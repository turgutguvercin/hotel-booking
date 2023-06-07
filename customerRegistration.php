<?php
require_once('functions.php');
echo makePageStart("Register","assets/stylesheets/register.css");
echo makeNavBar(array('index.php' => '<i class="fab fa-earlybirds"></i> Pigeon.com',
'index.php ' => '<i class="fas fa-home"></i> Home',
'customerSignIn.php' => '<i class="fas fa-sign-in-alt"></i> Log In'));
echo startMain();
?>

<div>
    <h2>Create Account</h2>
    <form action="registrationProcess.php" method="POST">
    

    <br>
    <label for="name">Name</label>
    <input type="text" name="name" required>
    <br>

    <label for="">Family Name</label>
    <input type="text" name="familyName" required>
    <br>

    <label for="userName">Username</label>
    <input type="text" name="userName" id="" required>
    <br>

    <label for="password">Password</label>
    <input id='password' type="password" name="password"  required>
    <br>
    <label for="password">Re-enter password</label>
    <input id='password_confirm' type="password" name="password"  required>
    <br>

    <label for="date">Date of Birth</label>
    <input type="date" name="date" required>
    <br>

    <label for="addressLine1">Address Line 1</label>
    <input type="text" name="addressLine1" required>
    <br>

    <label for="addressLine2">Address Line 2</label>
    <input type="text" name="addressLine2">
    <br>

    <label for="postCode">Postcode</label>
    <input type="text" name="postCode">
    <br>
    
    <input  id='submit-button' type='submit' value='Submit' >
    <br>
    </form>
    <p>By creating account you agree to <a href="#">terms & conditions</a>.</p>
    <br>
    <hr>
    <br>
    <p>Already have an account?<a href="customerSignIn.php"> Click here to sign in.</a></p>
</div>

<?php

echo endMain();
echo makeFooter();



?>

<script >

    //Password validation
    var password = document.getElementById("password");
    var passwordConfirm = document.getElementById('password_confirm');
    passwordConfirm.addEventListener('change', () => {
        if (password.value != document.getElementById('password_confirm').value) {
            password.setCustomValidity('Passwords do not match.');
        } else {

            password.setCustomValidity('');
        }

    });



</script>