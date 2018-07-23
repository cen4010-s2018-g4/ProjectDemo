<?php

include 'connect.php';

$msg = "";

if(isset($_POST["submit"]))

{

if($_POST["User_Name"]=='')

{

$msg = "Enter User Name...";

//return false;

}

else if($_POST["password"]=='')

{

$msg = "Enter Password...";

//return false;

}

else if($_POST["ddlsecurity"]=="0")

{

$msg = "Select Security Question...";

//return false;

}

else if($_POST["answer"]=='')

{

$msg = "Enter Answer...";

//return false;

}

else

{

$User_Name = $_POST["User_Name"];

$password = $_POST["password"];

$ddlsecurity = $_POST["ddlsecurity"];

$answer = $_POST["answer"];

$User_Name = mysqli_real_escape_string($con, $User_Name);

$ddlsecurity = mysqli_real_escape_string($con, $ddlsecurity);

$answer = mysqli_real_escape_string($con, $answer);

$password = mysqli_real_escape_string($con, $password);

//$password = md5($password);

// first check the user name from database its exist or not

$sql="SELECT * FROM user WHERE UserName='$User_Name'";

// insert data into qustions table

$result=mysqli_query($con,$sql);

// if exist execute if statement otherwise else

if (mysqli_num_rows($result) > 0) {

$msg = "Sorry...This email already exist...";

}

else

{

// first the save the (UserName,Password) in table 'user'

$query = mysqli_query($con, "INSERT INTO user(UserName,Password) VALUES('$User_Name','$password')");

// after save username ans password in table user then get (UserID) of this save date

// by this query

$sql2="SELECT UserID FROM `user` ORDER BY UserID DESC LIMIT 1";

  

$getUserID=mysqli_query($con,$sql2);

// if data retrive from table user

while ($row2 = mysqli_fetch_array($getUserID))

{

// store the userID data in variable $uID from table User

$uID = $row2['UserID'];

// then save the userID, QuestionID and ansewer into table 'security_answers'

$query3 = mysqli_query($con, "INSERT INTO security_answers(UserID,QuestionsID, Answers) VALUES ('$uID','$ddlsecurity','$answer')");

$msg = "Thank You! you are now registered.";

header("Location: login.php"); /* Redirect browser to login page */

exit();

  

}

}

}

}

?>

<!DOCTYPE html>

<html lang="en" >

<head>

<meta charset="UTF-8">

<title>Register</title>

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

<table align="center" width="60%">

<tr>

<td>

<input type="text" placeholder="User Name" class="txtcontrol" name="User_Name"/>

</td>

</tr>

<tr>

<td>

<input type="password" placeholder="Password" class="txtcontrol" name="password"/>

</td>

</tr>

<tr>

<td>

<select name="ddlsecurity" class="txtcontrol">

<option value="0">Select Security Question</option>

<?php

include 'connect.php';

$sql="select * from security_questions";

$qury=mysqli_query($con,$sql);

if (mysqli_num_rows($qury) > 0) {

while ($row = mysqli_fetch_array($qury)) {

$queID = $row['Questions'];

  

echo '<option value="'.$row['QuestionID'].'">'.$row['Questions'].'</option>';

  

}

}

else

{

echo "No Records Found";

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

<input type="submit" name="submit" value="Register" class="sbutton"/>

</td>

</tr>

<tr>

<td>

Already a User? <a href="login.php">Login Here</a>

</td>

</tr>

</table>

  

<br>

</form>

</div>

</div>

</body>

</html>
