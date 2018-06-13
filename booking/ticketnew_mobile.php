<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if (($_SESSION['info']['manager']==1)||($_SESSION['info']['report']!=0)){
		$_GET['p']='tick'; $_GET['s']='t.n';
		require_once('init.php');
		
		if($_POST){
			
			if(trim($_POST['details'])==''){
				$_GET['error']="Ticket needs a detail";
			}
			if(!$_GET['error']){
				$db= new DB();
				$deparmentNumber=department_no(trim($_POST['subject']));
				$fields=array('villa_id'=>$_POST['villa_id'],
							  'subject'=>$_POST['subject'], 
							  'details'=>htmlentities(strtolower($_POST['details']), ENT_QUOTES),
							  'status'=>1, 
							  'userid'=>$_SESSION['info']['id'], 
							  'date'=>time(),
							  'department'=>$deparmentNumber,
							  'priority'=>$_POST['priority'],
							  'villastatus'=>$_POST['villastatus'],
							  'arrivalsdate'=>$_POST['arrivingdate']);
				$reporid=$db->insert($fields, $table='reports');
				
				$fields2=array('reportid'=>$reporid,
							  'status'=>1, 
							  'userid'=>$_SESSION['info']['id'],
							  'date'=>time(),
							  'notereasondelegate'=>'');
				$reporthistid=$db->insert($fields2, $table='reporthistory');
				$fromNamelastname=$_SESSION['info']['name'].' '.$_SESSION['info']['lastname'];
				if($deparmentNumber==4){
					$data= new getQueries ();
					$villano=$data->villa_no($_POST['villa_id']);
					$_POST['details'].="<br/>Villa No.: $villano";
					notifyTicketDep_details($deparmentNumber, $details=$_POST['details'], $reporid, $fromNamelastname);
				}else{
					notifyTicketDep($deparmentNumber, $reporid, $fromNamelastname);	
				}
				$_GET['success']="Ticket $reporid successfully created";
			}
		}
		display_mobile('ticketnew_mobile');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>