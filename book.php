<?php

ini_set("session.save_path", "/home/sessionData");
session_start();

require_once('functions.php');


$hotelName = array_key_exists('hotelname', $_REQUEST) ? $_REQUEST['hotelname'] : null;
$hotelID = array_key_exists('hotelID', $_REQUEST) ? $_REQUEST['hotelID'] : null;



if (isset($_SESSION['Login']) && $_SESSION['Login']) {  
// Session will be terminated after 1000 seconds.
    if ($_SESSION['timeout'] + 1000 < time()) {

        session_destroy();
        header("Refresh:0");
    } 
    else {
        echo makeNavBar(array(
            'index.php' => '<i class="fab fa-earlybirds"></i> Pigeon.com',
            'index.php ' => '<i class="fas fa-home"></i> Home',
            'accommodationList.php' => ' <i class="fas fa-hotel"></i> Hotels',
            '#' => '<div class="dropdown" id="dropdown"><i class="fas fa-user fa"></i>  ' . $_SESSION['Username'] . '  <i class="fas fa-chevron-circle-down"></i></div>
        <div class="dropdown-content"><a href="logoutProcess.php">Sign out <i class="fas fa-sign-out-alt"></i></a><a href="myBookings.php">My Bookings</a></div>'
        ));
        $userName = $_SESSION['Username'];
        $userID = $_SESSION['UserID'];
    }
    echo makePageStart("Test", "assets/stylesheets/book.css");
    echo startMain();

    echo "
    
    <form action='bookProcess.php' method = 'GET'>
        <h2>Book Now</h2>
        <br>
        <label>User</label>
        <input type='text' value='$userName' name = 'userName' disabled >
        <input type='text' value='$userName' name = 'userName' hidden >
        <input type='text' value='$userID' name = 'userID' hidden >
        
        <br>
        <label>Hotel Name </label>
        <input type='text' value='$hotelName' name = 'hotelName' disabled >
        <input type='text' value='$hotelName' name = 'hotelName' hidden >
        <input type='text' value='$hotelID' name = 'hotelID' hidden >
        <br>
        <label>Start Date:</label>
        <input type='date' id='startDate' name='startDate' min='2022-01-01' required>
        <br>
        <label>End Date:</label>
        <input type='date' id='endDate' name='endDate' min='2022-01-01' required>
        <br>
        <label>Number of Guests</label>
        <select name='numberOfGuest'>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
        </select>
        <br>

        <input type='submit' value='Submit'>

        
    </form>
    ";
    echo endMain();
    echo makePageEnd();
} 
else {
    echo "You need to login first!<br>";
    echo "You will be redirected to sign in page in <span id = 'timeLeft' >5</span> second(s).";
    header('Refresh: 5; URL=./customerSignIn.php');
}

?>


<script>

// Counter For Time 
var timeleft = 5;
var downloadTimer = setInterval(function() {
    if (timeleft <= 0) {
        clearInterval(downloadTimer);
    }
    document.getElementById("timeLeft").textContent = timeleft;
    timeleft -= 1;
}, 1000);





// To prevent booking for past days

var today = new Date().toISOString().split('T')[0];
document.getElementsByName("startDate")[0].setAttribute('min', today);
var start = document.getElementById("startDate");
var end = document.getElementById("endDate");

console.log(start);
start.addEventListener('input', () => {
    var input = document.getElementById("startDate").value;
    console.log(document.getElementsByName("endDate")[0]);
    console.log(input);
    const start = new Date(Date.parse(document.getElementById("startDate").value));
    start.setDate(start.getDate() + 1)
    const end = start.toISOString().split('T')[0];
    console.log(end);
    document.getElementsByName("endDate")[0].setAttribute('min', end);
});
</script>