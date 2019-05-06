<?php 

require_once '../includes/connect.php';

$output = array('success' => false, 'messages' => array());

$file_ID = $_POST['file_ID'];


$sql1 = "UPDATE upload_table SET _stats='active' WHERE file_ID='$file_ID'";
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