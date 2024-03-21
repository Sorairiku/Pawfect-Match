<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = $user_data['user_image'];

$query = "SELECT * FROM users WHERE fname = '{$user_data['fname']}' AND lname = '{$user_data['lname']}'";
$result = mysqli_query($con, $query);
$pet_info = mysqli_fetch_assoc($result);
$owner_fname = $user_data['fname'];
$owner_image = $user_data['user_image'];
$owner_id= $user_data['user_id'];
$uploadError = '';

if(isset($_POST['submit'])){

    $pet_name = $_POST["pet_name"];
    // Use the user's first name as the pet owner
    $pet_owner = $owner_fname;
    $pet_owner_image = $owner_image;
    $pet_owner_id = $owner_id;
    $pet_type = $_POST["pet_type"];
    $pet_breed = $_POST["pet_breed"];
    $pet_gender = $_POST["pet_gender"];
    $pet_age = $_POST["pet_age"];
    $pet_location = $_POST["pet_location"];
    $pet_address = $_POST["pet_address"];
    $pet_description = $_POST["pet_description"];
    

    $img_name = $_FILES['pet_image']['name'];
    $img_size = $_FILES['pet_image']['size'];
    $tmp_name = $_FILES['pet_image']['tmp_name'];
    $error = $_FILES['pet_image']['error'];
    $type = $_FILES['pet_image']['type'];

    $ext = explode('.', $img_name);
    $actualext = strtolower(end($ext));
    $allowed = array('jpg','jpeg','png');

    if(in_array($actualext, $allowed)){
        if($error === 0){
            if($img_size < 1000000){
                $imageNameNew = uniqid('', true).".".$actualext;
                $destination = 'uploads/'.$imageNameNew;
                move_uploaded_file($tmp_name, $destination);
				$pet_id = random_num(20);
                $availability = 'Available';

                $query = "
                INSERT INTO pets (
                    pet_id, pet_name, pet_owner, pet_owner_image, pet_owner_id, pet_location, pet_address, pet_type, pet_breed,
                    pet_gender, pet_age, pet_image, pet_description, availability
                ) VALUES (
                    '$pet_id', '$pet_name', '$pet_owner', '$pet_owner_image', '$pet_owner_id', '$pet_location', '$pet_address', '$pet_type', 
                    '$pet_breed', '$pet_gender', '$pet_age', '$imageNameNew', '$pet_description', '$availability'
                )";

                mysqli_query($con, $query);

                header("Location: index.php");

            } else {
                $uploadError = "Your file is too big!";
            }
        } else {
            $uploadError = "There was an error uploading your file!";
        }
    } else {
        $uploadError = "You cannot upload files of this type!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/info.css">
    <link rel="stylesheet" href="css/message.css">
    <title>Pawfect Match</title>
</head>
<body>
<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>
<?php if (isset($_GET['error'])): ?>
    <p><?php echo $_GET['error']; ?></p>
<?php endif ?>
<div class="container">
    <div class="form-container-center">
        <div class="title-container"> <!-- Div to wrap title -->
            <div class="title">Pet Information</div>
        </div>
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data" class="form-group">
            <div class="left-form">
                <label for="pet_name">Pet Name:</label>
                <input type="text" name="pet_name" id="pet_name" placeholder="Name of Pet" required><br>
                <label for="pet_owner">Pet Owner:</label>
                <input type="text" name="pet_owner" id="pet_owner" value="<?php echo htmlspecialchars($owner_fname); ?>" required><br>
                <label for="pet_type">Pet Type:</label>
                <select id="pet_type" name="pet_type" required>
                    <option value="">--Select Pet Type--</option>
                    <option value="Dog">Dog</option>
                    <option value="Cat">Cat</option>
                    <option value="Bird">Bird</option>
                    <option value="Hamster">Hamster</option>
                    <option value="Rabbit">Rabbit</option>
                    <option value="Fish">Fish</option>
                </select><br>
                <label for="pet_breed">Pet Breed:</label>
                <input type="text" name="pet_breed" id="pet_breed" placeholder="Breed" required><br>
                <div class="gender-details">
                    <label for="pet_gender">Pet Gender:</label>
                    <input type="radio" id="pet_gender" name="pet_gender" value="Male"><span>Male<br></span>
                    <input type="radio" id="pet_gender" name="pet_gender" value="Female"><span>Female<br></span>
                </div>
                <label for="pet_age">Pet Age:</label>
                <input type="number" name="pet_age" id="pet_age" placeholder="Age" required><br>
                <label for="pet_location">Pet Address:</label>
                <select id="pet_location" name="pet_location" required onchange="checkOtherLocation(this.value)">
        <option value="">--Select Location--</option>
        <option value="Quezon City" <?= $user_data['city'] == 'Quezon City' ? 'selected' : '' ?>>Quezon City</option>
        <option value="Manila" <?= $user_data['city'] == 'Manila' ? 'selected' : '' ?>>Manila</option>
        <option value="Makati" <?= $user_data['city'] == 'Makati' ? 'selected' : '' ?>>Makati</option>
        <option value="Caloocan City" <?= $user_data['city'] == 'Caloocan City' ? 'selected' : '' ?>>Caloocan City</option>
        <option value="Marikina City" <?= $user_data['city'] == 'Marikina City' ? 'selected' : '' ?>>Marikina City</option>
        <option value="Mandaluyong City" <?= $user_data['city'] == 'Mandaluyong City' ? 'selected' : '' ?>>Mandaluyong City</option>
        <option value="Muntinlupa City" <?= $user_data['city'] == 'Muntinlupa City' ? 'selected' : '' ?>>Muntinlupa City</option>
        <option value="Navotas City" <?= $user_data['city'] == 'Navotas City' ? 'selected' : '' ?>>Navotas City</option>
        <option value="City of Malabon" <?= $user_data['city'] == 'City of Malabon' ? 'selected' : '' ?>>City of Malabon</option>
        <option value="Valenzuela City" <?= $user_data['city'] == 'Valenzuela City' ? 'selected' : '' ?>>Valenzuela City</option>
        <option value="Pasay City" <?= $user_data['city'] == 'Pasay City' ? 'selected' : '' ?>>Pasay City</option>
        <option value="Pasig City" <?= $user_data['city'] == 'Pasig City' ? 'selected' : '' ?>>Pasig City</option>
        <option value="Parañaque City" <?= $user_data['city'] == 'Parañaque City' ? 'selected' : '' ?>>Parañaque City</option>
        <option value="City of San Juan" <?= $user_data['city'] == 'City of San Juan' ? 'selected' : '' ?>>City of San Juan</option>
        <option value="Las Piñas City" <?= $user_data['city'] == 'Las Piñas City' ? 'selected' : '' ?>>Las Piñas City</option>
        <option value="Taguig City" <?= $user_data['city'] == 'Taguig City' ? 'selected' : '' ?>>Taguig City</option>
        <option value="other">Other..</option>
    </select>
                <div id="other-location" style="display: none;">
        <label class="details">Please specify:</label>
        <input id="other-location-input" type="text" name="other-location" placeholder="Type Here"/>
    </div>
                <label for="pet_address">Pet Address:</label>
                <input type="text" name="pet_address" id="pet_address" Value="<?php echo $user_data['address']?>" required><br>
                <label for="pet_description">Pet Description:</label>
                <textarea name="pet_description" id="pet_description" rows="5" placeholder="Type Here"></textarea><br>
            </div>
            <div class="pet-image-box">
                <label for="pet_image">Upload Image:</label>
                <img class="image-preview" id="image-preview" src="pictures/upload.png" alt="" >
                <input type="file" name="pet_image" id="pet_image" accept=".jpg, .jpeg, .png" style="margin-left: 130px"onchange="previewImage(event)"><br>
                <button type="button" id="remove-button" style="display: none;"  onclick="removeImage()">Remove Image</button>            </div>
            <div class="submit-container">
                <button type="submit" name="submit" class="submit-button">Put Pet up for Adoption</button>
            </div>
        </form>
    </div>
</div>

<script>
        // Function to preview image before uploading and show remove button
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block'; // Show the image preview
                document.getElementById('remove-button').style.display = 'inline-block'; // Show the remove button
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Function to remove the previewed image and hide remove button
        function removeImage() {
            document.getElementById('pet_image').value = ''; // Clear the file input
            document.getElementById('image-preview').src = ''; // Remove the previewed image
            document.getElementById('image-preview').style.display = 'none'; // Hide the image preview
            document.getElementById('remove-button').style.display = 'none'; // Hide the remove button
        }
        function checkOtherLocation(value) {
    const otherLocationDiv = document.getElementById('other-location');
    if(value === 'other'){
        otherLocationDiv.style.display = 'block';
    } else {
        otherLocationDiv.style.display = 'none';
    }
}
    </script>
</body>
</html>
