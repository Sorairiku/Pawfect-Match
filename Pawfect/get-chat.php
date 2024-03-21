<?php 
    session_start();

    if(isset($_SESSION['user_id'])){

        include_once "connection.php";
        include_once "functions.php";
        
        $outgoing_id = $_SESSION['user_id'];
        $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
        
        $output = "";

        $sql = "SELECT * FROM messages LEFT JOIN users ON users.user_id = messages.outgoing_msg_id
        WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
        OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                    <img src="uploads/'.$row['user_image'].'" alt="">
                                <div class="detailss">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }
        
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>