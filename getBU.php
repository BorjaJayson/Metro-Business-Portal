<?php 

require_once 'includes/connect.php';

$Business_ID = $_POST['Business_ID'];

$sql = "SELECT * FROM business_table WHERE Business_ID = '$Business_ID'";
$query = $conn->query($sql);
$result = $query->fetch_assoc();


$conn->close();
echo json_encode($result);

?>