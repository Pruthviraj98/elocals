<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elocals";
$hint="";
//connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  $mobile=$_REQUEST["p"];
  $referal=$_REQUEST["q"];
  $mobile=mysqli_real_escape_string($conn,$mobile);
  $referal=mysqli_real_escape_string($conn,$referal);

//echo $referal;

// as given first checking if the refer count>10 if true,  do nothing, else, update
    $result="SELECT refereralcode FROM refercount WHERE refereralcode='$referal'";
    $result = $conn->query($result);
    if ($result->num_rows < 10) {
      $result="SELECT mobile FROM users WHERE myrefer='$referal'";
      $result = $conn->query($result);
//to check the refercount
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $refmobile= $row['mobile'];
        }
    }
    //insert into passbook the transaction of referak bonus
    $result2="INSERT INTO `passbook`(`mobile`, `title`, `description`, `amount`) VALUES ('$refmobile','Referral bonus','eReferral cash received',50)";
    $result2 = $conn->query($result2);


    //to select the mobile number from whom the referal id was taken
    $result3="SELECT mobile FROM `cashback` WHERE mobile='$refmobile'";
    $result3 = $conn->query($result3);
    if ($result3->num_rows > 0) {
      //updating the cashback table adding the signup bonus for the referred mobile number if its already present
    $result4="UPDATE `cashback` SET `amount`=`amount`+50 WHERE mobile='$refmobile'";
    $result4 = $conn->query($result4);
    }else{
      // creating the tuple for the user if his/her referral was used for the first time
    $result5="INSERT INTO `cashback`(`mobile`, `amount`) VALUES ('$refmobile',50)";
    $result5= $conn->query($result5);
    }

//update the referal count as the 50 rs cashback has given here
    $result6="INSERT INTO `refercount`(`mobile`, `refereralcode`, `amount`, `referralmobile`, `description`) VALUES ('$mobile','$referal',50,'$refmobile','Referal bonus')";
    $result6= $conn->query($result6);
  }
//work flow ends here

?>
