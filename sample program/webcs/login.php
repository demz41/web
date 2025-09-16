<?php
// Start session management
session_start();

// Include database connection
include 'dbconnection.php'; // e.g. 'conn.php'

// Check if form was submitted
if (isset($_POST['login'])) { // e.g. 'login'

    // Get input values from POST (keeping your original variable names)
    $username = $_POST['username']; // e.g. 'username'
    $password = $_POST['password']; // e.g. 'password'

    // Prepare SQL query to find the user with active status
    $sql = "SELECT * FROM tbl_users WHERE USERNAME = '$username' AND STATUS = 1";

    // Execute the query (using your database connection variable)
    $result = $conn->query($sql);

    // Check if any user matched
    if ($result->num_rows > 0) {

        // Get user data
        $row = $result->fetch_assoc();

        // Verify password (replace with secure verification in real app!)
        if ($password == $row['PASSWORD']) {

            // Store user ID in session for authentication
            $_SESSION['admin'] = $row['ID'];

            // Redirect user based on their role
            if ($row['ROLE'] == 'admin') {
                header('location: dashboard.php');
            }
            elseif ($row['ROLE'] == 'staff') {
                header('location: staff.php');
            }
            else {
                header('location: admin.php');
            }

            // Log successful login
            $host = $_SERVER['HTTP_HOST'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $status = 1;

           // $logSql = "INSERT INTO [LOG_TABLE_NAME] ([USER_ID_COLUMN], [USERNAME_COLUMN], [USER_IP_COLUMN], [STATUS_COLUMN]) 
                       //VALUES ('".$_SESSION['[SESSION_USER_ID]']."', '$username', '$host', '$status')";
            $conn->query($logSql);

        } else {
            // Password incorrect
            $_SESSION['error'] = '[ERROR_MESSAGE_PASSWORD_INCORRECT]';
            header('location: error.php');
        }

    } else {
        // Username not found or inactive
        $_SESSION['error'] = '[ERROR_MESSAGE_USER_NOT_FOUND]';
        header('location: error.php');

        // Log failed login attempt
        $host = $_SERVER['HTTP_HOST'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $status = 0;

       // $logSql = "INSERT INTO [LOG_TABLE_NAME] ([USER_ID_COLUMN], [USERNAME_COLUMN], [USER_IP_COLUMN], [STATUS_COLUMN]) 
                   //VALUES ('UNKNOWN', '$username', '$host', '$status')";
        $conn->query($logSql);
    }

} else {
    // Form not submitted properly
    $_SESSION['error'] = 'error';
    header('location: error.php');
}
?>