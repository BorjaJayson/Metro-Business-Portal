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
                                <!-- Department of Trade and Industry -->
                                    <?php
                                                    
                                        $a=4;
                                        $id=intval($_GET['ids']);
                                        
                                        $sql441="SELECT * FROM progress_table WHERE Progress_Status='approve_BNRegister' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query31=$conn->query($sql441);
                                        $data1 = mysqli_fetch_array($query31,MYSQLI_ASSOC);
                                        $a=$data1['Progress_By'];
                                        $b=$data1['Progress_Status'];
                                        $c=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                        
                                        if($data1['Progress_ID']==$d1 && $b=='approve_BNRegister'){
                                    ?>

                                        <legend class="field-border">DTI</legend>
                                            <div class="form-check" style="zoom:1.6">
                                        <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled="disabled" value=""  id="defaultCheck1" required>
                                                            
                                            <label class="form-check-label" for="defaultCheck1">
                                                Business Name Registration
                                            </label>
                                        </div>
                                                    
                                    <?php }else{?>
                                                        
                                        <legend class="field-border">DTI</legend>
                                            <div class="form-check" style="zoom:1.6">
                                                <input class="form-check-input" type="checkbox" name="wewe[]" disabled="disabled"  value="approve_BNRegister"  id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Business Name Registration
                                                </label>
                                            </div>
                                    <?php } ?>
                                    <?php

                                        $a=4;
                                        $id=intval($_GET['ids']);
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_BNVerify' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query=$conn->query($sql);
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                      
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_BNVerify'){
                                    
                                    ?>
                                    

                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled="disabled" value="" id="defaultCheck1" required>
                                            <label class="form-check-label" for="defaultCheck1">
                                                DTI-BN Form Verification
                                            </label>
                                        </div>                                        
                                    
                                    <?php } else{ ?>

                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]"  disabled="disabled" value="" id="defaultCheck1" required>
                                            <label class="form-check-label" for="defaultCheck1">
                                                DTI-BN Form Verification
                                            </label>
                                        </div>

                                    <?php } ?>
                                    <?php
                                        
                                        $a=4;
                                        $id=intval($_GET['ids']);
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_All' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query=$conn->query($sql);
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                   
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_All'){
                                    
                                    ?>
                                        
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled="disabled" value="" id="defaultCheck1" required>
                                            <label class="form-check-label" for="defaultCheck1">
                                                Wait for Certificate of Registration: Claimed?
                                            </label>
                                         </div>

        
                                        
                                    <?php }else{ ?>

                                            <div class="form-check" style="zoom:1.6">
                                                <input class="form-check-input" type="checkbox" name="wewe[]"  disabled="disabled" value="" id="defaultCheck1" required>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Wait for Certificate of Registration: Claimed?
                                                </label>
                                           </div>
                                    <?php }?>

                                    <!-- LGU Starts Here -->
                                    <?php
                                                    
                                        $a=3;
                                        $id=intval($_GET['ids']);
                                        
                                        $sql441="SELECT * FROM progress_table WHERE Progress_Status='approve_brgyBusPerm' AND Progress_By='$a' AND Business_ID='$id'";
                                        
                                        $query31=$conn->query($sql441);
                                        $data1 = mysqli_fetch_array($query31,MYSQLI_ASSOC);
                                        $a=$data1['Progress_By'];
                                        $b=$data1['Progress_Status'];
                                        $c=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                        
                                        if($data1['Progress_ID']==$d1 && $b=='approve_brgyBusPerm'){
                                    ?>

        
                                        <legend class="field-border">LGU</legend>
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled="disabled" value="approve_brgyBusPerm"  id="defaultCheck1" required>
                                                            
                                            <label class="form-check-label" for="defaultCheck1">
                                                Baranggay Business Permit
                                            </label>
                                        </div>
                                                    
                                    <?php }else{?>
     
                                        <legend class="field-border">LGU</legend>
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]" disabled="disabled"  value="approve_brgyBusPerm"  id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Baranggay Business Permit
                                            </label>
                                        </div>
                                    <?php } ?>
                                    <?php

                                        $a=3;
                                        $id=intval($_GET['ids']);
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_MunBusPerm' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query=$conn->query($sql);
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                      
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_MunBusPerm'){
                                    
                                    ?>
                                    

                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled="disabled" value="" id="approve_MunBusPerm" required>
                                            <label class="form-check-label" for="defaultCheck1">
                                               Municipal Hall Business Permit
                                            </label>
                                        </div>                                        
                                    
                                    <?php } else{ ?>

                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]"  disabled="disabled" value="" id="approve_MunBusPerm" required>
                                            <label class="form-check-label" for="defaultCheck1">
                                                Municipal Hall Business Permit
                                            </label>
                                        </div>

                                    <?php } ?>
                                    <?php
                                        
                                        $a=3;
                                        $id=intval($_GET['ids']);
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_AllLGU' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query=$conn->query($sql);
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                   
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_AllLGU'){
                                    
                                    ?>
                                        
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled="disabled" value="approve_AllLGU" id="AllLGU" required>
                                            <label class="form-check-label" for="defaultCheck1">
                                                Proof of Address | Contract of Lease or
                                            </label>
                                         </div>

                                        
                                    <?php }else{ ?>

                                            <div class="form-check" style="zoom:1.6">
                                                <input class="form-check-input" type="checkbox" name="wewe[]"  disabled="disabled" value="approve_AllLGU" id="AllLGU" required>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Proof of Address | Contract of Lease or
                                                </label>
                                           </div>
                                    <?php }?>

                                    <!-- BIR Starts Here -->
                                    <?php
                                                    
                                        $a=2;
                                        $id=intval($_GET['ids']);
                                        
                                        $sql441="SELECT * FROM progress_table WHERE Progress_Status='approve_1901' AND Progress_By='$a' AND Business_ID='$id'";
                                        
                                        $query31=$conn->query($sql441);
                                        $data1 = mysqli_fetch_array($query31,MYSQLI_ASSOC);
                                        $a=$data1['Progress_By'];
                                        $b=$data1['Progress_Status'];
                                        $c=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                        
                                        if($data1['Progress_ID']==$d1 && $b=='approve_1901'){
                                    ?>

        
                                        <legend class="field-border">LGU</legend>
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled="disabled" value="approve_1901"  id="1901" required>
                                                            
                                            <label class="form-check-label" for="defaultCheck1">
                                                BIR Form 1901 | Self-Employment, Mixed Income, Estate and Trust
                                            </label>
                                        </div>
                                                    
                                    <?php }else{?>
     
                                        <legend class="field-border">LGU</legend>
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]" disabled="disabled"  value="approve_1901"  id="1901">
                                            <label class="form-check-label" for="defaultCheck1">
                                                BIR Form 1901 | Self-Employment, Mixed Income, Estate and Trust
                                            </label>
                                        </div>
                                    <?php } ?>
                                    <?php

                                        $a=2;
                                        $id=intval($_GET['ids']);
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_0605' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query=$conn->query($sql);
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                      
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_0605'){
                                    
                                    ?>
                                    

                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled="disabled" value="approve_0605" id="0605" required>
                                            <label class="form-check-label" for="0605">
                                               BIR Form 0605 | Documentary Stamp Tax Return
                                            </label>
                                        </div>                                        
                                    
                                    <?php } else{ ?>

                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]"  disabled="disabled" value="approve_0605" id="0605" required>
                                            <label class="form-check-label" for="0605">
                                                BIR Form 0605 | Documentary Stamp Tax Return
                                            </label>
                                        </div>

                                    <?php } ?>
                                    <?php
                                        
                                        $a=2;
                                        $id=intval($_GET['ids']);
                                        $sql="SELECT * FROM progress_table WHERE Progress_Status='approve_2000' AND Progress_By='$a' AND Business_ID='$id'";
                                        $query=$conn->query($sql);
                                        $data1 = mysqli_fetch_array($query);
                                        $a1=$data1['Progress_By'];
                                        $b1=$data1['Progress_Status'];
                                        $c1=$data1['Business_ID'];
                                        $d1=$data1['Progress_ID'];
                                   
                                        if($data1['Progress_ID']==$d1 && $b1=='approve_2000'){
                                    
                                    ?>
                                        
                                        <div class="form-check" style="zoom:1.6">
                                            <input class="form-check-input" type="checkbox" name="wewe[]" checked disabled="disabled" value="approve_2000" id="2000" required>
                                            <label class="form-check-label" for="2000">
                                                BIR Form 2000 | Remittance Document
                                            </label>
                                         </div>

                                        
                                    <?php }else{ ?>

                                            <div class="form-check" style="zoom:1.6">
                                                <input class="form-check-input" type="checkbox" name="wewe[]"  disabled="disabled" value="approve_2000" id="2000" required>
                                                <label class="form-check-label" for="2000">
                                                    BIR Form 2000 | Remittance Document
                                                </label>
                                           </div>
                                    <?php }?>
                                </form>
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