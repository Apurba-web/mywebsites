
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require_once( dirname( __FILE__ ) . "/head.php" ); ?>
    <title>How to Implement OTP SMS Mobile Verfication</title>
  </head>

<body>
  <div class="container__login">
      <div class="error"></div>
      <form id ="frm-mobile-verification ">
        <div class="form-heading">Mobile Number Verification</div>

      <div class="form-row">
          <input type="number" id="mobile" class= "form-input"
             placeholder="Enter the 10 digit mobile">
      </div>

      <input type="button" class="btnSubmit" value="Send OTP" onClick="sendOTP();">
    </form>
  </div>
</body>

  <script type="text/javascript" src = "../js/jquery.js"></script>

  <script>
  function sendOTP() {

    $(".error").html("").hide();
    var number = $("#mobile").val();

    if (number.length == 10 && number != null){
      var input = {
        "mobile_number" : number,
        "action" : "send_otp"
      }

      $.ajax({
        url : 'controller.php',
        type : 'POST',
        data : input,
        success : function(response){
          $(".container__login").html(response);
        }
      });
    } else {
      $(".error").html('please enter a valid number!')
      $(".error").show();
    }
  }
  </script>

  <script>
  function verifyOTP() {
    $(".error").html("").hide();
    $(".sucess").html("").hide();
    var otp = $("#mobileOtp").val();
    var input = {
      "otp" : otp,
      "action" : "verify_otp"
    };
    if (otp.length == 6 && otp !null) {
      $.ajax({
        url : 'controller.php',
        type : 'POST',
        dataType : "json",
        data : input,
        success : function(response) {
          $("." + response.type).html(response.message)
          $("." + response.type).show();
        },
        error : function() {
          alert("ss");
        }
      })
    } else {
        $(".error").html('You have entered Wrong OTP')
        $(".error").show();

    }
  }

  </script>

  <script src="verification.js"></script>



</html>
