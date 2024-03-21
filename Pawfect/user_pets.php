<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = $user_data['user_image'];
$fname = $user_data['fname'];
$user_id = $user_data['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/message.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <title>Pawfect Match</title>
    <style>
        
        body {
            font-family: monospace;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
            .my-pets {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    width: 100%;
}
.my-pets a{
    margin-top: 10px;
    text-decoration: none;
}
.details {
    background: #E6E6FA;
    border-radius: 10px;
    width: 300px;
    padding: 10px;
    margin: 10px 0 10px 0;
    cursor: pointer;
}
.details img{
    max-height: 200px;
    height: auto;
    width: 100%;
    border-radius: 10px;
}
.details h2{
    color: #000;
    font-size: 25px;
    margin: 10px 0 0 5px;
    font-weight: bold;
}
.details p{
    color: #000;
    font-size: 20px;
    margin: 0 0 0 5px;
}
.details span{
    color: #8B8B8B;
    font-size: 18px;
    font-weight: 300;
    margin: 0 0 10px 5px;
}
.details span i{
    color: #7A6BBC;
    font-size: 20px;
}

        
    </style>
</head>
<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>

<div class="title">
    <h1>My Pets</h1>
</div>

<div class="my-pets">
<?php
$query = "SELECT pet_id, pet_name, pet_owner, pet_type, pet_breed, pet_gender, pet_age, pet_image, pet_location, pet_address, pet_description, availability FROM pets WHERE pet_owner_id = '$user_id'";


$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0) {
    // Loop through each row in the result set
    while($row = mysqli_fetch_assoc($result)) {
        // Access pet information from the current row
        $pet_id = $row['pet_id'];
        $pet_name = $row['pet_name'];
        $pet_location = $row['pet_location'];
        $pet_address = $row['pet_address'];
        $pet_owner = $row['pet_owner'];
        $pet_type = $row['pet_type'];
        $pet_breed = $row['pet_breed'];
        $pet_gender = $row['pet_gender'];
        $pet_age = $row['pet_age'];
        $pet_image = $row['pet_image'];
        $pet_description = $row['pet_description'];
        $availability = $row['availability'];
        ?>
        

        <a href='pet_profile.php?pet_id=<?php echo $pet_id;?>?availability=<?php echo $availability;?>'>
            <div class="details">
                <img src='uploads/<?php echo $pet_image;?>' alt='<?php echo $pet_name;?>'>
                <h2><?php echo $pet_name;?></h2>
                <p><?php echo $pet_gender;?>, <?php echo $pet_age;?> years</p>
                <span><i class="fas fa-location-dot"></i>  <?php echo $pet_location.' '.$pet_address?></span>
                <p><?php echo $availability;?></p>
            </div>
        </a>

        
        <?php
    }
} else {
    // If no pets are found in the database, display a message
    echo "No pets found.";
}
?>
</div>

<script src="https://kit.fontawesome.com/b395562c04.js" crossorigin="anonymous"></script>

</body>
</html>