<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "freebeez";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO usersreg (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
        header("Location: login.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
