<?php

require_once '../includes/connect.php';
session_start();
$id=$_SESSION['User_ID'];
$output = array('data' => array());
$sql = "
        SELECT
            business_table.Business_ID,
            CONCAT(
                information_table.Firstname,
                ' ',
                information_table.Lastname
            ) AS FullName,
            business_table.Business_Name,
            business_table.Business_Type,
            business_table.Business_Status
            FROM
                information_table
            INNER JOIN user_table ON information_table.Information_ID = user_table.Information_ID
            INNER JOIN business_table ON user_table.User_ID = business_table.User_ID
            ORDER BY business_table.business_id DESC
        ";

    $query = mysqli_query($conn, $sql);
    $x = 0;
    $readBusiness = "
        
        
    ";

    while ($row = $query->fetch_assoc()) {

       if($id == 4){

            $actionButton = '

                <a href="approveDTI.php?ids=' . $row[ 'Business_ID'] . '"> 
                    <span class="glyphicon glyphicon-check" style="color:green;"></span>
                </a> &nbsp;
                <a href="readBusiness.php?ids=' . $row[ 'Business_ID'] . '"> 
                    <span class="glyphicon glyphicon-eye-open" style="color:blue;"></span>
                </a> 
            ';
    
       }else if($id == 3){
            $actionButton = '

                <a href="approveLGU.php?ids=' . $row[ 'Business_ID'] . '"> 
                    <span class="glyphicon glyphicon-check" style="color:green;"></span>
                </a> &nbsp;
                <a href="readBusiness.php?ids=' . $row[ 'Business_ID'] . '"> 
                    <span class="glyphicon glyphicon-eye-open" style="color:blue;"></span>
                </a> 

		          ';
       }else if($id == 2){
            $actionButton = '

                <a href="approveBIR.php?ids=' . $row[ 'Business_ID'] . '"> 
                    <span class="glyphicon glyphicon-check" style="color:green;"></span>
                </a> &nbsp;
                <a href="readBusiness.php?ids=' . $row[ 'Business_ID'] . '"> 
                    <span class="glyphicon glyphicon-eye-open" style="color:blue;"></span>
                </a> 

                ';
       }else {
            $actionButton = '

                <a href="approvereq.php?ids=' . $row[ 'Business_ID'] . '"> 
                    <span class="glyphicon glyphicon-check" style="color:green;"></span>
                </a> &nbsp;
                <a href="readBusiness.php?ids=' . $row[ 'Business_ID'] . '"> 
                    <span class="glyphicon glyphicon-eye-open" style="color:blue;"></span>
                </a> 

                ';
       }
       $Status = $row['Business_Status'];

       if($Status == 'approve'){
            
            $Status = "<p style'color:green;font-weight:bold;'>".$row['Business_Status']."</p>";

                $output['data'][] = array(
       
                $row['Business_ID'],
                $row[ 'Business_Name'],
                $row[ 'FullName'],
                $row['Business_Type'],
                $Status,
                $actionButton

    );

       }else{

             $Status = "<p style'color:yellow;font-weight:bold;'>".$row['Business_Status']."</p>";

                $output['data'][] = array(
       
                $row['Business_ID'],
                $row[ 'Business_Name'],
                $row[ 'FullName'],
                $row['Business_Type'],
                $Status,
                $actionButton

    );

       }

}

// database connection close
$conn->close();
echo json_encode($output);
?>