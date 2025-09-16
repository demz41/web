<?php
// Start session management
session_start();

// Include database connection
include '[PATH_TO_DB_CONNECTION_FILE]'; 

// Auto logout after [INACTIVITY_TIMEOUT] seconds (e.g. 60 for 1 minute)
if (isset($_SESSION['[SESSION_LAST_ACTIVITY]']) && (time() - $_SESSION['[SESSION_LAST_ACTIVITY]'] > [INACTIVITY_TIMEOUT])) {
    session_destroy();
    header("Location: [REDIRECT_AFTER_TIMEOUT]"); // e.g. 'index.php'
    exit();
}
$_SESSION['[SESSION_LAST_ACTIVITY]'] = time(); // Update last activity time

// Check if user is logged in
if (!isset($_SESSION['[SESSION_USER_ID]']) || trim($_SESSION['[SESSION_USER_ID]']) == '') {
    header("Location: [REDIRECT_IF_NOT_LOGGED_IN]"); // e.g. 'index.php'
    exit();
}

// Fetch user details from the database
$sql = "SELECT * FROM [USER_TABLE_NAME] WHERE [USER_ID_COLUMN] = '" . $_SESSION['[SESSION_USER_ID]'] . "'";
$query = $conn->query($sql);

// Handle query failure (optional)
if (!$query) {
    die('Database query failed: ' . $conn->error);
}

// Fetch user data
$user = $query->fetch_assoc();

 }
?>
