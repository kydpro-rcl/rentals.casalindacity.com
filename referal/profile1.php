<? session_start();
if ($_SESSION['referal']){
  $_GET['main']=1;   $_GET['secund']=1.2;   $_GET['segundo']=1.22;
  require_once('init.php');

   if ($_POST){
		 	$name=$_POST['name']; $lastname=$_POST['lastname']; $email=$_POST['email'];
		 	$url=$_POST['url']; $active=$_POST['active']; $phone=$_POST['phone'];
		 	$percent=$_POST['percent']; $comment=$_POST['comment']; $tipo=$_POST['tipo'];
	        $_GET['id']=$_POST['id'];
         if ($_POST['current_pass']!=$_POST['current_password']){     //hidden field password
             $_GET['error']['pass']="The current password was not correct.";
          }

          if ($_POST['pass']!=$_POST['confirm_pass']){
            $_GET['error']['pass']="The new password did not match with confirmed.";          }

        //--------------------------------------------------------------------------------------------------------------------
          if (trim($_POST['pass'])==""){

            $_GET['error']['pass']="The new password did not match with confirmed.";
          }

            //----------------------------------------------------------------------------------------------------------------
          if (trim($_POST['current_pass'])==""){
             $_GET['error']['pass']="Empty current password.";
          }
          //-------------------------------------------------------------------------------------------------------------------
          if (trim($_POST['confirm_pass'])==""){

            $_GET['error']['pass']="Confirmed password is empty.";
          }


	         if (!$_GET['error']){
			 	$db=new subDB();
			   @ $update_interm=$db->UpdateCommission($_GET['id'], $_POST['pass'], $name, $lastname, $email, $url, $phone, $percent, $comment, $active, $tipo);
			     //-----------------------INSERT OR UPDATE DETAILS-------------------------------------------------------------------------------------
				    $link= new getQueries();
				    $detalles_anterior=$link->show_any_data_limit1('referral_details', 'referral', $_GET['id'], '=');
					  if ($detalles_anterior){ // si existen detalles solo actualizar
					    $db->update_referral_details($detalles_anterior[0]['id'], $_GET['id'], $_POST['cell'], $_POST['agencies'], $_POST['language'], $_POST['question1'], $_POST['answer1'], $_POST['question2'], $_POST['answer2']);
					  }else{   // si no existen detalles entonces insertar
						$db->insert_referral_details($_GET['id'], $_POST['cell'], $_POST['agencies'], $_POST['language'], $_POST['question1'], $_POST['answer1'], $_POST['question2'], $_POST['answer2']);
					  }
			   //----------------------- TERMINA INSERT OR UPDATE DETAILS ----------------------------------------------------------------------------

	             if ($update_interm){
	               	$_GET['main']=1;   $_GET['secund']=1.2;
	               	$_GET['op']['name']='Profile';//new client
	               	$_GET['op']['done']='updated';//view client
	              	dibujar('success');//succeful
		     		die();
	               }

	         	 if (!$update_interm){ echo "Error to insert"; die();}

			 }else{
			     dibujar('profile1');
			     die();
	         }
	}

  dibujar('profile1');
}else{
	header('Location:login.php');
	die();
}
?>