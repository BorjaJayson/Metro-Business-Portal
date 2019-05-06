<?php

    require_once 'includes/connect.php';
    session_start();
    if ($_POST) {

        $validator = array('success' => false, 'messages' => array());
       $a = $_SESSION['User_ID'];   
       $b = md5($_POST['cnp']);     
        $sql = "UPDATE user_table SET Password = '$b' WHERE User_ID = $a";
        $query = $conn->query($sql);

        if ($query === true) {
            $validator['success'] = true;
            $validator['messages'] = "Successfully Updated";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while adding the member information";
        }


        // close the database connection
        $conn->close();
        echo json_encode($validator);
    }

?>
 