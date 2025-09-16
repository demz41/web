<?php
session_start();
include './dbconnection.php';

// Auto logout after 1 minute (60s)
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
    session_destroy();
    header("Location: ./index.php");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

if (!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '') {
    header("Location: ./index.php");
    exit();
}

$sql = "SELECT * FROM tbl_users WHERE ID = '" . $_SESSION['admin'] . "'";
$query = $conn->query($sql);
$user = $query->fetch_assoc();
?>
