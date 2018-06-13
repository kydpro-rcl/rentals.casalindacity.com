<?php
session_start();
//if (!$_SESSION['RCL4']=="rcladministraciones") die('Restricted area...');
$_SESSION['RCL5']="rcladministraciones";

require_once('init.php');

$_GET['pasos']=3;
draw('booking_services');
?>