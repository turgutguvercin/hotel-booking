<?php
ini_set("session.save_path", "/home/sessionData");
session_start();

require_once("functions.php");
echo makePageStart("Home","assets/stylesheets/index.css");

if (isset($_SESSION['Login']) && $_SESSION['Login']) {
// Session will be terminated after 1000 seconds.
    if ($_SESSION['timeout'] + 1000 < time()) {
        $_SESSION = array();
        session_destroy();
        header("Refresh:0");
        }

    else{
        echo makeNavBar(array('index.php' => '<i class="fab fa-earlybirds"></i> Pigeon.com',
        'index.php ' => '<i class="fas fa-home"></i> Home',
        'accommodationList.php' => ' <i class="fas fa-hotel"></i> Hotels',
        '#' => '<div class="dropdown" id="dropdown"><i class="fas fa-user fa"></i>  '.$_SESSION['Username'].'  <i class="fas fa-chevron-circle-down"></i></div>'));

    }   
}


else{
    echo makeNavBar(array('index.php' => '<i class="fab fa-earlybirds"></i> Pigeon.com','index.php ' => '<i class="fas fa-home"></i> Home',
    'accommodationList.php' => '<i class="fas fa-hotel"></i> Hotels',
    'customerRegistration.php'=>' Sign Up',
    'customerSignIn.php' => '<i class="fas fa-sign-in-alt"></i> Log In'));
   
}
echo startMain();
?>

<div class="title-introduction-position">
    <h1 class="main-title">WELCOME TO PIGEON.COM</h1>+
    <br>
    <p class="introduction">
            Pigeon.com is a search engine for hotels.You can easily find your ideal hotel and compare prices from different hotels.
            The prices shown come from numerous hotels.
            You can search from a large variety of rooms and locations across the world. Luxury does not need to be expensive. 
            There are various room types and a wide range of facilities for good value for money.
    </p>

</div>
<div class="button-position">
    <a href="accommodationList.php">Explore Rooms</a>
    <a href="#">Contact Us</a>
</div>

 <?php
echo endMain();
echo makeFooter();

?>

<script>
//nested tags
document.getElementById("dropdown").innerHTML +=  '<div class="dropdown-content"><a href="logoutProcess.php">Sign out <i class="fas fa-sign-out-alt"></i></a><a href="myBookings.php">My Bookings</a></div>'; 

</script>