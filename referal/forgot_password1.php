<?  session_start();
 if ($_SESSION['page1']=="RCL"){

	  require_once('init.php');
      if ($_POST){

        if ((trim($_POST['answer1']!="") && (trim($_POST['answer2']!="")))){
          if ((stripslashes($_POST['answer1'])==stripslashes($_SESSION['ans1'])) && (stripslashes($_POST['answer2'])==stripslashes($_SESSION['ans2'])) ){             unset($_SESSION['page1']); $_SESSION['page2']="RCL";
			 header('Location:forgot_password2.php');
         	// echo "todo esta correcto";

          }else{           $_GET['error']['securities']="Your questions and answers do not match, try again.";
          }




        }else{        	$_GET['error']['securities']="One or both answer(s) is/are empty";        }
	  }
	  dibujar_clear('forgot_password1');
	//echo  $_SESSION['quest1'];


 }else{ 	die("Private area...");
 }
?>