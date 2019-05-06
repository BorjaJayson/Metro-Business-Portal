<?php

session_start();
require_once 'includes/connect.php';

if (!isset($_SESSION['Username'])) {
    header('location:../index.php');
    exit;
} else {
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
                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox
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
            <div class="removeMessages"></div>
              <h1 class="box-title">Inbox</h1>
              <br/><br/><br/>
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
                <!-- /.pull-right -->

                <div class="modal fade" tabindex="-1" role="dialog" id="d">
                  	<div class="modal-dialog" role="document">
                  	  <div class="modal-content">

                  	    <div class="modal-header"><h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete Message</h4></div>
                        <div class="modal-body">
                  	      <p style="font-size:20px;">Do you really want to delete message ?</p>
                  	    </div>
                  	    <div class="modal-footer">
                  	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  	      <button type="button" class="btn btn-danger" id="dqwe">Delete</button>
                  	    </div>
                  	  
                      </div>
                  	</div>
                  </div>
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
        </div>
	</div>
 	<?php include 'includes/script.php'; ?>
</body>
</html>

<?php 
} ?>