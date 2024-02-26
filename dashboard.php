<?php
// Start the session
session_start();

// Set session timeout to 10 seconds
$timeout = 10;

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Check if the last activity time is not set
if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();
} else {
    // Check and update last activity time
    $elapsedTime = time() - $_SESSION['last_activity'];
    
    if ($elapsedTime > $timeout) {
        // Session has expired due to inactivity
        session_unset();
        session_destroy();
        header("Location: login.php"); // Redirect to login page or another page
        exit();
    }
    
    // Regenerate session ID to prevent session fixation
    session_regenerate_id(true);
}

// Update last activity time
$_SESSION['last_activity'] = time();

$username = $_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="session.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <h2>Welcome <?php echo $username; ?>! You are now logged in.</h2>
    <a href="logout.php">
        <button class="Bttn">
            <div class="sign">
                <svg viewBox="0 0 512 512">
                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                </svg>
            </div>
            <div class="text">Logout</div>
        </button>
    </a>
    <script>
        // Set session timeout to 10 seconds (in milliseconds)
        var timeout = 10000; 

        // Function to perform logout
        function performLogout() {
            // Redirect to the logout page or perform necessary logout actions
            window.location.href = 'logout.php';
        }

        // Function to reset the timer on user activity
        function resetTimer() {
            clearTimeout(timer);
            timer = setTimeout(performLogout, timeout);
        }

        // Set initial timer on page load
        var timer = setTimeout(performLogout, timeout);

        // Attach event handlers to reset the timer on user activity
        $(document).on('mousemove keydown', function() {
            resetTimer();
        });
    </script>
</body>
</html>
