<?php 

	require_once 'includes/connect.php';

	$output = array('success' => false, 'messages' => array());

	$send_id = $_POST['send_id'];

	$sql1 = "DELETE FROM send_table WHERE send_id='$send_id'";
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