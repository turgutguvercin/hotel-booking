<?php

ini_set("session.save_path", "/home/sessionData");
require_once("functions.php");
session_start();
echo makePageStart("Search", "assets/stylesheets/accommodationList.css");

if (isset($_SESSION['Login']) && $_SESSION['Login']) {

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
<div class="list" id="list">
<?php
$search1 = array_key_exists('search-input', $_REQUEST)? $_REQUEST['search-input'] : null;
$search2 = array_key_exists('search-input', $_REQUEST)? $_REQUEST['search-input'] : null;
$search3 = array_key_exists('search-input', $_REQUEST)? $_REQUEST['search-input'] : null;

//To use advanced search
$search1 = '%'.$search1.'%';
$search2 = $search2.'%';
$search3 = '%'.$search3;


$conn = getConnection();



$sql= "SELECT * FROM accommodation WHERE (accommodation_name LIKE ?) OR (description LIKE ?) OR (location LIKE ?)  
 OR  (accommodation_name  LIKE ? ) OR (description LIKE ?) OR (location LIKE ?)   OR 
  (accommodation_name  LIKE ?) OR (description LIKE ? ) OR (location LIKE ?)  ";


if ($stmt = mysqli_prepare($conn,$sql)){
    
  mysqli_stmt_bind_param($stmt, "sssssssss", $search1,$search1,$search1,$search2,$search2,$search2,$search3,$search3,$search3);
  mysqli_stmt_execute($stmt);
  $queryresult = mysqli_stmt_get_result($stmt);
  
}

if ($queryresult) {
  while ($currentrow = mysqli_fetch_assoc($queryresult)) {
    $accommodationID = $currentrow['accommodationID'];
    $accommodationName = $currentrow['accommodation_name'];
    $description = $currentrow['description'];
    $price = $currentrow['price'];
    $location = $currentrow['location'];
    $image_1 = $currentrow['image_1'];
    echo makeHotelCard($accommodationName, $description, $price, $location, $image_1);
  }
}
mysqli_close($conn);
mysqli_free_result($queryresult);

?>
</div>
<?php
echo endMain();

?>
<script>

// If there is no result from search
if(document.getElementsByClassName("listed-item").length == 0)
{
  document.getElementById("list").innerHTML += "<br>";
  document.getElementById("list").innerHTML += "No Result Found";

}

document.getElementById("dropdown").innerHTML +=  '<div class="dropdown-content"><a href="logoutProcess.php">Sign out <i class="fas fa-sign-out-alt"></i></a><a href="myBookings.php">My Bookings</a></div>'; 


</script>