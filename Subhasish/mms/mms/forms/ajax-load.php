<?php

$host = "127.0.0.1";
$user = "admin";
$pwd="mc211196";
$dbname="mms";

$conn = mysqli_connect($host, $user, $pwd, $dbname) or die("Connection Failed");

if($_POST['type'] == ""){
  $sql = "SELECT s_code,s_name FROM Suppliers order by s_name";

  $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");

  $Str = "";
  while ($row = mysqli_fetch_assoc($result)){
    $str .= "<option value='{$row['s_code']}'>{$row['s_name']}</option>";
  }

} else if($_POST['type'] == "GRNData") {

  $sql = "SELECT GRN,i_name FROM GRNDETAILS WHERE s_code = '{$_POST['id']}'";

  $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");

  $str="";

    if (mysqli_num_rows($result) > 0 ){

        $str = "<div class='row' style='height: 30px;'>
          <table style width='100%'>
          <thead>
            <th>Select</th>
            <th>GRN</th>
            <th>Name</th>
          </thead></table></div>";

          $str .= "<style>tr:nth-child(even) {background-color: white}</Style>";
          $str .= "<div class='row' style='height: 121px; overflow-y:auto;'>" ;
          $str .= "<table style width='100%'>";

          while ($row = mysqli_fetch_assoc($result)){
            $str .= "<tr><td align=left><input type = 'checkbox' value='{$row["GRN"]}'></td><td align=left>{$row["GRN"]}</td><td align=left>{$row["i_name"]}</td></tr>";
          }

          $str .= "</table></div>";


    } else {
      echo "No GRN Available";

    }
} else {

  $Selected_id = $_POST['id'];

  $idStr = implode(",",$Selected_id);

  $sql="SELECT GRN,GRDate,i_name, Driver, TicketNo, Qty, UOM, Rate, Bagwt, Qty*BagWt*Rate as Amount FROM GRNDETAILS WHERE GRN IN ({$idStr})";
  $result= mysqli_query($conn,$sql) or die("SQL Query Failed.");

  $str="";

  if (mysqli_num_rows($result) > 0 ){

    $str = '<style> tr:nth-child(even) {background-color: white} </Style>';
    $str .= '<div class="row" style="height: 100px; verflow-x: scroll; overflow-y: scroll;">' ;

    $str .= "<table class = 'basic' id='tableSelect' width=100% cellpadding='10px' cellspaceing='2' empty-cells: show >
    <thead class='thead-pink'>
      <tr>
        <th width='30px'>Select</th>
        <th width='30px'>GRN</th>
        <th width='30px'>Date</th>
        <th width='30px'>Item</th>
        <th width='30px'>Driver</th>
        <th width='30px'>Qty</th>
        <th width='30px'>UOM</th>
        <th width='30px'>Rate</th>
        <th width='30px'>BagWt</th>
        <th width='30px'>Amount</th>
      </tr>
    </thead>";

    $TotAmount = 0; $i=1; $x='checked';
      while ($row = mysqli_fetch_assoc($result)){
        $sid=strval($i);

        $str .= "<tr class = 'tr-border'>
                  <td><input type = 'radio' id= 'selectRadio' name = 'select' value='{$row["GRN"]}' {$x}></td>
                  <td align=left'>{$row["GRN"]}</td>
                  <td align=left'>{$row["GRDate"]}</td>
                  <td align=left'>{$row["i_name"]}</td>
                  <td align=left'>{$row["Driver"]}</td>
                  <td align=left'>{$row["Qty"]}</td>
                  <td align=left'>{$row["UOM"]}</td>
                  <td align=left'>{$row["Rate"]}</td>
                  <td align=left'>{$row["BagWt"]}</td>
                  <td align=left'>{$row["Amount"]}</td>
                  </tr>";

                  $i = $i + 1; $x='';
                  $TotAmount = $TotAmount + $row["Amount"] ;
      }
      $str .= "</table>";
      $str .= "<input type='hidden' name='TotAmount' id='TotAmount' value= {$TotAmount}>";
  }else {
      echo "No GRN Available";
  }

}

mysqli_close($conn);
echo $str;


 ?>
