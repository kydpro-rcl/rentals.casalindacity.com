<?php
session_start();
//if (!$_SESSION['RCL3']=="rcladministraciones") die('Restricted area...');
$_SESSION['RCL4']="rcladministraciones";
unset($_SESSION['RCL']); unset($_SESSION['RCL2']);

require_once('init.php');
$_GET['pasos']=2;
draw('booking_excursions');
?>