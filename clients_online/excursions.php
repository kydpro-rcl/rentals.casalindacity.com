<?php
session_start();
//if (!$_SESSION['RCL']=="rcladministraciones") die('Restricted area...');
//unset($_SESSION['RCL']);
//$_SESSION['RCL1']="rcladministraciones";
	if ($_SESSION['cust_online']){
		require_once('init.php');
		$_GET['pasos']=2;
		salida('excursions');
	}else{
	 header('Location:login.php');
	}
?>