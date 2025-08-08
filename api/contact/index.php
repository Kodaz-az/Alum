<?php
/**
 * Contact API Endpoint
 * Alumpro.Az Management System
 */

// Include required files
require_once __DIR__ . '/../../includes/session.php';

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

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
if (!checkRateLimit('contact_' . $client_ip, 10, 3600)) { // 10 requests per hour
    sendJsonResponse([
        'success' => false,
        'message' => 'Çox sayda sorğu göndərdiniz. Zəhmət olmasa bir az gözləyin.'
    ], 429);
}

if ($method !== 'POST') {
    sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

try {
    // Verify CSRF token
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        sendJsonResponse(['success' => false, 'message' => 'Invalid security token'], 403);
    }

    // Get and sanitize input data
    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $company = sanitize($_POST['company'] ?? '');
    $subject = sanitize($_POST['subject'] ?? '');
    $message = sanitize($_POST['message'] ?? '');
    $contact_methods = $_POST['contact_method'] ?? [];
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

    if (empty($subject)) {
        $errors['subject'] = 'Mövzu seçilməlidir';
    }

    if (empty($message)) {
        $errors['message'] = 'Mesaj tələb olunur';
    } elseif (strlen($message) < 10) {
        $errors['message'] = 'Mesaj ən azı 10 simvol olmalıdır';
    }

    if (!empty($errors)) {
        sendJsonResponse([
            'success' => false,
            'message' => 'Formu düzgün doldurun',
            'errors' => $errors
        ]);
    }

    $db = Database::getInstance();

    try {
        $db->beginTransaction();

        // For now, we'll create a simple contact_messages table structure
        // In a real implementation, you would create this table in your database schema
        
        // Log the activity instead of saving to a dedicated table for now
        logActivity(null, 'contact_message_sent', "Contact message from: {$name} ({$email}) - Subject: {$subject}", $client_ip);

        $db->commit();

        // Send email notification to admin (simulated)
        $admin_email_sent = sendAdminNotificationEmail($name, $email, $phone, $subject, $message);

        // Send auto-reply email to customer (simulated)
        $auto_reply_sent = sendAutoReplyEmail($name, $email);

        // Send WhatsApp notification if configured (simulated)
        $whatsapp_sent = false;
        if (defined('COMPANY_WHATSAPP') && !empty(COMPANY_WHATSAPP)) {
            $whatsapp_sent = sendWhatsAppNotification($name, $phone, $subject, $message);
        }

        sendJsonResponse([
            'success' => true,
            'message' => 'Mesajınız uğurla göndərildi. Ən qısa müddətdə sizinlə əlaqə saxlayacağıq.',
            'notifications_sent' => [
                'admin_email' => $admin_email_sent,
                'auto_reply' => $auto_reply_sent,
                'whatsapp' => $whatsapp_sent
            ]
        ]);

    } catch (Exception $e) {
        $db->rollback();
        error_log('Contact form error: ' . $e->getMessage());
        throw $e;
    }

} catch (Exception $e) {
    error_log('Contact API Error: ' . $e->getMessage());
    sendJsonResponse([
        'success' => false,
        'message' => 'Mesaj göndərilmədi. Zəhmət olmasa yenidən cəhd edin.'
    ], 500);
}

/**
 * Send admin notification email
 */
function sendAdminNotificationEmail($name, $email, $phone, $subject, $message) {
    try {
        // Here you would implement your email sending logic
        // For now, we'll just log it
        error_log("Admin notification: New contact from {$name} ({$email}) - Subject: {$subject}");
        
        // Log to messaging_log table
        $db = Database::getInstance();
        $sql = "INSERT INTO messaging_log (recipient, message, type, status, created_at) VALUES (?, ?, 'email', 'sent', NOW())";
        $admin_message = "New contact message from {$name}\nEmail: {$email}\nPhone: {$phone}\nSubject: {$subject}\nMessage: {$message}";
        $db->execute($sql, [COMPANY_EMAIL, $admin_message]);
        
        return true;
    } catch (Exception $e) {
        error_log("Failed to send admin notification email: " . $e->getMessage());
        return false;
    }
}

/**
 * Send auto-reply email to customer
 */
function sendAutoReplyEmail($name, $email) {
    try {
        // Here you would implement your email sending logic
        // For now, we'll just log it
        error_log("Auto-reply sent to {$name} ({$email})");
        
        // Log to messaging_log table
        $db = Database::getInstance();
        $sql = "INSERT INTO messaging_log (recipient, message, type, status, created_at) VALUES (?, ?, 'email', 'sent', NOW())";
        $auto_reply_message = "Hörmətli {$name},\n\nMesajınız üçün təşəkkür edirik. Komandamız ən qısa müddətdə sizinlə əlaqə saxlayacaq.\n\nHörmətlə,\nAlumpro.Az Komandası";
        $db->execute($sql, [$email, $auto_reply_message]);
        
        return true;
    } catch (Exception $e) {
        error_log("Failed to send auto-reply email: " . $e->getMessage());
        return false;
    }
}

/**
 * Send WhatsApp notification
 */
function sendWhatsAppNotification($name, $phone, $subject, $message) {
    try {
        // Here you would implement your WhatsApp sending logic
        // For now, we'll just log it
        error_log("WhatsApp notification: New contact from {$name} - {$subject}");
        
        // Log to messaging_log table
        $db = Database::getInstance();
        $sql = "INSERT INTO messaging_log (recipient, message, type, status, created_at) VALUES (?, ?, 'whatsapp', 'sent', NOW())";
        $whatsapp_message = "🔔 Yeni əlaqə mesajı\n👤 {$name}\n📞 {$phone}\n📋 {$subject}\n💬 {$message}";
        $db->execute($sql, [COMPANY_WHATSAPP, $whatsapp_message]);
        
        return true;
    } catch (Exception $e) {
        error_log("Failed to send WhatsApp notification: " . $e->getMessage());
        return false;
    }
}
?>