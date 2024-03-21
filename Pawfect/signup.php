<?php

session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];

    if (!empty($fname) && !empty($lname) && !empty($gender) && !empty($city) && !empty($email) && !empty($password) && !is_numeric($fname)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["message"=>"Invalid email format!"]);
            exit();
        } else if ($password != $confirm_password) {
            echo json_encode(["message"=>"Password and Confirm Password do not match!"]);
            exit();
        }

        $existing_email_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($con, $existing_email_query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo json_encode(["message"=>"$email already exists!"]);
            exit();
        }
        
        $user_id = random_num(20); // potential function you've written
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $time = time();
        $default_user_image = $time."blank.png";

        $isImageCopied = copy("pictures/blank.png", "uploads/".$default_user_image);

        $status = "Offline";
        
        $stmt = $con->prepare("INSERT INTO users (user_id, fname, lname, gender, city, email, password, user_image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssss', $user_id, $fname, $lname, $gender, $city, $email, $hashedPassword, $default_user_image, $status); 
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            // Redirect to login.php on successful registration
            echo json_encode(["redirect" => "login.php"]);
            exit();
        } else {
            echo json_encode(["message" => "Failed to register, try again!"]);
            exit();
        }
    } 
    echo json_encode(["message"=>"Please enter some valid information!"]);
    exit();
}
?>



<?php include_once "html/header2.html"; ?>
<body>

    <div class="box">
        <section class="form signup">
        <div class="title">Signup</div>
        <form method="post">
            <div class="error-txt"></div>
            <div class="user-details">
                <div class="name-details">
                <div class="input-box">
                        <span class="details">First Name</span>
                        <input name="fname" placeholder="First Name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input name="lname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span id="password-visibility-icon" onclick="togglePasswordVisibility()"> <i class="fa fa-eye"></i> </span>
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    <span id="confirm-password-visibility-icon" onclick="toggleConfirmPasswordVisibility()"> <i class="fa fa-eye"></i> </span>
                </div>
            </div>
            <div class="gender-details">
                <span class="gender-title">Gender</span>
                <p></p>
                <div class="category">
                    <label for="dot-1">
                        <input type="radio" id="dot-1" name="gender" value="male">
                        <span class="dot"></span>
                        <span class="gender">Male</span>
                    </label>
                    <label for="dot-2">
                        <input type="radio" id="dot-2" name="gender" value="female">
                        <span class="dot"></span>
                        <span class="gender">Female</span>
                    </label>
                    <label for="dot-3">
                        <input type="radio" id="dot-3" name="gender" value="not-specified">
                        <span class="dot"></span>
                        <span class="gender">Prefer not to say</span>
                    </label>
                </div>
            </div>
            <div class="input-box">
    <span class="details">City</span>
    <select id="city" name="city" required onchange="checkOther(this.value)">
        <option value="">--Select City--</option>
        <option value="Quezon city">Quezon City</option>
        <option value="Manila">Manila</option>
        <option value="Makati">Makati</option>
        <option value="Caloocan city">Caloocan City</option>
        <option value="Marikina city">Marikina City</option>
        <option value="Mandaluyong city">Mandaluyong City</option>
        <option value="Muntinlupa city">Muntinlupa City</option>
        <option value="Navotas city">Navotas City</option>
        <option value="Malabon city">City of Malabon</option>
        <option value="Valenzuela city">Valenzuela City</option>
        <option value="Pasay city">Pasay City</option>
        <option value="Pasig city">Pasig City</option>
        <option value="Parañaque city">Parañaque City</option>
        <option value="San Juan city">City of San Juan</option>
        <option value="Las Piñas city">Las Piñas City</option>
        <option value="Taguig city">Taguig City</option>
        <option value="other">Other..</option>
    </select>
    <div id="other-city" style="display: none;">
        <span class="details">Please specify:</span>
        <input id="other-city-input" type="text" name="other-city"/>
    </div>
</div>
            <div class="button">
                <input type="submit" value="Signup">
            </div>
            <div class="login-link">
                <span class="text">Already Have an Account?</span>
                <a href="login.php">Login</a>
            </div>
        </form>
        </section>
        <script>
document.querySelector('.form.signup form').addEventListener('submit', e => {
    e.preventDefault();
    fetch('signup.php', {
        method: 'POST', 
        body: new FormData(e.target)
    })
    .then(response => {
        if(response.ok) {
            return response.json(); // Parse JSON response
        } else {
            throw new Error('Network response was not ok.');
        }
    })
    .then(data => {
        if (data.redirect) {
            window.location.href = data.redirect; // Redirect to login.php
        } else {
            let errorText = document.querySelector('.error-txt');
            errorText.style.display = 'block';
            errorText.textContent = data.message; // Display error message
        }
    })
    .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
        let errorText = document.querySelector('.error-txt');
        errorText.style.display = 'block';
        errorText.textContent = 'An unexpected error occurred, please try again later!';
    });
});
</script>
        <script >
            
var password = document.getElementById("password");
var confirm_password = document.getElementById("confirm_password");
var passwordEyeIcon = document.getElementById("password-eye-icon");
var confirmPasswordEyeIcon = document.getElementById("confirm-password-eye-icon");

function togglePasswordVisibility() {
    if (password.type === "password") {
        password.type = "text";
        passwordEyeIcon.classList.remove("fa-eye");
        passwordEyeIcon.classList.add("fa-eye-slash");
    } else {
        password.type = "password";
        passwordEyeIcon.classList.remove("fa-eye-slash");
        passwordEyeIcon.classList.add("fa-eye");
    }
}

            function toggleConfirmPasswordVisibility() {
    if (confirm_password.type === "password") {
        confirm_password.type = "text";
        confirmPasswordEyeIcon.classList.remove("fa-eye");
        confirmPasswordEyeIcon.classList.add("fa-eye-slash");
    } else {
        confirm_password.type = "password";
        confirmPasswordEyeIcon.classList.remove("fa-eye-slash");
        confirmPasswordEyeIcon.classList.add("fa-eye");
    }
}

// Call the function to set the initial state to hidden
password.type = "password";
confirm_password.type = "password";

function checkOther(value) {
    const otherCityDiv = document.getElementById('other-city');
    if(value === 'other'){
        otherCityDiv.style.display = 'block';
    } else {
        otherCityDiv.style.display = 'none';
    }
}
        </script>
    </div>

</body>
</html>