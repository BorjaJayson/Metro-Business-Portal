<?php 

require_once '../includes/connect.php';

$output = array('success' => false, 'messages' => array());

$hd_ID = $_POST['hd_ID'];


$sql1 = "DELETE FROM hd_table WHERE hd_ID='$hd_ID'";
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