<?php include_once("auth.php");  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>Document</title>
</head>
    <body>

    <?php
        require_once "src/data.php";
        if (isset($_POST['FirstName'])&& isset($_POST['LastName'])){
                              
            $data = new data;
            $response = $data->updateUser($_POST);
            if($response==true){
                echo "<div>
                        <p>Your Profile has been updated, please <a href='logout.php'>Login</a> again.</p>
                    </div>";
            }else echo "<div>
                            <p>Some Error Found., please <a href='editUser.php'>Try Again</a>.</p>
                        </div>";
        }else{
?>        
        <main>

            <div class="">
                <h2>Edit Profile</h2>
            </div>
            <div class="formEdit">  
                <form action="" id="editCust" method="POST" class="edit">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input  type="text" name="FirstName" id="fname" value=<?php echo $_SESSION['FirstName']; ?> required="required">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input  type="text" name="LastName" id="lname" value=<?php echo $_SESSION['LastName']; ?> required="required">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input  type="number" name="Age" id="age" value=<?php echo $_SESSION['Age']; ?> required="required">
                    </div>              
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input  type="text" name="Address" id="address" class="form-control" value=<?php echo $_SESSION['Address']; ?>>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input  type="text" name="City" id="city" class="form-control" value=<?php echo $_SESSION['City']; ?>>
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <input  type="text" name="State" id="state" class="form-control" value=<?php echo $_SESSION['State']; ?>>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="Country" id="country" class="form-control" value=<?php echo $_SESSION['Country']; ?>>
                    </div>
                    <div class="form-group">
                        <label for="postalcode">Postal Code</label>
                        <input  type="text" name="PostalCode" id="postalcode" class="form-control" value=<?php echo $_SESSION['PostalCode']; ?>>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input  type="phone" name="Phone" id="phone" class="form-control" value=<?php echo $_SESSION['Phone']; ?> >
                    </div>
                    <div class="form-group">
                        <input  type="hidden"  name="Id" id="Id" value=<?php echo $_SESSION['Id']; ?>>
                    </div>       
                    <div class="form-group">
                        <button type="submit" class="btn btn-info" id="editCustomer">Edit Customer</button>
                    </div>

                </form>
            </div>
        </main>

<?php require 'footer.php';} ?>
    </body>
</html>
