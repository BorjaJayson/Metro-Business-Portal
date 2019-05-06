<?php

        require_once 'includes/connect.php';
        
        if ($_POST) {
        
                $validator = array('success' => false, 'messages' => array());
                $cbid = $_POST['cbid'];
                $bn = $_POST['bn'];
                $badd = $_POST['badd'];          
                $bs = $_POST['bs'];
                $tob = $_POST['tob'];
                $bsc = $_POST['bsc'];
                $by = $_POST['by'];
                $m = $_POST['m'];
                $r = $_POST['r'];
              
                $check1 = "SELECT * FROM business_table WHERE Business_Name='$bn' AND  Business_Brgy='$by'";
                $check2 = "SELECT * FROM business_table WHERE Business_Name='$bn' AND  Business_Mncipal='$m'";
                $check3 = "SELECT * FROM business_table WHERE Business_Name='$bn' AND  Business_Region='$r'";
                
                $cquery1=mysqli_query($conn,$check1);
                $data1 = mysqli_fetch_array($cquery1, MYSQLI_NUM);

                $cquery2=mysqli_query($conn,$check2);
                $data2 = mysqli_fetch_array($cquery2, MYSQLI_NUM);

                $cquery3=mysqli_query($conn,$check3);
                $data3 = mysqli_fetch_array($cquery3, MYSQLI_NUM);
                
                if($data1[0] > 0){

                        $validator['success'] = false;
                        $validator['messages'] = "Business name already exists within same Baranggay";            
                
                }
                else if($data2[0] > 0){

                        $validator['success'] = false;
                        $validator['messages'] = "Business name already exists within same Municipal";      
                }
                else if($data3[0] > 0){

                        $validator['success'] = false;
                        $validator['messages'] = "Business name already exists within same Region";   

                }else{


                        $sql = "INSERT INTO business_table(User_ID, Business_Name, Business_Size, Business_Type, Business_Sub, Business_Loc, Date_Add, Business_Brgy, Business_Mncipal, Business_Region, Business_Status) VALUES 
                        ('$cbid','$bn','$bs','$tob','$bsc','$badd',CURRENT_TIMESTAMP,'$by','$m','$r','pending')";

                        $query1 = $conn->query($sql);


                        if ($query1 === true) {
                                $validator['success'] = true;
                                $validator['messages'] = "Successfully Added";
                        } else {
                                $validator['success'] = false;
                                $validator['messages'] = "Error while adding the member information";
                        }


                }

                $conn->close();
                echo json_encode($validator);
        }
?>