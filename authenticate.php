<?php
$servername = "localhost";
$username = "usernini";
$password = "12345678";
$database = "usernini";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$nametag = $_POST['nametag'];
$password = $_POST['password'];

// Check credentials against the database
$stmt = $conn->prepare("SELECT Nametag, Password FROM signup WHERE Nametag = ?");
$stmt->bind_param("s", $nametag);
$stmt->execute();
$stmt->bind_result($dbNametag, $dbPassword);

if ($stmt->fetch() && password_verify($password, $dbPassword)) {
    // Authentication successful
    echo "success";
} else {
    // Authentication failed
    echo "failure";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
