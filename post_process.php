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
		foreach ($_SESSION['posts'] as  $value) { ?>
			<h1><?php echo $value['name_first']; ?></h1>
			<p><?php echo $value['content']; ?></p>
			
			
		<?php } 
	}
 //run query
 //place query into var
 // return var

 ?>