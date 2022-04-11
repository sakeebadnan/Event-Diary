<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>Document</title>
</head>
<?php include_once("auth.php");  
       require_once "src/data.php";
?>


    <body>

    <?php
     
        if(isset($_POST['submit'])){
            $now = DateTime::createFromFormat('U.u', microtime(true));
            $_POST['eventId']=$now->format("m-d-Y H:i:s.u");
            $_POST['category']="Self";
            $_POST['eventUrl']="#";
            $_POST['imageUrl']="http://event-diary.herokuapp.com/img/logo.png";
            $_POST['Id']=$_SESSION['Id'];
              
            $data = new data;
            $response = $data->InsertEventsDb($_POST);
            if($response=='success'){
                echo '<script>alert("You need to Select a Category")</script>';
                unset($_POST);
                header("Location: index.php");   
            }else {
                echo '<script>alert("Sorry Event not Saved, Check your input or something went wrong, please try again")</script>';
                unset($_POST);
            }
        }else{
?>        
        <main>

            <div class="">
                <h2>Create Event</h2>
            </div>
            <div class="formCEvent"> 
                <form action="" method="post" name="customerReg" id= "cr">           
                    <input id="en" name="eventName"  placeholder="Event Name" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required tabindex="1"><br>
                    
                    <input type="date" id="ed" name="eventDate" required tabindex="2">
                    <label for="eDate">: Event Date</label><br>
                    <input type="time" id="et" name="eventTime" required tabindex="3">
                    <label for="etime">: Event Time</label><br>
                    <input id="ead" name="address"  placeholder="Address" type="text" required tabindex="4"><br>
                    <input id="ect" type="text"  name="city" placeholder="City" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required tabindex="5"><br>
                    <input id="eco" name="country"  placeholder="Country" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required tabindex="6"><br>
                    <br><input name="submit" id="ceSub" type="submit" value="Submit" tabindex="7">
                </form>
            </div>
        </main>

<?php require 'footer.php';} ?>
    </body>
</html>
