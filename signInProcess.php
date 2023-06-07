<?php
ini_set("session.save_path", "/home/sessionData");
session_start();


require_once 'functions.php';
$username = array_key_exists('username', $_POST) ? $_POST['username'] : null;
$password = array_key_exists('password', $_POST) ? $_POST['password'] : null;

$conn = getConnection();
$querySQL = "SELECT password_hash,customerID FROM customers WHERE username = ?";
$stmt = mysqli_prepare($conn, $querySQL);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$queryresult = mysqli_stmt_get_result($stmt);
$userRow = mysqli_fetch_assoc($queryresult);
$passwordHash = $userRow['password_hash'];
$userID = $userRow['customerID'];


if (password_verify($password, $passwordHash)) {


  $_SESSION['Login'] = true;
  $_SESSION['Username'] = $username;
  $_SESSION['UserID'] = $userID;
  $_SESSION['timeout'] = time();
  echo "You succesfully log in. You will be redirected to home page in <span id = 'timeLeft' >5</span> second(s).";
  header('Refresh: 5; URL=./index.php');
} else {
  echo "Invalid password or username.<br>";
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

</script>