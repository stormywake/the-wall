<?php
// include('header.php');
session_start();
require('connection.php');

// get info from users post


function insert_query_post($post){
	$content = escape_this_string($post['content']);
	$query = "INSERT INTO posts
				(content, created_at, updated_at,user_id)
				values
				('{$content}',now(),now(),{$_SESSION['id']});";
	if(run_mysql_query($query)){ // run query here
		header('Location: wall.php');
		return true;
	} else{
		var_dump($post);
		die("System Error");
	}//return boolean false if errors
}


 if(isset($_POST['action']) && $_POST['action']=="write-post"){
 	insert_query_post($_POST);
 }

// function to get post all posts to wall
function pull_query(){
	$query= "SELECT * FROM users
	JOIN posts ON posts.user_id = users.id;";
	if(!fetch($query)){
		$_SESSION['errors']['posts'] = "post query was wrong";
		header("Location: wall.php");
		die();
	}

	$_SESSION['posts']= fetch($query);  // returns array
}

function post_to_wall(){
	pull_query();
	foreach (array_reverse($_SESSION['posts']) as  $value) { ?>
		<div class="well well-sm col-sm-8 col-sm-offset-2 blog text-center">
			<h3><?php echo ucfirst($value['name_first'])." ".ucfirst($value['name_last']) ?></h3>
			<p class="initialism" ><?php echo date('g:i a F j Y ', strtotime($value['created_at']));?></p>
			<p><?php echo $value['content']; ?></p>
			<input class="btn btn-danger btn-sm" type="button" value="Delete">
		</div>
	<?php } 
	}





 ?>