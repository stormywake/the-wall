<?php 
session_start();
include('header.php');
logged_in();
 ?>

<div id="container"class="container">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<form action="post_process.php" method="post">
				<div class="form-group">
					<input type="hidden" name="action" value="write-post">
					<label>Write a new post!</label>
					<textarea class="form-control" name="content" rows="3"></textarea>
				</div><!-- end group -->
				<div class="form-group">
					<input class="btn btn-success" type="submit" value="Post!">
				</div>
			</form>
		</div><!-- end col -->
	</div><!-- end row -->
</div><!-- end of container - class="container"-->




<?php include('footer.php') ?>
