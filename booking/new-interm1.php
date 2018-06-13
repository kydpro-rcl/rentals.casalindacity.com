<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']<=2){
		$_GET['p']='i'; $_GET['s']='i.n';
		require_once('init.php');
	    if ($_POST){
		 	$name=$_POST['name']; $lastname=$_POST['lastname']; $email=$_POST['email'];
		 	$url=$_POST['url']; $active=$_POST['active']; $phone=$_POST['phone'];
		 	$percent=$_POST['percent']; $comment=$_POST['comment'];
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
		 	if(!filter_var($percent, FILTER_VALIDATE_INT)) { $_GET['error']['percent']='integer value only'; }else{ $percent=($percent/100); }

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
			 	$db=new subDB();
			    $id_interm=$db->InsertCommission($_POST['pass'], $name, $lastname, $email, $url, $phone, $percent, $_POST['percentl'], $comment, $active, $tipo);
			    if ($id_interm){
			     	$_GET['p']='i'; $_GET['s']='i.n';
	               	$_GET['op']['name']='intermediary';//new client
	               	$_GET['op']['done']='saved';//view client
	              	//display_1('succefully'); //succeful
	              	$_SESSION['referal']['new']=$id_interm; //get id
		     		 //echo $id_interm;
		     		 echo("<meta http-equiv=\"refresh\" content=\"0;url=new-client1.php\">");
		     		die();
		     	}
			 }else{
			     display_1('new-interm1');
			     die();
	         }
	    }
		display_1('new-interm1');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>