<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","root","","elocals");
$hint="";
// get the q parameter from URL
$q = $_REQUEST["q"];

// lookup all registered numbers from database if $q is different from ""
if (strlen($q) == 10) {
  $mobile=mysqli_real_escape_string($db, $q);
  $result="SELECT * FROM users WHERE mobile='$mobile'";
  $result= mysqli_query($db,$result);

  if(mysqli_num_rows($result)==1){
    $hint="Correct";
  }
  else
  {
    $hint="Incorrect, you need to sinup in elocals app first using this number";
  }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint;
//echo $referal;
?>
