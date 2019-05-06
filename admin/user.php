<?php

    session_start();
    require_once 'includes/connect.php';

    if (!isset($_SESSION['Username'])) {
        header('location:../index.php');
        exit;

    } else {

?>

<?php require_once 'includes/connect.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12 col-centered">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="removeMessages"></div>
                                     <div style="float:left;">
                                         <h3>System User Masterfile</h3>
                                     </div>              
                                     <div style="float:right;">
                                        <fieldset class="field-border" style="text-align:left;">
                                            <b>LEGENDS</b> 
                                            <br/><span class="glyphicon glyphicon-check" style="color:green;"></span> Check Requirements
                                            <br/><span class="glyphicon glyphicon-eye-open" style="color:blue;"></span> View Business Information 
                                        </fieldset>
                                    </div>
                                    <button class="btn btn-primary pull pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addUser" id="addUserModalBtn" style="margin-right:5px;margin-left:5px;">
                                            <span class="glyphicon glyphicon-plus-sign"></span> Add User
                                    </button>
                                    <div style="margin-top:100px;">
                                        <table id="manageuserTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>User_ID</th>
                                                    <th>Full Name</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                <!--REMOVE USER MODAL-->
                                <div class="modal fade" tabindex="-1" role="dialog" id="removeuserModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Remove User</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Do you really want to remove ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="removeBtn1">Delete</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!--ADD USER MODAL-->
                                <div class="modal fade" tabindex="-1" role="dialog" id="addUser">
                                    <div class="modal-dialog" role="document" style="width:800px;">
                                        <div class="modal-content" style="height:20%;">
                                            <div class="modal-header">
                                                <h3 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Add User</h3>
                                            </div>
                                            <form action="php_action/adduser.php" method="POST" id="addUserForm">
                                                <div class="modal-body">
                                                    <div class="messagess"></div>
                                                    <br />
                                                    <fieldset class="field-border">
                                                        <legend class="field-border">Personal Information</legend>
                                                        <div class="form-group col-xs-6 ">
                                                            <label for="fname" class="control-label">FirstName</label>
                                                            <input type="text" class="form-control" id="fname" name="fname" onkeyup='capitalize(this)' placeholder="Enter First Name" required>                             
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="mname" class="control-label">MiddleName</label>
                                                            <input type="text" class="form-control" id="mname" name="mname" onkeyup='capitalize(this)' placeholder="Enter Middle Name" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="lname" class="control-label">LastName</label>
                                                            <input type="text" class="form-control" id="lname" name="lname" onkeyup='capitalize(this)' placeholder="Enter Last Name" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="bdate" class="control-label">Birthdate</label><br/>
                                                            <input type="date" min="<?=date('Y-m-d', strtotime(date('Y-m-d'). ' - 100 years'))?>" max="<?=date('Y-m-d', strtotime(date('Y-m-d'). ' - 18 years'))?>" name="bdate" class='form-control pull-right' required >
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="bplace" class="control-label">Birth Place</label>
                                                            <textarea type="street-address" class="form-control" id="bplace" name="bplace" onkeyup='capitalize(this)' placeholder="Enter Address" required></textarea>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="addr" class="control-label"> Address</label>
                                                            <textarea type="street-address" class="form-control" id="addr" name="addr" onkeyup='capitalize(this)' placeholder="Enter Address" required></textarea>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="gender" class="control-label">Gender</label>
                                                            <select class="form-control" name="gender" id="gender" required>
                                                                <option value="">--Select--</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="civilstat" class="control-label">Civil Status</label>
                                                            <select class="form-control" name="civilstat" id="civilstat" required>
                                                                <option value="">--Select--</option>
                                                                <option value="Single">Single</option>
                                                                <option value="Married">Married</option>
                                                                <option value="Widowed">Widowed</option>
                                                                <option value="Divorced">Divorced</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="nationality" class="control-label">Nationality</label>
                                                            <input type="text" class="form-control" id="nationality" name="nationality" onkeyup='capitalize(this)' placeholder="Enter Nationality" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="contactno" class="control-label">Contact Number</label>
                                                            <input type="text" class="form-control" id="contactno" name="contactno" maxlength="11" placeholder="Example '09123456789'" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="religion" class="control-label">Religion</label>
                                                            <input type="text" class="form-control" id="religion" name="religion" onkeyup='capitalize(this)' placeholder="Enter Religion" required>
                                                        </div>
                                                    </fieldset>
                                                    
                                                    <fieldset class="field-border">
                                                        <legend class="field-border">Account Information</legend>
                                                        <div class="form-group col-lg-6 ">
                                                            <label for="user" class="control-label">Username</label>
                                                            <input class="form-control" type="text" name="user" id="user" required>
                                                        </div>                               
                                                        <div class="form-group col-lg-6 ">
                                                            <label for="e" class="control-label">Email</label>
                                                            <input class="form-control" type="email" name="e" id="e" required>
                                                        </div>
                                                        <div class="form-group col-lg-6 ">
                                                            <label for="user" class="control-label">Password</label>
                                                            <input class="form-control" type="password" name="p" id="p" required>
                                                        </div>
                                        
                                                        <div class="form-group col-lg-6 ">
                                                            <label for="user" class="control-label">Confirm Password</label>
                                                            <input class="form-control" type="password" name="cp" id="cp" required>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Close</button>
                                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!--EDIT USER-->
                                <div class="modal fade" tabindex="-1" role="dialog" id="editUser">
                                    <div class="modal-dialog" role="document" style="width:800px;">
                                        <div class="modal-content" style="height:20%;">
                                            <div class="modal-header">
                                                <h3 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Edit User</h3>
                                            </div>
                                            <form action="php_action/editinfo.php" method="POST" id="editUserForm">
                                                <div class="modal-body">
                                                    <div class="edit-messages"></div>
                                                    <br />
                                                    <fieldset class="field-border">
                                                        <legend class="field-border">Personal Information</legend>
                                                        <div class="form-group col-xs-6 ">
                                                            <label for="editfname" class="control-label">FirstName</label>
                                                            <input type="text" class="form-control" id="editfname" name="editfname" onkeyup='capitalize(this)' required>    
                                                             <input type="hidden" class="form-control" id="editid" name="editid">                         
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="editmname" class="control-label">MiddleName</label>
                                                            <input type="text" class="form-control" id="editmname" name="editmname" onkeyup='capitalize(this)' required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="editlname" class="control-label">LastName</label>
                                                            <input type="text" class="form-control" id="editlname" name="editlname" onkeyup='capitalize(this)' required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="editbdate" class="control-label">Birthdate</label><br/>
                                                            <input type="text" class="form-control pull-right" name="editbdate" id="editbdate" readonly required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="editbplace" class="control-label">Birth Place</label>
                                                            <textarea type="street-address" class="form-control" id="editbplace" name="editbplace" onkeyup='capitalize(this)' required></textarea>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="editaddr" class="control-label"> Address</label>
                                                            <textarea type="street-address" class="form-control" id="editaddr" name="editaddr" onkeyup='capitalize(this)' required></textarea>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="editgender" class="control-label">Gender</label>
                                                            <select class="form-control" name="editgender" id="editgender" required>
                                                                <option value="">--Select--</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="editcivilstat" class="control-label">Civil Status</label>
                                                            <select class="form-control" name="editcivilstat" id="editcivilstat" required>
                                                                <option value="">--Select--</option>
                                                                <option value="Single">Single</option>
                                                                <option value="Married">Married</option>
                                                                <option value="Widowed">Widowed</option>
                                                                <option value="Divorced">Divorced</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="editnationality" class="control-label">Nationality</label>
                                                            <input type="text" class="form-control" id="editnationality" name="editnationality" onkeyup='capitalize(this)' required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="editcontactno" class="control-label">Contact Number</label>
                                                            <input type="text" class="form-control" id="editcontactno" name="editcontactno" maxlength="11" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="editreligion" class="control-label">Religion</label>
                                                            <input type="text" class="form-control" id="editreligion" name="editreligion" onkeyup='capitalize(this)' required>
                                                        </div>
                                                    </fieldset>
                                                    
                                                    <fieldset class="field-border">
                                                        <legend class="field-border">Account Information</legend>
                                                        <div class="form-group col-lg-6 ">
                                                            <label for="user" class="control-label">Username</label>
                                                            <input class="form-control" type="text" name="euser" id="euser" readonly required>
                                                        </div>
                                                        <div class="form-group col-lg-6 ">
                                                            <label for="e" class="control-label">Email</label>
                                                            <input class="form-control" type="email" name="ee" id="ee" readonly required>
                                                        </div>
                                                        <div class="form-group col-lg-6 ">
                                                            <label for="user" class="control-label">Password</label>
                                                            <input class="form-control" type="password" name="ep" id="ep">
                                                        </div>
                                        
                                                        <div class="form-group col-lg-6 ">
                                                            <label for="user" class="control-label">Confirm Password</label>
                                                            <input class="form-control" type="password" name="ecp" id="ecp">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="modal-footer editUser">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Close</button>
                                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Save</button>
                                                </div>                                               
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                        </div>
            </section>
        </div>
        <?php include 'includes/footer.php'; ?>
    </div>
    <?php include 'includes/script.php'; ?>
</body>

</html>
<?php 
} ?> 