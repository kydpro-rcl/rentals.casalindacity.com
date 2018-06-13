<?
session_start();
require_once('init.php');
 if ($_POST){
 $_POST['email']=trim($_POST['email']);

   if (!empty($_POST['email'])){
   	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    	$_GET['error']['email']='E-mail is not valid';
   	}else{
      $db=new getQueries();

		$referral=$db->show_any_data('commission', 'email', $_POST['email'], '=');
		/*print_r($referral);*/
		if ($referral){


		     if ($referral[0]['active']==1){
		     	/*$id_referal=$referral[0]['id'];*/
		     		/*$referral_details=$db->show_any_data('referral_details', 'referral', $id_referal, '=');*/
			     /*	$question1=$referral_details[0]['question1'];
			     	$answer1=$referral_details[0]['answer1'];
			     	$question2=$referral_details[0]['question2'];
			     	$answer2=$referral_details[0]['answer2'];

				$_SESSION['quest1']=$question1;
				$_SESSION['ans1']=$answer1;
				$_SESSION['quest2']=$question2;
				$_SESSION['ans2']=$answer2;
				$_SESSION['id_referal']=$id_referal;*/
				$password=$referral[0]['password'];
				 
				 $body_agent='Dear '.$referral[0]['name'].' '.$referral[0]['lastname']."\n\n Here is your password ($password) as per your request, please, contact us for more information. \n\n ";
					
					referralForgotPwd($referral[0]['email'], $body_agent);
								
                 /*header('Location:forgot_password1.php');*/
                 $_SESSION['page1']="RCL";
					$_GET['error']['email']="Your password has been sent to your email";

		     }else{

		     	$_GET['error']['email']="You had been disable form our system, please <a href=\"http://www.casalindacity.com/contact.php\" alt=\"\" target=\"_blank\">contact us</a> for more information";
		     }



		}else{

			$_GET['error']['email']="This email is not registered";
		}


   	}// do this only when email is valid
   }else{$_GET['error']['email']='E-mail is empty';}
 }

  dibujar_clear('forgot_password');
?>