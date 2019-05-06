<?php 
    
    require_once 'includes/connect.php';
    session_start();

    $output = array('data' => array());
    $id = $_SESSION['Username'];

    $sql = "SELECT send_table.send_id,user_table.User_ID,user_table.Username,send_table._sub,send_table.date_added, send_table._stat FROM user_table INNER JOIN send_table ON user_table.User_ID=send_table.User_ID WHERE send_table._to = '$id' ORDER BY send_table.send_id DESC";

    $query = mysqli_query($conn, $sql);
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
    $x = 0;
    
    foreach ($results as $result) {
    $stat = $result['_stat'];


        //$_sub = "<p>". $row['_sub'] ."</p>";
        //design for option..
        $actionButton = ' 

    	    <a href="read.php?id=' . $result['send_id'] . '"><span class="fa fa-file-text"></span> read</a>&nbsp;&nbsp;&nbsp;&nbsp;

            <a type="button" data-toggle="modal" data-target="#d1"  data-backdrop="static" data-keyboard="false" onclick="deletenanis(' . $result['send_id'] . ')"> <span class="glyphicon glyphicon-trash" style="color:red;"></span> delete</a>

    	';

        if($stat == 'send') {

            $sub = "<p style='font-weight:bold;'>". $result['_sub'] ."</p>";
            
            $output['data'][] = array(        
                $result['Username'],
                $sub,
                $result['date_added'],
                $actionButton
            );
        }
        else{

            $sub = "<p>". $result['_sub'] ."</p>";

            $output['data'][] = array(        
                $result['Username'],
                $sub,
                $result['date_added'],
                $actionButton
            );


        }
    }
$conn->close();
echo json_encode($output);

?>