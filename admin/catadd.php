<?php

	session_start();
	require_once 'includes/connect.php';
	
	if (!isset($_SESSION['Username'])) {
	  	header('location:../index.php');
	  	exit;
	}
	else{
?>
<head>
	<?php include 'includes/header.php';?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

 		<?php include 'includes/navbar.php'; ?>
    	<?php include 'includes/menubar.php'; ?>

    	<div class="content-wrapper">
    		<div class="messages"></div>
    		<br/><br/>
	    	<div class="col-xs-12">
	    		<fieldset class="field-border">
	    			<form id="addcatForm" action="php_action/addcat.php" method="POST">
	    				<br/><br/>
	    				<div class="form-group cols-xs-9">
			    			<b>Parent Business Nature</b>
                			
                			<select class="form-control" name="maincatt" id="maincatt">
                  				<option value=""> -- SELECT -- </option>
                  					<?php
				                   		
				                   		$sql="SELECT * FROM maincat_table";
				                      	$query = mysqli_query($conn, $sql);
				                     	$results = mysqli_fetch_all($query,MYSQLI_ASSOC);
				                    
				                      
				                      	if(mysqli_num_rows($query)> 0 ){
				                     		foreach($results as $result){           
                  		
                  					?>
                  								<option value="<?php echo $result['maincat_ID']?>"><?php echo $result['maincat_code']," - ",$result['maincat_name']?></option>
                 					<?php 	}} ?>
                     		</select>
		    			
		    			</div>
		    			<div class="form-group cols-xs-6">
		    				Sub-Category Name <br/>
		    				<input type="text" id="scname" name="scname" required /> 
		    			</div>
		    			<div class="form-group cols-xs-6">
		    				Sub-Category Code <br/>
		    				<input type="text" id="sccode" name="sccode" required /> 
		    			</div>
		    			<div class="cols-md-12">
		    				<input type="submit" class="btn btn-primary"/>
	    				</div>
	    			</form>
	    		</fieldset>
			</div>
		</div>
		<?php include 'includes/footer.php'; ?>
 		<?php include 'includes/script.php'; ?>

 	</div>

 <script> //Trappings
 	
 	    $("#scname").keypress(function(event){
	        var inputValue = event.charCode;
	 	    if(!(inputValue == 32) && !(inputValue >= 65 && inputValue <= 122) || (inputValue >= 91 && inputValue <= 96)){
	        	event.preventDefault();
	        } //Accepts only Space and Letters
		});

      	$("#sccode").keypress(function(event){
	        var inputValue = event.charCode;
	        if(!(inputValue != 32 && inputValue == 96) && !(inputValue >= 65 && inputValue <= 122) && !(inputValue >= 48 && inputValue <= 57) || (inputValue >= 91 && inputValue <= 94)){
	            event.preventDefault();
	        } //Accepts only Letters and Numbers, No Space and Special Characters except underscore
	    });

 </script>
	<script>

	$(document).ready(function() {
        $("#addcatForm").unbind('submit').bind('submit', function() {

            var form = $(this);

            var	scname = $("#scname").val();
            var sccode = $("#sccode").val();

            if (scname && sccode) {

                $.ajax({

                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',

                    success: function(response) {

                        if (response.success == true) {
                            $(".messages").each(function() {

                                $(".messages").each(function() {
                                	alert("Successfully Added");
                            });

                            });
                            
                            $("#addcatForm")[0].reset();
                        } else {

                            	$(".messages").each(function() {
                                	alert("Failed. Try Again");
                            });
                        }
                    }
                });
            }
            return false;
        });
    });
</script>
</body>
</html>

<?php }?>