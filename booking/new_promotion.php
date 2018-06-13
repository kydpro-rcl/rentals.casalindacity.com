<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='pro.n';
		require_once('init.php');

		if (!$_POST['save']){
		 display('new_promotion');
		}else{
		  	$_POST['promotion_code']=trim($_POST['promotion_code']);
          	if ($_POST['promotion_code']=="") $_GET['error']['code']="Promotion Code is Required";

           	$_POST['desde']=trim($_POST['desde']);
          	if ($_POST['desde']=="") $_GET['error']['desde']="From Date is Required";
          	if ($_POST['desde']!=""){
             if (!is_date($_POST['desde'])) $_GET['error']['desde']="Start Date is not valid";
          	}

     		$_POST['hasta']=trim($_POST['hasta']);
          	if ($_POST['hasta']=="")  $_GET['error']['hasta']="To Date is Required";
            if ($_POST['hasta']!=""){
             if (!is_date($_POST['hasta'])) $_GET['error']['hasta']="End Date is not valid";
           }

           if((trim($_POST['pro_type'])=="2")||(trim($_POST['pro_type'])=="1")){
	      		$_POST['monto_porc']=trim($_POST['monto_porc']);
	          	if ($_POST['monto_porc']=="")  $_GET['error']['percent']="A quantity is required";
	       }
          	//--------------------------------------------------------------------------------------

          	if(trim($_POST['pro_type'])=="3"){
              if(trim($_POST['mdays'])=="0"){  //minimun days
               		$_GET['error']['dias']="Minimun days required";
              }
             /* if(trim($_POST['ddays'])=="0"){  //discount days
               		$_GET['error']['dias']="Discount days required";
              }
              if((trim($_POST['mdays']))<=(trim($_POST['ddays']))){  //comparar cantidad
               		$_GET['error']['dias']="Discount day must be minor than min. days";
              }*/
          	}
           //-------------------------------------------------------------------------------------------
		 if (!$_GET['error']){ // if not error save data
			  $data= new subDB();
	         $data->pro_in($_POST['promotion_code'], 
							 $_POST['pro_type'], 
							 $_POST['monto_porc'], 
							 $_POST['mdays'], 
							 $_POST['maxdays'], 
							 $_POST['desde'], 
							 $_POST['hasta'], 
							 $_POST['bfrom'], 
							 $_POST['bto'], 
							 $_SESSION['info']['id'], 
							 $_POST['active'], 
							 $_POST['title']);
							 
				$_GET['p']='pro'; $_GET['s']='pro.n';
              $_GET['op']['name']='Promotion';
              $_GET['op']['done']='Created';
              display('succefully'); //successful
				die();
         }else{
		    display('new_promotion');
		  }
		}
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>