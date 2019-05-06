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

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
    <?php include 'includes/userNav.php'; ?>
    <?php include 'includes/timestamp.php'; ?>

    <div class="container">
        <div class="row">
            <br/>

            <!-- /.col -->
            <div class="col-md-12" style="margin-top: -200px;">
                <div class="removeMessages"></div>
                <h1 class="box-title">My Business List</h1>
                <fieldset class="field-border">
                    <br/>
                    <table id="viewBusiness" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Business ID</th>
                                <th>Business Name</th>
                                <th>Business Owner</th>
                                <th>Business Type</th>
                                <th>Business Location</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </fieldset>

                <div class="modal fade" tabindex="-1" role="dialog" id="d2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete Message</h4>
                            </div>
                            <div class="modal-body">
                                <p style="font-size:20px;">Do you really want to delete this data ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" id="dqwe12">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" id="e2">
                    <div class="modal-dialog" role="document" style="width:800px;">
                        <div class="modal-content" style="height:20%;">
                            <div class="modal-header">
                                <h3 class="modal-title" style="color:white;"><span class="glyphicon glyphicon-pencil"></span> 
                                    Edit Business 
                                </h3>
                            </div>
                            <form action="edit101.php" method="POST" id="editBuForm">
                                <div class="modal-body">
                                    <div class="edit-messages"></div>
                                    <br/>
                                    
                                    <fieldset>
                                        <div class="form-group" style="display:none;">
                                            <label for="ecbid"><span class="glyphicon glyphicon-user"></span> User's ID</label>
                                            <input type="text" class="form-control" id="ecbid" name="ecbid" value="<?php echo $_SESSION['User_ID']; ?>" readonly />
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="ecbe"><span class="glyphicon glyphicon-user"></span> Email</label>
                                            <input type="text" class="form-control" id="ecbe" name="ecbe" value="<?php echo $_SESSION['Email'] ?>" disabled />
                                        </div>


                                        <div class="form-group col-xs-12">
                                            <label for="ebn"><span class="glyphicon glyphicon-qrcode"></span> Business Name</label>
                                            <input type="text" class="form-control" id="ebn" name="ebn" required />
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="ebadd"><span class="glyphicon glyphicon-home"></span> Location</label>
                                            <textarea class="form-control" id="ebadd" name="ebadd" placeholder="Enter District" required></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <b>Business Size:</b>
                                            <input type="text" class="form-control" id="ebs" name="ebs" placeholder="No. of Employees" required />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <b>Type of Business:</b>
                                            <select class="form-control" name="etob" id="etob">
                                                <option value=""> -- SELECT -- </option>
                                                    <?php
                                                        
                                                        $sql="SELECT * FROM maincat_table";
                                                        $query = mysqli_query($conn, $sql);
                                                        $results = mysqli_fetch_all($query,MYSQLI_ASSOC);
                                                    
                                                      
                                                        if(mysqli_num_rows($query)> 0 ){
                                                            foreach($results as $result){           
                                        
                                                    ?>
                                                                <option value="<?php echo $result['maincat_ID']?>"><?php echo $result['maincat_code']," - ",$result['maincat_name']?></option>
                                                    <?php   }} ?>
                                            </select>
                                        </div>
                                       <!-- <div class="form-group col-xs-6">
                                            <b>Business Sub-Category:</b>
                                            <select class="form-control" name="ebsc" id="ebsc">
                                                <option class="selected" value="" disabled>-- Select --</option>
                                                <option value="Category 1">Category 1</option>
                                                <option value="Category 2">Category 2</option>
                                            </select>
                                        </div> -->
                                        <div class="form-group col-xs-6">
                                            <b>Business Sub-Category:</b>
                                           <select class="form-control" name="ebsc" id="ebsc" required>
                                              <option value="">-- SELECT --</option>
                                            </select>
                                        </div>  
                                        <div class="form-group col-md-6">
                                            <b>Barangay:</b>
                                            <input type="text" class="form-control" id="eby" name="eby" placeholder="Brgy. Name" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <b>Municipal:</b>
                                            <input type="text" class="form-control" id="em" name="em" placeholder="Municipal Name" required />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <b>Region:</b>
                                            <select class="form-control" name="er" id="er" required>
                                                <option class="selected" value=""> -- SELECT REGION -- </option>
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
                                        </div>
                                    </fieldset>

                                    <div class="modal-footer e2">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Close</button>
                                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> 
                                            Save changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="ajax.js"></script>
    <script>
        var viewBusiness;

        $(document).ready(function() {

            viewBusiness = $("#viewBusiness").DataTable({
                "ajax": "viewbusiness.php",
                "order": []
            });
        });
        //delete msg
        function deletenadis(Business_ID = null) {
            if (Business_ID) {
                // click on remove button
                $("#dqwe12").unbind('click').bind('click', function() {
                    $.ajax({
                        url: 'delete123.php',
                        type: 'post',
                        data: {
                            Business_ID: Business_ID
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success == true) {
                                $(".removeMessages").each(function() {

                                    alert("successfully deleted");
                                });
                                // refresh the table
                                viewBusiness.ajax.reload(null, false);

                                // close the modal
                                $("#d2").modal('hide');

                            } else {
                                $(".removeMessages").each(function() {

                                    alert("Error while removing data");
                                });
                            }
                        }
                    });
                }); // click remove btn
            } else {
                alert('Error: Refresh the page again');
            }
        }

        function editBU(Business_ID = null) {
            if (Business_ID) {

                // remove the error 
                $(".form-group").removeClass('has-error').removeClass('has-success');
                $(".text-danger").remove();
                // empty the message div
                $(".edit-messages").html("");

                // remove the id
                $("#Business_ID").remove();

                // fetch the member data
                $.ajax({
                    url: 'getBU.php',
                    type: 'post',
                    data: {
                        Business_ID: Business_ID
                    },
                    dataType: 'json',
                    success: function(response) {
                        $("#ebn").val(response.Business_Name);
                        $("#ebadd").val(response.Business_Loc);
                        $("#ebs").val(response.Business_Size);
                        $("#etob").val(response.Business_Type);
                        $("#ebsc").val(response.Business_Sub);
                        $("#eby").val(response.Business_Brgy);
                        $("#em").val(response.Business_Mncipal);
                        $("#er").val(response.Business_Region);


                        // mmeber id 
                        $(".e2").append('<input type="hidden" name="Business_ID" id="Business_ID" value="' + response.Business_ID + '"/>');

                        // here update the member data
                        $("#editBuForm").unbind('submit').bind('submit', function() {
                            // remove error messages
                            $(".text-danger").remove();

                            var form = $(this);

                            // validation
                            var ebadd = $("#ebadd").val();

                            if (ebadd) {
                                $.ajax({
                                    url: form.attr('action'),
                                    type: form.attr('method'),
                                    data: form.serialize(),
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.success == true) {
                                            $(".edit-messages").each(function() {

                                                alert("Successfully Updated");
                                            });

                                            // reload the datatables
                                            viewBusiness.ajax.reload(null, false);
                                            // this function is built in function of datatables;
                                            location.reload();
                                            // remove the error 
                                            $(".form-group").removeClass('has-success').removeClass('has-error');
                                            $(".text-danger").remove();
                                        } else {
                                            $(".edit-messages").each(function() {

                                                alert("Error while updating data");
                                            });
                                        }
                                    } // /success
                                }); // /ajax
                            } // /if

                            return false;
                        });

                    } // /success
                }); // /fetch selected member info

            } else {
                alert("Error : Refresh the page again");
            }
        }
    </script>
     <script>
        function capitalize(obj)
        {
            obj.value = obj.value.split(' ').map(eachWord=>
              eachWord.charAt(0).toUpperCase() + eachWord.slice(1)
            ).join(' ');
        }

        $("#ebs").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                   return false;
        }
       });
        $("#eby").keypress(function(event){
            var inputValue = event.charCode;
            if((inputValue != 32) &&!(inputValue >= 65 && inputValue <= 122) && !(inputValue >= 48 && inputValue <= 57) || (inputValue >= 91 && inputValue <= 96)){
                event.preventDefault();
            }
        });
        $("#em").keypress(function(event){
            var inputValue = event.charCode;
            if((inputValue != 32) &&!(inputValue >= 65 && inputValue <= 122) && !(inputValue >= 48 && inputValue <= 57) || (inputValue >= 91 && inputValue <= 96)){
                event.preventDefault();
            }
        });
        $("#ebn").keypress(function(event){
            var inputValue = event.charCode;
            if((inputValue != 32) && !(inputValue >= 65 && inputValue <= 122) && !(inputValue >= 48 && inputValue <= 57) || (inputValue >= 91 && inputValue <= 96)){
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
<?php } ?> 