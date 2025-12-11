<?php
// Load database credentials from environment file
$env = require __DIR__ . '/../.env.php';

const ROOT_DIR = '/';
const ICON_PATH = ROOT_DIR . 'images/logos/icon.png';
const PAGES = [
    "index" => ["label" => "<i class='bi bi-house'></i> Home", "URL" => "index.php", "filename" => "index.php"],
    "about" => ["label" => "<i class='bi bi-info-circle'></i> About", "URL" => "pages/about.php", "filename" => "about.php"],
    "contact" => ["label" => "<i class='bi bi-person'></i> Contact", "URL" => "pages/contact.php", "filename" => "contact.php"],
    "admin_main" => ["label" => "<i class='bi bi-speedometer2'></i> Admin Dashboard", "URL" => "admin/admin_main.php", "filename" => "admin_main.php"],
    "login" => ["label" => "<i class='bi bi-lock-fill'></i>", "URL" => "pages/login.php", "filename" => "login.php"],
    "logout" => ["label" => "<i class='bi bi-box-arrow-right'></i>", "URL" => "actions/logout.php", "filename" => "logout.php"]
];

const SESSION_NAME = "SessionName";

// Database configuration from environment file
define('DB_HOST', $env['DB_HOST']);
define('DB_NAME', $env['DB_NAME']);
define('DB_USER', $env['DB_USER']);
define('DB_PASS', $env['DB_PASS']);

const MESSAGE_CODES = [
    1 => "Incorrect login credentials. Please try again.",
    2 => "An error occurred. Please try again. If the problem persists, contact support.",
    3 => "You must be logged in to access this page. Please log in to continue.",
    404 => "The requested resource was not found."
];

const SUMMERNOTE_IMAGE_PATH = "/images/summernote_uploads/";