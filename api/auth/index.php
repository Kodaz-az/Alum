<?php
/**
 * Authentication API Endpoints
 * Alumpro.Az Management System
 */

// Include required files
require_once __DIR__ . '/../../includes/session.php';

// Get request method and action
$method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];
$path_parts = explode('/', trim($request_uri, '/'));
$action = end($path_parts);

// CORS headers for API
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-CSRF-Token');

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Rate limiting
$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
if (!checkRateLimit('auth_' . $client_ip, 30, 3600)) { // 30 requests per hour
    sendJsonResponse([
        'success' => false,
        'message' => 'Çox sayda sorğu göndərdiniz. Zəhmət olmasa bir az gözləyin.'
    ], 429);
}

try {
    switch ($action) {
        case 'login':
            handleLogin();
            break;
        case 'register':
            handleRegister();
            break;
        case 'logout':
            handleLogout();
            break;
        case 'verify':
            handleVerification();
            break;
        case 'forgot-password':
            handleForgotPassword();
            break;
        case 'reset-password':
            handleResetPassword();
            break;
        case 'csrf-token':
            handleCSRFToken();
            break;
        default:
            sendJsonResponse([
                'success' => false,
                'message' => 'Invalid endpoint'
            ], 404);
    }
} catch (Exception $e) {
    error_log('Auth API Error: ' . $e->getMessage());
    sendJsonResponse([
        'success' => false,
        'message' => 'Server error occurred'
    ], 500);
}

function handleLogin() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
    }

    // Verify CSRF token
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        sendJsonResponse(['success' => false, 'message' => 'Invalid security token'], 403);
    }

    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember_me = isset($_POST['remember_me']);

    // Validation
    $errors = [];
    if (empty($email)) {
        $errors['email'] = 'E-poçt ünvanı tələb olunur';
    } elseif (!isValidEmail($email)) {
        $errors['email'] = 'Düzgün e-poçt ünvanı daxil edin';
    }

    if (empty($password)) {
        $errors['password'] = 'Şifrə tələb olunur';
    }

    if (!empty($errors)) {
        sendJsonResponse([
            'success' => false,
            'message' => 'Formu düzgün doldurun',
            'errors' => $errors
        ]);
    }

    // Check user credentials
    $db = Database::getInstance();
    $sql = "SELECT * FROM users WHERE email = ? AND status = 'active'";
    $user = $db->fetch($sql, [$email]);

    if (!$user || !verifyPassword($password, $user['password'])) {
        logActivity(null, 'failed_login', "Failed login attempt for email: $email", $_SERVER['REMOTE_ADDR']);
        sendJsonResponse([
            'success' => false,
            'message' => 'E-poçt və ya şifrə yanlışdır'
        ]);
    }

    // Check if email is verified
    if (!$user['email_verified']) {
        sendJsonResponse([
            'success' => false,
            'message' => 'E-poçt ünvanınızı təsdiqləməlisiniz',
            'redirect' => '/auth/verify?email=' . urlencode($email)
        ]);
    }

    // Create session
    createSession($user);

    // Set remember me cookie if requested
    if ($remember_me) {
        $token = generateRandomString(32);
        setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', true, true); // 30 days
        
        // Store token in database (you might want to create a remember_tokens table)
        $sql = "UPDATE users SET remember_token = ? WHERE id = ?";
        $db->execute($sql, [hash('sha256', $token), $user['id']]);
    }

    // Determine redirect URL based on role
    $redirect = '/';
    switch ($user['role']) {
        case 'admin':
            $redirect = '/admin';
            break;
        case 'sales':
            $redirect = '/sales';
            break;
        case 'customer':
            $redirect = '/customer';
            break;
    }

    sendJsonResponse([
        'success' => true,
        'message' => 'Uğurla giriş etdiniz',
        'redirect' => $redirect,
        'user' => [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ]
    ]);
}

