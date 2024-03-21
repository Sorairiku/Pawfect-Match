<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password) && !is_numeric($email)) {
        // Read user data from the database
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            // Verify the entered password with the hashed password
            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['user_id'];

                // Update status to 'Active'
                $update_query = "UPDATE users SET status = 'Active now' WHERE user_id = '{$user_data['user_id']}'";
                mysqli_query($con, $update_query);

                // Check if it's the user's first login
                if ($user_data['first_login'] == 0) {
                    // Redirect to choice.php for first-time login
                    header("Location: choice.php");
                } else {
                    // Redirect to index.php for subsequent logins
                    header("Location: index.php");
                }

                $new_first_login_value = $user_data['first_login'] + 1;
                $update_query = "UPDATE users SET first_login = '$new_first_login_value' WHERE user_id = '{$user_data['user_id']}'";
                mysqli_query($con, $update_query);

                exit();
            } else {
                echo "Wrong email or password!";
            }
        } else {
            echo "User not found!";
        }
    } else {
        echo "Please enter both email and password!";
    }
}
?>
<?php include_once "html/header2.html"; ?>
<body>

<div class="box">
<div class="title">Login</div>
    <form method="post">
        <div class="error-txt">This is an error message!</div>
        <div class="user-details">
            <div class="input-box">
                <span class="details">Email</span>
                <input id="text" type="text" name="email" placeholder="Enter Email">
            </div>
            <div class="input-box">
        <span class="details">Password</span>
        <input id="password" type="password" name="password" placeholder="Enter Password">
        <i class="fas fa-eye" id="password-eye-icon" onclick="togglePasswordVisibility()"></i>
    </div>

        </div>
        <div class="button" >
            <input type="submit" value="Login">
        </div>
        
        <div class="signup-link">
            <span class="text">Don't Have an Account?</span>
            <a href="signup.php">Signup</a>
        </div>
    </form>
</div>


<script src="javascript/password.js"></script>

</body>
</html>
