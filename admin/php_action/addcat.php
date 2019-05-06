<?php
require_once '../includes/connect.php';

if ($_POST) {

        $validator = array('success' => false, 'messagess' => array());
        $maincatt = $_POST['maincatt'];
        $scname = $_POST['scname'];
        $sccode = $_POST['sccode'];

        // $sql = "SELECT maincat_ID FROM maincat_table ORDER BY maincat_ID DESC LIMIT 1";
        // $query = $conn->query($sql);
        // $data = mysqli_fetch_array($query);
        // $id = $data['maincat_ID'];
       
       
        $sql = "INSERT INTO subcat_table( subcat_name, subcat_code, maincat_ID) VALUES 
        ('$scname','$sccode','$maincatt')";
        $query = $conn->query($sql);


        if ($query === true) {
                $validator['success'] = true;
                $validator['messagess'] = "Successfully Added";
        } else {
                $validator['success'] = false;
                $validator['messagess'] = "Error while adding the member information";
        }


        
        $conn->close();
        echo json_encode($validator);
}
 