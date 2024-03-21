<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    $image = !empty($user_data['user_image']) ? $user_data['user_image'] : "blank.png";

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Open+Sans+Hebrew:wght@400;600;700&display=swap">
    <title>Pawfect Match</title>
    <style>
        
        body {
            font-family: monospace;
            background-color: #fff;
            margin: 0;
            padding: 0;

        }
        .about-text {
            width: 800px;
            text-align: left;
            padding: 10px;
            margin: 100px;
        }
        .text{
            margin-bottom: 30px;
        }
        .text h1{
            font-size: 40px;
            font-weight: bold;
        }
        .text p{
            font-size: 20px;
            font-weight: 300;
            margin-top: 10px;
        }
        

    </style>
</head>
<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>
<?php include_once "html/slider.html"; ?>

<div class="about-text">
    <div class="text">
        <h1>Pawfect Match</h1>
        <p>
            “Pawfect Match” is an innovative app that connects loving pet owners with
            compassionate individuals and families, creating lifelong bonds. It is a pet adoption
            system made to make pet adoption easier and more efficient for users. With this app, you
            can browse through extensive database of adorable pets looking for their forever homes
            with detailed profiles, heartwarming photos, and personalized matchmaking algorithms.
        </p>
    </div>
    <div class="text">
        <h1>Objective</h1>
        <p>
            The objective of the Pawfect Match project is to develop a comprehensive mobile
            application that facilitates the pet adoption process, connecting pet owners with potential
            adopters in an efficient, user-friendly, and transparent manner. The app aims to promote
            responsible pet ownership, reduce the number of homeless pets, and create lifelong bonds
            between pets and their adoptive families.
        </p>
    </div>
</div>


</body>
</html>