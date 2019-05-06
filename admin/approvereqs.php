<?php

session_start();
require_once 'includes/connect.php';

if (!isset($_SESSION['Username'])) {

    header('location:../index.php');
    exit;

} else {

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
                                        
                                        $sql44 = "SELECT * FROM progress_table WHERE Progress_Status='approve_BNRegister' AND Progress_By='$id' AND Business_ID='$wewe'";
                                        
                                        $query3=$conn->query($sql44);
                                        $data = mysqli_fetch_array($query3);
                                        
                                        $a=$data['Progress_By'];
                                        $b=$data['Progress_Status'];
                                        $c=$data['Business_ID'];
                                        $d1=$data['Progress_ID'];

                                        if($data['Progress_ID'] == $d1 && $b == 'approve_BNRegister'){
                                    
                                    ?>
                    
                                            <fieldset class="field-border">
                                                <legend class="field-border">DTI</legend>
                                                <div class="form-check" style="zoom:1.6">
                                                    <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled value="approve_BNRegister"  id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Business Name Registration
                                                    </label>
                                                </div>
                                    
                                        <?php } else{ ?>
                                        
                                            <fieldset class="field-border" >
                                                <legend class="field-border">DTI</legend>
                                                <div class="form-check" style="zoom:1.6">
                                                    <input class="form-check-input" type="checkbox" name="wewe[]"  value="approve_BNRegister"  id="defaultCheck1">
                                                    
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Business Name Registration
                                                    </label>
                                                </div>
                                        <?php }?>
                                    
                                    <?php
                                        
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_BNVerify' AND Progress_By='$id' AND Business_ID='$wewe'";
                                        $query=$conn->query($sql);
                                        
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                                     
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_BNVerify'){

                                    ?>
                                                
                                        <div class="form-check" style="zoom:1.6">            
                                            <input class="form-check-input" type="checkbox" name="wewe1[]" checked disabled  value="approve_BNVerify" id="defaultCheck12"> 
                                            <label class="form-check-label" for="defaultCheck12">
                                                DTI-BN Form Verification
                                            </label>
                                        </div>
                                
                                    <?php } else{?>
                                        
                                            <div class="form-check" style="zoom:1.6">
                                                <input class="form-check-input" type="checkbox" name="wewe1[]"   value="approve_BNVerify" id="defaultCheck12" >
                                                <label class="form-check-label" for="defaultCheck12">
                                                    DTI-BN Form Verification
                                                </label>
                                            </div>
                                        
                                    <?php } 
                                                   
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_All' AND Progress_By='$id' AND Business_ID='$wewe'";
                                        $query=$conn->query($sql);
                                        
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                             
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_All'){
                                    
                                    ?>
                                        
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe2[]" checked disabled value="approve_All" id="defaultCheck13" >
                                            <label class="form-check-label" for="defaultCheck13">
                                                Wait for Certificate of Registration: Claimed?
                                            </label>
                                        </div>
                                    
                                    <?php } else{?>
                                        
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe2[]"   value="approve_All" id="defaultCheck13" >
                                            <label class="form-check-label" for="defaultCheck13">
                                                Wait for Certificate of Registration: Claimed?
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
                                                            ('$id1','approve_BNRegister','complete','$id',CURRENT_TIMESTAMP)";
                                                $query=$conn->query($sql);
                                                    
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
                                                ('$id1','approve_BNVerify','complete','$id',CURRENT_TIMESTAMP)";
                                                
                                                $query=$conn->query($sql);
                                                    
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
                                                ('$id1','approve_All','complete','$id',CURRENT_TIMESTAMP)";
                                                $query=$conn->query($sql);
                                                    
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