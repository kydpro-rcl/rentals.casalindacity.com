<?php
 require_once('inc/session.php');
if ($_SESSION['info']){

		require_once('init.php');
	    if (($_POST['referal']=="yes")||($_GET['ref']=="yes")){
          echo("<meta http-equiv=\"refresh\" content=\"0;url=new-interm1.php\">");
	    }

	 	if (($_POST['referal']=="no")||($_GET['ref']=="no")){       	 echo("<meta http-equiv=\"refresh\" content=\"0;url=new-client1.php\">");
	 	}
		display_1('referal_customer');

}else{
	header('Location:login.php');
	die();
}
?>