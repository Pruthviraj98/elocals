<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","root","","elocals");
$hint="";
// get the q parameter from URL which refers to the mobile number
$q = $_REQUEST["q"];

// lookup all registered numbers from database if $q is different from ""
if (strlen($q) == 10) {
  $mobile=mysqli_real_escape_string($db, $q);
  $result="SELECT * FROM users WHERE mobile='$mobile'";
  $result= mysqli_query($db,$result);
//incase the mobile number is found in the database,  positive reply is done else not
  if(mysqli_num_rows($result)==1){
    $hint="Correct, the number is Number Verified !!";
  }
  else
  {
    $hint="Incorrect, you need to signup in elocals app first using this number";
  }
}

echo $hint;//now go back to homepage.php as the control moves there

?>
