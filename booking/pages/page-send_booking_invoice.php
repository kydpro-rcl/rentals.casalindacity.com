<?php
if ($_POST['ref']){ $_GET['ref']=$_POST['ref'];}
//print_r($_POST);

$_GET['ref']=trim($_GET['ref']);
   if ($_GET['ref']!=""){
	   	$db= new getQueries();
	   	$reference=$_GET['ref'];
		$reference=str_pad($reference, 9, "0", STR_PAD_LEFT);
		$book=$db->see_occupancy_ref($reference); //get reservation details
		
		$booking=$book[0];
		
       $servicios_reserva=$db->services_reserved($booking['reserveid']);
       $excursiones_reserva=$db->excrusiones_reserved($booking['reserveid']);
		$montoPagado=$db->amountRef($reference,'1');/*paid*/;
		
		
		if ($booking){
	//============================================================================================
	     if(($booking['status']!=0)&&($booking['status']!=5)){
			$info_sent_by=ucfirst($_SESSION['info']['name'])." ".ucfirst($_SESSION['info']['lastname']);
			//client details
			if($booking['line']==4){
				/*referral info*/
				$agent_comision=$db->showTable_r($table='bookingreferred', $field='ref_book', $value=$reference, $operator='=');
				$agent=$db->showTable_r($table='commission', $field='id', $value=$agent_comision[0]['id_referal'], $operator='=');
				$name=$agent[0]['name'];
				$lastname=$agent[0]['lastname'];
				$email=$agent[0]['email'];
				$sent_to=2;//referral
			}else{
				$sent_to=1;//client
				if(($booking['status']!=7)&&($booking['status']!=19)&&($booking['status']!=20)&&($booking['status']!=21)&&($booking['status']!=22)&&($booking['status']!=23)&&(		 $booking['status']!=24)&&($booking['status']!=25)){  //it is client
					$cl=$db->customer($booking['client']);//get client details
					$name=$cl['name'];
					$lastname=$cl['lastname'];
					$email=$cl['email'];
					$comming="CUSTOMER";
				}else{ //it is owner
					$owner=$db->show_id('owners', $booking['client']);
					$cl=$owner[0];//get owner details
					$name=$cl['name'];
					$lastname=$cl['lastname'];
					$email=$cl['email'];
					$comming="OWNER";
				}
			}
			$referral_client=$name." ".$lastname;
			$email_to_send=$email;
			$villa=$db->villa($booking['villa']); //get villa details
			$vd=$villa[0];
			//-------------------------------------------------------------------------
			$this_disc=$db->show_any_data_limit1("discount", "reference", $reference, "=");
			
			$Subtotal=($booking['NLS']*$booking['ppn']+$booking['NHS']*$booking['PHS']);
			$totalgral=$Subtotal+($Subtotal*0.18);
			
			$PAY_DUE=$totalgral-$montoPagado-$this_disc[0]['discounted'];
			$nights=$booking['NLS']+$booking['NHS'];
			$ref=$reference;
			
			if($_POST){
				//==============INSERT A COMMENT AS A INFO SENT TO CLIENT IN A EDITION OF A BOOKING=========================
   				$data=new subDB();
   				//$fecha=date("Y-m-d G:i:s");
				//echo $_POST['ref'];
				//============================= SEND EMAIL TO CLIENT ======================= 
				 
				 //echo $sent_to;
				 require_once('invoiceAPI/InvoiceAPI.php');
				 $amount_2_b_paid=$_POST['amount_now'];
				 $amount_2_b_paid=($amount_2_b_paid/1.18);
               #$resultado=send_single_invoice($ref,$payment_type=3,$amount_2_b_paid,$sent_to,$manual='1', $user='user');
			     $resultado=send_single_invoice2($ref,$payment_type=3,$amount_2_b_paid,$sent_to,$manual='1', $user='user', $email=$_POST['email']);
				//---------------------------- END SENDING EMAIL TO CLIENT ------------------------------
				/*$invoice_API= new PaypalInvoiceAPI;
				$header_API=$invoice_API->getInvoiceAPIHeader();*/
				/*echo "<pre>";
				print_r($header_API);
				echo "</pre>";
				print_r($resultado);*/
				if($sent_to==2){ $who="Referral";}else{ $who="Client"; }
				$amount_2_paid=$amount_2_b_paid*1.18;
				echo "<h1 align='center'>Invoice Successfully sent</h1>";
				echo "<p align='center'>Amount Invoiced:<strong>$amount_2_paid</strong></p>";
				echo "<p align='center'>Invoice for booking <strong>$ref</strong>";
				echo "<p align='center'>$who Name: <strong>$referral_client</strong></p>";
				echo "<p align='center'>Email: <strong>$email_to_send</strong></p>";
			}else{?>
			<h2 align="center">Sending invoice Manually to this booking</h2>
			<form method="post" action="send_booking_invoice.php">
				<p align="center">Name: <input type="text" size="35"  name="name" value="<?=$referral_client?>" disabled/></p>
				<p align="center">Email: <input type="text" size="35" name="email" value="<?=$email_to_send?>" /></p>
				<p align="center">Booking: <input type="text" name="ref" size="35" value="<?=$ref?>" readonly/></p>
				<p align="center">Invoice Amount: <input type="text" name="amount_now" value="<?=number_format($PAY_DUE,2)?>"/></p>
				<p align="center"><input type="submit" name="Send Invoice" value="Send Invoice"/></p>
			</form>
			<?
				//echo "show form";
			}
		 		
		  }else{
			echo "<p style='color:red; text-align:center;'><b>Error:</b> Email is not valid for client ".$cl['id']."</p>";
		  }

		 }else{
			echo "<p style='color:red; text-align:center;'><b>Error:</b> It is impossible to send information for booking <span style='color:black;'>No.:".$reference."</span></p>";
		 }

	}else{
			echo "<p style='color:red; text-align:center;'><b>Error:</b> Booking not found in our system</p>";
	}
	//}else{ echo "<p style='color:red; text-align:center;'>Missing reference number</p>"; }
?>
