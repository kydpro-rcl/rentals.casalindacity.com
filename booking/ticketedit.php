<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	require_once('init.php');
	if (($_SESSION['info']['manager']==1)||($_SESSION['info']['report']!=0)){
		if($_POST){
			$_GET['t']=$_POST['ticketno'];
		}
		$data= new getQueries ();
		$ticket=$data->singleTicket($ticketid=$_GET['t']);
		if (($_SESSION['info']['report']!=6)&&($_SESSION['info']['report']!=$ticket['department'])){
			//notify admin who and when and ticket
			die('Fatal Error: You are not allow to change this ticket');
		}
		//echo $ticket['status'];
		//die();
		
		switch($ticket['status']){
			case 1://reported
					$_GET['p']='tick'; $_GET['s']='t.r';
					break;
			case 2://in process
					$_GET['p']='tick'; $_GET['s']='t.i';
					break;
			case 3://completed
					$_GET['p']='tick'; $_GET['s']='t.c';
					//notify admin who and when and ticket
					die('Fatal Error: A completed ticket can not be changed');
					break;
			case 4://completed
					$_GET['p']='tick'; $_GET['s']='t.c';
					//notify admin who and when and ticket
					die('Fatal Error: A Cancelled ticket can not be changed');
					break;
			default: //reported
					$_GET['p']='tick'; $_GET['s']='t.r';
		}
		
		
		
		if($_POST){
			
			if(trim($_POST['details'])==''){
				$_GET['error']="Ticket needs a detail";
			}
			if(!$_GET['error']){
				$db= new DB();
				$deparmentNumber=department_no(trim($_POST['subject']));
					if($ticket['subject']!=$_POST['subject']){/*only if they change the subject*/
						$fields=array('villa_id'=>$_POST['villa_id'],
								  'subject'=>$_POST['subject'], 
								  'details'=>htmlentities($_POST['details'], ENT_QUOTES),
								  'status'=>$_POST['status'], 
								  'userid'=>$_SESSION['info']['id'], 
								  'date'=>time(),
								  'department'=>$deparmentNumber,
								  'priority'=>$_POST['priority'],
								  'villastatus'=>$_POST['villastatus'],
								  'arrivalsdate'=>$_POST['arrivingdate']);
					}else{
						$fields=array('villa_id'=>$_POST['villa_id'],
								  'subject'=>$_POST['subject'], 
								  'details'=>htmlentities(strtolower($_POST['details']), ENT_QUOTES),
								  'status'=>$_POST['status'], 
								  'department'=>$deparmentNumber,
								  'priority'=>$_POST['priority'],
								  'villastatus'=>$_POST['villastatus'],
								  'arrivalsdate'=>$_POST['arrivingdate']);
					}		  
				$db->update($ticket['id'], $fields, $table='reports');
				$reporid=$ticket['id'];
				$fields2=array('reportid'=>$reporid,
							  'status'=>5, 
							  'userid'=>$_SESSION['info']['id'],
							  'date'=>time(),
							  'notereasondelegate'=>'');
				$reporthistid=$db->insert($fields2, $table='reporthistory');
				$fromNamelastname=$_SESSION['info']['name'].' '.$_SESSION['info']['lastname'];
				if($ticket['subject']!=$_POST['subject']){/*only if they change the subject*/
					notifyTicketDep1($deparmentNumber, $reporid, $fromNamelastname);	//notify update of ticket
					//$_GET['success']="Ticket $reporid successfully created";
				}
				switch($ticket['status']){
					case 1://reported
							header('Location:reported.php');
							break;
					case 2://in process
							header('Location:reported.php');
							break;
					case 3://completed
							header('Location:ticketcompleted.php');
							break;
					default: //reported
							header('Location:reported.php');
				}
		
			}
		}
		display('ticketedit');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>