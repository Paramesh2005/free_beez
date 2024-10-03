<?php
// Connect to MySQL database
$servername = "localhost"; // Change this to your MySQL server
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "freebeez"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from the users table
$sql = "SELECT * FROM lanceregister";
$result = $conn->query($sql);

// Close MySQL connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancers registered</title>
    <!-- Your CSS styles here -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Users enrolled</h2>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Skill</th>
            <th>Description</th>
        </tr>
        <?php
        // Display fetched data in the table
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["jobtitle"] . "</td>";
                echo "<td>" . $row["message"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No users found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
