<?php
// Start session management
session_start();

// Include database connection
include '[PATH_TO_DB_CONNECTION_FILE]'; // e.g. 'conn.php'

// Check if form was submitted
if (isset($_POST['[FORM_SUBMIT_NAME]'])) { // e.g. 'login'

    // Get input values from POST (keeping your original variable names)
    $username = $_POST['[USERNAME_FIELD_NAME]']; // e.g. 'username'
    $password = $_POST['[PASSWORD_FIELD_NAME]']; // e.g. 'password'

    // Prepare SQL query to find the user with active status
    $sql = "SELECT * FROM [TABLE_NAME] WHERE [USERNAME_COLUMN] = '$username' AND [STATUS_COLUMN] = 1";

    // Execute the query (using your database connection variable)
    $result = $conn->query($sql);

    // Check if any user matched
    if ($result->num_rows > 0) {

        // Get user data
        $row = $result->fetch_assoc();

        // Verify password (replace with secure verification in real app!)
        if ($password == $row['[PASSWORD_COLUMN]']) {

            // Store user ID in session for authentication
            $_SESSION['[SESSION_USER_ID]'] = $row['[USER_ID_COLUMN]'];

            // Redirect user based on their role
            if ($row['[ROLE_COLUMN]'] == '[ROLE_1]') {
                header('location: [PATH_FOR_ROLE_1]');
            }
            elseif ($row['[ROLE_COLUMN]'] == '[ROLE_2]') {
                header('location: [PATH_FOR_ROLE_2]');
            }
            else {
                header('location: [PATH_FOR_OTHER_ROLES]');
            }

            // Log successful login
            $host = $_SERVER['HTTP_HOST'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $status = 1;

            $logSql = "INSERT INTO [LOG_TABLE_NAME] ([USER_ID_COLUMN], [USERNAME_COLUMN], [USER_IP_COLUMN], [STATUS_COLUMN]) 
                       VALUES ('".$_SESSION['[SESSION_USER_ID]']."', '$username', '$host', '$status')";
            $conn->query($logSql);

        } else {
            // Password incorrect
            $_SESSION['error'] = '[ERROR_MESSAGE_PASSWORD_INCORRECT]';
            header('location: [ERROR_PAGE_PATH]');
        }

    } else {
        // Username not found or inactive
        $_SESSION['error'] = '[ERROR_MESSAGE_USER_NOT_FOUND]';
        header('location: [LOGIN_PAGE_PATH]');

        // Log failed login attempt
        $host = $_SERVER['HTTP_HOST'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $status = 0;

        $logSql = "INSERT INTO [LOG_TABLE_NAME] ([USER_ID_COLUMN], [USERNAME_COLUMN], [USER_IP_COLUMN], [STATUS_COLUMN]) 
                   VALUES ('UNKNOWN', '$username', '$host', '$status')";
        $conn->query($logSql);
    }

} else {
    // Form not submitted properly
    $_SESSION['error'] = '[ERROR_MESSAGE_FORM_NOT_SUBMITTED]';
    header('location: [LOGIN_PAGE_PATH]');
}
?>