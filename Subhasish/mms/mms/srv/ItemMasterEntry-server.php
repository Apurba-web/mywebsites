
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

  $ItemName = $ItemType = "";
  $ItemUnitPrim = $ItemUnitSec="";
  $Dim = $DimUnit="";
  $ConversionFactor = $GSTCode = $GSTPer ="";
  $ICode="0001";
  $LastSrl=0;

  $error_cnt = 0;

  //echo "Get Data";

  if(isset($_POST['submit'])) {
    try {
      $db = OpenCon();
      if ($db->connect_errno) {
        echo "Connection Error";
        throw new Exception("Cannot connect to database: ".$db->connect_error);
      }

      $ItemName = $db -> real_escape_string($_POST["ItemName"]);
      $ItemType = $db -> real_escape_string($_POST["ItemType"]);
      $ItemUnitPrim = $db -> real_escape_string($_POST["ItemUnitPrim"]);
      $ItemUnitSec = $db -> real_escape_string($_POST["ItemUnitSec"]);
      $Dim = $db -> real_escape_string($_POST["Dim"]);
      $DimUnit = $db -> real_escape_string($_POST["DimUnit"]);
      $ConversionFactor = $db -> real_escape_string($_POST["ConversionFactor"]);
      $GSTCode = $db -> real_escape_string($_POST["GSTCode"]);
      $GSTPer = $db -> real_escape_string($_POST["GSTPer"]);

      if(empty("$ItemUnitPrim")) {$_SESSION['error'] = "enter Item Unit(Primary) ..."; $error_cnt = 1;}
      if(empty("$ItemType")) {$_SESSION['error'] = "enter Item Type ..."; $error_cnt = 1;}
      if(empty("$ItemName")) {$_SESSION['error'] = "enter Item Name ..."; $error_cnt = 1;}

      if($error_cnt == 0) {

        $sql=$db->prepare("SELECT MAX(srl) AS LastSrl FROM item");

        if (!$sql->execute()) {
          throw new Exception($db -> error);
          echo "Error in Last Serial";
        }
        else {

          $sql->store_result();
          $sql->bind_result($LastSrl);

         $num_of_rows = $sql->num_rows;

          if($num_of_rows > 0) {
            while ($row = $sql->fetch()) {
              $ICode=substr("0000".$LastSrl+1,-4);
              }
            }
          else {
              $ICode="0001";
              }

        $sql=$db->prepare("INSERT INTO item (i_code, i_name, i_type, i_uom_primary,i_uom_secondary,i_conversion_factor,i_dimension, i_dimension_unit, i_gst_code, i_gst_percentage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssssdissd", $ICode, $ItemName, $ItemType, $ItemUnitPrim, $ItemUnitSec, $ConversionFactor, $Dim, $DimUnit, $GSTCode, $GSTPer);

          if (!$sql->execute()) {
            throw new Exception($db -> error);
            echo "Error";
          }
          else {
              echo "Inserted Successful";
            }
            $sql->close();
        }
      }
      //
      //
      $db->close();

    } catch (Exception $e) {
      error_log($e -> getMessage());
    }
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
            $a = array();
              if($num_of_rows > 0)
              {
            //  $a = array();
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
