<?php
// Directory where uploaded files will be saved
$uploadDir = 'uploads/';

// Ensure the upload directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['fileUpload'];

    // Check for errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        $filename = basename($file['name']);
        $targetPath = $uploadDir . $filename;

        // Validate file type (e.g., allow only images and text files)
        $allowedTypes = [
            // Images
            'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml', 'image/bmp',
        
            // Videos
            'video/mp4', 'video/mpeg', 'video/ogg', 'video/webm', 'video/quicktime', 'video/x-msvideo', 'video/x-ms-wmv',
        
            // Audio
            'audio/mpeg', 'audio/ogg', 'audio/wav', 'audio/webm', 'audio/aac', 'audio/x-wav',
        
            // Documents
            'text/plain', 'text/csv', 'application/pdf', 'application/msword', 
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
            'application/vnd.ms-excel', 
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
            'application/vnd.ms-powerpoint', 
            'application/vnd.openxmlformats-officedocument.presentationml.presentation', // .pptx
        
            // Archives
            'application/zip', 'application/x-rar-compressed', 'application/x-7z-compressed',
            'application/x-tar', 'application/gzip',
        ];

        if (in_array($file['type'], $allowedTypes)) {
            // Move the file to the target directory
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                echo "File uploaded successfully: <a href=\"$targetPath\">$filename</a>";
            } else {
                echo "Failed to upload the file.";
            }
        } else {
            echo "Invalid file type. Only JPEG, PNG, TXT, and PDF files are allowed.";
        }
    } else {
        echo "Error during file upload. Code: " . $file['error'];
    }
}
?>
