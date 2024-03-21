<?php
include("connection.php");

$incoming_msg_id = $_POST['incoming_id'];
$message = $_POST['message'];

$query = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
          VALUES ('$incoming_msg_id', 1, '$message')"; // Change outgoing_msg_id as needed
$result = mysqli_query($con, $query) or die('Unable to send message');
?>