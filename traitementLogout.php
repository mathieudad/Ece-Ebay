<?php
session_start();
$_SESSION['Type']="";
$_SESSION['Id']="";
header('Location: index.php');
exit;

 ?>