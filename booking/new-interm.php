<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']<=2){
		$_GET['p']='v'; $_GET['s']='i.n';
		require_once('init.php');
	    if ($_POST){
		 	$name=$_POST['name']; $lastname=$_POST['lastname']; $email=$_POST['email'];
		 	$url=$_POST['url']; $active=$_POST['active']; $phone=$_POST['phone'];
		 	$percent=$_POST['percent']/100; $comment=$_POST['comment'];
		 	$tipo=$_POST['tipo'];

		 	//requerido
		 	// nombre, apellido, email, telefono, porciento
		 	if (!filter_var(trim($name), FILTER_SANITIZE_STRING)) $_GET['error']['name']='Invalid name';//validate caracteres trim
		 	if (!filter_var(trim($lastname), FILTER_SANITIZE_STRING)) $_GET['error']['lastname']='Invalid Last name';

		 	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			  {
			  	$_GET['error']['email']='E-mail is not valid';
			  }

		 	if (!validate_telephone_number($phone)) $_GET['error']['phone']='Wrong phone number';
		 	#if(!filter_var($percent, FILTER_VALIDATE_INT)) { $_GET['error']['percent']='integer value only'; }else{ $percent=($percent/100); }

		 	#$percent //lenght 2, integer

			//$url = "http://www.example.com";
		    if ($url!=''){
				if(!filter_var($url, FILTER_VALIDATE_URL))
				  {
				  $_GET['error']['url']='URL not valid';
				  //echo "URL is not valid";
				  }
				/*else
				  {
				  echo "URL is valid";
				  }*/
			}

	         if (!$_GET['error']){
			 	$db=new DB();
				$info2=array('password'=>$_POST['pass'],
							'name'=>$name,
							'lastname'=>$lastname,
							'email'=>$email,
							'url'=>$url,
							'phone'=>$phone,
							'percent'=>$percent,
							'long_percent'=>($_POST['percentl']/100),
							'comment'=>$comment,
							'date'=>date("Y-m-d G:i:s"),
							'active'=>$active,
							'tipo'=>$tipo,
							'agency'=>$_POST['agency'],
							'agency_user'=>$_POST['agency_user']);
				$insert_interm=$db->insert($info2, $table='commission');
			    #$insert_interm=$db->InsertCommission($_POST['pass'], $name, $lastname, $email, $url, $phone, $percent, ($_POST['percentl']/100), $comment, $active, $tipo);
			    if ($insert_interm){
			     	$_GET['p']='i'; $_GET['s']='i.n';
	               	$_GET['op']['name']='Referral Agent';//new client
	               	$_GET['op']['done']='Saved';//view client
	              	display('succefully'); //succeful
		     		die();
		     	}
			 }else{
			     display('new-interm');
			     die();
	         }
	    }
		display('new-interm');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>