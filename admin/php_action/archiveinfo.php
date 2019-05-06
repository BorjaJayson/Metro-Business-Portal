<?php 	

	require_once '../includes/connect.php';
	$output = array('success' => false, 'messages' => array());

	$Information_ID = $_POST['Information_ID'];


	$sql1 = "UPDATE information_table SET _status='inactive' WHERE Information_ID='$Information_ID'";
	$query = $conn->query($sql1);

	if ($query === true) {
	    $output['success'] = true;
	    $output['messages'] = 'Successfully removed';
	} else {
	    $output['success'] = false;
	    $output['messages'] = 'Error while removing the member information';
	}

	// close database connection
	$conn->close();
	echo json_encode($output);

?>