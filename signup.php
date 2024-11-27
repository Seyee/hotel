<?php
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
$password_error = ""; // Initialize a password error variable
$show_modal = false; // Flag to show the modal

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone_number = $_POST['phone_number'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $password_error = "Passwords do not match!";
        $show_modal = true;
    }
    
    // Proceed if there are no password errors
    if (empty($password_error)) {
        // Check if email already exists
        $email_check_sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($email_check_sql);

        if ($result->num_rows > 0) {
            $error_message = "Email is already used!";
            $show_modal = true;
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // SQL to insert data into users table
            $sql = "INSERT INTO users (full_name, email, phone_number, birth_date, gender, password)
            VALUES ('$full_name', '$email', '$phone_number', '$birth_date', '$gender', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['user_id'] = $row['id']; // Assuming 'id' is the user's ID column in your database
                $_SESSION['email'] = $row['email']; // Optional: Store other details if needed
                // Redirect to dashboard.html after successful signup
                header("Location: index.php?status=signup_success");
                exit;
            } else {
                $error_message = "Error: " . $conn->error;
                $show_modal = true;
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
    <style>
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
        <header>Sign up</header>
        <form action="signup.php" method="POST" class="form">
            <div class="input-box">
                <label>Full Name</label>
                <input type="text" name="full_name" placeholder="Enter full name" required />
            </div>

            <div class="input-box address">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter Email Address" required /> 
            </div>

            <div class="column">
                <div class="input-box">
                    <label>Phone Number</label>
                    <input type="number" name="phone_number" placeholder="Enter Phone Number" min="11" max="11"  required /> 
                </div>

                <div class="input-box">
                    <label>Birth Date</label>
                    <input type="date" name="birth_date" placeholder="Enter Birth date" required /> 
                </div>
            </div>

            <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="gender" value="Male" checked />
                        <label for="check-male">Male</label>
                    </div>

                    <div class="gender">
                        <input type="radio" id="check-female" name="gender" value="Female" />
                        <label for="check-female">Female</label>
                    </div>

                    <div class="gender">
                        <input type="radio" id="check-other" name="gender" value="Prefer not to say" />
                        <label for="check-other">Prefer not to say</label>
                    </div>
                </div>
            </div>

            <div class="input-box">
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" required />
            </div>

            <div class="input-box">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required />
            </div>

            <button type="submit">Submit</button>

            <p style="text-align: center; margin-top: 20px;">
                Already have an account? <a href="login.html">Login here</a>
            </p>
        </form>
    </section>

    <!-- Modal for displaying errors -->
    <div class="modal">
        <div class="modal-content">
            <span class="close" onclick="this.parentElement.parentElement.style.display='none';">&times;</span>
            <p><?php echo htmlspecialchars($password_error . ' ' . $error_message); ?></p>
        </div>
    </div>
</body>
</html>
