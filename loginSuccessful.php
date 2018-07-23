<?php

// this for session

session_start();

// database connection

include("connect.php");

// check the session if null go to login page

if(isset($_SESSION['User_Id']) == ''){

echo '<script>window.open("login.php", "_self")</script>';

}

else

{

$unames=$_SESSION['User_Id'];

}

?>

<html>

<body>

<h1>Welcome to page</h1>

<h2>User Name : <?php echo $unames?></h2>

<a href="login.php">Logout</a>

</body>

</html>
