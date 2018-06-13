<? session_start();
if ($_SESSION['referal']){
  $_GET['main']=1;   $_GET['secund']=1.2;    $_GET['segundo']=1.21;
  require_once('init.php');

   if ($_POST){
		 	$name=$_POST['name']; $lastname=$_POST['lastname']; $email=$_POST['email'];
		 	$url=$_POST['url']; $active=$_POST['active']; $phone=$_POST['phone'];
		 	$percent=$_POST['percent']; $comment=$_POST['comment']; $tipo=$_POST['tipo'];
	        $_GET['id']=$_POST['id'];


		 	if (!validate_telephone_number($phone)) $_GET['error']['phone']='Wrong phone number';
		 	//$percent*=100;
		 	//if(!filter_var($percent, FILTER_VALIDATE_INT)) { $_GET['error']['percent']='integer value only'; }else{/*$percent/=100;*/ $percent=($percent/100); }
				//datos del arhivo
			  if ($_FILES['logo']['name']!=''){
				$ruta="images/";
				$nombre_archivo = $_FILES['logo']['name'];
				$tipo_archivo = $_FILES['logo']['type'];
				$tamano_archivo = $_FILES['logo']['size'];
				$path=$ruta.$nombre_archivo;
				//compruebo si las características del archivo son las que deseo
					if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")|| strpos($tipo_archivo, "JPEG") || strpos($tipo_archivo, "JPG") || strpos($tipo_archivo, "jpg")|| strpos($tipo_archivo, "png") || strpos($tipo_archivo, "PNG")) && ($tamano_archivo < 1000000))) {
					  $_GET['error']['logo']="Logo size must be 1 MB max.<br/>"; //$url='new-client.php';

					}else{
					   	if (move_uploaded_file($_FILES['logo']['tmp_name'],"../for_rent1/".$path )){
					      $logo=$path;
					   	}else{
					      $_GET['error']['logo']="There was a problem uploading the photos. We could not save your photo<br/>";
					   	}
					}
	          }else{

	          	$logo=$_POST['oldLogo']; //src is was it was
	          }

	         if (!$_GET['error']){
			 	$db=new DB();$data=new subDB();
			    $update_interm=$data->UpdateCommission($_GET['id'], $_POST['pass'], $name, $lastname, $email, $url, $phone, $percent, $percent_long, $comment, $active, $tipo);
			     //-----------------------INSERT OR UPDATE DETAILS-------------------------------------------------------------------------------------
				    $link= new getQueries();
				    $detalles_anterior=$link->show_any_data_limit1('referral_details', 'referral', $_GET['id'], '=');
					  if ($detalles_anterior){ // si existen detalles solo actualizar
					    $db->upRefLogo($detalles_anterior[0]['id'], $_GET['id'], $_POST['cell'], $_POST['agencies'], $_POST['language'], $_POST['question1'], $_POST['answer1'], $_POST['question2'], $_POST['answer2'], $logo);
					  }else{   // si no existen detalles entonces insertar
						$db->inRefLogo($_GET['id'], $_POST['cell'], $_POST['agencies'], $_POST['language'], $_POST['question1'], $_POST['answer1'], $_POST['question2'], $_POST['answer2'], $logo);
					  }
			   //----------------------- TERMINA INSERT OR UPDATE DETAILS ----------------------------------------------------------------------------

	             if ($update_interm){
	               	$_GET['main']=1;   $_GET['secund']=1.2;
	               	$_GET['op']['name']='Profile';//new client
	               	$_GET['op']['done']='updated';//view client
	              	dibujar('success');//succeful
		     		die();
	               }

	         	 if (!$update_interm){ echo "Error to insert"; die();}

			 }else{
			     dibujar('profile');
			     die();
	         }
	}

  dibujar('profile');
}else{
	header('Location:login.php');
	die();
}
?>