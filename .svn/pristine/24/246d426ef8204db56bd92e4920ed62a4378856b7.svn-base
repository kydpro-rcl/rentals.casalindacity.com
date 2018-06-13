<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['manager']==1){
		$_GET['p']='a'; //$_GET['s']='v.n';
		require_once('init.php');
	    if ($_POST){
	    	$name=$_POST['name'];
	    	$desc=$_POST['desc'];
			$price=$_POST['LSma'];
		 	if (!filter_var(trim($name), FILTER_SANITIZE_STRING)) $_GET['error']['name']='Invalid name';//validate caracteres trim
		 	if (!filter_var(trim($desc), FILTER_SANITIZE_STRING)) $_GET['error']['desc']='Invalid description';//validate caracteres trim
	        if(!filter_var($price, FILTER_VALIDATE_FLOAT)) $_GET['error']['price']='Invalid price';
	         if (!$_GET['error']){
			    $db=new subDB();
			    #$insert_service=$db->InsertAddService($name, $price, $desc, $type, $comment, $active, $_POST['pricem'], $_POST['priceHS'], $_POST['priceHSm']);
			    $info_data=array('date'=>date("Y-m-d G:i:s"), 'name'=>$_POST['name'], 'description'=>$_POST['desc'], 'LS_min'=>$_POST['LSmi'], 'LS_max'=>$_POST['LSma'], 'HS_min'=>$_POST['HSmi'], 'HS_max'=>$_POST['HSma'], 'active'=>$_POST['active']);
			  	$insert_service=$db->insert_gral($info_data, $table='carros');

			     if ($insert_service){
	               	$_GET['p']='a';
	               	$_GET['op']['name']='Car Rental';//new client
	               	$_GET['op']['done']='saved';//view client
	              	display('succefully'); //succeful
		     		/*die();  */
	               }
		     }else{
			     display('cars_new');  //display page with errors
			     /*die(); */
	         }
	    }else{
		display('cars_new');
		}
	}else{
		header('Location:home-welcome.php');
		/*die();*/
	}
}else{
	header('Location:login.php');
	/*die();*/
}
?>