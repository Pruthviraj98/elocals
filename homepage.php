<?php
$conn=mysqli_connect("localhost","root","","elocals");
?>
<html>
<script>
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ALL THE DRIVER FUNCTIONS ARE HERE..
//THIS FUNCTION IS USED TO CHECK IF THE ENTERED NUMBER IS SIGNED UP OR NOT IN THE APP
function showHint(str) {
//if length of nobile no is zero, then display nothing else check it
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
              }
        }
        xmlhttp.open("GET", "getno.php?q="+str, true);//refer getno.php from here as the control moves there
        xmlhttp.send();
    }
}

//to check if the cashback button pressed with or without the referal
function redir(referal, mobile){
  //check if mobile is entered first
if(mobile.length>0){
  //check if referal length not entered
  if(referal.length<1)
  {
    checkRef(mobile);//to only get the referral id and give the cashback status
}else{
    checkRef(mobile);//same as above
    getref(referal, mobile);//for the additional updates of cashback table, referalcoount table, and passbook table.= in the database
  }
}
}

function checkRef(mobile){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("referalStatus").innerHTML = this.responseText;
          var status=this.responseText;
          if(status[20]=='e'){//to check if the cash back has already given to the user or not
          commonUpdate(mobile);//if the cashbackstauts is null, then update the database move to this function
        }
      }
  }

  xmlhttp.open("GET", "checkref.php?q="+mobile, true);
  xmlhttp.send();//move to checkref.php as the control moves there from here
}

function getref(referal, mobile){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("r").innerHTML = this.responseText;
          }
      }
      xmlhttp.open("GET", "getref.php?q="+ referal +"&p=" + mobile, true);
      xmlhttp.send();// move to getref.php as the control moves there
}


function commonUpdate(str){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("r").innerHTML = this.responseText;
      }
  }
  xmlhttp.open("GET","getuser.php?q="+ str, true);
  xmlhttp.send();//go to getuser.php as the control flows here for the updation of the data base after the cashback is being earned
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>


<style>
#Table1{

    border: 2px solid black;
    outline: #4CAF50 solid 10px;
    margin: auto;
    padding: 20px;
    text-align: center;
    box-shadow: 10px 10px 5px grey;
    font-size: 25px;
}


  input[type=text] {
    background-color: white;
    background-position: 10px 10px;
    background-repeat: no-repeat;
    padding-left: 40px;
    height:45px;
    font-size: 25px;
    text-shadow: 2px 2px Lightgrey;
}


#submit{
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 20px;
    text-align: center;
    font-family: Arial;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    margin: 4px 2px;
    cursor: pointer;
}
#submit:hover{
  background-color: darkgreen;
}
#texthint{
  font-size: 20px;
  text-shadow: 2px 2px grey;
}
body{
  background-image: url("https://ak6.picdn.net/shutterstock/videos/23324596/thumb/1.jpg?i10c=img.resize");
  background-size:cover;
  filter: blur(0.5px);
}
#referalStatus{
  color: black;
  background-color: lightblue;
  font-family: Arial;
}
}
</style>

    <body>
    <center>
        <p style="font-size:40px; color:black; 	font-family: Arial; background-color:lightblue">ELOCALS</p>
        <p style="font-size:30px; color:white"><u>CASHBACK AND REFERAL CENTER</u></p>

        <table cellspacing="25px" frame="box" id="Table1">
            <tr>
                <form>
                  <td align="left">
                    <p style="font-size:30px; color:white; font-family: Arial">MOBILE:</p>
                  </td>
                  <td>
                    <input type="text" onkeyup="showHint(this.value)" id="mobile" placeholder="mobile-no">
                  </td>
                </form>
           </tr>

            <tr rowspan="2">
              <td>
                  <p style="font-size:40px; color:black; 	font-family: Arial"> <span id="txtHint" ></span></p>
              </td>
            </tr>


            <tr>
                <td align="left">
                    <form>
                    <p style="font-size:30px; color:white; font-family:Arial">  ENTER THE REFERRAL-CODE:
                    </p>
                </td>
                <td>
                    <input type="text" id="referal" placeholder="referral code"><br>
                </td>
            </tr>


            <tr>
                <td align="right">
                    <input type="button" id="submit" onclick="redir(document.getElementById('referal').value, document.getElementById('mobile').value)" value=" CLICK HERE TO GET CASH-BACK NOW!!!">
                    </form>
                </td>
            </tr>


            <tr>
                <td>
                    <p style="font-size:20px;	font-family: Arial; color:white">refer to your friends by this code:</p></td><td><span id="referalStatus"></span></p>
                </td>
            </tr>

        </table>
    </center>

    </body>
</html>
