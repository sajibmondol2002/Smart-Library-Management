
function validateEmail() {
    var email = document.getElementById("email").value;
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (email === "" || !emailRegex.test(email)) {
        document.getElementById("email_error").innerHTML = "Enter a valid email address.";
        return false;
    } else {
        document.getElementById("email_error").innerHTML = "";
        return true;
    }
}


function validateForgotPasswordForm() {
    return validateEmail();
}
