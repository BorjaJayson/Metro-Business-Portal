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
      <section class="content-header">
        <h3>Helpdesk Module</h3>
      </section>
      <section class="content">
        <div class="row">
        <div class="col-md-3">
        
        </div>
          <div class="col-md-12 col-centered">
            <div class="box box-primary">
              <div class="box-body">
                <div class="removeMessages"></div>
                  <br/><br/><br/>
                  
                  <h3>List of User Appeals</h3>
                  <br/>
                  
                 
                  </div>
                </div>
              </div>
            </div>
        </section>
      </div>
      <?php include 'includes/footer.php'; ?>
    </div>
  <?php include 'includes/script.php'; ?>
</body>
<?php } ?>