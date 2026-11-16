<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if input data is set and not empty
    if (isset($_POST["inputData"]) && !empty($_POST["inputData"])) {
        // Sanitize input data
        $inputData = htmlspecialchars($_POST["inputData"]);

        // Define the file path to store the data
        $filePath = '/var/www/html/new/data.txt';

        // Check if file exists and is writable
        if (file_exists($filePath) && is_writable($filePath)) {
            // Open the file in append mode
            $file = fopen($filePath, "a");

            // Check if file opened successfully
            if ($file) {
                // Write the input data to the file
                fwrite($file, $inputData . "\n");

                // Close the file
                fclose($file);

                echo "Data stored successfully!";
            } else {
                echo "Error: Unable to open the file for writing.";
            }
        } else {
            echo "Error: The file $filePath is not writable.";
        }
    } else {
        echo "Please enter some data!";
    }
}
?>

