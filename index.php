<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","root","","elocals");
if(isset($_POST['Login'])){


  $mobile=mysqli_real_escape_string($db,$_POST['mobile']);
  $password=mysqli_real_escape_string($db,$_POST['password']);
  $result="SELECT * FROM users WHERE mobile='$mobile' AND password='$password'";
  $result= mysqli_query($db,$result);

  if(mysqli_num_rows($result)==1){

    $_SESSION['login'] = 1;
    $_SESSION['mobile']=$mobile;
    $_SESSION['message']="You are now Logged In";
    header("location:homepage.php");
  }
  else
  {
               $_SESSION['message']="Incorrect Mobile-no or Password You need to login from elocals app first!!";
  }
}

?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Elocals</title>



      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import url(https://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

body{
	margin: 0;
	padding: 0;
	background: #fff;

	color: #fff;
	font-family: Arial;
	font-size: 12px;
}

.body{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background-image: url(http://ginva.com/wp-content/uploads/2012/07/city-skyline-wallpapers-008.jpg);
	background-size: cover;
	-webkit-filter: blur(5px);
	z-index: 0;
}

.grad{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
	z-index: 1;
	opacity: 0.7;
}

.header{
	position: absolute;
	top: calc(50% - 35px);
	left: calc(50% - 300px);
	z-index: 2;
}

.header div{
	float: left;
	color: #5379fa !important;
	font-family: 'Exo', sans-serif;
	font-size: 60px;
	font-weight: 200;
}

.header div span{
	color: #fff;
}

.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(50% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 2;
}

.login input[type=text]{
	width: 450px;
	height: 50px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 26px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=password]{
	width: 450px;
	height: 50px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 26px;
	font-weight: 400;
	padding: 4px;
	margin-top: 10px;
}

.login input[type=submit]{
	width: 460px;
	height: 55px;
	background: #fff;
	border: 1px solid #fff;
	cursor: pointer;
	border-radius: 2px;
	color: #a18d6c;
	font-family: 'Exo', sans-serif;
	font-size: 26px;
	font-weight: 400;
	padding: 6px;
	margin-top: 10px;
}

.login input[type=submit]:hover{
	opacity: 0.8;
}

.login input[type=submit]:active{
	opacity: 0.6;
}

.login input[type=text]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=button]:focus{
	outline: none;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>

  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>E<span>locals</span></div>
		</div>
		<br>
		<div class="login">
      <form action="index.php" method="post">
				<input type="text" placeholder="Mobile-no" name="mobile" id="mobile"><br>
				<input type="password" placeholder="Password" name="password" id="password"><br>
				<input type="submit" value="Login"name="Login" id="Login">
      </form>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



</body>

</html>
