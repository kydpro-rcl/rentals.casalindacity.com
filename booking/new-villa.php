<?php
 require_once('inc/session.php');
 
 //print_r($_SESSION['info']);
 
 //die();
 
if ($_SESSION['info']){
  if ($_SESSION['info']['level']==1){
		$_GET['p']='v'; $_GET['s']='v.n';
		$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
		require_once('init.php');

		if ($_POST['create']){
		 //============start cautching inputs =====
	     $villa_no=$_POST['no']; $villa_type=$_POST['type'];$size_m2=$_POST['m2'];
	     $qty_bed=$_POST['bed'];$qty_ac=$_POST['AC'];$qty_bath=$_POST['bath'];
	     $price_low=$_POST['p_low'];$price_high=$_POST['p_high'];$long_price=$_POST['p_long'];
	     $maintenance=$_POST['maintenance'];$water_service=$_POST['water']; $long_able=$_POST['long_able']; $price_sale=$_POST['p_sale'];$maid=$_POST['p_in_clear'];
	     $garden_pool=$_POST['p_out_clear'];$able_rent=$_POST['able_r'];$able_sale=$_POST['able_s'];$owner_id=$_POST['owner'];
	     $wish_referal=$_POST['wish_referal'];


	     if ($HTTP_POST_FILES['pic']['name']!=''){   //check the picture and take the path to be saved
				$ruta="pictures/villas/";
				$nombre_archivo = $_FILES['pic']['name'];
				$tipo_archivo = $_FILES['pic']['type'];
				$tamano_archivo = $_FILES['pic']['size'];
				$path=$ruta.$nombre_archivo;
				//compruebo si las caracterÝsticas del archivo son las que deseo
					if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "JPG")) && ($tamano_archivo < 500000))) {
					    $_GET['error']['pic']="Extention must be .gif or jpg and size 500 KB max.";

					}else{
					   	if (move_uploaded_file($_FILES['pic']['tmp_name'],$path )){
					      	 $pic=$path;//mean all is ok with picture
					   	}else{

					      	 #echo "There was a problem uploading the photos. We could not save your photo";
					      	 $_GET['error']['pic']="There was a problem uploading the picture. We could not save your photo";
					      	// display('new-client');    //returs to the form
					      	// die();
					   	}
					}
	     }else{
	        $pic=''; //empty path
	     }
	     //==============end catching inputs from form

	     //=======start validation for five inputs integer
	     if (!empty($villa_no)){
	      /*if(!filter_var($villa_no, FILTER_VALIDATE_INT)){ $_GET['error']['no']='Only Numbers Allowed' ; }else{*/$villa_no=str_pad($villa_no, 2, "0", STR_PAD_LEFT);/*} */
	     }else{
	     $_GET['error']['no']='Number Required' ;
	     }
	     /*if (!empty($size_m2)){
	      if(!filter_var($size_m2, FILTER_VALIDATE_INT))$_GET['error']['size']='Only Numbers Allowed' ;
	     }else{
	     $_GET['error']['size']='size Required' ;
	     }
	     if (!empty($qty_bed)){
	      if(!filter_var($qty_bed, FILTER_VALIDATE_INT))$_GET['error']['bed']='Only Numbers Allowed' ;
	     }else{
	     $_GET['error']['bed']='bedrooms Required' ;
	     }
	     if (!empty($qty_ac)){
	      if(!filter_var($qty_ac, FILTER_VALIDATE_INT))$_GET['error']['ac']='Only Numbers Allowed' ;
	     }else{
	     $_GET['error']['ac']='AC Required' ;
	     }
	     if (!empty($qty_bath)){
	      if(!filter_var($qty_bath, FILTER_VALIDATE_INT))$_GET['error']['bath']='Only Numbers Allowed' ;
	     }else{
	     $_GET['error']['bath']='bathrooms Required' ;
	     }
	     if (!empty($price_low)){
	      if(!filter_var($price_low, FILTER_VALIDATE_INT))$_GET['error']['pl']='Only Numbers Allowed' ;
	     }else{
	     $_GET['error']['pl']='Price Required' ;
	     }
	     if (!empty($price_high)){
	      if(!filter_var($price_high, FILTER_VALIDATE_INT))$_GET['error']['ph']='Only Numbers Allowed' ;
	     }else{
	     $_GET['error']['ph']='Price Required' ;
	     }*/
	      //===end validation

	     if (!$_GET['error']){   //==check if there isn't error(s)

		    //connect to db
		    $db= new subDB();

			//$db->insertVilla($villa_no,$villa_type, $size_m2, $qty_bed, $qty_ac, $qty_bath, $price_low, $price_high, $long_price, $maintenance, $water_service, $long_able,$price_sale, $maid, $garden_pool, $_POST['title'], $pic, $able_sale, $able_rent, $owner_id, $wish_referal);
			$ft2=($size_m2*10.76);
			$cap=($qty_bed*2);
			$fecha=date("Y-m-d G:i:s");					
						$fields=array('no'=>$villa_no,
							'type'=>$villa_type,
							'm2'=>$size_m2,
							'ft2'=>$ft2,
							'bed'=>$qty_bed,
							'AC'=>$qty_ac,
							'bath'=>$qty_bath,
							'capacity'=>$cap,
							'p_low'=>$price_low,
							'p_shoulder'=>$_POST['p_should'],
							'p_high'=>$price_high,
							'p_long'=>$long_price,
							'maintenance'=>$maintenance,
							'water_long'=>$water_service,
							'long_able'=>$long_able,
							'p_sale'=>$price_sale,
							'p_in_clear'=>$maid,
							'p_out_clear'=>$garden_pool,
							'headline'=>htmlentities($_POST['headline'], ENT_QUOTES),
							'head'=>htmlentities($_POST['title'], ENT_QUOTES),
							'pic'=>$pic,
							'able_s'=>$able_sale,
							'able_r'=>$able_rent,
							'id_owner'=>$owner_id,
							'date'=>$fecha,
							'wish_referal'=>$wish_referal,
							'classification'=>$_POST['vclass'],
							'vonline'=>$_POST['vonline'],
							'vrap'=>$_POST['vrap'],
							'shared_f_bath'=>$_POST['sfb'],
							'priv_f_bath'=>$_POST['pfb'],
							'shared_h_bath'=>$_POST['shb'],
							'priv_h_bath'=>$_POST['phb']
						);
			$table='villas';
			$villaid=$db->insert_id($fields, $table);
			
		if ($_SESSION['info']['services']==1){		
			$fields2=array(	'villa_id'=>$villaid,
							'pool_garden'=>$_POST['pg'],
							'maid'=>$_POST['ms'],
							'wifi'=>$_POST['int'],
							'cable'=>$_POST['cab'],
							'electricity'=>$_POST['elec'],
							'admin_fee'=>$_POST['adm'],
							'acc_fee'=>$_POST['acc'],
							'agr_rental'=>$_POST['ra'],
							'agr_waiver'=>$_POST['wf'],
							'agr_rent_gua'=>$_POST['rg'],
							'agr_special'=>$_POST['sa'],
							'insurance'=>$_POST['hi'],
							'agr_other'=>$_POST['oa'],
							'fecha_made'=>time(),
							'user_made'=>$_SESSION['info']['id'],
								'swater'=>$_POST['wat'],
								'accdetails'=>$_POST['accountingfee'],
								'admdetails'=>$_POST['adminfee'],
								'ppool'=>$_POST['ppg'],
								'pmaid'=>$_POST['ppm'],
								'pwater'=>$_POST['ppw'],
								'pinternet'=>$_POST['ppi'],
								'ptvcable'=>$_POST['ppt'],
								'pelect'=>$_POST['ppe'],
								'subdivision'=>$_POST['sbd'],
								'subdivisionfee'=>$_POST['psbd']
						);
			$table2='villa_services_contracted';
			$db->insert_id($fields2, $table2);
			$data= new getQueries ();
			$user_with_services_rights=$data->usersServices();
			if($user_with_services_rights){
				foreach($user_with_services_rights AS $u){
					sendMail_services_contracted($to_add=$u['email'], $to_name=$u['name'].' '.$u['lastname'], $subject='Services contracted changed or created on villa '.$villa_no, $from_add=$_SESSION['info']['email'], $from_name=$_SESSION['info']['name'].' '.$_SESSION['info']['lastname'], $villa_no);
				}	
			}
		}
			//update($id, $info, $table)

		    $_GET['p']='v'; $_GET['s']='v.n'; //gets values
		   	$_GET['op']['name']='Villa';
	     	$_GET['op']['done']='Created';
	      	display('succefully'); //dispaly succefull
		    die();//die

	     }else{  //there is (are) error (s)
	      display('new-villa');    //display form with errors
	     }

		}else{ //if has not been submitted

			display('new-villa');    //display form with inputs
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