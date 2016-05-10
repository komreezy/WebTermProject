<?php include 'common.php'; ?>

<!DOCTYPE html>
<html>
<body style="background-color: #3498db">
	<form id="dbsearch" action="dbsearch.php" method="post" enctype="multipart/form-data">
		<input id="location" name="location" type="text" placeholder="Search by Location">
		From <input id="minyear" name="minyear" type="text" placeholder="YYYY" maxlength="4" size="4">
		<input id="minday" name="minday" type="text" placeholder="DD" maxlength="2" size="2">
		<input id="minmonth" name="minmonth" type="text" placeholder="MM" maxlength="2" size="2">
		To <input id="maxyear" name="maxyear" type="text" placeholder="YYYY" maxlength="4" size="4">
		<input id="maxday" name="maxday" type="text" placeholder="DD" maxlength="2" size="2">
		<input id="maxmonth" name="maxmonth" type="text" placeholder="MM" maxlength="2" size="2">
		<input id="volume" name="volume" type="text" placeholder="Minimum Tweet Volume">
		<input id="dbsubmit" type="submit" value="Search">
	</form>
  
	<p>Tweets meeting criteria:</p>

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
			$location = "Worldwide";
			$minyear = "";
			$minday = "";
			$minmonth = "";
			$maxyear = "";
			$maxday = "";
			$maxmonth = "";
			$volume = 0;
			
			$query = "SELECT DISTINCT text, location, date, volume
						FROM trends t
						WHERE";
			
			if(!empty($_POST["location"])){
				$location = $_POST['location'];
			}
			
			$query = $query . " t.location LIKE '" .mysql_escape_string($location). "%'";
			
			if(!empty($_POST["minyear"]) && !empty($_POST["minday"]) && !empty($_POST["minmonth"])){
				$minyear = $_POST['minyear'];
				$minday = $_POST['minday'];
				$minmonth = $_POST['minmonth'];
				$mindate = $minyear . $minday . $minmonth;
				$query = $query . " AND t.date >= '" .mysql_escape_string($mindate). "'";
			}
			
			if(!empty($_POST["maxyear"]) && !empty($_POST["maxday"]) && !empty($_POST["maxmonth"])){
				$maxyear = $_POST['maxyear'];
				$maxday = $_POST['maxday'];
				$maxmonth = $_POST['maxmonth'];
				$maxdate = $maxyear . $maxday . $maxmonth;
				$query = $query . " AND t.date <= '" .mysql_escape_string($maxdate). "'";
			}
			
			if(!empty($_POST["volume"])){
				$volume = $_POST['volume'];
				$query = $query . " AND t.volume >= '" .mysql_escape_string($volume). "'";
			}
			
			$query = $query . " GROUP BY text ORDER BY text ASC;";
			
			//echo $query;
			
			$result = $db->query($query);
			
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				echo '<div>';
				$trend = $row['text'];
				echo "<div class='match' id='clickable' onclick='matchSubmit(&#39;".$trend."&#39;)'>";
				echo "tweet volume: ".$row['volume']."<br />";
				echo "name: ".$row['text']."<br />";
				echo "location: ".$row['location']."<br />";
				echo "date: ".$row['date']."<br />";
				echo "</div>";
			}
			
		}catch(Exception $e){
			echo $e;
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