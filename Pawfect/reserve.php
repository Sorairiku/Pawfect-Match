<?php 
    session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $image = $user_data['user_image'];

    // Get pet_id from the URL
    $pet_id = isset($_GET['pet_id']) ? $_GET['pet_id'] : null;

    if($pet_id == null) {
        echo 'Invalid pet_id!';
        die();
    }
    $query = "SELECT * FROM pets WHERE pet_id = $pet_id";

    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);

    $pet_id = $data['pet_id'];
    $pet_owner_id = $data['pet_owner_id'];
    $pet_name = $data['pet_name'];
    $pet_type = $data['pet_type'];
    $reservation_id = $data['reservation_id'];

    $adopt_query = "SELECT * FROM adopt WHERE reservation_id = $reservation_id";

    // Execute the query
    $adopt_result = mysqli_query($con, $adopt_query);

    if (mysqli_num_rows($adopt_result) > 0) {
        // Fetch the data into an associative array
        $adopt_data = mysqli_fetch_assoc($adopt_result);

        // Get adoption date, replace 'date_of_adoption' with the actual column name in your table for adoption date
        $date_of_adoption = htmlspecialchars($adopt_data['adopt_date']);
        $adopt_reservation_id = $adopt_data['reservation_id'];
        $a_fname = $adopt_data['fname'];
        $a_mname = $adopt_data['mname'];
        $a_lname = $adopt_data['lname'];
        $a_occupation = $adopt_data['occupation'];
        $a_phone = $adopt_data['phone'];
        $a_email = $adopt_data['email'];
        $a_identification = $adopt_data['identification'];
        $a_id_img = $adopt_data['id_img'];
        $a_street = $adopt_data['street'];
        $a_country = $adopt_data['country'];
        $a_city = $adopt_data['city'];
        $a_state = $adopt_data['state'];
        $a_postal = $adopt_data['postal'];
        $a_adult = $adopt_data['adult'];
        $a_children = $adopt_data['children'];
        $a_names = $adopt_data['names'];
        $a_household = $adopt_data['household'];
        $a_adopter_id = $adopt_data['adopter_id'];
        $a_adopter_img  = $adopt_data['adopter_img'];
        
        
    } else {
        $date_of_adoption = "No adoption records found for this pet.";
    }

    include_once "html/body.html"; 
    include_once "html/users.html"; 
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
            margin-top: 800px;
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
<div class="title"></div>
<div class="pet-form">
    <form action="process_form.php" method="post">
    <h1>Fill up Pet Adoption Application Form</h1>
    <div class="info">
    <div class="input-box">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($a_fname); ?>" disabled>
    </div>
    <div class="input-box">
        <label for="mname">Middle Name</label>
        <input type="text" id="mname" name="mname" value="<?php echo htmlspecialchars($a_mname); ?>" disabled>
    </div>
    <div class="input-box">
        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($a_lname); ?>" disabled>
    </div>
</div>
<div class="info">
    <div class="input-box">
        <label for="occupation">Occupation</label>
        <input type="text" id="occupation" name="occupation" value="<?php echo htmlspecialchars($a_occupation); ?>" disabled>
    </div>
    <div class="input-box">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($a_phone); ?>" disabled>
    </div>
    <div class="input-box">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($a_email); ?>" disabled>
    </div>
</div>
<div class="info">
    <div class="id-input-box">
        <label for="id">Identification Type</label>
        <select id="identification" name="identification" disabled>
            <option value="">- Select -</option>
            <option value="Passport" <?php if ($a_identification === 'Passport') echo 'selected'; ?>>Passport</option>
            <option value="Drivers License" <?php if ($a_identification === 'Drivers License') echo 'selected'; ?>>Drivers License</option>
            <option value="SSS" <?php if ($a_identification === 'SSS') echo 'selected'; ?>>SSS</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>
<div class="info">
    <div class="img-input-box">
        <label for="id_img">Upload Image</label><br>
        <input type="file" name="id_img" id="id_img" accept=".jpg, .jpeg, .png, .pdf" onchange="previewImage(event)" disabled>
        <button type="button" id="remove-button" style="display: none;" onclick="removeImage()" disabled>Remove Image</button>
    </div>
</div>
<div class="info">
    <div class="id-input-box">
        <label for="adopt_date">Adoption Date:</label>
        <input type="date" id="adopt_date" name="adoption_date" value="<?php echo htmlspecialchars($date_of_adoption); ?>" disabled>
    </div>
