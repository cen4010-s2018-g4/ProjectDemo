<?php
include("sendmail.php");
session_start();

// initializing variables
$dbUserName = "cen4010sum18_g04";
$dbPass = "cen4O10Go4";
$username = "";
$email = "";
$errors = array();
$count = 0;

// connect to the database
$db = mysqli_connect('localhost', $dbUserName, $dbPass, 'cen4010sum18_g04');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $cPassword = mysqli_real_escape_string($db, $_POST['cPassword']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  
  //validate for at least one lower char, one upper char and one number (maybe one more special character (?=.*[.-_?*+=!~]) )
  $validPassword = preg_match('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])', $password);
  if ($validPassword == 1) {
	  if ($password != $cPassword) {
		array_push($errors, "The two passwords do not match");
	  }

	  // first check the database to make sure 
	  // a user does not already exist with the same username and/or email
	  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
	  $result = mysqli_query($db, $user_check_query);
	  $user = mysqli_fetch_assoc($result);
	  
	  if ($user) { // if user exists
	    if ($user['username'] === $username) {
	      array_push($errors, "Username already exists");
	    }

	    if ($user['email'] === $email) {
	      array_push($errors, "email already exists");
	    }
	  }

	  // Finally, register user if there are no errors in the form
	  if (count($errors) == 0) {
	  	$options = [
		    'cost' => 12,
		];
	  	$hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);//encrypt the password before saving in the database
		
		//testing
		echo "Password hashed!";
		
		$to = $email;
	    $subject = "Confirm Email";
		
		//real message for next release (need for formating)
	    //$message = "Hello " . $username . "<br><br><h2>Welcome to FAUBook!<h2><br><p>Please click the button below to verify your account before having a good time with us!<br>";
		//testing message
		$message = "Hello " . $username . "<br><br><h2>Welcome to FAUBook!<h2><br><p>This is a test for sending email functionality.<br>";
	    $name = $username;
	    $mailsend = sendmail($to,$subject,$message,$name);
	    if($mailsend == 1){
	      echo '<h2>email sent.</h2>';
	    }
	    else{
	      array_push($errors, 'There are some issue with emailing.');
	    }

		//only for testing purpose
	  	$query = "INSERT INTO users (username, email, password) 
	  			  VALUES('$username', '$email', '$hashPassword')";
	  	mysqli_query($db, $query);
	  	$_SESSION['username'] = $username;
	  	$_SESSION['success'] = "You are now logged in<br>Please check your email for a test email!";
	  	header('location: index.php');
	  }
	}
	else {
		array_push($errors, "The two passwords do not match");
	}
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$query = "SELECT * FROM users WHERE username='$username'";
  	$results = mysqli_query($db, $query);
	$user = mysqli_fetch_assoc($result);
	$hash = $user['password'];
  	if (password_verify($password, $hash)) {
  		$_SESSION['username'] = $username;
  		$_SESSION['success'] = "You are now logged in";
		$count = 0;
  		header('location: index.php');
  	}else {
		$count++;
		echo "You had failed to login " . $count . " times.<br>You will be prompt to answer one security question on the next release!";
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>