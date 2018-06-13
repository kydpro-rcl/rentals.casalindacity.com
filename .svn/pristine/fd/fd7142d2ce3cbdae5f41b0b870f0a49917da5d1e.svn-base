<?php
 require_once('inc/session.php');
 require_once('init.php');
if ($_SESSION['info']['id']){
	$_GET['p']='b'; $_GET['s']='b.e';	
	$_GET['info']['id']=$_SESSION['info']['id'];
	
	$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
	
	if($_POST){
		//save payments here
	 if(trim($_POST['pamount'])!=0){
		$data=new DB();
		$date=date("Y-m-d G:i:s");
		if(($_POST['ptype']==5)&&($_POST['pclass']==5)&&($_POST['refID']!='')){
			/*search into db this booking and apply transaction as a payment*/
			/*add note into the system*/
			$ref=str_pad($_POST['refID'], 9, "0", STR_PAD_LEFT);
			$db= new getQueries();
			$book=$db->see_occupancy_ref($ref); /*//get reservation details*/
			if (!empty($book)){
				$info0=array('ref'=>$ref,
					'type'=>'5',
					'class'=>'1',
					'amount'=>$_POST['pamount'],
					'transid'=>'',
					'notes'=>'Amount transferred from Booking:'.$_POST['ref'],
					'user'=>$_POST['id_adm'],
					'fecha'=>$date);				
				$data->insert($info0, $table='payments');
			}
			
		}
		
		switch($_POST['ptype']){
			case 1: $tipo="Cash"; break;
			case 2: $tipo="Credit Card"; break;
			case 3: $tipo="Paypal"; break;
			case 4: $tipo="Bank transfer"; break;
			case 5: $tipo="Move to Ref"; break;
			case 6: $tipo="Others"; break;
		}
		switch($_POST['pclass']){
			case 1: $clase="Payment"; break;
			case 2: $clase="Payment Refund"; break;
			case 3: $clase="Security Deposit"; break;
			case 4: $clase="Security Refund"; break;
			case 5: $clase="Transfer to booking"; break;
		}
		
		$info2=array('ref'=>$_POST['ref'],
					'type'=>$_POST['ptype'],
					'class'=>$_POST['pclass'],
					'amount'=>$_POST['pamount'],
					'transid'=>$_POST['refID'],
					'notes'=>$_POST['pnote'],
					'user'=>$_POST['id_adm'],
					'fecha'=>$date);				
		$data->insert($info2, $table='payments');
		$_GET['infoNote1']="$clase of ".$_POST['pamount']." USD successfully applied to the booking by $tipo";	
		unset($_POST['pamount']);/*tu disable refresh*/
	 }else{
		$_GET['infoNote']='Amount is required to apply this transaction';
	 }
	 $_GET['i']=$_POST['i'];
	 $_GET['sh']='y';
	}	
	display('applyPayment');
}else{
	header('Location:login.php');
	die();
}
?>