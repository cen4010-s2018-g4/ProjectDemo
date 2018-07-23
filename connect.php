<?php
// here is my database connection you need to change
// please change as our  database connection username , password, and database name the way it’s suppose to be I’m not to good at it
$servername = "cen4010sum18_g04";
$username = "csaintilmont2016"; //change to your db username
$password = "  "; //change to your db password
$dbName="groupname"; // change to your db name

// Create connection
$con = new mysqli($servername, $username, $password,$dbName);

// Check connection
if ($con->connect_error) {
die("Connection failed: " . $con->connect_error);
}


?>
