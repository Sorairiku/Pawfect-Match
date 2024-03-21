<?php 
session_start();  

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$outgoing_id = $_SESSION['user_id'];

// Get search query from url (if it exists)
$query = isset($_GET['q']) ? $_GET['q'] : '';

// If there's a search query, search database
if ($query != '') {
    $sql = mysqli_query($con, "SELECT * FROM users WHERE (fname LIKE '%$query%' OR lname LIKE '%$query%') AND id != '".$user_data['id']."'");
} else {
    // If there's no search query, fetch all users except the logged-in user
    $sql = mysqli_query($con, "SELECT * FROM users WHERE id != '".$user_data['id']."'");
}

$output = '';

if(mysqli_num_rows($sql) > 0){
    while($row = mysqli_fetch_assoc($sql)){
        
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['user_id']}
        OR outgoing_msg_id = {$row['user_id']}) AND (incoming_msg_id = {$outgoing_id}
        OR outgoing_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if(mysqli_num_rows($query2) > 0){
            $results = $row2['msg'];
            if($outgoing_id == $row2['outgoing_msg_id']) 
        {
            $you = "You: ";
        }
        else
        {
            $you = "";
        }
        }else{
            $results = "No messages available";
            $you = "";
        }
        
        (strlen($results) > 28) ? $msg = substr($results, 0, 28).'...' : $msg = $results;

        // Determine which CSS class to use based on the user's status
        $statusClass = $row['status'] === "Active now" ? "online" : "offline";

        $output .= '
        <a href="chat.php?user_id='.$row['user_id'].'">
            <div class="content">
                <img src="uploads/'.$row['user_image'].'" alt="">
                <div class="detailss">
                    <div class="name">
                        <span>'. $row['fname']." ". $row['lname'].'</span>
                    </div>
                    <p>'. $you . $msg .'</p>
                </div>
            </div>
            <div class="status-dot"><i class="fas fa-circle '. $statusClass .'"></i></div>
        </a>';
    }
} else {
    $output .= "No users are available to chat";
}

echo $output;
?>