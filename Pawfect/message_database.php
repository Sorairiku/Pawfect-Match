<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = $user_data['user_image'];

$allowed_user_id = "733270376";

if($user_data['user_id'] != $allowed_user_id) {
    // Redirect the user to the index.php page
    header("Location: index.php");
    exit();
}

$query = "SELECT msg_id, incoming_msg_id, outgoing_msg_id, msg FROM messages";
$result = mysqli_query($con, $query);

$data = array();

while($row = mysqli_fetch_assoc($result)){
    $data[] =  $row;
}

include_once "html/body.html";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/database.css">
    <link rel="stylesheet" href="css/message.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Open+Sans+Hebrew:wght@400;600;700&display=swap">    <title>Pawfect Match</title>

</head>
<body>
<?php include_once "html/users.html"; ?>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <!-- Display Table Headers -->
                    <?php 
                        $header_keys = array_keys($data[0]);
                        foreach($header_keys as $key) {
                            echo "<th>$key</th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <!-- Display Table Data -->
                <?php 
                    foreach($data as $row) {
                        echo "<tr>";
                        foreach($row as $key => $value) {
                            echo "<td>$value</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>