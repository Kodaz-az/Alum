<?php
/**
 * Common Functions and Utilities
 * Alumpro.Az Management System
 */

/**
 * Sanitize input data
 */
function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number (Azerbaijan format)
 */
function isValidPhone($phone) {
    $pattern = '/^(\+994|994|0)?(50|51|55|70|77|99)[0-9]{7}$/';
    return preg_match($pattern, $phone);
}

/**
 * Generate CSRF token
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['csrf_token_time'] = time();
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verifyCSRFToken($token) {
    if (!isset($_SESSION['csrf_token']) || !isset($_SESSION['csrf_token_time'])) {
        return false;
    }
    
    // Check if token has expired
    if (time() - $_SESSION['csrf_token_time'] > CSRF_TOKEN_EXPIRE) {
        unset($_SESSION['csrf_token'], $_SESSION['csrf_token_time']);
        return false;
    }
    
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Hash password
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_ARGON2ID, [
        'memory_cost' => 65536,
        'time_cost' => 4,
        'threads' => 3
    ]);
}

/**
 * Verify password
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Generate random string
 */
function generateRandomString($length = 10) {
    return bin2hex(random_bytes($length / 2));
}

/**
 * Log activity
 */
function logActivity($user_id, $action, $details = '', $ip = null) {
    if ($ip === null) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }
    
    try {
        $db = Database::getInstance();
        $sql = "INSERT INTO activity_log (user_id, action, details, ip_address, created_at) VALUES (?, ?, ?, ?, NOW())";
        $db->execute($sql, [$user_id, $action, $details, $ip]);
    } catch (Exception $e) {
        error_log("Failed to log activity: " . $e->getMessage());
    }
}

/**
 * Format currency
 */
function formatCurrency($amount, $currency = DEFAULT_CURRENCY) {
    return number_format($amount, 2) . ' ' . $currency;
}

/**
 * Format date
 */
function formatDate($date, $format = 'd.m.Y H:i') {
    if (is_string($date)) {
        $date = new DateTime($date);
    }
    return $date->format($format);
}

/**
 * Get file extension
 */
function getFileExtension($filename) {
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

/**
 * Validate file upload
 */
function validateFileUpload($file, $allowed_types = ALLOWED_IMAGE_TYPES) {
    $errors = [];
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'File upload error: ' . $file['error'];
        return $errors;
    }
    
    if ($file['size'] > MAX_FILE_SIZE) {
        $errors[] = 'File size exceeds maximum allowed size';
    }
    
    $extension = getFileExtension($file['name']);
    if (!in_array($extension, $allowed_types)) {
        $errors[] = 'File type not allowed';
    }
    
    return $errors;
}

/**
 * Upload file
 */
function uploadFile($file, $directory = 'general', $allowed_types = ALLOWED_IMAGE_TYPES) {
    $errors = validateFileUpload($file, $allowed_types);
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    $upload_dir = UPLOAD_PATH . $directory . '/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $extension = getFileExtension($file['name']);
    $filename = uniqid() . '_' . time() . '.' . $extension;
    $filepath = $upload_dir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return [
            'success' => true,
            'filename' => $filename,
            'filepath' => $filepath,
            'url' => '/uploads/' . $directory . '/' . $filename
        ];
    } else {
        return ['success' => false, 'errors' => ['Failed to move uploaded file']];
    }
}

/**
 * Send JSON response
 */
function sendJsonResponse($data, $status_code = 200) {
    http_response_code($status_code);
    header('Content-Type: application/json');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * Redirect with message
 */
function redirect($url, $message = '', $type = 'info') {
    if (!empty($message)) {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }
    header('Location: ' . $url);
    exit;
}

/**
 * Get flash message
 */
function getFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        $type = $_SESSION['flash_type'] ?? 'info';
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
        return ['message' => $message, 'type' => $type];
    }
    return null;
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Check user role
 */
function hasRole($role) {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
}

/**
 * Check if user has permission
 */
function hasPermission($permission) {
    if (!isLoggedIn()) {
        return false;
    }
    
    $user_role = $_SESSION['user_role'] ?? '';
    
    // Admin has all permissions
    if ($user_role === 'admin') {
        return true;
    }
    
    // Define role permissions
    $role_permissions = [
        'sales' => ['view_orders', 'create_orders', 'edit_orders', 'view_customers', 'view_products'],
        'customer' => ['view_own_orders', 'create_orders', 'view_profile']
    ];
    
    return isset($role_permissions[$user_role]) && in_array($permission, $role_permissions[$user_role]);
}

/**
 * Generate UUID v4
 */
function generateUUID() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

/**
 * Rate limiting
 */
function checkRateLimit($identifier, $max_requests = 60, $time_window = 3600) {
    $cache_key = 'rate_limit_' . md5($identifier);
    $cache_file = CACHE_PATH . $cache_key . '.json';
    
    if (!is_dir(CACHE_PATH)) {
        mkdir(CACHE_PATH, 0755, true);
    }
    
    $current_time = time();
    $requests = [];
    
    if (file_exists($cache_file)) {
        $data = json_decode(file_get_contents($cache_file), true);
        if ($data && isset($data['requests'])) {
            $requests = array_filter($data['requests'], function($timestamp) use ($current_time, $time_window) {
                return ($current_time - $timestamp) < $time_window;
            });
        }
    }
    
    if (count($requests) >= $max_requests) {
        return false;
    }
    
    $requests[] = $current_time;
    file_put_contents($cache_file, json_encode(['requests' => $requests]));
    
    return true;
}
?>