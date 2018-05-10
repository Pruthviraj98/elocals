<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elocals";
$hint="";
//connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

function prompt($prompt_msg){
  echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");
  return;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  $mobile=$_REQUEST["q"];

  $mobile=mysqli_real_escape_string($conn,$mobile);
  $result="SELECT cashbackstatus FROM users WHERE mobile='$mobile'";
  $result = $conn->query($result);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $status=$row["cashbackstatus"];
    }
$status=mysqli_real_escape_string($conn, $status);
//check if the cashbackstatus of the user is null or not
    if(strcmp("null", $status)==0){
      //print that the cashback is earned along with the== referal id
      $result="SELECT myrefer FROM users WHERE mobile='$mobile'";
      $result = $conn->query($result);
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $hint= $row['myrefer']."Cash back earned";
          echo $hint;
        }//move to the hopemage.php for the updations in the data base for the cashback stauts

    }
  }
  else{
//output only the referal id that the user can refer to his friends and  donot update the ddatabase
    $result="SELECT myrefer FROM users WHERE mobile='$mobile'";
    $result = $conn->query($result);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $hint=$row['myrefer']."Cash back has already given";
        echo $hint;
      }
  }
  }
}
?>
