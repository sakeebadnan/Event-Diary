<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Home</title>
		<link rel="shortcut icon" type="image/jpg" href="img/logo.png"/>		
		<link rel="stylesheet" href="css/style.css"> 
	</head>
	
<?php
	include_once("auth.php");
?>


	<body>
		<div class="content">
			<div>
				<h1>My Events</h1>
				<div class="form">
					
					<p><a href="seeEvent.php">See Event</a></p>
					<p><a href="searchEvent.php">Search Event</a></p>
					<p><a href="createEvent.php">Create Event</a></p>				
				</div>
			</div>
		<div>
			<span class="homepic"><img src='img/disco.jpg'></span>
			<span class="homepic"><img src='img/party1.jpg'></span>
			<span class="homepic"><img src='img/party2.jpg'></span>

			<span class="homepic"><img src='img/food.jpg'></span>
			<span class="homepic"><img src='img/food1.jpg'></span>
			<span class="homepic"><img src='img/food_reral_1.jpg'></span>


			<span class="homepic"><img src='img/sports1.jpg'></span>
			<span class="homepic"><img src='img/sports2.jpg'></span>
			<span class="homepic"><img src='img/sports3.jpg'></span>
		</div>
		<div style="clear: both;"></div>
<?php
			include('footer.php');
?>
		<div>
	</body>
	
</html>