<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    $image = $user_data['user_image'];
    
    if($user_data['user_id'] !== '733270376') {
        header('Location: index.php'); // Replace with your desired redirect page.
        exit; 
    }
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
.center-text {
    text-align: center;
    margin-top: 100px; /* Adjust the margin as needed */
}

.big-text {
    font-size: 60px;
    font-weight: bold;
    /* Add any other styles you want for the big text */
}

.link-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px; /* Adjust the margin as needed */
}

.link-button1,
.link-button2 {
    display: inline-block;
    vertical-align: top; /* add this line to align the buttons to the top */
    margin: 50px;
    padding: 20px;
    background-color: white;
    color: black;
    text-decoration: none;
    border-radius: 30px;
    position: relative;
    border: 2px solid #230B41; /* Add black border */
    transition: all 0.3s; /* Add transition for smooth effect */
    width: 350px; /* Adjust as needed */
    height: 200px;
}

.link-button1:hover,
.link-button2:hover{
    background-color: lavender;
    transform: scale(1.1); /* Increase size on hover */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add shadow effect on hover */
}

.link-button1 h1,
.link-button2 h1 {
    margin: 0;
    text-align: left;
    font-size: 30px;
}

.link-button1 span,
.link-button2 span {
    display: block;
    text-align: left;
    margin-top: 5px;
    font-size: 15px;
}
.overlap-image1,
.overlap-image2 {
    font-size: 80px;
    position: absolute;
    top: 100px;
    right: 70px; 
    z-index: 1;
}


.arrow {
    position: absolute;
    bottom: 30px; /* Adjust distance from bottom */
    left: 20px; /* Adjust distance from left */
}  
</style>
</head>

<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>
    <div class="center-text">
        <div class="big-text">Pick which Database</div><div>
            <a href="user_database.php" class="link-button1">
                <h1>User Database</h1>
                <div class="overlap-image1"><i class="fas fa-database"></i></div>
                <img src="pictures/arrow.png" class="arrow">
            </a>
            <a href="pets_database.php" class="link-button2">
                <h1>Pet Database</h1>
                <div class="overlap-image2"><i class="fas fa-database"></i></div>
                <img src="pictures/arrow.png" class="arrow">
            </a>
            <a href="message_database.php" class="link-button2">
                <h1>Messages Database</h1>
                <div class="overlap-image2"><i class="fas fa-database"></i></div>
                <img src="pictures/arrow.png" class="arrow">
            </a>
            <a href="adopt_database.php" class="link-button2">
                <h1>Adoption Database</h1>
                <div class="overlap-image2"><i class="fas fa-database"></i></div>
                <img src="pictures/arrow.png" class="arrow">
            </a>
        </div>
    </div>
</body>
</html>