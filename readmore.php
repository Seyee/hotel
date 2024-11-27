<?php
session_start();

// Check if the user is logged in successfully
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    $loginMessage = "Successfully logged in!";
    $showLoginModal = true;
    unset($_SESSION['user_logged_in']); // Unset the session variable after showing the login message
} else {
    $showLoginModal = false;
}

// Check if the user has logged out
if (isset($_GET['status']) && $_GET['status'] === 'logout_success') {
    $logoutMessage = "You have been logged out.";
    $showLogoutModal = true;
} else {
    $showLogoutModal = false;
}

// Modal content for login reminder when not logged in
if (isset($_GET['reservation']) && !isset($_SESSION['user_id'])) {
    $modalMessage = "You have to login to make reservations";
    $showReservationModal = true;
} else {
    $showReservationModal = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="about.css">
    <style>
        /* Modal styles */
        .modal {
            display: <?php echo ($showLoginModal || $showLogoutModal || $showReservationModal) ? 'block' : 'none'; ?>;
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
            cursor: pointer;
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
    <!-- Modal for Successful Login -->
    <?php if ($showLoginModal): ?>
        <div class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="window.location.href='about.php';">&times;</span>
                <p><?php echo $loginMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal for Logout -->
    <?php if ($showLogoutModal): ?>
        <div class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="window.location.href='about.php';">&times;</span>
                <p><?php echo $logoutMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal for Reservation - Login Required -->
    <?php if ($showReservationModal): ?>
        <div class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="window.location.href='about.php';">&times;</span>
                <p><?php echo $modalMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <a href="index.php"><img src="https://i.ibb.co/FmT02bH/King-s-Bed-Hotel-2500-x-1024-px-4.png" alt="King's Bed Hotel Logo"></a>
            </div>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="rooms.php">Rooms</a></li>
                <li><a href="about.php">About</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="reservation.php">Reservation</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="profile.php" class="profile-btn">Profile</a></li>
                    <li><a href="logout.php" class="logout-btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="?reservation=true">Reservation</a></li>
                    <li><a href="login.php" class="login-btn">Login</a></li>
 <!-- Reservation link when not logged in -->
                <?php endif; ?>
            </ul>
        </div>
    </nav>

<head>
    <body>
        <div class="about">
            <h1>About Us!</h1>
        </div>
        <div class="container">
            <section class="about2">
                <div class="about-image">
                    <img src="https://i.ibb.co/frCY686/Untitled-1.jpg">
                </div>
                <div class="about-content">
                    <h2>Our Beginnings</h2>
                    <p>King's Bed Hotel was established in 2010 to meet the growing demand for exceptional yet affordable lodging in downtown. Recognizing the need for a welcoming and comfortable space, we set out to create a unique experience for travelers seeking quality and convenience.<br><br>
                        In March 2011, we proudly opened our doors, committed to providing top-notch accommodations anchored in our core values: Cleanliness, Innovation, Efficiency, Courtesy, and Teamwork.<br><br>
                        Since our inception, King's Bed Hotel has continually evolved to exceed guest expectations, adapting to the changing needs of our visitors while maintaining our dedication to quality service. Join us as we continue to grow and redefine what a great stay means!</p>
                        <a href="about.php" class="read-more">Read Less</a>
                </div>
            </section>
        </div>
    </body>
</head>