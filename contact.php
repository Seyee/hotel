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
    <link rel="stylesheet" href="contact.css">
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
                <span class="close" onclick="window.location.href='contact.php';">&times;</span>
                <p><?php echo $loginMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal for Logout -->
    <?php if ($showLogoutModal): ?>
        <div class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="window.location.href='contact.php';">&times;</span>
                <p><?php echo $logoutMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal for Reservation - Login Required -->
    <?php if ($showReservationModal): ?>
        <div class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="window.location.href='contact.php';">&times;</span>
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

    <body>
        <div class="contact-section">
            <div class="contact-info">
                <div><i class='bx bxs-location-plus'></i>Main Branch Makati</div>
                <div><i class='bx bxs-contact'></i>king's.hotel.concerns@support.com</div>
                <div><i class='bx bxs-phone'></i>For inquiry call (87900-900)</div>
                <div><i class='bx bxs-time-five'></i>Mon - Fri 8:00 AM to 5:00 PM</div>
            </div>
            <div class="contact-form">
                <h2>Contact Us</h2>
                <form action="concern.php" method="POST" class="contact">
                    <input type="text" name="name" class="text" placeholder="Your name" required>
                    <input type="email" name="email" class="text-box" placeholder="Your email" required>
                    <textarea name="message" rows="5" placeholder="Your concern." required></textarea>
                    <input type="submit" name="submit" class="send-btn" value="Send to support">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
