<?php
// include('header.php');
session_start();
require('connection.php');

// get info from users post
if(isset($_POST['action']) && $_POST['action']=='post_comment'){
	insert_query_comment($_POST);

}


function insert_query_post($post){
	$content = escape_this_string($post['content']);
	$query = "INSERT INTO posts
				(content, created_at, updated_at,user_id)
				values
				('{$content}',now(),now(),{$_SESSION['user_id']});";
	if(run_mysql_query($query)){ // run query here
		header('Location: wall.php');
		return true;
	} else{
		var_dump($post);
		die("System Error");
	}//return boolean false if errors
}

function insert_query_comment($post){
	$content = escape_this_string($post['content']);
	
	
	$query = "INSERT INTO comments
					(content, created_at, updated_at,post_id,user_id)
					values
					('{$content}',now(),now(),{$_POST['post_id']},{$_SESSION['user_id']});";

		if(run_mysql_query($query)){ // run query here
			header('Location: wall.php');
			return true;
		} else{
			var_dump($post);
			die("System Error");
		}//return
}


 if(isset($_POST['action']) && $_POST['action']=="write-post"){
 	insert_query_post($_POST);
 }


function pull_all_posts(){
	$query= 'SELECT concat(users.name_first," ",users.name_last) as user_name,
							 users.id as user_id, posts.id as post_id, 
							 posts.content as post_content, 
							 posts.created_at as posted_at 
							 FROM posts
							JOIN users ON users.id = posts.user_id
							ORDER BY posted_at DESC;'
						;
	// var_dump($query);
	// die();
	if(!fetch($query)){
		$_SESSION['errors']['posts'] = "post query was wrong";
		header("Location: wall.php");
		die();
	}

	return fetch($query);  // returns array
}

function pull_all_comments($post_id){
	$query= "SELECT concat(users.name_first,' ',users.name_last) as user_name,
							 comments.id as comment_id,
							 comments.content as comment_content,
							 comments.user_id as user_who_commented,
							 comments.created_at as comment_date 
							 FROM comments
							JOIN users ON users.id = comments.user_id
							-- JOIN posts ON posts.id = comments.user_id
							WHERE comments.post_id = {$post_id}
							ORDER BY comment_date DESC;"
						;
	// var_dump($query);
	// die();

	return fetch($query);  // returns array
}



function post_to_wall(){
	$posts = pull_all_posts();
	foreach ($posts as  $post) { ?>
		<div class="well well-sm col-sm-8 col-sm-offset-2 blog text-center">
			<h3><?php echo ucfirst($post['user_name'])?></h3>
			<p class="initialism" ><?php echo date('g:i a F j Y ', strtotime($post['posted_at']));?></p>
			<p><?php echo $post['post_content']; ?></p>
			<?php $comments = pull_all_comments($post['post_id']); ?>
			<?php foreach ($comments as  $comment) { ?>
				<div>
					<h4><?= ucfirst($comment['user_name']); ?></h4>
					<p class="initialism" ><?php echo date('g:i a F j Y ', strtotime($comment['comment_date']));?></p>
					<p><?php echo $comment['comment_content']; ?></p>
				</div>
			<?php } ?>
			<form method="post" action="post_process.php">
				<div class="form-group">
					<input type="hidden" name="action" value="post_comment">
					<input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
					<textarea class="form-control" name="content" placeholder="Whats your comment"></textarea>
				</div>
				<div class="form-group">
					<input class="btn btn-success btn-sm" type="submit" value="Comment">
				</div>
			</form>
		</div>
	<?php } 
	}

 ?>