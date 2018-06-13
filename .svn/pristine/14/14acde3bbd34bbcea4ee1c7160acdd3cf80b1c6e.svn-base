<?php
 session_start();
if ($_SESSION['info']){
	if ($_SESSION['info']['level']<=2){
		$_GET['p']='ad'; $_GET['s']='ad.se';
		require_once('init.php');

		if($_POST){         if(trim($_POST['start'])==''){
         	$_GET['error']="Error: Empty Starting Date<br/>";
         }else{
         	if(!is_date($_POST['start']))$_GET['error'].="Error: Starting Date is not a valid date<br/>";
         }
         if(trim($_POST['end'])==''){         	 $_GET['error'].="Error: Empty ending Date<br/>";
         }else{         	 if(!is_date($_POST['end']))$_GET['error'].="Error: Ending Date is not a valid date<br/>";         }
         if(trim($_POST['qty'])==''){ $_GET['error'].="Error: Empty Qty amount/percent<br/>";}else{         	if(!filter_var($_POST['qty'], FILTER_VALIDATE_INT)) $_GET['error'].="Error: Qty amount/percent must be integer numbers only<br/>";
         }
         if(trim($_POST['increase'])==''){ $_GET['error'].="Error: Empty Increase/Dicrease<br/>";}


         if(!$_GET['error']){         //save event
            $db= new DB();
            $date=date("Y-m-d G:i:s");
            $_POST['start']=date('Y-m-d', strtotime($_POST['start'])); $_POST['end']=date('Y-m-d', strtotime($_POST['end']));
            $create_event=$db->insertar_event($_POST['name'], $_POST['start'], $_POST['end'], $_POST['qty'], $_POST['type'], $_POST['increase'], $_POST['status'], $date);
			$_GET['guardado']="New Special Event has been saved";         }		}

		display('special_events_new');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>