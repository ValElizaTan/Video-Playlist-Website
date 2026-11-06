document.getElementById("contactform").addEventListener("submit", function(event){
    if (!validateForm()) {  // if the validation of the form fails, we will not submit the form.                             
        event.preventDefault(); // prevents the form from submitting.
    }
    else {
      if (!confirm("Confirm Submission of Feedback Form?")) { // if form not confirmed to submit , we will not submit the form         
        event.preventDefault(); // prevents the form from submitting.
      }
    }
    // if we get to this line, the form will be ok to be submitted to server
});

function validateForm(){
    var formOK = true;
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var mobile = document.getElementById("mobile").value;
    var comments = document.getElementById("comments").value;

    // clear and hide any error messages before we validate [again] (could be a re-validation attempt)
    clearErrorMsgs();

    // name field validations
    if (name.length==0){
        formOK=false;
        showError(document.getElementById("name_err"),"Please enter a name.");
    } else
    if (!validateName(name)) {
        formOK=false;
        showError(document.getElementById("name_err"),"Name must contain only alphabets");
    }
    
    // email field validations
    if (email.length==0){
        formOK=false;
        showError(document.getElementById("email_err"),"Please enter an email address.");
    } else
    if (!validateEmail(email))
    {
        formOK=false;
        showError(document.getElementById("email_err"),"Please enter a valid email address.");
    }

    // mobile field validations
    if (mobile.length==0){
        formOK=false;
        showError(document.getElementById("mobile_err"),"Please enter a mobile number.");
    } else
    if (!validateMobile(mobile)) {
        formOK=false;
        showError(document.getElementById("mobile_err"),"Mobile number must be 8 digits.");
    }

    // comments field validations
    if (comments.length==0){
        formOK=false;
        showError(document.getElementById("comments_err"),"Comments must not be empty.<br>Please enter some comments.");
    }    
    return formOK;
}

function validateName(str) { 
    let pattern = /^[a-zA-Z\s]+$/; // must contain small cap or large caps or space
    return pattern.test(str); // using regex check that all characters are letters/space in the string.
}

function validateMobile(str) {
    // a shorter way to test regex
    return /^\d{8}$/.test(str); // using regex to ensure all 8 characters in string are numbers.
}

function validateEmail(str){
    // using regex again to validate email address: go to https://regexr.com/ and see the meaning of this regex expression below
    return /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(str);
}

// clears the error messages
function clearErrorMsgs(){    
    document.getElementById("name_err").innerHTML="";
    document.getElementById("name_err").style.display="none";
    document.getElementById("email_err").innerHTML="";
    document.getElementById("email_err").style.display="none";
    document.getElementById("mobile_err").innerHTML="";
    document.getElementById("mobile_err").style.display="none";
    document.getElementById("comments_err").innerHTML="";
    document.getElementById("comments_err").style.display="none";
}

function showError(element,msg) {
    element.style.display="block"; // set the element to be visible
    element.innerHTML=msg; // set the error message in the HTML element
}