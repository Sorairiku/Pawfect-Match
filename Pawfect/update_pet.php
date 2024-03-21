<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = $user_data['user_image'];
$pet_id = isset($_GET['pet_id']) ? $_GET['pet_id'] : header('Location: index.php');

$query = "SELECT * FROM pets WHERE pet_id = '$pet_id'";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Declare variables
    $pet_id = $row['pet_id'];
    $pet_name = $row['pet_name'];
    $pet_location = $row['pet_location'];
    $pet_owner = $row['pet_owner'];
    $pet_type = $row['pet_type'];
    $pet_breed = $row['pet_breed'];
    $pet_gender = $row['pet_gender'];
    $pet_age = $row['pet_age'];
    $pet_image = $row['pet_image'];
    $pet_location = $row['pet_location'];
    $pet_address = $row['pet_address'];
    $pet_description = $row['pet_description'];
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $pet_name = mysqli_real_escape_string($con, $_POST['pet_name']); /* Add your sanitization function here */
    $pet_owner = mysqli_real_escape_string($con, $_POST['pet_owner']); /* Add your sanitization function here */
    $pet_type = mysqli_real_escape_string($con, $_POST['pet_type']); /* Add your sanitization function here */
    $pet_breed = mysqli_real_escape_string($con, $_POST['pet_breed']); /* Add your sanitization function here */
    $pet_gender = mysqli_real_escape_string($con, $_POST['pet_gender']); /* Add your sanitization function here */
    $pet_age = mysqli_real_escape_string($con, $_POST['pet_age']); /* Add your sanitization function here */
    $pet_location = mysqli_real_escape_string($con, $_POST['pet_location']); /* Add your sanitization function here */
    $pet_address = mysqli_real_escape_string($con, $_POST['pet_address']); /* Add your sanitization function here */
    $pet_description = mysqli_real_escape_string($con, $_POST['pet_description']); /* Add your sanitization function here */

    $updateQuery = "UPDATE pets SET pet_name = '$pet_name', pet_owner = '$pet_owner', pet_type = '$pet_type', pet_breed = '$pet_breed', 
    pet_gender = '$pet_gender', pet_age = '$pet_age', pet_location = '$pet_location', pet_address = '$pet_address', 
    pet_description = '$pet_description' WHERE pet_id = '$pet_id'";

    if(mysqli_query($con, $updateQuery)){
        header("Location: update_pet.php");
        die;
    } else {
        echo "Update failed: " . mysqli_error($con);
    }
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
    <link rel="stylesheet" href="css/info.css">
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

<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>

<div class="container">
    <div class="form-container-center">
        <div class="title-container"> <!-- Div to wrap title -->
            <div class="title">Update Pet Information</div>
        </div>
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data" class="form-group">
            <div class="left-form">
                <label for="pet_name">Pet Name:</label>
                <input type="text" name="pet_name" id="pet_name" value="<?php echo $pet_name?>" required><br>
                <label for="pet_owner">Pet Owner:</label>
                <input type="text" name="pet_owner" id="pet_owner" value="<?php echo $pet_owner?>" required><br>
                <label for="pet_type">Pet Type:</label>
                <select id="pet_type" name="pet_type" required>
                    <option value="">--Select Pet Type--</option>
                    <option value="Dog" <?php echo ($pet_type=='Dog')?'selected':'' ?>>Dog</option>
                    <option value="Cat" <?php echo ($pet_type=='Cat')?'selected':'' ?>>Cat</option>
                    <option value="Bird" <?php echo ($pet_type=='Bird')?'selected':'' ?>>Bird</option>
                    <option value="Hamster" <?php echo ($pet_type=='Hamster')?'selected':'' ?>>Hamster</option>
                    <option value="Rabbit" <?php echo ($pet_type=='Rabbit')?'selected':'' ?>>Rabbit</option>
                    <option value="Fish" <?php echo ($pet_type=='Fish')?'selected':'' ?>>Fish</option>
                </select><br>
                <label for="pet_breed">Pet Breed:</label>
                <input type="text" name="pet_breed" id="pet_breed" value="<?php echo $pet_breed?>" required><br>
                <div class="gender-details">
                    <label for="male">Male</label>
                    <input type="radio" id="male" name="pet_gender" value="Male"
                    <?php echo ($pet_gender=='Male')?'checked':'' ?>>

                    <label for="female">Female</label>
                    <input type="radio" id="female" name="pet_gender" value="Female"
                    <?php echo ($pet_gender=='Female')?'checked':'' ?>>
                </div>
                <label for="pet_age">Pet Age:</label>
                <input type="number" name="pet_age" id="pet_age" value="<?php echo $pet_age?>" required><br>
                <label for="pet_location">Pet Address:</label>
                    <select id="pet_location" name="pet_location" required>
                        <option value="">--Select Location--</option>
                        <option value="Quezon City" <?= $user_data['city'] == 'Quezon City' ? 'selected' : '' ?>>Quezon City</option>
                        <option value="Manila" <?= $user_data['city'] == 'Manila' ? 'selected' : '' ?>>Manila</option>
                        <option value="Makati" <?= $user_data['city'] == 'Makati' ? 'selected' : '' ?>>Makati</option>
                    </select><br>
                <label for="pet_address">Pet Address:</label>
                <input type="text" name="pet_address" id="pet_address" value="<?php echo $pet_address?>" required><br>
                <label for="pet_description">Pet Description:</label>
                <textarea name="pet_description" id="pet_description" rows="5" required><?php echo $pet_description ?></textarea><br>
            </div>
            <div class="pet-image-box">
                <label for="pet_image">Upload Image:</label>
                <img class="image-preview" id="image-preview" src="uploads/<?php echo $pet_image?>" alt="" >
                <input type="file" name="pet_image" id="pet_image" accept=".jpg, .jpeg, .png" style="margin-left: 130px"onchange="previewImage(event)"><br>
                <button type="button" id="remove-button" style="display: none;"  onclick="removeImage()">Remove Image</button>            </div>
            <div class="submit-container">
                <button type="submit" name="submit" class="submit-button">Update Information</button>
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
    </script>
</body>
</html>
