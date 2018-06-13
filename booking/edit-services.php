<?php
 require_once('inc/session.php');
if ($_SESSION['info']){	if ($_SESSION['info']['level']==1){
		$_GET['p']='a'; $_GET['s']='a.c';
		require_once('init.php');
		 if ($_POST){		 	$name=$_POST['name']; $type=$_POST['type'];$desc=$_POST['description'];
			$price=$_POST['price'];$active=$_POST['active'];$comment=$_POST['comment'];
		 	$_GET['id']=$_POST['id'];
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
			    $update_service=$db->UpdateAddService($_GET['id'], $name, $price, $desc, $type, $comment, $active, $_POST['pricem'], $_POST['priceHS'], $_POST['priceHSm']);

			     if ($update_service){
	               	$_GET['p']='a'; $_GET['s']='a.c';
	               	$_GET['op']['name']='service';//new client
	               	$_GET['op']['done']='updated';//view client
	              	display('succefully'); //succeful
		     		die();
	               }

	         	 if (!$update_service){ echo "Error to insert"; die();}

		     }else{
			     display('edit-services');  //display page with errors
			     die();
	         }
	     }
		display('edit-services');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>