function handleRegister() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
    }

    // Verify CSRF token
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        sendJsonResponse(['success' => false, 'message' => 'Invalid security token'], 403);
    }

    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    $company = sanitize($_POST['company'] ?? '');
    $address = sanitize($_POST['address'] ?? '');
    $agree_terms = isset($_POST['agree_terms']);
    $newsletter = isset($_POST['newsletter']);

    // Validation
    $errors = [];

    if (empty($name)) {
        $errors['name'] = 'Ad və soyad tələb olunur';
    } elseif (strlen($name) < 2) {
        $errors['name'] = 'Ad və soyad ən azı 2 simvol olmalıdır';
    }

    if (empty($email)) {
        $errors['email'] = 'E-poçt ünvanı tələb olunur';
    } elseif (!isValidEmail($email)) {
        $errors['email'] = 'Düzgün e-poçt ünvanı daxil edin';
    }

    if (empty($phone)) {
        $errors['phone'] = 'Telefon nömrəsi tələb olunur';
    } elseif (!isValidPhone($phone)) {
        $errors['phone'] = 'Düzgün telefon nömrəsi daxil edin';
    }

    if (empty($password)) {
        $errors['password'] = 'Şifrə tələb olunur';
    } elseif (strlen($password) < PASSWORD_MIN_LENGTH) {
        $errors['password'] = 'Şifrə ən azı ' . PASSWORD_MIN_LENGTH . ' simvol olmalıdır';
    }

    if ($password !== $password_confirm) {
        $errors['password_confirm'] = 'Şifrələr uyğun gəlmir';
    }

    if (!$agree_terms) {
        $errors['agree_terms'] = 'İstifadə şərtləri ilə razılaşmalısınız';
    }

    if (!empty($errors)) {
        sendJsonResponse([
            'success' => false,
            'message' => 'Formu düzgün doldurun',
            'errors' => $errors
        ]);
    }

    $db = Database::getInstance();

    // Check if email already exists
    $sql = "SELECT id FROM users WHERE email = ?";
    $existing_user = $db->fetch($sql, [$email]);
    if ($existing_user) {
        sendJsonResponse([
            'success' => false,
            'message' => 'Bu e-poçt ünvanı artıq istifadə olunur',
            'errors' => ['email' => 'Bu e-poçt ünvanı artıq qeydiyyatdan keçib']
        ]);
    }

    // Check if phone already exists
    $sql = "SELECT id FROM users WHERE phone = ?";
    $existing_phone = $db->fetch($sql, [$phone]);
    if ($existing_phone) {
        sendJsonResponse([
            'success' => false,
            'message' => 'Bu telefon nömrəsi artıq istifadə olunur',
            'errors' => ['phone' => 'Bu telefon nömrəsi artıq qeydiyyatdan keçib']
        ]);
    }

    try {
        $db->beginTransaction();

        // Create user
        $hashed_password = hashPassword($password);
        $sql = "INSERT INTO users (name, email, phone, password, role, status, created_at) VALUES (?, ?, ?, ?, 'customer', 'pending', NOW())";
        $db->execute($sql, [$name, $email, $phone, $hashed_password]);
        $user_id = $db->lastInsertId();

        // Create customer record
        $sql = "INSERT INTO customers (user_id, name, email, phone, company, address, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $db->execute($sql, [$user_id, $name, $email, $phone, $company, $address]);

        // Generate verification code
        $verification_code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expires_at = date('Y-m-d H:i:s', time() + 600); // 10 minutes

        $sql = "INSERT INTO verification_codes (email, phone, code, type, expires_at) VALUES (?, ?, ?, 'email', ?)";
        $db->execute($sql, [$email, $phone, $verification_code, $expires_at]);

        $db->commit();

        // Send verification email (implement your email sending logic here)
        // sendVerificationEmail($email, $verification_code);

        // Send verification SMS (implement your SMS sending logic here)
        // sendVerificationSMS($phone, $verification_code);

        logActivity($user_id, 'user_registered', "New user registered: $email");

        sendJsonResponse([
            'success' => true,
            'message' => 'Qeydiyyat uğurla tamamlandı. E-poçt ünvanınızı təsdiqləyin.',
            'redirect' => '/auth/verify?email=' . urlencode($email)
        ]);

    } catch (Exception $e) {
        $db->rollback();
        error_log('Registration error: ' . $e->getMessage());
        sendJsonResponse([
            'success' => false,
            'message' => 'Qeydiyyat zamanı xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.'
        ]);
    }
}

function handleLogout() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
    }

    // Clear remember me cookie
    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, '/', '', true, true);
        
        // Remove token from database if user is logged in
        if (isLoggedIn()) {
            $db = Database::getInstance();
            $sql = "UPDATE users SET remember_token = NULL WHERE id = ?";
            $db->execute($sql, [$_SESSION['user_id']]);
        }
    }

    destroySession();

    sendJsonResponse([
        'success' => true,
        'message' => 'Uğurla çıxış etdiniz'
    ]);
}

