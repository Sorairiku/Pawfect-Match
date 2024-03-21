<?php 
   session_start();

   include("connection.php");
   include("functions.php");

   $user_data = check_login($con);
   $image = $user_data['user_image'];
   
   if (isset($_POST['delete_account'])) {
       $delete_query = "DELETE FROM users WHERE user_id = '$user_data[user_id]'";
       mysqli_query($con, $delete_query);

       // Redirect to a confirmation page or log the user out
       header("Location: logout.php");
   }
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    
    // Fetch the current hashed password from the database.
    $result = mysqli_query($con, "SELECT password FROM users WHERE user_id = '$user_data[user_id]'");
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['password'];
    
    // Verify that the submitted current password matches the hash in the database.
    if (password_verify($currentPassword, $hashedPassword)) {
        // If the passwords match, update the password in the database to the new one
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $updateQuery = "UPDATE users SET password = '$newHashedPassword' WHERE user_id = '$user_data[user_id]'";
        mysqli_query($con, $updateQuery);
        echo "Password changed successfully.";
    } else {
        echo "Wrong password. Please try again.";
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
	<link rel="stylesheet" href="css/message.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Open+Sans+Hebrew:wght@400;600;700&display=swap">    <title>Pawfect Match</title>
    <style>
        
        body {
    font-family: 'Poppins', sans-serif;
    background: #f8f9fa;
    color: #343a40;
   }

.settings {
    max-width: 960px;
    margin: 0 auto;
    padding: 40px;
    text-align: center;
}

.settings header {
    font-size: 30px;
    margin-bottom: 40px;
    color: #343a40;
}

.settings-option {
    display: inline-block;
    background: #fff;
    width: 200px;
    height: 200px;
    margin: 10px;
    padding: 20px;
    color: #343a40;
    border-radius: 4px;
    box-shadow: 0 2px 3px rgba(0,0,0,0.1);
    transition: all 200ms ease-in-out;
    text-align: left;
}
.settings-option{
	font-size: 20px;
}

.settings-option:hover {
    transform: translateY(-5px);
    box-shadow: 0 2px 3px rgba(0,0,0,0.2);
}

.delete-account {
    background: #dc3545;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    margin-top: 20px;
}  
		.modal {
			display: none; /* Hidden by default */
    		position: fixed; 
			justify-content: center;
    		z-index: 1; 
    		left: 0;
    		top: 0;
    		width: 100%; 
    		height: 100%;
    		overflow: auto; 
    		background-color: rgba(0,0,0,0.4); 
		}

		.modal-body {
    		display: flex;
    		flex-direction: column;
    		background-color: #fefefe;
			padding: 20px;
			border: 1px solid #888;
			border-radius: 10px;
    		margin: 15% auto;
    		width: 30%;
			height: 400px;
    		border: 1px solid #888;
		}
		.close {
			display: flex;
			justify-content: center;
			background-color: #7A6BBC;
			border-radius: 10px;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
			margin-left: 470px;
            cursor: pointer;
            width: 10%;
		}
		.modal-body button:hover {
            opacity: 1.1;
        }
		.modal-body h2{
			font-size: 25px;
			margin-top: -45px;
			margin-bottom: 40px;
			margin-left: 20px;
		}
		.submit{
			display: flex;
			justify-content: center;
			color: white;
			border: none;
			background-color: #7A6BBC;
			cursor: pointer;
			border-radius: 10px;
			padding: 14px 20px;
            font-size: 20px;
			margin-top: 20px;
			margin-left: 100px;
			margin-right: 100px;
        }
		.input-box{
			display: flex;
            flex-direction: column;
            margin-left: 20px;
			width: calc(100% - 100px);
		}
		.input-box label{
            font-size: 15px;
			margin-bottom: 10px;
        }
		.input-box input{
			width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
		}
		.input-box input:focus{
            border: 1px solid #7A6BBC;
        }
        
    </style>
</head>
<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>
<div class="settings">
    <header>
        <h2>Settings & Privacy</h2>
    </header>
    <a href="#" id="changePasswordButton">
        <div class="settings-option">
            <h3>Change Password</h3>
        </div>
    </a>
    <a href="deleteaccount.php?user_id=<?php echo $user_data['user_id'];?>" onclick="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
        <div class="settings-option">
            <h3>Delete Account</h3>
        </div>
    </a>
</div>

<form id="changePasswordModal" action="" method="post" class="modal">
    <div class="modal-body">
        <button id="closeModalButton" class="close">X</button>
        <h2>Change Password</h2>
        <div class="input-box">
            <label for="currentPassword">Current Password</label>
            <input type="password" id="currentPassword" name="currentPassword" required>
        </div>
        <div class="input-box">
            <label for="newPassword">New Password</label>
            <input type="password" id="newPassword" name="newPassword" required>
        </div>
        <div class="input-box">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
        </div>
        <button type="submit" value="Submit" class="submit">Submit</button>
    </div>
</form>

<script>
    document.getElementById('changePasswordButton').onclick = function() {
        document.getElementById('changePasswordModal').style.display = 'block';
    }

    document.getElementById('closeModalButton').onclick = function() {
        document.getElementById('changePasswordModal').style.display = 'none';
    }
</script>
</body>
</html>