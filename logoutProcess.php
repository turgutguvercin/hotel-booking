<?php
ini_set("session.save_path", "/home/sessionData");
session_start();
$_SESSION = array();
session_destroy();



echo"You successfully sign out. ";
echo "You will be redirected to home page in <span id = 'timeLeft' >5</span> second(s).";
header('Refresh: 5; URL=./index.php');
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