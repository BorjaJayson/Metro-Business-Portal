<?php
require_once 'includes/connect.php';


if ($_POST) { 

    //declarations
    $validator = array('success' => false, 'messages' => array());
    $to = $_POST['to'];
    $from = $_POST['from'];
    $sub = $_POST['sub'];
    $ct = $_POST['ct'];
    $sql1 = "SELECT User_ID FROM user_table WHERE Username='$from' OR Email='$from'";
    $query1 = $conn->query($sql1);
    $data = mysqli_fetch_array($query1);
    $id = $data['User_ID'];
    
    //$count2 = mysqli_num_rows($query1);
    //if ($count2 == 1) {

    $sql = "INSERT INTO hd_table( User_ID, _subject, _message, _status, date_added, _read, _to) VALUES 
    ('$id','$sub','$ct','unread',CURRENT_TIMESTAMP,0,'$to')";
    $query = $conn->query($sql);


    if ($query === true) {
        $validator['success'] = true;
        $validator['messages'] = "Successfully Added";
    } else {
        $validator['success'] = false;
        $validator['messages'] = "Error while adding the member information";
    }
    
    $conn->close();
    echo json_encode($validator);


}



?>