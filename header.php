<?php 
// session_start();

function echo_if_error($key){
	if(isset($_SESSION['errors'][$key])){
		echo "<span class='errors'>".$_SESSION['errors'][$key]."</span>";
	}
}
function logged_in(){
  if(!isset($_SESSION['name_first'])){ ?>
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3 ">
            <div class="alert alert-danger" role="alert">OOPS you are not logged in</div>
            <form action="index.php">
              <input type="submit" class="btn btn-danger btn-block" value="Login">
            </form>
            <?php include('footer.php');?>
          </div>
        </div>
      </div>
 <?php
      unset($_SESSION['errors']);
      include('footer.php');
      die();
  } 
}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  	<meta name="description" content="Coding Dojo The Wall Assignment">
    <title>The Wall</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">The Wall</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="post.php"> Write a post!</a></li>
              <li><a href="wall.php"> See your wall!</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <form action="process.php" method="post">
                <input type="hidden" name="action" value="logout">
                <input class="btn btn-danger" type="submit" name="logout" value="Logout!">
              </form>
            </ul>
          </div><!--  end of navs -->
        </div>
      </nav>