<?php
require_once('../classes/tools.class.php');
require_once('../config/constants.php');

// Set JSON response header
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method.']);
    exit;
}

if (!isset($_FILES['file'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No file uploaded.']);
    exit;
}

$file = $_FILES['file'];

// Check for upload errors
if ($file['error'] !== UPLOAD_ERR_OK) {
    $errorMessages = [
        UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE directive in HTML form',
        UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
    ];
    $errorMsg = $errorMessages[$file['error']] ?? 'Unknown upload error';
    http_response_code(400);
    echo json_encode(['error' => $errorMsg]);
    exit;
}

$fileTmpPath = $file['tmp_name'];
$fileName = $file['name'];
$fileSize = $file['size'];
$fileType = $file['type'];

// Validate file name
if (empty($fileName)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid file name.']);
    exit;
}

$fileNameCmps = explode(".", $fileName);
if (count($fileNameCmps) < 2) {
    http_response_code(400);
    echo json_encode(['error' => 'File must have an extension.']);
    exit;
}

$fileExtension = strtolower(end($fileNameCmps));
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];

if (!in_array($fileExtension, $allowedExtensions)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid file type. Allowed: ' . implode(', ', $allowedExtensions)]);
    exit;
}

// Additional validation: check actual file type (MIME)
$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp'];
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$actualMimeType = finfo_file($finfo, $fileTmpPath);
finfo_close($finfo);

if (!in_array($actualMimeType, $allowedMimeTypes)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid file content. File is not a valid image.']);
    exit;
}

// Sanitize file name and create unique name
$baseFileName = implode('.', array_slice($fileNameCmps, 0, -1));
$newFileName = Tools::sanitizeFileName($baseFileName) . '_' . time() . '.' . $fileExtension;

// Directory in which the uploaded file will be moved
$uploadFileDir = __DIR__ . '/../' . ltrim(SUMMERNOTE_IMAGE_PATH, '/');

if (!is_dir($uploadFileDir)) {
    if (!mkdir($uploadFileDir, 0755, true)) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to create upload directory.']);
        exit;
    }
}

$dest_path = $uploadFileDir . $newFileName;

// Move the uploaded file
if (!move_uploaded_file($fileTmpPath, $dest_path)) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to move uploaded file.']);
    exit;
}

// Success - return the image URL
$imageURL = ROOT_DIR . ltrim(SUMMERNOTE_IMAGE_PATH, '/') . $newFileName;
echo json_encode(['url' => $imageURL]);
?>