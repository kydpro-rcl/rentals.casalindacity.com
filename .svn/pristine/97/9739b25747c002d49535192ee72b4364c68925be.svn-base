<?php
session_start();
if (!$_SESSION['RCL']=="rcladministraciones") die('Restricted area...');
unset($_SESSION['RCL']);
$_SESSION['RCL1']="rcladministraciones";
require_once('init.php');
$_GET['pasos']=2;
draw('select_excursions');
?>