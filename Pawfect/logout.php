<?php
session_start();

if (isset($_SESSION['user_id'])) {
    include("connection.php");

	// Update status to 'Offline'
    $update_query = "UPDATE users SET status = 'Offline' WHERE user_id = '{$_SESSION['user_id']}'";
    mysqli_query($con,$update_query);

    unset($_SESSION['user_id']);
}

header("Location: login.php");
die;
?>