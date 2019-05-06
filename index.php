<?php
	
	session_start();
	include 'includes/connect.php';

	if (isset($_SESSION['Username'])) {

		header('location:PortalHome1.php');
	}
	//Login Script.
	if(isset($_POST['login_user']))	{

		$ULemail = $_POST['ULusername']; // username sent from form 'login' below.
		$ULpassword = $_POST['ULpassword']; // password sent from form  'login' below.
		$ULpassword1 = $_POST['ULpassword'];
		$ULemail = stripslashes($ULemail);
		$ULpassword = stripslashes($ULpassword);
	
		$email = mysqli_real_escape_string($conn,$ULemail);
		$ULpassword = mysqli_real_escape_string($conn,$ULpassword);
		$ULpassword = md5($ULpassword);

		$cek_data = mysqli_query($conn, "SELECT * FROM user_table WHERE
		Username = '$ULemail' AND Password = '$ULpassword'");

		$data = mysqli_fetch_array($cek_data);
		$level = $data['User_level'];
		$Status = $data['Status'];
		$Username = $data['Username'];
		$emp_id = $data['User_ID'];
		$ULemail = $data['Email'];

		
		if(mysqli_num_rows($cek_data) > 0)	{
		
			$_SESSION['Username'] = $Username;
			$_SESSION['User_ID'] = $emp_id;
			$_SESSION['Email'] = $ULemail;
			$_SESSION['Status'] = $Status;

			if($level == 'admin' && $Status == 'active'){

				header('Location: Admin/AdminHome.php'); 
				exit;
			}
			else if($level == 'sole' && $Status == 'active'){

				header("Location: PortalHome1.php");
				exit;	
			
			}else{

					echo '<script type="text/javascript">
					alert("Account Disabled! Contact your Administrator.");
				</script>';
				session_destroy();

			}
		}else{
	
			echo '<script type="text/javascript">
					alert("Failed to Login!");
				</script>';
				session_destroy();
		}
	}
?>

<!doctype html>
<html lang="en">
<head>
	
	<?php include"includes/userHeader.php";?>
	<style>

		html, body, #map-canvas {
	        height: 400px;
	        margin-bottom:0;
	        margin-top:0;
	        padding: 0px;
      }

      	#map-canvas {
	       
	        margin-left:100px;
	        margin-right:100px;
	        margin-bottom:20px;
      }

	</style>

