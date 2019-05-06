<?php
$conn = mysqli_connect('localhost', 'root', '', 'capstone42');
if ($conn->connect_error) {

    die("Connection Failed :" . $conn->connect_error);
    
} else {

    //echo "Successfully Connected!";
}

?>