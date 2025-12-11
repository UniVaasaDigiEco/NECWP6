<?php
require_once(__DIR__ . '/../config/constants.php');

header('Content-Type: application/json');

$uploadDir = __DIR__ . '/../images/summernote_uploads/';
$images = [];

if (is_dir($uploadDir)) {
    $files = scandir($uploadDir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif|bmp|webp)$/i', $file)) {
            $filePath = $uploadDir . $file;
            $images[] = [
                'filename' => $file,
                'url' => ROOT_DIR . 'images/summernote_uploads/' . $file,
                'size' => filesize($filePath),
                'modified' => filemtime($filePath)
            ];
        }
    }

    // Sort by modified date, newest first
    usort($images, function($a, $b) {
        return $b['modified'] - $a['modified'];
    });
}

echo json_encode(['images' => $images]);
?>

