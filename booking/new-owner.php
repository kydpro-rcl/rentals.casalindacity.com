<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='v'; $_GET['s']='v.no';
		require_once('init.php');
		#display('new-owner');

		if ($_POST){

	     // start validation
	     $name = $_POST['name']; $lastname = $_POST['lastname'];$passport = strtoupper($_POST['passport']);$cedula = $_POST['cedula'];$email = strtolower($_POST['email']);$phone = $_POST['phone'];
	     $fax = $_POST['fax'];$zip = $_POST['zip'];$active = $_POST['active'];$language = $_POST['language'];$country = $_POST['country'];
	     $address = $_POST['address'];$username = $_POST['user'];$password = $_POST['pass'];

	     $comentario = $_POST['info'];

	      if (trim($username)==''){
				$_GET['error']['user']='Username required';
	      }else{
	      	$db= new getQueries();
	        //$result=$db->checkEmail($email);
	        $r=$db->check_username_table($username,'owners');
		    if($r[0]['user']==$username)$_GET['error']['user']='Username already taken';
	      }

	      if (trim($password)==''){
				$_GET['error']['pass']='Password required';
	      }
	      //validar email

	      	 if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			  {
			  	//$_GET['error']['email']='E-mail is not valid';

			  }else{
	            $db= new getQueries();
	            $result=$db->checkEmail_table($email,'owners');
	          //  $result=$db->checkEmail($email);
	           if ($result[0]['email']==$email){ $_GET['error']['email']='Email already registered:'.$result[0]['id'];}
			  }

	          if ($phone!=''){
				if (!validate_telephone_number($phone)) $_GET['error']['phone']='Wrong phone number';
	          }
					if (!filter_var($name, FILTER_SANITIZE_STRING)) $_GET['error']['name']='Invalid name';
					if (!filter_var($lastname, FILTER_SANITIZE_STRING)) $_GET['error']['lastname']='Invalid Last name';


				if(!preg_match("#^[-A-Za-z' '������������]*$#",utf8_decode($name))) $_GET['error']['name']='Invalid name';
				if(!preg_match("#^[-A-Za-z' '������������]*$#",utf8_decode($lastname))) $_GET['error']['lastname']='Invalid Last name';
			  if ($cedula!=''){
				if (!validate_cedula($cedula)){
					$_GET['error']['cedula']='Invalid Cedula';
				}else{

						#$db= new getQueries();	$result=$db->checkCedula($cedula);  if ($result[0]['cedula']==$cedula){ $_GET['error']['cedula']='Cedula already registered:'.$result[0]['id'];}
				}
			  }

			  if ($passport!=''){
				#$db= new getQueries();	$result=$db->checkPassport($passport);  if ($result[0]['passport']==$passport){ $_GET['error']['passport']='already registered:'.$result[0]['id'];}
			  }

			//datos del arhivo
			  if ($HTTP_POST_FILES['photo']['name']!=''){
				$ruta="photos/owners/";
				$nombre_archivo = $HTTP_POST_FILES['photo']['name'];
				$tipo_archivo = $HTTP_POST_FILES['photo']['type'];
				$tamano_archivo = $HTTP_POST_FILES['photo']['size'];
				$path=$ruta.$nombre_archivo;
				//compruebo si las caracter�sticas del archivo son las que deseo
					if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "JPG")) && ($tamano_archivo < 500000))) {
					  $_GET['error']['photo']="Extention should be .gif or .jpg and size 500 KB max."; //$url='new-client.php';

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
	          //rent contrac
	           if ($HTTP_POST_FILES['rent']['name']!=''){
				$ruta2="documents/contracts/";
				$nombre_archivo2 = $HTTP_POST_FILES['rent']['name'];
				$tipo_archivo2 = $HTTP_POST_FILES['rent']['type'];
				$tamano_archivo2 = $HTTP_POST_FILES['rent']['size'];
				$path2=$ruta2.$nombre_archivo2;
				//compruebo si las caracter�sticas del archivo son las que deseo
					if (!((strpos($tipo_archivo2, "pdf") || strpos($tipo_archivo2, "PDF")) && ($tamano_archivo2 < 500000))) {
					  $_GET['error']['rent']="should be .pdf and size 500 KB max."; //$url='new-client.php';

					}else{
					   	if (move_uploaded_file($HTTP_POST_FILES['rent']['tmp_name'],$path2 )){
					      $rent_contract=$path2;
					   	}else{
					      $_GET['error']['rent']="There was a problem uploading rent contract. We could not save your file";
					   	}
					}
	          }else{

	          $rent_contract=""; //empty path


	          }
	         //services contract
	           if ($HTTP_POST_FILES['services']['name']!=''){
				$ruta3="documents/contracts/";
				$nombre_archivo3 = $HTTP_POST_FILES['services']['name'];
				$tipo_archivo3 = $HTTP_POST_FILES['services']['type'];
				$tamano_archivo3 = $HTTP_POST_FILES['services']['size'];
				$path3=$ruta3.$nombre_archivo3;
				//compruebo si las caracter�sticas del archivo son las que deseo
					if (!((strpos($tipo_archivo3, "pdf") || strpos($tipo_archivo3, "PDF")) && ($tamano_archivo3 < 500000))) {
					  $_GET['error']['service']="should be .pdf oand size 500 KB max."; //$url='new-client.php';

					}else{
					   	if (move_uploaded_file($HTTP_POST_FILES['services']['tmp_name'],$path3 )){
					      $serv_contract=$path3;
					   	}else{
					      $_GET['error']['service']="There was a problem uploading services contract. We could not save it";
					   	}
					}
	          }else{
	          	$serv_contract=""; //empty path
	          }
	     //end valitation

			//SOLO SE INTRODUCEN SI TODO ESTA BIEN
	         if (!$_GET['error']){ // if not error save data
		      //introducir aqui en la base de datos
		        $db= new subDB();
		        #$datos=$db->newOwner($username, $password, $name, $lastname, $email, $phone, $_POST['movil'], $fax, $cedula, $passport, $language, $zip, $address, $country, $photo, $rent_contract,$serv_contract, $comentario, $active, $_SESSION['info']['id'],$_POST['cedula2'],$_POST['passport2']);
				
			/*=============================================================================================================*/
			$fecha=date("Y-m-d G:i:s");
			$fields=array(	'user'=>$username,
							'pass'=>$password,
							'name'=>$name,
							'lastname'=>$lastname,
							'company'=>$_POST['company'],
							'RNC'=>$_POST['rnc'],
							'email'=>$email,
							'phone'=>$phone,
							'movil'=>$_POST['movil'],
							'fax'=>$fax,
							'cedula'=>$cedula,
							'passport'=>$passport,
							'language'=>$language,
							'zip'=>$zip,
							'address'=>$address,
							'country'=>$country,
							'photo'=>$photo,
							'contract_rent'=>$rent_contract,
							'contract_serv'=>$serv_contract,
							'info'=>$comentario,
							'date'=>$fecha,
							'active'=>$active,
							'id_adm'=>$_SESSION['info']['id'],
							'cedula2'=>$_POST['cedula2'],
							'passport2'=>$_POST['passport2']
						);
			$table='owners';
			$datos=$db->insert_id($fields, $table);
			/*=============================================================================================================*/
				
				
				
				
	           if ($datos){
	               	$_GET['p']='v'; $_GET['s']='v.no';
	               	$_GET['op']['name']='Owner';//new client
	               	$_GET['op']['done']='Created';//view client
	              	 display('succefully'); //succeful
		     		 die();

	               //echo "insertado";


	          }

	          if (!$datos){ echo "Error to insert";

		     	 //display('succefully'); //show form with error if post and error
		    	 die();
		      }
	         }else{
		     display('new-owner'); //show form with error if post and error
		     die();
	         }
		}else{
		display('new-owner');
		}
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>