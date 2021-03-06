<?php
session_start();
require('connection.php');



if($_POST['action']=="register"){
	register();
}
if($_POST['action']=="login"){
	login();
}
if($_POST['action']=="logout"){
	logout();
}


function validate_register(){
	if($_POST['action']=="register"){
		foreach ($_POST as $key => $value) {
			if($key=="name_first" or $key=="name_last"){
				if(!preg_match("/^[a-zA-Z ]*$/",$value)){
					$_SESSION['errors'][$key]=" cannot contain numbers!!!";
				}//name contained numbers
			}//key is name
			if($key=="email"){
				if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
					$_SESSION['errors'][$key]="Stay calm, Email is not valid.";
				}//email is not valid
			}// if is key is email
			if($key=="password" or $key=="password_confirm"){
				if(strlen($value)<6){
					$_SESSION['errors'][$key]="Password is not long enough";
				}//password is not long enough
			}//key is a password
			if($key=="password_confirm"){
				if($_POST['password']!== $_POST['password_confirm']){
					$_SESSION['errors'][$key]="passwords do not match";
				}//Passwords do not match
			}//key is password confirm
		} //end of validate for each
	}//end of if action == register
}//end of register function

function if_empty_validate(){
	foreach ($_POST as $key => $value) {
		if($value==null){
			$_SESSION['errors'][$key]="cannot be empty";
		}//value cannot be empty
	}//for each key in post
}


function if_errors_validation(){
	if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
			header("Location: index.php");
			die();
	} // you have errors, so redirect to index and show errors
}


// add to databse
function insert_query($post){
	foreach ($post as $key => $value) {
		$post[$key]=escape_this_string($value);
	}  // escape everything in $post
	$query = "INSERT INTO users(name_first, name_last, email, password, created_at, updated_at)
	values('{$post['name_first']}','{$post['name_last']}','{$post['email']}','{$post['password']}',now(),now())";
	if(run_mysql_query($query)){ // run query here
		$get_register_query ="SELECT id as user_id, name_first, name_last
								FROM users
								WHERE email='{$post['email']}'
								AND password='{$post['password']}';
		";
		var_dump($get_register_query); die();
		// $_SESSION=fetch($get_register_query)[0]; // user array replaces SESSION
		// header("Location: wall.php");

	} else{
		var_dump($post);
		die("System Error");
	}//return boolean false if errors
}


function register(){
	validate_register();
	if_empty_validate();
	if_errors_validation();
	insert_query($_POST);
}



function login(){
	$email = escape_this_string($_POST['email']);
	$password = escape_this_string($_POST['password']); 
	//check is login info is in database
	// $query = "SELECT *  FROM users WHERE users.email ='{$email}' and users.password ='{$password}'; ";
	$query = "SELECT id as user_id, name_first, name_last
								FROM users
								WHERE email='{$email}'
								AND password='{$password}';
		";
	if(!fetch($query)){
		$_SESSION['errors']['login'] = "Login information is incorrect";
		header("Location: index.php");
		die();
	}

	$_SESSION= fetch($query)[0];  //// user array replaces SESSION

	// $user = fetch($query)[0];	
	// $_S['user-id'] = $user['id'];
	// $_S['user-name'] = $user['name_first'];

		header("Location: wall.php");
}


function logout(){
	session_destroy();
	header("Location: index.php");
	die();
}
	
 ?>