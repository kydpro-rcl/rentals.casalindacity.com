<?php
if ($_POST['ref']) $_GET['ref']=$_POST['ref'];
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
			}else{
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
		  if (filter_var($email,FILTER_VALIDATE_EMAIL)){

			$villa=$db->villa($booking['villa']); //get villa details
			$vd=$villa[0];
			//-------------------------------------------------------------------------
			$this_disc=$db->show_any_data_limit1("discount", "reference", $reference, "=");
			$total_villa=($booking['NLS']*$booking['ppn'])+($booking['NHS']*$booking['PHS']);
			$booking['total']=$total_villa+($total_villa*0.18);
			 $PAY_DUE=$booking['total']-$montoPagado-$this_disc[0]['discounted'];
			 $booking['total']-=$this_disc[0]['discounted'];
			 $nights=$booking['NLS']+$booking['NHS'];
            //==============INSERT A COMMENT AS A INFO SENT TO CLIENT IN A EDITION OF A BOOKING=========================
   				  $data=new subDB();
   				  $fecha=date("Y-m-d G:i:s");
                $insert_comment=$data->insert_comments($reference,'',$tipo='5'/*mean info sent to client*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='', $booking['villa'], $id_ocupacion_mod='');
				//============================= SEND EMAIL TO CLIENT =======================
					//echo $email_to_send;
					$body=booking_info_short($reference, $gral_amount=$booking['total'], $PAY_DUE, $referral_client, $villa_no=$vd['no'], $nights, $start=$booking['start'], $end=$booking['end']);
					sendMail_copy_reservations($body, $email_to_send, $subject="BOOKING CONFIRMATION:$reference", $from_add='reservations@casalindacity.com', $from_name='Residencial Casa Linda');	
					//SAVE EMAIL SENT IN DB	
					$info5=array('email'=>$email_to_send, 'ref'=>$reference, 'msg'=>utf8_encode($body), 'date'=>time());		  
					$datos=$data->insert($info5, 'confirmation_sent'); 
				//---------------------------- END SENDING EMAIL TO CLIENT ------------------------------
				echo $body;
		  }else{
			echo "<p style='color:red; text-align:center;'><b>Error:</b> Email is not valid for client ".$cl['id']."</p>";
		  }

		 }else{
			echo "<p style='color:red; text-align:center;'><b>Error:</b> It is impossible to send information for booking <span style='color:black;'>No.:".$reference."</span></p>";
		 }

		}else{
			echo "<p style='color:red; text-align:center;'><b>Error:</b> Booking not found in our system</p>";
		}
	}else{ echo "<p style='color:red; text-align:center;'>Missing reference number</p>"; }
?>
