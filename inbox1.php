<?php

session_start();
require_once 'includes/connect.php';
	
if (!isset($_SESSION['Username'])) {
	
  header('location:index.php');
	exit;
	
}	
  else{

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <title>Metro Business Portal</title>
  <?php include 'includes/userHeader.php'; ?>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">	
	
  <?php include 'includes/userNav.php';?>
	<?php include'includes/timeStamp.php';?>
	<div class="container">
    <div class="row">
    <br/>

        <div class="col-md-12" style="margin-top: -200px;">
            <div class="removeMessages"></div>
              <h1 class="box-title">Inbox</h1>
              <fieldset class="field-border">
              <br/>
                  <table id="inboxTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Username</th>
					             	<th>Subject</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>           
                  </table>

                <div class="modal fade" tabindex="-1" role="dialog" id="d1">
                  	<div class="modal-dialog" role="document">
                  	  <div class="modal-content">

                  	    <div class="modal-header"><h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete Message</h4></div>
                        <div class="modal-body">
                  	      <p style="font-size:20px;">Do you really want to delete message ?</p>
                  	    </div>
                  	    <div class="modal-footer">
                  	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  	      <button type="button" class="btn btn-danger" id="dqwe1">Delete</button>
                  	    </div>
                  	  
                      </div>
                  	</div>
                  </div>
                  </fieldset>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


	</div>
	
	<script type="text/javascript">
     var inboxTable;

$(document).ready(function() {
    
    inboxTable = $("#inboxTable").DataTable({
        "ajax": "retrieve.php",
        "order": []
    });


});
    //delete msg
function deletenanis(send_id = null) {
    if (send_id) {
        // click on remove button
        $("#dqwe1").unbind('click').bind('click', function() {
            $.ajax({
                url: 'deletemsg.php',
                type: 'post',
                data: { send_id: send_id },
                dataType: 'json',
                success: function(response) {
                    if (response.success == true) {
                        $(".removeMessages").each(function() {

                            alert("successfully deleted");
                                            });
                        // refresh the table
                        inboxTable.ajax.reload(null, false);

                        // close the modal
                        $("#d1").modal('hide');

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
</body>
</html>
<?php } ?>