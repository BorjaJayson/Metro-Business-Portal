<?php

require_once '../includes/connect.php';
if ($_POST) {

    $validator = array('success' => false, 'messages' => array());
    $User_ID = $_POST['User_ID'];

    $ecp = $_POST['ecp'];
    $eiid = $_POST['eiid'];
    $ecp1 = md5($ecp);
    
    $sql = "UPDATE user_table SET Information_ID = '$eiid', 
        Password = '$ecp1'
        WHERE User_ID = '$User_ID'";
    
    $query = $conn->query($sql);

    if ($query === true) {
    
        $validator['success'] = true;
        $validator['messages'] = "Successfully Updated";
    
    } else {
    
        $validator['success'] = false;
        $validator['messages'] = "Error while Editing the member information";
    
    }
        }
    $conn->close();
    echo json_encode($validator);
?>