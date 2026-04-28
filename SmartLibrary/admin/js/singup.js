// Full Name Validation
function validateFullName() {
    var fullName = document.getElementById("full_name").value;
    var nameRegex = /^[a-zA-Z\s._-]+$/;

    if (fullName === "" || !nameRegex.test(fullName)) {
        document.getElementById("full_name_error").innerHTML = "Enter a valid full name (letters and spaces only).";
        return false;
    } else {
        document.getElementById("full_name_error").innerHTML = "";
        return true;
    }
}

// Username Validation
function validateUsername() {
    var username = document.getElementById("username").value;
    if (username.length < 4) {
        document.getElementById("username_error").innerHTML = "Username must be at least 4 characters.";
        return false;
    } else {
        document.getElementById("username_error").innerHTML = "";
        return true;
    }
}

// Email Validation
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

// Phone Number Validation
function validatePhoneNumber() {
    var phoneNumber = document.getElementById("phone_number").value;
    var phoneRegex = /^[0-9]{11}$/;
    if (phoneNumber === "" || !phoneRegex.test(phoneNumber)) {
        document.getElementById("phone_error").innerHTML = "Enter a valid 11-digit phone number.";
        return false;
    } else {
        document.getElementById("phone_error").innerHTML = "";
        return true;
    }
}

// Password Validation
function validatePassword() {
    var password = document.getElementById("password").value;
    var passwordRegex = /[@#$&]/;
    if (password.length < 6) {
        document.getElementById("password_error").innerHTML = "Password must be at least 6 characters long.";
        return false;
    } else if (!passwordRegex.test(password)) {
        document.getElementById("password_error").innerHTML = "Password must contain at least one special character (@, #, $, &).";
        return false;
    } else {
        document.getElementById("password_error").innerHTML = "";
        return true;
    }
}

// Confirm Password Validation
function validateConfirmPassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    if (confirmPassword !== password) {
        document.getElementById("confirm_password_error").innerHTML = "Passwords do not match.";
        return false;
    } else {
        document.getElementById("confirm_password_error").innerHTML = "";
        return true;
    }
}

// Role Validation
function validateRole() {
    var role = document.getElementById("role").value;
    if (role === "") {
        document.getElementById("role_error").innerHTML = "Please select a role.";
        return false;
    } else {
        document.getElementById("role_error").innerHTML = "";
        return true;
    }
}

// Employee ID Validation
function validateEmployeeId() {
    var employeeId = document.getElementById("employee_id").value;
    if (employeeId === "") {
        document.getElementById("employee_id_error").innerHTML = "Employee ID is required.";
        return false;
    } else {
        document.getElementById("employee_id_error").innerHTML = "";
        return true;
    }
}

// Security Question Validation
function validateSecurityQuestion() {
    var securityQuestion = document.getElementById("security_question").value;
    if (securityQuestion === "") {
        document.getElementById("security_question_error").innerHTML = "Please select a security question.";
        return false;
    } else {
        document.getElementById("security_question_error").innerHTML = "";
        return true;
    }
}

// Profile Picture Validation
function validateProfilePicture() {
    var profilePicture = document.getElementById("profile_picture").value;
    if (profilePicture === "") {
        document.getElementById("profile_picture_error").innerHTML = "Please upload a profile picture.";
        return false;
    } else {
        document.getElementById("profile_picture_error").innerHTML = "";
        return true;
    }
}

// Language Validation
function validateLanguage() {
    var language = document.getElementById("default_language").value;
    if (language === "") {
        document.getElementById("default_language_error").innerHTML = "Please select a default language.";
        return false;
    } else {
        document.getElementById("default_language_error").innerHTML = "";
        return true;
    }
}

// Time Zone Validation
function validateTimeZone() {
    var timeZone = document.getElementById("time_zone").value;
    if (timeZone === "") {
        document.getElementById("time_zone_error").innerHTML = "Please select a time zone.";
        return false;
    } else {
        document.getElementById("time_zone_error").innerHTML = "";
        return true;
    }
}

// Form Validation
function validation() {
    return validateFullName() && validateUsername() && validateEmail() && validatePhoneNumber() &&
           validatePassword() && validateConfirmPassword() && validateRole() &&
           validateEmployeeId() && validateSecurityQuestion() && validateProfilePicture() &&
           validateLanguage() && validateTimeZone();
}
