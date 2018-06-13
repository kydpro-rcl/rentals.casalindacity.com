<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='u.e';
		require_once('init.php');

		if ($_POST['id']) $_GET['id']=$_POST['id'];

	 	 if ($_POST['update']){
	    	/*$user=trim($_POST['username']); $pass=trim($_POST['password']); */$level=trim($_POST['level']); $name=trim($_POST['name']); $lastname=trim($_POST['lastname']); $email=trim($_POST['email']); $phone=trim($_POST['phone']); $more_info=trim($_POST['info']); $active=trim($_POST['active']);

	         //START VALIDATION
	         if(!empty($name)){
	      		if(!preg_match("#^[-A-Za-z' 'ЯМяАИСЗаимсз]*$#",utf8_decode($name))) $_GET['error']['name']='Invalid name';
	      	}else{
	      		$_GET['error']['name']='empty name';
	      	}
			if(!empty($lastname)){
				if(!preg_match("#^[-A-Za-z' 'ЯМяАИСЗаимсз]*$#",utf8_decode($lastname))) $_GET['error']['lastname']='Invalid Last name';
	        }else{
	      		$_GET['error']['lastname']='empty lastname';
	      	}
	      	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

			  	$_GET['error']['email']='e-mail is not valid';

			}else{
	            $db= new getQueries();
	            $result=$db->checkEmail_others_table($email,'users',$_POST['id']);
	            if ($result[0]['email']==$email){ $_GET['error']['email']='Email already registered';}
			}
            /*
			if(!empty($user)){
	      		//validar usuario
	      		if (!isLength($user,4,8)){
		      		$_GET['error']['user']='Length Min 4 - Max 8';
	      		}else{
	        		//search user name if exist, because username must be unique
	             $data= new getQueries();
	             $r=$data->check_username_others_table($user,'users',$_POST['id']);
	             if($r[0]['user']==$user)$_GET['error']['user']='username busy';
	      		}
	      	}else{
	      		$_GET['error']['user']='empty username';
	      	}
	      	if(!empty($pass)){
	      		//validar pass
	      		if (!isLength($pass,6,12))$_GET['error']['pass']='Length Min 6 - Max 12';
	      	}else{
	      		$_GET['error']['pass']='empty password';
	      	}*/
	        //END VALIDATION

	       if (!$_GET['error']){
				$db=new subDB();
				// $update_user=$db->UpdateUser($_POST['id'], $user, $pass, $level, $name, $lastname, $email, $phone, $more_info, $active);
				$update_user=$db->UpdateUser($_POST['id'], $level, $name, $lastname, $email, $phone, $more_info, $active, $report=$_POST['report'],$_POST['noemails']);
				$_GET['p']='u'; $_GET['s']='u.e';	$_GET['op']['name']='User'; $_GET['op']['done']='Updated';//view client
				display('succefully'); //succeful
				die();
			}else{
				display('edit-user');
				die();
			}
	   	 }

		display('edit-user');
    }else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>