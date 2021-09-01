<?php
#echo dirname( __DIR__ );
   require_once( dirname( __DIR__ ) . '/srv/login-server.php' );
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require_once( dirname( __FILE__ ) . "/head.php" ); ?>
    <title>MMS : Login</title>
  </head>

  <body>
    <div class="">
      <?php require_once( dirname( __FILE__ ) . "/pg-caption.php" ); ?>
    </div>
    <div class="container__login">
      <form class="" action="login.php" method="post" autocomplete="off">
        <div class="row">
          <div class="c12-l-12 c12-m-12 c12-s-12">
            <h3 class="">Please Login</h2>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="c12-l-2 c12-m-2 c12-s-2 center p4">
            <img src="../images/user.png" alt="" class="img-fluid">
          </div>
          <div class="c12-l-10 c12-m-10 c12-s-10 center">
            <input class="small" type="text" placeholder="enter user name" name="user" maxlength=10 value="<?php echo $user ?>">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="c12-l-2 c12-m-2 c12-s-2 center p4">
            <img src="../images/key.png" alt="" class="img-fluid">
          </div>
          <div class="c12-l-10 c12-m-10 c12-s-10 center">
            <input class="small" type="password" placeholder="enter password" name="pwd" maxlength=25 value="<?php echo $pwd ?>">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="c12-l-2 c12-m-2"></div>
          <div class="c12-l-5 c12-m-5 c12-s-12 center">
            <input type="submit" name="submit_login" value="Submit" class="small round bg-verylightgoldenyellow txt-black">
          </div>
          <div class="c12-l-6 c12-m-6 c12-s-12 center">
            <a href="pwd-change.php" class="changepwd">Change Password</a>
          </div>
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
      </form>
    </div>
  </body>

  <script src="../js/commonscripts.js">
    function closeMsg() {
      alert("HI");
      document.getElementById("popupMsg").style.display = "none";
    }
  </script>
</html>
