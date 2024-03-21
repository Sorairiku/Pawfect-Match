<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = $user_data['user_image'];

$search_query = isset($_GET['search_query']) ? mysqli_real_escape_string($con, $_GET['search_query']) : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/adopt.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="css/message.css">
    <title>Pawfect Match</title>
</head>
<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>

<div class="search-box">
<form method="GET" action="">
    <div class="search-pet">
        <input id="petSearch" name="search_query" type="text" placeholder="Search for Pets..." value="<?php echo htmlspecialchars($search_query); ?>">
        <button type="submit" role="search"><i class="fas fa-search"></i></button>
        <a href="?search_query=">
            <div class="arr"><i class="fas fa-arrow-rotate-right"></i></div>
        </a>    
    </div>
</form>
<?php include_once "html/slider.html"; ?>
<div class="categories">
    <h1>Categories</h1>
    <div class="pet-categories">
        <a href="?search_query=Dog">
            <div class="pet-types">
                <img src="pictures/dog.png">
                <h2>Dog</h2>
            </div>
        </a>
        <a href="?search_query=Cat">
            <div class="pet-types">
                <img src="pictures/cat.png">
                <h2>Cat</h2>
            </div>
        </a>
        <a href="?search_query=Bird">
            <div class="pet-types">
                <img src="pictures/bird.png">
                <h2>Bird</h2>
            </div>
        </a>
        <a href="?search_query=Hamster">
            <div class="pet-types">
                <img src="pictures/hamster.png">
                <h2>Hamster</h2>
            </div>
        </a>
        <a href="?search_query=Rabbit">
            <div class="pet-types">
                <img src="pictures/rabbit.png">
                <h2>Rabbit</h2>
            </div>
        </a>
        <a href="?search_query=Fish">
            <div class="pet-types">
                <img src="pictures/fish.jpg">
                <h2>Fish</h2>
            </div>
        </a>
    </div>
</div>
</form>
</div>
<div class="results-container">
<?php
$query = "SELECT pet_id, pet_name, pet_owner, pet_type, pet_breed, pet_gender, pet_age, pet_image, pet_location, pet_address, pet_description, availability FROM pets";

if (!empty($search_query)) {
    $query .= " AND (LOWER(pet_name) LIKE LOWER('%$search_query%') OR 
                LOWER(pet_owner) LIKE LOWER('%$search_query%') OR 
                LOWER(pet_type) LIKE LOWER('%$search_query%') OR
                LOWER(pet_breed) LIKE LOWER('%$search_query%') OR 
                LOWER(pet_gender) LIKE LOWER('%$search_query%') OR
                LOWER(pet_location) LIKE LOWER('%$search_query%') OR
                LOWER(pet_address) LIKE LOWER('%$search_query%') OR
                LOWER(availability) LIKE LOWER('%$search_query%') OR
                pet_age = '$search_query' OR
                LOWER(pet_description) LIKE LOWER('%$search_query%'))";
}

$result = mysqli_query($con, $query);

// Check if there are any rows returned from the query
if(mysqli_num_rows($result) > 0) {
    // Loop through each row in the result set
    while($row = mysqli_fetch_assoc($result)) {
        // Access pet information from the current row
        $pet_id = $row['pet_id'];
        $pet_name = $row['pet_name'];
        $pet_location = $row['pet_location'];
        $pet_owner = $row['pet_owner'];
        $pet_type = $row['pet_type'];
        $pet_breed = $row['pet_breed'];
        $pet_gender = $row['pet_gender'];
        $pet_age = $row['pet_age'];
        $pet_image = $row['pet_image'];
        $pet_description = $row['pet_description'];
        $pet_address = $row['pet_address'];
        $availability = $row['availability'];
        ?>
        

        <a href='pet_profile_adopt.php?pet_id=<?php echo $pet_id;?>'>
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
