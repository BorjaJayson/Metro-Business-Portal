<?php
    require_once 'includes/connect.php';
    if ($_POST) {
    
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


        $user = $_POST['user'];
        $e = $_POST['e'];
        $p = $_POST['p'];
        $cp = $_POST['cp'];
        $cp = md5("$cp");

        $sql_u = "SELECT * FROM user_table WHERE Username ='$user'"; // Checks if User or Email Already exists
        $sql_e = "SELECT * FROM user_table WHERE Email = '$e'";

        $query_u = mysqli_query($conn,$sql_u);
        $data_u = mysqli_fetch_array($query_u, MYSQLI_NUM);
        $query_e = mysqli_query($conn,$sql_e);
        $data_e = mysqli_fetch_array($query_e, MYSQLI_NUM);

        if($data_u[0] > 0)  {

                $validator['success'] = false;
                $validator['messages'] = "Username Already Exists.";            
        
        }
        else if($data_e[0] > 0)   {

                $validator['success'] = false;
                $validator['messages'] = "Email Already Exists.";   

        }else   {

            $sql11 = "INSERT INTO information_table(Firstname, Middlename, Lastname, Birthdate, Contact_no, Address, Gender, birthplace, nationality, religion, civil_status,_status) 
            VALUES ('$fname','$mid_name','$lname','$bdate','$contactno','$addr','$gender','$bplace','$nationality','$religion','$civilstat','active')";

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
                $validator['messages'] = "Account Successfully Added";
              
            } else {

                $validator['success'] = false;
                $validator['messages'] = "Error while adding the member information";
        
            }
        }
        $conn->close();
        echo json_encode($validator);
}