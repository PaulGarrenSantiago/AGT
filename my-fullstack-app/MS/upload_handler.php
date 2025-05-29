<?php
header('Content-Type: application/json');

// Create upload directories if they don't exist
$audioUploadDir = 'uploads/audio/';
$imageUploadDir = 'uploads/images/';

if (!file_exists($audioUploadDir)) {
    mkdir($audioUploadDir, 0777, true);
}
if (!file_exists($imageUploadDir)) {
    mkdir($imageUploadDir, 0777, true);
}

try {
    // Check if files were uploaded
    if (!isset($_FILES['audioFile']) || !isset($_FILES['imageFile'])) {
        throw new Exception('Both audio and image files are required');
    }

    // Generate unique filename prefix
    $uniqueId = uniqid();

    // Process audio file
    $audioFile = $_FILES['audioFile'];
    $audioFileExt = strtolower(pathinfo($audioFile['name'], PATHINFO_EXTENSION));
    $allowedAudioTypes = ['mp3', 'wav', 'ogg', 'm4a'];
    
    if (!in_array($audioFileExt, $allowedAudioTypes)) {
        throw new Exception('Invalid audio file type. Allowed types: ' . implode(', ', $allowedAudioTypes));
    }

    $audioFileName = $uniqueId . '_' . basename($audioFile['name']);
    $audioFilePath = $audioUploadDir . $audioFileName;

    // Process image file
    $imageFile = $_FILES['imageFile'];
    $imageFileExt = strtolower(pathinfo($imageFile['name'], PATHINFO_EXTENSION));
    $allowedImageTypes = ['jpg', 'jpeg', 'png', 'gif'];
    
    if (!in_array($imageFileExt, $allowedImageTypes)) {
        throw new Exception('Invalid image file type. Allowed types: ' . implode(', ', $allowedImageTypes));
    }

    $imageFileName = $uniqueId . '_' . basename($imageFile['name']);
    $imageFilePath = $imageUploadDir . $imageFileName;

    // Move uploaded files to their destinations
    if (!move_uploaded_file($audioFile['tmp_name'], $audioFilePath)) {
        throw new Exception('Failed to upload audio file');
    }
    if (!move_uploaded_file($imageFile['tmp_name'], $imageFilePath)) {
        // Remove the audio file if image upload fails
        unlink($audioFilePath);
        throw new Exception('Failed to upload image file');
    }

    // Generate URLs for the files
    $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/';
    $audioURL = $baseUrl . $audioFilePath;
    $imageURL = $baseUrl . $imageFilePath;

    // Return success response
    echo json_encode([
        'status' => 'success',
        'audioURL' => $audioURL,
        'imageURL' => $imageURL
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?> 