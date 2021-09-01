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
/*
  $ItemCode = $SupplierCode = "";
  $Driver = $TicketNumber=$UOM="";
  $Quantity = $Bagwt = $Rate=0;
  $LastSrl=0;
*/
  $error_cnt = 0;

  //echo "Get Data";


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

  function SelectGRNx()
  {
    $SCode = mGRN ;
    try {
      $db = OpenCon();
      if ($db->connect_errno) {
        echo "Connection Error";
        throw new Exception("Cannot connect to database: ".$db->connect_error);
         }

        $sql=$db->prepare("SELECT GRN,i_name FROM GRNDETAILS WHERE s_code = 'A0038'");

          if (!$sql->execute()) {
            throw new Exception($db -> error);
            echo "Error in Last Serial";
            }
          else {
            $sql->store_result();
            $sql->bind_result($Bind_GRN,$Bind_IName);
            $num_of_rows = $sql->num_rows;
              if($num_of_rows > 0)
              {
              $a = array();
              while ($sql->fetch()) {
                    array_push($a,array("GRN"=>$Bind_GRN,"IName"=>$Bind_IName));
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
