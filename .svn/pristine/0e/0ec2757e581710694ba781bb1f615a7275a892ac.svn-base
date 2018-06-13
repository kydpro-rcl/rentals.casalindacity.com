<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='u.p';
		require_once('init.php');

		if ($_POST){
          //validate data
          $name=$_POST['name'];     $lastname=$_POST['lastname'];    $email=$_POST['email'];  $phone=$_POST['phone']; $details=$_POST['info'];
          if(!empty($name)){ //verify name
		    if(!preg_match("#^[-A-Za-z' 'ЯМяАИСЗаимсз]*$#",utf8_decode($name))) $_GET['error']['name']='Invalid name';
		  }else{
		    $_GET['error']['name']='empty name';
		  }

		  if(!empty($lastname)){ //verify lastname
			if(!preg_match("#^[-A-Za-z' 'ЯМяАИСЗаимсз]*$#",utf8_decode($lastname))) $_GET['error']['lastname']='Invalid Last name';
		  }else{
		  	$_GET['error']['lastname']='empty lastname';
		  }

		  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){   //verify email

			$_GET['error']['email']='e-mail is not valid';

		  }else{
		    $db= new getQueries();
		    $result=$db->checkEmail_others_table($email, 'users', $_SESSION['info']['id']);
		    if ($result[0]['email']==$email){ $_GET['error']['email']='Email already registered';}
		  }

          if (!$_GET['error']){
			$db=new DB();
			$updateProfile=$db->profile_user($_SESSION['info']['id'], $name, $lastname, $email, $phone, $details);
		    $_GET['p']='u'; $_GET['s']='u.p';	$_GET['op']['name']='profile'; $_GET['op']['done']='updated';//view client
		    display('succefully'); //succeful
			die();
		  }else{
			display('profile-user');
			die();
		  }


		}else{			display('profile-user');
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