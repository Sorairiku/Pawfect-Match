<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$image = !empty($user_data['user_image']) ? $user_data['user_image'] : "blank.png";

// API URL and Key
$apiKey = "YOUR_API_KEY";
$url = 'https://gnews.io/api/v4/search?q=pet&lang=en&token='.$apiKey;

// Fetch the data and decode JSON Response
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($ch);
curl_close($ch);
$newsData = json_decode($json);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/message.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <title>Pawfect Match</title>
    <style>
        body {
            font-family: monospace;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        .news-section{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 50px;
            margin: 50px;
            background-color: transparent;
            border-radius: 10px;

            height: 400px;
        }
    </style>
</head>

<?php include_once "html/body.html"; ?>
<?php include_once "html/users.html"; ?>
<?php include_once "html/slider.html"; ?>


<!-- News Section -->

<div class="news-section">
<h2>Pet News</h2>
   <?php 
       if(!empty($newsData->articles)) {
           foreach($newsData->articles as $news) {
               ?>
               <article aria-labelledby="news-title-<?php echo $news->title; ?>">
                   <h3 id="news-title-<?php echo $news->title; ?>">
                       <a href="<?php echo $news->url; ?>"><?php echo $news->title; ?></a>
                   </h3>
                   <p><?php echo $news->description; ?></p>
                   <img src="<?php echo $news->image; ?>" alt="News related image">
               </article>
               <?php
           }
       } else {
           echo '<p>No pets news found.</p>';
       }
   ?>
</div>
<!-- End of News Section -->

</body>
</html>