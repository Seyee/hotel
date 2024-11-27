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
    <link rel="stylesheet" href="room.css">
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
                <span class="close" onclick="window.location.href='rooms.php';">&times;</span>
                <p><?php echo $loginMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal for Logout -->
    <?php if ($showLogoutModal): ?>
        <div class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="window.location.href='rooms.php';">&times;</span>
                <p><?php echo $logoutMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal for Reservation - Login Required -->
    <?php if ($showReservationModal): ?>
        <div class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="window.location.href='rooms.php';">&times;</span>
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
    <!-- ROOM CONTAINER -->
    <div class="card-container" id="rooms">
        <!-- Simple Room Card -->
        <div class="card">
            <label for="popup1">
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/12/cd/49/41/b-b-hotel-bourges-1.jpg?w=700&h=-1&s=1">
                <div class="card-content">
                    <h3>Simple Room <i class='bx bxs-group'></i> 1-2 </h3>
                    <p><br>Click for more details.</p>
                </div>
            </label>
        </div>

        <!-- Pop-up Modal for Simple Room -->
        <input type="checkbox" id="popup1" class="pop-up-input">
        <div class="pop-up" id="modal1">
            <div class="pop-up-content">
                <label for="popup1" class="close-btn">&times;</label>
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/12/cd/49/41/b-b-hotel-bourges-1.jpg?w=700&h=-1&s=1" alt="Simple Room">
                <h3>Simple Room <i class='bx bxs-group'></i> 1-2 ₱1,299/Day</h3>
                <p>A basic and affordable room for budget travelers.</p>
            </div>
        </div>

        <!-- Comfort Room Card -->
        <div class="card">
            <label for="popup2">
                <img src="https://cache.marriott.com/content/dam/marriott-renditions/CHIOX/chiox-guestroom-0017-hor-clsc.jpg?output-quality=70&interpolation=progressive-bilinear&downsize=1140px:*">
                <div class="card-content">
                    <h3>Comfort Room <i class='bx bxs-group'></i> 1-2</h3>
                    <p><br>Click for more details.</p>
                </div>
            </label>
        </div>

        <!-- Pop-up Modal for Comfort Room -->
        <input type="checkbox" id="popup2" class="pop-up-input">
        <div class="pop-up" id="modal2">
            <div class="pop-up-content">
                <label for="popup2" class="close-btn">&times;</label>
                <img src="https://cache.marriott.com/content/dam/marriott-renditions/CHIOX/chiox-guestroom-0017-hor-clsc.jpg?output-quality=70&interpolation=progressive-bilinear&downsize=1140px:*" alt="Comfort Room">
                <h3>Comfort Room <i class='bx bxs-group'></i> 1-2 ₱2,299/Day</h3>
                <p>A cozy, mid-range room with extra comfort.</p>
            </div>
        </div>

        <!-- Elegant Room Card -->
        <div class="card">
            <label for="popup3">
                <img src="https://cache.marriott.com/marriottassets/marriott/CHIOX/chiox-guestroom-0018-hor-clsc.jpg?interpolation=progressive-bilinear&">
                <div class="card-content">
                    <h3>Elegant Room <i class='bx bxs-group'></i> 1-4 </h3>
                    <p><br>Click for more details.</p>
                </div>
            </label>
        </div>

        <!-- Pop-up Modal for Elegant Room -->
        <input type="checkbox" id="popup3" class="pop-up-input">
        <div class="pop-up" id="modal3">
            <div class="pop-up-content">
                <label for="popup3" class="close-btn">&times;</label>
                <img src="https://cache.marriott.com/marriottassets/marriott/CHIOX/chiox-guestroom-0018-hor-clsc.jpg?interpolation=progressive-bilinear&" alt="Elegant Room">
                <h3>Elegant Room <i class='bx bxs-group'></i> 1-4 ₱3,599/Day</h3>
                <p>A spacious and elegant room designed for 1-4 guests, featuring comfortable furnishings and family-friendly amenities.</p>
            </div>
        </div>

        <!-- Luxury Room Card -->
        <div class="card">
            <label for="popup4">
                <img src="https://photos.mandarinoriental.com/is/image/MandarinOriental/dubai-suite-skyline-view-bedroom">
                <div class="card-content">
                    <h3>Luxury Room <i class='bx bxs-group'></i> 1-2 </h3>
                    <p><br>Click for more details.</p>
                </div>
            </label>
        </div>

        <!-- Pop-up Modal for Luxury Room -->
        <input type="checkbox" id="popup4" class="pop-up-input">
        <div class="pop-up" id="modal4">
            <div class="pop-up-content">
                <label for="popup4" class="close-btn">&times;</label>
                <img src="https://photos.mandarinoriental.com/is/image/MandarinOriental/dubai-suite-skyline-view-bedroom" alt="Luxury Room">
                <h3>Luxury Room <i class='bx bxs-group'></i> 1-2 ₱5,599/Day</h3>
                <p>A luxurious suite with a private balcony, offering beautiful views and spacious comfort for an unforgettable stay.</p>
            </div>
        </div>

        <!-- Royal Room Card -->
        <div class="card">
            <label for="popup5">
                <img src="https://photos.mandarinoriental.com/is/image/MandarinOriental/dubai-room-deluxe-skyline-view?wid=1600&fmt=jpeg&op_usm=1,1,5,0&resMode=sharp2&fit=crop&qlt=75,0">
                <div class="card-content">
                    <h3>Royal Room <i class='bx bxs-group'></i> 1-4 </h3>
                    <p><br>Click for more details.</p>
                </div>
            </label>
        </div>

        <!-- Pop-up Modal for Royal Room -->
        <input type="checkbox" id="popup5" class="pop-up-input">
        <div class="pop-up" id="modal5">
            <div class="pop-up-content">
                <label for="popup5" class="close-btn">&times;</label>
                <img src="https://photos.mandarinoriental.com/is/image/MandarinOriental/dubai-room-deluxe-skyline-view?wid=1600&fmt=jpeg&op_usm=1,1,5,0&resMode=sharp2&fit=crop&qlt=75,0" alt="Royal Room">
                <h3>Royal Room <i class='bx bxs-group'></i> 1-4 ₱7,599/Day</h3>
                <p>A luxurious room with two beds, accommodating up to 4 guests, featuring a private balcony for enjoying the views in style.</p>
            </div>
        </div>

        <!--King's Suite-->
        <div class="card">
            <label for="popup7">
                <img src="https://photos.mandarinoriental.com/is/image/MandarinOriental/dubai-two-bedroom-premier-seaview-suite-living-room?wid=1600&fmt=jpeg&op_usm=1,1,5,0&resMode=sharp2&fit=crop&qlt=75,0">
                <div class="card-content">
                    <h3>King's Suite <i class='bx bxs-group'></i>1-3 </h3>
                    <p><br>Click for more details.</p>
                </div>
            </label>
        </div>

                <!-- Pop-up Modal for King's Suite -->
        <input type="checkbox" id="popup7" class="pop-up-input">
            <div class="pop-up" id="modal7">
                <div class="pop-up-content">
                <label for="popup7" class="close-btn">&times;</label>
                <img src="https://photos.mandarinoriental.com/is/image/MandarinOriental/dubai-two-bedroom-premier-seaview-suite-living-room?wid=1600&fmt=jpeg&op_usm=1,1,5,0&resMode=sharp2&fit=crop&qlt=75,0" alt="King's Suite">
                <h3>King's Suite <i class='bx bxs-group'></i> 1-3 ₱10,999/Day</h3>
                <p>Designed for families, this spacious room can host up to 6 guests with plenty of amenities to keep everyone happy.</p>
            </div>
    </div>
</body>

</html>
