<?php
  session_start();
  //$user = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include 'head.php'; ?>
    <title>MMS : M e n u</title>
  </head>
  <body>
    <?php
      $FormTitle = "";
      require_once( dirname( __FILE__ ) . "/pg-caption.php" );
      require_once( dirname( __FILE__ ) . "/nav.php" );
    ?>
  </body>

  <script src= "../js/nav.js"></script>

</html>
