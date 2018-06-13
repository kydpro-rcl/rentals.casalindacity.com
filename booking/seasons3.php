<?php
 session_start();
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='ad.s';
		require_once('init.php');
		//guardar datos si post
		if ($_POST){
		       $link= new DB();
			   //low season
			    $info=array('start_mont'=>$_POST['lsm'], 
							'start_day'=>$_POST['lsd'], 
							'end_mont'=>$_POST['lem'], 
							'end_day'=>$_POST['led'], 
							'qty_day'=>'', 
							'type'=>$_POST['lowseasontype'], 
							'active'=>1,
							'date'=>time(),
							'admin'=>$_SESSION['info']['id'] 
							);
			   if($_POST['idlow']!=''){
					$link->update_gral($_POST['idlow'], $info, $table='seasons3');
			   }else{
					$link->insert($info, $table='seasons3');
			   }
			   //shoulder season 1
			     $info1=array('start_mont'=>$_POST['ssm'], 
							'start_day'=>$_POST['ssd'], 
							'end_mont'=>$_POST['sem'], 
							'end_day'=>$_POST['sed'], 
							'qty_day'=>'', 
							'type'=>$_POST['shoulderseasontype'], 
							'active'=>1,
							'date'=>time(),
							'admin'=>$_SESSION['info']['id'] 
							);
			   if($_POST['idsh']!=''){
					$link->update_gral($_POST['idsh'], $info1, $table='seasons3');
			   }else{
					$link->insert($info1, $table='seasons3');
			   }
			   //shoulder season 2
			     $info2=array('start_mont'=>$_POST['ssm2'], 
							'start_day'=>$_POST['ssd2'], 
							'end_mont'=>$_POST['sem2'], 
							'end_day'=>$_POST['sed2'], 
							'qty_day'=>'', 
							'type'=>$_POST['shoulderseasontype'], 
							'active'=>1,
							'date'=>time(),
							'admin'=>$_SESSION['info']['id'] 
							);
			   if($_POST['idsh2']!=''){
					$link->update_gral($_POST['idsh2'], $info2, $table='seasons3');
			   }else{
					$link->insert($info2, $table='seasons3');
			   }
			   //high season 
			     $info3=array('start_mont'=>$_POST['hsm'], 
							'start_day'=>$_POST['hsd'], 
							'end_mont'=>$_POST['hem'], 
							'end_day'=>$_POST['hed'], 
							'qty_day'=>'', 
							'type'=>$_POST['highseasontype'], 
							'active'=>1,
							'date'=>time(),
							'admin'=>$_SESSION['info']['id'] 
							);
			   if($_POST['idhigh']!=''){
					$link->update_gral($_POST['idhigh'], $info3, $table='seasons3');
			   }else{
					$link->insert($info3, $table='seasons3');
			   }
			   
		       $_GET['susscee_hs']="New seasons has been successfully saved.";
		}
		display('seasons3');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>