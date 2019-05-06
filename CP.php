<?php

session_start();
require_once 'includes/connect.php';

if (!isset($_SESSION['Username'])) {
    
    header('location:index.php');
    exit;

} else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Metro Business Portal</title>
    <?php include 'includes/userHeader.php'; ?>
    <style>
        
        .container{

            font-size:20px;

        }

    </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
    <?php include 'includes/userNav.php'; ?>
    <?php include 'includes/timestamp.php'; ?>

    <div class="container">
        <div class="messages"></div>
        <div class="removeMessages"></div>
        
        <br/>
        <div class="row">
            <fieldset class="field-border">
                <h3 style="text-align:left;">USER PROFILE</h3>
                <div class="col-md-8">

                    <p><b>Username: </b><?php echo $_SESSION['Username']?></p>
                    <p><b>Email: </b><?php echo $_SESSION['Email']?></p>
                    <br/><br/>
                </div>
            </fieldset>
        </div>
        <div class="row">
            <fieldset class="field-border">
                <h3 style="text-align:left;">CHANGE PASSWORD</h3>
                <div class="col-md-10">
                   <form action="CNP.php" method="POST" id="CP">
     
                        <div class="form-group col-xs-3">
               
                            <label for="ecbe"><span class="glyphicon glyphicon-lock"></span> Enter New Password</label>
                            <input type="password" class="form-control" id="enp" name="enp">
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="ecbe"><span class="glyphicon glyphicon-lock"></span> Confirm New Password</label>
                            <input type="password" class="form-control" id="cnp" name="cnp">
                        </div>  
                        <div class="form-group col-xs-6">      
                            <button type="submit" class="btn btn-primary pull pull-right"><span class="glyphicon glyphicon-ok"></span> 
                                Save Changes
                            </button>
                        </div>   
                   </form>
                </div>
            </fieldset>           
        </div>
    </div>  
<script>
    var password = document.getElementById("enp"),
        confirm_password = document.getElementById("cnp");

    function validatePassword() {
        
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Password Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
  
<script type="text/javascript">
     $("#CP")[0].reset();
      $("#CP").unbind('submit').bind('submit', function() {

                var form = $(this);

                var cnp = $("#cnp").val();



                if (cnp) {

                    $.ajax({

                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',

                        success: function(response) {

                            if (response.success == true) {
                                $(".messages").each(function() {

                                    alert("Password Change!");

                                });

                               
                                $("#CP")[0].reset();
                            } else {

                                $(".messages").each(function() {
                                    alert("Not sent!");
                                });
                            }
                        }
                    });
                }
                return false;
            });

</script>>

</body>
</html>
<?php } ?> 