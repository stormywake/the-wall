<?php 
// session_start();
include('post_process.php');
include('header.php'); 
logged_in();
unset($_SESSION['errors']);
// var_dump($_SESSION);
// var_dump($_POST);
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center">
		<h2>Welcome <?php echo ucwords($_SESSION['name_first']); ?></h2>
		<h4>What's on your wall today?</h4>
	</div><!--  end of col -->
	</div><!-- end row -->
	<div class="row">
		<div id="messages" class="col-sm-12">
			<?php
				post_to_wall();
			 ?>
		<div><!-- end of messages -->
	</div><!-- end of messages -->
</div><!-- end container -->


<?php include('footer.php'); ?>