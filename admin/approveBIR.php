<?php

session_start();
require_once 'includes/connect.php';

if (!isset($_SESSION['Username'])) {

    header('location:../index.php');
    exit;

} else {

?>

<?php //Notification SQL
    $id= intval($_GET['ids']);
    $nsql = "
        SELECT
        business_table.Business_ID,
        business_table.Business_Name,
        business_table.Business_Type,
        business_table.Business_Status,
        user_table.Email,
        user_table.Username,
        user_table.User_ID
        FROM
            business_table
        INNER JOIN user_table ON user_table.User_ID = business_table.user_ID WHERE business_table.Business_ID = $id
    ";
    $nquery = $conn->query($nsql);

        $ndata = mysqli_fetch_array($nquery);
        $nemail = $ndata['Email'];
        $nid = $ndata['User_ID'];
        $nusername = $ndata['Username'];
        $nbn = $ndata['Business_Name'];

?>

<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>Checking Requirements</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-6 col-centered">
                        <div class="box box-primary">
                            <div class="box-body">
                                <form action="" method="POST" id="updateInfoForm">
                                    <?php
                                        
                                        $id = $_SESSION['User_ID'];
                                        $wewe = intval($_GET['ids']);
                                        
                                        $sql44 = "SELECT * FROM progress_table WHERE Progress_Status='approve_1901' AND Progress_By='$id' AND Business_ID='$wewe'";
                                        
                                        $query3=$conn->query($sql44);
                                        $data = mysqli_fetch_array($query3);
                                        
                                        $a=$data['Progress_By'];
                                        $b=$data['Progress_Status'];
                                        $c=$data['Business_ID'];
                                        
                                        $d1=$data['Progress_ID'];
                                        if($data['Progress_ID']==$d1 && $b=='approve_1901'){
                                    
                                        ?>
                                        
                                            <fieldset class="field-border">
                                            <legend class="field-border">BIR</legend>
                                            <div class="form-check" style="zoom:1.6">
                                                <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled value="approve_1901"  id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    BIR Form 1901 | Self-Employment, Mixed Income, Estate and Trust
                                                </label>
                                            </div>
                                    
                                        <?php } else{ ?>
                                        
                                            <fieldset class="field-border" >
                                                <legend class="field-border">BIR</legend>
                                                <div class="form-check" style="zoom:1.6">
                                                    <input class="form-check-input" type="checkbox" name="wewe[]"  value="approve_1901"  id="defaultCheck1">
                                                    
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        BIR Form 1901 | Self-Employment, Mixed Income, Estate and Trust
                                                    </label>
                                                </div>
                                        <?php }?>
                                    
                                    <?php
                                        
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_0605' AND Progress_By='$id' AND Business_ID='$wewe'";
                                        $query=$conn->query($sql);
                                        
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                                     
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_0605'){

                                    ?>
                                                
                                        <div class="form-check" style="zoom:1.6">            
                                            <input class="form-check-input" type="checkbox" name="wewe1[]" checked disabled  value="approve_0605" id="defaultCheck12"> 
                                            <label class="form-check-label" for="defaultCheck12">
                                                BIR Form 0605 | Documentary Stamp Tax Return
                                            </label>
                                        </div>
                                
                                    <?php } else{?>
                                        
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe1[]"   value="approve_0605" id="defaultCheck12" >
                                            <label class="form-check-label" for="defaultCheck12">
                                                BIR Form 0605 | Documentary Stamp Tax Return
                                            </label>
                                        </div>
                                        
                                    <?php } 
                                                   
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_2000' AND Progress_By='$id' AND Business_ID='$wewe'";
                                        $query=$conn->query($sql);
                                        
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                             
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_2000'){
                                    
                                    ?>
                                        
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe2[]" checked disabled value="approve_2000" id="defaultCheck13" >
                                            <label class="form-check-label" for="defaultCheck13">
                                                BIR Form 2000 | Remittance Document
                                            </label>
                                        </div>
                                    
                                    <?php } else{?>
                                        
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe2[]"   value="approve_2000" id="defaultCheck13" >
                                            <label class="form-check-label" for="defaultCheck13">
                                                BIR Form 2000 | Remittance Document
                                            </label>
                                        </div>

                                    <?php }?>
                                        
                                        </fieldset>
                        
                                    <?php
                                        
                                        $qwe="SELECT COUNT(*) as wewe FROM progress_table WHERE Business_ID=$wewe AND Progress_By='$id'";
                                        $qee=$conn->query($qwe);
                                        
                                        $row11=mysqli_fetch_assoc($qee);
                                        
                                        if($row11['wewe']==3){
                                    
                                    ?>
                                        <button type="submit" name="submit" disabled class="btn btn-primary pull pull-right">Approve</button>
                                    <?php } else{?>
                                        <button type="submit" name="submit"  class="btn btn-primary pull pull-right">Approve</button>
                                    <?php }?>
                                
                                </form> <!-- END OF DTI FORM -->
                                    
                                <?php 
                                    
                                    if(isset($_POST['submit'])){
                                        
                                        //$checkBox = implode(',', $_POST['wewe']);
                                        //$checkBox1 = implode(',', $_POST['wewe1']);
                                        //$checkBox2 = implode(',', $_POST['wewe2']);
                                        $id1=intval($_GET['ids']);
                                        $id=$_SESSION['User_ID'];
                                                           
                                        //$sql1="UPDATE business_table SET Business_Status='approve' WHERE Business_ID='$id1'";
                                        //$query1=$conn->query($sql1);
                                            
                                        if(empty($_POST['wewe']) && empty($_POST['wewe1']) && empty($_POST['wewe2'])){
                                                    
                                            echo'<script>
                                                alert("please check the corresponding checkbox!");                  
                                            </script>';
                                            
                                           echo "<meta http-equiv='refresh' content='0'>";
                                                
                                        }else{
                                            
                                            if(!empty($_POST['wewe'])){
                                                            
                                                $sql="INSERT INTO progress_table(Business_ID,Progress_Status,Progress_Remarks,Progress_By,Progress_Date) VALUES 
                                                            ('$id1','approve_1901','complete','$id',CURRENT_TIMESTAMP)";
                                                $query=$conn->query($sql);

                                                $sndr = $_SESSION['User_ID'];
                                                $sql_n = "INSERT INTO send_table(User_ID, _sub, _mes, _stat,date_added,_to)
                                                VALUES(
                                                        
                                                        '$sndr',
                                                        'BIR 1901 | Registration for Self-Employment',
                                                        'Your Registration of Self Employment for $nbn has been Approved by the BIR',
                                                        'send',
                                                        CURRENT_TIMESTAMP,
                                                        '$nusername'
                                                    )
                                                ";
                                                $query_n = $conn->query($sql_n);
                                                    
                                                if($query == true){
                                                        
                                                    echo'<script>
                                                        alert("Approved!");            
                                                    </script>';
                                                    
                                                    echo "<meta http-equiv='refresh' content='0'>";
                                                
                                                }else{
                                                        
                                                    echo'<script>
                                                        alert("Not Approved!");
                                                    </script>';
                                                }
                                            }
                                                
                                            if(!empty($_POST['wewe1'])){
                                                    
                                                $sql="INSERT INTO progress_table(Business_ID,Progress_Status,Progress_Remarks,Progress_By,Progress_Date) VALUES 
                                                ('$id1','approve_0605','complete','$id',CURRENT_TIMESTAMP)";
                                                
                                                $query=$conn->query($sql);

                                                $sndr = $_SESSION['User_ID'];
                                                $sql_n = "INSERT INTO send_table(User_ID, _sub, _mes, _stat,date_added,_to)
                                                VALUES(
                                                        
                                                        '$sndr',
                                                        'BIR 0605 | Payment Form',
                                                        'Your Annual Payment Form for $nbn has been accepted by the BIR',
                                                        'send',
                                                        CURRENT_TIMESTAMP,
                                                        '$nusername'
                                                    )
                                                ";
                                                $query_n = $conn->query($sql_n);
                                                    
                                                if($query ==true){
                                                        
                                                    echo'<script>
                                                        alert("Approved!");
                                                    </script>';
                                                    
                                                    echo "<meta http-equiv='refresh' content='0'>";
                                                    
                                                } else{
                                                        
                                                    echo'<script>
                                                        alert("Not Approved!");
                                                    </script>';
                                                    }
                                                
                                            } 

                                            if(!empty($_POST['wewe2'])){
                                        
                                                $sql="INSERT INTO progress_table(Business_ID,Progress_Status,Progress_Remarks,Progress_By,Progress_Date) VALUES 
                                                ('$id1','approve_2000','complete','$id',CURRENT_TIMESTAMP)";
                                                $query=$conn->query($sql);

                                                $sndr = $_SESSION['User_ID'];
                                                $sql_n = "INSERT INTO send_table(User_ID, _sub, _mes, _stat,date_added,_to)
                                                VALUES(
                                                        
                                                        '$sndr',
                                                        'BIR 2000 | Documentary Stamp Tax Return',
                                                        'Your Documentary Stamp Tax Return Document has been Issued. 
                                                        Congratulations on your $nbn. It is now a Legitimate Business
                                                        ',
                                                        'send',
                                                        CURRENT_TIMESTAMP,
                                                        '$nusername'
                                                    )
                                                ";
                                                $query_n = $conn->query($sql_n);
                                                    
                                                if($query ==true){
                                                        
                                                    echo '<script>
                                                        alert("Approved!");
                                                    </script>';
                                                        
                                                    echo "<meta http-equiv='refresh' content='0'>";
                                                    
                                                }else{
                                                    
                                                    echo'<script>
                                                        alert("Not Approved!");
                                                    </script>';
                                                }
                                            }
                                        }        
                                    }
                                ?>
                                <?php //Counts No of Progress Transac, Auto-Approves BN when count reaches 9
                                           
                                    $qwe="SELECT COUNT(*) as wewe FROM progress_table WHERE Business_ID=$wewe";
                                    $qee=$conn->query($qwe);
                                    $row11=mysqli_fetch_assoc($qee);
                                            
                                    if($row11['wewe']==9){
                                            
                                        $sql1="UPDATE business_table SET Business_Status='approve' WHERE Business_ID= '$wewe'"; 
                                        $query11=$conn->query($sql1);
                                    
                                    }else {
                                                
                                        $sql1="UPDATE business_table SET Business_Status='pending' WHERE Business_ID= '$wewe'"; 
                                        $query11=$conn->query($sql1);
                                    } 
                                            
                                ?>                                          
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include 'includes/footer.php'; ?>
    </div>
    <?php include 'includes/script.php'; ?>
</body>
<?php 
} ?> 