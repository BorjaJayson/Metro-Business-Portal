<?php 

require_once '../includes/connect.php';

$User_ID = $_POST['User_ID'];

$sql = "SELECT user_table.User_ID,
information_table.Firstname,
information_table.Information_ID,
information_table.Middlename,
information_table.Birthdate,
information_table.Contact_no,
information_table.Address,
information_table.Gender,
information_table.birthplace,
information_table.nationality,
information_table.religion,
information_table.civil_status,
information_table.Lastname,
user_table.Username,
user_table.Email 
FROM information_table INNER JOIN user_table 
ON information_table.Information_ID = user_table.Information_ID 
WHERE user_table.Status = 'active' AND user_table.User_Level = 'sole' AND user_table.User_ID = '$User_ID'";
$query = $conn->query($sql);
$result = $query->fetch_assoc();

$conn->close();

echo json_encode($result);

?>