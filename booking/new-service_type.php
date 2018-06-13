<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='a'; $_GET['s']='a.t';
		require_once('init.php');

	    if ($_POST){	    	if ($HTTP_POST_FILES['pic']['name']!=''){
			$ruta="../for_rent/images/";
			$nombre_archivo = $HTTP_POST_FILES['pic']['name'];
			$tipo_archivo = $HTTP_POST_FILES['pic']['type'];
			$tamano_archivo = $HTTP_POST_FILES['pic']['size'];
			$path=$ruta.$nombre_archivo;
			//compruebo si las características del archivo son las que deseo
				if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "JPG") || strpos($tipo_archivo, "png")|| strpos($tipo_archivo, "PNG")) && ($tamano_archivo < 900000))) {
				   	 $_GET['error']['photo']="Extention should be .gif or jpg and size 900 KB max.";
				}else{
				   	if (move_uploaded_file($HTTP_POST_FILES['pic']['tmp_name'],$path )){
				      	 $photo=$nombre_archivo;
				   	}else{
				      	 $_GET['error']['photo']="There was a problem uploading the photos. We could not save your photo";
				   	}
				}
	        }else{
	        $photo=""; //empty path
	        }

	         if (!$_GET['error']){
			    $db=new subDB();
			    $insert_service=$db->insert_type_serv($t=$_POST['type'], $p=$photo, $m=$_POST['msg'], $nl=$_POST['nl'], $l=$_POST['url']);
			     if ($insert_service){
	               	$_GET['p']='a';
	               	$_GET['op']['name']='Service Type';//new client
	               	$_GET['op']['done']='saved';//view client
	              	display('succefully'); //succeful
		     		die();
	               }
		     }
	     }
		display('new-service_type');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>