<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='a'; //$_GET['s']='v.n';
		require_once('init.php');

	    if ($_POST){
	    	$name=$_POST['name']; $type=$_POST['type'];$desc=$_POST['description'];
			$price=$_POST['price'];$active=$_POST['active'];$comment=$_POST['comment'];
		 	//requeridos
		 	//nombre, precio, descripcion
		 	if (!filter_var(trim($name), FILTER_SANITIZE_STRING)) $_GET['error']['name']='Invalid name';//validate caracteres trim
		 	if (!filter_var(trim($desc), FILTER_SANITIZE_STRING)) $_GET['error']['desc']='Invalid description';//validate caracteres trim
		 	//if (!filter_var(trim($price), FILTER_SANITIZE_STRING)) $_GET['error']['price']='Invalid price';//validate caracteres trim
	        //$price=round($price);
	        if(!filter_var($price, FILTER_VALIDATE_INT)) $_GET['error']['price']='Invalid price';
	        //if (!is_int($price)){ $_GET['error']['price']='Invalid price'; }
	         //is_float($price)
	         if (!$_GET['error']){
			    $db=new subDB();
			    $insert_service=$db->InsertAddService($name, $price, $desc, $type, $comment, $active, $_POST['pricem'], $_POST['priceHS'], $_POST['priceHSm']);
			     if ($insert_service){
	               	$_GET['p']='a';
	               	$_GET['op']['name']='service';//new client
	               	$_GET['op']['done']='saved';//view client
	              	display('succefully'); //succeful
		     		die();
	               }
		     }else{
			     display('new-service');  //display page with errors
			     die();
	         }
	     }
		display('new-service');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>