<?php
    session_start();
    require_once '../includes/connect.php';

    if (!isset($_SESSION['Username'])) {
        header('location:index.php');
        exit;
    } else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Files to download</title>
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="../MetroBusinessPortal.css" rel="stylesheet"/>
    <?php include "../includes/userHeader.php"; ?>
</head>
<body>

    <p><br/></p>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>File Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>DTI | Business Name Form</td>
                    <td class="text-center"><a href="media/DTI_BNForm.pdf" class="btn btn-primary" download>Download</a></td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>LGU | Triplicate Business Registration Form</td>
                    <td class="text-center"><a href="media/CH_TriplicateBusRegForm.pdf" class="btn btn-primary" download>Download</a></td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>BIR | Form 2000</td>
                    <td class="text-center"><a href="media/BIR_2000.pdf" class="btn btn-primary" download>Download</a></td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>BIR | Form 1901</td>
                    <td class="text-center"><a href="media/BIR_1901.pdf" class="btn btn-primary" download>Download</a></td>
                </tr> 

                <tr>
                    <td>5</td>
                    <td>BIR | 0605</td>
                    <td class="text-center"><a href="media/BIR_0605.pdf" class="btn btn-primary" download>Download</a></td>
                </tr>

                
            </tbody>
        </table>
        <a href="../PortalHome1.php" class="btn btn-secondary">Go Back</a>

    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php }?>