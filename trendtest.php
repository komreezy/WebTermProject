<script>
var x = document.getElementById("left");
showPosition(getLocation());

function getLocation() {
    if (navigator.geolocation) {
        return navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude; 
}
</script>

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
		$getfield = '?lat=37.781157&long=-122.400612831116';
		$twitter = new TwitterAPIExchange($settings);
		$string = $twitter->setGetfield($getfield)
			->buildOauth($url, $requestMethod)
			->performRequest();
		 
		$result = json_decode($string, true); 
		foreach($result['trends'] as $items)
		{
			echo "<div id='match'>";
			echo "woeid: ".$items['woeid']."<br />";
?>