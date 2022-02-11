<?php
	include_once("auth.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SearchEvent</title>
		<link rel="shortcut icon" type="image/jpg" href="img/logo.png"/>
		<link rel="stylesheet" href="css/style.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="js/jquery-3.5.1.min.js"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
	
		<div class="content">
			<div>
				<label for="cars">Choose an event category:</label>
				<select name="category" id="category" onchange="searchEvents();">
				<option >Select</option>
				<option value="sports">Sports</option>
				<option value="music">Music</option>
				<option value="food">Food</option>
				<option value=" ">Rest</option>
				</select>
				<input id="city" name="city"  placeholder="City" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" ><br>
				<input type='button' name='save' value='save' onclick='insertevent()'>
			</div>
			<table class='eventstable' id='evTable'>
			</table>
		</div>
<?php
		include('footer.php');
?>
	</body>
</html>