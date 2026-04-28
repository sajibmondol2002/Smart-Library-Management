<?php
require '../control/reg_control.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
    <script src="../js/signup.js"></script>
</head>

<body>
<?php include 'header.php';?>
<div class="container">
    <h1>Admin Registration</h1>
    <hr>

    <form action="../control/reg_control.php" method="post" enctype="multipart/form-data" onsubmit="return validation()">
        <table>
           
            <tr>
                <td>Full Name:</td>
                <td><input type="text" id="full_name" name="full_name" class="form-input"></td>
                <td><span class="error-message" id="full_name_error"></span></td>
            </tr>

            
            <tr>
                <td>Username:</td>
                <td><input type="text" id="username" name="username" class="form-input"></td>
                <td><span class="error-message" id="username_error"></span></td>
            </tr>

       
            <tr>
                <td>Email Address:</td>
                <td><input type="text" id="email" name="email" class="form-input"></td>
                <td><span class="error-message" id="email_error"></span></td>
            </tr>

           
            <tr>
                <td>Phone Number:</td>
                <td><input type="text" id="phone_number" name="phone_number" class="form-input"></td>
                <td><span class="error-message" id="phone_error"></span></td>
            </tr>

           
            <tr>
                <td>Password:</td>
                <td><input type="password" id="password" name="password" class="form-input"></td>
                <td><span class="error-message" id="password_error"></span></td>
            </tr>

            
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" id="confirm_password" name="confirm_password" class="form-input"></td>
                <td><span class="error-message" id="confirm_password_error"></span></td>
            </tr>

            <tr>
                <td>Role:</td>
                <td>
                    <select id="role" name="role" class="form-input">
                        <option value="">Select Role</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="system_admin">System Admin</option>
                    </select>
                </td>
                <td><span class="error-message" id="role_error"></span></td>
            </tr>

           
            <tr>
                <td>Employee ID:</td>
                <td><input type="text" id="employee_id" name="employee_id" class="form-input"></td>
                <td><span class="error-message" id="employee_id_error"></span></td>
            </tr>

            
            <tr>
                <td>Address:</td>
                <td><input type="text" id="address" name="address" class="form-input"></td>
                <td><span class="error-message" id="address_error"></span></td>
            </tr>

            
            <tr>
                <td>Security Question:</td>
                <td>
                    <select id="security_question" name="security_question" class="form-input">
                        <option value="">Select a security question</option>
                        <option value="pet_name">What is your pet's name?</option>
                        <option value="school_name">What is the name of your first school?</option>
                        <option value="birth_city">In which city were you born?</option>
                    </select>
                </td>
                <td><span class="error-message" id="security_question_error"></span></td>
            </tr>

          
            <tr>
                <td>Profile Picture:</td>
                <td><input type="file" id="profile_picture" name="profile_picture" class="form-input"></td>
                <td><span class="error-message" id="profile_picture_error"></span></td>
            </tr>

            
            <tr>
                <td>Default Language:</td>
                <td>
                    <select id="default_language" name="default_language" class="form-input">
                        <option value="">Select Language</option>
                        <option value="english">English</option>
                        <option value="spanish">Spanish</option>
                        <option value="french">French</option>
                    </select>
                </td>
                <td><span class="error-message" id="default_language_error"></span></td>
            </tr>

           
            <tr>
                <td>Time Zone:</td>
                <td>
                    <select id="time_zone" name="time_zone" class="form-input">
                        <option value="">Select Time Zone</option>
                        <option value="gmt">GMT</option>
                        <option value="est">EST</option>
                        <option value="pst">PST</option>
                    </select>
                </td>
                <td><span class="error-message" id="time_zone_error"></span></td>
            </tr>

           
            <tr>
                <td colspan="2" class="form-buttons">
                    <input type="reset" name="reset" class="btnShape btnReset" value="Reset">
                    <input type="submit" name="submit" class="btnShape btnSubmit" value="Submit">
                </td>
            </tr>
        </table>
    </form>
</div>
<script src="../js/signup.js"></script>
<?php include 'footer.php';?>
</body>
</html>