<?php
#A-find out if invoices sent/reminded today {if not, then do below}
#B-function get booking to sent invoices {if so A}
function invoices_sent_reminded(){
	//require_once('../init.php');
	require_once('init.php');
	$link = new getQueries();
	$facturaEnviada=$link->showTable_restrinted($table='ppinvoices', $condition='status=\'Sent\' OR status=\'Reminded\'', $order='id');
	
	return $facturaEnviada;
}

function facturaInfo($booking, $tipo){
	//require_once('../init.php');
	require_once('init.php');
	$link = new getQueries();
	$facturaEnviada=$link->showTable_restrinted($table='ppinvoices', $condition='ref='.$booking.' AND tipopago='.$tipo, $order='id');
	
	return $facturaEnviada;
}
function InvoicingToday(){
//require_once('../init.php');
require_once('init.php');
	
	$link= new getQueries();
	$booking=$link->getUnpaidShorTerm();// 3 no confirmed
	$booking2=$link->getUnpaidShorTerm(2);//2 confirmed 
	$result=array();
	
	/*$result=$booking2;*/
	//conditions

	#4-yes all other referral[no importan los otros referral, si dijo que no enviara al cliente????]

	if($booking){
		foreach($booking AS $k){
			if($k['atipo']!=3){//if not booking engine
				//$result[]=$k;
				$montoTotalPagado='';//borrar el monto anterior cual el ciclo regrese
				$montoTotalPagado=$link->amountRef($k['ref'],'1');//paid
				$montoTotalPagado+=$k['dep'];
				
				$montoTotalPagadoNoTax=(($montoTotalPagado/118)*100);
				$today=date('Y-m-d');
				
				$daysToStart=days_dates($start=$today, $end=$k['start']);//qty days in dates
				
				$montoApagar='';//borrar el monto anterior cual el ciclo regrese
				$noEnviar='';//muy importante reiniciar la variable
				//charge one night
				if($daysToStart>35){//one night due-send when discovery to pay immediately 
					if($k['nightsLS']>0){
						$payment1=(($k['priceLS']*1)+($k['priceLS']*0.18));
						$precioVilla=$k['priceLS'];
					}else{
						$payment1=(($k['priceHS']*1)+($k['priceHS']*0.18));
						$precioVilla=$k['priceHS'];
					}
					//verificar que el monto pagado (incluyendo viejos depositos es mayor o igual a una noche
					if($montoTotalPagado>=$payment1){
						//no hace nada si ya pagó la noche que debe pagar
						$noEnviar=true;//resetear la variable al inicio para cuando regrese el contador
					}else{
						//$montoApagar=$payment1-$montoTotalPagado;
						$pagoen=0;//due in same date
						$tipoFact=1;//1 = one night; 2- 50%; 3=100%
					}
					
					//look into invoice sent to check if send
					$facturaEnviada=facturaInfo($booking=$k['ref'], $tipo=1);
					//if($facturaEnviada){ $result[]=$facturaEnviada; }
				
					if((!$facturaEnviada)&&($noEnviar!=true)){
						//si ya se envio factura para el pago de una noche no la envio otra vez o si se ha realizado el pago de otro modo tampoco
						//verificar que el monto a pagar sea mayor de 50 dolares
						$montoApagar=$precioVilla-$montoTotalPagadoNoTax;//reduce taxes from $montoApagar
						
						$aPagarWithTax=$montoApagar+($montoApagar*0.18);
						if($aPagarWithTax>50){//only if invoice is more than 50 USD
							$montoApagar=number_format($montoApagar,2);
							$result[]=array('booking'=>$k['ref'], 'type'=>$tipoFact, 'amount'=>$montoApagar, 'startDate'=>$k['start'], 'dueDays'=>$pagoen, 'online'=>$k['source']);
							//$result[]=array('booking'=>$k['ref'], 'type'=>1, 'paid'=>$montoTotalPagado, 'startDate'=>$k['start'], 'nocheTAX'=>$payment1, 'nocheNoTAX'=>$precioVilla,'aPagar'=>$montoApagar);
						}
					}				
					
				}//end one night
				
				//charge 50% (to complete 50% if one night paid)
				if(($daysToStart<=35)&&($daysToStart>12)){//50%
					if(($daysToStart<=35)&&($daysToStart>30)){//50% due-sent at 13 days due in 5
						//look into invoices sent to check if send or remind
						switch($daysToStart){
							case 35:$pagoen=5; break;
							case 34:$pagoen=4; break;
							case 33:$pagoen=3; break;
							case 32:$pagoen=2; break;
							case 31:$pagoen=1; break;
						}						
					}elseif(($daysToStart<=30)&&($daysToStart>12)){//50% due-sent at 13 days due in 5					
						$pagoen=0;//due in same date
					}
					$payment2=($k['total']/2);
					$tipoFact=2;//1 = one night; 2- 50%; 3=100%
					
					if($montoTotalPagado>=$payment2){
						//no hace nada si ya pago la noche que debe pagar
						$noEnviar=true;
					}else{
						$montoApagarWithTax=$payment2-$montoTotalPagado;
						$montoApagar=(($montoApagarWithTax/118)*100);
					}					
					//look into invoice sent to check if send
					$facturaEnviada=facturaInfo($booking=$k['ref'], $tipo=2);
					if((!$facturaEnviada)&&($noEnviar!=true)){
						//si ya se envio factura para el pago de una noche no la envio otra vez o si se ha realizado el pago de otro modo tampoco
						if($montoApagarWithTax>50){/*solo envia factura por mas de 50 USD*/
							$montoApagar=number_format($montoApagar,2);
							$result[]=array('booking'=>$k['ref'], 'type'=>$tipoFact, 'amount'=>$montoApagar, 'startDate'=>$k['start'], 'dueDays'=>$pagoen, 'online'=>$k['source']);
						}
						//array_push($result, array('booking'=>$k['ref'], 'type'=>$tipoFact, 'amount'=>$montoApagar, 'startDate'=>$k['start'], 'dueDays'=>$pagoen));
					}
				}//end 50%	
				
				//charge 100%
				if($daysToStart<=12){//100%
				
					if(($daysToStart<=12)&&($daysToStart>7)){//50% due-sent at 13 days due in 5						
						switch($daysToStart){
							case 12:$pagoen=5; break;
							case 11:$pagoen=4; break;
							case 10:$pagoen=3; break;
							case 9:$pagoen=2; break;
							case 8:$pagoen=1; break;
						}									
					}else{//100% due
						$pagoen=0;//due in same date
					}
					$payment3=$k['total'];
					$tipoFact=3;//1 = one night; 2- 50%; 3=100%
					
					if($montoTotalPagado>=$payment3){
						//no hace nada si ya pago la noche que debe pagar
						$noEnviar=true;
					}else{
						$montoApagarWithTax=$payment3-$montoTotalPagado;
						$montoApagar=(($montoApagarWithTax/118)*100);
					}					
					//look into invoice sent to check if send
					$facturaEnviada=facturaInfo($booking=$k['ref'], $tipo=3);
					if((!$facturaEnviada)&&($noEnviar!=true)){
						//si ya se envio factura para el pago de una noche no la envio otra vez o si se ha realizado el pago de otro modo tampoco
						//even one penny need to be charged here because it is the last charge.
						$montoApagar=number_format($montoApagar,2);
						$result[]=array('booking'=>$k['ref'], 'type'=>$tipoFact, 'amount'=>$montoApagar, 'startDate'=>$k['start'], 'dueDays'=>$pagoen, 'online'=>$k['source']);
					}
					#$result[]=array('booking'=>$k['ref'], 'type'=>3, 'amount'=>$montoApagar, 'startDate'=>$k['start'], 'dueDays'=>$pagoen);
				}//end 100%
				
			}//end booking engines
		}//end for each booking found
	}//end if booking found
	if($booking2){
		foreach($booking2 AS $k){
			if($k['atipo']!=3){//if not booking engine
				//$result[]=$k;
				$montoTotalPagado='';//borrar el monto anterior cual el ciclo regrese
				$montoTotalPagado=$link->amountRef($k['ref'],'1');//paid
				$montoTotalPagado+=$k['dep'];
				
				$montoTotalPagadoNoTax=(($montoTotalPagado/118)*100);
				$today=date('Y-m-d');
				
				$daysToStart=days_dates($start=$today, $end=$k['start']);//qty days in dates
				
				$montoApagar='';//borrar el monto anterior cual el ciclo regrese
				$noEnviar='';//muy importante reiniciar la variable
				//charge one night
				if($daysToStart>35){//one night due-send when discovery to pay immediately 
					if($k['nightsLS']>0){
						$payment1=(($k['priceLS']*1)+($k['priceLS']*0.18));
						$precioVilla=$k['priceLS'];
					}else{
						$payment1=(($k['priceHS']*1)+($k['priceHS']*0.18));
						$precioVilla=$k['priceHS'];
					}
					//verificar que el monto pagado (incluyendo viejos depositos es mayor o igual a una noche
					if($montoTotalPagado>=$payment1){
						//no hace nada si ya pagó la noche que debe pagar
						$noEnviar=true;//resetear la variable al inicio para cuando regrese el contador
					}else{
						$montoApagar=$payment1-$montoTotalPagado;
						$pagoen=0;//due in same date
						$tipoFact=1;//1 = one night; 2- 50%; 3=100%
					}
					
					//look into invoice sent to check if send
					$facturaEnviada=facturaInfo($booking=$k['ref'], $tipo=1);
					//if($facturaEnviada){ $result[]=$facturaEnviada; }
				
					if((!$facturaEnviada)&&($noEnviar!=true)){
						//si ya se envio factura para el pago de una noche no la envio otra vez o si se ha realizado el pago de otro modo tampoco
						//verificar que el monto a pagar sea mayor de 50 dolares
						$montoApagar=$precioVilla-$montoTotalPagadoNoTax;//reduce taxes from $montoApagar
						
						$aPagarWithTax=$montoApagar+($montoApagar*0.18);
						if($aPagarWithTax>50){//only if invoice is more than 50 USD
							$montoApagar=number_format($montoApagar,2);
							$result[]=array('booking'=>$k['ref'], 'type'=>$tipoFact, 'amount'=>$montoApagar, 'startDate'=>$k['start'], 'dueDays'=>$pagoen, 'online'=>$k['source']);
							//$result[]=array('booking'=>$k['ref'], 'type'=>1, 'paid'=>$montoTotalPagado, 'startDate'=>$k['start'], 'nocheTAX'=>$payment1, 'nocheNoTAX'=>$precioVilla,'aPagar'=>$montoApagar);
						}
					}				
					
				}//end one night
				
				//charge 50% (to complete 50% if one night paid)
				if(($daysToStart<=35)&&($daysToStart>12)){//50%
					if(($daysToStart<=35)&&($daysToStart>30)){//50% due-sent at 13 days due in 5
						//look into invoices sent to check if send or remind
						switch($daysToStart){
							case 35:$pagoen=5; break;
							case 34:$pagoen=4; break;
							case 33:$pagoen=3; break;
							case 32:$pagoen=2; break;
							case 31:$pagoen=1; break;
						}						
					}elseif(($daysToStart<=30)&&($daysToStart>12)){//50% due-sent at 13 days due in 5					
						$pagoen=0;//due in same date
					}
					$payment2=($k['total']/2);
					$tipoFact=2;//1 = one night; 2- 50%; 3=100%
					
					if($montoTotalPagado>=$payment2){
						//no hace nada si ya pago la noche que debe pagar
						$noEnviar=true;
					}else{
						$montoApagarWithTax=$payment2-$montoTotalPagado;
						$montoApagar=(($montoApagarWithTax/118)*100);
					}					
					//look into invoice sent to check if send
					$facturaEnviada=facturaInfo($booking=$k['ref'], $tipo=2);
					if((!$facturaEnviada)&&($noEnviar!=true)){
						//si ya se envio factura para el pago de una noche no la envio otra vez o si se ha realizado el pago de otro modo tampoco
						if($montoApagarWithTax>50){/*solo envia factura por mas de 50 USD*/
							$montoApagar=number_format($montoApagar,2);
							$result[]=array('booking'=>$k['ref'], 'type'=>$tipoFact, 'amount'=>$montoApagar, 'startDate'=>$k['start'], 'dueDays'=>$pagoen, 'online'=>$k['source']);
						}
						//array_push($result, array('booking'=>$k['ref'], 'type'=>$tipoFact, 'amount'=>$montoApagar, 'startDate'=>$k['start'], 'dueDays'=>$pagoen));
					}
				}//end 50%	
				
				//charge 100%
				if($daysToStart<=12){//100%
				
					if(($daysToStart<=12)&&($daysToStart>7)){//50% due-sent at 13 days due in 5						
						switch($daysToStart){
							case 12:$pagoen=5; break;
							case 11:$pagoen=4; break;
							case 10:$pagoen=3; break;
							case 9:$pagoen=2; break;
							case 8:$pagoen=1; break;
						}									
					}else{//100% due
						$pagoen=0;//due in same date
					}
					$payment3=$k['total'];
					$tipoFact=3;//1 = one night; 2- 50%; 3=100%
					
					if($montoTotalPagado>=$payment3){
						//no hace nada si ya pago la noche que debe pagar
						$noEnviar=true;
					}else{
						$montoApagarWithTax=$payment3-$montoTotalPagado;
						$montoApagar=(($montoApagarWithTax/118)*100);
					}					
					//look into invoice sent to check if send
					$facturaEnviada=facturaInfo($booking=$k['ref'], $tipo=3);
					if((!$facturaEnviada)&&($noEnviar!=true)){
						//si ya se envio factura para el pago de una noche no la envio otra vez o si se ha realizado el pago de otro modo tampoco
						//even one penny need to be charged here because it is the last charge.
						$montoApagar=number_format($montoApagar,2);
						$result[]=array('booking'=>$k['ref'], 'type'=>$tipoFact, 'amount'=>$montoApagar, 'startDate'=>$k['start'], 'dueDays'=>$pagoen, 'online'=>$k['source']);
					}
					#$result[]=array('booking'=>$k['ref'], 'type'=>3, 'amount'=>$montoApagar, 'startDate'=>$k['start'], 'dueDays'=>$pagoen);
				}//end 100%
				
			}//end booking engines
		}//end for each booking found
	}//end if booking found
	#retornar monto a pagar, type 1,2,3,4 numero de reserva.
	return $result;
}

