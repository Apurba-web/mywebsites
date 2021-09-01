<?php
echo '


<!-- MENU DESKTOP   -->

<div class="menu__dsk">

  <div class="navbar">
    <!-- MASTER DETAIL -->

    <button onmouseover="openNavDrop(2, \'navDropMaster\', \'btnMaster\')" onmouseout="closeNavDrop(\'navDropMaster\')" id="btnMaster" class="navbar__dropdown-btn bg-lightmakeuppink txt-black">
      Master <i class="fa fa-caret-down"></i>
    </button>

    <div onmouseover="openNavDrop(2, \'navDropMaster\', \'btnMaster\')" onmouseout="closeNavDrop(\'navDropSite\')" id="navDropMaster" class="navbar__dropdown-link">
      <a href="SupplierMasterEntry.php">Supplier Master</a>
      <a href="test.php">Demo</a>
      <a href="GRNReportDateWise.php">GRN Report</a>
      <a href="ItemMasterEntry.php">Item Master</a>
      <a href="mobile.php">Mobile OTP</a>
    </div>

    <!-- PURCHASE DETAILS -->

    <button onmouseover="openNavDrop(1, \'navDropPurchase\', \'btnPurchase\')" onmouseout="closeNavDrop(\'navDropPurchase\')" id="btnPurchase" class="navbar__dropdown-btn bg-lightmakeuppink txt-black">
      Purchase<i class="fa fa-caret-down"></i>
    </button>

    <div onmouseover="openNavDrop(1, \'navDropPurchase\', \'btnPurchase\')" onmouseout="closeNavDrop(\'navDropPurchase\')" id="navDropPurchase" class="navbar__dropdown-link">
      <a href="GREntry.php">Good Received Entry</a>
      <a href="PurchaseEntry.php">Purchase Entry</a>
    </div>

    <!-- BILLING -->

    <button onmouseover="openNavDrop(1, \'navDropBilling\', \'btnBilling\')" onmouseout="closeNavDrop(\'navDropBilling\')" id="btnBilling" class="navbar__dropdown-btn bg-goldenyellow txt-black">
      Billing<i class="fa fa-caret-down"></i>
    </button>
    <div onmouseover="openNavDrop(1, \'navDropBilling\', \'btnBilling\')" onmouseout="closeNavDrop(\'navDropBilling\')" id="navDropBilling" class="navbar__dropdown-link">
      <a href="Billing.php">Billing Entry</a>
    </div>

    <!-- REGISTER -->

    <button onmouseover="openNavDrop(1, \'navDropRegister\', \'btnRegister\')" onmouseout="closeNavDrop(\'navDropRegister\')" id="btnRegister" class="navbar__dropdown-btn bg-lightmakeuppink txt-black">
      Register <i class="fa fa-caret-down"></i>
    </button>

    <div onmouseover="openNavDrop(1, \'navDropRegister\', \'btnRegister\')" onmouseout="closeNavDrop(\'navDropRegister\')" id="navDropRegister" class="navbar__dropdown-link">
      <a href="Register.php">Daily Register</a>

    </div>



  </div>
</div>

'


?>
