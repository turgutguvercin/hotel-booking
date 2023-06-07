<?php
ini_set("session.save_path", "/home/unn_w21034972/sessionData");
session_start();

require_once("functions.php");
echo makePageStart("Home", "assets/stylesheets/details.css");

if (isset($_SESSION['Login']) && $_SESSION['Login']) {
// Session will be terminated after 1000 seconds.
    if ($_SESSION['timeout'] + 1000 < time()) {
        $_SESSION = array();
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
    }
} 
else {
    echo makeNavBar(array(
        'index.php' => '<i class="fab fa-earlybirds"></i> Pigeon.com', 'index.php ' => '<i class="fas fa-home"></i> Home',
        'accommodationList.php' => '<i class="fas fa-hotel"></i> Hotels',
        'customerRegistration.php' => ' Sign Up',
        'customerSignIn.php' => '<i class="fas fa-sign-in-alt"></i> Log In'
    ));
}

$conn = getConnection();
$hotelname = $_GET['hotelname'];
$sql = "SELECT * FROM accommodation where accommodation_name = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {

    mysqli_stmt_bind_param($stmt, "s", $hotelname);
    mysqli_stmt_execute($stmt);
    $queryresult = mysqli_stmt_get_result($stmt);
}
if ($queryresult) {
    while ($currentrow = mysqli_fetch_assoc($queryresult)) {
        $id = $currentrow['accommodationID'];
        $name = filter_var($currentrow['accommodation_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $name = filter_var($currentrow['accommodation_name'], FILTER_SANITIZE_SPECIAL_CHARS); 
        $description = $currentrow['description'];
        $price = $currentrow['price'];
        $image = $currentrow['image_1'];
    }
}
mysqli_free_result($queryresult);
mysqli_close($conn);


echo startMain();
echo makeHotelDetails($id, $image, $name, $price, $description);
echo endMain();
echo makeFooter();
?>

<script>
//nested tags
document.getElementById("dropdown").innerHTML +=  '<div class="dropdown-content"><a href="logoutProcess.php">Sign out <i class="fas fa-sign-out-alt"></i></a><a href="myBookings.php">My Bookings</a></div>'; 

</script>