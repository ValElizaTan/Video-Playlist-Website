document.getElementById("createaccount").addEventListener("submit", function (event) {
    if (!validateForm()) {  // if the validation of the form fails, we will not submit the form.                             
        event.preventDefault(); // prevents the form from submitting.
    }
    else {
        if (!confirm("Confirm Submission of Signup form?")) { // if form not confirmed to submit , we will not submit the form         
            event.preventDefault(); // prevents the form from submitting.
        }
    }
    // if we get to this line, the form will be ok to be submitted to server
});

function validateForm() {
    var formOK = true;
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var pwd = document.getElementById("pwd").value;


    // clear and hide any error messages before we validate [again] (could be a re-validation attempt)
    clearErrorMsgs();

    // username field validations
    if (name.length == 0) {
        formOK = false;
        showError(document.getElementById("name_err"), "Please enter a Username.");
    } else
        if (!validateName(name)) {
            formOK = false;
            showError(document.getElementById("name_err"), "Name must contain only alphabets");
        }

    // email field validations
    if (email.length == 0) {
        formOK = false;
        showError(document.getElementById("email_err"), "Please enter an Email Address.");
    }
    else if (!validateEmail(email)) {
        formOK = false;
        showError(document.getElementById("email_err"), "Please enter a valid Email Address.");
    }

    // Password field validations
    if (pwd.length == 0) {
        formOK = false;
        showError(document.getElementById("pwd_err"), "Please enter a Password.");
    }
    else if (pwd.length < 8) {
        formOK = false;
        showError(document.getElementById("pwd_err"), "Password must at least 8 characters long.");
    }
    else if (pwd.length > 16) {
        formOK = false;
        showError(document.getElementById("pwd_err"), "Password cannot be more than 16 characters.");
    }
    else if (!checkPasswordMatch(pwd)) {
        formOK = false;
        showError(document.getElementById("cfmpwd_err"), "Passwords does not match!");
    }

    return formOK;

}

function validateName(str) {
    let pattern = /^[a-zA-Z\s]+$/; // must contain small cap or large caps or space
    return pattern.test(str); // using regex check that all characters are letters/space in the string.
}

function validateEmail(str) {
    // using regex again to validate email address: go to https://regexr.com/ and see the meaning of this regex expression below
    return /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(str);
}

// clears the error messages
function clearErrorMsgs() {
    document.getElementById("name_err").innerHTML = "";
    document.getElementById("name_err").style.display = "none";
    document.getElementById("email_err").innerHTML = "";
    document.getElementById("email_err").style.display = "none";
    document.getElementById("pwd_err").innerHTML = "";
    document.getElementById("pwd_err").style.display = "none";
}

function showError(element, msg) {
    element.style.display = "block"; // set the element to be visible
    element.innerHTML = msg; // set the error message in the HTML element
}

//check confirm password
function checkPasswordMatch() {
    var checkOK = true;
    var password = $("#pwd").val();
    var confirmPassword = $("#cfmpwd").val();
    if (password != confirmPassword) {
        $("#cfmpwd_err").html("Passwords does not match!");
        checkOK = false;
    }
    else
        $("#cfmpwd_err").html("Passwords match.");

    return checkOK;
}
$(document).ready(function () {
    $("#cfmpwd").keyup(checkPasswordMatch);
});


