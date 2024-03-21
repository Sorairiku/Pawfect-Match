<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = $user_data['user_image'];
$user_id = $user_data['user_id'];
$pet_id = isset($_GET['pet_id']) ? $_GET['pet_id'] : header('Location: index.php');

$query = "SELECT * FROM pets WHERE pet_id = '$pet_id'";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);

    // Declare variables
    $pet_id = $row['pet_id'];
    $pet_name = $row['pet_name'];
    $pet_location = $row['pet_location'];
    $pet_owner = $row['pet_owner'];
    $pet_owner_image = $row['pet_owner_image'];
    $pet_owner_id = $row['pet_owner_id'];
    $pet_type = $row['pet_type'];
    $pet_breed = $row['pet_breed'];
    $pet_gender = $row['pet_gender'];
    $pet_age = $row['pet_age'];
    $pet_image = $row['pet_image'];
    $pet_location = $row['pet_location'];
    $pet_address = $row['pet_address'];
    $pet_description = $row['pet_description'];
    $availability = $row['availability'];
    $reservation = $row['reservation'];

    if(isset($_GET['unadopt'])){
      $query_update_availability = "UPDATE pets SET availability = 'Available' WHERE pet_id= ?";
      if ($stmt = $con->prepare($query_update_availability)) {
            $stmt->bind_param("i", $pet_id);
            $stmt->execute();
      }
  
      // Redirect to the same page to see the updated data.
      header('Location: pet_profile.php?pet_id='.$pet_id);
      exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link rel="stylesheet" href="css/info.css">
  <link rel="stylesheet" href="css/pet_profile.css">
  <link rel="stylesheet" href="css/message.css">
  <title>Pawfect Match</title>

</head>

<body>
  
  <?php include_once "html/body.html"; ?>
  <?php include_once "html/users.html"; ?>

<div class="center-content">
  <div class="left">
    <div class="pet-profile">
      <div class="pet-name">
        <img src='uploads/<?php echo htmlspecialchars($pet_image);?>'>
        <h2><?php echo htmlspecialchars($pet_name);?></h2>
        <p><i class="fas fa-location-dot"></i>  <?php echo htmlspecialchars($pet_location);?></p>
        <span><?php echo htmlspecialchars($pet_description);?></span>
        <div class="profile-box">
          <div class="box">
            <h3>Gender</h3>
            <p><?php echo htmlspecialchars($pet_gender);?></p>
          </div>
          <div class="box">
            <h3>Age</h3> 
            <p><?php echo htmlspecialchars($pet_age);?> years</p>
          </div>
          <div class="box">
            <h3>Breed</h3>
            <p><?php echo htmlspecialchars($pet_breed);?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="edit">
    <a href="update_pet.php?pet_id=<?php echo htmlspecialchars($pet_id);?>" class="button">
      <p>Edit Pet Profile</p>
    </a>
    </div>
  </div>

  <div class="right">
    <div class="user">
      <img src='uploads/<?php echo htmlspecialchars($pet_owner_image);?>'>
      <div class="info">
        <h2><?php echo htmlspecialchars($pet_owner);?></h2>
        <p>Pet Owner</p>
      </div>
      <div class="disc">
        <p>
          Are you looking for a new furry friend?
          Search resident pets near you and discover 
          their adoption details.
        </p>
        <div class="pet-disc">
          <h3>Breed: </h3>
          <span><?php echo htmlspecialchars($pet_breed);?></span>
        </div>
        <div class="pet-disc">
          <h3>Description: </h3>
          <span><?php echo htmlspecialchars($pet_description);?></span>
        </div>
        <div class="pet-disc-a">
          <h3>Pet Availability: </h3>
          <?php
              if ($availability == 'Available') {
                  echo "<div class='a'><i class='fas fa-circle available'></i> <span>Available for adoption</span></div>";
              } 
              else if ($availability == 'Adopted') {
                  echo "<div class='a'><i class='fas fa-circle adopted'></i> <span>Not available for adoption</span></div>";
              } 
              else if ($availability == 'Reserved'){
                  echo "<div class='a'><i class='fas fa-circle reserved'></i> <span>Currently reserved</span></div>";
              }
          ?>
        </div>
        <a href="reserve.php?pet_id=<?php echo htmlspecialchars($pet_id);?>">
          <div class="reservation">
            <p>Check Reservation</p>
          </div>
        </a>
        <a href=<?php echo '"pet_profile.php?pet_id=' . htmlspecialchars($pet_id) . '&unadopt=true"' ?> 
          <?php if($availability != 'Adopted') echo 'style="display:none;"';?> >
          <div class="adoption">
              <p>Put Pet For Adoption</p>
          </div>
        </a>
    <div class="similar-pets">
      <div class="similar"><h2>My Other Pets...</h2></div>
      
      <?php
        $pet_id_escaped = mysqli_real_escape_string($con, $pet_id);
        $user_id_escaped = mysqli_real_escape_string($con, $user_id);
        $similar_pets_query = "SELECT * FROM pets WHERE pet_owner_id = '{$user_id_escaped}' AND pet_id != '{$pet_id_escaped}' LIMIT 4";      
        $similar_pets_result = mysqli_query($con, $similar_pets_query);
    
        while ($pet = mysqli_fetch_assoc($similar_pets_result))
      { ?>
        <a href="pet_profile.php?pet_id=<?php echo htmlspecialchars($pet['pet_id']); ?>">
            <div class="pet-card">
                <img src='uploads/<?php echo htmlspecialchars($pet['pet_image']); ?>' alt='<?php echo htmlspecialchars($pet['pet_name']); ?>'>
                <h2><?php echo htmlspecialchars($pet['pet_name']); ?></h2>
                <p><?php echo htmlspecialchars($pet['pet_breed']); ?></p>
            </div>
        </a>
      <?php
      }
      ?>
    </div>
  </div>

</div>

<script src="https://kit.fontawesome.com/b395562c04.js" crossorigin="anonymous"></script>

</body>
</html>