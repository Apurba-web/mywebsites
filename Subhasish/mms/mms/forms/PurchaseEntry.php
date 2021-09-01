<?php

  require_once( dirname( __DIR__ ) . '/srv/PurchaseEntry-server.php' );

 ?>

 <!DOCTYPE html>
  <html lang="en" dir="ltr">
   <head>
     <?php  require_once( dirname( __FILE__ ) . "/head.php" ); ?>
     <title>Purchase Entry</title>
   </head>
   <body>
     <?php
       require_once( dirname( __FILE__ ) . "/pg-caption.php" );
       require_once( dirname( __FILE__ ) . "/nav.php" );
     ?>
     <div class="container__dataentry-medium ">
      <form class="" action="PurchaseEntry.php">
         <div class="row frm__title">
           <div class="c12-l-12">
             Purchase Entry
           </div>
           <div class="c12-l-1 center">
             <a href="menu.php"><img class="button__clos" src="../images/btn-close.png"></a>
           </div>
         </div>

      <div class="c12-l-12" p16>
         <div class="c12-l-4 p16" >
            <div class="bold"> Purchase Booking Date</div>
            <input class="small box mt4" type="date" name="PurchaseDate" id="PurchaseDate" onchange="SaveVal(this);">

            <div class="bold">Suppliers Name</div>

              <select id="SupplierName">
                  <option value="">Select Supplier</option>
              </select >

              <input type = "button" id="select-button" value = "Confirm Selection"></button>

              <table id="main" border="1" cellspacing="0">
                <tr>
                  <td id="table-data">
                    <table border="1" width="100%" cellspacing="0" cellpadding="10px">

                    </table>
                  </td>
                  </tr>
             </table>


        </div>

          <div class="c12-l-4 p16" >

            <div class="bold">GRN</div>
            <input class="small box mt4" type="text" name="GRN" id="GRN" placeholder="Goode Receipt No" onchange="SaveVal(this);">

            <div class="bold">GRN Date</div>
            <input class="small box mt4" type="text" name="Date" id="GRNDate" placeholder="GRN Date" onchange="SaveVal(this);">

            <div class="bold">Item Name</div>
            <input class="small box mt4" type="text" name="Item" id="i_name" placeholder="Item Name" onchange="SaveVal(this);">

            <div class="bold">Driver</div>
            <input class="small box mt4" type="text" name="Driver" id="Driver" placeholder="Driver" onchange="SaveVal(this);">

          <!--  <button id = "btnOne">1</button>  -->
           <br><br>
           <input type = 'button' id='SaveData' value = 'Save Data'></button>
           <input type = "hidden" id="btnOne" value = "1">

       </div>

        <div class="c12-l-4 p16" >
            <div class="bold">Quanitiy</div>
            <input class="small box mt4" type="text" name="Qty" id="Qty" placeholder="Quantity" onchange="SaveVal(this);">

            <div class="bold">Unit</div>
            <input class="small box mt4" type="text" name="UOM" id="UOM" placeholder='Unit of Measure' onchange="SaveVal(this);">

            <div class="bold">Rate</div>
            <input class="small box mt4" type="text" name="Rate" id="Rate" placeholder="Rate" onchange="SaveVal(this);">

            <div class="bold">Bag Wt</div>
            <input class="small box mt4" type="text" name="BagWt" id="BagWt" placeholder="Bag Weight" onchange="SaveVal(this);">

            <div class="bold">Total</div>
            <input class="small box mt4" type="text" name="Amount" id="TAmount" onchange="SaveVal(this);">

          </div>
