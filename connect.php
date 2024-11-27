<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "wawapogi@202X";
$dbname = "schoolsystem"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture the form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$room_type = $_POST['room_type'];
$checkin_date = $_POST['checkin_date'];
$checkout_date = $_POST['checkout_date'];
$checkin_time = $_POST['checkin_time'];
$checkout_time = $_POST['checkout_time'];

// SQL query to insert data into the database
$sql = "INSERT INTO reservations (name, email, phone, address, room_type, checkin_date, checkout_date, checkin_time, checkout_time)
        VALUES ('$name', '$email', '$phone', '$address', '$room_type', '$checkin_date', '$checkout_date', '$checkin_time', '$checkout_time')";

if ($conn->query($sql) === TRUE) {
    // Redirect to ind ex.html after successful signup
    header("Location: reservation.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
