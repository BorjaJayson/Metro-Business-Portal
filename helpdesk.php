<?php
require_once 'includes/connect.php';

if ($_POST) {

    $validator = array('success' => false, 'messages' => array());    
    $hdid = $_POST['hdid'];
    $hdname = $_POST['hdname'];
    $hdmsg1 = $_POST['hdmsg'];
    $hdmsg2= $_POST['s'];
    $hdto = $_POST['hdto'];
        
    $sql_u = "SELECT * FROM user_table WHERE Email ='$hdto'"; // Checks if User or Email Already exists
    $query_u = mysqli_query($conn,$sql_u);
    $data_u = mysqli_fetch_array($query_u, MYSQLI_NUM);

    if($data_u[0] > 0)  {

        $sql = "INSERT INTO hd_table( User_ID, _subject, _message, _status, date_added, _read, _to) VALUES 
        ('$hdid','$hdmsg2','$hdmsg1','unread',CURRENT_TIMESTAMP,0,'$hdto')";
        $query1 = $conn->query($sql);

       if ($query1 === true) {

                $validator['success'] = true;
                $validator['messages'] = "Successfully Added";
        } else {
                
                $validator['success'] = false;
                $validator['messages'] = "Error while adding the member information";
        }
    }else {

        $validator['success'] = false;
        $validator['messages'] = "Username not Found.";   

        }
    
        $conn->close();
        echo json_encode($validator);
}    
?>