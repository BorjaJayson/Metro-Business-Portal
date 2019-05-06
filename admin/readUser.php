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

<?php 
		                    
	$id= intval($_GET['ids']);
		$sql_i = "

			SELECT 
			user_table.User_ID,
		information_table.Firstname,
		information_table.Information_ID,
		information_table.Middlename,
		information_table.Birthdate,
		information_table.Contact_no,
		information_table.Address,
		information_table.Gender,
		information_table.birthplace,
		information_table.nationality,
		information_table.religion,
		information_table.civil_status,
		information_table.Lastname,
		user_table.Username,
		user_table.Email 
		FROM information_table INNER JOIN user_table 
		ON information_table.Information_ID = user_table.Information_ID 
		WHERE user_table.Status = 'active' AND user_table.User_Level = 'sole' AND user_table.User_ID = '$id'

	";

	$query_i =$conn->query($sql_i);
	$arr_i = mysqli_fetch_array($query_i);	
?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h3>User Information</h3>
            </section>

            <section class="content">
            	<div class="info-box">
			        <div class="info-box">
			      
		                <div class="info-box-content" style="margin-left:10px;">

		                	<h3>User's Personal Information</h3><br/>
		             		<div class="col-md-12">
			                	<p><b>Name:</b><em> <?php echo $arr_i['Lastname']; ?>,
			                	<?php echo $arr_i['Firstname']; ?> 
			                	<?php echo $arr_i['Middlename']; ?></em></p>
		                	</div>
		                	<div class="col-md-3">
		                		<p><b>Gender:</b><em> <?php echo $arr_i['Gender']; ?></em></p>		       
		                		<p><b>Civil Status:</b><em> <?php echo $arr_i['nationality']; ?></em></p> 		               
		                		<p><b>Birth date:</b><em> <?php echo $arr_i['Birthdate']; ?></em></p>
		                	</div>
		                	<div class="col-md-9">
		                		<p><b>Nationality:</b><em> <?php echo $arr_i['nationality']; ?></em></p>
		                		<p><b>Religion:</b><em> <?php echo $arr_i['nationality']; ?></em></p>
		                		<p>
		             			<b>Contact:</b>
			             			<em> 
			             				<?php echo $arr_i['Contact_no']; ?> | 
			             				<?php echo $arr_i['Email'];?>
			             			</em>
		             			</p>
		                	</div>
		                	<div class="col-md-12">
		                		<p><b>Address:</b><em> <?php echo $arr_i['Address']; ?></em></p>
		                	</div>
		                	<div class="col-md-12">
		   						<hr/>
		              		</div>	

		            	   	<h3>User's Account Information</h3><br/>
		            	   	<div class="col-md-12">
		                		<p><b>User's ID:</b><em> <?php echo $arr_i['User_ID']; ?></em></p>
		                		<p><b>Account Username:</b><em> <?php echo $arr_i['Username']; ?></em></p>		          
		   					</div>

		   					<br/><br/><br/><br/><br/>
		                </div>
			    	</div>
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