<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "freebeez";

    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO lanceregister (firstname, lastname, email, phone, jobtitle, message) VALUES (:firstname, :lastname, :email, :phone, :jobtitle, :message)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':jobtitle', $jobtitle);
    $stmt->bindParam(':message', $message);

    // Get form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $jobtitle = $_POST['jobtitle'];
    $message = $_POST['message'];

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>alert("Thank you! Your message has been stored.");</script>';
        header("Location: freelancers.html");
    } else {
        echo '<script>alert("Sorry, there was an error storing your message. Please try again later.");</script>';
    }

    // Close connection
    $conn = null;
}
?>
