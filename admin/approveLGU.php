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
                                        
                                        $sql44 = "SELECT * FROM progress_table WHERE Progress_Status='approve_brgyBusPerm' AND Progress_By='$id' AND Business_ID='$wewe'";
                                        
                                        $query3=$conn->query($sql44);
                                        $data = mysqli_fetch_array($query3);
                                        
                                        $a=$data['Progress_By'];
                                        $b=$data['Progress_Status'];
                                        $c=$data['Business_ID'];
                                        
                                        $d1=$data['Progress_ID'];
                                        if($data['Progress_ID']==$d1 && $b=='approve_brgyBusPerm'){
                                    
                                    ?>
                                        
                                            <fieldset class="field-border" >  
                                                <legend class="field-border">LGU</legend>
                                                        <div class="form-check" style="zoom:1.6"> <!-- Process #1 -->
                                                            <input class="form-check-input" type="checkbox" checked disabled="disabled" name="wewe[]" value="approve_brgyBusPerm" id="brgyBusPerm">
                                                            <label class="form-check-label" for="brgyBusPerm">
                                                                Barangay Certificate of Business Registration
                                                            </label>
                                                        </div>
                                    
                                        <?php } else{ ?>
                                        
                                            <fieldset class="field-border" >
                                                <legend class="field-border">LGU</legend>
                                                    <div class="form-check" style="zoom:1.6">
                                                        <input class="form-check-input" type="checkbox" name="wewe[]" value="approve_brgyBusPerm" id="brgyBusPerm">
                                                        <label class="form-check-label" for="brgyBusPerm">
                                                            Barangay Certificate of Business Registration
                                                        </label>
                                                </div>
                                        <?php }?>
                                    
                                    <?php
                                        
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_MunBusPerm' AND Progress_By='$id' AND Business_ID='$wewe'";
                                        $query=$conn->query($sql);
                                        
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                                     
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_MunBusPerm'){

                                    ?>
                                                
                                        <div class="form-check" style="zoom:1.6"> <!-- Process #2 -->            
                                            <input class="form-check-input" type="checkbox" name="wewe1[]" checked disabled  value="approve_MunBusPerm" id="MunBusPerm"> 
                                            <label class="form-check-label" for="defaultCheck12">
                                                Municipal or City Hall Business Permit
                                            </label>
                                        </div>
                                
                                    <?php } else{?>
                                        
                                            <div class="form-check" style="zoom:1.6">
                                                <input class="form-check-input" type="checkbox" name="wewe1[]" value="approve_MunBusPerm" id="MunBusPerm" >
                                                <label class="form-check-label" for="defaultCheck12">
                                                    Municipal or City Hall Business Permit
                                                </label>
                                            </div>
                                        
                                    <?php } 
                                                   
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_AllLGU' AND Progress_By='$id' AND Business_ID='$wewe'";
                                        $query=$conn->query($sql);
                                        
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                             
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_AllLGU'){
                                    
                                    ?>
                                        
                                        <div class="form-check" style="zoom:1.6"> <!-- Process #3 -->
                                            <input class="form-check-input" type="checkbox" name="wewe2[]" checked disabled value="approve_AllLGU" id="AllLGU" >
                                            <label class="form-check-label" for="defaultCheck13">
                                                Proof of Address | Contract of Lease or
                                            </label>
                                        </div>
                                    
                                    <?php } else{?>
                                        
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe2[]"   value="approve_AllLGU" id="AllLGU" >
                                            <label class="form-check-label" for="defaultCheck13">
                                                Proof of Address | Contract of Lease or
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
                                                            ('$id1','approve_brgyBusPerm','complete','$id',CURRENT_TIMESTAMP)";
                                                $query=$conn->query($sql);

                                                $sndr = $_SESSION['User_ID'];
                                                $sql_n = "INSERT INTO send_table(User_ID, _sub, _mes, _stat,date_added,_to)
                                                VALUES(
                                                        
                                                        '$sndr',
                                                        'Baranggay Certificate of Registration',
                                                        'Your Baranggay Certificate of Registration for $nbn has been Accepted by the Municipal! You may now proceed on your next LGU Process. Kindly look back for further notice.',
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
                                                ('$id1','approve_MunBusPerm','complete','$id',CURRENT_TIMESTAMP)";
                                                
                                                $query=$conn->query($sql);

                                                $sndr = $_SESSION['User_ID'];
                                                $sql_n = "INSERT INTO send_table(User_ID, _sub, _mes, _stat,date_added,_to)
                                                VALUES(
                                                        
                                                        '$sndr',
                                                        'Mayor`s Business Permit Approval',
                                                        'Your Municipal Hall or City Hall Business Permit for $nbn has been Signed and Approved. It can now be claimed! Congratulations!',
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
                                                ('$id1','approve_AllLGU','complete','$id',CURRENT_TIMESTAMP)";
                                                $query=$conn->query($sql);

                                                $sndr = $_SESSION['User_ID'];
                                                $sql_n = "INSERT INTO send_table(User_ID, _sub, _mes, _stat,date_added,_to)
                                                VALUES(
                                                        
                                                        '$sndr',
                                                        'Certificate of Lease or Proof of Contract',
                                                        'Your Certificate of Lease or Proof of Contract for $nbn has been verified, You may now proceed to your BIR Processes',
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