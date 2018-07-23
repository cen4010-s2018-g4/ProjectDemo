<?php

session_start();

include 'connect.php';

if($_SESSION['counter']==null)

{

$_SESSION['counter']=1;

}

$msg = "";

if(isset($_POST["check"]))

{

if($_POST["username1"]=='')

{

$msg = "Enter User Name...";

//return false;

}

else if($_POST["ddlsecurity"]=="0")

{

$msg = "Select Security Question...";

//return false;

}

else if(empty($_POST["answer"]))

{

$msg = "Enter Answer...";

//return false;

}

else{

$username1 = $_POST["username1"];

$ddlsecurity = $_POST["ddlsecurity"];

$answer = $_POST["answer"];

$username1 = mysqli_real_escape_string($con, $username1);

$ddlsecurity = mysqli_real_escape_string($con, $ddlsecurity);

$answer = mysqli_real_escape_string($con, $answer);

$sql="SELECT Password FROM `tbl_user_registration` WHERE User_Name='$username1' and Security_Question_Id='$ddlsecurity' and Security_Answer='$answer'";

$result=mysqli_query($con,$sql);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

if(mysqli_num_rows($result) == 1)

{

//$_SESSION['User_Id'] = $row['Password'];

$msg = "Your Password is:".$row['Password']; /* Redirect browser */

//exit();

}

else

{

$msg = "Sorry..! Invalid Answer";

}

}

}

if(isset($_POST["submit"]))

{

if($_POST["username"]=='')

{

$msg = "Enter User Name...";

//return false;

}

else if($_POST["password"]=='')

{

$msg = "Enter Password...";

//return false;

}

else

{

$username = $_POST["username"];

$password = $_POST["password"];

$username = mysqli_real_escape_string($con, $username);

$password = mysqli_real_escape_string($con, $password);

//$password = md5($password);

$sql="SELECT UserID,UserName FROM user WHERE UserName='$username' and Password='$password'";

$result=mysqli_query($con,$sql);

$row=mysqli_fetch_array($result);

if(mysqli_num_rows($result) == 1)

{
// create a session here
$_SESSION['User_Id'] = $row['UserName'];

$msg = "Successfully Log in"; /* Redirect browser */
header("location: loginSuccessful.php");
//exit();

}

else

{

$msg = "Sorry..! Invalid UserName and Password".$_SESSION['counter'];

$_SESSION['counter']=$_SESSION['counter']+1;

if($_SESSION['counter']==3)

{

?>

<script> var x = document.getElementById('divlogin'); x.style.display = 'none'; var y = document.getElementById('divsecurity'); y.style.display = 'block';</script>

<?php

$_SESSION['counter']=0;

}

}

}

}

?>

<!DOCTYPE html>

<html lang="en" >

<head>

<meta charset="UTF-8">

<title>login</title>

<style>

.txtcontrol{

height: 40px;

font-size: 22px;

border: single;

border-color:black;

width: 100%;

margin-bottom:10px;

text-align:center;

}

.mcontainer {

max-width: 600px;

margin: 0 auto;

padding: 80px 0;

height: 400px;

text-align: center;

}

.mcontainer {

width: 100%;

padding-right: 10px;

padding-left: 10px;

margin-right: auto;

margin-left: auto;

}

.sbutton

{

width: 42%;

height: 42px;

background-color: #75d4b6;

border: none;

color: #f9f5ee;

font-size: 17px;

}

</style>

</head>

<body>

<div class="wrapper">

<div class="mcontainer">

<h1>Welcome</h1>

<form method="post" action="">

<?php

if($msg!='')

{

echo " <div>

<h4>Message</h4>

$msg</div>";

}

?>

<div id="divlogin" style="display:block;">

<table align="center" width="60%">

<tr>

<td>

<input type="text" placeholder="Email Id" class="txtcontrol" name="username"/>

</td>

</tr>

<tr>

<td>

<input type="password" placeholder="Password" class="txtcontrol" name="password"/>

</td>

</tr>

<tr>

<td>

<input type="submit" name="submit" value="Log In" class="sbutton"/>

<br>New User? <a href="Register.php">Register Here</a>

</td>

</tr>

</table>

</div>

<div id="divsecurity" style="display:none;">

<table align="center" width="60%">

<tr>

<td>

<input type="text" placeholder="Email Id" class="txtcontrol" name="username1"/>

</td>

</tr>

<tr>

<td>

<select name="ddlsecurity" class="txtcontrol">

<option value="0">Select Security Question</option>

<?php

$sql="SELECT * FROM `tbl_Security_Question`";

$qury=mysqli_query($con,$sql);

if(!$qury){

echo "No Records Found";

}

else

{

while($row=mysqli_fetch_array($qury))

{

echo "<option value=".$row["Security_Question_Id"].">".$row["Security_Question"]."</option>";

}

}

?>

</select>

</td>

</tr>

<tr>

<td>

<input type="text" placeholder="Security Answer" class="txtcontrol" name="answer"/>

</td>

</tr>

<tr>

<td>

<input type="submit" name="check" value="Log In" class="sbutton"/>

</td>

</tr>

</table>

</div>

</form>

</div>

</div>

</body>

</html>
