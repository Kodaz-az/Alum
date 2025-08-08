<?php
/**
 * Session Management
 * Alumpro.Az Management System
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include configuration and functions
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/functions.php';

/**
 * Check if session is valid
 */
function validateSession() {
    // Check if session exists
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['last_activity'])) {
        return false;
    }
    
    // Check session expiry
    if (time() - $_SESSION['last_activity'] > SESSION_EXPIRE) {
        destroySession();
        return false;
    }
    
    // Update last activity
    $_SESSION['last_activity'] = time();
    
    return true;
}

/**
 * Create user session
 */
function createSession($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['last_activity'] = time();
    $_SESSION['session_id'] = session_id();
    
    // Log the login
    logActivity($user['id'], 'login', 'User logged in');
    
    // Update last login in database
    try {
        $db = Database::getInstance();
        $sql = "UPDATE users SET last_login = NOW(), last_login_ip = ? WHERE id = ?";
        $db->execute($sql, [$_SERVER['REMOTE_ADDR'] ?? 'unknown', $user['id']]);
    } catch (Exception $e) {
        error_log("Failed to update last login: " . $e->getMessage());
    }
}

/**
 * Destroy session
 */
function destroySession() {
    if (isset($_SESSION['user_id'])) {
        logActivity($_SESSION['user_id'], 'logout', 'User logged out');
    }
    
    // Clear all session variables
    $_SESSION = [];
    
    // Delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Destroy the session
    session_destroy();
}

/**
 * Check authentication and redirect if not logged in
 */
function requireAuth($role = null) {
    if (!validateSession()) {
        redirect('/auth/login', 'Please login to continue', 'warning');
    }
    
    if ($role && !hasRole($role)) {
        redirect('/', 'Access denied', 'error');
    }
}

/**
 * Check permission and redirect if not authorized
 */
function requirePermission($permission) {
    requireAuth();
    
    if (!hasPermission($permission)) {
        redirect('/', 'Permission denied', 'error');
    }
}

/**
 * Regenerate session ID for security
 */
function regenerateSession() {
    session_regenerate_id(true);
    $_SESSION['session_id'] = session_id();
}

// Auto-regenerate session ID every 30 minutes
if (isset($_SESSION['last_regeneration'])) {
    if (time() - $_SESSION['last_regeneration'] > 1800) { // 30 minutes
        regenerateSession();
        $_SESSION['last_regeneration'] = time();
    }
} else {
    $_SESSION['last_regeneration'] = time();
}
?>