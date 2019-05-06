<?php

  session_start();
  require_once 'includes/connect.php';
  
  if (!isset($_SESSION['Username'])) {
    header('location:../index.php');
    exit;
  }
  else{
?>
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
                 <fieldset class="field-border"><br/>
                  <legend class="field-border">User Archive List</legend>
                    <table id="managearchiveTable" class="table table-bordered table-striped">
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
                    </fieldset>
<br/><br/><br/><br/><br/>
                      <fieldset class="field-border"><br/>
                  <legend class="field-border">File Archive List</legend>
                    <table id="tables" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                         <th>File ID</th>
                                <th>File Name</th>
                                <th>File Date</th>
                                <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                    </fieldset>
                  <!-- ARCHIVE USER MODAL-->                                    
                  <div class="modal fade" tabindex="-1" role="dialog" id="restoreModal">
                  	<div class="modal-dialog" role="document">
                  	  <div class="modal-content">

                  	    <div class="modal-header"><h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Remove User</h4></div>
                        <div class="modal-body">
                  	      <p style="font-size:20px;">Do you really want to restore data ?</p>
                  	    </div>
                  	    <div class="modal-footer">
                  	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  	      <button type="button" class="btn btn-primary" id="restoreBtn">Restore</button>
                  	    </div>
                  	  
                      </div>
                  	</div>
                  </div>

                  <!--ARCHIVE INFORMATION MODAL-->                                    
                  <div class="modal fade" tabindex="-1" role="dialog" id="IrestoreModal">
                    <div class="modal-dialog" role="document">
                    	<div class="modal-content">  
                        
                        <div class="modal-header">
                    	    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Remove File</h4>
                    	  </div>
                        <div class="modal-body">
                    	    <p style="font-size:20px;">Do you really want to restore data ?</p>
                        </div> 
                        <div class="modal-footer">
                    	    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    	    <button type="button" class="btn btn-primary" id="IrestoreBtn">Restore</button>
                    	  </div>  
                      </div>
                    </div>
                  </div>    
              </div>
            </div>
          </div>
        </div>
      </section>    
    </div>
    <?php include 'includes/footer.php'; ?>
  </div>
  <?php include 'includes/script.php'; ?>

  <script type="text/javascript">
      var tables;

    $(document).ready(function() {

        tables = $("#tables").DataTable({
            "ajax": "php_action/filearchive.php",
            "order": []
        });
})

      function restoreData(file_ID = null) {
        if (file_ID) {
            // click on remove button
            $("#IrestoreBtn").unbind('click').bind('click', function() {
                $.ajax({
                    url: 'php_action/restorefile.php',
                    type: 'post',
                    data: {
                        file_ID: file_ID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            $(".removeMessages").each(function() {

                                alert("successfully Restored");
                            });

                            // refresh the table
                            tables.ajax.reload(null, false);

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
  </script>
</body>
<?php } ?>