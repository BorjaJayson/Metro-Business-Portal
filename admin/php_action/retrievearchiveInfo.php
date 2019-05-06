<?php
require_once '../includes/connect.php';

$output = array('data' => array());
$sql = "SELECT Information_ID ,CONCAT(Firstname, ' ' ,Middlename, ' ' ,Lastname)AS FullName, Contact_no FROM information_table WHERE _status='inactive' ORDER BY Information_ID desc";
$query = mysqli_query($conn, $sql);
$x = 0;
while ($row = $query->fetch_assoc()) {
   //to view the active and deactive employee..but the data are 1 and 2 only.
    //$active = '';
    //if ($row['employeestat'] == 'active') {
    //    $active = '<label class="label label-success">Active</label>';
    //} elseif ($row['employeestat'] == 'deactive') {
    //$active = '<label class="label label-danger">Deactive</label>';
    //}
    //design for option..
    $actionButton = '
	
	    <a type="button" data-toggle="modal" data-target="#IrestoreModal"  data-backdrop="static" data-keyboard="false" onclick="IrestoreData(' . $row['Information_ID'] . ')"> <span class="glyphicon glyphicon-share" style="color:blue;"></span> </a>

  
	</div>
		';

    $output['data'][] = array(
        $row['Information_ID'],
        $row['FullName'],
        $row['Contact_no'],
        $actionButton

    );


}

// database connection close
$conn->close();
echo json_encode($output);
?>