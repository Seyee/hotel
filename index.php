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
    <link rel="stylesheet" href="style.css">
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
                <span class="close" onclick="window.location.href='index.php';">&times;</span>
                <p><?php echo $loginMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal for Logout -->
    <?php if ($showLogoutModal): ?>
        <div class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="window.location.href='index.php';">&times;</span>
                <p><?php echo $logoutMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal for Reservation - Login Required -->
    <?php if ($showReservationModal): ?>
        <div class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="window.location.href='index.php';">&times;</span>
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

    <!-- Slideshow -->
    <div class="slider">
        <div class="slide">
            <img src="https://i.ibb.co/zrkNtqL/Screenshot-2024-09-27-215940-copy.png" alt="image 1">
        </div>
        <div class="slide">
            <img src="https://i.ibb.co/7pHtm6G/final.png" alt="image 2">
        </div>
        <div class="slide">
            <img src="https://i.ibb.co/b289TSb/hallway.png" alt="image 3">
        </div>
        <div class="slide">
            <img src="https://i.ibb.co/JkH4xHc/bedroom.png" alt="image 4">
        </div>
    </div>

    <!-- Hotel Reviews Section -->
    <section class="reviews">
        <div class="reviews-header">
            <h2>Customer Reviews</h2>
        </div>
        <div class="reviews-grid">
            <div class="review-card">
                <img src="https://media.istockphoto.com/id/1364917563/photo/businessman-smiling-with-arms-crossed-on-white-background.jpg?s=612x612&w=0&k=20&c=NtM9Wbs1DBiGaiowsxJY6wNCnLf0POa65rYEwnZymrM=" alt="User 1" class="reviewer-img">
                <div class="review-content">
                    <h3>Mark Ezekiel</h3>
                    <p>"Absolutely loved my stay! The room was clean, the staff was friendly, and the location was perfect."</p>
                    <div class="rating">⭐⭐⭐⭐⭐</div>
                </div>
            </div>
            <div class="review-card">
                <img src="https://pbs.twimg.com/profile_images/1008650588697944064/2OghK9Sl_400x400.jpg" alt="User 2" class="reviewer-img">
                <div class="review-content">
                    <h3>Sayieeh</h3>
                    <p>"The view from the room was amazing, and I felt so comfortable. I will definitely come back!"</p>
                    <div class="rating">⭐⭐⭐⭐⭐</div>
                </div>
            </div>
            <div class="review-card">
                <img src="https://t4.ftcdn.net/jpg/06/12/37/95/360_F_612379539_nATPRGof8MPSNts37Rvs17xJJrwe4s3N.jpg" alt="User 3" class="reviewer-img">
                <div class="review-content">
                    <h3>Rhianne Venice</h3>
                    <p>"Fantastic service! The amenities were top-notch, and the breakfast was excellent."</p>
                    <div class="rating">⭐⭐⭐⭐⭐</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Special Offers Section -->
    <section class="special-offers">
        <div class="offers-container">
            <div class="offer">
                <h3>Weekend Getaway</h3>
                <p>Book a 2-night stay and get 30% off your weekend getaway!</p>
                <a href="reservation.php"><button class="offer-btn">Book Now</button></a>
            </div>
            <div class="offer">
                <h3>Early Bird Discount</h3>
                <p>Save 20% when you book your stay 30 days in advance!</p>
                <a href="reservation.php"><button class="offer-btn">Book Now</button></a>
            </div>
            <div class="offer">
                <h3>Family Vacation Deal</h3>
                <p>Stay for 4 nights and get the 5th</p><br>
                <a href="reservation.php"><button class="offer-btn">Book Now</button></a>
            </div>
        </div>
    </section>
