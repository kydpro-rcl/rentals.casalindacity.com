<?php
 require_once('inc/session.php');

if ($_SESSION['info']){
 if ($_SESSION['info']['level']<=3){
	$_GET['p']='c'; $_GET['s']='c.e';
	require_once('init.php'); 

	if ($_POST['update']){

     // start validation
     $name = $_POST['name']; $lastname = $_POST['lastname'];$passport = strtoupper($_POST['passport']);$cedula = $_POST['cedula'];$email = strtolower($_POST['email']);$phone = $_POST['phone']; $phone2 = $_POST['phone2'];
     $fax = $_POST['fax'];$active = $_POST['active'];$language = $_POST['language'];$zip = $_POST['zip'];$country = $_POST['country'];
     $intermediario = $_POST['intermediario']; $password = $_POST['password'];$address = $_POST['address'];/*$info = $_POST['info']; */ //this will disable session info
     $class = $_POST['class']; $comentario = $_POST['info']; $ename = $_POST['name_emerg']; $ephone = $_POST['phone_emerg'];
     $state=$_POST['state']; $city=$_POST['city'];
      //validar email

      	 if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		  {
		  	$_GET['error']['email']='E-mail is not valid';
		  }else{
            $db= new getQueries();
            $result=$db->checkEmail_others($email, $_POST['no']);
           if ($result[0]['email']==$email){ $_GET['error']['email']='Email already registered:'.$result[0]['id'];}
		  }

			if ($phone=="") $_GET['error']['phone']='Empty phone number';
				if (!filter_var($name, FILTER_SANITIZE_STRING)) $_GET['error']['name']='Invalid name';
				if (!filter_var($lastname, FILTER_SANITIZE_STRING)) $_GET['error']['lastname']='Invalid Last name';
			if(!preg_match("#^[-A-Za-z' 'ñíÑáéóúÁÉÍÓÚ]*$#",utf8_decode($name))) $_GET['error']['name']='Invalid name';
			if(!preg_match("#^[-A-Za-z' 'ñíÑáéóúÁÉÍÓÚ]*$#",utf8_decode($lastname))) $_GET['error']['lastname']='Invalid Last name';
			if ($cedula!=''){
				if (!validate_cedula($cedula)){
				$_GET['error']['cedula']='Invalid Cedula';
				}else{

					$db= new getQueries();	$result=$db->checkCedula_others($cedula, $_POST['no']);  if ($result[0]['cedula']==$cedula){ $_GET['error']['cedula']='Cedula already registered:'.$result[0]['id'];}
					}
			}

			if ($passport!=''){
			$db= new getQueries();	$result=$db->checkPassport_others($passport, $_POST['no']);  if ($result[0]['passport']==$passport){ $_GET['error']['passport']='already registered:'.$result[0]['id'];}
			}

		if ($HTTP_POST_FILES['photo']['name']!=''){
			$ruta="photos/customers/";
			$nombre_archivo = $HTTP_POST_FILES['photo']['name'];
			$tipo_archivo = $HTTP_POST_FILES['photo']['type'];
			$tamano_archivo = $HTTP_POST_FILES['photo']['size'];
			$path=$ruta.$nombre_archivo;
			//compruebo si las características del archivo son las que deseo
				if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "JPG")) && ($tamano_archivo < 500000))) {
				   	 $_GET['error']['photo']="Extention should be .gif or jpg and size 500 KB max.";$url='new-client.php';
				}else{
				   	if (move_uploaded_file($HTTP_POST_FILES['photo']['tmp_name'],$path )){
				      	 $photo=$path;
				   	}else{
				      	 $_GET['error']['photo']="There was a problem uploading the photos. We could not save your photo";
				   	}
				}
        }else{
         $dat= new getQueries();
			$rr=$dat->customer($_POST['no']);
        $photo=$rr['photo']; //what it has before
        }
     //end valitation

		//SOLO SE INTRODUCEN SI TODO ESTA BIEN
      if (!$_GET['error']){ // if not error save data
	      //introducir aqui en la base de datos
	    $db= new subDB();
	     # $datos=1;
	     $data= new getQueries();
  		 $r=$data->customer($_POST['no']);/* the information for this client to saved as modified*/
	    $id_update=$db->customers_mod($r['id'], $r['id_commission'], $r['online'], $r['pass'], $r['name'], $r['lastname'], $r['email'], $r['phone'],$r['phone2'], $r['fax'], $r['cedula'], $r['passport'], $r['language'], $r['zip'], $r['address'], $r['country'], $r['state'], $r['city'], $r['photo'], $r['info'], $r['active'], $r['classify_cust'], $_SESSION['info']['id'],$r['ename'], $r['ephone']);//return id     		  
		  //$datos=$db->update_Customers($_POST['no'], $intermediario, $password, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario,  $active, $class, $id_update, $ename, $ephone);		   
		 		 
		 $db= new DB;
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
					  'id_update'=>$id_update,
					  'ename'=>$ename,
					  'ephone'=>$ephone,
					  'id_seller'=>$_POST['sale']);
		   $datos=$db->update_gral($_POST['no'], $info, 'customers'); 
		   		   		  
		 /*==========================================================================*/	

		   $agr=AgentClient($tipo='rental',$idclient=$_POST['no']);	#rental agent
		   $ag=AgentClient($tipo='sale',$idclient=$_POST['no']);	#sale agent	
		   
			if(($intermediario>0) || ($_POST['sale']>0)){	#if sale or rental agent info sent			
			
				if($intermediario>0){#si hay id de renta				 
				  if($agr){	
					$diasFechas=days_dates($start=date('Y-m-d',strtotime($agr['fecha'])), $end='');# 18 meses rental
					if(!$diasFechas<AGENTTIME){
						//desabilita el registro encontrado (porque la fecha es valida para ambos id-sale/rental)
						//quito el agente del cliente
						agent_referred_update($agr['id'], $value=0, $type='rental');
						client_agent_update($id=$_POST['no'],$value=0, $type='rental');
						unset($agr);//quitar agente econtrados
					}
				  }
				}
				
				if($_POST['sale']>0){#si hay id de venta				  
				  if($ag){
					$diasFechas=days_dates($start=date('Y-m-d',strtotime($ag['fecha'])), $end='');# 18 meses sales
					if(!$diasFechas<AGENTTIME){#540 dias son 18 meses
					 //desabilita el registro encontrado (porque la fecha es valida para ambos id-sale/rental)
					 //quitar del cliente
					 agent_referred_update($ag['id'], $value=0, $type='sale');
					 client_agent_update($id=$_POST['no'],$value=0, $type='sale');
					 unset($ag);//quitar agente econtrados
					}
				  }
				}
		
				if(($intermediario>0) && ($_POST['sale']>0)){#both agents
				  //get info for agents										
					if($ag && !$agr){#only sales found
						
							 if($ag['id_sale']!=$_POST['sale']){#if agent saved is different
							   if($ag['id_rental']==0){#solo habia sales
								//desabilito el encontrado
								agent_referred_update($ag['id'], $value=0, $type='disable');
							   }else{
								 //actualizo el guardado a cero en sale id
								 agent_referred_update($ag['id'], $value=0, $type='sale');
							   } 
							   //guardo este nuevo agente en nuevo record con sale id y rental id postedo
							    $info2=array('fecha'=>FECHA,
								  'id_client'=>$_POST['no'],
								  'id_sale'=>$_POST['sale'],
								  'id_rental'=>$intermediario,
								  'active'=>'1');
								$db->insert_gral($info2, 'clients_referred');
							 }#si el id de sale es igual ql que habia no se hace nada
						
					}#sales
					
					
					if($agr && !$ag){#only rental found									
							if($agr['id_rental']!=$intermediario){#if agent saved is different
							   if($agr['id_sale']==0){#solo habia rental
								//desabilito el encontrado
								agent_referred_update($agr['id'], $value=0, $type='disable');
							   }else{
							    //actualizo el guardado a cero en rental id
							    agent_referred_update($ag['id'], $value=0, $type='rental');
							   }
							 //guardo este nuevo agente en nuevo record con sale id y rental id postedo
								 $info2=array('fecha'=>FECHA,
								  'id_client'=>$_POST['no'],
								  'id_sale'=>$_POST['sale'],
								  'id_rental'=>$intermediario,
								  'active'=>'1');
								$db->insert_gral($info2, 'clients_referred');
							}# si el id del agente de renta econtrado es el mismo no hago nada al registro						
					}#rental
					
					if($agr && $ag){#if both agents found							
							if(($agr['id_rental']!=$intermediario)&&($ag['id_sale']!=$_POST['sale'])){#ambos id encontrados son differentes a los posteados
							   if($agr['id']==$ag['id']){#si es el mismo record
								//desabilito el encontrado
								agent_referred_update($agr['id'], $value=0, $type='disable');
							   }else{#si son dos records distintos
								 //en cada uno de los records pongo los records de los agentes en cero (de un lado) or desabilitarlo depende del if
								   if($agr['id_sale']==0){#no hay info del otro lado
								    agent_referred_update($agr['id'], $value=0, $type='disable');
								   }else{
								    agent_referred_update($agr['id'], $value=0, $type='rental');#cambiar id a cero en renta del record guardado
								   }								
								   if($ag['id_rental']==0){#no hay info del otro lado
								    agent_referred_update($agr['id'], $value=0, $type='disable');#desabilitar esta referencia
								   }else{
								    agent_referred_update($agr['id'], $value=0, $type='sale');#poner el id de sale en record a cero
								   }																	
							   }
							 //guardo este nuevo agente en nuevo record con sale id y rental id postedo
								$info2=array('fecha'=>FECHA,
								  'id_client'=>$_POST['no'],
								  'id_sale'=>$_POST['sale'],
								  'id_rental'=>$intermediario,
								  'active'=>'1');
								$db->insert_gral($info2, 'clients_referred');
							}elseif(($agr['id_rental']==$intermediario)&&($ag['id_sale']!=$_POST['sale'])){#rental is the same and sale not
								//en el record de sale se debe atualizar a cero
								 agent_referred_update($ag['id'], $value=0, $type='sale');#poner el id de sale en record a cero
								//insertar solo un record con sale y no rental
								$info2=array('fecha'=>FECHA,
								  'id_client'=>$_POST['no'],
								  'id_sale'=>$_POST['sale'],
								  'id_rental'=>'0',
								  'active'=>'1');
								$db->insert_gral($info2, 'clients_referred');
							}elseif(($agr['id_rental']!=$intermediario)&&($ag['id_sale']==$_POST['sale'])){#sale is the same and rental not
							 //en el record de rental se debe actualizar a cero
							 agent_referred_update($agr['id'], $value=0, $type='rental');#cambiar id a cero en renta del record guardado
							 //insertar un nuevo record con solo el id de rental found		
								$info2=array('fecha'=>FECHA,
								  'id_client'=>$_POST['no'],
								  'id_sale'=>'0',
								  'id_rental'=>$intermediario,
								  'active'=>'1');
								$db->insert_gral($info2, 'clients_referred');
							}# si ambos id econtrados son iguales a los posteados no se cambia nada						
					}#rental
				 				  
				 if(!$ag && !$agr){#si no econtre ninguno de los dos agentes
					//no encontre ningun agente
				    $info2=array('fecha'=>FECHA,
							  'id_client'=>$_POST['no'],
							  'id_sale'=>$_POST['sale'],
							  'id_rental'=>$intermediario,
							  'active'=>'1');
				    $db->insert_gral($info2, 'clients_referred');
				  }
				  
				}elseif($intermediario>0){#only agent for rental
					if(($agr)&&($ag)){#if both found
					 //probar que ambos id son iguales o diferentes
					 if($agr['id']==$ag['id']){
						if($agr['id_rental']==$intermediario){
						//solo desabelito el sale a cero, pk no se posteo sale
						agent_referred_update($agr['id'], $value=0, $type='sale');#sale
						}else{
						//desabilito en record para ambos agentes guardados (porque no se postedo sale)
						agent_referred_update($agr['id'], $value=0, $type='disable');#disable
						//creo un nuevo record solo con este nuevo agente
						$info2=array('fecha'=>FECHA,
								  'id_client'=>$_POST['no'],
								  'id_sale'=>'0',
								  'id_rental'=>$intermediario,
								  'active'=>'1');
						$db->insert_gral($info2, 'clients_referred');	
						}
					 }else{#no es el mismo record
						if($agr['id_rental']==$intermediario){
						//no se cambia el record,del rental
						//se desabilita el record del sale
						agent_referred_update($ag['id'], $value=0, $type='disable');#sale
						}else{
						//desabilito ambos record para ambos agentes guardados
						agent_referred_update($agr['id'], $value=0, $type='disable');#rental
						agent_referred_update($ag['id'], $value=0, $type='disable');#sale
						//creo un nuevo record solo con este nuevo agente
						 $info2=array('fecha'=>FECHA,
								  'id_client'=>$_POST['no'],
								  'id_sale'=>'0',
								  'id_rental'=>$intermediario,
								  'active'=>'1');
						$db->insert_gral($info2, 'clients_referred');	
						}					 
					 } 
					}
					
					if(($agr)&&(!$ag)){#only rental found
					 if($agr['id_rental']==$intermediario){
						//no se hace nada porque es el mismo agente guardado que se posteo
						}else{
						//desabilito en record para ambos agentes guardados (porque no se postedo sale)
						agent_referred_update($agr['id'], $value=0, $type='disable');#rental
						//creo un nuevo record solo con este nuevo agente
						$info2=array('fecha'=>FECHA,
								  'id_client'=>$_POST['no'],
								  'id_sale'=>'0',
								  'id_rental'=>$intermediario,
								  'active'=>'1');
						$db->insert_gral($info2, 'clients_referred');	
						}
					}
					if((!$agr)&&($ag)){#only sale found
					 //desabilito el sale encontrado
					 agent_referred_update($ag['id'], $value=0, $type='disable');#rental
					 //creo nuevo record para el agente de renta posteado.
					  $info2=array('fecha'=>FECHA,
								  'id_client'=>$_POST['no'],
								  'id_sale'=>'0',
								  'id_rental'=>$intermediario,
								  'active'=>'1');
					  $db->insert_gral($info2, 'clients_referred');	
					}
					
					if((!$agr)&&(!$ag)){#none found
					  $info2=array('fecha'=>FECHA,
								  'id_client'=>$_POST['no'],
								  'id_sale'=>'0',
								  'id_rental'=>$intermediario,
								  'active'=>'1');
					  $db->insert_gral($info2, 'clients_referred');		
					}																		  
				}elseif($_POST['sale']>0){#only for sale
					if(($agr)&&($ag)){#if both found
					 //probar que ambos id son iguales o diferentes
					 if($agr['id']==$ag['id']){
						if($ag['id_sale']==$_POST['sale']){
						//solo desabelito el rental a cero, pk no se posteo rental
						agent_referred_update($agr['id'], $value=0, $type='rental');#rental
						}else{
						//desabilito los record para ambos agentes guardados (porque no se postedo rental)
						agent_referred_update($ag['id'], $value=0, $type='disable');#disable
						agent_referred_update($agr['id'], $value=0, $type='disable');#disable
						//creo un nuevo record solo con este nuevo agente
						 $info2=array('fecha'=>FECHA,
							  'id_client'=>$_POST['no'],
							  'id_sale'=>$_POST['sale'],
							  'id_rental'=>'0',
							  'active'=>'1');
						 $db->insert_gral($info2, 'clients_referred');
						}
					 }else{#no es el mismo record
						if($ag['id_sale']==$_POST['sale']){
						 //no se cambia el record,del sale
						 //se desabilita el record del rental
						 agent_referred_update($agr['id'], $value=0, $type='disable');#rental
						}else{
						 //desabilito ambos record para ambos agentes guardados
						 agent_referred_update($agr['id'], $value=0, $type='disable');#rental
						 agent_referred_update($ag['id'], $value=0, $type='disable');#sale
						 //creo un nuevo record solo con este nuevo agente
						  $info2=array('fecha'=>FECHA,
							  'id_client'=>$_POST['no'],
							  'id_sale'=>$_POST['sale'],
							  'id_rental'=>'0',
							  'active'=>'1');
						  $db->insert_gral($info2, 'clients_referred');
						}					 
					 } 
					}
					
					if(($agr)&&(!$ag)){#only rental found
					//desabilito el rental encontrado
					 agent_referred_update($agr['id'], $value=0, $type='disable');#rental
					 //creo nuevo record para el agente de venta posteado.
					   $info2=array('fecha'=>FECHA,
							  'id_client'=>$_POST['no'],
							  'id_sale'=>$_POST['sale'],
							  'id_rental'=>'0',
							  'active'=>'1');
				     $db->insert_gral($info2, 'clients_referred');
					}
					if((!$agr)&&($ag)){#only sale found
					 
					 if($ag['id_sale']==$_POST['sale']){
						//no se hace nada porque es el mismo agente guardado que se posteo
					 }else{
						//desabilito en record para ambos agentes guardados (porque no se postedo rental)
						agent_referred_update($ag['id'], $value=0, $type='disable');#both
						//creo un nuevo record solo con este nuevo agente
						 $info2=array('fecha'=>FECHA,
							  'id_client'=>$_POST['no'],
							  'id_sale'=>$_POST['sale'],
							  'id_rental'=>'0',
							  'active'=>'1');
						 $db->insert_gral($info2, 'clients_referred');
					  }
					}
																				
					if((!$agr)&&(!$ag)){#none found
					 $info2=array('fecha'=>FECHA,
							  'id_client'=>$_POST['no'],
							  'id_sale'=>$_POST['sale'],
							  'id_rental'=>'0',
							  'active'=>'1');
				     $db->insert_gral($info2, 'clients_referred');
					}									 
				}
			}else{#si no se postearon agentes para este cliente
			//deshabilitar cualquier agente que tenga este cliente
			 client_agent_update($id=$_POST['no'],$value=0, $type='sale');
			 client_agent_update($id=$_POST['no'],$value=0, $type='rental');
			//deshabilito cualquier referencia en table referrido de agentes
				if($agr){
				 agent_referred_update($agr['id'], $value=0, $type='disable');#desabilitar esta referencia, en todo caso este cliente no debe tener agentes					 
				}
				if($ag){
					agent_referred_update($ag['id'], $value=0, $type='disable');#desabilitar esta referencia en todos casos este cliente no debe tener agente
				}					
			}
			 /*==========================================================================*/
			if (($class==1)&&($r['classify_cust']==0)){ //insert vip record
             $vip=$db->vip_record($_POST['no'], $_SESSION['info']['id']);
		  	}
               if ($datos){
               	$_GET['p']='c';
               	$_GET['op']['name']='Customer';//new client
               	$_GET['op']['done']='Updated';//view client
              	display('succefully'); //succeful
	     		   die();
               }
         if (!$datos){ echo "Error to insert";
	     	 //display('succefully'); //show form with error if post and error
	      die();
	     }
      }else{
	     display('edit-clients'); //show form with error if post and error
	     die();
      }
	}else{
	$_POST['no']=$_POST['no'];
	display('edit-clients');
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
