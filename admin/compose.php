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
        <h1>Helpdesk</h1>
      </section>
      
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-3">
            <a href="inbox.php" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Folder</h3>
                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div> 
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li>
                    <a href="inbox.php"><i class="fa fa-inbox"></i> Inbox
                    <span class="label label-primary pull-right"><?php echo $unreadcount; ?></span></a>
                  </li>
                  </ul>
                </div> <!-- /.box-body -->
              </div> <!-- /. box -->
            </div> <!-- /.col -->
            
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Compose New Message</h3>
                </div> <!-- /.box-header -->
                
                <div class="messages"></div>
                
                <form action="php_action/sendcompose.php" method="POST" id="composeForm">
                  <div class="box-body">
                    <div class="form-group">
                      <input class="form-control hidden" id="from" value="<?php echo $_SESSION['Username']?>" name="from" placeholder="From:"required >
                    </div>
                    <div class="form-group">
                      <input class="form-control" id="to" name="to" placeholder="Username:"required>
                    </div>
                    <div class="form-group">
                      <input class="form-control" id="sub" name="sub" placeholder="Subject:" required>
                    </div>
                    <div class="form-group">
                      <textarea type="text" id="ct" name="ct" class="form-control" style="height: 300px" placeholder="Message:" required></textarea>
                    </div>
                  </div> <!-- /.box-body -->
                  
                  <div class="box-footer">
                    <div class="pull-right">
                      <button type="submit" name="send" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                    </div>
                  </div>
                </form>
              </div> <!-- /. box -->
            </div> <!-- /.col -->
          </div> <!-- /.row -->
        </section> <!-- /.content -->
    </div>
      <?php include 'includes/footer.php'; ?>
  </div>
 	  <?php include 'includes/script.php'; ?>
</body>

<?php 
} ?>