<? session_start();
if ($_SESSION['owner']){
  $_GET['main']=4;  // $_GET['secund']=1.1;
  require_once('init.php');
  // print_r($_SESSION['owner']);
  if ($_POST){

		     $email = strtolower($_POST['email']);$phone = $_POST['phone'];
		     $movil=$_POST['movil']; $address = $_POST['address'];
		     $username = $_POST['user'];
		     $language = $_POST['language'];  $country = $_POST['country'];
            //----------------------------------------------------------------------------------------------------------------
             $_GET['id']=$_POST['id'];$_GET['error']="";
             $link= new getQueries();
	         $owner=$link->show_id('owners', $_GET['id']);//get information saved for this owner
	         $ow=$owner[0];
	         //------------------------------------------------------------------------------------------------------------------
             //VALIDATE EMAIL
               if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  	$_GET['error'].="E-mail is not valid<br/>";
			  }else{
	           // $db= new getQueries();
	            //$result=$db->checkEmail_table($email,'owners');
	            $result=$link->checkEmail_others_intable($email, $_GET['id'], 'owners');
	           if ($result[0]['email']==$email){ $_GET['error'].='Email already registered:'.$result[0]['id']."<br/>";}
			  }
             //VALIDATE PHONE NUMBER
              if (trim($phone)==''){
				$_GET['error'].="Phone number is required<br/>";
	          }
             //VALIDATE USERNAME
               if (trim($username)==''){
				$_GET['error'].='Username required<br/>';
		      }else{
		      	//$db= new getQueries();
		        $r=$link->check_username_others_table($username,'owners',$_GET['id']);//check username for others owners
			    if($r[0]['user']==$username) $_GET['error'].='Username already taken by other owner<br/>';
			    //$_GET['error']['user']='Username already taken by ('.$r[0]['id'].')';
		      }
             //VALIDATE PASSWORD
             if(trim($_POST['actual_pass'])!=''){   //if actual password is not empty
             	if ($_POST['actual_pass']==$ow['pass']){  //if actual password is the same as in db for this owner

	             	if(trim($_POST['new_pass'])=='' || trim($_POST['confirm_pass'])==''){ //verify that new password or confirm new password are not empty
	             		$_GET['error'].="New password and/or confimation password is empty<br/>";
	             	}else{
	             		if(trim($_POST['new_pass'])==trim($_POST['confirm_pass'])){// verify that new pass and confirm pass are the same
	             			$password =trim($_POST['new_pass']); //$password is the new one
	             		}else{
	             			$_GET['error'].="New password and confimation mismatch<br/>";
	             		}
                    }
             	}else{
             		$_GET['error'].="Actual Password is incorrect<br/>";
             	}
               //$password =trim($_POST['actual_pass']);
             }else{
	         	$password =$ow['pass'];
	         }
          /*
			  if (trim($username)==''){
				$_GET['error']['user']='Username required';
		      }else{
		      	$db= new getQueries();
		        $r=$db->check_username_others_table($username,'owners',$_GET['id']);//check username for others owners
			    if($r[0]['user']==$username)$_GET['error']['user']='Username already taken by ('.$r[0]['id'].')';
		      }

		      if (trim($password)==''){
					$_GET['error']['pass']='Password required';
		      }

	     	$comentario = $_POST['info'];
	        //validar email

	      	 if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			  {
			  	$_GET['error']['email']='E-mail is not valid';

			  }else{
	            $db= new getQueries();
	            //$result=$db->checkEmail_table($email,'owners');
	            $result=$db->checkEmail_others_intable($email, $_GET['id'], 'owners');
	           if ($result[0]['email']==$email){ $_GET['error']['email']='Email already registered:'.$result[0]['id'];}
			  }

	          if ($phone!=''){
				//if (!validate_telephone_number($phone)) $_GET['error']['phone']='Wrong phone number';
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
               */
			//datos del arhivo
			  if ($HTTP_POST_FILES['photo']['name']!=''){
				$ruta="photos/owners/";
				$nombre_archivo = $HTTP_POST_FILES['photo']['name'];
				$tipo_archivo = $HTTP_POST_FILES['photo']['type'];
				$tamano_archivo = $HTTP_POST_FILES['photo']['size'];
				$path=$ruta.$nombre_archivo;
				//compruebo si las caracter�sticas del archivo son las que deseo
					if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "JPG") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "png") || strpos($tipo_archivo, "PNG")) && ($tamano_archivo < 900000))) {
					  $_GET['error'].="Extention should be .gif, .jpg or .png and size 900 KB max.<br/>"; //$url='new-client.php';

					}else{
					   	if (move_uploaded_file($HTTP_POST_FILES['photo']['tmp_name'],"../booking/".$path )){
					      $photo=$path;
					   	}else{
					      $_GET['error'].="There was a problem uploading the photos. We could not save your photo<br/>";
					   	}
					}
	          }else{

	          	$photo=$ow['photo']; //src is was it was
	          }
            /*

	     //end valitation

			//SOLO SE INTRODUCEN SI TODO ESTA BIEN   */
	         if (!$_GET['error']){ // if not error save data
		      //introducir aqui en la base de datos
		          $db= new subDB();
		          $name=$ow['name']; $fax=$ow['fax'];
		          $lastname=$ow['lastname']; $cedula=$ow['cedula'];
		          $passport=$ow['passport']; $zip=$ow['zip'];
		          $rent_contract=$ow['contract_rent'];  $serv_contract=$ow['contract_serv'];
		          $comentario=$ow['info'];  $active=$ow['active'];
		          $idadmin='';

		        $datos=$db->UpdateOwner($_GET['id'], $username, $password, $name, $lastname, $email, $phone, $movil, $fax, $cedula, $passport, $language, $zip, $address, $country, $photo, $rent_contract, $serv_contract, $comentario, $active, $idadmin);
                 $_GET['note']="Your profile has been successfully changed.";
		         salida('profile');//go to profile instead to return to the edition form
		         die();//kill the script here
		     }
		    /*      if ($datos){
		             $_GET['p']='v'; $_GET['s']='v.e';
		             $_GET['op']['name']='Owner';//new client
		             $_GET['op']['done']='Created';//view client
		             display('succefully'); //succeful
			     	 die();
		          }

		          if (!$datos){
		          	echo "Error to insert";
			    	die();
			      }

	         }else{
		     display('edit-owner-details'); //show form with error if post and error
		     die();
	         } */
  }//END IF POST

  salida('edit_profile');
}else{
	header('Location:login.php');
	die();
}
?>