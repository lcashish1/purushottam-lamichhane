<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["identifier"])) {
    $identifier = $_GET["identifier"];
    $filePath = "uploads/" . $identifier . "_*"; // Adjust file path pattern as per your naming convention
    $files = glob($filePath);
    if (count($files) > 0) {
        $file = $files[0];
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . basename($file));
        readfile($file);
        exit();
    } else {
        echo "File not found.";
    }
}
?>
