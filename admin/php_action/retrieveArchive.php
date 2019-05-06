<?php 

require_once '../includes/connect.php';

$output = array('data' => array());

$sql = "SELECT user_table.User_ID, CONCAT(information_table.Firstname, ' ' ,information_table.Lastname) AS Fullname,user_table.Username,user_table.Email FROM information_table INNER JOIN user_table ON information_table.Information_ID = user_table.Information_ID WHERE user_table.Status='inactive' ORDER BY user_table.User_ID desc";
$query = mysqli_query($conn, $sql);

$x = 0;
while ($row = $query->fetch_assoc()) {
   //to view the active and deactive employee..but the data are 1 and 2 only.

    //design for option..
    $actionButton = '

	    
        <a type="button" data-toggle="modal" data-target="#restoreModal"  data-backdrop="static" data-keyboard="false" onclick="restoreData(' . $row['User_ID'] . ')"> <span class="glyphicon glyphicon-share" style="color:blue;"></span>Restore </a>

	</div>
		';

    $output['data'][] = array(
       $row['User_ID'],
        $row[ 'Fullname'],
        $row['Username'],
        $row['Email'], 
        $actionButton

    );


}

// database connection close
$conn->close();
echo json_encode($output);
?>