</div>
    <h3>Full home address:</h3>
    <div class="info">
        <div class="input-box">
            <label for="address">Street Address</label>
            <input type="text" id="street" name="street" value="<?php echo htmlspecialchars($a_street); ?>" disabled>
        </div>
        <div class="input-box">
            <label for="country">Country</label>
            <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($a_country); ?>" disabled>
        </div>
    </div>
    <div class="info">
        <div class="input-box">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($a_city); ?>" disabled>
        </div>
        <div class="input-box">
            <label for="state">State</label>
            <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($a_state); ?>" disabled>
        </div>
        <div class="input-box">
            <label for="postal">Postal/Zip Code</label>
            <input type="text" id="postal" name="postal" value="<?php echo htmlspecialchars($a_postal); ?>" disabled>
        </div>
    </div>
    <div class="title"></div>
<style>
    .pet-form2{
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: left;
            width: 80%;
            margin: 0 auto;
            background: transparent;
            border-radius: 10px;
            margin-top: 80px;
        }
        .pet-form2 form{
            width: 100%;
            height: 100%;
            display: flex;
            background: transparent;
            justify-content: center;
            flex-direction: column;
        }
        .info2{
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row; /* Change from row to column */
            width: 100%; /* The input boxes will take the full width of the form */
            margin-bottom: 10px;
        }
        .info2 p,
        .t-info p{
            font-size: 20px;
            color: #230B41;
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
        .decision {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-bottom: 100px;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background: #70427D;
    color: #FFFFFF;
    font-size: 1em;
    cursor: pointer;
    transition: background 0.3s ease;
}

button:hover {
    background: #50275D;
}
</style>
<div class="pet-form2">
    <form action="" method="post">
        <div class="info2">
            <p>How many adults live in your household? (Including yourself) </p>
            <input type="text" name="adult"  value="<?php echo htmlspecialchars($a_adult); ?>" disabled>
        </div>
        <div class="info2">
            <p>How many children live in your household? (N/A if none) </p>
            <input type="text" name="children" value="<?php echo htmlspecialchars($a_children); ?>" disabled>
        </div>
        <div class="info2">
            <p>Type of household?</p>
            <input type="text" name="household" value="<?php echo htmlspecialchars($a_household); ?>" disabled>
        </div>
        <div class="t-info">
            <p>Names and ages of all permanent residents of your home (Adults/Children) </p>
            <textarea type="text" rows="3" class="styled-textarea" name="names" disabled><?php echo htmlspecialchars($a_names); ?></textarea>
        </div>

    </form>
</form>
</div>
</div>
<div class="decision">
    <h3>Will you let <?php echo $a_fname; ?> adopt <?php echo $pet_name; ?>?</h3>
    <form action="" method="post">
        <input type="hidden" name="decision">
        <input type="hidden" name="pet_id" value="<?php echo htmlspecialchars($pet_id); ?>" >

        <button type="submit" id="yesBtn" name="decision" value="yes" aria-label="Click to approve">Yes</button>  
        <button type="submit" id="noBtn" name="decision" value="no" aria-label="Click to disapprove">No</button>
    </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['decision'])) {
    $decision = $_POST['decision'];

    if ($decision === 'yes') {
        // Fetch necessary adopter details from the POST request
        $pet_owner_id = $a_adopter_id;
        $pet_id = $_POST['pet_id'];
        $owner_img = $a_adopter_img;
        $a_fname = $a_fname; // Make sure to replace 'adopter_name' to the actual form field name

        acceptAdoption($a_fname, $pet_owner_id, $owner_img, $pet_id, $con);
    } elseif ($decision === 'no') {
        rejectAdoption($pet_id, $con);
    }
}

function acceptAdoption($a_fname, $owner_id, $owner_img, $pet_id, $con) {
    $query = "UPDATE pets SET pet_owner = ?, pet_owner_id = ?, pet_owner_image = ?, availability = 'Adopted', reservation_id = '' WHERE pet_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sisi", $a_fname, $owner_id, $owner_img, $pet_id);
    $stmt->execute();
}

function rejectAdoption($pet_id, $con) {
    $query = "UPDATE pets SET availability = 'Available', reservation_id = '' WHERE pet_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $pet_id);
    $stmt->execute();
}
?>
</body>
</html>