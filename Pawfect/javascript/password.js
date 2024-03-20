
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

