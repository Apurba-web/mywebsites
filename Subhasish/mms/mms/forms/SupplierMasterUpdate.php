  <?php

    require_once( dirname( __DIR__ ) . '/srv/SupplierMasterUpdate-server.php' );

   ?>
   <!DOCTYPE html>
   <html lang="en" dir="ltr">
     <head>
       <?php require_once( dirname( __FILE__ ) . "/head.php" ); ?>
       <title>Supplier Master Entry</title>
     </head>
     <body>
       <?php
         require_once( dirname( __FILE__ ) . "/pg-caption.php" );
         require_once( dirname( __FILE__ ) . "/nav.php" );
       ?>
       <div class="container__dataentry-medium">
           <form class="" action="SupplierMasterUpdate.php" method="post">
           <div class="row frm__title">
             <div class="c12-l-12">
               Supplier Master Update
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

    $sql=$db->prepare("SELECT s_name, s_address,s_city, s_state,s_pin,s_contact,s_email, s_mob FROM Suppliers where s_code= '".$ids."'");

     if (!$sql->execute()) {
        throw new Exception($db -> error);
        echo "Error";
        }
      else {

        $sql->store_result();
        $sql->bind_result($SupplierName,$Address,$City,$State,$Pin,$ContactPerson,$mail,$Mobile);

        while ($sql->fetch()) {
          }

        }
      } catch (Exception $e) {
        error_log($e -> getMessage());
        }
        $sql->close();
   ?>

          <div class="c12-l-6 p16">
               <div class="bold">Supplier Name</div>
               <input class="small box mt4" type="text" name="SupplierName" id="SupplierName" Value ="<?php echo $SupplierName; ?>" placeholder="Supplier name" onchange="SaveVal(this);">

               <div class="bold">Address</div>
               <input class="small box mt4" type="text" name="Address" id="Address" Value ="<?php echo $Address; ?>" placeholder="Full Address" onchange="SaveVal(this);">

               <div class="bold">City</div>
               <input class="small box mt4" type="text" name="City" id="City" Value ="<?php echo $City; ?>" placeholder="City / Town" onchange="SaveVal(this);">

               <div class="bold">State</div>
               <input class="small box mt4" type="text" name="State" id="Pin" Value ="<?php echo $State; ?>" placeholder="State" onchange="SaveVal(this);">
         </div>
         <div class="c12-l-6 p16">

               <div class="bold">Pin</div>
               <input class="small box mt4" type="text" name="Pin" id="Pin" Value ="<?php echo $Pin; ?>" placeholder="Pin Code" onchange="SaveVal(this);">

               <div class="bold">Contact Person</div>
               <input class="small box mt4" type="text" name="ContactPerson" id="ContactPerson" Value ="<?php echo $ContactPerson; ?>" placeholder="Name of Contact Person" onchange="SaveVal(this);">

               <div class="bold">Email</div>
               <input class="small box mt4" type="text" name="Email" id="Email" Value ="<?php echo $mail; ?>" placeholder="Email" onchange="SaveVal(this);">

               <div class="bold">Contact Number(Mobile)</div>
               <input class="small box mt4" type="text" name="Mobile" id="Mobile" Value ="<?php echo $Mobile; ?>" placeholder="Telephone Number of Contact Person" onchange="SaveVal(this);">

          </div>

           <div class="row p1" style="border-top: thin solid rgb(255,175,0);"> </div>

              <div class="c12-l-4 p1 center">
                <button id="Cancel" type="button" name="Cancel" class="btn bg-verylightgoldenyellow txt-black" onclick="goBack()">Cancel</button>
              </div>

              <div class="c12-l-4 p1 center">
                <input type="submit" name="submit" value="Update" class="bg-verylightgoldenyellow txt-black">
                <input type="hidden" name="scode" value= "<?php echo $ids; ?>">
              </div>

  <style>
  tr:nth-child(even) {background-color: white}
  </Style>

  <div class="row" style="height: 30px;">
    <table style width='100%'>
      <thead>
        <th style width='10%'>S-Code</th>
        <th style width='60%'>S-Name</th>
        <th style width='9%'>Edit  </th>
        <th style width='4%'>Delete</th>
      </thead>
    </table>
  </div>

    <div class="row" style="height: 125px; overflow-y:auto;">
        <table style width='100%'>
            <?php $DataArray = SelectData(); ?>
             <?php

             for ($row = 0; $row < count($DataArray); $row++)
            {
                echo "<tr>";
                  echo "<td>".$DataArray[$row]['SCode']."</td>";
                  echo "<td>".$DataArray[$row]['SName']."</td>";
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
