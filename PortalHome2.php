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

        <!-- This Function Uploads File -->
    <?php 

        if(isset($_POST['upload'])){

            $id= intval($_GET['id']);
            $target = 'uploads/'.basename($_FILES['uploadFile']['name']);
                $image = $_FILES['uploadFile']['name'];
                $user = $id;
                $sql = "INSERT INTO upload_table (
                file_name,
                type, 
                description, 
                disposition, 
                expires, 
                cache, 
                pragma, 
                file_date,
                Business_ID) 

                VALUES (

                '$image',
                'application/octet-stream',
                'File Transfer',
                'attachment',
                0,
                'must-revalidate',
                'public',
                CURRENT_TIMESTAMP,
                '$user'

                )";
                mysqli_query($conn, $sql);


            if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], $target)){

                echo"
                    <script>
                        alert('File Uploaded Successfully!');
                    </script>
                ";
            }else {

                echo"
                    <script>
                        alert('Error on Uploading File!');
                    </script>

                ";
            }
        }
    ?>

   <?php 
        $id= intval($_GET['id']);

        $bprog = "SELECT * FROM business_table WHERE Business_ID = $id";
        $bpquery=$conn->query($bprog);
        $bpdata = mysqli_fetch_array($bpquery);
        $a=$bpdata['Business_Name'];
        $bid =  $bpdata['Business_ID'];

    ?>
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
    <div class="container">
    <div id="Home" class="text-center" style="margin-bottom:20px;">
        <h1><strong>METRO BUSINESS PORTAL</strong></h1>
        <p><em>Your Companion in your Business Career.</em></p>
        <br/><br/>
    </div>
        <div class="tab-pane">
            <ul class="nav nav-tabs" style="padding-left:18px;">
                <li>
                    <a data-toggle="tab" href="#menu1" class="btn-primary">
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </a>
                </li>
                <li class="active">
                    <a data-toggle="tab" href="#menu0" class="btn">
                        <span class="glyphicon glyphicon-triangle-bottom"></span>
                        <?php echo $a ?>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content" style="margin-top:20px;" id="Progress">
            <div id="menu1" class="tab-pane fade">
                <div class="col-md-12">
                    <br/>
                    <img src="img/DTIIcon.png" alt="DTI" height="60" style="float:left;margin-top:0px;margin-right:5px;position:relative;"/>
                    <img src="img/LGUIcon.png" alt="DTI" height="60" style="float:left;margin-top:0px;margin-right:5px;position:relative;"/>
                    <img src="img/BIRIcon.png" alt="DTI" height="60" style="float:left;margin-top:0px;margin-right:5px;position:relative;"/>
                    <br/><br/><br/>
                    <p>Click Button to Show <?php echo $a?> BN Progress</p>
                    <p>Click <a href="editbusiness.php">Here</a> to Select another BN</p> 
                </div>
            </div>
            <div id="menu0" class="tab-pane fade in active">
                <div style="margin-top:0px;">
                    <div class="tab-content" style="text-align:left;font-size:15px;">
                  
                        <div id="DTI" class="col-md-4">
                            <div style="margin-top:0px;">
                                <h4 style="font-size:17px;">Department of Trade and Industry</h4>
                              
                                <table id="featTable"> <!-- DTI Table -->
                                    <?php
                                        $a=4;
                                        $id=intval($_GET['id']);
                                        $sql44="SELECT * FROM progress_table WHERE Progress_Status='approve_BNRegister' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query3=$conn->query($sql44);
                                        $data = mysqli_fetch_array($query3);
                                        $a=$data['Progress_By'];
                                        $b=$data['Progress_Status'];
                                        $c=$data['Business_ID'];
                                        $d1=$data['Progress_ID'];
                                  
                                        if($data['Progress_ID']==$d1 && $b=='approve_BNRegister'){
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" checked name="dti_CBN" disabled /></td>
                                        <td style="color:green;">Business Name Registration</td>
                                    </tr>
                                    
                                    <?php }else{?>
                                    
                                    <tr>
                                        <td><input type="checkbox"  name="dti_CBN" disabled /></td>
                                        <td>Business Name Registration</td>
                                    </tr>
                                    
                                    <?php }

                                        $a=4;
                                        $id=intval($_GET['id']);
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_BNVerify' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query=$conn->query($sql);
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                 
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_BNVerify'){
                                  
                                    ?>
                            
                                    <tr>
                                        <td><input type="checkbox" checked name="dti_BNF" disabled /></td>
                                        <td style="color:green;">DTI-BN Form Verification</td>
                                    </tr>
                                    
                                    <?php } else{?>
                                        
                                    <tr>
                                        <td><input type="checkbox"  name="dti_BNF" disabled /></td>
                                        <td>DTI-BN Form Verification</td>
                                    </tr>
                                    
                                    <?php }
                                    
                                    $a=4;
                                          $id=intval($_GET['id']);
                                          $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_All' AND Progress_By='$a' AND Business_ID='$id'";
                                          $query=$conn->query($sql);
                                          $data1 = mysqli_fetch_array($query);
                                          $a1=$data1['Progress_By'];
                                          $b1=$data1['Progress_Status'];
                                          $c1=$data1['Business_ID'];
                                          $d1=$data1['Progress_ID'];
                                       
                                          if($data1['Progress_ID']==$d1 && $b1=='approve_All'){
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" checked name="dti_CoR" disabled/></td>
                                        <td style="color:green;">Wait for Certificate of Registration: Claimed?</td>
                                    </tr>
                                          <?php } else{?>
                                            <tr>
                                        <td><input type="checkbox"  name="dti_CoR" disabled/></td>
                                        <td>Wait for Certificate of Registration: Claimed?</td>
                                    </tr>
                                          <?php }?>
                                </table> <!-- DTI Table -->
                            </div>
                        </div>
                        <div id="LGU" class="col-md-4">
                            <div style="margin-top:0px;">
                                <h4>Local Government Unit</h4>

                                <table id="featTable"> <!-- LGU Table -->
                                    
                                    <?php
                                        $a=3;
                                        $id=intval($_GET['id']);
                                        $sql44="SELECT * FROM progress_table WHERE Progress_Status='approve_brgyBusPerm' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query3=$conn->query($sql44);
                                        $data = mysqli_fetch_array($query3);
                                        $a=$data['Progress_By'];
                                        $b=$data['Progress_Status'];
                                        $c=$data['Business_ID'];
                                        $d1=$data['Progress_ID'];
                                  
                                        if($data['Progress_ID']==$d1 && $b=='approve_brgyBusPerm'){
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" checked name="lgu_brgy" disabled /></td>
                                        <td style="color:green;">Barangay Certificate of Business Registration</td>
                                    </tr>
                                    
                                    <?php }else{?>
                                    
                                    <tr>
                                        <td><input type="checkbox"  name="lgu_brgy" disabled /></td>
                                        <td>Barangay Certificate of Business Registration </td>
                                    </tr>
                                    
                                    <?php }

                                        $a=3;
                                        $id=intval($_GET['id']);
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_MunBusPerm' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query=$conn->query($sql);
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                 
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_MunBusPerm'){
                                  
                                    ?>
                            
                                    <tr>
                                        <td><input type="checkbox" checked name="dti_CH" disabled /></td>
                                        <td style="color:green;">Municipal Hall Business Permit</td>
                                    </tr>
                                    
                                    <?php } else{?>
                                        
                                    <tr>
                                        <td><input type="checkbox"  name="dti_CH" disabled /></td>
                                        <td>Municipal Hall Business Permit </td>
                                    </tr>
                                    
                                    <?php }
                                    
                                    $a=3;
                                          $id=intval($_GET['id']);
                                          $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_AllLGU' AND Progress_By='$a' AND Business_ID='$id'";
                                          $query=$conn->query($sql);
                                          $data1 = mysqli_fetch_array($query);
                                          $a1=$data1['Progress_By'];
                                          $b1=$data1['Progress_Status'];
                                          $c1=$data1['Business_ID'];
                                          $d1=$data1['Progress_ID'];
                                       
                                          if($data1['Progress_ID']==$d1 && $b1=='approve_AllLGU'){
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" checked name="dti_CoL" disabled/></td>
                                        <td style="color:green;">Proof of Address | Contract of Lease or</td>
                                    </tr>
                                          <?php } else{?>
                                            <tr>
                                        <td><input type="checkbox"  name="dti_CoL" disabled/></td>
                                        <td>Proof of Address | Contract of Lease or </td>
                                    </tr>
                                    <?php }?>
                                </table> <!-- LGU End -->
                            </div>
                        </div>
                        <div id="BIR" class="col-md-4">
                            <div style="margin-top:0px;">
                                <h4>Bureu of Internal Revenue</h4>
                                <table id="featTable"> <!-- BIR Table -->
                                    
                                    <?php
                                        $a=2;
                                        $id=intval($_GET['id']);
                                        $sql44="SELECT * FROM progress_table WHERE Progress_Status='approve_1901' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query3=$conn->query($sql44);
                                        $data = mysqli_fetch_array($query3);
                                        $a=$data['Progress_By'];
                                        $b=$data['Progress_Status'];
                                        $c=$data['Business_ID'];
                                        $d1=$data['Progress_ID'];
                                  
                                        if($data['Progress_ID']==$d1 && $b=='approve_1901'){
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" checked name="bir_1901" disabled /></td>
                                        <td style="color:green;">BIR Form 1901 | Self-Employment, Mixed Income, Estate and Trust</td>
                                    </tr>
                                    
                                    <?php }else{?>
                                    
                                    <tr>
                                        <td><input type="checkbox"  name="bir_1901" disabled /></td>
                                        <td>BIR Form 1901 | Self-Employment, Mixed Income, Estate and Trust  </td>
                                    </tr>
                                    
                                    <?php }

                                        $a=2;
                                        $id=intval($_GET['id']);
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_0605' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query=$conn->query($sql);
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                 
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_0605'){
                                  
                                    ?>
                            
                                    <tr>
                                        <td><input type="checkbox" checked name="bir_0605" disabled /></td>
                                        <td style="color:green;">BIR Form 0605 | Documentary Stamp Tax Return</td>
                                    </tr>
                                    
                                    <?php } else{?>
                                        
                                    <tr>
                                        <td><input type="checkbox"  name="bir_0605" disabled /></td>
                                        <td>BIR Form 0605 | Documentary Stamp Tax Return  </td>
                                    </tr>
                                    
                                    <?php }
                                    
                                    $a=2;
                                          $id=intval($_GET['id']);
                                          $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_2000' AND Progress_By='$a' AND Business_ID='$id'";
                                          $query=$conn->query($sql);
                                          $data1 = mysqli_fetch_array($query);
                                          $a1=$data1['Progress_By'];
                                          $b1=$data1['Progress_Status'];
                                          $c1=$data1['Business_ID'];
                                          $d1=$data1['Progress_ID'];
                                       
                                          if($data1['Progress_ID']==$d1 && $b1=='approve_2000'){
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" checked name="bir_2000" disabled/></td>
                                        <td style="color:green;">BIR Form 2000 | Remittance Document</td>
                                    </tr>
                                          <?php } else{?>
                                            <tr>
                                        <td><input type="checkbox"  name="bir_2000" disabled/></td>
                                        <td>BIR Form 2000 | Remittance Document  </td>
                                    </tr>
                                          <?php }?>
                                </table> <!-- BIR End -->
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Container (Contact Section) -->
    <div id="HelpDesk" class="container">

        <form enctype="multipart/form-data" action="" name="uploadForm" id="uploadForm" method="POST"> <!-- Upload Form -->
            <div class="col-md-12" style="margin:5px;padding:5px;">
                <fieldset class="field-border">
                    <div class="col-md-1">
                        <input type="file" name="uploadFile" accept="application/pdf,image/jpeg,image/png,image/jpg" required/>
                    </div>
                    <div class="col-md-11" style="margin-right:5px;">
                        <input type="submit" value="UPLOAD" id="upload" name="upload" class="btn"/>
                        Click 'Choose File' to Browse and then Click Upload to submit a selected file.
                    </div>
                </fieldset>
            </div>
        </form>
      
        <fieldset class="field-border">
        <h2 class="text-center">PORTAL HELPDESK</h2>
        <p class="text-center"><em>Your Interactive Portal-Assistant.</em></p>
            <div class="row">
                <div class="col-md-4" style="float:left;">
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