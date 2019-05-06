<?php

session_start();
require_once 'includes/connect.php';

if (!isset($_SESSION['Username'])) {
    header('location:../index.php');
    exit;
} else {
    
    $isread = 1;
    $Git = intval($_GET['id']);
    $sql = "UPDATE hd_table SET _read='$isread',_status='read' WHERE hd_ID='$Git'";
    $query = mysqli_query($conn, $sql);

    ?>

<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
 		<?php include 'includes/navbar.php'; ?>
    	<?php include 'includes/menubar.php'; ?>

    	<div class="content-wrapper">
        <section class="content-header">
      <h1>
        Helpdesk
      </h1>
      
    </section>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="compose.php" class="btn btn-primary btn-block margin-bottom">Compose</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folder</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="inbox.php"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right"><?php echo $unreadcount; ?></span></a></li>
    
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
         
     
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
            <div class="RemoveMessage"></div>
              <h3 class="box-title">Read Mail</h3>
            </div>
            <!-- /.box-header -->
            <?php
            $isread = 1;
            $Git = intval($_GET['id']);
            $sql = "SELECT information_table.Firstname,user_table.User_ID,user_table.Username,user_table.Email,hd_table._subject,hd_table._message,hd_table._status,hd_table.hd_ID,hd_table.date_added FROM user_table INNER JOIN hd_table ON user_table.User_ID = hd_table.User_ID INNER JOIN information_table ON information_table.Information_ID=user_table.Information_ID WHERE hd_table._read = '$isread' AND hd_table.hd_ID='$Git'";
            $query = $conn->query($sql);
            $data = mysqli_fetch_array($query);
            ?>
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><strong><?php echo $data['_subject']; ?></strong></h3>
                <h5>From: <?php echo $data['Username']; ?>&nbsp;/&nbsp;<?php echo $data['Email']; ?>
                  <span class="mailbox-read-time pull-right"><?php echo $data['date_added']; ?></span></h5>
              </div>
              <!-- /.mailbox-read-info -->
             
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>Hello admin,</p>

                <p id="body" name="body"><?php echo $data['_message']; ?></p>

                
                <p>Thanks,<br><?php echo $data['Firstname']; ?></p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
           
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                <button class="btn btn-default" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#addrep" id="addRepModalBtn">
					          <span class="fa fa-reply"></span>	Reply
				          </button>
              </div>
             
           
            </div>
            <!-- /.box-footer -->
            <div class="modal fade" tabindex="-1" role="dialog" id="addrep">
	                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title"><span class="fa fa-reply"></span>&nbsp;Reply</h3>
                        </div>
                        
                        <form action="php_action/reply.php" method="POST" id="createRepForm">
                          <div class="modal-body">
	      	                  <div class="messages"></div> 
                                
                                <input class="form-control hidden" id="from" value="<?php echo $_SESSION['Username']?>" name="from" placeholder="From:"required >
                            
                            <div class="form-group">
                                <label for="to" class="control-label">To</label>
                                <input class="form-control" id="to" name="to" value="<?php echo $data['Username']; ?>" placeholder="To:"required readonly>
                            </div>
                            <div class="form-group">
                            <label for="sub" class="control-label">Subject</label>
                                <input class="form-control" id="sub" name="sub" value="<?php echo $data['_subject']; ?>" placeholder="Subject:" required readonly>
                            </div>
                            <div class="form-group">
                                    <textarea type="text" id="ct" name="ct" class="form-control" style="height: 300px" placeholder="Message:" required></textarea>
                            </div>
                            
                          </div>
                          <div class="modal-footer">
                	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                	          <button type="submit" class="btn btn-primary">Send</button>
	                        </div>
	                    </form> 
	                  </div><!-- /.modal-content -->
	                </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



    </section>
    <!-- /.content -->
        </div>
    	<?php include 'includes/footer.php'; ?>
	</div>
 	<?php include 'includes/script.php'; ?>
</body>
</html>

<?php 
} ?>