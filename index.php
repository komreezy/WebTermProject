<?php include 'common.php'; ?>

<!DOCTYPE html>
<html>
<body>
	<div id="left">
		<h1>
			Love
		</h1>
		<?php
			require_once __DIR__ . '/phpInsight-master/autoload.php';
			$sentiment = new \PHPInsight\Sentiment();
			if(isset($_POST["search_result"])){
				$query = $_POST["search_result"];
				$getfield = '?q="love%20' . $query . '"&result_type=recent&count='.$count.'filter=safe';
				$twitter = new TwitterAPIExchange($settings);
				$string = $twitter->setGetfield($getfield)
				    ->buildOauth($url, $requestMethod)
				    ->performRequest();
				 
				$result = json_decode($string, true); 
				foreach($result['statuses'] as $items)
				{
					// calculations:
					$scores = $sentiment->score($items['text']);
					$class = $sentiment->categorise($items['text']);
					if($scores['pos'] > 0.5) {
						echo "<div class='match'>";
						echo "Tweet: ". $items['text']."<br />";
						//to see scores uncomment
						//echo "Dominant:". $class.", scores: ";
						print_r($scores);
						echo "Time and Date of Tweet: ".$items['created_at']."<br />";
						echo "Tweeted by: ". $items['user']['name']."<br />";
						echo "Screen name: ". $items['user']['screen_name']."<br />";
						echo "Followers: ". $items['user']['followers_count']."<br />";
						echo "Friends: ". $items['user']['friends_count']."<br />";
						echo "Listed: ". $items['user']['listed_count']."<br>";
						echo "Positivity Score: ". $scores['pos'] ."<br>";
						echo "Negativity Score: ". $scores['neg'] ."<br>";
						//echo "Neutrality Score: ". $scores['neu'] ."<br>";
						echo "</div>";
					}
				}
			}
		?>
		
	</div>
	<div id = "right">
		<h1>
			Hate
		</h1>	
		<?php 
			require_once __DIR__ . '/phpInsight-master/autoload.php';
			$sentiment = new \PHPInsight\Sentiment();
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
					// calculations:
					$scores = $sentiment->score($items['text']);
					$class = $sentiment->categorise($items['text']);
					if($scores['neg'] > 0.5) {
						echo "<div class='match'>";
						echo "Tweet: ". $items['text']."<br />";
						//to see scores uncomment
						//echo "Dominant:". $class.", scores: ";
						//print_r($scores);
						echo "Time and Date of Tweet: ".$items['created_at']."<br />";
						echo "Tweeted by: ". $items['user']['name']."<br />";
						echo "Screen name: ". $items['user']['screen_name']."<br />";
						echo "Followers: ". $items['user']['followers_count']."<br />";
						echo "Friends: ". $items['user']['friends_count']."<br />";
						echo "Listed: ". $items['user']['listed_count']."<br>";
						echo "</div>";
					}
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
