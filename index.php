<!DOCTYPE html>
<html>
<head>
	<title>Polarize The Web</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
					echo "<div id='match'>";
					echo "Time and Date of Tweet: ".$items['created_at']."<br />";
					echo "Tweet: ". $items['text']."<br />";
					echo "Tweeted by: ". $items['user']['name']."<br />";
					echo "Screen name: ". $items['user']['screen_name']."<br />";
					echo "Followers: ". $items['user']['followers_count']."<br />";
					echo "Friends: ". $items['user']['friends_count']."<br />";
					echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
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
					echo "Time and Date of Tweet: ".$items['created_at']."<br />";
					echo "Tweet: ". $items['text']."<br />";
					echo "Tweeted by: ". $items['user']['name']."<br />";
					echo "Screen name: ". $items['user']['screen_name']."<br />";
					echo "Followers: ". $items['user']['followers_count']."<br />";
					echo "Friends: ". $items['user']['friends_count']."<br />";
					echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
					echo "</div>";
					
				}
			}

		 ?> 
		
	</div>
	<form id="searchbox" action="index.php" method="post" enctype="multipart/form-data">
	    <input id="search" name="search_result" type="text" placeholder="Search Topics">
	    <input id="submit" type="submit" value="Search">
	</form>
	
</body>
<script src="visual.js"></script>
</html>
