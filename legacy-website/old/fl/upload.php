<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// function to get the next available serial number
function getNextSerialNumber() {
	$serialFile = "serial.txt";
	if (file_exists($serialFile)) {
		$serialNumber = intval(file_get_contents($serialFile));
	} else {
		$serialNumber = 1; // Start with  1 if the serial file doesn't exit 
	}

	// Inrement serial number and save it to the file 
	file_put_contents($serialFile, $serialNumber + 1);
	return $serialNumber;
}


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Check if file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        // Ensure file size is within allowed limit (adjust as needed)
        $maxFileSize = 10 * 1024 * 1024; // 10 MB
        if ($_FILES["file"]["size"] > $maxFileSize) {
            echo "Error: File size exceeds the maximum allowed limit.";
            exit();
        }

        // Specify upload directory
        $uploadDir = "http://192.168.209.128/fl/uploads/";
        // Ensure the upload directory exists and is writable
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
	

	// Generate a unique filenumber using serial number
	$serialNumber = getNextSerialNumber();
	$uploadedFile = $uploadDir . $serialNumber . '_'. basename($_FILES["file"]["name"]);


        // Move uploaded file to specified directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadedFile)) {
            // File uploaded successfully
            // Output JavaScript to redirect after a short delay and display serial number
            echo "<script>";
            echo "var serialNumber = " . $serialNumber . ";";
            echo "alert('File uploaded successfully. Serial number: ' + serialNumber);";
            echo "setTimeout(function() { window.location.href = 'https://lcashish1.github.io'; }, 3000);"; // Redirect after 3 seconds
            echo "</script>";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error: " . $_FILES["file"]["error"];
    }
}
?>

