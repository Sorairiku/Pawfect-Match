<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = $user_data['user_image'];

// Function to get user data

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="css/message.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Open+Sans+Hebrew:wght@400;600;700&display=swap">    <title>Pawfect Match</title>
    <style>
        
        body {
            font-family: monospace;
            background-color: #fff;
            margin: 0;
            padding: 0;

        }
        
    </style>
</head>

<?php include_once "html/body.html"; ?>

<?php
function get_user_data($con, $user_id) {
    $user_id = mysqli_real_escape_string($con, $user_id); 
    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0){
        $user_data = mysqli_fetch_assoc($result);
        return $user_data;
    } else {
        die('User not found.');
    }
}


$chat_user_id = mysqli_real_escape_string($con, $_GET['user_id']);
$chat_user_query = "SELECT * FROM users WHERE user_id = '$chat_user_id'";

$chat_user_result = mysqli_query($con, $chat_user_query);
$chat_user_data = mysqli_fetch_assoc($chat_user_result);
?>
<div class="wrapper">
    <div class="container-chat">
        <section class="chat-area">
            <header>
                <a href="index.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="uploads/<?php echo $chat_user_data['user_image'];?>" alt="">                
                <div class="details">
                    <div class="name">
                        <span><?php echo $chat_user_data['fname'] . ' ' . $chat_user_data['lname']; ?></span>
                    </div>
                    <p><?php echo $chat_user_data['status'];?></p>
                </div>
            </header>
                <div class="chat-box">
                    
                </div>
                <form action="#" class="typing-area">
                    <input type="text" class="outgoing_id" name="outgoing_id" value="<?php echo $_SESSION['user_id']; ?>" hidden>
                    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $chat_user_id; ?>" hidden>
                    <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                    <button type="submit"><i class="fab fa-telegram-plane"></i></button>
                </form>
            </section>
        </div>
    </div>

<script src="javascript/chat.js"></script>

</body>
</html>