<?php

    require_once 'includes/connect.php';
    if ($_POST) {

        $validator = array('success' => false, 'messages' => array());
        $Business_ID = $_POST['Business_ID'];
        $ebn = $_POST['ebn'];
        $ebadd = $_POST['ebadd'];
        $ebs = $_POST['ebs'];
        $etob = $_POST['etob'];
        $ebsc = $_POST['ebsc'];
        $eby = $_POST['eby'];
        $em = $_POST['em'];
        $er = $_POST['er'];
        
        $sql = "UPDATE business_table SET Business_Name = '$ebn', 
        Business_Size = '$ebs', 
        Business_Type = '$etob',
        Business_Sub = '$ebsc', 
        Business_Loc = '$ebadd',
        Business_Brgy = '$eby',
        Business_Mncipal = '$em',
        Business_Region = '$er' WHERE Business_ID =  $Business_ID";
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
 