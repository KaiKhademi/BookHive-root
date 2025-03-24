console.log("sag");

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signin-form");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const emailError = document.getElementById("email-error");
    const passwordError = document.getElementById("password-error");
    console.log(form);

    form.addEventListener("submit", function (event) {
        console.log("hi");
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
            console.log("Hi1");
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
            console.log("hi2");
        }
    });
});


function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
