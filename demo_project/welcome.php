<?php include('connection.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome to FAUBook</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="script.js"></script>
</head>
<body>
    <div id="login">
      <div id="login">
        <h2>Login</h2>
      </div>

      <form method="post" action="login.php">
        <?php include('errors.php'); ?>
        <div>
            <label>Username</label>
            <input type="text" name="username" >
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div>
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
		<!-- Hold Off for now
		<?php
			if ($count > 2)
			{
				echo "<div>
					      		<label>$question</lable>
								<input type="text" name="answer">
						   </div>"
			}
		?> -->
        <p>
            Not yet a member? <a id="reg">Sign up</a>
			Forgot your account? <a id="forgot" href="">Find your account!</a>
        </p>
      </form>
    </div>
    
    <div id="register" hidden>
      <div>
        <h2>Register</h2>
      </div>

      <form method="post" action="register.php">
        <?php include('errors.php'); ?>
        <div>
          <label>Username</label>
          <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div>
          <label>Email</label>
          <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div>
          <label>Password</label>
          <input type="password" min="8" name="password">
        </div>
        <div>
          <label>Confirm password</label>
          <input type="password" min="8" name="cPassword">
        </div>
        <div>
          <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <p>
            Already a member? <a id="log">Sign in</a>
        </p>
      </form>
    </div>
</body>
</html>