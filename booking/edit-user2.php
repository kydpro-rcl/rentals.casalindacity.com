<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='u.e';
		require_once('init.php');

		#if ($_POST['id']) $_GET['id']=$_POST['id'];

	 	 if ($_POST['update']=='Change'){
				$db=new subDB();
				// $update_user=$db->UpdateUser($_POST['id'], $user, $pass, $level, $name, $lastname, $email, $phone, $more_info, $active);
				//$update_user=$db->UpdateUser($_POST['id'], $level, $name, $lastname, $email, $phone, $more_info, $active, $report=$_POST['report'],$_POST['noemails']);
				//$_GET['p']='u'; $_GET['s']='u.e';	$_GET['op']['name']='User'; $_GET['op']['done']='Updated';//view client
				//display('succefully'); //succeful
				$fields=array('user'=>$_POST['user'],
							'pass'=>$_POST['pass'],
							'level'=>$_POST['level'],
							'name'=>$_POST['name'],
							'lastname'=>$_POST['lastname'],
							'email'=>$_POST['email'],
							'phone'=>$_POST['phone'],
							'active'=>$_POST['acti'],
							'contabilidad'=>$_POST['feat'],
							'manager'=>$_POST['mana'],
							'report'=>$_POST['report'],
							'noemails'=>$_POST['noemails'],
							'housekeeping'=>$_POST['hk'],
							'services'=>$_POST['serv'],
							'reception'=>$_POST['rep'],
							'agentes'=>$_POST['agent'],
							'cancelbooking'=>$_POST['cancel'],
							'movevillas'=>$_POST['movi']
						);
				$table='users';
				$villaid=$db->update($id=$_POST['id'],$fields, $table);			
				display('edit-user2');
				die();
	   	 }

		display('edit-user2');
    }else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>