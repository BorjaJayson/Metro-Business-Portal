<?php 

require_once '../includes/connect.php';

$Information_ID = $_POST['Information_ID'];

$sql = "SELECT * FROM information_table WHERE Information_ID = $Information_ID";
$query = $conn->query($sql);
$result = $query->fetch_assoc();


$conn->close();
echo json_encode($result);

?>

