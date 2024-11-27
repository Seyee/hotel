<?php
session_start(); // Start the session
// Database connection
$servername = "localhost";
$username = "root";
$password = "wawapogi@202X";
$dbname = "schoolsystem";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = ""; // Initialize an error message variable
$show_modal = false; // Flag to show the modal

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the account exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variable for the logged-in user
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_logged_in'] = true;  // Add this line
        
            // Redirect with success message
            header("Location: index.php?login_success=true");
            exit;
        } else {
            $error_message = "Incorrect password!";
            $show_modal = true;
        }
    } else {
        $error_message = "Account does not exist!";
        $show_modal = true;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="signup.css"> <!-- Ensure this matches your styling -->
    <style>
        /* Modal styles */
        .modal {
            display: <?php echo $show_modal ? 'block' : 'none'; ?>;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <section class="container"> 
        <header>Login</header>
        <form action="login.php" method="POST" class="form">
            <div class="input-box">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter Email Address" required /> 
            </div>

            <div class="input-box">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password" required />
            </div>

            <button type="submit">Login</button>

            <p style="text-align: center; margin-top: 20px;">
                Don't have an account? <a href="signup.php">Sign up here</a>
            </p>
        </form>
    </section>

    <!-- Modal for displaying errors -->
    <div class="modal">
        <div class="modal-content">
            <span class="close" onclick="this.parentElement.parentElement.style.display='none';">&times;</span>
            <p><?php echo htmlspecialchars($error_message); ?></p>
        </div>
    </div>
</body>
</html>
