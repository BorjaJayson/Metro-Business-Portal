<?php
session_start();

//unset($_SESSION['username']);
//unset($_SESSION['password']);
  
session_destroy();

// Include URL for Login page to login again.
header("Location: index.php");
exit;
?>

