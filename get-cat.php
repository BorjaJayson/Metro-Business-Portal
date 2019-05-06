<?php require_once 'includes/connect.php'; ?>
<?php

	if(isset($_POST['c_id'])) {
	  
	  $sql = "SELECT * from subcat_table where maincat_ID=".mysqli_real_escape_string($conn, $_POST['c_id']);
	  $res = mysqli_query($conn, $sql);
	  
	  	if(mysqli_num_rows($res) > 0) {
	    
	    	echo "<option value=''>-- SELECT --</option>";

	    	while($row = mysqli_fetch_object($res)) {
	      
	      		echo "<option value='".$row->subcat_ID."'>".$row->subcat_name."</option>";
	    	}
	  	}
	} 
?>