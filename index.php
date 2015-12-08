<?php 
session_start();
function echo_if_error($key){
	if(isset($_SESSION['errors'][$key])){
		echo "<span class='errors'>".$_SESSION['errors'][$key]."</span>";
	}
}
 ?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>The Wall</title>
	<meta name="description" content="Coding Dojo The Wall Assignment">
</head>
<body>
	<div id="container">
		<div id="login_register">

			<fieldset>
				<legend>Register</legend>
					<form id="register" action="process.php" method="post">
								<input type="hidden" name="action" value="register">
						<label><input type="text" name="name_first" placeholder="first name"><?php echo_if_error('name_first'); ?></label>
						<label><input type="text" name="name_last" placeholder="last name"><?php echo_if_error('name_last'); ?></label>
						<label><input type="text" name="email" placeholder="email"><?php echo_if_error('email'); ?></label>
						<label><input type="password" name="password" placeholder="password"><?php echo_if_error('password'); ?></label>
						<label><input type="password" name="password_confirm" placeholder=" confirm password"><?php echo_if_error('password_confirm'); ?></label>
						<label><input type="submit" value="Register!">
					</form><!-- end of register -->
			</fieldset>
			<fieldset>
				<legend>Login</legend>
					<form id="login" action="process.php" method="post">
						<input type="hidden" name="action" value="register">
						<input type="text" name="email" placeholder="email">
						<input type="password" name="password" placeholder="password">
						<input type="submit" value="Login!">
					</form><!-- end of login -->
			</fieldset>
		</div><!-- end of login_register -->
	</div><!--end of container -->
</body>
</html>