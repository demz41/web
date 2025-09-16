<?php
// Start session
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie if it exists
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}

// Destroy the session
session_destroy();

// Redirect to login or desired page
header('Location: [LOGIN_PAGE_PATH]?action=logout'); // e.g. 'login.php?action=logout'
?>
