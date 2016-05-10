<?php include 'common.php'; ?>

<!DOCTYPE html>
<html>
<body style="background-color: #3498db">
  <?php
  		set_error_handler('exceptions_error_handler');

		function exceptions_error_handler($severity, $message, $filename, $lineno) {
		  if (error_reporting() == 0) {
			return;
		  }
		  if (error_reporting() & $severity) {
			throw new ErrorException($message, 0, $severity, $filename, $lineno);
		  }
		}
  
  		try{
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
			foreach($newResult as $array){
				foreach($array['trends'] as $items){
					{
						$trend = $items['name'];
						//$trend = str_replace('+', ' ', $trend); // Replaces all spaces with hyphens.
						$trend = preg_replace('/[^A-Za-z0-9 \-]/', '', $trend);
						echo "<div class='match' id='clickable' onclick='matchSubmit(&#39;".$trend."&#39;)'>";
						echo "tweet volume: ".$items['tweet_volume']."<br />";
						echo "name: ".$items['name']."<br />";
						echo "url: ".$items['url']."<br />";
						echo "</div>";
					}
				}
			}
		}catch(Exception $e){
			echo "Error: Could not receive data from Twitter. This is probably caused by an overload of calls to the server. Please try again soon.";
		}
		
?>

	<form id="matcher" action="index.php" method="post" enctype="multipart/form-data">
		<input id="search" name="search_result" type="hidden">
	</form>

</body>
<script src="visual.js"></script>
<script>
function matchSubmit(trend){
	var search = document.getElementById("search");
	console.log(trend);
	search.setAttribute("value", trend);
	document.getElementById('matcher').submit();
}
</script>
</html>