</div>

   <div class="c12-l-12" >
   </div>
             <div class="row" style="border-top: thin solid rgb(255,175,0);"></div>

             <div class="c12-l-12 p2" >
               <table id="main" border="0" cellspacing="0">
                <tr>
                  <td id="selected-data">
                    <table border="0" width="100%" cellspacing="0" cellpadding="1px">
                    </table>
                  </td>
                </tr>
              </table>
             </div>
           </form>
         </div>


  <script type="text/javascript" src = "../js/jquery.js"></script>

            <script type="text/javascript">

                    $(document).ready(function(){
                      function loadData(type,icode){
                        $.ajax({
                          url : "ajax-load.php",
                          type : "POST",
                          data : {type : type, id : icode},
                          success : function(data){
                            if(type == "GRNData"){
                              $("#table-data").html(data) ;
                            }else if (type == "SelectedGRN"){
                              $("#selected-data").html(data);
                              $("#btnOne").trigger("click");
                              $("#selectRadio").trigger("click");
                            }else{
                              $("#SupplierName").append(data);
                            }
                          }
                        });
                      }

                    loadData();

                        $("#SupplierName").on("change",function(){
                          var Supplier = $("#SupplierName").val();

//                          RemoveSelectItem()
                          loadData("GRNData",Supplier);

                        });

                       $("#select-button").on("click",function(){
                          var id =[];
                          $(":checkbox:checked").each(function(key){
                            id[key] = $(this).val();
                          });

                          if(id.length == 0){
                            alert("Please Select atleast on checkbox");
                          }else {
                            loadData("SelectedGRN",id);
                          }
                        });

                        $("#btnOne").click(function(){
                          var t=document.getElementById("TotAmount").value;
                          document.getElementById("TAmount").value = t;

                        });

                        $("#selected-data").on("click", "input[type=radio]", function(){
                          var currentRow=$(this).closest('tr');
                          $("#GRN").val(currentRow.find('td:eq(1)').text());
                          $("#GRNDate").val(currentRow.find('td:eq(2)').text());
                          $("#i_name").val(currentRow.find('td:eq(3)').text());
                          $("#Driver").val(currentRow.find('td:eq(4)').text());

                          $("#Qty").val(currentRow.find('td:eq(5)').text());
                          $("#UOM").val(currentRow.find('td:eq(6)').text());
                          $("#Rate").val(currentRow.find('td:eq(7)').text());
                          $("#BagWt").val(currentRow.find('td:eq(8)').text());

                      });

                    });  // end of ajax


            </script>


            <script>
                    function RemoveSelectItem() {
                        var d = document.getElementById("SupplierName");
                        d.remove(0);
                    }
            </script>


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

<script>
function validateFloatKeyPress(el) {
  var v = parseFloat(el.value);
  el.value = (isNaN(v)) ? '' : v.toFixed(2);
}
</script>

<script>
function showGRN(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","PurchaseEntry.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>


<script type="text/javascript">

function showGRN2(str) {
  if (str == "") {
    $(#table-data).html("");
  }else {
    $DataArray = SelectGRN(Str);

    $Output="<table>";
    for ($row = 0; $row < count($DataArray); $row++)
    {
      $Output .="<tr>
                <td style='width:1%''><input type='checkbox'></td>
                <td style='width:1%'>".$DataArray[$row]['GRN']."</td>
                <td style='width:10%'>".$DataArray[$row]['IName']."</td>
                </tr>";
     }
    $Output .="</table>";
  }

}

</script>

<script>

function SelectGRN(mGRN)
{
  $SCode = mGRN ;
  try {
    $db = OpenCon();
    if ($db->connect_errno) {
      echo "Connection Error";
      throw new Exception("Cannot connect to database: ".$db->connect_error);
       }

      $sql=$db->prepare("SELECT GRN,i_name FROM GRNDETAILS WHERE s_code = '".mGRN."'");

        if (!$sql->execute()) {
          throw new Exception($db -> error);
          echo "Error in Last Serial";
          }
        else {
          $sql->store_result();
          $sql->bind_result($Bind_GRN,$Bind_IName);
          $num_of_rows = $sql->num_rows;
            if($num_of_rows > 0)
            {
            $a = array();
            while ($sql->fetch()) {
                  array_push($a,array("GRN"=>$Bind_GRN,"IName"=>$Bind_IName));
                }
            }
          }
         }  catch (Exception $e) {
         error_log($e -> getMessage());
      }
       $sql->close();
return($a);
}
</Script>

         <!-- ********* error/success block ********* -->
         <?php if (isset($_SESSION['error'])): ?>
<!--           <div id="popupMsg" class="msg__err">
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

-->


   </body>
</html>
