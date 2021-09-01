
  <?php
  session_start();
  //
  // set session variable
  $_SESSION["GRDate"] = "";

  require_once( dirname( __FILE__ ) . "/dbConnect.php" );
  require_once( dirname( __FILE__ ) . "/server-lib.php" );
  //
  unset($_SESSION['error']);
  unset($_SESSION['success']);

  //
  // get data
  //

  $ItemCode = $SupplierCode = "";
  $Driver = $TicketNumber=$UOM="";
  $Quantity = $Bagwt = $Rate=0;
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

      $GRDate = $db -> real_escape_string($_POST["GRDate"]);
      $ItemCode = $db -> real_escape_string($_POST["ItemName"]);
      $SupplierCode = $db -> real_escape_string($_POST["SupplierName"]);
      $Driver= $db -> real_escape_string($_POST["Driver"]);
      $TicketNumber = $db -> real_escape_string($_POST["TicketNumber"]);
      $UOM = $db -> real_escape_string($_POST["UOM"]);
      $Quantity = $db -> real_escape_string($_POST["Quantity"]);
      $BagWt = $db -> real_escape_string($_POST["BagWt"]);
      $Rate = $db -> real_escape_string($_POST["Rate"]);
      $GRN = $db -> real_escape_string($_POST["GRN"]);


      if(empty("$GRDate")) {$_SESSION['error'] = "enter GR Date ..."; $error_cnt = 1;}
/*      if(empty("$ItemType")) {$_SESSION['error'] = "enter Item Type ..."; $error_cnt = 1;}
      if(empty("$ItemName")) {$_SESSION['error'] = "enter Item Name . .."; $error_cnt = 1;}
*/
      if($error_cnt == 0) {

        $sql=$db->prepare("DELETE FROM GRN WHERE GRN = ?");

        $sql->bind_param("s", $GRN);

        if (!$sql->execute()) {
          throw new Exception($db -> error);
          echo "Error in Last Serial";
        }
        else {

          echo "Delete Successful";

          session_regenerate_id();
          header('location: ../forms/GREntry.php');

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

        $sql=$db->prepare("SELECT GRN,i_name,s_name FROM GRNDETAILS ORDER BY GRN");

          if (!$sql->execute()) {
            throw new Exception($db -> error);
            echo "Error in Last Serial";
            }
          else {
            $sql->store_result();
            $sql->bind_result($Bind_GRN,$Bind_IName,$Bind_SName);
            $num_of_rows = $sql->num_rows;
              if($num_of_rows > 0)
              {
              $a = array();
              while ($sql->fetch()) {
                    array_push($a,array("GRN"=>$Bind_GRN,"IName"=>$Bind_IName, "SName"=>$Bind_SName));
                  }
              }
            }
           }  catch (Exception $e) {
           error_log($e -> getMessage());
        }
         $sql->close();
  return($a);
  }

  function SelectItem()
  {
    try {
      $db = OpenCon();
      if ($db->connect_errno) {
        echo "Connection Error";
        throw new Exception("Cannot connect to database: ".$db->connect_error);
         }

        $sql=$db->prepare("SELECT i_code,i_name FROM item WHERE i_type = 'RM' order by i_name");

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
                    array_push($a,array("ICode"=>$Bind_ICode, "IName"=>$Bind_IName));
                  }
              }
            }
           }  catch (Exception $e) {
           error_log($e -> getMessage());
        }
         $sql->close();
  return($a);
  }


  function SelectSupplier()
  {
    try {
      $db = OpenCon();
      if ($db->connect_errno) {
        echo "Connection Error";
        throw new Exception("Cannot connect to database: ".$db->connect_error);
         }

        $sql=$db->prepare("SELECT s_code,s_name FROM Suppliers order by s_name");

          if (!$sql->execute()) {
            throw new Exception($db -> error);
            echo "Error in Last Serial";
            }
          else {
            $sql->store_result();
            $sql->bind_result($Bind_SCode,$Bind_SName);
            $num_of_rows = $sql->num_rows;
              if($num_of_rows > 0)
              {
              $a = array();
              while ($sql->fetch()) {
                    array_push($a,array("SCode"=>$Bind_SCode, "SName"=>$Bind_SName));
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
