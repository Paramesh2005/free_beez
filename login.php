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
    $password = $_POST["password"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("SELECT * FROM usersreg WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Authentication successful
        header("Location: index.html");
    } else {
        // Authentication failed
        echo "Invalid username or password";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
