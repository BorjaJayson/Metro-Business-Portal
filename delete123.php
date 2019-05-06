<?php 

	require_once 'includes/connect.php';

	$output = array('success' => false, 'messages' => array());

	$Business_ID = $_POST['Business_ID'];


	$sql1 = "DELETE FROM business_table WHERE Business_ID='$Business_ID'";
	$query = $conn->query($sql1);
	if ($query === true) {
	    $output['success'] = true;
	    $output['messages'] = 'Successfully restored';
	} else {
	    $output['success'] = false;
	    $output['messages'] = 'Error while removing the member information';
	}

	// close database connection
	$conn->close();
	echo json_encode($output);

?>
 