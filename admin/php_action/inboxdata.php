<?php 

    session_start();
    require_once '../includes/connect.php';

    $output = array('data' => array());
    $eid = $_SESSION['Email'];

    $sql = "SELECT hd_table.hd_ID,user_table.User_ID,user_table.Username,hd_table._subject,hd_table.date_added,hd_table._status FROM user_table INNER JOIN hd_table ON user_table.User_ID=hd_table.user_ID WHERE hd_table._to = '$eid' ORDER BY hd_table.hd_ID desc";

    //WHERE hd_table._to = ".$_SESSION['Username']
    $query = mysqli_query($conn, $sql);
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
    $x = 0;
    
    foreach ($results as $result) {
        //to view the active and deactive employee..but the data are 1 and 2 only.
        $status = $result['_status'];
        $actionButton = ' 

	        <a href="read.php?id=' . $result['hd_ID'] . '"><span class="fa fa-file-text"></span>&nbsp; read</a>&nbsp;&nbsp;&nbsp;&nbsp;

            <a type="button" data-toggle="modal" data-target="#d"  data-backdrop="static" data-keyboard="false" onclick="deletenani(' . $result['hd_ID'] . ')"> <span class="glyphicon glyphicon-trash" style="color:red;"></span> delete</a>

		';

         if($status == 'unread') {

            $subject = "<p style='font-weight:bold;'>". $result['_subject'] ."</p>";
            $output['data'][] = array(        
                
                $result['Username'],
                $subject,
                $result['date_added'],
                $actionButton
            );
        }
        else{
            
            $output['data'][] = array(
        
                $result['Username'],
                $result['_subject'],
                $result['date_added'],
                $actionButton
            );
        }
    }

    // Database Connection Close
    $conn->close();
    echo json_encode($output);

?>