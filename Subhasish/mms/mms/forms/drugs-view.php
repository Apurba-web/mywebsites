<?php
  session_start();
  $user = $_SESSION["user_id"];
  //
  include "../server/srv-drug-view.php"
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include 'head.php'; ?>
    <title>Prescription: Grugs List</title>
  </head>
  <body>
    <?php include "pg-caption.php"; ?>
    <?php include 'nav.php'; ?>

    <div class="container__viewform-large">
      <div class="row">
        <div class="c-l-11 bg_saberblue align-center p2">
          <h6>LIST OF DRUGS</h6>
        </div>
        <div class="c-l-1 bg_saberblue align-center">
          <a href="menu.php"><img class="button__close" src="../images/btn-close.png"></a>
        </div>
      </div>

      <div class="row p3 box">
        <div class="c-l-2"></div>
        <div class="c-l-1 align-center"><p class="small bold">Search Brand:</p></div>
        <div class="c-l-5">
          <input type="text" list="lstDrug"></span>
          <datalist class="" id="lstDrug">
            <?php
              foreach ($drugs as $drug) {
                echo "<option value='".$drug['drug_name_brand']."'>";
              }
            ?>
          </datalist>
        </div>
      </div>

      <div class="row" style="height: 500px; overflow:auto;">
        <div class="c-l-12 p2">
          <table>
            <thead>
              <th>Id</th>
              <th>Formulation</th>
              <th>Type</th>
              <th>Brand</th>
              <th>Generic</th>
              <th>Edit</th>
            </thead>
            <?php
              foreach ($drugs as $drug) {
                $id_of_drug = $drug['drug_id'];
                echo "<tr>";
                  echo "<td>".$drug['drug_id']."</td>";
                  echo "<td>".$drug['vehicle']."</td>";
                  echo "<td>".$drug['type']."</td>";
                  echo "<td>".$drug['drug_name_brand']."</td>";
                  echo "<td>".$drug['drug_name_generic']."</td>";
                  echo '<td><a href="drug-edit.php?edit='.$id_of_drug.'">edit</a></td>';
                echo "</tr>";
              }
            ?>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
