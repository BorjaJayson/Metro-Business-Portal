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
            <section class="content">
                <div class="row">
                    <div class="col-md-12 col-centered">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div style="float:left;">
                                    <h3>Business List</h3>
                                </div>
                                <div style="float:right;">
                                    <fieldset class="field-border" style="text-align:left;">
                                        <b>LEGENDS</b> 
                                        <br/><span class="glyphicon glyphicon-check" style="color:green;"></span> Check Requirements
                                        <br/><span class="glyphicon glyphicon-eye-open" style="color:blue;"></span> View Business Information 
                                    </fieldset>
                                </div>
                                <div class="removeMessages"></div>
                         
                                <div style="margin-top:120px;">
                                    <table id="manageinfoTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Business ID</th>
                                                <th>Business Name</th>
                                                <th>Business Owner</th>
                                                <th>Business Type</th>
                                                <th>Requirements Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
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