<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    $image = $user_data['user_image'];
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
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;

        }
        .profile{
			width: 50%;
			height: 40%;
			background: transparent;
			border-radius: 20px;
			margin: 80px;
			padding: 20px;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.image img{
			width: 300px;
			height: 300px;
			border-radius: 50%;
			border: 4px solid #7A6BBC;
			box-shadow: 0px 0px 10px #7A6BBC;
			margin-right: 30px;
		}
		.name{
            display: flex;
			flex-direction: column;
			margin-top: -100px;
			
        }
		.e-icon{
    		margin-top: 180px;
    		transform: translateX(-40px);
		}
		.e-icon i{
			font-size: 30px;
			color: #000;
		}
    </style>
</head>

<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>

<div class="profile">
	<div class="image">
		<img src="uploads/<?php echo $image;?>" alt="">
	</div>
	<div class="name">
		<h1><?php echo $user_data['fname'] . ' ' . $user_data['lname']?></h1>
		<p>Joined <?php echo date('F Y', strtotime($user_data['date'])); ?></p>
		<span><i class="fas fa-location-dot"></i>   <?php echo $user_data['city']. ', ' . $user_data['address']?></span>
		<p class="num"><i class="fas fa-phone"></i>   <?php echo $user_data['phone']?></p>
	</div>
	<div class="edit">
		<a href="information.php">
			<div class="e-icon"><i class="fas fa-user-pen"></i></div>
		</a>
	</div>
</div>
<script src="https://kit.fontawesome.com/b395562c04.js" crossorigin="anonymous"></script>

</body>
</html>