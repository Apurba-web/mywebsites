<?php
session_start();
error_reporting(E_ALL & ~ E_NOTICE);
require_once('textlocal.class.php');

echo($_POST["action"]);
class Controller
{
    function __construct() {
      alert("construct");
      $this->processMobileVerification();
    }

    function processMobileVerification()
    {
        switch ($_POST["action"]) {
          case "send_otp":
            $mobile_number = $_POST('mobile_number');
            echo($mobile_number);
            alert("sfdf");
            $apiKey = urlencode('NTI0YzU2Mzk1MDUzNzY0ZTc4NTc0NjUwNzA2ODc2NDk');
            $TextLocal = new Textlocal(false,false,$apiKey);

            $numbers=array($mobile_number);
            $sender = 'TXTLCL';
            $otp = rand(100000, 999999);
            $_SESSION['session_otp'] = $otp;
            $message = "Your One Time Password is ".$otp;

            try{
              $response = $Textlocal->sendSms($numbers, $message, $sender);
              require_once ("verification.php");
              exit();
            }catch (Exception $e){
              die('Error: '.$e->getMessage());
            }
            break;

          case "verify_otp":
            $otp = $_POST['otp'];

            if ($otp == $_SESSION['session_otp']){
              unset ($_SESSION['session_otp']);
              echo json_encode(array("type"=>"success","message"=>"Your Mobile number is verified"));
            }else {
              echo json_encode(array("type"=>"success","message"=>"Your Mobile number verification failed"));
            }
            break;
        }
    }
}
$controller = new Controller();
?>
