<?php 

require_once '../includes/connect.php';

$output = array('success' => false, 'messages' => array());

$User_ID = $_POST['User_ID'];


$sql1 = "UPDATE user_table SET Status='active' WHERE User_ID='$User_ID'";
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