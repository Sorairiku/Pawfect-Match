<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    $image = !empty($user_data['user_image']) ? $user_data['user_image'] : "blank.png";

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Open+Sans+Hebrew:wght@400;600;700&display=swap">
    <title>Pawfect Match</title>
    <style>
        
        body {
            font-family: monospace;
            background-color: #fff;
            margin: 0;
            padding: 0;

        }
        .about-text {
            width: 800px;
            text-align: left;
            padding: 10px;
            margin: 100px;
        }
        .text{
            margin-bottom: 30px;
        }
        .text h1{
            font-size: 40px;
            font-weight: bold;
        }
        .text p{
            font-size: 20px;
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 40px;
        }
        form {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 600px;
    margin: auto;
    padding: 40px;
    background-color: #E6E6FA;
    border-radius: 10px;
}

form label {
    width: 100%;
    font-size: 18px;
    margin-top: 20px;
    font-weight: 500;
}

form input[type="text"], form input[type="email"], form textarea {
    width: 100%;
    margin-top: 10px;
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    background-color: #fff;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

form textarea {
    height: 100px;
    resize: vertical;
}

form input[type="submit"] {
    margin-top: 30px;
    padding: 10px 30px;
    border: none;
    border-radius: 20px;
    background-color: #7A6BBC;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease;
}

form input[type="submit"]:hover {
    background-color: #444;
}

    </style>
</head>
<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>
<?php include_once "html/slider.html"; ?>

<div class="about-text">
    <div class="text">
        <h1>Contact Us</h1>
        <p>
            Have a question, comment, or suggestion? We'd love to hear from you! Use the form below to get in touch with us. Our team is ready to assist you.
        </p>
        <p>
            <strong>Address:</strong> 123 Main Street, Cityville, State, Zip Code
        </p>
        <p>
            <strong>Phone:</strong> (123) 456-7890
        </p>
        <p>
            <strong>Email:</strong> info@example.com
        </p>
        <p>
            <strong>Business Hours:</strong> Monday - Friday: 9:00 AM - 5:00 PM
        </p>
        <p>
            Feel free to reach out to us using the contact form below. We'll do our best to respond to your inquiry promptly.
        </p>
    </div>
</div>
<form>
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>
    
    <label for="message">Message</label>
    <textarea id="message" name="message" required></textarea>
    
    <input type="submit" value="Submit">
</form>

</body>
</html>