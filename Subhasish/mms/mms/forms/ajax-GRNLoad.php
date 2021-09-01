<?php

$host = "127.0.0.1";
$user = "admin";
$pwd="mc211196";
$dbname="mms";

$conn = mysqli_connect($host, $user, $pwd, $dbname) or die("Connection Failed");

if($_POST['type'] == "SelectedGRN") {
  $sql = "SELECT s_code,s_name FROM Suppliers order by s_name";

  $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");

  $Str = "";

  $str .= "<table style border='0' width=100% cellpadding='10px' cellspaceing='2'>
    <tr>
      <th width='30px'>Test1</th>
      <th width='30px'>Test2</th>
      <th>Name</th>
    </tr>";

} else if($_POST['type'] == "GRNData") {

  $sql = "SELECT GRN,i_name FROM GRNDETAILS WHERE s_code = '{$_POST['id']}'";

  $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");

  $str="";

    if (mysqli_num_rows($result) > 0 ){

        $str = '<style> tr:nth-child(even) {background-color: white} </Style>';
        $Str .= '<div class="row" style="height: 300px; overflow-y:auto;">' ;

        $str .= "<table style border='0' width=100% cellpadding='10px' cellspaceing='2'>
          <tr>
            <th width='30px'></th>
            <th width='30px'>GRN</th>
            <th>Name</th>
          </tr>";

          while ($row = mysqli_fetch_assoc($result)){
            $str .= "<tr><td align=left'><input type = 'checkbox' value='{$row["GRN"]}'></td><td align=left'>{$row["GRN"]}</td><td align=left'>{$row["i_name"]}</td></tr>";
          }

          $str .= "</table> </div>";

    } else {
      echo "No GRN Available";

    }
} else {

}

mysqli_close($conn);
echo $str;
