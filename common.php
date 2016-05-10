<?php
	try{
		$db = new PDO('mysql:host=localhost;dbname=polarize;charset=utf8mb4', 'root');
	
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch(Exception $e) {
    	echo 'Connection to database failed with error: ',  $e->getMessage(), '. ';
		echo 'Make sure you have a user with full permissions with username "ayy_taq" and password "passwd321".';
		exit;
	}
	
	require_once('TwitterAPIExchange.php');

		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
		'oauth_access_token' => "3344215463-XNj7sDb8WaCvjEbErOHTqaCv9HdlHeZcU7The5X",
		'oauth_access_token_secret' => "4uPiJrFsL0SuWIefaT3RMnPmR684ce29LrWnY35pI1Lkw",
		'consumer_key' => "60EwKn8kG8sDW45ZcuFJByOmd",
		'consumer_secret' => "xOk1d9wqPpzTIK68gACMG5lrv2M587ItlHNe3e2j0auVFQ9VBx"
	);
	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$requestMethod = 'GET';
	$count = "50"; //The amount of tweets to show
  ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Polar Statistics</title>
		
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/bootstrap.min.js"></script>
  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		
  
  
	</head>
	
	

	
	<nav class="navbar navbar-inverse" style="margin: 0px;">
		<div class ="container-fluid">
			<!-- Logo -->
			<div class = "navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<!-- LOGO -->
				<a href ="home.php" class="navbar-brand"> 
				
				<div style="float: left">
					<img src = "Twitter_logo_blue.png" alt = "Image Not Supported on Your browser." height = "20" width = "20">
				</div>
				
				<div style="float: left">
					<img src = "Twitter_logo_red.png" alt = "Image Not Supported on Your browser." height = "20" width = "20">
				</div> </a>
				
				<!-- End of Logo -->
				
			</div>
			
			<!-- Menu Items -->
			<div id = "navbar">
			<div class="collapse navbar-collapse" id="mainNavBar">
				<ul class="nav navbar-nav">
					<li <?=echoActiveClassIfRequestMatches("home")?>> <a href="home.php">Home</a></li>
					<li <?=echoActiveClassIfRequestMatches("index")?>> <a href="index.php">Polarize</a> </li>
					<li <?=echoActiveClassIfRequestMatches("trendtest")?>class="dropdown">
						<a href = '#' class="dropdown-toggle" data-toggle="dropdown"> Trends<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li>  <a id='trends'">Local Trends</a>	</li>
							<li><a href = "trendtest.php">WorldWide Trends</a></li>
						</ul>
					</li>
				</ul>
				
		<?php 

		function echoActiveClassIfRequestMatches($requestUri)	
			{
			$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

		if ($current_file_name == $requestUri)
			echo 'class="active"';
		}

		?>

				
				
				
				
			
			</div>
			</div>
			
		</div>
			
	</nav>
	
	<div>
		<div class="modal fade" id="popUpWindow"> 
			<div class="modal-dialog">
				<div class="modal-content">
					
					<!-- header -->
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"> &times; </button>
						<h3 class="modal-title"> Sign In</h3>
					</div>
					
					<!-- Body -->
					
					<div class="modal-body"> 
						<form role="form">
							<div class="form-group">
								<input type="email" class="form-control" placeholder="Email">
							</div>
							
							<div class="form-group">
								<input type="password" class="form-control" placeholder="Password">
							</div>
						</form>
					</div>
					
					<!-- Button -->
					<div class="modal-footer">
						<button class="btn btn-primary btn-block"> Log In </button>
					</div>
					
				</div>
			</div>
		</div>
	
	</div>
		
	<form id="trender" action="trendtest.php" method="post" enctype="multipart/form-data">
		<input id="latitude" name="latitude" type="hidden">
		<input id="longitude" name="longitude" type="hidden">
	</form>
	
	<script>
	$(document).ready(function() {
    $('a[href="' + this.location.pathname + '"]').parent().addClass('active');
});
	</script>
	
</html>