<?php
 session_start();
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='ad.s';
		require_once('init.php');
		//guardar datos si post
		if ($_POST){
		       $link= new DB();
			    $info=array('low_start_month'=>$_POST['lsm'], 
							'low_start_day'=>$_POST['lsd'], 
							'low_end_month'=>$_POST['lem'], 
							'low_end_day'=>$_POST['led'], 
							'sh_start_month'=>$_POST['ssm'], 
							'sh_start_day'=>$_POST['ssd'], 
							'sh_end_month'=>$_POST['sem'], 
							'sh_end_day'=>$_POST['sed'], 
							'sh2_sm'=>$_POST['ssm2'], 
							'sh2_sd'=>$_POST['ssd2'], 
							'sh2_em'=>$_POST['sem2'], 
							'sh2_ed'=>$_POST['sed2'], 
							'high_start_month'=>$_POST['hsm'], 
							'high_start_day'=>$_POST['hsd'], 
							'high_end_month'=>$_POST['hem'], 
							'high_end_day'=>$_POST['hed'], 
							'date'=>time());
			   if($_POST['idseason']!=''){
					$link->update_gral($_POST['idseason'], $info, $table='seasons2');
			   }else{
					$link->insert($info, $table='seasons2');
			   }
		       $_GET['susscee_hs']="New seasons been successfully saved.";
		}
		display('seasons2');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>