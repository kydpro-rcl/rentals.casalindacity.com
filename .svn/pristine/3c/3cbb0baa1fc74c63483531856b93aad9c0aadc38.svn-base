<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	require_once('init.php');
	if (($_SESSION['info']['manager']==1)||($_SESSION['info']['report']!=0)){
		
		if($_POST){
			$_GET['cancel']=$_POST['ticketno'];
		}
		
		if($_GET['cancel'])	{/*================START CANCELLING*/
			$data= new getQueries ();
			$ticket=$data->singleTicket($ticketid=$_GET['cancel']);
			
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
						break;
				default: //reported
						$_GET['p']='tick'; $_GET['s']='t.r';
			}
				
			if($_POST){
				
				if(trim($_POST['details'])==''){
					$_GET['error']="Ticket needs a reason";
				}
				if(!$_GET['error']){	
					if (($_SESSION['info']['report']!=6)&&($_SESSION['info']['report']!=$ticket['department'])){
						//notify admin who and when and ticket
						die('Fatal Error: You are not allow to CANCEL this ticket');
					}else{
						//si no esta cancela
						if($ticket['status']!=4){
							//cancel ticket
							$db= new DB();
							$fields=array( 'status'=>4);
							$db->update($ticket['id'], $fields, $table='reports');
							//save record
							$reporid=$ticket['id'];
							$fields2=array('reportid'=>$reporid,
										  'status'=>4, 
										  'userid'=>$_SESSION['info']['id'],
										  'date'=>time(),
										  'notereasondelegate'=>$_POST['details']);
							$reporthistid=$db->insert($fields2, $table='reporthistory');
							$fromNamelastname=$_SESSION['info']['name'].' '.$_SESSION['info']['lastname'];
							//inform to creator and department
							$proccess=$data->ticketHistory($reporid, 1);//creator user
							$userDetails=$data->displayUserDetails($proccess['userid']);
							notifyTicketCancel($ticket['department'], $reporid, $fromNamelastname, $userDetails);	//notify update of ticket
							header('Location:ticketcancelled.php');
							die();
						}else{
							die('Fatal Error: ticket previously cancelled');
						}
					}
				}
			}
			//echo $ticket['status'];
		}/*================END CANCELLING*/

		display('ticketcancel');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>