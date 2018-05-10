<?php

$conn=mysqli_connect("localhost","root","","elocals");
$q = $_REQUEST["q"];
$mobile=mysqli_real_escape_string($conn,$q);
echo $mobile;
$result="SELECT deviceserial, devicemac, devicemodel, deviceid FROM `users` WHERE mobile='$mobile'";
$result = $conn->query($result);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $serial=$row["deviceserial"];
      $serial=mysqli_real_escape_string($conn,$serial);
      $id=$row["deviceid"];
      $id=mysqli_real_escape_string($conn,$id);
      $model=$row["devicemodel"];
      $model=mysqli_real_escape_string($conn,$model);
      $mac=$row["devicemac"];
      $mac=mysqli_real_escape_string($conn,$mac);
  }
}

//first update the cashback status to DONE
$result="UPDATE `users` SET `cashbackstatus`='DONE' WHERE deviceserial='$serial' && devicemac='$mac' && devicemodel='$model' && deviceid='$id'";
$result= mysqli_query($conn,$result);

//update the passbook for the transactions entry
$result2="INSERT INTO passbook(`mobile`, `title`, `description`, `amount`) VALUES ('$mobile', 'Signup Bonus', 'Signup cash received', 100)";
$result2= mysqli_query($conn,$result2);

//select the mobile number from the cashback table if present, then update there itself by adding 100 else, create the new row and add 100 to it
$result3="SELECT mobile FROM `cashback` WHERE mobile='$mobile'";
$result3= mysqli_query($conn,$result3);
//if the number found,  perform updation of cashback, else create the new row;
if(mysqli_num_rows($result3)==1){
  $result4="UPDATE `cashback` SET amount=amount+100 WHERE mobile='$mobile'";
  $result4 = $conn->query($result4);
  exit();
}
else
{//if number not present
  $result4="INSERT INTO `cashback`(`mobile`, `amount`) VALUES ($mobile,100)";
  $result4 = $conn->query($result4);
}
// here the work flow gets completed 
 ?>
