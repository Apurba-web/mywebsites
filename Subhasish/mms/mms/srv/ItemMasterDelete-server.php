  <?php //echo "here-Server"; ?>

  <?php
  session_start();
  //
  // set session variable
  $_SESSION["ItemName"] = "";



  require_once( dirname( __FILE__ ) . "/dbConnect.php" );
  require_once( dirname( __FILE__ ) . "/server-lib.php" );
  //
  unset($_SESSION['error']);
  unset($_SESSION['success']);


  //
  // get data
  //

  $error_cnt = 0;

  //echo "Get Data";

  if(isset($_POST['Submit'])) {
    try {
      $db = OpenCon();
      if ($db->connect_errno) {
        echo "Connection Error";
        throw new Exception("Cannot connect to database: ".$db->connect_error);
      }

      $ICode = $_POST['icode'];

      $ItemName = $db -> real_escape_string($_POST["ItemName"]);
      $ItemType = $db -> real_escape_string($_POST["ItemType"]);
      $ItemUnitPrim =$db -> real_escape_string($_POST["ItemUnitPrim"]);
      $ItemUnitSec =$db -> real_escape_string($_POST["ItemUnitSec"]);
      $Dim=$db -> real_escape_string($_POST["Dim"]);
      $DimUnit=$db -> real_escape_string($_POST["DimUnit"]);
      $ConversionFactorn=$db -> real_escape_string($_POST["ConversionFactor"]);
      $GSTCode=$db -> real_escape_string($_POST["GSTCode"]);
      $GSTPer=$db -> real_escape_string($_POST["GSTPer"]);

      if(empty("$ItemName")) {$_SESSION['error'] = "enter Item Name ..."; $error_cnt = 1;}

      if($error_cnt == 0) {

      $sql=$db->prepare("DELETE FROM item WHERE i_code = ?");

      $sql->bind_param("s", $ICode);

        if (!$sql->execute()) {
          throw new Exception($db -> error);
          echo "Error in Last Serial";
        }
        else {

          echo "Updated Successful";

          session_regenerate_id();
          header('location: ../forms/ItemMasterEntry.php');

        }
      $db->close();
      }

    } catch (Exception $e) {
      error_log($e -> getMessage());
    }
  //echo "End";
    //
  }

  function SelectData()
  {

    try {
      $db = OpenCon();
      if ($db->connect_errno) {
        echo "Connection Error";
        throw new Exception("Cannot connect to database: ".$db->connect_error);
         }

      $sql=$db->prepare("SELECT i_code,i_name FROM item order by i_name");


        if (!$sql->execute()) {
          throw new Exception($db -> error);
          echo "Error in Last Serial";
          }
        else {
          $sql->store_result();
          $sql->bind_result($Bind_ICode,$Bind_IName);
          $num_of_rows = $sql->num_rows;
            if($num_of_rows > 0)
            {
            $a = array();
            while ($sql->fetch()) {
                array_push($a,array("IName"=>$Bind_IName, "ICode"=>$Bind_ICode));
                }
            }
          }
         }  catch (Exception $e) {
           error_log($e -> getMessage());
        }
         $sql->close();
  return($a);
  }

  ?>
