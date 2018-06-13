<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['manager']==1){
		$_GET['p']='a'; $_GET['s']='a.c';
		require_once('init.php');
		if ($_POST){
		 	$name=$_POST['name'];
	    	$desc=$_POST['desc'];
			$price=$_POST['LSma'];


		 	$_GET['id']=$_POST['id'];
		 	
	         if (!$_GET['error']){
			    $db=new subDB();
			    #$update_service=$db->UpdateAddService($_GET['id'], $name, $price, $desc, $type, $comment, $active, $_POST['pricem'], $_POST['priceHS'], $_POST['priceHSm']);

			   $info_data=array('date'=>time(),
								'admin'=>$_SESSION['info']['id'],
								'descrip'=>$_POST['desc'],
								'price'=>$_POST['price'],
								'tax'=>$_POST['tax'],
								'beds'=>$_POST['beds'],
								'optional'=>$_POST['optional']);
								
			  	$update_service=$insert_service=$db->update_gral($_GET['id'], $info_data, $table='services');

			     if ($update_service){
	               	$_GET['p']='a'; $_GET['s']='a.c';
	               	$_GET['op']['name']='New Service';//new client
	               	$_GET['op']['done']='updated';//view client
	              	display('succefully'); //succeful
		     		//die();
	             }
	         	 if (!$update_service){ echo "Error to insert"; die();}
		     }else{
			     display('services_edit');  //display page with errors
			    /* die();  */
	         }
	    }else{
		display('services_edit');
		}
	}else{
		header('Location:home-welcome.php');
		/*die();  */
	}
}else{
	header('Location:login.php');
	/*die();  */
}
?>