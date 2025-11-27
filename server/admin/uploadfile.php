<?php
function uploadFile($inputName, $uploadDir = "../../uploads/") {

    // No file
    if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== 0) {
        return null;
    }

    // Ensure directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Unique filename
    $filename = time() . "_" . basename($_FILES[$inputName]['name']);
    $targetFile = $uploadDir . $filename;

    // Move file
    move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetFile);

    return $filename; // return saved filename
}
?>
