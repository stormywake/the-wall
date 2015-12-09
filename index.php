<?php
session_start();
include('header.php');
 ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">
				<fieldset>
					<legend>Register</legend>
						<form id="register" action="process.php" method="post">
							<div class="form-group">
								<input type="hidden" name="action" value="register">
								<label for="name_first">First Name: <?php echo_if_error('name_first'); ?></label>
									<input class="form-control" type="text" name="name_first" id="first" placeholder="first name">
							</div><!-- end of name -->
							<div class="form-group">
								<label>Last Name: <?php echo_if_error('name_last'); ?></label>
								<input class="form-control" type="text" name="name_last" placeholder="last name">
							</div>
							<div class="form-group">
								<label>Email: <?php echo_if_error('email'); ?></label>
								<input class="form-control" type="text" name="email" placeholder="email">
							</div>
							<div class="form-group">
								<label>Password: <?php echo_if_error('password'); ?></label>
								<input class="form-control" type="password" name="password" placeholder="password">
							</div>
							<div class="form-group">
								<label>Confirm Password: <?php echo_if_error('password_confirm'); ?></label>
								<input class="form-control" type="password" name="password_confirm" placeholder=" confirm password">
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-success btn-block" value="Register!">
							</div>
						</form><!-- end of register -->
				</fieldset>
			</div> <!-- end of registration -->
			<div class="col-sm-5">
				<fieldset>
					<legend>Login</legend>
						<form id="login" action="process.php" method="post">
							<div>
								<label><?php echo_if_error('login'); ?></label>
								<input type="hidden" name="action" value="login">
							</div>
							<div class="form-group">
								<label>Email:</label>
								<input  class="form-control" type="text" name="email" placeholder="email">
							</div>
							<div class="form-group">
							<label>Password:</label>
								<input class="form-control" type="password" name="password" placeholder="password">
							</div>
							<div class="form-group">
								<input class="btn btn-success btn-block" type="submit" value="Login!">
							</div>
						</form><!-- end of login -->
				</fieldset>
				 <?php unset($_SESSION['errors']); ?>
			</div><!-- end of login_register -->
		</div><!-- end of form row -->
	</div><!--end of container -->
	<?php require_once('footer.php') ?>
