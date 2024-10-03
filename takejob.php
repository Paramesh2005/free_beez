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

// Prepare SQL statement to select data from the database
$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Listing</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .accepted-button {
            background-color: #4CAF50; /* Green background for accepted jobs */
            color: white; /* White text color for accepted jobs */
        }
        .whatsapp-form {
            display: none;
            margin-top: 20px;
            text-align: center;
        }
        .whatsapp-input {
            padding: 8px;
            width: 100%;
            margin-bottom: 10px;
        }
        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>Jobs Listing</h2>

<table id="jobsTable">
    <tr>
        <th>ID</th>
        <th>Job Title</th>
        <th>Company Name</th>
        <th>Job Description</th>
        <th>Salary</th>
        <th>Job Type</th>
        <th>LinkedIn</th>
        <th>WhatsApp</th>
        <th>Action</th>
    </tr>
    <?php
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr id='jobRow" . $row["ID"] . "'>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["job_title"] . "</td>";
        echo "<td>" . $row["company_name"] . "</td>";
        echo "<td>" . $row["job_description"] . "</td>";
        echo "<td>" . $row["salary"] . "</td>";
        echo "<td>" . $row["job_type"] . "</td>";
        echo "<td>" . $row["linkedin"] . "</td>";
        echo "<td>" . $row["whatsapp"] . "</td>";
        echo "<td><button onclick='acceptJob(" . $row["ID"] . ")'>Accept Job</button></td>";
        echo "</tr>";
    }
    ?>
</table>

<div class="whatsapp-form" id="whatsappForm">
    <p>Please enter your WhatsApp number to receive further details:</p>
    <input type="text" class="whatsapp-input" id="whatsappInput" placeholder="Enter your WhatsApp number">
    <button class="submit-button" onclick="sendWhatsAppDetails()">Submit</button>
</div>

<script>
    function acceptJob(jobId) {
        var button = document.querySelector("#jobRow" + jobId + " button");
        button.classList.add("accepted-button");
        button.textContent = "Accepted";
        button.disabled = true; // Disable the button after it's been accepted
        showWhatsAppForm();
    }

    function showWhatsAppForm() {
        var whatsappForm = document.getElementById("whatsappForm");
        whatsappForm.style.display = "block";
    }

    function sendWhatsAppDetails() {
        var whatsappNumber = document.getElementById("whatsappInput").value;
        var jobId = document.querySelector(".accepted-button").closest("tr").querySelector("td").textContent;

        // AJAX request to send job details to the WhatsApp number
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log("Job details sent to WhatsApp number: " + whatsappNumber);
                    hideWhatsAppForm();
                } else {
                    console.error("Failed to send job details. Error: " + xhr.status);
                }
            }
        };
        xhr.open("POST", "ajax.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("whatsappNumber=" + whatsappNumber + "&jobId=" + jobId);
    }

    function hideWhatsAppForm() {
        var whatsappForm = document.getElementById("whatsappForm");
        whatsappForm.style.display = "none";
    }
</script>

</body>
</html>
