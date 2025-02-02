<!DOCTYPE html>
<html>
<body>

<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "Malcolm_webpage";

// Establishing the connection
$con = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $name = $con->real_escape_string($_POST["Name"]);
    $email = $con->real_escape_string($_POST["Email"]);
    $subject = $con->real_escape_string($_POST["Subject"]);
    $message = $con->real_escape_string($_POST["Message"]);

    // Use a prepared statement to insert the data safely
    $stmt = $con->prepare("INSERT INTO contact (Name, Email, Subject, Message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        // Display success message
        echo '<script>alert("Details have been inserted successfully!");</script>';
    } else {
        // Show the error if something goes wrong
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Close the statement
}

$con->close(); // Close the connection
?>

</body>
</html>
