<?php
require_once(__DIR__ . '/../config/constants.php');
require_once(__DIR__ . '/../classes/tools.class.php');
require_once(__DIR__ . '/../classes/security.class.php');
require_once(__DIR__ . '/../vendor/autoload.php');
use Ramsey\Uuid\Uuid;

session_name(SESSION_NAME);

$db = Tools::getDB();
//TODO: Implement login logic
var_dump($_POST);

$sql = "SELECT public_id FROM users WHERE email = ?";
$stmt = $db->prepare($sql);
$sanitized_username = Security::sanitizeInput($_POST['username']);
$stmt->bind_param("s", $sanitized_username);
/** @var string $fetched_public_id */
$stmt->bind_result($fetched_public_id);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows === 0) {
    // No user found with that email
    $error_code = 1; // Invalid username or password
    header('Location: ../pages/login.php?error=' . urlencode($error_code));
    die();
}
if($stmt->num_rows > 1) {
    // Multiple users found with that email - database integrity error
    $error_code = 2; // Database integrity error
    header('Location: ../pages/login.php?error=' . urlencode($error_code));
    die();
}
$stmt->fetch();
$stmt->close();
$public_id = Uuid::fromBytes($fetched_public_id)->toString();
$is_authenticated = Security::authenticateUser($public_id, $_POST['password']);
if($is_authenticated) { // Successful authentication
    // Start session first
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Regenerate session ID to prevent session fixation attacks
    session_regenerate_id(true);

    // Set session variables
    $_SESSION['user_id'] = $public_id;
    $_SESSION['is_logged_in'] = true;
    $_SESSION['login_timestamp'] = time();
    $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];

    // Redirect to admin main page
    header("Location: ../pages/admin/admin_main.php");
    exit();
} else { // Authentication failed
    $error_code = 1; // Invalid username or password
    header('Location: ../pages/login.php?error=' . urlencode($error_code));
    die();
}