<?php
 require_once('inc/session.php');

if ($_SESSION['info']){
	
	if($_POST){
		//form submitted
		/*if(trim($_POST['delegated'])==''){
			$_GET['error']="Ticket needs a delegated person";
		}*/
		
		$_GET['t']=$_POST['tiketnr'];
		
		if(trim($_POST['price'])!=''){
			if (!filter_var(trim($_POST['price']), FILTER_VALIDATE_INT) === false) {
				//echo("Variable is an integer");
				$precio=trim($_POST['price']);
			} else {
				if (!filter_var(trim($_POST['price']), FILTER_VALIDATE_FLOAT) === false) {
					//echo("Variable is a float");
					$precio=round(trim($_POST['price']));
				}else{
					$_GET['error']='The price requires only numbers';
				}
			}
			//die();
		}
		
		if(!$_GET['error']){
			 require_once('init.php');
			 
			 $data= new getQueries ();
			 $ticket=$data->singleTicket($ticketid=$_POST['tiketnr']);
			 $completedby=$data->ticketHistory($ticket['id'],3);



			 $db= new DB();
			//change ticket 2 in process
			$fields=array('notereasondelegate'=>htmlentities($_POST['delegated'], ENT_QUOTES),'etc'=>$precio);
			$reporid=$db->update($_POST['cno'], $fields, 'reporthistory');
			
			$fields2=array('reportid'=>$ticket['id'],
						  'status'=>6, 
						  'userid'=>$_SESSION['info']['id'],
						  'date'=>time(),
						  'notereasondelegate'=>htmlentities($completedby['notereasondelegate'], ENT_QUOTES),
						  'etc'=>$completedby['etc']);
			$reporid=$db->insert($fields2, 'reporthistory');//
			//insert new ticket history with status=2 in process
			/*$fields2=array('reportid'=>$_POST['ticketno'],
						  'status'=>3, 
						  'userid'=>$_SESSION['info']['id'],
						  'date'=>time(),
						  'notereasondelegate'=>htmlentities($_POST['delegated'], ENT_QUOTES),
						  'etc'=>$precio);
			$reporthistid=$db->insert($fields2, 'reporthistory');*/
			header('Location:ticketcompleted.php');
		}
		//unset($_POST);
	}
	
	if (($_SESSION['info']['manager']==1)||($_SESSION['info']['report']!=0)){
		$_GET['p']='tick'; $_GET['s']='t.c';
		require_once('init.php');

		display('changeTicketPrice');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>