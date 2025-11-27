<?php
if (!isset($_GET['file'])) {
    die("No file specified.");
}

$file = $_GET['file'];
$filePath = "../../uploads/" . $file;
echo 'filePath' . $filePath;

if (!file_exists($filePath)) {
    die("File not found.");
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));

readfile($filePath);
exit;
?>
