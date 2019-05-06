<?php

	session_start();
	require_once 'includes/connect.php';
	
	if (!isset($_SESSION['Username'])) {
	  	header('location:../index.php');
	  	exit;
	}
	else{
?>

<?php include 'includes/header.php';?>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

 		<?php include 'includes/navbar.php'; ?>
    	<?php include 'includes/menubar.php'; ?>

    	<div class="content-wrapper">
    		<br/><br/>
    		
    		<?php
       
		        $isread = 0;
		        $managerID = $_SESSION['User_ID'];
		        $sql = "SELECT hd_ID FROM hd_table WHERE _read='$isread' AND user_ID!='$managerID'";
		        $query = $conn->query($sql);
		        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
		        $unreadcount = $query->num_rows;
         
          	 	$sql1 = "SELECT * FROM user_table WHERE User_level = 'sole'";
   				if ($result1 = mysqli_query($conn,$sql1))	{
   			   		$rowcount1 = mysqli_num_rows($result1);
   			   		mysqli_free_result($result1);
   			   	}
   			   	$sql2 = "SELECT * FROM business_table";
   				if ($result2 = mysqli_query($conn,$sql2)){
   			   		
   			   		$rowcount2 = mysqli_num_rows($result2);          		
   			   		mysqli_free_result($result2);

          		}
          	?>
          	<div class="row" style="padding-left:10px;">
		    	<div class="col-lg-3 col-xs-6">
		          	<div class="small-box bg-green">
		            	<div class="inner">
		              		<h3><?php echo $rowcount1;?></h3>
		              		<p>User Count</p>
		            	</div>
		            	<div class="icon">
		              		<i class="ion ion-person-add"></i>
		            	</div>
		          </div>
		        </div>
		        <div class="col-lg-3 col-xs-6">
		          	<div class="small-box bg-orange">
		            	<div class="inner">
		              		<h3><?php echo $rowcount2;?></h3>
		              		<p>Business Name Count</p>
		            	</div>
		            	<div class="icon">
		              		<i class="ion ion-card"></i>
		            	</div>
		          </div>
		    </div>
	        </div>
	    	<div class="row" style="padding-left:10px;">
		    	<div class="col-md-3 col-sm-6 col-xs-12">
		          	<div class="info-box">
		            	<span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>
		            	<div class="info-box-content">
		              		<span class="info-box-text">Unread Messages</span>
		              		<span class="info-box-number"><?php echo $unreadcount; ?></span>
		            	</div>
		          	</div>
		        </div>
    		</div>
		</div>
		<?php include 'includes/footer.php'; ?>
 		<?php include 'includes/script.php'; ?>
 		
 	</div>
</body>
</html>

<?php }?>