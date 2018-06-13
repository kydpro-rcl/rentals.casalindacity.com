<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='a'; $_GET['s']='a.e';
		require_once('init.php');

		 if ($_POST){


			if ($_FILES['photo']){
				$ruta="images/excursion/";
				$nombre_archivo = $HTTP_POST_FILES['photo']['name'];
				$tipo_archivo = $HTTP_POST_FILES['photo']['type'];
				$tamano_archivo = $HTTP_POST_FILES['photo']['size'];
				$path=$ruta.$nombre_archivo;
				//compruebo si las características del archivo son las que deseo
					if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "JPG")) && ($tamano_archivo < 500000))) {
						   	 $_GET['error']['photo']="Extention should be .gif or jpg and size 500 KB max.";
					}else{
					   	if (move_uploaded_file($HTTP_POST_FILES['photo']['tmp_name'],$path )){
					      	 $photo=$path;
					   	}else{
					      	 $_GET['error']['photo']="There was a problem uploading the photos. We could not save your photo";
					   	}
					}
	        }else{
	        $photo=""; //empty path
	        }


	         if (!$_GET['error']){
			    $db=new subDB();
			    $insert_excursion=$db->insert_excursions($_POST['ti'], $_POST['de'], $_POST['pa'], $_POST['pk'], $_POST['lt'], $_POST['li'],$photo);
			     if ($insert_excursion){
	               	$_GET['p']='a'; $_GET['s']='a.e';
	               	$_GET['op']['name']='Escursion';//new client
	               	$_GET['op']['done']='saved';//view client
	              	display('succefully'); //succeful
		     		die();
	               }
		     }else{
			     display('new_excursion');  //display page with errors
			     die();
	         }
	     }
		display('new_excursion');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>