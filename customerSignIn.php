<?php
require_once('functions.php');
echo makePageStart("Sign-in", "assets/stylesheets/sign-in.css");

echo makeNavBar(array(
    'index.php' => '<i class="fab fa-earlybirds"></i> Pigeon.com',
    'index.php ' => '<i class="fas fa-hotel"></i> Home',
    'customerRegistration.php' => 'Sign Up'
));

echo startMain();
?>

<div>
    <h2>Sign In</h2>
    <br>

    <form action="signInProcess.php" method="POST">
        <label for="">Username</label>
        <input type="text" name="username">
        <br>

        <label for="">Password</label>
        <input type="password" name="password">
        <br>

        <input id='submit-button' type='submit' value='Sign-in'>
        <br>
    </form>
    <p>By signing-in you agree to <a href="#">terms & conditions</a>.</p>
    <br>
    <hr>
    <br>
    <p>To create an account <a href="customerRegistration.php"> click here.</a></p>


</div>

<?php

echo endMain();
echo makeFooter();
echo"</body>";


?>