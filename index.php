<!DOCTYPE html>
<html>
<head>
	<title>Polarize The Web</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  
  
  <link rel="import" href="nav.html">
  
  
  <?php
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
</head>
<body>


		<nav class="navbar navbar-inverse" style="margin: 0px;">
		<div class ="container-fluid">
			<!-- Logo -->
			<div class = "navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href ="home.php" class="navbar-brand"> Twitter Polarity</a>
			</div>
			
			<!-- Menu Items -->
			<div class="collapse navbar-collapse" id="mainNavBar">
				<ul class="nav navbar-nav">
					<li> <a href="home.php">Home</a></li>
					<li> <a id="trends">Trends</a> </li>
					<li class="active"> <a href="index.php">Polarize</a> </li>
				
					
				</ul>
				
				
				
				
				<ul class="nav navbar-nav navbar-right"> 
					<li> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#popUpWindow"> SignIn/SignOut </button> </li>
				</ul>
			</div>
		</div>
	</nav>
	
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
	
	
	
	<div id="left">
		<h1>
			Love
		</h1>
		<?php
			if(isset($_POST["search_result"])){
				$query = $_POST["search_result"];
				$getfield = '?q="love%20' . $query . '"&result_type=recent&count='.$count.'&filter=safe';
				$twitter = new TwitterAPIExchange($settings);
				$string = $twitter->setGetfield($getfield)
				    ->buildOauth($url, $requestMethod)
				    ->performRequest();
				 
				$result = json_decode($string, true); 
				foreach($result['statuses'] as $items)
				{
					echo "<div class='match'>";
					echo "Tweet: ". $items['text']."<br />";
					echo "Time and Date of Tweet: ".$items['created_at']."<br />";
					echo "Tweeted by: ". $items['user']['name']."<br />";
					echo "Screen name: ". $items['user']['screen_name']."<br />";
					echo "Followers: ". $items['user']['followers_count']."<br />";
					echo "Friends: ". $items['user']['friends_count']."<br />";
					echo "Listed: ". $items['user']['listed_count']."<br />";
					echo "</div>";
					
				}
			}
		?>
		
	</div>
	<div id = "right">
		<h1>
			Hate
		</h1>	
		<?php 
			if(isset($_POST["search_result"])){
				$query = $_POST["search_result"];
				$getfield = '?q="hate%20' . $query . '"&result_type=recent&count='.$count.'filter=safe';
				$twitter = new TwitterAPIExchange($settings);
				$string = $twitter->setGetfield($getfield)
				    ->buildOauth($url, $requestMethod)
				    ->performRequest();
				 
				$result = json_decode($string, true); 
				foreach($result['statuses'] as $items)
				{
					echo "<div id='match'>";
					echo "Tweet: ". $items['text']."<br />";
					echo "Time and Date of Tweet: ".$items['created_at']."<br />";
					echo "Tweeted by: ". $items['user']['name']."<br />";
					echo "Screen name: ". $items['user']['screen_name']."<br />";
					echo "Followers: ". $items['user']['followers_count']."<br />";
					echo "Friends: ". $items['user']['friends_count']."<br />";
					echo "Listed: ". $items['user']['listed_count']."<br>";
					echo "</div>";
					
				}
			}

		 ?> 
		
	</div>
	<form id="searchbox" action="index.php" method="post" enctype="multipart/form-data">
	    <input id="search" name="search_result" type="text" placeholder="Search Topics">
	    <input id="submit" type="submit" value="Search">
	</form>
	
	<form id="trender" action="trendtest.php" method="post" enctype="multipart/form-data">
		<input id="latitude" name="latitude" type="hidden">
	    <input id="longitude" name="longitude" type="hidden">
	</form>
	
</body>
<script src="visual.js"></script>
</html>
