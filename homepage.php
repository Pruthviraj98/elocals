<?php
$conn=mysqli_connect("localhost","root","","elocals");
?>
<html>
<script>
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function showHint(str) {
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
        xmlhttp.open("GET", "getno.php?q="+str, true);
        xmlhttp.send();
    }
}

function redir(referal, mobile){

  if(referal.length<1)
  {
    checkRef(mobile);
}else{
    checkRef(mobile);
    getref(referal, mobile);
  }
}

function checkRef(mobile){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("referalStatus").innerHTML = this.responseText;
          var status=this.responseText;
          alert(status[20]);
          if(status[20]=='e'){
          commonUpdate(mobile);
        }
      }
  }

  xmlhttp.open("GET", "checkref.php?q="+mobile, true);
  xmlhttp.send();
}

function getref(referal, mobile){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("r").innerHTML = this.responseText;
          }
      }
      xmlhttp.open("GET", "getref.php?q="+ referal +"&p=" + mobile, true);
      xmlhttp.send();
}


function commonUpdate(str){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("r").innerHTML = this.responseText;
      }
  }
  xmlhttp.open("GET","getuser.php?q="+ str, true);
  xmlhttp.send();
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>
<style>

</style>

</head>
<body>
<center><br><br>
<p style="font-size:30px"><u>CASHBACK and REFERAL center</u></p>
<table cellspacing="25px" frame="box">
<tr>
<form>
  <td>
Mobile
</td>
<td>
   <input type="text" onkeyup="showHint(this.value)" id="mobile">
</td>
</form>
<p> <span id="txtHint"></span></p>
</td>


<tr>
<td>
<form>
  Enter the Referal-Code:
</td>
<td>
  <input type="text" id="referal"><br>
</td></tr>


<tr>
<td>
  <input type="button" id="submit" onclick="redir(document.getElementById('referal').value, document.getElementById('mobile').value)" value="GetcashBack!!">
</form>
</td>
</tr>


<tr>
<td>
<p>refer to your friends by this code:<span id="referalStatus"></span></p>
</td>
</tr>

</table>
</center>

</body>
</html>
