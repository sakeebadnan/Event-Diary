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
						<option>--Select--</option>
						<option value="sports">Sports</option>
						<option value="music">Music</option>
						<option value="food">Food</option>
						<option value="all">Rest</option>
						
					</select>
				</div>
				<div>
					<label for="txtCity:">Choose a City:</label>
					<select name="City" required>
						<option>--Select--</option>
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
	$events=$db->seeEvents($_POST["Category"],$_POST["City"],$_SESSION['Id']);
	$y=0;
    {      
        foreach($events as $row){
			$y++;      
			if($y==1){
				?>
				<form method="post" class="delEvent">
					<table class='eventstable'>
						
						<tr>
							<th></th>
							<th>Name</th>
							<th class='other'>Category</th>
							<th class='other'>Date</th>
							<th class='other'>Time</th>
							<th class='other'>Address</th>
							<th class='other'>City</th>
							<th class='other'>Country</th>
							<th>Picture</th>
						</tr>
		<?php
				}
				$colorIndex++;
				if($colorIndex%2==0){
					$alterNativeColor='odd';
				}else{
					$alterNativeColor='even';
				}

				echo "<tr class=${alterNativeColor}>";
				echo "<td><input class='eventid' name = '".$y."' type='checkbox' id='".$row->EventId."' value='".$row->EventId."' ></td>";
				echo "<td class='ename'><a href='". $row->EventUrl."'>".$row->EventName."</a></td>";
				echo "<td class='other'>" . $row->Category."</td>";
				echo "<td class='other'>" . $row->EventDate."</td>";
				echo "<td class='other'>" . $row->EventTime."</td>";
				echo "<td class='other'>" . $row->Address."</td>";
				echo "<td class='other'>" . $row->CityName."</td>";
				echo "<td class='other'>" . $row->Country."</td>";
				echo "<td class='epic'><img class='eventimg' src='" . $row->ImageUrl."'></td>";
				echo "</tr>";
			}
			
		}
		if($y==0) echo "<h3>No Event Found in databse.<h3>";
		else {$_SESSION['y']=$y;
			echo '</table>';
			echo '<input type="submit" name="delete" value="Delete">';	
			echo "</form>";
		}
		
}
?>
		</div>
<?php
					include('footer.php');
			?>	
	</body>
</html>