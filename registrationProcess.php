<?php
require_once("functions.php");
$errors = array();
$name = array_key_exists('name', $_POST)? $_POST['name'] : null;
$familyName = array_key_exists('familyName', $_POST) ? $_POST['familyName'] : null;
$userName = array_key_exists('userName', $_POST) ? $_POST['userName'] : null;
$password =  array_key_exists('password',$_POST)? $_POST['password'] : null;
$date = array_key_exists('date', $_POST) ? $_POST['date'] : null;
$addressLine1 = array_key_exists('addressLine1', $_POST) ? $_POST['addressLine1'] : null;
$addressLine2 = array_key_exists('addressLine2', $_POST) ? $_POST['addressLine2'] : null;
$postCode = array_key_exists('postCode', $_POST) ? $_POST['postCode'] : null;

$name  = trim($name);
$familyName = trim($familyName);
$userName = trim($userName);
$addressLine1 = trim($addressLine1);
$addressLine2 = trim($addressLine2);
$postCode = trim($postCode);


$error = false;
$userNameCheck = null;

if (empty($name ) || empty($familyName) || empty($userName)|| empty($addressLine1)) {
  $errors[] = "<p>Name, Familyname, Username and/or Address Line 1 are missing. </p>\n";
  $error = true;
}

else if(strlen($name ) || strlen($familyName) || strlen($userName) > 30) {
  $errors[] = "<p>Name, Familyname, Username and/or Address Line 1 cannot br longer than 30 characters</p>\n";
  $error = true;
}

// if($error = true)
// {
//  echo "$input,$errors";
//  return;
// }

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$conn = getConnection();


$checkSameUser = "SELECT * FROM customers WHERE username = ?";
if ($stmt = mysqli_prepare($conn,$checkSameUser)){
  mysqli_stmt_bind_param($stmt, "s",$userName);	
  mysqli_stmt_execute($stmt);
  $queryresult = mysqli_stmt_get_result($stmt);

}	

if ($queryresult) {
    while ($currentrow = mysqli_fetch_assoc($queryresult)) {
        $userNameCheck = $currentrow['username'];
    }
}


if($userName == $userNameCheck){
    echo "Username is already taken :( <br> ";
    echo "You will be redirected to register page in <span id = 'timeLeft' >5</span> second(s).";
    header('Refresh: 5; URL=./customerRegistration.php');
}
  
else{
    $insertSQL = "INSERT INTO customers(username, password_hash, customer_forename, customer_surname, customer_postcode, customer_address1,customer_address2, date_of_birth) VALUES (?,?,?,?,?,?,?,?)";
    if ($stmt = mysqli_prepare($conn,$insertSQL)){
		
		mysqli_stmt_bind_param($stmt, "ssssssss",$userName,$passwordHash, $name, $familyName , $postCode, $addressLine1, $addressLine2,$date);
		$queryresult2 = mysqli_stmt_execute($stmt);
		
		if (!$queryresult2) {
			echo "<p>Error: " . mysqli_stmt_error($stmt) . "</p>";
		}
	  mysqli_close($conn);
    }

    echo"You successfully registered. You will be redirected to home page in <span id = 'timeLeft' >5</span> second(s).";
    header('Refresh: 5; URL=./index.php');
}



?>





<script>


var timeleft = 5;
var downloadTimer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(downloadTimer);
  }
  document.getElementById("timeLeft").textContent = timeleft;
  timeleft -= 1;
}, 1000);

</script>