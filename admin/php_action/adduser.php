<?php
require_once '../includes/connect.php';

if ($_POST) {

        $validator = array('success' => false, 'messagess' => array());
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $bdate = date('Y-m-d', strtotime($_POST['bdate']));
        $bplace = $_POST['bplace'];
        $addr = $_POST['addr'];
        $gender = $_POST['gender'];
        $nationality = $_POST['nationality'];
        $contactno = $_POST['contactno'];
        $religion = $_POST['religion'];
        $civilstat = $_POST['civilstat'];


        $user = $_POST['user'];
        $e = $_POST['e'];
        $p = $_POST['p'];
        $cp = $_POST['cp'];
        $cp = md5("$cp");


        $sql11 = "INSERT INTO information_table(Firstname, Middlename, Lastname, Birthdate, Contact_no, Address, Gender, birthplace, nationality, religion, civil_status,_status) 
        VALUES ('$fname','$mname','$lname','$bdate','$contactno','$addr','$gender','$bplace','$nationality','$religion','$civilstat','active')";

        $query11 = $conn->query($sql11);


        $sql1 = "SELECT Information_ID FROM information_table ORDER BY Information_ID DESC LIMIT 1";
        $query2 = $conn->query($sql1);
        $data = mysqli_fetch_array($query2);
        $id = $data['Information_ID'];
       
       
        $sql = "INSERT INTO user_table(Information_ID, Username, Password,Email,Status,User_level) VALUES 
        ('$id','$user','$cp','$e','active','sole')";
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
 