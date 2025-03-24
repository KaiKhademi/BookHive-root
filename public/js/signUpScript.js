

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signup-form");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const dob = document.getElementById("dob");
    const emailError = document.getElementById("email-error");
    const passwordError = document.getElementById("password-error");
    const usernameError = document.getElementById("username-error");
    const dobError = document.getElementById("dob-error");


    form.addEventListener("submit", function (event) {
        if(validateEmail(email.value) === false || email.value.length === 0) {
            event.preventDefault();
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
            event.preventDefault();
            password.classList.add("error");
            passwordError.textContent = "Please enter a password";
            passwordError.style.display = "flex";
        }
        else {
            password.classList.remove("error");
            passwordError.textContent = "";
            passwordError.style.display = "none";
        }
        if(username.value.length === 0){
            event.preventDefault();
            username.classList.add("error");
            usernameError.textContent = "Please enter a username";
            usernameError.style.display = "flex";
        }
        else {
            username.classList.remove("error");
            usernameError.textContent = "";
            usernameError.style.display = "none";
        }
        if(dob.value === null){
            event.preventDefault();
            dob.classList.add("error");
            dobError.textContent = "Please enter your date of birth";
            dobError.style.display = "flex";
        }
        else {
            dob.classList.remove("error");
            dobError.textContent = "";
            dobError.style.display = "none";
        }
        if(isValidDOB(dob.value) === false ){
            event.preventDefault();
            dob.classList.add("error");
            dobError.textContent = "Please enter a valid date of birth";
            dobError.style.display = "flex";
        }
        else {
            dob.classList.remove("error");
            dobError.textContent = "";
            dobError.style.display = "none";
        }

    });
});


function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidDOB(dob) {
    const dobPattern = /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/;

    if (!dobPattern.test(dob)) {
        return false;
    }

    const [year, month, day] = dob.split("-").map(Number);

    const date = new Date(year, month - 1, day);

    return (
        date.getFullYear() === year &&
        date.getMonth() + 1 === month &&
        date.getDate() === day
    );
}