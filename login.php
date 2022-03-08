<?php
session_start();
?>
<!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8">

		<title>Login</title>
		<link rel="shortcut icon" type="image/jpg" href="img/logo.png"/>
		<link rel="stylesheet" href="css/style.css">

	</head>

	<body>

<?php

		require_once "src/data.php";
		if (isset($_POST['email'])){

			$data = new data;

			$response = $data->getUser($_POST['email']);
			if($response['return']==false){
				echo "<div>
						<p>User Email address is incorrect.</p>
						<p><a href='index.php'>Try Again</a></p>
						<p><a href='registration.php'>For Register </a></p>
						</div>";
			}else{
				$pass=$response['Password'];
				if(!isset($_POST['password'])) $_POST['password']==' ';
				if(password_verify($_POST['password'], $pass)){   
					foreach($response as $key => $value) {
						$_SESSION[$key]=$value;
					}
					$_SESSION['Name']=$_SESSION['FirstName'].' '.$_SESSION['LastName'];
					unset($_POST);
					header('Location: index.php?login=Success');
				}else{
					echo "<div>
						<p>Password is incorrect.</p>
						<p><a href='index.php'>Try Again</a></p>
						<p><a href='registration.php'>For Register </a></p>
					</div>";
				}
				

			}
		}else{

?>

		<div class="content">

			<div class="loginbox">

				<h1>Event Diary </h1>

				<h2>Log In</h2>

				<form action="" method="post" name="login">

				  <span class='formelementc'>

					<input type="email" name="email" placeholder="E-Mail" required class='formelement'/>

					</span>

					<span class='formelementc'>

					<input type="password" name="password" placeholder="Password" required class='formelement' />

					</span>

					<span class='formelementc'>

					<input name="submit" type="submit" value="Login" class="button"/>

					</span>

				</form>				

				<span class='formelementc'>Not registered yet? <a href='registration.php'>Register Here</a></span>

			</div>

		</div>
	

		<?php 
		include_once('footer.php');
	} ?>

	</body>

</html>