<?php
session_start();
if(!isset($_SESSION["Name"])){
    header("Location: login.php");
    exit(); 
    }else
    {
?>
<div class="header">
    <img src="img/logo.png" class='logo'/>
    <a href="index.php" class="gohome">Home</a>
    
    
    <span class="loginbstatus">
        <span class='welcome'>Welcome <?php echo $_SESSION['Name']; ?>!
        </span>
        <span class='welcome'>
            &nbsp;<a href="logout.php" class="logout">Logout</a>
        </span>
        <br>
        <span class='othermenu'>
            &nbsp;<a href="editUser.php" class="logout">Edit Profile</a>
            &nbsp;<a href="changePassword.php" class="logout">Change Password</a>
        </span>
        
    </span>
</div>

<?php

    }
?>