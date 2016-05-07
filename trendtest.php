<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
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
		//echo $string;
		$result = json_decode($string, true); 
		foreach($result as $items)
		{
			echo "<div id='match'>";
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
		echo $newString;
		$newResult = json_decode($newString, true); 
		foreach($newResult as $array){
			foreach($array as $date){
				foreach($date as $trend)
				{
					echo "<div id='match'>";
					echo "tweet volume: ".$items['tweet_volume']."<br />";
					echo "name: ".$items['name']."<br />";
					echo "url: ".$items['url']."<br />";
					echo "</div>";
				}
			}
		}
?>

</body>
</html>
