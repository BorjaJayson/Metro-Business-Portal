<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../dist/js/date.js"></script>
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<script type="text/javascript">
    
    $(function() {
     
        $("#compose-textarea").wysihtml5();
        /** add active class and stay opened when selected */
        $('#bdate').datepicker({

            format: 'yyyy-mm-dd',
            autoclose: true
        })

        $('#editbdate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        })

        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

    });

    function capitalize(obj) {
        
        obj.value = obj.value.split(' ').map(eachWord => eachWord.charAt(0).toUpperCase() + eachWord.slice(1)).join(' ');
    }
</script>
<script>

    var manageuserTable;
    var managearchiveTable;
    var manageinfoTable;
    var manageinfoaTable;
    var inboxTable;

    $(document).ready(function() {

        manageuserTable = $("#manageuserTable").DataTable({
            "ajax": "php_action/retrieve.php",
            "order": []
        });

        uploadTable = $("#uploadTable").DataTable({
            "ajax": "php_action/retrieveUpload.php",
            "order": []
        });

        inboxTable = $("#inboxTable").DataTable({
            "ajax": "php_action/inboxdata.php",
            "order": []
        });

        manageinfoTable = $("#manageinfoTable").DataTable({
            "ajax": "php_action/retrieveInfo.php",
            "order": []
        });

        manageinfoaTable = $("#manageinfoaTable").DataTable({
            "ajax": "php_action/retrievearchiveInfo.php",
            "order": []

        });

        managearchiveTable = $("#managearchiveTable").DataTable({
            "ajax": "php_action/retrieveArchive.php",
            "order": []
        });
        
        $(".messages").html("");
        $("#composeForm").unbind('submit').bind('submit', function() {
            
            var form = $(this);
            var to = $("#to").val();
            var sub = $("#sub").val();

            if (to && sub) {

                $.ajax({

                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',

                    success: function(response) {

                        if (response.success == true) {
                            $(".messages").each(function() {

                                alert("successfully added");

                            });

                            // refresh the table
                            $("#composeForm")[0].reset();

                        } else {

                            $(".messages").each(function() {
                                alert("Username or Email not exist!");
                            });
                        }
                    }
                });
            }
            return false;
        });

        $("#addUserModalBtn").on('click', function() {
            $("#addUserForm")[0].reset();

            // empty the message div
            $(".messages").html("");

            $("#addUserForm").unbind('submit').bind('submit', function() {
                var form = $(this);

                var user = $("#user").val();
                var p = $("#p").val();

                if($("#p").val() != $("#cp").val())    {

                    alert("Password and Confirm Password are not The Same.");
                    return false;

                }else{


                    if (user && p) {
                        $.ajax({

                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',

                            success: function(response) {

                                if (response.success == true) {
                                    $(".messagess").each(function() {

                                        alert("successfully added");
                                    });
                                    // refresh the table
                                    manageuserTable.ajax.reload(null, false);
                                    $("#addUserForm")[0].reset();
                                } else {

                                    $(".messagess").each(function() {
                                        alert("Duplicate Data! Information ID, Username and Email must have unique Value.");
                                    });
                                }
                            }
                        });
                    }
                }
                return false;
            });
        });

        $("#addInfoModalBtn").on('click', function() {
            $("#createInfoForm")[0].reset();

            // empty the message div
            $(".messages").html("");

            $("#createInfoForm").unbind('submit').bind('submit', function() {
                var form = $(this);

                var fname = $("#fname").val();
                var lname = $("#lname").val();
                var mid_name = $("#mid_name").val();
                var bdate = $("#bdate").val();
                var bplace = $("#bplace").val();
                var addr = $("#addr").val();
                var gender = $("#gender").val();
                var nationality = $("#nationality").val();
                var contactno = $("#contactno").val();
                var religion = $("#religion").val();
                var civilstat = $("#civilstat").val();

                if (fname && lname && mid_name && bdate && bplace && gender && addr && nationality &&
                    contactno && religion && civilstat) {
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success == true) {
                                $(".messages").each(function() {

                                    alert("successfully Added");

                                });

                                // refresh the table
                                manageinfoTable.ajax.reload(null, false);

                                $("#createInfoForm")[0].reset();

                            } else {
                                $(".messages").each(function() {
                                    alert("Error while added the data");
                                });
                            }
                        }
                    });
                }
                return false;
            });
        });

        $("#addRepModalBtn").on('click', function() {
            $("#createRepForm")[0].reset();

            // empty the message div
            $(".messages").html("");

            $("#createRepForm").unbind('submit').bind('submit', function() {
                var form = $(this);

                var to = $("#to").val();



                if (to) {

                    $.ajax({

                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',

                        success: function(response) {

                            if (response.success == true) {
                                $(".messages").each(function() {

                                    alert("Sent!");

                                });

                                // refresh the table
                                window.location = "inbox.php";
                                //manageuserTable.ajax.reload(null, false);
                                $("#addrep").modal('hide');

                                $("#createRepForm")[0].reset();
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
        });
    });

    //to archive data
    function archiveData(User_ID = null) {
        if (User_ID) {
            // click on remove button
            $("#removeBtn1").unbind('click').bind('click', function() {
                $.ajax({
                    url: 'php_action/archiveuser.php',
                    type: 'post',
                    data: {
                        User_ID: User_ID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            $(".removeMessages").each(function() {

                                alert("successfully removed");
                            });

                            // refresh the table
                            manageuserTable.ajax.reload(null, false);

                            // close the modal
                            $("#removeuserModal").modal('hide');

                        } else {
                            $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                '</div>');
                        }
                    }
                });
            }); // click remove btn
        } else {
            alert('Error: Refresh the page again');
        }
    }
    //to edit user data
    function editfunction(User_ID = null) {
        if (User_ID) {
            $("#editUserForm")[0].reset();
            // remove the error 
            $(".form-group").removeClass('has-error').removeClass('has-success');
            $(".text-danger").remove();
            // empty the message div
            $(".edit-messages").html("");

            // remove the id
            $("#User_ID").remove();

            // fetch the member data
            $.ajax({
                url: 'php_action/getUser.php',
                type: 'post',
                data: {
                    User_ID: User_ID
                },
                dataType: 'json',
                success: function(response) {
                    $("#editid").val(response.Information_ID);
                    $("#editfname").val(response.Firstname);
                    $("#editmname").val(response.Middlename);
                    $("#editlname").val(response.Lastname);
                    $("#editbdate").val(response.Birthdate);
                    $("#editaddr").val(response.Address);
                    $("#editbplace").val(response.birthplace);
                    $("#editgender").val(response.Gender);
                    $("#editcivilstat").val(response.civil_status);
                    $("#editnationality").val(response.nationality);
                    $("#editcontactno").val(response.Contact_no);
                    $("#editreligion").val(response.religion);   
                    $("#euser").val(response.Username);
                    $("#ee").val(response.Email);
                   

                    // mmeber id 
                    $(".editUser").append('<input type="hidden" name="User_ID" id="User_ID" value="' + response.User_ID + '"/>');

                    // here update the member data
                    $("#editUserForm").unbind('submit').bind('submit', function() {
                       
                        // remove error messages
                        $(".text-danger").remove();

                        var form = $(this);

                        // validation
                    
                        var ecn = $("#euser").val();
                        var ep = $("#ep").val();
                        var ecp = $("#ecp").val

                        if($("#ep").val() != $("#ecp").val()) {

                            alert("Password and Confirm Password are not The Same.");
                            return false;

                        }else{
                    
                            if (ecn) {
                                $.ajax({
                                    url: form.attr('action'),
                                    type: form.attr('method'),
                                    data: form.serialize(),
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.success == true) {
                                            $(".edit-messages").each(function() {

                                                alert("successfully updated");
                                            });

                                            // reload the datatables
                                            manageuserTable.ajax.reload(null, false);
                                            // this function is built in function of datatables;
                                            location.reload();
                                            // remove the error 
                                            $(".form-group").removeClass('has-success').removeClass('has-error');
                                            $(".text-danger").remove();
                                        } else {
                                            $(".edit-messages").each(function() {

                                                alert("Error while Editing the member information");
                                            });
                                        }
                                    }   // success
                                }); // ajax
                            }
                        }   // if(ecn)
                        return false;
                    });

                } // /success
            }); // /fetch selected member info

        } else {
            alert("Error : Refresh the page again");
        }
    }
    //to edit information
    function editInfo(Information_ID = null) {
        if (Information_ID) {

            // remove the error 
            $(".form-group").removeClass('has-error').removeClass('has-success');
            $(".text-danger").remove();
            // empty the message div
            $(".edit-messages").html("");

            // remove the id
            $("#Information_ID").remove();

            // fetch the member data
            $.ajax({
                url: 'php_action/getInfo.php',
                type: 'post',
                data: {
                    Information_ID: Information_ID
                },
                dataType: 'json',
                success: function(response) {
                    $("#editfname").val(response.Firstname);
                    $("#editlname").val(response.Lastname);
                    $("#editmname").val(response.Middlename);
                    $("#editbdate").val(response.Birthdate);
                    $("#editbplace").val(response.birthplace);
                    $("#editaddr").val(response.Address);
                    $("#editgender").val(response.Gender);
                    $("#editnationality").val(response.nationality);
                    $("#editcontactno").val(response.Contact_no);
                    $("#editreligion").val(response.religion);
                    $("#editcivilstat").val(response.civil_status);

                    // mmeber id 
                    $(".editInfoModal").append('<input type="hidden" name="Information_ID" id="Information_ID" value="' + response.Information_ID + '"/>');

                    // here update the member data
                    $("#updateInfoForm").unbind('submit').bind('submit', function() {
                        // remove error messages
                        $(".text-danger").remove();

                        var form = $(this);

                        // validation
                        var editfname = $("#editfname").val();
                        var editlname = $("#editlname").val();
                        if (editfname && editlname) {
                            $.ajax({
                                url: form.attr('action'),
                                type: form.attr('method'),
                                data: form.serialize(),
                                dataType: 'json',
                                success: function(response) {
                                    if (response.success == true) {
                                        $(".edit-messages").each(function() {

                                            alert("successfully updated");
                                        });

                                        // reload the datatables
                                        manageinfoTable.ajax.reload(null, false);
                                        // this function is built in function of datatables;
                                        location.reload();
                                        // remove the error 
                                        $(".form-group").removeClass('has-success').removeClass('has-error');
                                        $(".text-danger").remove();
                                    } else {
                                        $(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                            '</div>')
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
    //to restore data from archive
    function restoreData(User_ID = null) {
        if (User_ID) {
            // click on remove button
            $("#restoreBtn").unbind('click').bind('click', function() {
                $.ajax({
                    url: 'php_action/restoreuser.php',
                    type: 'post',
                    data: {
                        User_ID: User_ID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            $(".removeMessages").each(function() {

                                alert("successfully Restored");
                            });

                            // refresh the table
                            managearchiveTable.ajax.reload(null, false);

                            // close the modal
                            $("#restoreModal").modal('hide');

                        } else {
                            $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                '</div>');
                        }
                    }
                });
            }); // click remove btn
        } else {
            alert('Error: Refresh the page again');
        }
    }
    //to archive info data
    function delinfo(Information_ID = null) {
        if (Information_ID) {
            // click on remove button
            $("#removeBtn").unbind('click').bind('click', function() {
                $.ajax({
                    url: 'php_action/archiveinfo.php',
                    type: 'post',
                    data: {
                        Information_ID: Information_ID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            $(".removeMessages").each(function() {

                                alert("successfully updated");
                            });
                            // refresh the table
                            manageinfoTable.ajax.reload(null, false);

                            // close the modal
                            $("#removeinfo").modal('hide');

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
    //to restore data from INFORMATION archive
    function IrestoreData(Information_ID = null) {
        if (Information_ID) {
            // click on remove button
            $("#IrestoreBtn").unbind('click').bind('click', function() {
                $.ajax({
                    url: 'php_action/restoreinfo.php',
                    type: 'post',
                    data: {
                        Information_ID: Information_ID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            $(".removeMessages").each(function() {

                                alert("successfully Restored");
                            });

                            // refresh the table
                            manageinfoaTable.ajax.reload(null, false);

                            // close the modal
                            $("#IrestoreModal").modal('hide');

                        } else {
                            $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                '</div>');
                        }
                    }
                });
            }); // click remove btn
        } else {
            alert('Error: Refresh the page again');
        }
    }
    //delete msg
    function deletenani(hd_ID = null) {
        if (hd_ID) {
            // click on remove button
            $("#dqwe").unbind('click').bind('click', function() {
                $.ajax({
                    url: 'php_action/deletemsg.php',
                    type: 'post',
                    data: {
                        hd_ID: hd_ID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            $(".removeMessages").each(function() {

                                alert("successfully deleted");
                            });
                            // refresh the table
                            inboxTable.ajax.reload(null, false);

                            // close the modal
                            $("#d").modal('hide');

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
</script>

<script>
    var password = document.getElementById("p"),
        confirm_password = document.getElementById("cp");

    function validatePassword() {
        
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

<script>
    var password = document.getElementById("ep"),
        confirm_password = document.getElementById("ecp");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script> 