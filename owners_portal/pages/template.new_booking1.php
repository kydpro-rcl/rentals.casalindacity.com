<h2>Welcome, <?=$_SESSION['owner']['name']." ".$_SESSION['owner']['lastname']?></h2>
<p style="clear:both;">&nbsp;</p>
<hr style="border:1px solid #f9a80b;" />
<?php

	try{
		
		$db= new getQueries();

		$new_busy=check_villa_new($_POST['v'], $_POST['desde'], $_POST['hasta']); /* check if occupied in case villas was occupied during process or refreshed page then through an error*/
		 $cant_new=count($new_busy);
		 if(!$cant_new>0){/*incio si no hay ocupaciones en esta villa*/
			 $db= new subDB (); //CONNECT TO DATABASE
			$id_ocupacion=$db->insert_ocupacion_short_reserve($starting=$_POST['desde'], $ending=$_POST['hasta'], $id_villa=$_POST['v'], $id_adm=''); //insert ocupation and returm id of insertion
			
			$ref=str_pad($id_ocupacion, 9, "0", STR_PAD_LEFT);
			
			if($_POST['T_nights']>=30){
				$status=23; /*long term owner*/
			}else{
				$status=19; /*short term owner*/
			}
			
			$id_reserve=$db->insert_short_reserva($ref, $id_ocupacion, $id_customer=$_POST['owner'], $adults_qty=1, $children_qty=0, $interm_id=0, $qty_nights=$_POST['T_nights'], $HS_nights=0, $LS_nights=$_POST['T_nights'], $price_per_night=0, $priceHS=0, $amount_commision=0, $sub_total_rent=0, $ITBIS=0, $services_amount=0, $deposit=0, $general_amount=0, $status, $source=10);  //INSERT RESERVE AND TAKE IT ID
			 
			 //send email to reservation en to owners email
			 $body1=email2rcl($ref, $_POST['vnumber']);
			 $body2=email2owner($ref, $_POST['vnumber'], $qty_nights, $starting, $ending);
			
			$envio1=sendMail($body1, $sent_to='webmaster@casalindacity.com', $question='', $correo_owner='it@casalindacity.com', "RCL Owners Portal");//send to RCL from (owner)
			$envio2=sendMail($body2, $sent_to='webmaster@casalindacity.com', $question='', $correo_owner='it@casalindacity.com', "RCL Owners Portal");//send to RCL from (owner)
			
			$envio1=sendMail($body1, $sent_to='reservations@casalindacity.com', $question='', $correo_owner='info@casalindacity.com', "RCL Owners Portal");//send to RCL from (owner)
			/*$envio2=sendMail($body2, $sent_to='webmaster@casalindacity.com', $question='', $correo_owner='it@casalindacity.com', "RCL Owners Portal");//send to RCL from (owner)*/
			 
		 }else{/*fin si no hay ocupaciones en esta villa*/
			echo "Error: This villa is now occupied in you period selected!";
			die();
		 }

		if($_POST){   //if this owner has any villa
		
			 ?>
			 <h3 style="color:#2A6EBB; text-transform:uppercase;">Confirmation of your booking</h3>
			 <p>&nbsp;</p>
		   
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

			<!-- Optional theme -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

			<!-- Latest compiled and minified JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
			<h3>You have created successfully your booking no. <?=$ref?>  for villa no. <?=$_POST['vnumber']?> from <?=$_POST['desde']?> to <?=$_POST['hasta']?></h3>
			<?
			
			//shows details about reservations
			
			/*echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			
			if($_POST){
				
				
			}*/
				
		/*=================================START CONTENT========================================================================*/			
		}
	}catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}		
		?>
		