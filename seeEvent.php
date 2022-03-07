<?php
	include_once("auth.php");
	require('src/data.php');
	$db = new data;  
	$returnValue=$db->CityList($_SESSION['Id']);
	
        
?>
<html>
	<head>
	<link rel="shortcut icon" type="image/jpg" href="img/logo.png"/>
	<link rel="stylesheet" href="css/style.css">
	</head>
	<body>


	<div class="content">
		<div>
			<h1>See Your Event </h1>

			<form method="post" class="seeEvent">						
				<div>
					<label for="txtCategory:">Choose a Category:</label>
					<select name="Category" required>
						<option value="not">--Select--</option>
						<option value="sports">Sports</option>
						<option value="music">Music</option>
						<option value="food">Food</option>
						<option value="all">Rest</option>
						
					</select>
				</div>
				<div>
					<label for="txtCity:">Choose a City:</label>
					<select name="City" required>
						<option value="all">All</option>
<?php
						for($x = 0; $x < count($returnValue); $x++)
							echo "<option value='".$returnValue[$x]."'>".$returnValue[$x]."</option>";
						
?>						
					</select>
				</div>

				<input type="submit" name="submit" value="Submit">	
			</form>
		</div>
<?php
if(isset($_POST['delete'])){
	
	for($x = 1; $x <=$_SESSION['y']; $x++){
		if(isset($_POST[$x])){
			$delRet=$db->delEvent($_POST[$x],$_SESSION['Id']);
			if($delRet==true)echo "<script> alert('Delete Successful.');</script>" ;
			else echo "<script> alert('Somthing went wrong.');</script>" ;
		}		
	}
}	
				$colorIndex=0;
				$alterNativeColor='even';
if(isset($_POST['submit'])){
	if(($_POST["Category"]=='not')){
		echo '<script>alert("You need to Select a Category")</script>';
	}else{
		$events=$db->seeEvents($_POST["Category"],$_SESSION['Id']);
		$y=0;
		{      
			foreach($events as $row){
				if($_POST['City']!='all'){
					if($_POST['City']==$row->CityName){
						$y++;
						$colorIndex++;
					if($colorIndex%2==0){
						$alterNativeColor='odd';
					}else{
						$alterNativeColor='even';
					}
						$db->tableSeeEvent($row,$colorIndex,$alterNativeColor,$y);
					}
				}
				else{
					$y++;
					$colorIndex++;
					if($colorIndex%2==0){
						$alterNativeColor='odd';
					}else{
						$alterNativeColor='even';
					}
					$db->tableSeeEvent($row,$colorIndex,$alterNativeColor,$y);
				}
			}
		}
		if($y==0) echo "<h3>No Event Found in databse.<h3>";
		else {$_SESSION['y']=$y;
			echo '</table>';
			echo '<input type="submit" name="delete" value="Delete">';	
			echo "</form>";
		}
	}
	unset($_POST['submit']);		
}
?>
		</div>
<?php
					include('footer.php');
?>	
	</body>
</html>