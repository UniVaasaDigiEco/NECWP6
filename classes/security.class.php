<?php
require_once(__DIR__ . '/tools.class.php');
require_once(__DIR__ . '/../vendor/autoload.php');
use Ramsey\Uuid\Uuid;
class Security{
    public static function sanitizeInput($data): string
    {
        // Trim whitespace from the beginning and end
        $data = trim($data);
        // Remove backslashes
        $data = stripslashes($data);
        // Convert special characters to HTML entities
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    public static function addUser($email, $password, $full_name): bool
    {
        $db = Tools::getDB();

        $sanitizedEmail = self::sanitizeInput($email);
        $sanitizedName = self::sanitizeInput($full_name);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $uuid = Uuid::uuid4();
        $public_id = $uuid->getBytes();

        $sql = "INSERT INTO users (public_id, email, password_hash, full_name) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssss', $public_id, $sanitizedEmail, $hashedPassword, $sanitizedName);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public static function authenticateUser($user_public_id, $password): bool
    {
        try {
            $user = Tools::getUserWithPublicId($user_public_id);
            $user_id = $user->getId();
        } catch (Exception $e) {
            return false;
        }

        $db = Tools::getDB();
        $sql = "SELECT password_hash FROM users WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $user_id);
        /** @var string $fetched_password_hash */
        $stmt->bind_result($fetched_password_hash);
        $stmt->execute();
        $stmt->fetch();

        if (password_verify($password, $fetched_password_hash)) {
            return true;
        } else {
            return false;
        }
    }

    public static function resetPassword(){

    }

    /**
     * Check if the current user session is authenticated
     * @return bool True if authenticated, false otherwise
     */
    public static function isAuthenticated(): bool
    {
        // Ensure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if all required session variables are set
        if (!isset($_SESSION['is_logged_in']) ||
            !isset($_SESSION['user_id']) ||
            !isset($_SESSION['login_timestamp'])) {
            return false;
        }

        // Check if user is marked as logged in
        if ($_SESSION['is_logged_in'] !== true) {
            return false;
        }

        // Check if session has expired (24 hours)
        $session_lifetime = 24 * 60 * 60; // 24 hours in seconds
        if ((time() - $_SESSION['login_timestamp']) > $session_lifetime) {
            return false;
        }

        // Optional: Check if IP address has changed (security measure)
        // Commented out by default as it can cause issues with dynamic IPs
        /*
        if (isset($_SESSION['ip_address']) && $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']) {
            return false;
        }
        */

        return true;
    }

    /**
     * Protect a page by requiring authentication
     * Redirects to login page if user is not authenticated
     * @param string $loginUrl The URL to redirect to if not authenticated (default: '../login.php')
     * @return void
     */
    public static function requireAuth(string $loginUrl = '../login.php'): void
    {
        if (!self::isAuthenticated()) {
            // Clear any existing session data
            $_SESSION = [];

            // Destroy the session
            if (session_status() === PHP_SESSION_ACTIVE) {
                session_destroy();
            }

            // Redirect to login page with error message
            header('Location: ' . $loginUrl . '?error=3');
            exit();
        }

        // Optional: Refresh the login timestamp to keep session alive (sliding timeout)
        // Uncomment if you want a "sliding" session timeout
        // $_SESSION['login_timestamp'] = time();
    }

    /**
     * Log out the current user by destroying their session
     * @return void
     */
    public static function logout(): void
    {
        // Ensure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Clear all session variables
        $_SESSION = [];

        // Destroy the session cookie
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }

        // Destroy the session
        session_destroy();
    }
}