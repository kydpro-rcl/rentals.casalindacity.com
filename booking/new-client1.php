<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='c'; //$_GET['s']='v.n';
	require_once('init.php');
	if ($_POST){

     // start validation
     $name = $_POST['name']; $lastname = $_POST['lastname'];$passport = strtoupper($_POST['passport']);$cedula = $_POST['cedula'];$email = strtolower($_POST['email']);$phone = trim($_POST['phone']);  $phone2 = $_POST['phone2'];
     $fax = $_POST['fax'];$active = $_POST['active'];$language = $_POST['language'];$zip = $_POST['zip'];$country = $_POST['country'];
     $intermediario = $_POST['intermediario']; $password = $_POST['password'];$address = $_POST['address'];/*$info = $_POST['info']; */ //this will disable session info
     $class = $_POST['class']; $comentario = $_POST['info'];  $ename = $_POST['name_emerg']; $ephone = $_POST['phone_emerg'];
     $state=$_POST['state'];
     $city=$_POST['city'];
      //validar email

      	 if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		  {
		  	$_GET['error']['email']='E-mail is not valid';
		  //echo "E-mail is not valid";
		  // display('new-client');    //returs to the form
		 //  die();
		  }else{
            $db= new getQueries();
            $result=$db->checkEmail($email);
           if ($result[0]['email']==$email){ $_GET['error']['email']='Email already registered:'.$result[0]['id'];}

		  }

			if ($phone=="") $_GET['error']['phone']='Required phone number';
			//if (!valName($name))$_GET['error']['name']='Invalid name';

				if (!filter_var($name, FILTER_SANITIZE_STRING)) $_GET['error']['name']='Invalid name';
				if (!filter_var($lastname, FILTER_SANITIZE_STRING)) $_GET['error']['lastname']='Invalid Last name';

			if(!preg_match("#^[-A-Za-z' 'ñíÑáéóúÁÉÍÓÚ]*$#",utf8_decode($name))) $_GET['error']['name']='Invalid name';
			if(!preg_match("#^[-A-Za-z' 'ñíÑáéóúÁÉÍÓÚ]*$#",utf8_decode($lastname))) $_GET['error']['lastname']='Invalid Last name';
			if ($cedula!=''){
				if (!validate_cedula($cedula)){
				$_GET['error']['cedula']='Invalid Cedula';
				}else{

					$db= new getQueries();	$result=$db->checkCedula($cedula);  if ($result[0]['cedula']==$cedula){ $_GET['error']['cedula']='Cedula already registered:'.$result[0]['id'];}
					}
			}

			if ($passport!=''){
			$db= new getQueries();	$result=$db->checkPassport($passport);  if ($result[0]['passport']==$passport){ $_GET['error']['passport']='already registered:'.$result[0]['id'];}
			}
      //validar nombre que no este vacio
      //validar apellido  que no este vacio

		//echo utf8_encode("Escribió en el campo de texto: ") . $cadenatexto . "<br><br>";
         # echo utf8_encode("name typed: ") . $cadenatexto . "<br><br>";
		//datos del arhivo
		if ($HTTP_POST_FILES['photo']['name']!=''){
			$ruta="photos/customers/";
			$nombre_archivo = $HTTP_POST_FILES['photo']['name'];
			$tipo_archivo = $HTTP_POST_FILES['photo']['type'];
			$tamano_archivo = $HTTP_POST_FILES['photo']['size'];
			$path=$ruta.$nombre_archivo;
			//compruebo si las características del archivo son las que deseo
				if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "JPG")) && ($tamano_archivo < 500000))) {
				   #	echo utf8_encode("Extention or size of your picture is not right. <br><br><table><tr><td><li>we allow files .gif o .jpg<br><li>Maximun size allowed is 500 Kb.</td></tr></table>");

				   	 $_GET['error']['photo']="Extention should be .gif or jpg and size 500 KB max.";$url='new-client.php';


				    // display('new-client');    //returs to the form
				    // die();
				}else{
				   	if (move_uploaded_file($HTTP_POST_FILES['photo']['tmp_name'],$path )){
				      	 $photo=$path;

				   	}else{

				      	 #echo "There was a problem uploading the photos. We could not save your photo";
				      	 $_GET['error']['photo']="There was a problem uploading the photos. We could not save your photo";

				   	}
				}
        }else{

        $photo=""; //empty path


        }
     //end valitation

		//SOLO SE INTRODUCEN SI TODO ESTA BIEN
      if (!$_GET['error']){ // if not error save data
	         //$db= new subDB();
			  $info=array('id_commission'=>$intermediario,
						  'pass'=>$password,
						  'name'=>$name,
						  'lastname'=>$lastname,
						  'email'=>$email,
						  'phone'=>$phone,
						  'phone2'=>$phone2,
						  'fax'=>$fax,
						  'cedula'=>$cedula,
						  'passport'=>$passport,
						  'language'=>$language,
						  'zip'=>$zip,
						  'address'=>$address,
						  'country'=>$country,
						  'state'=>$state,
						  'city'=>$city,
						  'photo'=>$photo,
						  'info'=>$comentario,
						  'date'=>FECHA,
						  'active'=>$active,
						  'classify_cust'=>$class,
						  'id_adm'=>$_SESSION['info']['id'],
						  'ename'=>$ename,
						  'ephone'=>$ephone,
						  'id_seller'=>$_POST['sale']);
			  /*$id_client=$db->newCustomers($intermediario, $password, '0', $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario,  $active, $class, $_SESSION['info']['id'], '0', $ename, $ephone);*/
			   $db= new DB;
			   $id_client=$db->insert_gral($info, 'customers');
				if ($class==1){ //insert vip record
				 $vip=$db->vip_record($id_client, $_SESSION['info']['id']);
				}
				/*==========================================================================*/
				if(($intermediario>0) || ($_POST['sale']>0)){
				
					if(($intermediario>0) && ($_POST['sale']>0)){
					 $info2=array('fecha'=>FECHA,
								  '	id_client'=>$id_client,
								  'id_sale'=>$_POST['sale'],
								  'id_rental'=>$intermediario,
								  'active'=>'1');
					  $db->insert_gral($info2, 'clients_referred');
					}elseif($intermediario>0){
					 $info2=array('fecha'=>FECHA,
								  '	id_client'=>$id_client,
								  'id_sale'=>'0',
								  'id_rental'=>$intermediario,
								  'active'=>'1');
					  $db->insert_gral($info2, 'clients_referred');
					}elseif($_POST['sale']>0){
					 $info2=array('fecha'=>FECHA,
								  '	id_client'=>$id_client,
								  'id_sale'=>$_POST['sale'],
								  'id_rental'=>'0',
								  'active'=>'1');
					  $db->insert_gral($info2, 'clients_referred');
					}
				}
	      if ($class==1){ //insert vip record
             $vip=$db->vip_record($id_client, $_SESSION['info']['id']);
		  }

               if ($id_client){
               	$_SESSION['client']['new']=$id_client; //get id of introduce client
               	$_GET['p']='c';
               	$_GET['op']['name']='Customer';//new client
               	$_GET['op']['done']='Created';//view client
              	 display_1('succefully1'); //succeful
              	 //IMPUT CLOSE MAY BE HERE
	     		 die();
               }
         if (!$id_client){ echo "Error to insert";

	     	 //display('succefully'); //show form with error if post and error
	    	 die();  }

      }else{
	     display_1('new-client1'); //show form with error if post and error
	     die();
        }
	}else{
	display_1('new-client1');
	}
}else{
	header('Location:login.php');
	die();
}
?>