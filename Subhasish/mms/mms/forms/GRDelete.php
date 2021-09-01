<?php

  require_once( dirname( __DIR__ ) . '/srv/GRDelete-server.php' );

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <?php require_once( dirname( __FILE__ ) . "/head.php" ); ?>
     <title>Good Receipt Entry</title>
   </head>
   <body>
     <?php
       require_once( dirname( __FILE__ ) . "/pg-caption.php" );
       require_once( dirname( __FILE__ ) . "/nav.php" );
     ?>
     <div class="container__dataentry-medium">
      <form class="" action="GRDelete.php" method="post">
         <div class="row frm__title">
           <div class="c12-l-12">
             Good Receipt Delete
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

           $sql=$db->prepare("SELECT GRDate, i_code, s_code, Driver, TicketNo, UOM, Qty, BagWt, Rate FROM GRN  where GRN = '".$ids."'");

            if (!$sql->execute()) {

               throw new Exception($db -> error);
               echo "Error";
               }
             else {

               $sql->store_result();
               $sql->bind_result($GRDate,$ICode,$SCode,$Driver,$TicketNumber,$UOM,$Quantity,$BagWt,$Rate);

               while ($sql->fetch()) {
                 }

               }
             } catch (Exception $e) {
               error_log($e -> getMessage());
               }
               $sql->close();
          ?>

         <div class="c12-l-4 p16" >
            <div class="bold">GR Date</div>
            <input class="small box mt4" type="date" name="GRDate" id="GRDate" Value ="<?php echo $GRDate; ?>" onchange="SaveVal(this);">
          </div>

          <div class="c12-l-4 p16" >
            <div class="bold">Item Name</div>
              <select class="small box mt4" name="ItemName" id="ItemName" placeholder="Item Name" onchange="SaveVal(this);">
                  <?php $ItemArray = SelectItem();
                   for ($row = 0; $row < count($ItemArray); $row++)
                   {
                        ?>
                        <?php if ( $ItemArray[$row]['ICode'] == $ICode) { ?>
                          <option value=<?php echo $ItemArray[$row]['ICode'] ?> selected='selected' ><?php echo $ItemArray[$row]['IName'] ?></option>
                        <?php ;}
                        else { ?>
                          <option value=<?php echo $ItemArray[$row]['ICode'] ?>><?php echo $ItemArray[$row]['IName'] ?></option>
                        <?php ;}
                   }
                   ?>
              </select >
            </div>

          <div class="c12-l-4 p16" >
            <div class="bold">Suppliers Name</div>
              <select class="small box mt4" name="SupplierName" id="SupplierName" placeholder="Supplier Name" onchange="SaveVal(this);">
            <?php   echo "Scode.. ".$SCode; ?>
                  <?php $SupplierArray = SelectSupplier();

                   for ($row = 0; $row < count($SupplierArray); $row++)
                   {
                        ?>
                        <?php if ( $SupplierArray[$row]['SCode'] == $SCode) { ?>
                          <option value=<?php echo $SupplierArray[$row]['SCode'] ?> selected='selected' ><?php echo $SupplierArray[$row]['SName'] ?></option>
                        <?php ;}
                        else { ?>
                          <option value=<?php echo $SupplierArray[$row]['SCode'] ?>><?php echo $SupplierArray[$row]['SName'] ?></option>
                        <?php ;}
                   }
                   ?>
              </select >
          </div>

          <div class="c12-l-4 p16" >

             <div class="bold">Driver</div>
             <input class="small box mt4" type="text" name="Driver" id="Driver" Value ="<?php echo $Driver; ?>" placeholder="Driver Name" onchange="SaveVal(this);">

             <div class="bold">Quantity</div>
             <input class="small box mt4" type="text" name="Quantity" id="Quantity" Value ="<?php echo $Quantity; ?>" placeholder="Quantity" onkeypress="return isNumberKey(event)" onchange="SaveVal(this);">

          </div>
          <div class="c12-l-4 p16">

            <div class="bold">Ticket Number</div>
            <input class="small box mt4" type="text" name="TicketNumber" id="TicketNumber" Value ="<?php echo $TicketNumber; ?>" placeholder="Ticket Number" onchange="SaveVal(this);">

            <div class="bold">Unit of Measurement</div>
            <input class="small box mt4" type="text" name="UOM" id="UOM" Value ="<?php echo $UOM; ?>" placeholder="Unit" onchange="SaveVal(this);">

          </div>

          <div class="c12-l-4 p16">

             <div class="bold">Bag Wt</div>
             <input class="small box mt4" type="text" name="BagWt" id="BagWt" Value ="<?php echo $BagWt; ?>" placeholder="Bag Weight" onkeypress="return isNumberKey(event)" onchange="SaveVal(this);">

             <div class="bold">Rate</div>
             <input class="small box mt4" type="text" name="Rate" id="Rate" Value ="<?php echo $Rate; ?>" placeholder="Price Rate" onkeypress="return isNumberKey(event)" onchange="SaveVal(this);">

           </div>


         <div class="row p1" style="border-top: thin solid rgb(255,175,0);"> </div>

            <div class="c12-l-4 p1 center">
              <button id="Cancel" type="button" name="Cancel" class="btn bg-verylightgoldenyellow txt-black" onclick="goBack()">Cancel</button>
            </div>

            <div class="c12-l-4 p1 center">
              <input type="submit" name="submit" value="Delete Record" class="bg-verylightgoldenyellow txt-black">
              <input type="hidden" name="GRN" value= "<?php echo $ids; ?>">
            </div>


<style>
tr:nth-child(even) {background-color: white}
</Style>
          <div class="row" style="height: 30px;">
            <table style width='100%'>
              <thead>
                <th style width='5%'>GRN</th>
                <th style width='10%'>Item Name</th>
                <th style width='40%'>Supplier Name</th>
                <th style width='10%'>Edit  </th>
                <th style width='4%'>Delete</th>
              </thead>
            </table>
          </div>

          <div class="row" style="height: 145px; overflow-y:auto;">
              <table style width='100%'>
                <?php $DataArray = SelectData(); ?>
                <?php

                 for ($row = 0; $row < count($DataArray); $row++)
                {
                    echo "<tr>";
                      echo "<td style='width:10%'>".$DataArray[$row]['GRN']."</td>";
                      echo "<td style='width:37%'>".$DataArray[$row]['IName']."</td>";
                      echo "<td style='width:43%'>".$DataArray[$row]['SName']."</td>";
                      ?>
                      <td><a href="GRUpdate.php?id=<?php echo $DataArray[$row]['GRN'] ?>" data-toggle="tooltip" data-placement="top" title="Update">Edit</a></td>
                      <td><a href="GRUpdate.php?id=<?php echo $DataArray[$row]['GRN'] ?>" data-toggle="tooltip" data-placement="top" title="Trash">Delete</a></td>

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
function val() {
    d = document.getElementById("ItemName").value;
    alert(d);
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
