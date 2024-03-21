<?php
session_start();
$pet_id = $_POST['pet_id'];
/* Getting form values */
$_SESSION["form_data"] = array(
  'pet_name' => $_POST['pet_name'],
  'pet_type' => $_POST['pet_type'],
  'fname' => $_POST['fname'],
  'mname' => $_POST['mname'],
  'lname' => $_POST['lname'],
  'occupation' => $_POST['occupation'],
  'phone' => $_POST['phone'],
  'email' => $_POST['email'],
  'identification' => $_POST['identification'],
  'id_img' => $_POST['id_img'],
  'street' => $_POST['street'],
  'country' => $_POST['country'],
  'city' => $_POST['city'],
  'state' => $_POST['state'],
  'postal' => $_POST['postal'],
  'adopt_date' => $_POST['adopt_date'],
);

/* Redirect to the next page */
header("Location: continue-form.php?pet_id=" . $pet_id);
exit();  // Stop the script from executing further.
?>