<?php
require_once '../includes/connect.php';


if ($_POST) { 

    //declarations
    $validator = array('success' => false, 'messages' => array());
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mid_name = $_POST['mid_name'];
    $bdate = date('Y-m-d', strtotime($_POST['bdate']));
    $bplace = $_POST['bplace'];
    $addr = $_POST['addr'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $contactno = $_POST['contactno'];
    $religion = $_POST['religion'];
    $civilstat = $_POST['civilstat'];

    $sql = "INSERT INTO information_table(Firstname, Middlename, Lastname, Birthdate, Contact_no, Address, Gender, birthplace, nationality, religion, civil_status,_status) 
    VALUES ('$fname','$mid_name','$lname','$bdate','$contactno','$addr','$gender','$bplace','$nationality','$religion','$civilstat','active')";
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