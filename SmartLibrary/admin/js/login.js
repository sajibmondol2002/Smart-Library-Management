// Email Validation
function validateEmail() {
    var email = document.getElementById("email").value.trim();
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (email === "" || !emailRegex.test(email)) {
        document.getElementById("email_error").innerHTML = "Enter a valid email address.";
        return false;
    } else {
        document.getElementById("email_error").innerHTML = "";
        return true;
    }
}

// Password Validation
function validatePassword() {
    var password = document.getElementById("password").value.trim();
    if (password === "") {
        document.getElementById("password_error").innerHTML = "Password cannot be empty.";
        return false;
    } else {
        document.getElementById("password_error").innerHTML = "";
        return true;
    }
}

// Form Validation
function validateLoginForm() {
    var isEmailValid = validateEmail();
    var isPasswordValid = validatePassword();
    
    return isEmailValid && isPasswordValid;
}
