<?php
include "config.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stat = $db->prepare("SELECT * FROM requirement_table WHERE id=?");
    $stat->bindParam(1, $id);
    $stat->execute();
    $data = $stat->fetch();

    $file = 'media/'.$data['filename'];

    if(file_exists($file)){
        header('Content-Description: '. $data['description']);
        header('Content-Type: '.$data['type']);
        header('Content-Disposition: '.$data['disposition'].'; filename="'.basename($file).'"');
        header('Expires: '.$data['expires']);
        header('Cache-Control: '.$data['cache']);
        header('Pragma: '.$data['pragma']);
        header('Content-Length: '.filesize($file));
        readfile($file);
        exit;
    }
}