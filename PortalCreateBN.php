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
<body id="mypage" data-spy="scroll" data-target=".navbar" data-offset="50">
    
    <?php include 'includes/userNav.php'; ?>
    
    <div id="Home" class="container text-center">
        <div class="messages"></div> <!-- Message Verification -->
        <h2>Business Name</h2>
        <button class="btn" onclick="window.location.href='PortalHome1.php'">
            Go back to Home
        </button>
    </div>
    <div class="modal-dialog">
        <!-- CBN Form Section -->
        <form action="BNProcess.php" method="POST" id="BNform">
            <div class="form-group" style="display:none;">
                <label for="cbid"><span class="glyphicon glyphicon-user"></span> User's ID</label>
                <input type="text" class="form-control" id="cbid" name="cbid" value="<?php echo $_SESSION['User_ID']; ?>" readonly />
            </div>
            <div class="form-group col-xs-12">
                <label for="cbe"><span class="glyphicon glyphicon-user"></span> Email</label>
                <input type="text" class="form-control" id="cbe" name="cbe" value="<?php echo $_SESSION['Email'] ?>" disabled />
            </div>
            <div class="form-group col-xs-12">
                <input type="checkbox" name ="termsCheck" id="termsCheck" onClick="checkFunc(this)">
                <label for="termsCheck">I Have Agreed<a href="#trmsModal" data-toggle="modal" data-target="#trmsModal" >
                Undertaking</a></label>
            </div>
            <div class="form-group col-xs-12">
                <label for="bn"><span class="glyphicon glyphicon-qrcode"></span> Business Name</label>
                <input type="text" class="form-control" id="bn" name="bn" disabled required />
            </div>
            <div class="form-group col-md-12">
                <label for="badd"><span class="glyphicon glyphicon-home"></span> Location</label>
                <textarea class="form-control" id="badd" name="badd" placeholder="Enter District" required></textarea>
            </div>
            <div class="form-group col-md-12">
                <b>Business Size:</b>
                <input type="text" class="form-control" id="bs" name="bs" placeholder="No. of Employees" required />
            </div>
            <div class="form-group col-xs-6">
                <b>Type of Business:</b>
                <select class="form-control" name="tob" id="tob" required>
                    <option value="">-- SELECT --</option>
                    <?php 
                        $sql = "SELECT * FROM maincat_table";
                        $res = mysqli_query($conn, $sql);
                        
                        if(mysqli_num_rows($res) > 0) {
                            while($row = mysqli_fetch_object($res)) {
                        
                                echo "<option value='".$row->maincat_ID."'>".$row->maincat_name."</option>";
                            
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group col-xs-6">
                <b>Business Sub-Category:</b>
               <select class="form-control" name="bsc" id="bsc" required>
                  <option value="">-- SELECT --</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <b>Barangay:</b>
                <input type="text" class="form-control" id="by" name="by" placeholder="Brgy. Name" required>
            </div>

            <div class="form-group col-md-6">
                <b>Municipal:</b>
                <input type="text" class="form-control" id="m" name="m" placeholder="Municipal Name" required />
            </div>
            <div class="form-group col-md-6">
                <b>Region:</b>
                <select class="form-control" name="r" id="r">
                    <option class="selected" value="">~~SELECT REGION~~</option>
                    <option value="ARMM">ARMM (Autonomous Region in Muslim Mindanao)</option>
                    <option value="CAR">CAR (Cordillera Administrative Region)</option>
                    <option value="NCR">NCR (National Capital Region)</option>
                    <option value="REGION1">Region 1</option>
                    <option value="REGION2">Region 2</option>
                    <option value="REGION3">Region 3</option>
                    <option value="REGION4A">Region 4a</option>
                    <option value="REGION4B">Region 4b</option>
                    <option value="REGION5">Region 5</option>
                    <option value="REGION6">Region 6</option>
                    <option value="REGION7">Region 7</option>
                    <option value="REGION8">Region 8</option>
                    <option value="REGION9">Region 9</option>
                    <option value="REGION10">Region 10</option>
                    <option value="REGION11">Region 11</option>
                    <option value="REGION12">Region 12</option>
                    <option value="REGION13">Region 13</option>
                </select>
                <br/>
            </div>
            <div class="form-group">
                <input type="submit" name="cbnSend" id="cbnSend" value="Create Business Name" class="btn btn-block" disabled />
            </div>
        </form>
        <?php 

        ?>
    </div> <!-- CBN Form Section -->

    <!-- Undertaking -->
    <?php include 'terms.php';?>
    <!-- Footer -->
    <?php include 'includes/userFooter.php'; ?>
    <script type="text/javascript" src="ajax.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            
            $("#BNform").unbind('submit').bind('submit', function() {

                var form = $(this);

                var bn = $("#bn").val();
                var badd = $("#badd").val();
                var by = $("#by").val();
                var m = $("#m").val();
                var r = $("#r").val();

                if (bn && badd && by && m && r) {

                    $.ajax({

                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',

                        success: function(response) {

                            if (response.success == true) {
                                $(".messages").each(function() {

                                    alert("Business Name Successfully Added.");

                                });

                                // refresh the table

                                //manageuserTable.ajax.reload(null, false);
                                $("#BNform")[0].reset();
                            } else {

                                $(".messages").each(function() {
                                    alert("Business Name Already Exists.");
                                });
                            }
                        }
                    });
                }
                return false;
            });

        });
    </script>
    <script language="Javascript">

        function checkFunc(self)    {
        document.getElementById("cbnSend").disabled = !self.checked;
        document.getElementById("bn").disabled = !self.checked;
        }

    </script>
    <script>
        function capitalize(obj)
        {
            obj.value = obj.value.split(' ').map(eachWord=>
              eachWord.charAt(0).toUpperCase() + eachWord.slice(1)
            ).join(' ');
        }

        $("#bs").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                   return false;
        }
       });
        $("#by").keypress(function(event){
            var inputValue = event.charCode;
            if((inputValue != 32) &&!(inputValue >= 65 && inputValue <= 122) && !(inputValue >= 48 && inputValue <= 57) || (inputValue >= 91 && inputValue <= 96)){
                event.preventDefault();
            }
        });
        $("#m").keypress(function(event){
            var inputValue = event.charCode;
            if((inputValue != 32) &&!(inputValue >= 65 && inputValue <= 122) && !(inputValue >= 48 && inputValue <= 57) || (inputValue >= 91 && inputValue <= 96)){
                event.preventDefault();
            }
        });
        $("#bn").keypress(function(event){
            var inputValue = event.charCode;
            if((inputValue != 32) && !(inputValue >= 65 && inputValue <= 122) && !(inputValue >= 48 && inputValue <= 57) || (inputValue >= 91 && inputValue <= 96)){
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
<?php 
} ?> 