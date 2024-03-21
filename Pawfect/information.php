<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = $user_data['user_image'];

$query = "SELECT * FROM users WHERE fname = '{$user_data['fname']}' AND lname = '{$user_data['lname']}'";
$result = mysqli_query($con, $query);
$user_info = mysqli_fetch_assoc($result);

if(isset($_POST['submit']) && isset($_FILES['user-image'])){
    // Handle image upload and update
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mname = $_POST["mname"];
    $dob = $_POST["dob"]; 
    $address = $_POST["address"];
    $city = $_POST["city"];
    $postal_code = $_POST["postal_code"];
    $phone = $_POST["phone"];

    $img_name = $_FILES['user-image']['name'];
    $img_size = $_FILES['user-image']['size'];
    $tmp_name = $_FILES['user-image']['tmp_name'];
    $error = $_FILES['user-image']['error'];
    $type = $_FILES['user-image']['type'];

    $ext = explode('.', $img_name);
    $actualext = strtolower(end($ext));

    $allowed = array('jpg','jpeg','png', 'pdf');

    if(in_array($actualext, $allowed)){
        if($error === 0){
            if($img_size < 1000000){
                $imageNameNew = uniqid('', true).".".$actualext;
                $destination = 'uploads/'.$imageNameNew;
                move_uploaded_file($tmp_name, $destination);

                $query = "UPDATE users SET fname = '$fname', lname = '$lname', mname = '$mname', user_image = '$imageNameNew', dob = '$dob', address = '$address', city = '$city', postal_code = '$postal_code', phone = '$phone' WHERE id = {$user_data['id']}";
                mysqli_query($con, $query);

                header("Location: index.php");

            } else {
                echo "Your file is too big!";
            }

        } else {
            echo "There was an error uploading your file!";
        }

    } else {
        echo "You cannot upload files of this type!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/message.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/info.css">
    <title>Pawfect Match</title>
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
<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>

    <div class="container">
    <!-- Left side form -->
    <div class="left-form">
        <div class="title">Update Information</div>
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data" class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname" value="<?php echo $user_info['fname'] ?? ''; ?>" required>
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname" value="<?php echo $user_info['lname'] ?? ''; ?>" required>
            <label for="mname">Middle Name:</label>
            <input type="text" name="mname" id="mname" value="<?php echo $user_info['mname'] ?? ''; ?>">
            <label for="dob">Birth Date:</label>
            <input type="date" name="dob" id="dob" value="<?php echo $user_info['dob'] ?? ''; ?>" required>
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" value="<?php echo $user_info['address'] ?? ''; ?>" required>            
            <label for="city">City:</label>
            <select id="city" name="city" required>
                <option value="">--Select City--</option>
                <option value="Quezon City" <?php echo ($user_info['city'] === 'Quezon City') ? 'selected' : ''; ?>>Quezon City</option>
                <option value="Manila" <?php echo ($user_info['city'] === 'Manila') ? 'selected' : ''; ?>>Manila</option>
                <option value="Makati" <?php echo ($user_info['city'] === 'Makati') ? 'selected' : ''; ?>>Makati</option>
            </select>
            <label for="postal_code">Postal Code:</label>
            <input type="text" name="postal_code" id="postal_code" value="<?php echo $user_info['postal_code'] ?? ''; ?>" required>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" value="<?php echo $user_info['phone'] ?? ''; ?>" required>
            <label for="user-image">Upload Image:</label>
            <input type="file" name="user-image" id="user-image" accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
            <button type="button" id="remove-button" style="display: none;" onclick="removeImage()">Remove Image</button>
            <img id="image-preview" src="#" alt="Image Preview" style="max-width: 100%; max-height: 200px; margin-bottom: 10px;">
            <button type="submit" name="submit" class="submit-button">Update Information</button>
        </form>
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
            document.getElementById('user-image').value = ''; // Clear the file input
            document.getElementById('image-preview').src = '#'; // Remove the previewed image
            document.getElementById('image-preview').style.display = 'none'; // Hide the image preview
            document.getElementById('remove-button').style.display = 'none'; // Hide the remove button
        }
    </script>
</body>
</html>
