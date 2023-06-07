<?php
ini_set("session.save_path", "/home/sessionData");
session_start();
require_once("functions.php");
echo makePageStart("Rooms", "assets/stylesheets/accommodationList.css");

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
            'index.php ' => '<i class="fas fa-home"></i>  Home',
            'accommodationList.php' => '<i class="fas fa-hotel"></i>  Hotels',
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

echo startMain();

?>

<div class = 'searchBar'>
    <form action="search.php" method="REQUEST">
    <input name='search-input' id='search' type="text" placeholder="Search...Hotel, City">
    <span></span>
    <button id="search-submit" type="submit"><i class="fa fa-search"></i></button>
    </form>

</div>
<div class="list">
    <?php

    $conn = getConnection();
    $sql = "SELECT * FROM accommodation";
    $queryresult = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    while ($row = mysqli_fetch_assoc($queryresult)) {
        $accommodationName = filter_var($row['accommodation_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $accommodationName = filter_var($row['accommodation_name'], FILTER_SANITIZE_SPECIAL_CHARS); 
        $description  = filter_var($row['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $description  = filter_var($row['description'], FILTER_SANITIZE_SPECIAL_CHARS); 
        $price = $row['price'];
        $location = $row['location'];
        $image_1 = $row['image_1'];
        echo makeHotelCard($accommodationName, $description, $price, $location, $image_1);
    }
    mysqli_free_result($queryresult); 
    mysqli_close($conn);

    ?>
</div>


<?php

echo endMain();
echo makeFooter();

?>


<script>

//Since nested tags are not possible added them using JS. 
document.getElementById("dropdown").innerHTML +=  '<div class="dropdown-content"><a href="logoutProcess.php">Sign out <i class="fas fa-sign-out-alt"></i></a><a href="myBookings.php">My Bookings</a></div>'; 

</script>