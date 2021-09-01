<?php
#echo dirname( __DIR__ );
   require_once( dirname( __DIR__ ) . '/srv/GRNReport-server.php' );

//href="ItemMasterUpdate.php?id=
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require_once( dirname( __FILE__ ) . "/head.php" ); ?>
    <title>GRN Report</title>
  </head>

  <body>
    <div class="">
      <?php require_once( dirname( __FILE__ ) . "/pg-caption.php" ); ?>
    </div>
    <div class="container__login">

      <form class="" action="ReportGRN.php" method="post" autocomplete="off">
        <div class="row">
          <div class="c12-l-12 c12-m-12 c12-s-12">
            <h3 class="">GRN Report</h3>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="bold">Suppliers Name</div>
          <div class="c12-l-10">
          <select class="small box mt4" name="SupplierName" id="SupplierName" placeholder="Supplier Name" onchange="SaveVal(this);">
                <option value=<?php echo "0000" ?>><?php echo "All" ?></option>

                <?php $SupplierArray = SelectSupplier();
                 for ($row = 0; $row < count($SupplierArray); $row++)
                 {
                      ?>
                      <option value=<?php echo $SupplierArray[$row]['SCode'] ?>><?php echo $SupplierArray[$row]['SName'] ?></option>
                      <?php
                 }


                 ?>
          </select >
        </div>
      </div>
        <br>
        <div class="row">
          <br>
          <div class="c12-s-6">
            <div class="bold">From Date</div>
            <input class="small" type="date" placeholder="Enter date (From)" name="FromDt" maxlength=10>
          </div>
        </div>
        <br>
        <div class="row">
          <br>
          <div class="c12-s-6">
            <div class="bold">To Date</div>
            <input class="small" type="Date" placeholder="Enter Date (To)" name="ToDt" maxlength=10>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="c12-s-6">
            <input type="submit" name="submitReport" value="ShowReport" class="button">
          </div>

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
      </div>

      </form>
    </div>


      <script src="../js/commonscripts.js">
        function closeMsg() {
          alert("HI");
          document.getElementById("popupMsg").style.display = "none";
        }
      </script>
  </body>
</html>
