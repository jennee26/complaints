<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "usernini";

// Get form data
$ID_Number = $_POST['ID_Number'];
$LLCCemail = $_POST['LLCCemail'];
$Nametag = $_POST['Nametag'];
$PlainPassword = $_POST['Password'];  // Store the plain password
$Password = password_hash($PlainPassword, PASSWORD_DEFAULT); // Hash the password for security

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO signup (ID_Number, LLCCemail, Nametag, Password) VALUES (?, ?, ?, ?)");

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("isss", $ID_Number, $LLCCemail, $Nametag, $Password);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Sign up successful...";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
