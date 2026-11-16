<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set and not empty
    if (isset($_POST["name"]) && !empty($_POST["name"]) &&
        isset($_POST["address"]) && !empty($_POST["address"]) &&
        isset($_POST["phone"]) && !empty($_POST["phone"]) &&
        isset($_POST["sex"]) && !empty($_POST["sex"]) &&
        isset($_POST["nationality"]) && !empty($_POST["nationality"])) {

        // Sanitize input data
        $name = htmlspecialchars($_POST["name"]);
        $address = htmlspecialchars($_POST["address"]);
        $phone = htmlspecialchars($_POST["phone"]);
        $sex = htmlspecialchars($_POST["sex"]);
        $nationality = htmlspecialchars($_POST["nationality"]);
        
        // Define the file path to store the data
        $filePath = '/main/new/user_data.txt';

        // Format data to write to file
        $data = "Name: $name\nAddress: $address\nPhone: $phone\nSex: $sex\nNationality: $nationality\n\n";

        // Open the file in append mode
        $file = fopen($filePath, "a");

        // Check if file opened successfully
        if ($file) {
            // Write the data to the file
            fwrite($file, $data);

            // Close the file
            fclose($file);

              //echo "Data stored successfully!";

	    // Redirect to another website 
	    // echo '<script src="http://192.168.209.128/fl/script.js"></script>';
	   //  header("Location: http://192.168.209.128");


		echo '<script>
            setTimeout(function() {
                // Display success message
                alert("Your data has been added successfully.");

                // Redirect to the specified URL
                window.location.href = "https://lcashish1.github.io";
            }, 1000); // Simulated delay of 1 second (adjust as needed)
          </script>';

		exit();

        } else {
            echo "Error: Unable to open the file for writing.";
        }
    } else {
        echo "Please fill out all fields!";
    }
}
?>
