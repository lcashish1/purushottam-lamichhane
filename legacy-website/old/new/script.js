// Wait for the DOM content to be fully loaded
document.addEventListener("DOMContentLoaded", function() {
    // Select the form element with the ID "myForm"
    var form = document.getElementById("myForm");

    // Add an event listener to the form submission event
    form.addEventListener("submit", function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Simulate data submission with a timeout
        setTimeout(function() {
            // Display success message
            alert("Your data has been added successfully.");

            // Redirect to the specified URL
            window.location.href = "https://lcashish1.github.io";
        }, 1000); // Simulated delay of 1 second (adjust as needed)
    });
});

