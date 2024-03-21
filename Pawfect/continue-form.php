<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = $user_data['user_image'];

if(isset($_GET['pet_id'])) {
    $_SESSION['pet_id'] = $_GET['pet_id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION["form_data"]['adult'] = $_POST['adult'];
    $_SESSION["form_data"]['children'] = $_POST['children'];
    $_SESSION["form_data"]['names'] = $_POST['names'];
    $_SESSION["form_data"]['adopter_id'] = $user_data['user_id'];
    $_SESSION["form_data"]['adopter_img'] = $user_data['user_image'];
    
    // Handling the household field
    $household = "";
    if (isset($_POST['household'])) {
        $household = is_array($_POST['household']) ? implode(', ', $_POST['household']) : $_POST['household'];
    }
    $_SESSION["form_data"]['household'] = $household;

    // Update the pet availability to 'Reserved'
    if(isset($_SESSION['pet_id'])) {
        $pet_id = mysqli_real_escape_string($con, $_SESSION["pet_id"]);
        $query_update = "UPDATE pets SET availability ='Reserved' WHERE pet_id = '$pet_id'";
        $result_update = mysqli_query($con, $query_update);

        if(!$result_update){
            $_SESSION['error_message'] = "An error occurred in updating the pet status : " . mysqli_error($con);
        }
    }
    if(isset($_SESSION['pet_id'])) {
        $pet_id = mysqli_real_escape_string($con, $_SESSION["pet_id"]);
        
        // Generate reservation_id
        $reservation_id = random_num(20);

        // Update the pet reservation_id and availability in the pets table
        $query_update_pets = "UPDATE pets SET availability ='Reserved', reservation_id = '$reservation_id' WHERE pet_id = '$pet_id'";
        $result_update_pets = mysqli_query($con, $query_update_pets);

        // Store the reservation_id in the session array
        $_SESSION["form_data"]['reservation_id'] = $reservation_id;

        if(!$result_update_pets){
            $_SESSION['error_message'] = "An error occurred in updating the reservation : " . mysqli_error($con);
        }
    }

    header("Location: finalize_submission.php?pet_id=".$_SESSION['pet_id']);
    exit();
}

// ... rest of your HTML form code ...
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
            margin-bottom: 10px;
        }
        .info p,
        .t-info p{
            font-size: 20px;
            color: #230B41;
        }
        .checkboxes label{
            font-size: 20px;
            color: #230B41;
        }
        .checkboxes span{
            font-size: 25px;
            color: #000;
            margin-left: 70px;
        }
        .pet-form h1{
            font-size: 30px;
            font-weight: 600;
            margin: 0;
            padding: 0;
            color: #230B41;
        }
        .pet-form h3{
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            padding: 0;
            color: #230B41;
            margin-top: 20px;
        }
        input[type=text], input[type=submit], input[type=email] {
            width: 50%;
            padding: 12px;
            margin: 5px 0 12px 0;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background-color: #F5F5F5;
        }
        .checkboxes {
    margin-left: 20px;
}
        input[type=checkbox] {
    visibility: hidden;
}

input[type=checkbox]:before {
    content: "";
    display: inline-block;
    width: 30px;
    height: 30px;
    border: 2px solid #000;
    border-radius: 4px;
    margin-right: 10px;
    background-color: #fff;
    left: 40px;
    bottom: 10px;
    position: relative;
    visibility: visible;
    vertical-align: middle;

}

input[type=checkbox]:checked:before {
    background: #70427D; /* Change the color according to your design */
}
            
        /* Style for the Submit button */
        button[type=submit] {
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
            border: none;
        }

        button[type=submit]:hover {
            background-color: #45a049;
        }
        .styled-textarea {
            font-family: 'Poppins', sans-serif;
            color: #230B41;
            border-radius: 5px;
            padding: 12px;
            margin: 5px 0 12px 0;
            width: 100%;
            resize: vertical;
            border: none;
            background-color: #F5F5F5;
        }

        
    </style>
</head>
<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>

<div class="title"></div>
<div class="pet-form">
    <form action="" method="post">
        <h1>Fill up Pet Adoption Application Form</h1>
        <div class="info">
            <p>How many adults live in your household? (Including yourself) </p>
            <input type="text" name="adult" required>
        </div>
        <div class="info">
            <p>How many children live in your household? (N/A if none) </p>
            <input type="text" name="children" required>
        </div>
        <div class="t-info">
            <p>Names and ages of all permanent residents of your home (Adults/Children) </p>
            <textarea type="text" rows="5" class="styled-textarea" name="names" required></textarea>
        </div>
        <div class="checkboxes">
            <label>Please describe your household:</label>
            <input type="checkbox" id="active" name="household" value="Active"><label for="active"><span>Active</span></label>
            <input type="checkbox" id="calm" name="household" value="Calm"><label for="calm"><span>Calm</span></label>
            <input type="checkbox" id="noisy" name="household" value="Noisy"><label for="noisy"><span>Noisy</span></label>
            <input type="checkbox" id="quiet" name="household" value="Quiet"><label for="quiet"><span>Quiet</span></label>
        </div>
        <h3>Have you read <a href="#">Terms & Conditions</a> ? </h3>
        <?php 
        if(isset($_SESSION["form_data"])): ?>
            <button type="submit" class="submission-button" onclick="location.href ='finalize_submission.php'">Finalize Submission</button>
        <?php endif; ?>
    </form>
</form>
</div>

</body>
</html>