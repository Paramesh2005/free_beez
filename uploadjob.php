<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "freebeez";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert data into the database
$stmt = $conn->prepare("INSERT INTO jobs (job_title, company_name, job_description, salary, job_type, linkedin, whatsapp) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Bind parameters to the prepared statement
$stmt->bind_param("sssdsss", $job_title, $company_name, $job_description, $salary, $job_type, $linkedin, $whatsapp);

// Get form data
$job_title = $_POST['job_title'];
$company_name = $_POST['company_name'];
$job_description = $_POST['job_description'];
$salary = $_POST['salary'];
$job_type = $_POST['job_type'];
$linkedin = $_POST['linkedin'];
$whatsapp = $_POST['whatsapp'];

// Execute the prepared statement
if ($stmt->execute()) {
  header("Location: takejob.php");
} else {
  echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
