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
    <?php include 'includes/userHeader.php'; ?>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
   
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-default navbar-fixed-top">

        <div class="messages"></div>
        <div class="container-fluid" style="margin-right:5px;">
            <div class="navbar-header" style="float:top;position:absolute;margin-left:10px;">
                METRO BUSINESS PORTAL
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">

                <div class="usertab">
                    Welcome! <a href="CP.php">
                        <?php echo $_SESSION['Username']; ?></a><img src="img/Profile.png" alt="userpic" style="width:30px;height:30px;" />
                </div>

                <ul class="nav navbar-nav navbar-left">
                    <li><a href="#Home">HOME</a></li>
                    <li><a href="#HelpDesk">HELPDESK</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <?php

                        $isread = 'send';
                        $managerID = $_SESSION['Username'];
                        $sql = "SELECT send_id FROM send_table WHERE _stat='$isread' AND _to='$managerID'";
                        $query = $conn->query($sql);
                        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        $unreadcount = $query->num_rows;

                    ?>

                    <li><a href="inbox1.php">INBOX<span class="label label-danger">
                                <?php echo $unreadcount; ?></span></a></li>


                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="CP.php">EDIT PROFILE</a></li>
                            <li><a href="editbusiness.php" data-toggle="modal" data-target="download/index.php">EDIT BUSINESS INFO</a></li>
                            <li><a href="download/index.php" data-toggle="modal" data-target="download/index.php">DOWNLOADABLE FORMS</a></li>
                            <li><a href="logout.php" onclick="return confirm('Are you sure to logout?');">LOGOUT</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- End of Top Nav-bar, Timeline Section Below -->
    <!-- Timestamp Here-->

    <?php include 'includes/timeStamp.php'; ?>
    <div id="Home" class="container text-center">

        <h1>METRO BUSINESS PORTAL</h1>
        <p><em>Your Companion in your Business Career.</em></p>
        <button class="btn" onclick="window.location.href='PortalCreateBN.php'">
            Create Business Name
        </button>
    </div>
    <div class="container">
        <div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#menu0">
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </a>
                </li>
                <li>
                    <a class="btn" href="editbusiness.php">SELECT BUSINESS TO DISPLAY</a>
                </li>
            </ul>
        </div>

        <br />
        <div class="tab-content" id="Progress">

            <div id="menu0" class="tab-pane fade in active">
                <div style="margin-top:0px;">
                    Click the Button to Select which Business Name's Progress to show.
                </div>
            </div>
        </div> <!-- tab-content -->
    </div>
    
    <!-- Container (Contact Section) -->
    <div id="HelpDesk" class="container">
        <div class="col-md-12" style="margin:5px;padding:5px;">
            <div class="col-md-1">
                <input type="file" name="uploadFile" accept="application/pdf,image/jpeg,image/png,image/jpg" disabled/>
            </div>
            <div class="col-md-11" style="margin-right:5px;">
                <input type="submit" value="UPLOAD" id="upload" name="upload" class="btn" disabled/>
                <p>Disabled; To Upload a Requirement: <a href="editbusiness.php"><b>Select</b></a> a Business Name first</p>
            </div>
        </div>
        <fieldset class="field-border">
            <h2 class="text-center"><strong>Helpdesk Portal</strong></h2>
            <p class="text-center"><em>Your Interactive Portal-Assistant.</em></p>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Feel free to Contact/Appeal/Submit:</strong></p>
                    <p><a href="inbox1.php" class="btn">INBOX</a></p>
                    <br/>
                    <p><img src="img/DTIIcon.png" alt="DTI" height="20"/> &nbsp;dti.gov@mbp.com</p>
                    <p><img src="img/LGUIcon.png" alt="LGU" height="20"/> &nbsp; lgu.gov@mbp.com</p>
                    <p><img src="img/BIRIcon.png" alt="BIR" height="20"/> &nbsp; bir.gov@mbp.com</p>
                </div>
                <div class="col-md-8">

                    <form action="helpdesk.php" id="HDForm" method="POST">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input class="form-control hidden" style="margin:0;" type="text" id="hdname" name="hdname" value="<?php echo $_SESSION['Username']; ?>" readonly />
                                <label for="f" class="control-label">To</label>
                                <input class="form-control" style="margin:0;" type="text" id="hdto" name="hdto" required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="hdid" class="control-label">Subject</label>
                                <input class="form-control" type="text" id="s" name="s" value="" />
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control hidden" style="width:50px;" type="text" id="hdid" name="hdid" value="<?php echo $_SESSION['User_ID']; ?>" readonly />
                            </div>
                        </div>
                        <textarea class="form-control" id="hdmsg" name="hdmsg" rows="5" onkeyup="success()" required disabled placeholder="Message Here!"></textarea>
                        <input type="checkbox" onclick="document.getElementById('hdmsg').disabled= !this.checked;" /> Compose Message

                        <br/>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button class="btn pull-right" type="submit" id="hdsend" name = "hdsend" disabled> Send </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </fieldset>
    </div>

    <?php include 'includes/userFooter.php' ?>
    <script language="Javascript">
        function success() {


            if (document.getElementById("hdmsg").value === "") {

                document.getElementById('hdsend').disabled = true;

            } else {

                document.getElementById('hdsend').disabled = false;
            }
        }
    </script>
    <script>
        $(document).ready(function() {

            // Initialize Tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Add smooth scrolling to all links in navbar + footer link
            $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {

                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area

                    $('html, body').animate({

                        scrollTop: $(hash).offset().top

                    }, 900, function() {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });
        })
    </script>
    <script>
        // TRAPPINGS SeCTION

        function capitalize(obj) {
            obj.value = obj.value.split(' ').map(eachWord =>
                eachWord.charAt(0).toUpperCase() + eachWord.slice(1)
            ).join(' ');
        }


        $(document).ready(function() {
            $('#bplace').on('keypress', function(e) {
                if ($(this).val() == "") {
                    if (event.which === 32) {
                        return false;
                    } else {
                        var regex = new RegExp("^[a-zA-Z0-9., ]*$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    }
                } else {
                    var regex = new RegExp("^[a-zA-Z0-9., ]*$");
                    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                    if (!regex.test(key)) {
                        event.preventDefault();
                        return false;
                    }
                }
                return true;
            });

            $('#addr').on('keypress', function(e) {
                if ($(this).val() == "") {
                    if (event.which === 32) {
                        return false;
                    } else {
                        var regex = new RegExp("^[a-zA-Z0-9., ]*$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    }
                } else {
                    var regex = new RegExp("^[a-zA-Z0-9., ]*$");
                    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                    if (!regex.test(key)) {
                        event.preventDefault();
                        return false;
                    }
                }
                return true;
            });
            $('#editaddr').on('keypress', function(e) {
                if ($(this).val() == "") {
                    if (event.which === 32) {
                        return false;
                    } else {
                        var regex = new RegExp("^[a-zA-Z0-9., ]*$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    }
                } else {
                    var regex = new RegExp("^[a-zA-Z0-9., ]*$");
                    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                    if (!regex.test(key)) {
                        event.preventDefault();
                        return false;
                    }
                }
                return true;
            });

            $("#religion").keypress(function(event) {
                var inputValue = event.charCode;
                if (!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) {
                    event.preventDefault();
                }
            });

            $("#nationality").keypress(function(event) {
                var inputValue = event.charCode;
                if (!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) {
                    event.preventDefault();
                }
            });

            $("#lname").keypress(function(event) {
                var inputValue = event.charCode;
                if (!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) {
                    event.preventDefault();
                }
            });

            $("#mid_name").keypress(function(event) {
                var inputValue = event.charCode;
                if (!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) {
                    event.preventDefault();
                }
            });

            $("#fname").keypress(function(event) {
                var inputValue = event.charCode;
                if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
                    event.preventDefault();
                }
            });

            $("#user").keypress(function(event) {
                var inputValue = event.charCode;
                if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
                    event.preventDefault();
                }
            });

            $("#contactno").keypress(function(e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message

                    return false;
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            
            $("#HDForm").unbind('submit').bind('submit', function() {

                var form = $(this);

                var hdto = $("#hdto").val();
                var hdmsg = $("#hdmsg").val();

                if (hdto && hdmsg) {

                    $.ajax({

                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',

                        success: function(response) {

                            if (response.success == true) {
                                $(".messages").each(function() {

                                    alert("Message successfully sent.");

                                });

                                // refresh the table

                                //manageuserTable.ajax.reload(null, false);
                                $("#HDForm")[0].reset();
                            } else {

                                $(".messages").each(function() {
                                    alert("User Not Found.");
                                });
                            }
                        }
                    });
                }
                return false;
            });
        });
    </script>
</body>

</html>
<?php 
} ?> 