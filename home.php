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
					<li class="active"> <a href="home.php">Home</a></li>
					<li> <a href="trendtest.php">Statistics</a> </li>
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

	
	
</html>
