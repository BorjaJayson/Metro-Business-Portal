<?php

	session_start();
	require_once 'includes/connect.php';
	
	if (!isset($_SESSION['Username'])) {
	  header('location:index.php');
	  exit;
	}
	else{

        $isread = 'read';
        $Git = intval($_GET['id']);
        $sql = "UPDATE send_table SET _stat='$isread' WHERE send_id='$Git'";
        $query = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <?php include 'includes/userHeader.php'; ?>	

  <?php
    $isread = 'read';
    $Git = intval($_GET['id']);
    
    $sql = "SELECT information_table.Firstname,user_table.User_ID,user_table.Username,user_table.Email,send_table._sub,send_table._mes,send_table._stat,send_table.send_id,send_table.date_added FROM user_table INNER JOIN send_table ON user_table.User_ID = send_table.User_ID INNER JOIN information_table ON information_table.Information_ID=user_table.Information_ID WHERE send_table._stat = '$isread' AND send_table.send_id='$Git'";
    
    $query = $conn->query($sql);
    $data = mysqli_fetch_array($query);
  ?>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
	
	<?php include 'includes/userNav.php'?>
	<?php include'includes/timeStamp.php';?>

  <br/><br/><br/>
	<div class="container" style="float:center;margin:0px auto;">
    <div class="row">

      <fieldset class="field-border">
        <div class="control-label">
          <div class="removeMessages"></div>     
          <div class="mailbox-read-info">
            <legend class="field-border">MESSAGE</legend>
            <h4><strong><?php echo $data['_sub']; ?></strong></h4>
            <p>
                
              From:<b> <?php echo $data['Username']; ?>&nbsp; | &nbsp; <?php echo $data['Email']; ?></b>
              <span class="mailbox-read-time pull-right"> <?php echo $data['date_added']; ?></span>

            </p>
            <hr/>
          </div>

          <div class="mailbox-read-message">
                
            <p>Hello User,</p>
            <p id="body" name="body">  &nbsp;<?php echo $data['_mes']; ?></p>  
            <p>Sincerely, <strong><?php echo $data['Firstname']; ?></strong></p>
      
          </div> <!-- Message Section -->  
          <div style="float:right;position:relative;"> 
            <button class="btn" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#addrep" id="addRepModalBtn">
              <span class="fa fa-reply"></span>	Reply
            </button><br/>
            <a class="btn" href="inbox1.php" style="position:relative;text-align:right;margin-top:10px;">
              Back to Inbox
            </a>
          </div>
        </div>
      </fieldset>
      <!--MESSAGE MODAL-->
      <div class="modal fade" tabindex="-1" role="dialog" id="addrep">
	      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" style="color:white;"><span class="fa fa-reply"></span>&nbsp;Reply</h3>     
            </div>

            <form action="reply.php" method="POST" id="createRepForm">
              <div class="modal-body">
	      	      
                <div class="messages"></div> 
                <input class="form-control hidden" id="from" value="<?php echo $_SESSION['Username']?>" name="from" placeholder="From:"required >            
                
                <div class="form-group">
                  <label for="to" class="control-label">To</label>
                  <input class="form-control" id="to" name="to" value="<?php echo $data['Email']; ?>" placeholder="To:"required readonly>
                </div>
                
                <div class="form-group">
                  <label for="sub" class="control-label">Subject</label>
                  <input class="form-control" id="sub" name="sub" value="<?php echo $data['_sub']; ?>" placeholder="Subject:" required readonly>
                </div>
                
                <div class="form-group">
                  <textarea type="text" id="ct" name="ct" class="form-control" style="height: 300px" placeholder="Message:" required></textarea>
                </div>
                  
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                	<button type="submit" class="btn btn-default">Send</button>
	            </div>
	          </form> 
	        </div><!-- modal-content -->
	      </div><!-- modal-dialog -->
      </div><!-- modal -->
    </div>
	</div>
	<script>
    $(document).ready(function (){  
      $("#addRepModalBtn").on('click', function() {
        
        $("#createRepForm")[0].reset();
        
        // empty the message div
        $(".messages").html("");
        $("#createRepForm").unbind('submit').bind('submit', function() {
          var form = $(this);
          var to = $("#to").val();
          
          if(to){
            
            $.ajax({
              
              url: form.attr('action'),
              type: form.attr('method'),
              data: form.serialize(),
              dataType: 'json',
                        
              success: function(response) {
                if (response.success == true) {
                  $(".messages").each(function() {
                    alert("Sent!");            
                  })
                  
                  // refresh the table
                  window.location = "inbox1.php";
                  
                  //manageuserTable.ajax.reload(null, false);
                  $("#addrep").modal('hide');              
                  $("#createRepForm")[0].reset();
                
                }else {
                  
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
  </script>
</body>
</html>
<?php } ?>