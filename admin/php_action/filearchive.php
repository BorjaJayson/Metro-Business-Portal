<?php 

require_once '../includes/connect.php';

$output = array('data' => array());

$sql = "SELECT * FROM upload_table WHERE _stats='inactive'";
$query = mysqli_query($conn, $sql);

$x = 0;
while ($row = $query->fetch_assoc()) {
   //to view the active and deactive employee..but the data are 1 and 2 only.

    //design for option..
    $actionButton = '

	    
        <a type="button" data-toggle="modal" data-target="#IrestoreModal"  data-backdrop="static" data-keyboard="false" onclick="restoreData(' . $row['file_ID'] . ')"> <span class="glyphicon glyphicon-share" style="color:blue;"></span>Restore </a>

	</div>
		';

    $output['data'][] = array(
       $row['file_ID'],
        $row[ 'file_name'],
        $row['file_date'],
        $actionButton

    );


}

// database connection close
$conn->close();
echo json_encode($output);
?>