// ---- SIDE NAV BAR PANEL

function sendOTP() {
  alert("Verfication");
  $(".error").html("").hide();
  var number = $("mobile").val();
  if (number.length == 10 && number != null){
    var input = {
      "mobile number" : number,
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

//	NTI0YzU2Mzk1MDUzNzY0ZTc4NTc0NjUwNzA2ODc2NDk=
