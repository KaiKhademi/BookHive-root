

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signin-form");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const emailError = document.getElementById("email-error");
    const passwordError = document.getElementById("password-error");


    form.addEventListener("submit", function (event) {
        event.preventDefault();
        if(validateEmail(email.value) === false || email.value.length === 0) {
            email.classList.add("error");
            emailError.textContent = "Please enter a valid email";
            emailError.style.display = "flex";
        }
        else {
            email.classList.remove("error");
            emailError.textContent = "";
            emailError.style.display = "none";
        }
        if(password.value.length === 0){
            password.classList.add("error");
            passwordError.textContent = "Please enter a password";
            passwordError.style.display = "flex";
        }
        else {
            password.classList.remove("error");
            passwordError.textContent = "";
            passwordError.style.display = "none";
        }
    });
});


function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
