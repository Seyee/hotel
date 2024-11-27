<?php
$servername = "localhost"; // usually localhost
$username = "root"; // your database username
$password = "wawapogi@202X"; // your database password
$dbname = "schoolsystem"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO concerns (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

if ($conn->query($sql) === TRUE) {
    // Redirect to index.html after successful signup
    header("Location: concern.html");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$stmt->close();
$conn->close();
?>
