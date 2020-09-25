<?php
require_once("config.php");
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Login without button</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="row">
   
  <div class="col-md-4 mx-auto">
  <h2>Login form</h2>
  <form action="" method="" id="">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="username" placeholder="Enter email" name="username">
    </div>
    <div class="form-group">
     
      <input type="password" class="form-control" id="user_password" placeholder="Enter password" name="user_password">
    </div>
   
   
  </form>
   
</div>

</div>
<div class="row">
  <div class="col-md-4 mx-auto mt-5" id="alert_box">
    <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Failed!</strong>Please Provide Correct email.
</div>
  </div>

  <div class="col-md-4 mx-auto mt-5" id="alert_success">
    <div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong>Email matched successfully.
</div>
  </div>

  <div class="col-md-4 mx-auto mt-5" id="pwd_not_matched">
    <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Failed!</strong>Password not matched.
</div>
  </div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    $("#alert_box").hide();
     $("#alert_success").hide();
      $("#pwd_not_matched").hide();
    $("#user_password").prop("disabled", true);
    $("#user_password").hide();

    $(document).on("keyup", "#username", function() {
        var username = $("#username").val();
        if (username == "") {
            alert("enter email");
            $("#user_password").prop("disabled", true);
            return false;

        }
        var data = {
            "username": username
        }

        $.ajax({
            type: 'POST',
            url: 'login_sub.php',
            data: data,
            success: function(res) {
                if (res == "email_matched") { 
                  $("#alert_box").hide();
                   $("#alert_success").show();
                    $("#username").css("border-color", "green");
                    $("#user_password").show();
                    $("#user_password").prop("disabled", false);

                    $(document).on("keyup", "#user_password", function() {
                        var username = $("#username").val();
                        var user_password = $("#user_password").val();
                        //alert(user_password);
                        var data1 = {
                            "username": username,
                            "user_password": user_password
                        }


                        $.ajax({
                            type: 'POST',
                            url: 'login_sub.php',
                            data: data1,
                            success: function(res1) {
                                if (res1 == "email_matchedLogin") {
                                    window.location.href = "dashboard.php";
                                }
                                else{
                                   $("#alert_box").hide();
                                    $("#alert_success").hide();
                                  $("#pwd_not_matched").show();
                                }
                            }

                        });

                    });

                }

                if (res == "email_not_matched") {
                    //showing alertbox
                    $("#user_password").prop("disabled", true);
                    //alert("email not matched");
                    $("#alert_box").show();
                    $("#alert_success").hide();
                    $("#username").css("border-color", "red");
                }


            }

        });

    });
});
</script>

</body>
</html>




