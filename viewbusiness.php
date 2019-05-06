<?php
    require_once 'includes/connect.php';
    session_Start();
    $id=$_SESSION['User_ID'];
    $output = array('data' => array());
    $sql = "SELECT
    
        business_table.Business_ID,
        CONCAT(
            information_table.Firstname,
            ' ',
            information_table.Lastname
        ) AS FullName,
        business_table.Business_Name,
        business_table.Business_Type,
        business_table.Business_Loc,
        business_table.Business_Status
        
        FROM
        information_table
        
        INNER JOIN user_table ON information_table.Information_ID = user_table.Information_ID
        INNER JOIN business_table ON user_table.User_ID = business_table.User_ID WHERE user_table.user_ID = $id 
        ORDER BY business_table.business_id DESC";

        // $sql = "SELECT
        //     business_table.Business_ID,
        //     CONCAT(
        //         information_table.Firstname,
        //         ' ',
        //         information_table.Lastname
        //     ) AS FullName,
        //     business_table.Business_Name,
        //     business_table.Business_Type,
        //     business_table.Business_Loc
        // FROM
        //     information_table
        // INNER JOIN user_table ON information_table.Information_ID = user_table.Information_ID
        // INNER JOIN business_table ON user_table.User_ID = business_table.User_ID WHERE business_table.Business_Status='pending' AND User_table.user_ID = ".$_SESSION['User_ID'];

    $query = mysqli_query($conn, $sql);
    $x = 0;

    while ($row = $query->fetch_assoc()) {
    $status = $row['Business_Status'];
   
    if( $status == 'approve') {

        $select = "<a class='btn' href='PortalHome2.php?id=". $row['Business_ID'] ."#HelpDesk'>Upload File Requirements</a>";
        $status = "<p style='color:green;font-weight:bold;'> ". $row['Business_Status']. "</p>";
        
        $actionButton = '           
        <div class="btn-group">
            <button type="button" disabled class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#e2" onclick="editBU(' . $row['Business_ID'] .')"> <span class="glyphicon glyphicon-pencil"></span> edit</a></li>
                 <li><a type="button" data-toggle="modal" data-target="#d2" onclick="deletenadis(' . $row['Business_ID'] . ')"> <span class="glyphicon glyphicon-trash"></span> delete</a></li>     	    
             </ul>
         </div>
     ';
    }else{
        
        $select = "<a class='btn' href='PortalHome2.php?id=". $row['Business_ID'] ."#HelpDesk'>Upload File Requirements</a>";
        $status = "<p style='color:yellow;font-weight:bold;'> ". $row['Business_Status']. "</p>";
          $actionButton = '
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#e2" onclick="editBU(' . $row['Business_ID'] .')"> <span class="glyphicon glyphicon-pencil"></span> edit</a></li>
                 <li><a type="button" data-toggle="modal" data-target="#d2" onclick="deletenadis(' . $row['Business_ID'] . ')"> <span class="glyphicon glyphicon-trash"></span> delete</a></li>     	    
             </ul>
         </div>
     ';
    }
    

    $output['data'][] = array(
        $select,
        $row['Business_ID'],
        $row['Business_Name'],
        $row['FullName'],
        $row['Business_Type'],
        $row['Business_Loc'],
        $status,
        $actionButton

    );
}
// database connection close
$conn->close();
echo json_encode($output);

?> 