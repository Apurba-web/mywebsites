<?php
session_start([
    'use_only_cookies' => 1,
    'cookie_lifetime' => 0,
    'cookie_secure' => 1,
    'cookie_httponly' => 1
  ]);
// set session variable
$_SESSION["user"] = "";
$_SESSION['hi'] = "";
$_SESSION['user_type'] = "";
//
unset($_SESSION['error']);
unset($_SESSION['success']);
//
mysqli_report(MYSQLI_REPORT_STRICT);
//
require_once( dirname( __FILE__ ) . "/dbConnect.php" );
require_once( dirname( __FILE__ ) . "/server-lib.php" );
//
$user = $password = "";
$users = array();
$msg = "";
$error_cnt = 0;
$num_of_rows = 0;
//
// process login request
//
if(isset($_POST["submit_login"])) {
  try {
    $db = OpenCon();
    if(!$db) {
      echo $db->connect_error;
    } else {
      echo "Connection Successful";
    }
    //
    $user = $db -> real_escape_string($_POST["user"]);
    $password = $db -> real_escape_string($_POST["pwd"]);
    //
    if(empty("$user")) {$_SESSION['error'] = "enter user id ..."; $error_cnt = 1;}
    if(empty("$password")) {$_SESSION['error'] = $_SESSION['error']."enter password ..."; $error_cnt = 1;}
    //
    if($error_cnt == 0) {
      $sql = $db->prepare("SELECT user, password, usertype, fullname FROM users WHERE user = ? AND password = ?");
      $sql->bind_param("ss", $user, $password);
      //
      if (!$sql->execute()) {
        throw new Exception($db -> error);
      } else {
        $sql->store_result();
        $sql->bind_result($col_user, $col_password, $col_usertype, $col_fullname);
        //
        $num_of_rows = $sql->num_rows;

        if($num_of_rows > 0) {
          while ($row = $sql->fetch()) {
            $tmp_user = $col_user;
            $tmp_usertype = $col_usertype;
            $tmp_pass = $col_password;
            $tmp_fullname = $col_fullname;
          }
          //
          $_SESSION["user"] = $tmp_fullname;
          $_SESSION['usertype'] = $tmp_usertype;
          $_SESSION['hi'] = 'Welcome '.$tmp_fullname;
          //
          after_successful_login();
          //
          header('location: ../forms/menu.php');
          //
        } else {
          $_SESSION['error'] = "Authentication failed! Try again.";
        }
      }
      $sql->close();
    }
    //
    $db->close();
    //
  } catch(Exception $e){
    error_log($e->getMessage());
  }
}
//

//
function after_successful_login() {
    session_regenerate_id();
    $_SESSION['logged_in'] = true;
    $_SESSION['last_login'] = time();
  }
  //
?>
