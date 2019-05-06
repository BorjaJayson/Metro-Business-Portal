<?php 
require_once 'includes/pdoConnect.php';
if(isset($_GET['id'])){
$id =$_GET['id'];
$sql=$db->prepare("SELECT * FROM upload_table WHERE file_ID=?");
$sql->bindParam(1, $id);
$sql->execute();
$data = $sql->fetch();

$file ='../uploads/'.$data['file_name'];

if(file_exists($file)){
	header('Content-Description: '.$data['description']);
    header('Content-Type: '.$data['type']);
    header('Content-Disposition: '.$data['disposition'].'; filename="'.basename($file).'"');
    header('Expires'.$data['expires']);
    header('Cache-Control: '.$data['cache']);
    header('Pragma: '.$data['pragma']);
    header('Content-Length: '.filesize($file));
    readfile($file);
    exit;

	}
}