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
        Welcome <?php echo $_SESSION['Name']; ?>!
        &nbsp;<a href="editUser.php" class="logout">Edit Profile</a>
        &nbsp;<a href="changePassword.php" class="logout">Change Password</a>
        &nbsp;<a href="logout.php" class="logout">Logout</a>
        &nbsp;<a href="delUser.php" class="unsub">Unsubscribe</a>
    </span>
</div>

<?php

    }
?>