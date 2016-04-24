

<!DOCTYPE html>
<html>
<head>
	<title>Polarize The Web</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
	<div id="left">
		<h1>
			Love
		</h1>
		
		
	</div>
	<div id = "right">
		<h1>
			Hate
		</h1>	
		<?php include 'Polarize.php'; ?> 
		
	</div>
	<form id="searchbox" action="Polarize.php" method="post">
	    <input id="search" name="search" type="text" placeholder="Search Topics">
	    <input id="submit" type="submit" value="Search">
	</form>
	
</body>
<script src="visual.js"></script>
</html>