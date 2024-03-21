<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    $image = $user_data['user_image'];
?>
<?php include_once "html/header.html"; ?>
<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>

<div class="homepage-center-text">
        <div class="big-text">
			<div class="text">
				<h1>Pet adoption made easy<br>with Pawfect Match</h1>
				<span>WHERE EVERY PET FINDS ITS<br>PURR-FECT HOME. ADOPT NOW!</span>
				<a href="contact.php">Contact us</a>
			</div>
			<img src="pictures/dog_cat.png">
		</div>
		<div>
            <a href="adopt.php" class="link-button">
                <h1>Adopt a pet</h1>
                <span>I’m here to look for a pet <br>to adopt!</span>
                <img src="pictures/adopt.png" alt="Image" class="overlap-image">
                <img src="pictures/arrow.png" class="arrow">
            </a>
            <a href="pet_info.php" class="link-button">
                <h1>Pet for Adoption</h1>
                <span>I’m here to find my pet a <br>new home.</span>
                <img src="pictures/pet.png" alt="Image" class="overlap-image">
                <img src="pictures/arrow.png" class="arrow">
            </a>
        </div>
    </div>

</body>
</html>