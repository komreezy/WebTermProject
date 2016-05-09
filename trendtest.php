<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  
  
  <script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/bootstrap.min.js"></script>
  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
	<nav class="navbar navbar-inverse">
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
					<li>  <a href="home.php">Home</a></li>
					<li class="active"> <a href="trendtest.php">Statistics</a> </li>
					<li> <a href="index.php">Polarize</a> </li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right"> 
					<li> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#popUpWindow"> SignIn/SignOut </button> </li>
				</ul>
			
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

	
	








<body>

  <?php
  		require_once('TwitterAPIExchange.php');
 
			/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		    'oauth_access_token' => "3344215463-XNj7sDb8WaCvjEbErOHTqaCv9HdlHeZcU7The5X",
		    'oauth_access_token_secret' => "4uPiJrFsL0SuWIefaT3RMnPmR684ce29LrWnY35pI1Lkw",
		    'consumer_key' => "60EwKn8kG8sDW45ZcuFJByOmd",
		    'consumer_secret' => "xOk1d9wqPpzTIK68gACMG5lrv2M587ItlHNe3e2j0auVFQ9VBx"
		);
		$lat = 0;
		$lon = 0;
		if(isset($_POST["latitude"])){
			$lat = $_POST["latitude"];
		}if(isset($_POST["longitude"])){
			$lon = $_POST["longitude"];
		}
		$url = 'https://api.twitter.com/1.1/trends/closest.json';
		$requestMethod = 'GET';
		$count = "50"; //The amount of tweets to show
		$getfield = '?lat=' . $lat . '&long=' . $lon;
		$twitter = new TwitterAPIExchange($settings);
		$string = $twitter->setGetfield($getfield)
			->buildOauth($url, $requestMethod)
			->performRequest();
		//echo $lat;
		//echo $lon;
		echo "<p>At location:</p></br>";
		$result = json_decode($string, true); 
		foreach($result as $items)
		{
			echo "<div class='match'>";
			echo "name: ".$items['name']."<br />";
			echo "country: ".$items['country']."<br />";
			$woeid = $items['woeid'];
			echo "woeid: ".$items['woeid']."<br />";
			echo "</div>";
		}
		
		$newUrl = 'https://api.twitter.com/1.1/trends/place.json';
		$requestMethod = 'GET';
		$count = "50"; //The amount of tweets to show
		$getfield = '?id=' . $woeid;
		$twitter = new TwitterAPIExchange($settings);
		$newString = $twitter->setGetfield($getfield)
			->buildOauth($newUrl, $requestMethod)
			->performRequest();
		echo "<p>Current trends:</p></br>";
		$newResult = json_decode($newString, true);
		$counter = 0; 
		foreach($newResult as $array){
			foreach($array['trends'] as $items){
				{
					$trend = $items['name'];
					//$trend = str_replace('+', ' ', $trend); // Replaces all spaces with hyphens.
					$trend = preg_replace('/[^A-Za-z0-9 \-]/', '', $trend);
					echo "<div class='match' id=' ". $counter ." ' onclick='formSubmit(&#39;".$trend."&#39;)'>";
					echo "tweet volume: ".$items['tweet_volume']."<br />";
					echo "name: ".$items['name']."<br />";
					echo "url: ".$items['url']."<br />";
					echo "</div>";
				}
			}
		}
		
?>

	<form id="matcher" action="index.php" method="post" enctype="multipart/form-data">
		<input id="search" name="search_result" type="hidden">
	</form>

</body>
<script>
var test;
function formSubmit(trend){
	var search = document.getElementById("search");
	console.log(trend);
	search.setAttribute("value", trend);
	document.getElementById('matcher').submit();
}
</script>
</html>