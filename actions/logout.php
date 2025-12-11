<?php
require_once(__DIR__ . '/../config/constants.php');
require_once(__DIR__ . '/../classes/security.class.php');

// Start session
session_name(SESSION_NAME);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Log out the user
Security::logout();

// Redirect to home page
header('Location: ../index.php');
exit();

