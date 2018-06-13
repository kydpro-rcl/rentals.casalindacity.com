<?php
 require_once('inc/session.php');

if ($_SESSION['info']){
	
	if($_POST){
		//form submitted
		if(trim($_POST['delegated'])==''){
			$_GET['error']="Ticket needs a delegated person";
		}else{
			if(($_POST['h']==0)&&($_POST['d']==0)){
				$_GET['error']="Ticket needs estimated time";
			}else{
				$estimatedTime = time() + ((60 * 60 * $_POST['h'])+(60*60*24*$_POST['d']));//add hours and days
			}
		}
		#$timeInFuture = time() + (60 * 60 * 24);//24 hours
		//strtotime('+1 day', $timestamp);
		#$timestamp += (60*60*24*7);//7 days

		$_GET['t']=$_POST['ticketno'];
		
		if(!$_GET['error']){
			 require_once('init.php');
			 $db= new DB();
			//change ticket 2 in process
			$fields=array('status'=>2);
			$reporid=$db->update($_POST['ticketno'], $fields, 'reports');
			//insert new ticket history with status=2 in process
			$fields2=array('reportid'=>$_POST['ticketno'],
						  'status'=>2, 
						  'userid'=>$_SESSION['info']['id'],
						  'date'=>time(),
						  'notereasondelegate'=>htmlentities($_POST['delegated'], ENT_QUOTES),
						  'etc'=>$estimatedTime);
			$reporthistid=$db->insert($fields2, 'reporthistory');
			header('Location:reported.php');
		}
		//unset($_POST);
	}
	
	if (($_SESSION['info']['manager']==1)||($_SESSION['info']['report']!=0)){
		$_GET['p']='tick'; $_GET['s']='t.r';
		require_once('init.php');

		display('change2inprocess');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>