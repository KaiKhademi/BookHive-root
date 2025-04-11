

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("add-thread-form");
    const book_name = document.getElementById("book_name");
    const date = document.getElementById("user_time");
    const content = document.getElementById("message")
    const book_name_error = document.getElementById("name-error");
    const message_error = document.getElementById("message-error");



    form.addEventListener("submit", function (event) {
        if(book_name.value.length === 0) {
            event.preventDefault();
            book_name.classList.add("error");
            book_name_error.textContent = "Please enter name for the book!";
            book_name_error.style.display = "flex";
        }
        else {
            book_name.classList.remove("error");
            book_name_error.textContent = "";
            book_name_error.style.display = "none";
        }

        if(content.value.length === 0) {
            event.preventDefault();
            book_name.classList.add("error");
            book_name_error.textContent = "Please write a thread!";
            book_name_error.style.display = "flex";
        }
        else {
            book_name.classList.remove("error");
            book_name_error.textContent = "";
            book_name_error.style.display = "none";
        }

    });
});
