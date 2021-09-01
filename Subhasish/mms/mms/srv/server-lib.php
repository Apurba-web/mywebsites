<?php
//
function sanitise_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//

function only_alpha_input($data) {
  return preg_match("/^[a-zA-Z]*$/",$data);
}
//

function only_alpha_and_space_input($data) {
  return preg_match("/[a-zA-Z\s]*$/",$data);
}
//
function only_digit_input($data) {
  return preg_match("/^[0-9]*$/",$data);
}
//


//
function validate_date($date) {
  if(strlen($date) < 10) {
    return "date must be in dd-mm-yyyy format";
  } else {
    $d = substr($date,0,2);
    $m = substr($date,3,2);
    $y = substr($date,6);
    if(!checkdate($m, $d, $y)) {
      return "invalid date !!";
    } else {
      return "";
    }
  }
}
//

// pad zero before
function pad_zero($inputStr, $FinalLengthOfStr) {
  $presentLength = strlen($inputStr);
  for($i=0; $i < $FinalLengthOfStr-$presentLength; $i++) {
    $inputStr = "0".$inputStr;
  }
  return $inputStr;
}

/*
function SelectData()

echo "Select Data";
{
  try {
    $db = OpenCon();
    if ($db->connect_errno) {
      echo "Connection Error";
      throw new Exception("Cannot connect to database: ".$db->connect_error);
       }

    $sql=$db->prepare("SELECT v_code,v_name FROM Vendor order by v_name");

      if (!$sql->execute()) {
        throw new \Exception($db -> error);
        echo "Error in Last Serial";
        }
      else {
        $sql->store_result();
        $sql->bind_result($Bind_VCode,$Bind_VName);
        $num_of_rows = $sql->num_rows;
          if($num_of_rows > 0)
          {
            $a = array();
            while ($sql->fetch()) {
  //           $arraySelect=array("VName"=>$Bind_VName, "VCode"=>$Bind_VCode);
              array_push($a,array("VName"=>$Bind_VName, "VCode"=>$Bind_VCode));
              }
          }
        }
       } catch (\Exception $e) {
         error_log($e -> getMessage());
         }
       $sql->close();
return($a);
}
*/

?>
