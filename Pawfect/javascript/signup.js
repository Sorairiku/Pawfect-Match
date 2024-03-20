window.addEventListener('DOMContentLoaded', (event) => {
    const form = document.querySelector('.signup form');
    const errorText = document.querySelector('.error-txt');

    form.addEventListener('submit', (e) => {
        e.preventDefault(); 

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "signup.php", true); 

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    errorText.textContent = data;
                    errorText.style.display = "block";

                    if (data === "Registration Successful") {
                        // Redirect to another page
                        window.location.href = "login.php";
                    } 

                } else {
                    console.error('Request failed with status:', xhr.status);
                    // Provide Feedback to the User
                    errorText.textContent = "Error: An unexpected error occurred. Please try again.";
                    errorText.style.display = "block";
                }
            }
        };

        xhr.onerror = () => {
            console.error('Request failed');
            // Provide Feedback to the User
            errorText.textContent = "Error: failed to send the request. Please check your network connection and try again.";
            errorText.style.display = "block";
        };

        let formData = new FormData(form);
        xhr.send(formData); 
    });
});