<?php
session_start();
include("connection.php");
include("functions.php");

if(isset($_SESSION["form_data"])){

    // Retrieving data
    $pet_name = mysqli_real_escape_string($con, $_SESSION["form_data"]['pet_name']);
    $pet_type = mysqli_real_escape_string($con, $_SESSION["form_data"]['pet_type']);
    $fname = mysqli_real_escape_string($con, $_SESSION["form_data"]['fname']);
    $mname = mysqli_real_escape_string($con, $_SESSION["form_data"]['mname']);
    $lname = mysqli_real_escape_string($con, $_SESSION["form_data"]['lname']);
    $occupation = mysqli_real_escape_string($con, $_SESSION["form_data"]['occupation']);
    $phone = mysqli_real_escape_string($con, $_SESSION["form_data"]['phone']);
    $email = mysqli_real_escape_string($con, $_SESSION["form_data"]['email']);
    $identification = mysqli_real_escape_string($con, $_SESSION["form_data"]['identification']);
    $id_img = mysqli_real_escape_string($con, $_SESSION["form_data"]['id_img']);
    $street = mysqli_real_escape_string($con, $_SESSION["form_data"]['street']);
    $country = mysqli_real_escape_string($con, $_SESSION["form_data"]['country']);
    $city = mysqli_real_escape_string($con, $_SESSION["form_data"]['city']);
    $state = mysqli_real_escape_string($con, $_SESSION["form_data"]['state']);
    $postal = mysqli_real_escape_string($con, $_SESSION["form_data"]['postal']);
    $adults = mysqli_real_escape_string($con, $_SESSION["form_data"]['adult']);
    $children = mysqli_real_escape_string($con, $_SESSION["form_data"]['children']);
    $names = mysqli_real_escape_string($con, $_SESSION["form_data"]['names']);
    $household = mysqli_real_escape_string($con, $_SESSION["form_data"]['household']);
    $adopter_id = mysqli_real_escape_string($con, $_SESSION["form_data"]['adopter_id']);
    $reservation_id = mysqli_real_escape_string($con, $_SESSION["form_data"]['reservation_id']);
    $adopt_date = mysqli_real_escape_string($con, $_SESSION['form_data']['adopt_data']);
    $adopter_img = mysqli_real_escape_string($con, $_SESSION["form_data"]['adopter_img']);

    // query to execute in the database
    $query = "INSERT INTO adopt (adopter_img, adopt_date, adopter_id, reservation_id, pet_name, pet_type, fname, mname, lname, occupation, phone, email, identification, id_img, street, country, city, state, postal, adult, children, names, household)     
    VALUES ('$adopter_img', '$adopt_date', '$adopter_id', '$reservation_id', '$pet_name', '$pet_type', '$fname', '$mname', '$lname', '$occupation', '$phone', '$email', '$identification', '$id_img', '$street', '$country', '$city', '$state', '$postal', '$adults', '$children', '$names', '$household')"; 
    $result = mysqli_query($con, $query);

    // Check if the query was successfully executed:
    if($result){
        // Form data has been stored, you can now clear session form data
        unset($_SESSION["form_data"]);

        // Redirect to a success page
        header("Location: index.php");
        exit();  // Stop further script execution
    }else{
        die("Failed to save form: " . mysqli_error($con));
    }
}
?>