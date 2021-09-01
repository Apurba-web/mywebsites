<?php
//
mysqli_report(MYSQLI_REPORT_STRICT);
//
function OpenCon() {
 $host = "127.0.0.1";
 $user = "admin";
 $pwd="mc211196";
 $dbname="mms";

 try {
   $dbCon = new mysqli($host, $user, $pwd, $dbname);
   return $dbCon;
 }
 catch(mysqli_sql_exception $e) {
   error_log($e->getMessage());
 }

}
//
function CloseCon($dbCon) {
 $dbCon  -> close();
}

?>
