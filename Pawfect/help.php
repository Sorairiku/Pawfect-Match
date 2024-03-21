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
            width: 100%;
            padding: 10px;
        }
        .about-text2{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-5%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 70%;
        }
        .about-text h1{
            font-size: 50px;
            font-weight: bold;
            text-align: left;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .text{
            margin-bottom: 30px;
        }
        .text h1{
            font-size: 40px;
            font-weight: bold;
        }
        .text span{
            font-size: 23px;
            font-weight: 300;
            margin-top: 10px;
        }
        .text li{
            font-size: 20px;
            font-weight: 550;
            margin-top: 10px;
        }
        .text p{
            font-size: 15px;
            font-weight: 300;
            margin-top: 10px;
        }
        

    </style>
</head>
<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>
<?php include_once "html/slider.html"; ?>

<div class="about-text">
<div class="about-text2">
    <h1>Help & Services</h1>
    <div class="text">
        <h1>Frequently Asked Questions (FAQs):</h1>
        <span>
            Have questions about using the Pawfect Match app? Check out our FAQs for answers to common inquiries about pet adoption, app features, and more.
    </span>
        <ul>
            <li>How does Pawfect Match work?</li>
            <p>Pawfect Match is an innovative app that connects pet owners with potential adopters. Users can browse through profiles of pets available for adoption, view photos, and learn more about each pet's personality. The app uses personalized matchmaking algorithms to help users find their perfect match.</p>
            <li>How can I adopt a pet using Pawfect Match?</li>
            <p>To adopt a pet using Pawfect Match, simply create an account, browse through the available pets, and find one that you're interested in. Once you've found your match, you can contact the pet owner or adoption agency directly through the app to arrange the adoption process.</p>
            <li>Can I list my pet for adoption on Pawfect Match?</li>
            <p>Yes, pet owners can list their pets for adoption on Pawfect Match. Simply create an account, provide details about your pet, upload photos, and publish your pet's profile. Potential adopters can then view your pet's profile and contact you if they're interested in adopting.</p>
            <li>Is there a fee to use Pawfect Match?</li>
            <p>Pawfect Match is free to download and use for both pet owners and potential adopters. However, some adoption agencies or pet owners may charge adoption fees or require donations to cover expenses associated with pet care and adoption.</p>
            <li>How can I ensure a successful adoption through Pawfect Match?</li>
            <p>To increase your chances of a successful adoption, we recommend thoroughly reading each pet's profile, asking questions about their behavior and needs, and meeting the pet in person before finalizing the adoption. Additionally, be prepared to provide a loving and stable home for your new furry friend.</p>
        </ul>
    </div>
    <div class="text">
        <h1>Customer Support:</h1>
        <span>
        Need assistance or have a specific question? Our dedicated customer support team is available to help. Contact us via phone, email, or live chat for personalized assistance.
    </span>
    </div>
    <div class="text">
        <h1>Adoption Process Overview:</h1>
        <span>
        Wondering how the pet adoption process works? Get an overview of the adoption process from start to finish, including how to search for pets, submit applications, and finalize adoptions.
    </span>
    </div>
    <div class="text">
        <h1>Feedback & Suggestions:</h1>
        <span>
        We value your feedback! Share your thoughts, suggestions, and ideas with us to help us improve the Pawfect Match app and better meet your needs.    </span>
    </div>
    <div class="text">
        <h1>Privacy & Security:</h1>
        <span>
        Your privacy and security are our top priorities. Learn more about how we protect your personal information and ensure a safe and secure browsing experience.    </span>
    </div>
    <div class="text">
        <h1>Terms of Service & Policies:</h1>
        <span>
        Familiarize yourself with our terms of service and policies to understand your rights and responsibilities as a Pawfect Match app user.    </div>
    <div class="text">
        <h1>Community Forum:</h1>
        <span>
        Connect with other pet lovers and Pawfect Match users in our community forum. Share stories, ask questions, and join discussions about all things pets!
    </div>
</div>
</div>

</body>
</html>