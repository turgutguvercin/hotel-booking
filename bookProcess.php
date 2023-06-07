<?php
require_once("functions.php");
$userName = array_key_exists('userName', $_REQUEST)? $_REQUEST['userName'] : null;
$userID = array_key_exists('userID', $_REQUEST)? $_REQUEST['userID'] : null;
$hotelName= array_key_exists('hotelName', $_REQUEST) ? $_REQUEST['hotelName'] : null;
$hotelID= array_key_exists('hotelID', $_REQUEST) ? $_REQUEST['hotelID'] : null;
$startDate = array_key_exists('startDate', $_REQUEST) ? $_REQUEST['startDate'] : null;
$endDate = array_key_exists('startDate', $_REQUEST) ? $_REQUEST['endDate'] : null;
$numberOfGuest = array_key_exists('numberOfGuest',$_REQUEST)? $_REQUEST['numberOfGuest'] : null;
$already = false;
$conn = getConnection();

$checkReservation = "SELECT accommodationID, customerID FROM reservations WHERE customerID = ?";
if ($stmt = mysqli_prepare($conn,$checkReservation)){
    
  mysqli_stmt_bind_param($stmt, "i", $userID);
  mysqli_stmt_execute($stmt);
  $queryresult = mysqli_stmt_get_result($stmt);
  
}

if ($queryresult) {
  while ($currentrow = mysqli_fetch_assoc($queryresult)) {
    $accommodationID = $currentrow['accommodationID'];
    $customerID = $currentrow['customerID'];
    if($accommodationID == $hotelID && $customerID == $userID)
    {
      // if the room booked already
      $already = true;
      echo "<p>You already booked this room.</p>";
      header('Refresh: 5; URL=./myBookings.php');
      echo "You will be redirected to my bookings in <span id = 'timeLeft' >5</span> second(s).";
    }
}
mysqli_free_result($queryresult);

}



if($already == false)
{
    
  $insertSQL = "INSERT INTO reservations( accommodationID, customerID, start_date, end_date, num_guests) VALUES (?,?,?,?,?)";
  if ($stmt = mysqli_prepare($conn,$insertSQL)){
      
      mysqli_stmt_bind_param($stmt, "iissi",$hotelID, $userID, $startDate, $endDate, $numberOfGuest);
      $queryresult2 = mysqli_stmt_execute($stmt);
      
      if (!$queryresult2) {
          echo "<p>Error: " . mysqli_stmt_error($stmt) . "</p>";
      }
    
    echo "<p>Your reservation is successfull.</p>";
   

    header('Refresh: 5; URL=./myBookings.php');
    echo "You will be redirected to my bookings in <span id = 'timeLeft' >5</span> second(s).";
    
  }

  else{
    echo "Could not prepare statement";
  }

}

mysqli_close($conn);
?>


<script>
// Counter For Time 
var timeleft = 5;
var downloadTimer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(downloadTimer);
  }
  document.getElementById("timeLeft").textContent = timeleft;
  timeleft -= 1;
}, 1000);

</script>