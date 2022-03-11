<?php include_once("auth.php");  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>Unsubscribe</title>
</head>
    <body>

   
    <script>
      let text = "It will delete all your events and information.";
      if (confirm(text) == true) {
        window.location.href ='logout.php';;
      } else {
        window.location.href ='index.php';
      }
    </script>
  

<?php require 'footer.php'; ?>
    </body>
</html>