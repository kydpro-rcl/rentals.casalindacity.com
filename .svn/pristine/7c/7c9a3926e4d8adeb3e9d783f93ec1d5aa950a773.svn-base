<?php
session_start();
//if (!$_SESSION['RCL1']=="rcladministraciones") die('Restricted area...');
	if ($_SESSION['cust_online']){

	require_once('init.php');

	//$_GET['pasos']=3;
	salida('services');
	}else{	 header('Location:login.php');	}
?>