</head>
<body id="myage" data-spy="scroll" data-target=".navbar" data-offset="50" >
	
	<!-- Side Navigation Bar -->
		<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="PortalHome1.php">MBP</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">	
					<li><a href="#ULModal" data-toggle="modal" data-target="#ULModal" class="btn-primary">LOGIN</a></li>
					<li><a href="#USModal" data-toggle="modal" data-target="#USModal" class="btn-primary">SIGNUP</a></li> 
					&nbsp;
				</ul>
			</div>
		</div>
	</nav>
	
	<!-- 'Home' Section -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
    
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1" class="item"></li>
			<!-- <li data-target="#myCarousel" data-slide-to="2" class="item"></li> -->
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="img/CityWallpaper.png" alt="WPPR" width="600" height="400"/>
				<div class="carousel-caption">
					<br/><br/><br/><br/><br/>
					<h3>Welcome to Metro Business Portal</h3>
				</div>      
			</div>
			<div class="item">
				<img src="img/CityWallpaper.png" alt="WPPR" width="600" height="400"/>
				<div class="carousel-caption">
					<br/><br/><br/><br/><br/>
					<h3>Welcome to Metro Business Portal</h3>
				</div>      
			</div>
			<!-- <div class="item"></div> -->
	</div>
	</div>
	<!--  User Login Modal --> 
	<div class="modal fade" id="ULModal" role="dialog">
		<div class="modal-dialog">
    
			<!-- Modal content-->
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4><span class="glyphicon glyphicon-lock"></span>User Login</h4>
				</div>
				
				<div class="modal-body">
				
					<form id="login" method="POST" > <!-- Login Form -->
						<div class="form-group">
							<label for="ULusername">Username</label>
							<input type="text" class="form-control" id="ULusername" name="ULusername" placeholder="Username" required>
						</div>
						<div class="form-group">
							<label for="ULpassword">Password</label>
							<input type="password" class="form-control" id="ULpassword" name="ULpassword" placeholder="Password" required>
						</div>
						
						<input type="submit" value="Login" class="btn btn-block" name="login_user"/>
						<!--onclick="window.location.href='PortalHome.html'-->
					</form>
				
				</div>				
					<div class="modal-footer">
						<p>Not a Member Yet? <a href="#USModal" data-toggle="modal" data-target="#USModal">Sign-up</a></p>
					</div>
					
				</div>
		</div>
	</div>
	
		<!-- Signup Modal -->
	<div class="modal fade" tabindex="-1" id="USModal" role="dialog">
		<div class="modal-dialog" role="document"style="width:800px;">
    
			<!-- Modal content-->
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4><span class="glyphicon glyphicon-plus"></span>&nbsp;Register</h4>
       	 		</div>
        		
        		<form action="register.php" method="POST" id="createForm">
          			<div class="messages"></div>
					<div class="modal-body">
        				<fieldset class="field-border">
          					<legend class="field-border">Personal Information</legend>
			      			<div class="form-group col-xs-6 ">
               					<label for="fname" class="control-label">FirstName</label>
                				<input type="text" class="form-control" id="fname" name="fname" onkeyup='capitalize(this)' placeholder="Enter First Name" required>             				
              				</div>
              				<div class="form-group col-xs-6">
                 				<label for="mid_name" class="control-label">MiddleName</label>
                  				<input type="text" class="form-control" id="mid_name" name="mid_name" onkeyup='capitalize(this)' placeholder="Enter Middle Name" required>
              				</div>
				            <div class="form-group col-xs-6">
				            	<label for="lname" class="control-label">LastName</label>
				               	<input type="text" class="form-control" id="lname" name="lname" onkeyup='capitalize(this)' placeholder="Enter Last Name" required>
				            </div>
				            <div class="form-group col-xs-6">
                                <label for="bdate" class="control-label">Birthdate</label><br/>
                                
                                <!-- <input type="date" class="form-control pull-right" name="bdate" id="bdate" placeholder="Enter Birth Date" required> -->
                                <input type="date" min="<?=date('Y-m-d', strtotime(date('Y-m-d'). ' - 100 years'))?>" max="<?=date('Y-m-d', strtotime(date('Y-m-d'). ' - 18 years'))?>" name="bdate" class='form-control pull-right' required >
                           	</div>							

                           	<div class="form-group col-xs-6">
                				<label for="bplace" class="control-label">Birth Place</label>
               					<textarea type="street-address" class="form-control" id="bplace" name="bplace" onkeyup='capitalize(this)' placeholder="Enter Address" required></textarea>
              				</div>
               				<div class="form-group col-xs-6">
                				<label for="addr" class="control-label">Business Address</label>
               					<textarea type="street-address" class="form-control" id="addr" name="addr" onkeyup='capitalize(this)' placeholder="Enter Address" required></textarea>
              				</div>
              				<div class="form-group col-xs-6">
            					<label for="gender" class="control-label">Gender</label>
              					<select class="form-control" name="gender" id="gender" required>
                  					<option value="">-- Select --</option>
                  					<option value="male">Male</option>
                  					<option value="female">Female</option>
			         			</select>
	          				</div>
	          				<div class="form-group col-xs-6">
				            	<label for="civilstat" class="control-label">Civil Status</label>
				              	<select class="form-control" name="civilstat" id="civilstat" required>
				                  	<option value="">-- Select --</option>
				                  	<option value="Single">Single</option>
				                  	<option value="Married">Married</option>
				                  	<option value="Widowed">Widowed</option>
				                  	<option value="Divorced">Divorced</option>
							    </select>
				            </div>
				        	<div class="form-group col-xs-6">
				            	<label for="nationality" class="control-label">Nationality</label>
				               	<input type="text" class="form-control" id="nationality" name="nationality" onkeyup='capitalize(this)' placeholder="Enter Nationality" required>
				               	<p style="font-size:10px;">For Non-Filipino Nationals: Click 
				               		<a href="#forReg" data-toggle="modal" data-target="#ForReg" class="btn-primary">HERE</a>
				               	</p>
				             
				            </div>
             				<div class="form-group col-xs-6">
            					<label for="contactno" class="control-label">Contact Number</label>
            					<input type="text" class="form-control" id="contactno" name="contactno" maxlength="11" placeholder="Example '0923 4444 5678'" required>
            				</div>
				            <div class="form-group col-xs-6">
				                <label for="religion" class="control-label">Religion</label>
				               	<input type="text" class="form-control" id="religion" name="religion" onkeyup='capitalize(this)' placeholder="Enter Religion" required>
				           	</div>
            			</fieldset>
           				<fieldset class="field-border">
          					<legend class="field-border">Account Information</legend>
          					<div class="form-group col-lg-6 ">		
                        		<label for="user" class="control-label">Username</label>
                        		<input class="form-control" type="text" name="user" id="user" required>   
                    		</div>
                    		<div class="form-group col-lg-6 ">		
                       			<label for="user" class="control-label">Email</label>
                        		<input class="form-control" type="email" name="e" id="e" required>   
                    		</div>
                    		<div class="form-group col-lg-6 ">		
                        		<label for="user" class="control-label">Password</label>
                        		<input class="form-control" type="password" name="p" id="p" required>   
                    		</div>
                    		<div class="form-group col-lg-6 ">		
                        		<label for="user" class="control-label">Confirm Password</label>
                        		<input class="form-control" type="password" name="cp" id="cp" required>   
                    		</div>
          				</fieldset>
					</div>				
					<div class="modal-footer">
	       			 	<button type="submit" class="btn btn-primary">Save</button>
        			</div>	
  				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="ForReg" role="dialog"> <!-- Foreigner Registration -->
		<div class="modal-dialog">
    
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					
				</div>
				<div class="modal-body">
					<p>		
					
						Non-Filipino Individuals must Obtain a Certificate of Registration of Sole Proprietorship or a Certificate of Authority to Engage in Business in the Philippines pursuant to RA 7042 (Foreign Investment Act) and who is at least 18 years of age.
						
						<br/><br/>
						<button type="button" class="btn" stlye="text-align:center;" data-dismiss="modal">Okay</button>
					</p>

				</div>				
			</div>
		</div>
	</div>

	<div class="faqmain">
		<h4>What is Sole Propreitorship?</h4>
		<div class="faq">
			<p>		
				A Sole-Proprietorship is exactly what the first word in the term implies - you run the show and are the legal owner of the business, so you accept all assets and liabilities of owning the business.
				That doesn't mean the business has to bear your name on the front door. Your company can be named after you, or have a different name
				Your company name is viewed by the government as a legal entity that is completely separate and distinct from the owner of the sole proprietorship.
			</p>
		</div>
			<h4>Proesses and Agencies involved?</h4>
		<div class="faq">
			
			<ul style="list-style-type:none;">
				<li><img src="img/DTIIcon.png" alt="DTI" height="20"/> Department of Trade and Industry</li>
				<li><img src="img/LGUIcon.png" alt="LGU" height="20"/> Baranggay Hall</li>
				<li><img src="img/LGUIcon.png" alt="LGU" height="20"/> Cebu City Hall or Municipal Hall</li>
				<li><img src="img/BIRIcon.png" alt="BIR" height="20"/> Bureu of Internal Revenue</li>
			</ul>
		
		</div>

		<h4 id="AppBN">Who may Apply for BN?</h4>
		<div>	
			<p>		
					Filipino citizen who is at least 18 years of age; <br/>
					
					For Non-Filipino: Obtain a Certificate of Registration of Sole Proprietorship/Certificate of Authority to Engage in Business in the Philippines, <br/> pursuant to RA 7042 (Foreign Investment Act) and who is at least 18 years of age.
			</p>
		</div>
	</div>
	<div style="margin-left:100px;margin-bottom:3px;">

			<p>	
				Works only with: 	<i class="fa fa-firefox" aria-hidden="true"></i>
									<i class="fa fa-chrome" aria-hidden="true"></i>
			</p>
			<button id="1" style="padding:10px;cursor:pointer;" onclick="myFunction()" class="btn">DTI CEBU</button>
			<button id="2" style="padding:10px;cursor:pointer;" class="btn">CEBU CITY HALL</button>
			<button id="3" style="padding:10px;cursor:pointer;" class="btn">BIR CEBU</button>
	</div>
	<!-- MAP SCRIPT HERE -->

		<script src="//code.jquery.com/jquery-3.1.3.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuuA8qSPU-uLmXMcSIhav3B9C9t0jeExM&callback=Map" type="text/javascript"></script>

	<!-- 
		New: AIzaSyAuuA8qSPU-uLmXMcSIhav3B9C9t0jeExM
		Old: AIzaSyBYzXj5wF4L6mChyyc5xwfb2QT1QEZ9VN8 
	-->
	<div style="height:100%;" id="map-canvas">	

		<script src="//code.jquery.com/jquery-3.1.3.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuuA8qSPU-uLmXMcSIhav3B9C9t0jeExM&callback=Map" type="text/javascript"></script>	

	</div>

	<script>
		
		var map;
		function initialize()
		{
		  map = new google.maps.Map(document.getElementById('map-canvas'), {
		    center: new google.maps.LatLng(10.2927012,123.9016582),//Setting Initial Position
		    zoom: 19
		  });
		}

		function newLocation(newLat,newLng)
		{
			map.setCenter({
				lat : newLat,
				lng : newLng
			});
		}

		google.maps.event.addDomListener(window, 'load', initialize);

		//Setting Location with jQuery
		$(document).ready(function ()
		{
		    $("#1").on('click', function ()
		    {
			  newLocation(10.2939978,123.90407346);
			});
		  
			$("#2").on('click', function ()
		    {
			  newLocation(10.2927012,123.9016582);
			});
		  
		    $("#3").on('click', function ()
		    {
			  newLocation(10.3239,123.9065);
			});
		});
	</script>
	<script>
	
		function capitalize(obj)
		{
		    obj.value = obj.value.split(' ').map(eachWord=>
		      eachWord.charAt(0).toUpperCase() + eachWord.slice(1)
		    ).join(' ');
		}

		$( document ).ready(function(){

		    $('#bplace').on('keypress', function (e) {
			    
			    if ($(this).val() == "") {
			        
			        if (event.which === 32)
			        { return false; }
			        else {
			            var regex = new RegExp("^[a-zA-Z0-9., ]*$");
			            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			        
			        	if (!regex.test(key)) {
			                
			                event.preventDefault();
			                return false;
			            }
			        }
			    }
			    else {
			        var regex = new RegExp("^[a-zA-Z0-9., ]*$");
			        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			        if (!regex.test(key)) {
			            event.preventDefault();
			            return false;
			        }
			    }
			    return true;
			});
			$('#addr').on('keypress', function (e) {
		    	if ($(this).val() == "") {
		        	
		        	if (event.which === 32)
		        	
		        		{ return false; }
		        	
		        	else {
		            
			            var regex = new RegExp("^[a-zA-Z0-9., ]*$");
			            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			            
			            if (!regex.test(key)) {
			                event.preventDefault();
			                return false;
		            	}
		        	}
		    	}
		    	
		    	else {
		        	
		        	var regex = new RegExp("^[a-zA-Z0-9., ]*$");
		        	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
		        	
		        	if (!regex.test(key)) {
		            	
		            	event.preventDefault();
		            	return false;
		        	}
		    	}
		    	return true;
			});
		    
		    $("#religion").keypress(function(event){
		        var inputValue = event.charCode;
		        if(!(inputValue == 32) && !(inputValue >= 65 && inputValue <= 122) || (inputValue >= 91 && inputValue <= 96)){
		            event.preventDefault();
		        } //Accepts only Space and Letters
		    }); 
		    $("#nationality").keypress(function(event){
		        var inputValue = event.charCode;
		        if(!(inputValue == 32) && !(inputValue >= 65 && inputValue <= 122) || (inputValue >= 91 && inputValue <= 96)){
		            event.preventDefault();
		        } //Accepts only Space and Letters
		    }); 
		    $("#lname").keypress(function(event){
		        var inputValue = event.charCode;
			    if(!(inputValue == 32) && !(inputValue >= 65 && inputValue <= 122) || (inputValue >= 91 && inputValue <= 96)){
		            event.preventDefault();
		        } //Accepts only Space and Letters
		    });
		    $("#mid_name").keypress(function(event){
		        var inputValue = event.charCode;
		     	if(!(inputValue == 32) && !(inputValue >= 65 && inputValue <= 122) || (inputValue >= 91 && inputValue <= 96)){
		            event.preventDefault();
		        } //Accepts only Space and Letters
		    });
		 	$("#fname").keypress(function(event){
		        var inputValue = event.charCode;
		 	    if(!(inputValue == 32) && !(inputValue >= 65 && inputValue <= 122) || (inputValue >= 91 && inputValue <= 96)){
		        	event.preventDefault();
		        } //Accepts only Space and Letters
		    });
		   	$("#contactno").keypress(function (e) {
		     	//if the letter is not digit then display error and don't type anything
		     	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		        	//display error message
		        	return false;
		    	}
		   	}); 
		    
		    $("#user").keypress(function(event){
		        var inputValue = event.charCode;
		        if(!(inputValue != 32 && inputValue == 96) && !(inputValue >= 65 && inputValue <= 122) && !(inputValue >= 48 && inputValue <= 57) || (inputValue >= 91 && inputValue <= 94)){
		            event.preventDefault();
		        } //Accepts only Letters and Numbers, No Space and Special Characters except underscore
		    });
		    $("#e").keypress(function(event){
		        var inputValue = event.charCode;
		        if(!(inputValue != 32 && inputValue != 0) || (inputValue >= 91 && inputValue <= 94)){
		            event.preventDefault();
		        }
		    });
	    });
	</script>
	<script>

		$(document).ready(function() {
            $("#createForm").unbind('submit').bind('submit', function() {

                var form = $(this);

                var	user = $("#user").val();
                var p = $("#p").val();
                var e = $("#e").val();

                if($("#p").val() != $("#cp").val())	{

                	alert("Password and Confirm Password are not The Same.");
                	return false;

                }else{

	                if (user && e) {

	                    $.ajax({

	                        url: form.attr('action'),
	                        type: form.attr('method'),
	                        data: form.serialize(),
	                        dataType: 'json',

	                        success: function(response) {

	                            if (response.success == true) {
	                                $(".messages").each(function() {

	                                    $(".messages").each(function() {
	                                    	alert("Registration Successful");
	                                });

	                                });
	                                
	                                $("#createForm")[0].reset();
	                            } else {

	                                	$(".messages").each(function() {
	                                    	alert("Username already Exists | Error on Registration.");
	                                });
	                            }
	                        }
	                    });
	                }
	                return false;
	            }
            });
        });
	</script>
	<?php include 'includes/userFooter.php'?>
</body>
</html>