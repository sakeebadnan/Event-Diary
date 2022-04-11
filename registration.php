<?php
  session_start();
  if(isset($_SESSION['Name'])){
    header('Location: index.php');
    
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css" />
    <title>Register</title>
  </head>
  <body>
    <header>
        <h1>Welcome To User Registration</h1>
    </header>	
    <main>
      
<?php
      require_once "src/data.php";
      if (isset($_POST['Email'])){
        //echo 'email';
        $data = new data;
        $response = $data->getUser($_POST['Email']);
        if($response['return']==false){
          $add = $data->addUser($_POST);
          if($add==true){
            echo "<div>
                <p>Thanks for Registration, Please go to <a href='index.php'>>Login<</a></p>
                </div>";
          }
          else{
            echo "<div>
                <p>Something went wrong or Some input is not valid, Please try again later.</p>
                <p>To go to <a href='index.php'>>Login<</a></p>
                </div>";
          }
        }else{
        echo "<div>
              <p>A user already exists for the E-Mail you entered. Try with <a href='registration.php'>>Another E-Mail<</a>.</p>
              <p>To go to <a href='index.php'>>Login<</a></p>
              </div>";
        }
      }else{
?>
		<div class="content">

<div class='registrtionform'>
      <div class ="CRform">
          <form action="" method="post" name="customerReg" id= "cr">           
              <span class='formelementc'><input class='formelement' id="fn" name="FirstName"  placeholder="First Name" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required tabindex="1"></span><br>
              <span class='formelementc'><input class='formelement' id="ln" name="LastName"  placeholder="Last Name" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required tabindex="2"></span><br>
              <span class='formelementc'><input class='formelement' id="pw" type="password"  name="Password" placeholder="Password" required tabindex="3"></span><br>
              <span class='formelementc'><input class='formelement' id="em" placeholder="Email Address" type="email" name="Email"  required tabindex="4"></span><br>
              <span class='formelementc'><input class='formelement' id="ag" placeholder="Age" type="number" name="Age"  required min="1" max="99" tabindex="5"></span><br>
              <span class='formelementc'><input class='formelement' id="ad" name="Address"  placeholder="Address" type="text" tabindex="6"></span><br>
              <span class='formelementc'><input class='formelement' id="ct" type="text"  name="City" placeholder="City" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" tabindex="7"></span><br>
              <span class='formelementc'><input class='formelement' id="st" name="State"  placeholder="State" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" tabindex="8"></span><br>
              <span class='formelementc'><input class='formelement' id="co" name="Country"  placeholder="Country" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" tabindex="9"></span><br>
              <span class='formelementc'><input class='formelement' id="pc" type="text"  name="PostalCode" placeholder="Postal Code" tabindex="10"></span><br>
              <span class='formelementc'><input class='formelement' id="ph" name="Phone"  placeholder="Phone Number" type="phone"  tabindex="11"></span><br>
              <span class='formelementc'><input class="button registrationbutton" name="submit" id="customerRegistration" type="submit" value="Submit" tabindex="12"></span>
          </form>
      <div>
        <p>Back to <a href='index.php'>>Login<</a></p>
      </div>
      </div>
</div>
    </main>
<?php 
        include_once('footer.php');
      }
?> 
  </body>
</html>
