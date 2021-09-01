  <?php

    require_once( dirname( __DIR__ ) . '/srv/ItemMasterUpdate-server.php' );

   ?>
   <!DOCTYPE html>
   <html lang="en" dir="ltr">
     <head>
       <?php require_once( dirname( __FILE__ ) . "/head.php" ); ?>
       <title>Item Master Entry</title>
     </head>
     <body>
       <?php
         require_once( dirname( __FILE__ ) . "/pg-caption.php" );
         require_once( dirname( __FILE__ ) . "/nav.php" );
       ?>
       <div class="container__dataentry-medium">
           <form class="" action="ItemMasterUpdate.php" method="post">
           <div class="row frm__title">
             <div class="c12-l-12">
                Item Master Update
             </div>
             <div class="c12-l-1 center">
               <a href="menu.php"><img class="button__close" src="../images/btn-close.png"></a>
             </div>
           </div>

  <?php

  try {
    $db = OpenCon();
    if ($db->connect_errno) {
      echo "Connection Error";
      throw new Exception("Cannot connect to database: ".$db->connect_error);
      }

      $ids = $_GET['id'];

    $sql=$db->prepare("SELECT i_name, i_type,i_uom_primary, i_uom_secondary,i_conversion_factor,i_dimension,i_dimension_unit, i_gst_code,i_gst_percentage FROM item where i_code= '".$ids."'");

     if (!$sql->execute()) {
        throw new Exception($db -> error);
        echo "Error";
        }
      else {

        $sql->store_result();
        $sql->bind_result($ItemName,$ItemType,$ItemUnitPrim,$ItemUnitSec,$ConversionFactor,$Dim,$DimInit,$GSTCode,$GSTPer);

        while ($sql->fetch()) {
          }

        }
      } catch (Exception $e) {
        error_log($e -> getMessage());
        }
        $sql->close();
   ?>

          <div class="c12-l-4 p16">
               <div class="bold">Item Name</div>
               <input class="small box mt4" type="text" name="ItemName" id="ItemName" Value ="<?php echo $ItemName; ?>" placeholder="Item name" onchange="SaveVal(this);">

               <div class="bold">Dimension</div>
               <input class="small box mt4" type="text" name="Dim" id="Dim" Value ="<?php echo $Dim; ?>" placeholder="Dimension" onkeypress="return isNumberKey(event)" onchange="SaveVal(this);">

               <div class="bold">Item Type</div>
               <select class="small box mt4" name="ItemType" id="ItemType" placeholder="Item Type" onchange="SaveVal(this);">
                  <?php echo $ItemType; ?>
                  <?php if ($ItemType == 'RM') { ?>
                  <option value= 'RM' selected='selected'>RM</option> <?php ;}
                    else { ?>
                      <option value='RM'>RM</option>
                    <?php ;} ?>
                  <?php if ($ItemType == 'FG') { ?>
                      <option value= 'FG' selected='selected'>FG</option> <?php ;}
                      else { ?>
                         <option value='FG'>FG</option>
                       <?php ;} ?>
               </select >

         </div>

         <div class="c12-l-4 p16">

              <div class="bold">Item Unit(Primary)</div>
              <input class="small box mt4" type="text" name="ItemUnitPrim" id="ItemUnitPrim" Value ="<?php echo $ItemUnitPrim; ?>" placeholder="Item Unit (Primery)" onchange="SaveVal(this);">

              <div class="bold">Item Unit Secondary</div>
              <input class="small box mt4" type="text" name="ItemUnitSec" id="ItemUnitSec" Value ="<?php echo $ItemUnitSec; ?>" placeholder="Item Unit (Secondary)" onchange="SaveVal(this);">

              <div class="bold">Dimenstion Unit</div>
              <input class="small box mt4" type="text" name="DimUnit" id="DimUnit" Value ="<?php echo $DimUnit; ?>" placeholder="Dimension Unit" onchange="SaveVal(this);">

         </div>

         <div class="c12-l-4 p16">

               <div class="bold">Conversion Factor</div>
               <input class="small box mt4" type="text" name="ConversionFactor" id="ConversionFactor" Value ="<?php echo $ConversionFactor; ?>" placeholder="Conversion Factor" onkeypress="return isNumberKey(event)" onchange="SaveVal(this);">

               <div class="bold">GST Code</div>
               <input class="small box mt4" type="text" name="GSTCode" id="GSTCode" Value ="<?php echo $GSTCode; ?>" placeholder="GST Code" onchange="SaveVal(this);">

               <div class="bold">GST Percentage<</div>
               <input class="small box mt4" type="text" name="GSTPer" id="GSTPer" Value ="<?php echo $GSTPer; ?>" placeholder="GST Percentage" onkeypress="return isNumberKey(event)" onchange="validateFloatKeyPress(this);">

          </div>

           <div class="row p1" style="border-top: thin solid rgb(255,175,0);"> </div>

              <div class="c12-l-4 p1 center">
                <button id="Cancel" type="button" name="Cancel" class="btn bg-verylightgoldenyellow txt-black" onclick="goBack()">Cancel</button>
              </div>

              <div class="c12-l-4 p1 center">
                <input type="submit" name="submit" value="Update" class="bg-verylightgoldenyellow txt-black">
                <input type="hidden" name="icode" value= "<?php echo $ids; ?>">
              </div>

  <style>
  tr:nth-child(even) {background-color: white}
  </Style>

  <div class="row" style="height: 30px;">
    <table style width='100%'>
      <thead>
        <th style width='10%'>I-Code</th>
        <th style width='60%'>I-Name</th>
        <th style width='9%'>Edit  </th>
        <th style width='4%'>Delete</th>
      </thead>
    </table>
  </div>

    <div class="row" style="height: 170px; overflow-y:auto;">
        <table style width='100%'>
            <?php $DataArray = SelectData(); ?>
             <?php

             for ($row = 0; $row < count($DataArray); $row++)
            {
                echo "<tr>";
                  echo "<td>".$DataArray[$row]['ICode']."</td>";
                  echo "<td>".$DataArray[$row]['IName']."</td>";
                  ?>
                  <td><data-toggle='tooltip' data-placement= 'top' title='Update'>Edit</a></td>
                  <td><data-toggle='tooltip' data-placement= 'top' title='Trash'>Delete</a></td>
                  <?php
                echo "</tr>";
              }
            ?>
          </table>
      </div>

  <script>
  function InitVals() {
    document.getElementById("VendorName").value = "";
  }
  </script>

           <!-- ********* error/success block ********* -->
           <?php if (isset($_SESSION['error'])): ?>
             <div id="popupMsg" class="msg__err">
               <div class="">
                 <button class="btn-circle small" onclick="closeMsg()">X</button>
               </div>
               <?php
                 echo $_SESSION['error'];
                 unset($_SESSION['error']);
               ?>
             </div>
           <?php endif ?>
           <!-- ********* end error block ********* -->

           <!-- END BOTTOM ROW  -->
         </form>
       </div>
     </body>
  </html>

  <script>
  function goBack() {
    window.history.back();
  }
  </script>

<script>
  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
//    if (charCode > 31 && (charCode < 48 || charCode > 57))
    if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}
</script>

<script>
function validateFloatKeyPress(el) {
  var v = parseFloat(el.value);
  el.value = (isNaN(v)) ? '' : v.toFixed(2);
}
</script>