function handleVerification() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
    }

    $email = sanitize($_POST['email'] ?? '');
    $code = sanitize($_POST['code'] ?? '');

    if (empty($email) || empty($code)) {
        sendJsonResponse([
            'success' => false,
            'message' => 'E-poçt və kod tələb olunur'
        ]);
    }

    $db = Database::getInstance();

    // Find verification code
    $sql = "SELECT * FROM verification_codes WHERE email = ? AND code = ? AND type = 'email' AND verified = 0 AND expires_at > NOW()";
    $verification = $db->fetch($sql, [$email, $code]);

    if (!$verification) {
        sendJsonResponse([
            'success' => false,
            'message' => 'Kod yanlışdır və ya vaxtı keçib'
        ]);
    }

    try {
        $db->beginTransaction();

        // Mark verification as used
        $sql = "UPDATE verification_codes SET verified = 1 WHERE id = ?";
        $db->execute($sql, [$verification['id']]);

        // Activate user
        $sql = "UPDATE users SET email_verified = 1, status = 'active' WHERE email = ?";
        $db->execute($sql, [$email]);

        $db->commit();

        logActivity(null, 'email_verified', "Email verified: $email");

        sendJsonResponse([
            'success' => true,
            'message' => 'E-poçt ünvanınız uğurla təsdiqləndi',
            'redirect' => '/auth/login'
        ]);

    } catch (Exception $e) {
        $db->rollback();
        error_log('Email verification error: ' . $e->getMessage());
        sendJsonResponse([
            'success' => false,
            'message' => 'Təsdiqləmə zamanı xəta baş verdi'
        ]);
    }
}

function handleCSRFToken() {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
    }

    sendJsonResponse([
        'success' => true,
        'token' => generateCSRFToken()
    ]);
}

function handleForgotPassword() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
    }

    $email = sanitize($_POST['email'] ?? '');

    if (empty($email) || !isValidEmail($email)) {
        sendJsonResponse([
            'success' => false,
            'message' => 'Düzgün e-poçt ünvanı daxil edin'
        ]);
    }

    $db = Database::getInstance();

    // Check if user exists
    $sql = "SELECT id FROM users WHERE email = ? AND status = 'active'";
    $user = $db->fetch($sql, [$email]);

    // Always return success to prevent email enumeration
    if ($user) {
        // Generate reset code
        $reset_code = generateRandomString(32);
        $expires_at = date('Y-m-d H:i:s', time() + 3600); // 1 hour

        $sql = "INSERT INTO verification_codes (email, code, type, expires_at) VALUES (?, ?, 'password_reset', ?)";
        $db->execute($sql, [$email, $reset_code, $expires_at]);

        // Send password reset email (implement your email sending logic here)
        // sendPasswordResetEmail($email, $reset_code);

        logActivity($user['id'], 'password_reset_requested', "Password reset requested for: $email");
    }

    sendJsonResponse([
        'success' => true,
        'message' => 'Əgər bu e-poçt ünvanı qeydiyyatdan keçibsə, şifrə sıfırlama linki göndəriləcək'
    ]);
}

function handleResetPassword() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
    }

    $token = sanitize($_POST['token'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    $errors = [];

    if (empty($token)) {
        $errors['token'] = 'Sıfırlama kodu tələb olunur';
    }

    if (empty($password)) {
        $errors['password'] = 'Şifrə tələb olunur';
    } elseif (strlen($password) < PASSWORD_MIN_LENGTH) {
        $errors['password'] = 'Şifrə ən azı ' . PASSWORD_MIN_LENGTH . ' simvol olmalıdır';
    }

    if ($password !== $password_confirm) {
        $errors['password_confirm'] = 'Şifrələr uyğun gəlmir';
    }

    if (!empty($errors)) {
        sendJsonResponse([
            'success' => false,
            'message' => 'Formu düzgün doldurun',
            'errors' => $errors
        ]);
    }

    $db = Database::getInstance();

    // Find valid reset token
    $sql = "SELECT * FROM verification_codes WHERE code = ? AND type = 'password_reset' AND verified = 0 AND expires_at > NOW()";
    $reset_token = $db->fetch($sql, [$token]);

    if (!$reset_token) {
        sendJsonResponse([
            'success' => false,
            'message' => 'Sıfırlama kodu yanlışdır və ya vaxtı keçib'
        ]);
    }

    try {
        $db->beginTransaction();

        // Update password
        $hashed_password = hashPassword($password);
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $db->execute($sql, [$hashed_password, $reset_token['email']]);

        // Mark token as used
        $sql = "UPDATE verification_codes SET verified = 1 WHERE id = ?";
        $db->execute($sql, [$reset_token['id']]);

        $db->commit();

        logActivity(null, 'password_reset', "Password reset completed for: " . $reset_token['email']);

        sendJsonResponse([
            'success' => true,
            'message' => 'Şifrəniz uğurla dəyişdirildi',
            'redirect' => '/auth/login'
        ]);

    } catch (Exception $e) {
        $db->rollback();
        error_log('Password reset error: ' . $e->getMessage());
        sendJsonResponse([
            'success' => false,
            'message' => 'Şifrə dəyişdirmə zamanı xəta baş verdi'
        ]);
    }
}
?>