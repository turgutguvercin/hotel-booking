<?php

ini_set("session.save_path", "/home/sessionData");
session_start();

require_once('functions.php');


if (isset($_SESSION['Login']) && $_SESSION['Login']) {
    
echo makePageStart("My Bookings", "assets/stylesheets/book.css");
// Session will be terminated after 1000 seconds.
    if ($_SESSION['timeout'] + 1000 < time()) {
        $_SESSION = array();
        session_destroy();
    } else {
        $userName = $_SESSION['Username'];
        $userID = $_SESSION['UserID'];
        echo makeNavBar(array(
            'index.php' => '<i class="fab fa-earlybirds"></i> Pigeon.com',
            'index.php ' => '<i class="fas fa-home"></i> Home',
            'accommodationList.php' => ' <i class="fas fa-hotel"></i> Hotels',
            '#' => '<div class="dropdown" id="dropdown"><i class="fas fa-user fa"></i>  '.$_SESSION['Username'].'  <i class="fas fa-chevron-circle-down"></i></div>'));
        
    }

$conn = getConnection();
$sql = "SELECT reservations.reservation_id, reservations.start_date,reservations.end_date,reservations.num_guests,accommodation.accommodation_name,accommodation.price
    FROM reservations 
    INNER JOIN accommodation ON accommodation.accommodationID = reservations.accommodationID 
    WHERE customerID=?";
    if ($stmt = mysqli_prepare($conn, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);
        $queryresult = mysqli_stmt_get_result($stmt);
        		
		if (!$queryresult) {
			echo "<p>Error: " . mysqli_stmt_error($stmt) . "</p>";
		}
	  mysqli_close($conn);
    }
    else {
        echo "Could not prepare statement";
      }
    

  
    echo startMain();
    echo "
    <h2>My Reservations</h2>
    <table>
    <tr>
    <th>Hotel Name</th>
    <th>Check-in Date</th>
    <th>Check-out Date</th>
    <th>Number of Guests</th>
    <th>Total Price Per Day</th> 
    <th>Cancel</th> 
    ";


    if ($queryresult) {
        while ($currentrow = mysqli_fetch_assoc($queryresult)) {
            $startDate = filter_var($currentrow['start_date'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
            $startDate = filter_var($currentrow['start_date'], FILTER_SANITIZE_SPECIAL_CHARS); 
            $endDate= filter_var($currentrow['end_date'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
            $endDate= filter_var($currentrow['end_date'], FILTER_SANITIZE_SPECIAL_CHARS); 
            $accommodationName = filter_var($currentrow['accommodation_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
            $accommodationName = filter_var($currentrow['accommodation_name'], FILTER_SANITIZE_SPECIAL_CHARS); 
            $accommodationPrice = $currentrow['price'];
            $numberOfGuests = $currentrow['num_guests'];
            $startDate = explode(" ", $startDate);
            $endDate = explode(" ", $endDate);

            echo " <tr>
            <td>$accommodationName</td>
            <td>$startDate[0]</td>
            <td>$endDate[0]</td>
            <td>$numberOfGuests</td>
            <td>" . floatval($accommodationPrice) * floatval($numberOfGuests) . "</td>
            <td>
                <form method='post' action='cancelBooking.php'>
                    <input type='hidden' name='reservation_id' value='$reservationId'>
                    <input id='myBookings' type='submit' value='Cancel'>
                </form>
            </td>
            </tr>";
        }
    }

    echo "</table>";
    echo endMain();
    echo makePageEnd();
} else {
    echo "You need to login first!<br>";
    echo "You will be redirected to sign in page in <span id = 'timeLeft' >5</span> second(s).";
    header('Refresh: 5; URL=./customerSignIn.php');
}

?>


<script>

document.getElementById("dropdown").innerHTML +=  '<div class="dropdown-content"><a href="logoutProcess.php">Sign out <i class="fas fa-sign-out-alt"></i></a><a href="myBookings.php">My Bookings</a></div>'; 

</script>