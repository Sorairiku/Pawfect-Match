<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = $user_data['user_image'];
$pet_id_adopted = isset($_GET['pet_id']) ? $_GET['pet_id'] : null;

if ($pet_id_adopted != null)
{
    $pet_id_escaped = mysqli_real_escape_string($con, $pet_id_adopted);
    $query = "SELECT * FROM pets WHERE pet_id = '{$pet_id_escaped}'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $pet_name = $row['pet_name'];
        $pet_image = $row['pet_image'];
    }
    
    if(isset($_POST['yes'])){
        $update_query = "UPDATE pets SET availability = 'Adopted' WHERE pet_id = '{$pet_id_escaped}'";
        mysqli_query($con,$update_query);
        header('Location: adopt.php');
        exit();
    }
    
    if(isset($_POST['no'])){
        header('Location: adopt.php');
        exit();
    }
}

include_once "html/body.html"; 

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
<?php include_once "html/users.html"; ?>
<div class="center-content">
    <div class="pet-adoption-confirm">
        <h2>Would you like to adopt <?php echo htmlspecialchars($pet_name); ?>?</h2>
        <img src='uploads/<?php echo htmlspecialchars($pet_image); ?>' alt='<?php echo htmlspecialchars($pet_name); ?>'>
        <form method="post">
            <button type="submit" name="yes">Yes</button>
            <button type="submit" name="no">No</button>
        </form>
    </div>
</div>

</body>
</html>