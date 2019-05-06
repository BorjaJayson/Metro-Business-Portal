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

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h3>Read Business</h3>
            </section>

            <section class="content">
            	<div class="info-box">
			        <div class="info-box">
			          
			            <?php 
		                    
		                    $id= intval($_GET['ids']);
		                    $bprog = "SELECT * FROM business_table WHERE Business_ID = $id";
		                    $bpquery=$conn->query($bprog);
		                    $bpdata = mysqli_fetch_array($bpquery);
		                    $a=$bpdata['Business_Name'];

		                ?>
		                <span class="info-box-icon bg-grey" style="margin-left:5px;">
		                	<img src="../img/DTIIcon.png" alt="DTI" style="margin-bottom:0px;"/>
		                	<a href="info.php"><button class="btn btn-primary">Back</button></a>
		                </span>

		                <div class="info-box-content" style="margin-left:100px;">
		                	<h3>Business Information</h3>
		                	<p class="hidden"><b>User's ID:</b><em><?php echo $bpdata['User_ID']; ?></em></p>

		                	<p><b>Business Name:</b><em> <?php echo $bpdata['Business_Name']; ?></em></p>
		                	<p><b>Business Type:</b><em> <?php echo $bpdata['Business_Type']; ?></em></p>
		                	<p><b>Business Category:</b><em> <?php echo $bpdata['Business_Sub']; ?></em></p>
		                	<p><b>Business Size:</b><em> <?php echo $bpdata['Business_Size']; ?></em></p>
		                	
		                	<hr/>
		                	
		                	<h3>Territorial Scope</h3>
		                	<p><b>Location | Address:</b><em> <?php echo $bpdata['Business_Loc']; ?></em></p>
		                	<p><b>Baranggay:</b><em> <?php echo $bpdata['Business_Brgy']; ?></em></p>
		                	<p><b>Municipal:</b><em> <?php echo $bpdata['Business_Mncipal']; ?></em></p>
		                	<p><b>Region:</b><em> <?php echo $bpdata['Business_Region']; ?></em></p>
		                	
		                	<hr/>
		                	
		                	<p><b>Date Added:</b></p>
		                	<?php echo $bpdata['Date_Add']; ?>

		                	<hr/>

		                	<p><b>Files Uploaded Under this Business Name</b></p>

		                		 <div style="margin-top:10px;">
		                		 	  <div class="removeMessages"></div>
		                		 	  <fieldset class="field-border"><br/><br/><br/>	
		                		 		<table class="table table-striped" id="table">
		                		 			<thead>
		                		 			<tr>
		                		 				<th>File ID</th>
		                		 				<th>File Name</th>
		                		 				<th>File Date</th>
		                		 				<th>Action</th>
		                		 			</tr>
		                		 			</thead>
		                		 			<tbody>
		                		 				
		                		 				<?php 
		                		 					require_once 'includes/pdoConnect.php';
			                		 				$ee=intval($_GET['ids']);
			                		 				$sql= $db->prepare("SELECT * FROM upload_table WHERE Business_ID='$ee' AND _stats='active'");
			                		 				$sql->execute();
		                		 					while($res = $sql->fetch()){
		                		 				?>
		                		 				
		                		 				<tr>
		                		 					<td><?php echo $res['file_ID']?></td>
		                		 					<td><?php echo $res['file_name']?></td>
		                		 					<td><?php echo $res['file_date']?></td>
		                		 					<td><a href="download.php?id=<?php echo $res['file_ID']?>" class="btn btn-primary">Download</a>&nbsp;
		                		 				<?php echo '<a type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeuserModal"  data-backdrop="static" data-keyboard="false"  onclick="archiveData(' . $res['file_ID'] . ')"> Archive</a>';?>	</td>

		                		 				</tr>
		                		 				<?php }?>
		                		 			</tbody>
		                		 		</table>
		                		 		</fieldset>
		                		 	</div>
                                  </div>		                		
		                	<br/>
		                	<br/>
		                	    <!--REMOVE USER MODAL-->
                                <div class="modal fade" tabindex="-1" role="dialog" id="removeuserModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Remove User</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Do you really want to remove ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="removeBtn1">Delete</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
		                </div>
			    	</div>
			    </div>
            </section>
        </div>
        <?php include 'includes/footer.php'; ?>
    </div>
    <?php include 'includes/script.php'; ?>
    <script type="text/javascript">

    	var table;

    	    $(document).ready(function() {
    	    	  table = $("#table").DataTable({
            "order": []
        });

    	    })
    	//to archive data
    function archiveData(file_ID = null) {
        if (file_ID) {
            // click on remove button
            $("#removeBtn1").unbind('click').bind('click', function() {
                $.ajax({
                    url: 'php_action/archiveFile.php',
                    type: 'post',
                    data: {
                        file_ID: file_ID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            $(".removeMessages").each(function() {

                                alert("successfully removed");
                            });

                            // refresh the table
                             location.reload();

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

    </script>
</body>

</html>
<?php 
} ?> 