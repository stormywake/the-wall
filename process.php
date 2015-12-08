<?php
session_start();
//check validation of
// email
// names
// passwords

$_SESSION['errors'] = array();
// var_dump($_POST);

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
			if($value<6){
				$_SESSION['errors'][$key]="Password is not long enough";
			}//password is not long enough
		}//key is a password
		if($key=="password_confirm"){
			if($key!=$_POST['password']){
				$_SESSION['errors'][$key]="passwords do not match";
			}//Passwords do not match
		}//key is password confirm
	} //end of validate for each
}//end of register function


foreach ($_POST as $key => $value) {
	if($value==null){
		$_SESSION['errors'][$key]="cannot be empty";
	}//value cannot be empty
}//for each key in post


if(isset($_SESSION['errors'])&& !empty($_SESSION['errors'])){
		header("Location: index.php");
		// die();
} 
	



 ?>