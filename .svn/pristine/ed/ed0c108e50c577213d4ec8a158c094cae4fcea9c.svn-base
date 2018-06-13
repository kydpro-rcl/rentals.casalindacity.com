<?  session_start();
 if ($_SESSION['page2']=="RCL"){
  require_once('init.php');
  if ($_POST){
     if ((trim($_POST['new_pass']!=""))&&(trim($_POST['confirm']!=""))){        if (trim($_POST['new_pass'])==trim($_POST['confirm'])){            $link=new subDB;
			$cambiar_password=$link->change_referral_pass($_SESSION['id_referal'],trim($_POST['new_pass']));
        	$_GET['success']="close";        }else{        	$_GET['error']['psd']="Your new password did not match with confirm password";        }
     }else{
      $_GET['error']['psd']="Please, type your new password on each text box above";     }

  }
  dibujar_clear('forgot_password2');
  }else{
 	die("Private area...");
 }
?>