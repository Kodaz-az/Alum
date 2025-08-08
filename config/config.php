<?php
/**
 * Database Configuration
 * Alumpro.Az Management System
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'ezizov04_db');
define('DB_USER', 'ezizov04_user');
define('DB_PASS', 'secure_password_here');
define('DB_CHARSET', 'utf8mb4');

/**
 * Application Configuration
 */
define('APP_NAME', 'Alumpro.Az');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'https://alumpro.az');
define('APP_DEBUG', false);

/**
 * Security Configuration
 */
define('SECRET_KEY', 'your-secret-key-here-change-in-production');
define('CSRF_TOKEN_EXPIRE', 3600); // 1 hour
define('SESSION_EXPIRE', 7200); // 2 hours
define('PASSWORD_MIN_LENGTH', 8);

/**
 * File Upload Configuration
 */
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
define('ALLOWED_DOCUMENT_TYPES', ['pdf', 'doc', 'docx', 'xlsx']);
define('UPLOAD_PATH', __DIR__ . '/../uploads/');

/**
 * WhatsApp Configuration
 */
define('WHATSAPP_SESSION_PATH', __DIR__ . '/../storage/whatsapp/');
define('WHATSAPP_WEBHOOK_URL', APP_URL . '/api/whatsapp/webhook');
define('WHATSAPP_AUTO_REPLY', true);
define('WHATSAPP_BUSINESS_HOURS_START', '09:00');
define('WHATSAPP_BUSINESS_HOURS_END', '18:00');

/**
 * SMS Configuration (for verification)
 */
define('SMS_PROVIDER', 'local'); // local, twilio, etc.
define('SMS_API_KEY', 'your-sms-api-key');
define('SMS_SENDER', 'Alumpro');

/**
 * Email Configuration
 */
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'info@alumpro.az');
define('MAIL_PASSWORD', 'your-email-password');
define('MAIL_FROM_ADDRESS', 'info@alumpro.az');
define('MAIL_FROM_NAME', 'Alumpro.Az');

/**
 * Currency and Localization
 */
define('DEFAULT_CURRENCY', 'AZN');
define('DEFAULT_LANGUAGE', 'az');
define('DEFAULT_TIMEZONE', 'Asia/Baku');

/**
 * Cache Configuration
 */
define('CACHE_ENABLED', true);
define('CACHE_DURATION', 3600); // 1 hour
define('CACHE_PATH', __DIR__ . '/../storage/cache/');

/**
 * API Configuration
 */
define('API_RATE_LIMIT', 100); // requests per hour
define('API_VERSION', 'v1');
define('API_AUTH_EXPIRE', 86400); // 24 hours

/**
 * Company Information
 */
define('COMPANY_NAME', 'Alumpro.Az');
define('COMPANY_ADDRESS', 'Bakı, Azərbaycan');
define('COMPANY_PHONE', '+994 XX XXX XX XX');
define('COMPANY_EMAIL', 'info@alumpro.az');
define('COMPANY_WHATSAPP', '+994 XX XXX XX XX');

/**
 * Set timezone
 */
date_default_timezone_set(DEFAULT_TIMEZONE);

/**
 * Error reporting based on debug mode
 */
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/../logs/php_errors.log');
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/../logs/php_errors.log');
}

/**
 * Session configuration
 */
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.gc_maxlifetime', SESSION_EXPIRE);
ini_set('session.cookie_lifetime', SESSION_EXPIRE);
?>