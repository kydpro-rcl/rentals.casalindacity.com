<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['manager']==1){
		$_GET['p']='a'; //$_GET['s']='v.n';
		require_once('init.php');
	    if ($_POST){
	    	
		 	
	         if (!$_GET['error']){
			    $db=new subDB();
			    #$insert_service=$db->InsertAddService($name, $price, $desc, $type, $comment, $active, $_POST['pricem'], $_POST['priceHS'], $_POST['priceHSm']);
			    $info_data=array('date'=>time(),
								'admin'=>$_SESSION['info']['id'],
								'descrip'=>$_POST['desc'],
								'price'=>$_POST['price'],
								'tax'=>$_POST['tax'],
								'beds'=>$_POST['beds'],
								'optional'=>$_POST['optional']);
				
			  	$insert_service=$db->insert_gral($info_data, $table='services');

			     if ($insert_service){
	               	$_GET['p']='a';
	               	$_GET['op']['name']='New Service';//new client
	               	$_GET['op']['done']='saved';//view client
	              	display('succefully'); //succeful
		     		/*die();  */
	               }
		     }else{
			     display('new_services');  //display page with errors
			     /*die(); */
	         }
	    }else{
		display('new_services');
		}
	}else{
		header('Location:home-welcome.php');
		/*die();*/
	}
}else{
	header('Location:login.php');
	/*die();*/
}
?>