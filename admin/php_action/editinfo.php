<?php

require_once '../includes/connect.php';
if ($_POST) {

    //information_table
    $validator = array('success' => false, 'messages' => array());
    $Information_ID = $_POST['editid'];
    $editfname = $_POST['editfname'];
    $editlname = $_POST['editlname'];
    $editmname = $_POST['editmname'];
    $editbdate = $_POST['editbdate'];
    $editbplace = $_POST['editbplace'];
    $editaddr = $_POST['editaddr'];
    $editgender = $_POST['editgender'];
    $editnationality = $_POST['editnationality'];
    $editcontactno = $_POST['editcontactno'];
    $editreligion = $_POST['editreligion'];
    $editcivilstat = $_POST['editcivilstat'];
   
    $ecp = $_POST['ecp']; //Password
    $ecp1 = md5($ecp);    //Encrypts Password
    $User_ID = $_POST['User_ID'];
    
    $sql_i = "UPDATE information_table SET Firstname = '$editfname', 
    Middlename = '$editmname', 
    Lastname = '$editlname', 
    Birthdate = '$editbdate',
    Contact_no = '$editcontactno',
    Address = '$editaddr',
    Gender = '$editgender',
    birthplace = '$editbplace',
    nationality = '$editnationality',
    religion = '$editreligion',
    civil_status = '$editcivilstat' WHERE Information_ID = $Information_ID";
    
    $query_i = $conn->query($sql_i);

   
    //user_table
    $sql_u = "UPDATE user_table SET Information_ID = '$Information_ID', 
    Password = '$ecp1'
    WHERE User_ID = '$User_ID'";

    $query_u = $conn->query($sql_u);

    if ($query_u === true) {
        $validator['success'] = true;
        $validator['messages'] = "Successfully Updated";
    } else {
        $validator['success'] = false;
        $validator['messages'] = "Error while Editing the member information";
    }
   

	// close the database connection
    $conn->close();
    echo json_encode($validator);

}
?>