<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$user_id = $user_data['user_id'];
$image = $user_data['user_image'];

$pet_id = $_GET['pet_id'] ?? header('Location: index.php');

// Fetching details of logged in user
$stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_info = $result->fetch_assoc();

// Fetching details of pet
$stmt = $con->prepare("SELECT * FROM pets WHERE pet_id = ?");
$stmt->bind_param("i", $pet_id);
$stmt->execute();
$result = $stmt->get_result();
$pet_data = $result->fetch_assoc();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission
    if (isset($_FILES["id_img"]["error"]) && $_FILES["id_img"]["error"] == 0) {
        $img_name = $_FILES['id_img']['name'];
        $tmp_name = $_FILES['id_img']['tmp_name'];
        $img_size = $_FILES['id_img']['size'];

        $ext = explode('.', $img_name);
        $actualext = strtolower(end($ext));

        $allowed = array('jpg','jpeg','png', 'pdf');

        if (in_array($actualext, $allowed)) {
            if($img_size < 1000000){
                $imageNameNew = uniqid('', true).".".$actualext;
                $destination = 'uploads/'.$imageNameNew;
                move_uploaded_file($tmp_name, $destination);

                // Process other form data and save image name to DB
            } else {
                echo "Your file is too big!";
            }

        } else {
            echo "You cannot upload files of this type!";
        }
    }

    if (isset($_POST['identification']) && !empty($_POST['identification'])) {
        // Process this information appropriately
    }

    // ... More of your form processing code here ...
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
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;

        }
        .pet-form{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 70%;
            height: 600px;
            margin: 0 auto;
            background: transparent;
            border-radius: 10px;
            margin-top: 80px;
        }
        .pet-form form{
            width: 100%;
            height: 100%;
            display: flex;
            background: transparent;
            justify-content: center;
            flex-direction: column;
        }
        .info{
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row; /* Change from row to column */
            width: 100%; /* The input boxes will take the full width of the form */
        }
        .pet-form h1{
            font-size: 30px;
            font-weight: 600;
            margin: 0;
            padding: 0;
            color: #230B41;
            margin-top: 40px;
        }
        .pet-form h3{
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            padding: 0;
            color: #230B41;
            margin-top: 10px;
        }
        .input-box{
            display: flex;
            justify-content: center;
            align-items: left;
            flex-direction: column;
            margin-right: 10px;
            margin-left: 10px;
            width: 100%;
        }
        .id-input-box{
            display: flex;
            justify-content: center;
            align-items: left;
            flex-direction: column;
            margin-right: 10px;
            margin-left: 10px;
            width: 40%;
        }
        .img-input-box{
            display: flex;
            justify-content: center;
            align-items: left;
            flex-direction: column;
            margin-right: 10px;
            margin-left: 10px;
            width: 100%;
        }
        input[type=text], input[type=submit], input[type=email] {
            width: 100%;
            padding: 12px;
            margin: 5px 0 12px 0;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background-color: #F5F5F5;

        }
            
/* Style for form text labels */
        .input-box label {
            color: #230B41;
            margin-bottom: 5px;
            display: block;
        }
        .id-input-box label{
            color: #230B41;
            margin-bottom: 5px;
            display: block;
        }
        .img-input-box label{
            color: #230B41;
            display: block;
            margin-bottom: -15px;
        }

        /* Style for the Submit button */
        input[type=submit] {
            background-color: #70427D;
            color: white;
            cursor: pointer;
            border-radius: 20px;  /* Make the button border rounded */
            width: 150px; /* Set a small, fixed width */
            height: 35px; /* Set a small, fixed height */
            margin: 0 auto; /* Center the button */
            display: block; /* This helps the 'margin:auto' centering to work */
            transition: 0.3s;
            margin-top: 20px;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }
        input[type=date] {
            width: 100%;
            padding: 12px;
            margin: 5px 0 12px 0;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background-color: #F5F5F5;
        }
        .select-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .select-wrapper::after { 
            content: '\25BC';
            position: absolute;
            top: 0;
            right: 0;
            padding: 12px;
            background-color: #F5F5F5;
            cursor: pointer;
            pointer-events: none;
            transition: 0.25s all ease;
        }

        #identification {
            width: 100%;
            padding: 12px;
            margin: 5px 0 12px 0;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background-color: #F5F5F5;
            appearance: none;
        }

        
    </style>
</head>
<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>

<div class="title"></div>
<div class="pet-form">
    <form action="process_form.php" method="post">
    <h1>Fill up Pet Adoption Application Form</h1>
    <div class="info">
        <div class="input-box">
            <label for="pet_name">Name of the pet being adopted</label>
            <input type="text" id="pet_name" name="pet_name" value="<?php echo $pet_data['pet_name']; ?>" required>
        </div>
        <div class="input-box">
            <label for="pet_type">Type of Animal</label>
            <input type="text" id="pet_type" name="pet_type" value="<?php echo $pet_data['pet_type']; ?>" required>
        </div>
    </div>
    <div class="info">
        <div class="input-box">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" value="<?php echo $user_data['fname']; ?>" required>
        </div>
        <div class="input-box">
            <label for="mname">Middle Name</label>
            <input type="text" id="mname" name="mname" value="<?php echo $user_data['mname']; ?>">
        </div>
        <div class="input-box">
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lname" value="<?php echo $user_data['lname']; ?>" required>
        </div>
    </div>
    <div class="info">
        <div class="input-box">
            <label for="occupation">Occupation</label>
            <input type="text" id="occupation" name="occupation" placeholder="Occupation" required>
        </div>
        <div class="input-box">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" value="<?php echo $user_data['phone']; ?>" required>
        </div>
        <div class="input-box">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>
        </div>
    </div>
    <div class="info">
        <div class="id-input-box">
            <label for="id">Identification Type</label>
            <select id="identification" name="identification" required>
            <option value="">- Select -</option>
            <option value="Passport">Passport</option>
            <option value="Drivers License">Drivers License</option>
            <option value="SSS">SSS</option>
          <!-- Add more options as needed -->
            </select>
        </div>
    </div>
    <div class="info">
        <div class="img-input-box">
            <label for="id_img">Upload Image</label><br>
            <input type="file" name="id_img" id="id_img" accept=".jpg, .jpeg, .png, .pdf" onchange="previewImage(event)">
            <button type="button" id="remove-button" style="display: none;" onclick="removeImage()">Remove Image</button>
        </div>
    </div>
    <div class="info">
    <div class="id-input-box">
        <label for="adopt_date">Adoption Date:</label>
        <input type="date" id="adopt_date" name="adoption_date" required>
    </div>
    </div>
    <h3>Full home address:</h3>
    <div class="info">
        <div class="input-box">
            <label for="address">Street Address</label>
            <input type="text" id="street" name="street" value="<?php echo $user_data['address']; ?>" required>
        </div>
        <div class="input-box">
            <label for="country">Country</label>
            <input type="text" id="country" name="country" placeholder="Country" required>
        </div>
    </div>
    <div class="info">
        <div class="input-box">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?php echo $user_data['city']; ?>" required>
        </div>
        <div class="input-box">
            <label for="state">State</label>
            <input type="text" id="state" name="state" placeholder="State" required>
        </div>
        <div class="input-box">
            <label for="postal">Postal/Zip Code</label>
            <input type="text" id="postal" name="postal" value="<?php echo $user_data['postal_code']; ?>" required>
        </div>
    </div>

    
    <input type="hidden" name="pet_id" value="<?php echo $pet_id; ?>">
    <input type="submit" value="Continue">
</form>
</form>
</div>

</body>
</html>