function invoicesDue(){
	require_once('init.php');
	
	$link= new getQueries();
	$invoices=$link->show_data($table='ppinvoices', $condition="duedate<='".date('Y-m-d')."' AND status='Sent'", $order='id');
	
	return $invoices;
}

function changeStatus($id, $status){
		require_once('init.php');
		$db = new DB();
		$info=array('status'=>$status);
		$upd=$db->update($id, $info, $table='ppinvoices');
return $upd;	
}

function savePayment($ref, $amount, $invoiceID){
		require_once('init.php');
		$db = new DB();
		$info=array('ref'=>$ref,'type'=>'3','class'=>'1','amount'=>$amount,'transid'=>"Invoice:$invoiceID",'user'=>'47','fecha'=>date('Y-m-d G:i:s'));
		$upd=$db->insert($info, $table='payments');
return $upd;	
}
function saveReminded($invoiceID, $manual=2){
		require_once('init.php');
		$db = new DB();
		$info=array('user'=>$_SESSION['info']['id'],'datereminded'=>date('Y-m-d'),'invoiceID'=>$invoiceID,'manual'=>$manual);
		$upd=$db->insert($info, $table='ppreminder');
return $upd;	
}
#C-function get invoices to remind/not paid {if so A}
#D-function save invoices sent/reminded today {if so A}

?>