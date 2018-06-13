<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='u.pa';
		require_once('init.php');
		if ($_POST){
              //validate data
          $old_pass=$_POST['old_pass']; $new_pass=$_POST['n_pass']; $verify_pass=$_POST['v_n_pass'];

          if  ($old_pass!=$_SESSION['info']['pass']) $_GET['error']['old_pass']='Old password do not match';

  		  if (($new_pass!='')&&($verify_pass!='')){ //verify new pass
           if  ( $new_pass!=$verify_pass) $_GET['error']['v_new_pass']='Incorrect to verify new password';
          }else{          	if ($new_pass=='') $_GET['error']['new_pass']='Empty new password';
          	if ($verify_pass=='') $_GET['error']['v_new_pass']='Empty verify new password';
          }

          if (!$_GET['error']){
			$db=new DB();
			$change_pas=$db->change_user_pass($_SESSION['info']['id'], $new_pass);
		    $_GET['p']='u'; $_GET['s']='u.pa';	$_GET['op']['name']='password'; $_GET['op']['done']='changed';//view client
		    display('succefully'); //succeful
			die();
		  }else{
			display('pass-user');
			die();
		  }

		}else{
			display('pass-user');
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