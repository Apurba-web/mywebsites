<?php

  require_once( dirname( __DIR__ ) . '/srv/ItemMasterEntry-server.php' );

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
         <form class="" action="ItemMasterEntry.php" method="post">
         <div class="row frm__title">
           <div class="c12-l-12">
             Item Master Entry
           </div>
           <div class="c12-l-1 center">
             <a href="menu.php"><img class="button__close" src="../images/btn-close.png"></a>
           </div>
         </div>


        <div class="c12-l-4 p16">
             <div class="bold">Item Name</div>
             <input class="small box mt4" type="text" name="ItemName" id="ItemName" placeholder="Item Name" onchange="SaveVal(this);">

             <div class="bold">Dimension</div>
             <input class="small box mt4" type="text" name="Dim" id="Dim" placeholder="Dim" onkeypress="return isNumberKey(event)" onchange="SaveVal(this);">

             <div class="bold">Item Type</div>
             <select class="small box mt4" name="ItemType" id="ItemType" placeholder="Item Type" onchange="SaveVal(this);">
               <option value="RM">RM</option>
               <option value="FG">FG</option>
             </select >

          </div>
          <div class="c12-l-4 p16">

            <div class="bold">Item Unit(Primary)</div>
            <input class="small box mt4" type="text" name="ItemUnitPrim" id="ItemUnitPrim" placeholder="Item Unit (Primary)" onchange="SaveVal(this);">

            <div class="bold">Item Unit Secondary</div>
            <input class="small box mt4" type="text" name="ItemUnitSec" id="ItemUnitSec" placeholder="Item Unit (Secondary)" onchange="SaveVal(this);">

            <div class="bold">Dimenstion Unit</div>
            <input class="small box mt4" type="text" name="DimUnit" id="DimUnit" placeholder="Dimension Unit" onchange="SaveVal(this);">

          </div>
       <div class="c12-l-4 p16">

             <div class="bold">Conversion Factor</div>
             <input class="small box mt4" type="text" name="ConversionFactor" id="ConversionFactor" placeholder="Conversion Factor" onkeypress="return isNumberKey(event)" onchange="SaveVal(this);">

             <div class="bold">GST Code</div>
             <input class="small box mt4" type="text" name="GSTCode" id="GSTCode" placeholder="GST Code" onchange="SaveVal(this);">

             <div class="bold">GST Percentage</div>
             <input class="small box mt4" type="text" name="GSTPer" id="GSTPer" placeholder="GST Percentage" onkeypress="return isNumberKey(event)" onchange="validateFloatKeyPress(this);">

           </div>


         <div class="row p1" style="border-top: thin solid rgb(255,175,0);"> </div>

            <div class="c12-l-4 p1 center">
              <input type="submit" name="submit" value="Insert New Record" class="bg-verylightgoldenyellow txt-black">
              <input type="hidden" name="Icode" value= "<?php echo $ids; ?>">
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
                      <td><a href="ItemMasterUpdate.php?id=<?php echo $DataArray[$row]['ICode'] ?>" data-toggle="tooltip" data-placement="top" title="Update">Edit</a></td>
                      <td><a href="ItemMasterDelete.php?id=<?php echo $DataArray[$row]['ICode'] ?>" data-toggle="tooltip" data-placement="top" title="Trash">Delete</a></td>

                      <?php
                    echo "</tr>";
                  }
                ?>
              </table>
          </div>

<script>

function InitVals() {
  document.getElementById("ItemName").value = "";
}
</script>


<script>
  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
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
