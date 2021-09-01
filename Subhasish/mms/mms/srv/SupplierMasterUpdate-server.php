  <?php //echo "here-Server"; ?>

  <?php
  session_start();
  //
  // set session variable
  $_SESSION["SupplierName"] = "";



  require_once( dirname( __FILE__ ) . "/dbConnect.php" );
  //require_once( dirname( __FILE__ ) . "/server-lib.php" );
  //
  unset($_SESSION['error']);
  unset($_SESSION['success']);


  //
  // get data
  //

  $error_cnt = 0;

  //echo "Get Data";

  if(isset($_POST['submit'])) {
    try {
      $db = OpenCon();
      if ($db->connect_errno) {
        echo "Connection Error";
        throw new Exception("Cannot connect to database: ".$db->connect_error);
      }

      $SCode = $_POST['scode'];
      $SupplierName = $db -> real_escape_string($_POST["SupplierName"]);
      $Address = $db -> real_escape_string($_POST["Address"]);
      $City =$db -> real_escape_string($_POST["City"]);
      $State=$db -> real_escape_string($_POST["State"]);
      $Pin=$db -> real_escape_string($_POST["Pin"]);
      $ContactPerson=$db -> real_escape_string($_POST["ContactPerson"]);
      $Email=$db -> real_escape_string($_POST["Email"]);
      $Mobile=$db -> real_escape_string($_POST["Mobile"]);

      if(empty("$SupplierName")) {$_SESSION['error'] = "enter Supplier Name ..."; $error_cnt = 1;}

      if($error_cnt == 0) {

      $sql=$db->prepare("UPDATE Suppliers SET s_name = ?, s_address =?, s_city=?, s_state = ?, s_pin=?, s_contact=?, s_email=?, s_mob=? WHERE s_code = ?");

      $sql->bind_param("sssssssss", $SupplierName, $Address, $City, $State, $Pin, $ContactPerson,$Email,$Mobile, $SCode);

        if (!$sql->execute()) {
          throw new Exception($db -> error);
          echo "Error in Last Serial";
        }
        else {

          echo "Updated Successful";

          session_regenerate_id();
          header('location: ../forms/SupplierMasterEntry.php');

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
  //              $arraySelect=array("VName"=>$Bind_VName, "VCode"=>$Bind_VCode);
                array_push($a,array("SName"=>$Bind_SName, "SCode"=>$Bind_SCode));
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
