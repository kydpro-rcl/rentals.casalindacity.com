<?php
function dates_between($s='2010-10-01', $e='2010-10-05'){
	//$startdate = explode("-", $s);
	//$enddate = explode("-", $e);
	$period = new DatePeriod(
     new DateTime($s),
     new DateInterval('P1D'),
     new DateTime($e)
	);
	$dates=array();
	
	foreach ($period as $key => $value) {
		//$value->format('Y-m-d')
		$current_date=$value->format('Y-m-d');
		array_push($dates, $current_date);		
	}

	/*if($startdate[0]==$enddate[0]){// case it is the same year
		
		if($startdate[1]==$enddate[1]){// case it is the same month
			//$lastday = date('t',strtotime('2018-02-01'));
			for($i=$startdate[3]; $i<=$enddate[3]; $i++){
				$current_date=$startdate[0]."-".$startdate[1]."-".$i;
				array_push($dates, $current_date);
			}
		}else{
			for($m=$startdate[2]; $m<=$enddate[2]; $m++){//from start month until end month
				if($i!=$enddate[2]){//it's a month in middle
					$actual_fecha=$startdate[0].'-'.$m.'-01';
					$lastday = date('t',strtotime($actual_fecha));
					for($i=01; $i<=$lastday; $i++){
						$current_date=$startdate[0]."-".$m."-".$i;
						array_push($dates, $current_date);
					}
				}elseif($i==$startdate[2]){//starting month
					$actual_fecha=$startdate[0].'-'.$m.'-01';
					$lastday = date('t',strtotime($actual_fecha));
					for($i=$startdate[3]; $i<=$lastday; $i++){
						$current_date=$startdate[0]."-".$startdate[1]."-".$i;
						array_push($dates, $current_date);
					}
				}else{//end month
					for($i=01; $i<=$enddate[3]; $i++){
						$current_date=$startdate[0]."-".$startdate[1]."-".$i;
						array_push($dates, $current_date);
					}
				}
			}
			
		}
		
	}else{
		for($y=$startdate[0]; $y<=$enddate[0]; $y++){//since starting year until ending year
			if($y==$startdate[0]){// case it is the starting year
		
				if($startdate[1]==$enddate[1]){// case it is the same month
					//$lastday = date('t',strtotime('2018-02-01'));
					for($i=$startdate[3]; $i<=$enddate[3]; $i++){
						$current_date=$startdate[0]."-".$startdate[1]."-".$i;
						array_push($dates, $current_date);
					}
				}else{
					for($m=$startdate[2]; $m<=$enddate[2]; $m++){//from start month until end month
						if($i!=$enddate[2]){//it's a month in middle
							$actual_fecha=$startdate[0].'-'.$m.'-01';
							$lastday = date('t',strtotime($actual_fecha));
							for($i=01; $i<=$lastday; $i++){
								$current_date=$startdate[0]."-".$m."-".$i;
								array_push($dates, $current_date);
							}
						}elseif($i==$startdate[2]){//starting month
							$actual_fecha=$startdate[0].'-'.$m.'-01';
							$lastday = date('t',strtotime($actual_fecha));
							for($i=$startdate[3]; $i<=$lastday; $i++){
								$current_date=$startdate[0]."-".$startdate[1]."-".$i;
								array_push($dates, $current_date);
							}
						}else{//end month
							for($i=01; $i<=$enddate[3]; $i++){
								$current_date=$startdate[0]."-".$startdate[1]."-".$i;
								array_push($dates, $current_date);
							}
						}
					}
					
				}
				
			}elseif(){//case this is the ending year
				
			}else{// case this is a year in between
				
			}
		}
	}*/
	
	return $dates;
}

/**
 * @param $bed
 * @param $nights
 * @return string
 */
function services_franco($bed, $nights){
	if(($bed>=1)&&($nights>0)){
		$total_fee="";
		$housekeeping_fee="";
		$electricity_fee="";
		switch ($bed){
			case '1': //1 bedrooms
					if($nights>=1){
						switch ($nights){
							case '1': //1 nights length
									$housekeeping_fee=10.50; $laundry_fee=7.50;
									break;
							case '2': //2 nights length
									$housekeeping_fee=17.00; $laundry_fee=7.50;
									break;
							case '3': //3 nights length
									$housekeeping_fee=23.50; $laundry_fee=15.00;
									break;
							case '4': //4 nights length
									$housekeeping_fee=30.00; $laundry_fee=15.00;
									break;
							case '5': //5 nights length
									$housekeeping_fee=36.50; $laundry_fee=22.50;
									break;
							case '6': //6 nights length
									$housekeeping_fee=43.00; $laundry_fee=22.50;
									break;
							case '7': //7 nights length
									$housekeeping_fee=49.50; $laundry_fee=30.00;
									break;
							default: //more than 7 nights length
									$more_than_7=$nights-7;
									$aditional_amount=$more_than_7*6.50;
									$housekeeping_fee=49.50+$aditional_amount;

									$aditional_laundry=$more_than_7*3.75;
									$laundry_fee=30.00+$aditional_laundry;
						}
					}
					//$electricity_fee=10*$nights;
					$electricity_fee=0;
				break;
			case '2': //2 bedrooms
					if($nights>=1){
						switch ($nights){
							case '1': //1 nights length
									$housekeeping_fee=10.50; $laundry_fee=15.00;
									break;
							case '2': //2 nights length
									$housekeeping_fee=17.00; $laundry_fee=15.00;
									break;
							case '3': //3 nights length
									$housekeeping_fee=23.50; $laundry_fee=30.00;
									break;
							case '4': //4 nights length
									$housekeeping_fee=30.00; $laundry_fee=30.00;
									break;
							case '5': //5 nights length
									$housekeeping_fee=36.50; $laundry_fee=45.00;
									break;
							case '6': //6 nights length
									$housekeeping_fee=43.00; $laundry_fee=45.00;
									break;
							case '7': //7 nights length
									$housekeeping_fee=49.50; $laundry_fee=60.00;
									break;
							default: //more than 7 nights length
									$more_than_7=$nights-7;
									$aditional_amount=$more_than_7*6.50;
									$housekeeping_fee=49.50+$aditional_amount;

									$aditional_laundry=$more_than_7*7.50;
									$laundry_fee=60.00+$aditional_laundry;

						}
					}
					//$electricity_fee=10*$nights;
					$electricity_fee=0;
					break;
			case '3': //3 bedrooms
					if($nights>=1){
						switch ($nights){
							case '1': //1 nights length
									$housekeeping_fee=15.50; $laundry_fee=22.50;
									break;
							case '2': //2 nights length
									$housekeeping_fee=24.50; $laundry_fee=22.50;
									break;
							case '3': //3 nights length
									$housekeeping_fee=33.50; $laundry_fee=45.00;
									break;
							case '4': //4 nights length
									$housekeeping_fee=42.50; $laundry_fee=45.00;
									break;
							case '5': //5 nights length
									$housekeeping_fee=51.50; $laundry_fee=67.50;
									break;
							case '6': //6 nights length
									$housekeeping_fee=60.50; $laundry_fee=67.50;
									break;
							case '7': //7 nights length
									$housekeeping_fee=69.50; $laundry_fee=90.00;
									break;
							default: //more than 7 nights length
									$more_than_7=$nights-7;
									$aditional_amount=$more_than_7*9.00;
									$housekeeping_fee=69.50+$aditional_amount;

									$aditional_laundry=$more_than_7*11.25;
									$laundry_fee=90.00+$aditional_laundry;
						}
					}
					//$electricity_fee=12*$nights;
					$electricity_fee=0;
					break;
			case '4': //4 bedrooms
					if($nights>=1){
						switch ($nights){
							case '1': //1 nights length
									$housekeeping_fee=20.50; $laundry_fee=30.00;
									break;
							case '2': //2 nights length
									$housekeeping_fee=32.00; $laundry_fee=30.00;
									break;
							case '3': //3 nights length
									$housekeeping_fee=43.50; $laundry_fee=60.00;
									break;
							case '4': //4 nights length
									$housekeeping_fee=55.00; $laundry_fee=60.00;
									break;
							case '5': //5 nights length
									$housekeeping_fee=66.50; $laundry_fee=90.00;
									break;
							case '6': //6 nights length
									$housekeeping_fee=78.00; $laundry_fee=90.00;
									break;
							case '7': //7 nights length
									$housekeeping_fee=89.50; $laundry_fee=120.00;
									break;
							default: //more than 7 nights length
									$more_than_7=$nights-7;
									$aditional_amount=$more_than_7*11.00;
									$housekeeping_fee=89.50+$aditional_amount;

									$aditional_laundry=$more_than_7*15.00;
									$laundry_fee=120.00+$aditional_laundry;
						}
					}
					//$electricity_fee=17*$nights;
					$electricity_fee=0;
					break;
			case '5': //5 bedrooms
					if($nights>=1){
						switch ($nights){
							case '1': //1 nights length
									$housekeeping_fee=25.50; $laundry_fee=37.50;
									break;
							case '2': //2 nights length
									$housekeeping_fee=39.50; $laundry_fee=37.50;
									break;
							case '3': //3 nights length
									$housekeeping_fee=53.50; $laundry_fee=75.00;
									break;
							case '4': //4 nights length
									$housekeeping_fee=67.50; $laundry_fee=75.00;
									break;
							case '5': //5 nights length
									$housekeeping_fee=81.50; $laundry_fee=112.50;
									break;
							case '6': //6 nights length
									$housekeeping_fee=95.50; $laundry_fee=112.50;
									break;
							case '7': //7 nights length
									$housekeeping_fee=109.50; $laundry_fee=150.00;
									break;
							default: //more than 7 nights length
									$more_than_7=$nights-7;
									$aditional_amount=$more_than_7*14.00;
									$housekeeping_fee=109.50+$aditional_amount;

									$aditional_laundry=$more_than_7*18.75;
									$laundry_fee=150.00+$aditional_laundry;
						}
					}
					//$electricity_fee=25*$nights;
					$electricity_fee=0;
					break;
			case '6': //6 bedrooms
					if($nights>=1){
						switch ($nights){
							case '1': //1 nights length
									$housekeeping_fee=30.50; $laundry_fee=45.00;
									break;
							case '2': //2 nights length
									$housekeeping_fee=47.50; $laundry_fee=45.00;
									break;
							case '3': //3 nights length
									$housekeeping_fee=64.50; $laundry_fee=90.00;
									break;
							case '4': //4 nights length
									$housekeeping_fee=81.50; $laundry_fee=90.00;
									break;
							case '5': //5 nights length
									$housekeeping_fee=98.50; $laundry_fee=135.00;
									break;
							case '6': //6 nights length
									$housekeeping_fee=115.50; $laundry_fee=135.00;
									break;
							case '7': //7 nights length
									$housekeeping_fee=132.50; $laundry_fee=180.00;
									break;
							default: //more than 7 nights length
									$more_than_7=$nights-7;
									$aditional_amount=$more_than_7*17.00;
									$housekeeping_fee=132.50+$aditional_amount;

									$aditional_laundry=$more_than_7*22.50;
									$laundry_fee=180.00+$aditional_laundry;
						}
					}
					//$electricity_fee=25*$nights;
					$electricity_fee=0;
					break;
			/*default: //case its not defined bedrooms
					
					$electricity_fee=0;
					
					$more_than_7=$nights-7;
					$aditional_amount=$more_than_7*6.50;
					$housekeeping_fee=56.00+$aditional_amount;*/
		}
		$total_fee=$housekeeping_fee+$electricity_fee+$laundry_fee;


		$fees_charged['total']=$total_fee;
		$fees_charged['electricity']=$electricity_fee;
		$fees_charged['housekeeping']=$housekeeping_fee;
		$fees_charged['laundry']=$laundry_fee;
		
	}else{ //if its not defined bedrooms
		$fees_charged="";
	}
	
	return $fees_charged;
}

function wear_tear_funds($beds, $qtynights){
	switch($beds){
		case 2: $r=5*$qtynights;break;
		case 3: $r=10*$qtynights;break;
		case 4: $r=15*$qtynights;break;
		case 5: $r=20*$qtynights;break;
		case 6: $r=20*$qtynights;break;
		default: $r=5*$qtynights;
	}
	return $r;
}

function browse_images($dir) {
		$folder = $dir;
		$filetype = '*.*';
		$files = glob($folder.$filetype);
		$count = count($files);
		for ($i = 0; $i < $count; $i++) {
			$images[$i] = $files[$i];
		}
	return $images;
}
			
function convert_amount_to_percent($totalAmount, $discountedAmount){
	$percent=(($discountedAmount*100)/$totalAmount);
	
	return number_format($percent,2);
}

function readmore_villas($string,$id){
	// strip tags to avoid breaking any html
	$string = strip_tags($string);
	if (strlen($string) > 300) {
		// truncate string
		$stringCut = substr($string, 0, 300);
		// make sure it ends in a word so assassinate doesn't become ass...
		$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="../vacationrentals/villa-details.php?v='.$id.'" target="_blank">Read More</a>'; 
		//$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
	}
	return $string;
}

function readmore_villas_tiny($string,$id){
	// strip tags to avoid breaking any html
	$string = strip_tags($string);
	if (strlen($string) > 70) {
		// truncate string
		$stringCut = substr($string, 0, 70);
		// make sure it ends in a word so assassinate doesn't become ass...
		$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="../vacationrentals/villa-details.php?v='.$id.'" target="_blank">Read More</a>'; 
		//$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
	}
	return $string;
}

function servicios_reserva($array_servicios,$qty_nights, $bed){
    // print_r($array_servicios);
	if($array_servicios){
		
      ?>
        <table cellpadding="0px" style="border: 1px solid #9c0000;" align="right" width="100%">
		    <tbody>
			  <tr>
				  <td><strong>Select</strong></td>
				  <td align="center"><strong>Services</strong></td>
				   <td><strong>Tax</strong></td>
				  <td><strong>Qty</strong></td>
			  </tr>
			  <?
			foreach($array_servicios AS $k){
				if(($k['beds']==$bed) || ($k['beds']==0)) {
			?>
				<tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">
					<td>
						<input type="checkbox" <? if ($k['optional']==2){ ?>  checked="checked" <? } ?> value="<?=$k['id']?>" name="servicesLR[<?=$k['id']?>]" />
					</td>
					<td>
						 <?=$k['descrip']?>	(US$  <?=$k['price']?>)
					</td>
					<td>
						 <?=$k['tax']*100?>%
					</td>
					<td>
						<select name="servicesLR_qty[<?=$k['id']?>]">
							<? for($i=1; $i<=$qty_nights; $i++ ){?>}
								<option value="<?=$i?>"><?=$i?></option>
							<? }?>
						</select>
						<input type="hidden" name="servicesLR_price[<?=$k['id']?>]" value="<?=$k['price']?>" />
						<input type="hidden" name="servicesLR_tax[<?=$k['id']?>]" value="<?=$k['tax']?>" />
						<input type="hidden" name="servicesLR_desc[<?=$k['id']?>]" value="<?=$k['descrip']?>" />
					</td>
				</tr>
			<?
				}
			}
			?>	
			</tbody>
		</table>
          	<? 
		
	}			
 }
 
 function servicios_reserva_edit($array_servicios,$qty_nights, $bed,$previous_chosen){
    // print_r($previous_chosen);
	if($array_servicios){
		
      ?>
        <table cellpadding="0px" style="border: 1px solid #9c0000;" align="right" width="100%">
		    <tbody>
			  <tr>
				  <td><strong>Select</strong></td>
				  <td align="center"><strong>Services</strong></td>
				   <td><strong>Tax</strong></td>
				  <td><strong>Qty</strong></td>
			  </tr>
			  <?
			foreach($array_servicios AS $k){
				if(($k['beds']==$bed) || ($k['beds']==0)) {
			?>
				<tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">
					<td>
						<input type="checkbox" <? if ($k['optional']==2){ ?>  checked="checked" <? } ?> value="<?=$k['id']?>" <? if ($previous_chosen[$k['id']]['id']==$k['id']){ ?>  checked="checked" <? } ?> value="<?=$k['id']?>" name="servicesLR[<?=$k['id']?>]" />
					</td>
					<td>
						 <?=$k['descrip']?>	(US$  <?=$k['price']?>)
					</td>
					<td>
						 <?=$k['tax']*100?>%
					</td>
					<td>
						<select name="servicesLR_qty[<?=$k['id']?>]">
							<? for($i=1; $i<=$qty_nights; $i++ ){?>}
								<option value="<?=$i?>" <? if ($previous_chosen[$k['id']]['qty']==$i){ ?>  selected="selected" <? } ?> ><?=$i?></option>
							<? }?>
						</select>
						<input type="hidden" name="servicesLR_price[<?=$k['id']?>]" value="<?=$k['price']?>" />
						<input type="hidden" name="servicesLR_tax[<?=$k['id']?>]" value="<?=$k['tax']?>" />
						<input type="hidden" name="servicesLR_desc[<?=$k['id']?>]" value="<?=$k['descrip']?>" />
					</td>
				</tr>
			<?
				}
			}
			?>	
			</tbody>
		</table>
          	<? 
		
	}			
 }
 
 
 function servicios_reserva_hidden($array_servicios,$qty_nights, $bed){
    // print_r($array_servicios);
	if($array_servicios){
		
			foreach($array_servicios AS $k){
				if($k['beds']==$bed) {
					
					if ($k['optional']==2){/*La option es obligatoria para esta villa*/		
			?>
						<input type="hidden" name="servicesLR[<?=$k['id']?>]" value="<?=$k['id']?>" />
						<input type="hidden" name="servicesLR_qty[<?=$k['id']?>]" value="1" />
						
						<input type="hidden" name="servicesLR_price[<?=$k['id']?>]" value="<?=$k['price']?>" />
						<input type="hidden" name="servicesLR_tax[<?=$k['id']?>]" value="<?=$k['tax']?>" />
						<input type="hidden" name="servicesLR_desc[<?=$k['id']?>]" value="<?=$k['descrip']?>" />
					
			<?		}
				}
			}		
	}			
 }


function daysDifference2($endDate, $beginDate){ //WITHOUT 2 THIS FUNCTION IS DUPLICATED-this work fine but with warnings sometimes if not add @ begining
	   //explode the date by "-" and storing to array
	   $date_parts1=explode("-", $beginDate);
	   $date_parts2=explode("-", $endDate);
	   //gregoriantojd() Converts a Gregorian date to Julian Day Count
	   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	   return $end_date - $start_date;
}
   
function auto_promotion($checkin, $checkout, $price, $code){
	$code=addslashes(utf8_encode($code));
	$nowdate=date('Y-m-d');
	$noches=daysDifference2(date('Y-m-d', strtotime($checkout)), date('Y-m-d', strtotime($checkin)));
	//$noches='5';
	//buscar promocion en base de datos (entrada, salida, noches, fecha de ahora)
	$link=new getQueries;
	$pro=$link->display_table($table='promotion', $condition=" DATE(desde)<'".$checkout."' AND DATE(hasta)>='".$checkin."' AND DATE(bookingfrom)<='".$nowdate."' AND DATE(bookingto)>='".$nowdate."' AND min_days<='".$noches."' AND max_days>='".$noches."' AND active='1' AND code='".$code."'", $order='id');
	
	if($pro){
		$promo=array();
		/*if((strtotime($pro[0]['hasta'])>=strtotime($checkout)) AND (strtotime($pro[0]['desde'])<=strtotime($checkin))){*/
			//COVER ALL THE BOOKING
			switch($pro[0]['tipo']){
				case 1://1-percent
				$price-=$price*($pro[0]['qty']/100);
				$promo['qty_perc']=$pro[0]['qty'];
				break;
				case 2://2-amount
				$promotion_apply=$pro[0]['qty']." USD off";
				#$discount_percent='';
				break;	
				case 3://3-nights
				$promotion_apply=$pro[0]['qty']." nights free";
				#$discount_percent='';
				break;
			}
						
			$promo['code']=$pro[0]['code'];
			$promo['title']=$pro[0]['title'];
			$promo['fin']=$pro[0]['bookingto'];
			$promo['price']=$price;
			$promo['msg']='Sale!';
			$promo['id']=$pro[0]['id'];
			
		/*}elseif(($pro[1]['hasta']>=$checkout) AND ($pro[1]['desde']<=$checkin)){
			//calculate how many nights apply
			//add others promotions
			
		}else{
			
		}*/
	}
	//return $noches;
	return $promo;
}

function put_villa_dirty($villaid){
	$link=new DB();	$data= new getQueries ();
    $clean=$data->clean($villaid); //get information for actual villa in cleaning table
    if ($clean){//record found
     $link->up_clean($clean['id'], $_SESSION['info']['id'], $villaid, 2,$esta_nota='');//dirty
    }else{//there is not records found - create a new
     $link->in_clean($_SESSION['info']['id'], $villaid, 2,$esta_nota=''); //dirty
    }
	return true;
}

 function price_mid($bed, $normal_price){
     require_once('class/getQueries.php');
     $db=new getQueries;
     $prices_setting=$db->show_any_data_limit1($table='price_settings', $field='active', $value='1', $operator='=');
     if($prices_setting[0]){
     	switch($bed){
			case 2: 
				$new_price=$normal_price-($normal_price*$prices_setting[0]['mid2bdr']/100);
				break;
			case 3: 
				$new_price=$normal_price-($normal_price*$prices_setting[0]['mid3bdr']/100);
				break;
			case 4: 
				$new_price=$normal_price-($normal_price*$prices_setting[0]['mid4bdr']/100);
				break;
			case 5:
				$new_price=$normal_price-($normal_price*$prices_setting[0]['mid5bdr']/100);
				break;
			case 6:
				$new_price=$normal_price-($normal_price*$prices_setting[0]['mid6bdr']/100);
				break;
			default:
				$new_price=$normal_price;
		}
     }else{
		 $new_price=$normal_price;
	 }
   return $new_price;
   }
   
   function price_short_auto($bed, $normal_price){
     require_once('class/getQueries.php');
     $db=new getQueries;
     $prices_setting=$db->show_any_data_limit1($table='price_settings', $field='active', $value='1', $operator='=');
     if($prices_setting[0]){
     	switch($bed){
			case 2: 
				$new_price=$normal_price-($normal_price*$prices_setting[0]['short2bdr']/100);
				break;
			case 3: 
				$new_price=$normal_price-($normal_price*$prices_setting[0]['short3bdr']/100);
				break;
			case 4: 
				$new_price=$normal_price-($normal_price*$prices_setting[0]['short4bdr']/100);
				break;
			case 5:
				$new_price=$normal_price-($normal_price*$prices_setting[0]['short5bdr']/100);
				break;
			case 6:
				$new_price=$normal_price-($normal_price*$prices_setting[0]['short6bdr']/100);
				break;
			default:
				$new_price=$normal_price;
		}
     }else{
		 $new_price=$normal_price;
	 }
   return $new_price;
   }


 function url_encode($string){
     return urlencode(utf8_encode($string));
 }

 function url_decode($string){
     return utf8_decode(urldecode($string));
 }

function breakdate($date){
	 $fecha=strtotime($date);
	 $nuevafecha=date('Y-m-d', $fecha);
  	 $pieces_date=explode("-", $nuevafecha);
	 $fecha_datos=array();
	 $fecha_datos['year']=$pieces_date[0]; //year
	 $fecha_datos['month']=$pieces_date[1]; //month
	 $fecha_datos['day']=$pieces_date[2];  //day
return 	$fecha_datos;
}

/*function login($user,$pass){

	$sql="SELECT * FROM `".prefijo."users` WHERE username="$user"AND password=".$pass." AND active=1";

	return ($userid);
	}     */
	
function whatSource($array){
	$sources=array();
	foreach($array AS $k){
		
		if(($k['line']==2)||($k['line']==4)){
			//referral
			$sources['referral']+=1;
		}else{
			$db=new getQueries (); 
			 $agent_comision=$db->showTable_r($table='bookingreferred', $field='ref_book', $value=$k['ref'], $operator='=');
			 if($agent_comision[0]){//see what type of agent
				$agent=$db->showTable_r($table='commission', $field='id', $value=$agent_comision[0]['id_referal'], $operator='=');
				
				if($agent[0]['tipo']==3){
					//booking engine
					$sources['engine']+=1;
				}else{
					//or referral internal 
					$sources['referral']+=1;
				}
				
			 }else{
				//direct
				$sources['direct']+=1;
			 }
		
		}
	}
	return $sources;
}	
function cancelled_invoice($ref, $name_user, $invoice_id, $invoice_amount){
	
		$body="<!doctype html>
		<html>
		<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>Booking Confirmation-Residencial Casa Linda</title>
		<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
		</head>


		<body>
		<div class=\"container\">
		<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

		<p>&nbsp;</p>
		<p>Dear Reservation Department,</p>

		<p>$name_user has cancelled invoice $invoice_id,<br/>
		<strong>BOOKING INVOICE: $ref
		  
		  </strong></p>
		<p><strong>Invoiced amount was: $invoice_amount USD<br></p>
		
		<p>Best wishes,
		  The Casa Linda team!</p>
		<p><br>
		  Residencial Casa Linda <br>
		  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
		  Tel: +1 809 571 1190 <br>
		  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
		  <a href=\"mailto:reception@casalindacity.com\">Reception@casalindacity.com</a></p>
		</div>
		</body>
		</html>";
	return $body;
}	
function infoTicketHtml_details($ticket, $details, $toNameLastname, $fromNamelastname){
	
		$body="<!doctype html>
		<html>
		<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>Booking Confirmation-Residencial Casa Linda</title>
		<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
		</head>


		<body>
		<div class=\"container\">
		<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

		<p>&nbsp;</p>
		<p>Dear $toNameLastname,</p>

		<p>A new ticket with the number $ticket, has been generated (by $fromNamelastname) requiring your attention at Residencial Casa Linda<br/>
		</p>
		
		<p>Details: <br/>$details
		</p>
		
		<p>Please, login to the system to follow up and process this ticket.</p>
		
		
		<p>Best wishes,
		  The Casa Linda team!</p>
		<p><br>
		  Residencial Casa Linda <br>
		  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
		  Tel: +1 809 571 1190 <br>
		  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
		  <a href=\"mailto:reception@casalindacity.com\">Reception@casalindacity.com</a></p>
		</div>
		</body>
		</html>";
	return $body;
}	
function infoTicketHtml($ticket, $toNameLastname, $fromNamelastname){
	
		$body="<!doctype html>
		<html>
		<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>Booking Confirmation-Residencial Casa Linda</title>
		<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
		</head>


		<body>
		<div class=\"container\">
		<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

		<p>&nbsp;</p>
		<p>Dear $toNameLastname,</p>

		<p>A new ticket with the number $ticket, has been generated (by $fromNamelastname) requiring your attention at Residencial Casa Linda<br/>
		</p>
		
		<p>Please, login to the system to follow up and process this ticket.</p>
		
		
		<p>Best wishes,
		  The Casa Linda team!</p>
		<p><br>
		  Residencial Casa Linda <br>
		  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
		  Tel: +1 809 571 1190 <br>
		  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
		  <a href=\"mailto:reception@casalindacity.com\">Reception@casalindacity.com</a></p>
		</div>
		</body>
		</html>";
	return $body;
}	
function infoTicketHtml1($ticket, $toNameLastname, $fromNamelastname){
	
		$body="<!doctype html>
		<html>
		<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>Booking Confirmation-Residencial Casa Linda</title>
		<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
		</head>


		<body>
		<div class=\"container\">
		<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

		<p>&nbsp;</p>
		<p>Dear $toNameLastname,</p>

		<p>A ticket with the number $ticket, has been changed (by $fromNamelastname) requiring your attention at Residencial Casa Linda<br/>
		</p>
		
		<p>Please, login to the system to follow up and process this ticket.</p>
		
		
		<p>Best wishes,
		  The Casa Linda team!</p>
		<p><br>
		  Residencial Casa Linda <br>
		  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
		  Tel: +1 809 571 1190 <br>
		  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
		  <a href=\"mailto:reception@casalindacity.com\">Reception@casalindacity.com</a></p>
		</div>
		</body>
		</html>";
	return $body;
}	

function infoTicketHtml2($ticket, $toNameLastname, $fromNamelastname){
	
		$body="<!doctype html>
		<html>
		<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>Booking Confirmation-Residencial Casa Linda</title>
		<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
		</head>


		<body>
		<div class=\"container\">
		<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

		<p>&nbsp;</p>
		<p>Dear $toNameLastname,</p>

		<p>Your ticket with the number $ticket, has been CANCELLED (by $fromNamelastname) at Residencial Casa Linda<br/>
		</p>
		
		<p>Please, login to the system to see more details about this ticket.</p>
		
		
		<p>Best wishes,
		  The Casa Linda team!</p>
		<p><br>
		  Residencial Casa Linda <br>
		  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
		  Tel: +1 809 571 1190 <br>
		  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
		  <a href=\"mailto:reception@casalindacity.com\">Reception@casalindacity.com</a></p>
		</div>
		</body>
		</html>";
	return $body;
}	
	
function booking_info_short($ref, $general_amount, $PAYMENT_DUE, $name_referral_client, $villa_number, $qty_nights, $starting, $ending){
	$total_sin_impuestos=number_format(($general_amount/1.18),2);//RETURN QUANTITIES WITHOUT TAXES
	$impuestos=number_format(($total_sin_impuestos*0.18),2);

		$body="<!doctype html>
		<html>
		<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>Booking Confirmation-Residencial Casa Linda</title>
		<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
		</head>


		<body>
		<div class=\"container\">
		<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

		<p>&nbsp;</p>
		<p>Dear $name_referral_client,</p>

		<p>Thank you for booking with Residencial Casa Linda,
		<p><strong>BOOKING CONFIRMATION: $ref
		  
		  </strong>
		<p><strong>To stay in villa $villa_number for $qty_nights nights<br>
		  Check-In $starting Check-in time: 3.00 PM<br>
		  Check-Out
		</strong><strong> $ending
		  Check-out time: 12.00 Noon<br>
		  <br>
		  Price: $total_sin_impuestos USD
		  <br>
		  Taxes:
		  $impuestos USD<br>
		  Total price: $general_amount USD<br>
		  Balance due: $PAYMENT_DUE USD</strong></p>
		<p>  <br>
		  Bring yours and all adults who checks in with you passport or Valid ID into the check-in office in order to check-in.<br>
		  We will ask for a security deposit of 75USD per room, this can be in cash or 
		  CC slip.<br>
		</p>
		<p>Our office is located on the first gate to the left on El Choco Road.  </p>
		<p>  Upon arrival you will recieve all controls and keys for the villa, when you come to the villa there will be a free water 5-gallon.
		  <br>
		  If you need any more come by the office with the empty one and for a small fee we will replace it for a full one.
		  <br>
		  There will also be an inventory list of what was there upon check-in from our staff, 
		  please go through this as you are responsible for any breakage in the villa during your stay. <br>
		  <br>
		 You will recieve a one time welcome package in the villa:</p>
		<ul>
		  <li>Coffee</li>
		  <li>Shampoo</li>
		  <li>Bodywash</li>
		  <li>Dish Soap</li>
		  <li>Sponge</li>
		</ul>
		<p>Residencial Casa Linda strives to create the best relaxed and enjoyable vacations for all of our clients.<br>
		  Therefore please respect our rules regarding parties and loud noices during your stay, more info will be give upon arrival.
		</p>
		<p>Daily housekeeping and pool service is included in your villa as well as Free shuttle bus from Sosua to Cabarete on a schedule.<br>
		  <br>
		  Don\'t miss out on our extra services we offer, airport pickup, excursions, car rental and more!<br>
		More info on our website!</p>
		<p>Best wishes,
		  The Casa Linda team!</p>
		<p>If you have any questions feel free to contact us.<br>
		  Residencial Casa Linda <br>
		  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
		  Tel: +1 809 571 1190 <br>
		  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
		  <a href=\"mailto:reception@casalindacity.com\">Reception@casalindacity.com</a></p>
		<p><small><strong>Unless you have paid in full, remember that you will receive invoices as we are closing up to arrival date (as per cancellation rules). <br>
		Failure in doing this may result in a cancellation.
		This way you will be fully paid for a smoother check-in.</strong></small> <strong><br>
		<small><a href=\"http://www.casalindacity.com/Terms_and_conditions.php\" target=\"new\">Terms and Conditions </a></small></strong></p>
		</div>
		</body>
		</html>";
	return $body;
}	
function cancellation_email($ref, $general_amount, $cancellation_fee, $name_referral_client, $villa_number, $qty_nights, $starting, $ending){
	
	/*$general_amount, 

	
	$starting, 
	$ending*/
	
	$body="<!doctype html>
			<html>
			<head>
			<meta charset=\"utf-8\">
			<title>Untitled Document</title>
			</head>

			<body>
			</body>
			</html>
			<!doctype html>
			<html>
			<head>
			<meta charset=\"utf-8\">
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
			<title>Booking Cancellation-Residencial Casa Linda</title>
			<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
			</head>


			<body>
			<div class=\"container\">
			<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

			<p>&nbsp;</p>
			<p>Dear $name_referral_client,</p>
			<p>Cancellation at Residencial Casa Linda, </p>
			<p>
			<p><strong>BOOKING CANCELLATION: $ref. </strong> </p>
			<p>
			<p><strong>For the stay in villa $villa_number for $qty_nights nights<br>
			  Check-In $starting		 Check-in time: 3.00 PM<br>
			  Check-Out </strong><strong> $ending
				Check-out time: 12.00 Noon<br>
				<br>
				Price: $total_sin_impuestos USD <br>
				Taxes:
				$impuestos USD<br>
				Total price: $general_amount USD<br>
				Cancellation Charge: $cancellation_fee USD<br>
			</strong></p>
			<p>Regarding cancellation rules see below as agreed upon when making the reservation. </p>
			<p> This is to inform you that your reservation has been cancelled with us upon request from you or due to not paying acording to reservation rules.<br>
			  Please be aware that if there was a deposit made it will be charged according to our cancellation rules that are listed in terms and conditions. </p>

			<p>We are sorry to loose your reservation and hope to have you staying with us shortly in the future.</p>

			<p>More info on our website!</p>
			<p>Best wishes,
			  The Casa Linda team!</p>
			<p>If you have any questions regarding this email or you did not wish to cancel please feel free to contact us.<br>
			  Residencial Casa Linda <br>
			  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
			  Tel: +1 809 571 1190 <br>
			  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
			  <a href=\"mailto:Reception@casalindacity.com\">Reception@casalindacity.com</a></p>
			<p><strong><span style=\"font-size: 12px; line-height: 17px;\">Please see below link for more information regarding charges in reservations.</span><br>
			  <small><a href=\"http://www.casalindacity.com/Terms_and_conditions.php\" target=\"new\">Terms and Conditions </a></small></strong></p>
			</div>
			</body>
			</html>";
	return $body;
}


function infoPriceChanged($username, $ref, $villano){
	
		$body="<!doctype html>
		<html>
		<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>Booking Confirmation-Residencial Casa Linda</title>
		<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
		</head>


		<body>
		<div class=\"container\">
		<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

		<p>&nbsp;</p>
		<p>Dear Rental Department,</p>

		<p>$username, has changed the price for the villa no. $villano to booking no. $ref on date ".date('l jS \of F Y h:i:s A').".<br/>
		</p>
		
		<p>Please, do not reply to this email as this is an automatic notification from the system.</p>
		
		
		<p>Best wishes,
		  The Casa Linda team!</p>
		<p><br>
		  Residencial Casa Linda <br>
		  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
		  Tel: +1 809 571 1190 <br>
		  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
		  <a href=\"mailto:reception@casalindacity.com\">Reception@casalindacity.com</a></p>
		</div>
		</body>
		</html>";
	return $body;
}

 function formatear_fecha($date){
  $formato=strtotime($date);
  $fecha_format=date('D. F j, Y', $formato);

  return ($fecha_format);
 }

 function date_to_insert($date){
  $formato=strtotime($date);
  $fecha_format=date('Y-m-d', $formato);

  return ($fecha_format);
 }

 function calcula_numero_dia_semana($dia,$mes,$ano){
	$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));
	if ($numerodiasemana == 0)
		$numerodiasemana = 6;
	else
		$numerodiasemana--;
	return $numerodiasemana;
}

//funcion que devuelve el �ltimo d�a de un mes y a�o dados
function ultimoDia($mes,$ano){
    $ultimo_dia=28;
    while (checkdate($mes,$ultimo_dia + 1,$ano)){
       $ultimo_dia++;
    }
    return $ultimo_dia;
}

function dame_nombre_mes($mes){
	 switch ($mes){
	 	case 1:
			$nombre_mes="January";
			break;
	 	case 2:
			$nombre_mes="February";
			break;
	 	case 3:
			$nombre_mes="March";
			break;
	 	case 4:
			$nombre_mes="April";
			break;
	 	case 5:
			$nombre_mes="May";
			break;
	 	case 6:
			$nombre_mes="June";
			break;
	 	case 7:
			$nombre_mes="July";
			break;
	 	case 8:
			$nombre_mes="August";
			break;
	 	case 9:
			$nombre_mes="September";
			break;
	 	case 10:
			$nombre_mes="October";
			break;
	 	case 11:
			$nombre_mes="November";
			break;
	 	case 12:
			$nombre_mes="December";
			break;
	}
	return $nombre_mes;
}

function datediff($interval, $datefrom, $dateto, $using_timestamps = false)
{



	if (!$using_timestamps) {
		$datefrom = strtotime($datefrom, 0);
		$dateto = strtotime($dateto, 0);
	}
	$difference = $dateto - $datefrom; // Difference in seconds

	switch($interval) {
		case 'yyyy': // Number of full years
		$years_difference = floor($difference / 31536000);
		if (mktime(date("H", $datefrom),
                              date("i", $datefrom),
                              date("s", $datefrom),
                              date("n", $datefrom),
                              date("j", $datefrom),
                              date("Y", $datefrom)+$years_difference) > $dateto) {

		$years_difference--;
		}
		if (mktime(date("H", $dateto),
                              date("i", $dateto),
                              date("s", $dateto),
                              date("n", $dateto),
                              date("j", $dateto),
                              date("Y", $dateto)-($years_difference+1)) > $datefrom) {

		$years_difference++;
		}
		$datediff = $years_difference;
		break;

		case "q": // Number of full quarters
		$quarters_difference = floor($difference / 8035200);
		while (mktime(date("H", $datefrom),
                                   date("i", $datefrom),
                                   date("s", $datefrom),
                                   date("n", $datefrom)+($quarters_difference*3),
                                   date("j", $dateto),
                                   date("Y", $datefrom)) < $dateto) {

		$months_difference++;
		}
		$quarters_difference--;
		$datediff = $quarters_difference;
		break;

		case "ww": // Number of full weeks
		$datediff = floor($difference / (60*60*24));
		break;

  		case "d": // Number of full days - ing.joseluis@msn.com
		$datediff = floor($difference / 86400);
		break;

		case "h": // Number of full hours
		$datediff = floor($difference / 3600);
		break;

		case "n": // Number of full minutes
		$datediff = floor($difference / 60);
		break;

		default: // Number of full seconds (default)
		$datediff = $difference;
		break;
	}

	return $datediff;
}


function display($page){
	require_once(TEMP_DIR.HEAD);
	require_once(DIR_PAGE."page-".$page.PHP_EXT);
	require_once(TEMP_DIR.FOOTER);
	}
function display_1($page){
	require_once(TEMP_DIR.HEAD_SIMPLE);
	require_once(DIR_PAGE."page-".$page.PHP_EXT);
	require_once(TEMP_DIR.FOOTER_SIMPLE);
	}
/*function display_mobile($page){
	require_once('template/header_mobile.php');
	require_once('pages/page-'.$page.PHP_EXT);
	require_once('template/footer_mobile.php');
	}*/
function countryArray(){

	return array(
	'CA'=>'Canada',
	'US'=>'United States',
	'DO'=>'Dominican Republic',
    'NO'=>'Norway',
	'UK'=>'United Kingdom',
    'DE'=>'Germany',
    'FR'=>'France',
    'ES'=>'Spain',
	'AF'=>'Afghanistan',
	'AL'=>'Albania',
	'DZ'=>'Algeria',
	'AS'=>'American Samoa',
	'AD'=>'Andorra',
	'AO'=>'Angola',
	'AI'=>'Anguilla',
	'AQ'=>'Antarctica',
	'AG'=>'Antigua And Barbuda',
	'AR'=>'Argentina',
	'AM'=>'Armenia',
	'AW'=>'Aruba',
	'AU'=>'Australia',
	'AT'=>'Austria',
	'AZ'=>'Azerbaijan',
	'BS'=>'Bahamas',
	'BH'=>'Bahrain',
	'BD'=>'Bangladesh',
	'BB'=>'Barbados',
	'BY'=>'Belarus',
	'BE'=>'Belgium',
	'BZ'=>'Belize',
	'BJ'=>'Benin',
	'BM'=>'Bermuda',
	'BT'=>'Bhutan',
	'BO'=>'Bolivia',
	'BA'=>'Bosnia And Herzegovina',
	'BW'=>'Botswana',
	'BV'=>'Bouvet Island',
	'BR'=>'Brazil',
	'IO'=>'British Indian Ocean Territory',
	'BN'=>'Brunei',
	'BG'=>'Bulgaria',
	'BF'=>'Burkina Faso',
	'BI'=>'Burundi',
	'KH'=>'Cambodia',
	'CM'=>'Cameroon',
 	'CV'=>'Cape Verde',
	'KY'=>'Cayman Islands',
	'CF'=>'Central African Republic',
	'TD'=>'Chad',
	'CL'=>'Chile',
	'CN'=>'China',
	'CX'=>'Christmas Island',
	'CC'=>'Cocos (Keeling) Islands',
	'CO'=>'Columbia',
	'KM'=>'Comoros',
	'CG'=>'Congo',
	'CK'=>'Cook Islands',
	'CR'=>'Costa Rica',
	'CI'=>'Cote D\'Ivorie (Ivory Coast)',
	'HR'=>'Croatia (Hrvatska)',
	'CU'=>'Cuba',
	'CY'=>'Cyprus',
	'CZ'=>'Czech Republic',
	'CD'=>'Democratic Republic Of Congo (Zaire)',
	'DK'=>'Denmark',
	'DJ'=>'Djibouti',
	'DM'=>'Dominica',
 	'TP'=>'East Timor',
	'EC'=>'Ecuador',
	'EG'=>'Egypt',
	'SV'=>'El Salvador',
	'GQ'=>'Equatorial Guinea',
	'ER'=>'Eritrea',
	'EE'=>'Estonia',
	'ET'=>'Ethiopia',
	'FK'=>'Falkland Islands (Malvinas)',
	'FO'=>'Faroe Islands',
	'FJ'=>'Fiji',
	'FI'=>'Finland',
 	'FX'=>'France, Metropolitan',
	'GF'=>'French Guinea',
	'PF'=>'French Polynesia',
	'TF'=>'French Southern Territories',
	'GA'=>'Gabon',
	'GM'=>'Gambia',
	'GE'=>'Georgia',
 	'GH'=>'Ghana',
	'GI'=>'Gibraltar',
	'GR'=>'Greece',
	'GL'=>'Greenland',
	'GD'=>'Grenada',
	'GP'=>'Guadeloupe',
	'GU'=>'Guam',
	'GT'=>'Guatemala',
	'GN'=>'Guinea',
	'GW'=>'Guinea-Bissau',
	'GY'=>'Guyana',
	'HT'=>'Haiti',
	'HM'=>'Heard And McDonald Islands',
	'HN'=>'Honduras',
	'HK'=>'Hong Kong',
	'HU'=>'Hungary',
	'IS'=>'Iceland',
	'IN'=>'India',
	'ID'=>'Indonesia',
	'IR'=>'Iran',
	'IQ'=>'Iraq',
	'IE'=>'Ireland',
	'EI'=>'Ireland (Eire)',
	'IL'=>'Israel',
	'IT'=>'Italy',
	'JM'=>'Jamaica',
	'JP'=>'Japan',
	'JO'=>'Jordan',
	'KZ'=>'Kazakhstan',
	'KE'=>'Kenya',
	'KI'=>'Kiribati',
	'KW'=>'Kuwait',
	'KG'=>'Kyrgyzstan',
	'LA'=>'Laos',
	'LV'=>'Latvia',
	'LB'=>'Lebanon',
	'LS'=>'Lesotho',
	'LR'=>'Liberia',
	'LY'=>'Libya',
	'LI'=>'Liechtenstein',
	'LT'=>'Lithuania',
	'LU'=>'Luxembourg',
	'MO'=>'Macau',
	'MK'=>'Macedonia',
	'MG'=>'Madagascar',
	'MW'=>'Malawi',
	'MY'=>'Malaysia',
	'MV'=>'Maldives',
	'ML'=>'Mali',
	'MT'=>'Malta',
	'MH'=>'Marshall Islands',
	'MQ'=>'Martinique',
	'MR'=>'Mauritania',
	'MU'=>'Mauritius',
	'YT'=>'Mayotte',
	'MX'=>'Mexico',
	'FM'=>'Micronesia',
	'MD'=>'Moldova',
	'MC'=>'Monaco',
	'MN'=>'Mongolia',
	'MS'=>'Montserrat',
	'MA'=>'Morocco',
	'MZ'=>'Mozambique',
	'MM'=>'Myanmar (Burma)',
	'NA'=>'Namibia',
	'NR'=>'Nauru',
	'NP'=>'Nepal',
	'NL'=>'Netherlands',
	'AN'=>'Netherlands Antilles',
	'NC'=>'New Caledonia',
	'NZ'=>'New Zealand',
	'NI'=>'Nicaragua',
	'NE'=>'Niger',
	'NG'=>'Nigeria',
	'NU'=>'Niue',
	'NF'=>'Norfolk Island',
	'KP'=>'North Korea',
	'MP'=>'Northern Mariana Islands',
 	'OM'=>'Oman',
	'PK'=>'Pakistan',
	'PW'=>'Palau',
	'PA'=>'Panama',
	'PG'=>'Papua New Guinea',
	'PY'=>'Paraguay',
	'PE'=>'Peru',
	'PH'=>'Philippines',
	'PN'=>'Pitcairn',
	'PL'=>'Poland',
	'PT'=>'Portugal',
	'PR'=>'Puerto Rico',
	'QA'=>'Qatar',
	'RE'=>'Reunion',
	'RO'=>'Romania',
	'RU'=>'Russia',
	'RW'=>'Rwanda',
	'SH'=>'Saint Helena',
	'KN'=>'Saint Kitts And Nevis',
	'LC'=>'Saint Lucia',
	'PM'=>'Saint Pierre And Miquelon',
	'VC'=>'Saint Vincent And The Grenadines',
	'SM'=>'San Marino',
	'ST'=>'Sao Tome And Principe',
	'SA'=>'Saudi Arabia',
	'SN'=>'Senegal',
	'SC'=>'Seychelles',
	'SL'=>'Sierra Leone',
	'SG'=>'Singapore',
	'SK'=>'Slovak Republic',
	'SI'=>'Slovenia',
	'SB'=>'Solomon Islands',
	'SO'=>'Somalia',
	'ZA'=>'South Africa',
	'GS'=>'South Georgia And South Sandwich Islands',
	'KR'=>'South Korea',
    'LK'=>'Sri Lanka',
	'SD'=>'Sudan',
	'SR'=>'Suriname',
	'SJ'=>'Svalbard And Jan Mayen',
	'SZ'=>'Swaziland',
	'SE'=>'Sweden',
	'CH'=>'Switzerland',
	'SY'=>'Syria',
	'TW'=>'Taiwan',
	'TJ'=>'Tajikistan',
	'TZ'=>'Tanzania',
	'TH'=>'Thailand',
	'TG'=>'Togo',
	'TK'=>'Tokelau',
	'TO'=>'Tonga',
	'TT'=>'Trinidad And Tobago',
	'TN'=>'Tunisia',
	'TR'=>'Turkey',
	'TM'=>'Turkmenistan',
	'TC'=>'Turks And Caicos Islands',
	'TV'=>'Tuvalu',
	'UG'=>'Uganda',
	'UA'=>'Ukraine',
	'AE'=>'United Arab Emirates',
 	'UM'=>'United States Minor Outlying Islands',
	'UY'=>'Uruguay',
	'UZ'=>'Uzbekistan',
	'VU'=>'Vanuatu',
	'VA'=>'Vatican City (Holy See)',
	'VE'=>'Venezuela',
	'VN'=>'Vietnam',
	'VG'=>'Virgin Islands (British)',
	'VI'=>'Virgin Islands (US)',
	'WF'=>'Wallis And Futuna Islands',
	'EH'=>'Western Sahara',
	'WS'=>'Western Samoa',
	'YE'=>'Yemen',
	'YU'=>'Yugoslavia',
	'ZM'=>'Zambia',
	'ZW'=>'Zimbabwe'
	);
}

function cities($country){
    switch ($country){

    	case "US":
    		return array(
						'un'=>'Unknown',
    					'AB'=>'Alabama',
						'AL'=>'Alaska',
						'AS'=>'American Samoa',
						'AR'=>'Arizona',
						'AK'=>'Arkansas',
						'CA'=>'California',
						'CO'=>'Colorado',
						'CN'=>'Connecticut',
						'DE'=>'Delaware',
						'DC'=>'District of Columbia',
						'FL'=>'Florida',
						'GE'=>'Georgia',
						'GU'=>'Guam',
						'HA'=>'Hawaii',
						'ID'=>'Idaho',
						'IL'=>'Illinois',
						'IN'=>'Indiana',
						'IO'=>'Iowa',
						'KA'=>'Kansas',
						'KE'=>'Kentucky',
						'LO'=>'Louisiana',
						'MA'=>'Maine',
						'ML'=>'Maryland',
						'MS'=>'Massachusetts',
						'MI'=>'Michigan',
						'MN'=>'Minnesota',
						'MP'=>'Mississippi',
						'Mu'=>'Missouri',
						'MO'=>'Montana',
						'NE'=>'Nebraska',
						'NV'=>'Nevada',
						'NH'=>'New Hampshire',
						'NJ'=>'New Jersey',
						'NM'=>'New Mexico',
						'NY'=>'New York',
						'NC'=>'North Carolina',
						'ND'=>'North Dakota',
						'NI'=>'Northern Marianas Islands',
						'OH'=>'Ohio',
						'OK'=>'Oklahoma',
						'OR'=>'Oregon',
						'PE'=>'Pennsylvania',
						'PR'=>'Puerto Rico',
						'RI'=>'Rhode Island',
						'SC'=>'South Carolina',
						'SD'=>'South Dakota',
						'TE'=>'Tennessee',
						'TX'=>'Texas',
						'UT'=>'Utah',
						'VE'=>'Vermont',
						'VI'=>'Virginia',
						'VS'=>'Virgin Islands',
						'WA'=>'Washington',
						'WV'=>'West Virginia',
						'WI'=>'Wisconsin',
						'WY'=>'Wyoming'
				);
			break;
		case "CA":
    		return array(
					'un'=>'Unknown',
		    		'AL'=>'Alberta',
					'BC'=>'British Columbia',
					'MA'=>'Manitoba',
					'NB'=>'New Brunswick',
					'NL'=>'Newfoundland and Labrador',
					'NT'=>'Northwest Territories',
					'NS'=>'Nova Scotia',
					'NU'=>'Nunavut',
					'ON'=>'Ontario',
					'PI'=>'Prince Edward Island',
					'QU'=>'Quebec',
					'SA'=>'Saskatchewan',
					'YU'=>'Yukon Territory'
				);
			break;

		case "DO":
    		return array(
				'un'=>'Unknown',
    			'DN'=>'DN-Santo Domingo',
				'AZ'=>'Azua',
				'BA'=>'Bahoruco-Neiba',
				'BH'=>'Barahona',
				'DA'=>'Dajabon',
				'DU'=>'Duarte-San Francisco de Macoris',
				'ES'=>'El Seibo',
				'EP'=>'Elias Pi&ntilde;a-Comendador',
				'MO'=>'Espaillat-Moca',
				'HM'=>'Hato Mayor',
				'SA'=>'Hermanas Mirabal-Salcedo',
				'IJ'=>'Independencia-Jimani',
				'LA'=>'La Altagracia-Higuey',
				'LR'=>'La Romana',
				'LV'=>'La Vega',
				'NA'=>'Maria Trinidad Sanchez-Nagua',
				'BO'=>'Monse&ntilde;or Nouel-Bonao',
				'MC'=>'Monte Cristi',
				'MP'=>'Monte Plata',
				'PE'=>'Pedernales',
				'PB'=>'Peravia-Bani',
				'PP'=>'Puerto Plata',
				'SA'=>'Samana',
				'SC'=>'San Cristobal',
				'SO'=>'San Jose de Ocoa',
				'SJ'=>'San Juan',
				'SP'=>'San Pedro de Macoris',
				'CO'=>'Sanchez Ramirez-Cotui',
				'SG'=>'Santiago',
				'SS'=>'Santiago Rodriguez-Sabaneta',
				'SD'=>'Santo Domingo-Sto. Dgo Este',
				'VM'=>'Valverde-Mao'
				);
			break;
			case "AU":
    		return array(
				'un'=>'Unknown',
                'AAT'=>'Australian Antarctic Territory',
				'ACT'=>'Australian Capital Territory',
				'NT'=>'Northern Territory',
				'NSW'=>'New South Wales',
				'QLD'=>'Queensland',
				'SA'=>'South Australia',
				'TAS'=>'Tasmania',
				'VIC'=>'Victoria',
				'WA'=>'Western Australia'
				);
			break;
			case "BR":
    		return array(
				'un'=>'Unknown',
                'AC'=>'Acre',
				'AL'=>'Alagoas',
				'AM'=>'Amazonas',
				'AP'=>'Amapa',
				'BA'=>'Baia',
				'CE'=>'Ceara',
				'DF'=>'Distrito Federal',
				'ES'=>'Espirito Santo',
				'FN'=>'Fernando de Noronha',
				'GO'=>'Goias',
				'MA'=>'Maranhao',
				'MG'=>'Minas Gerais',
				'MS'=>'Mato Grosso do Sul',
				'MT'=>'Mato Grosso',
				'PA'=>'Para',
				'PB'=>'Paraiba',
				'PE'=>'Pernambuco',
				'PI'=>'Piaui',
				'PR'=>'Parana',
				'RJ'=>'Rio de Janeiro',
				'RN'=>'Rio Grande do Norte',
				'RO'=>'Rondonia',
				'RR'=>'Roraima',
				'RS'=>'Rio Grande do Sul',
				'SC'=>'Santa Catarina',
				'SE'=>'Sergipe',
				'SP'=>'Sao Paulo',
				'TO'=>'Tocatins'
				);
			break;
			case "NL":
    		return array(
				'un'=>'Unknown',
                'DR'=>'Drente',
				'FL'=>'Flevoland',
				'FR'=>'Friesland',
				'GL'=>'Gelderland',
				'GR'=>'Groningen',
				'LB'=>'Limburg',
				'NB'=>'Noord Brabant',
				'NH'=>'Noord Holland',
				'OV'=>'Overijssel',
				'UT'=>'Utrecht',
				'ZH'=>'Zuid Holland',
				'ZL'=>'Zeeland'
				);
			break;
			case "UK":
    		return array(
				'un'=>'Unknown',
                'AVON'=>'Avon',
				'BEDS'=>'Bedfordshire',
				'BERKS'=>'Berkshire',
				'BUCKS'=>'Buckinghamshire',
				'CAMBS'=>'Cambridgeshire',
				'CHESH'=>'Cheshire',
				'CLEVE'=>'Cleveland',
				'CORN'=>'Cornwall',
				'CUMB'=>'Cumbria',
				'DERBY'=>'Derbyshire',
				'DEVON'=>'Devon',
				'DORSET'=>'Dorset',
				'DURHAM'=>'Durham',
				'ESSEX'=>'Essex',
				'GLOUS'=>'Gloucestershire',
				'GLONDON'=>'Greater London',
				'GMANCH'=>'Greater Manchester',
				'HANTS'=>'Hampshire',
				'HERWOR'=>'Hereford & Worcestershire',
				'HERTS'=>'Hertfordshire',
				'HUMBER'=>'Humberside',
				'IOM'=>'Isle of Man',
				'IOW'=>'Isle of Wight',
				'KENT'=>'Kent',
				'LANCS'=>'Lancashire',
				'LEICS'=>'Leicestershire',
				'LINCS'=>'Lincolnshire',
				'MERSEY'=>'Merseyside',
				'NORF'=>'Norfolk',
				'NHANTS'=>'Northamptonshire',
				'NTHUMB'=>'Northumberland',
				'NOTTS'=>'Nottinghamshire',
				'OXON'=>'Oxfordshire',
				'SHROPS'=>'Shropshire',
				'SOM'=>'Somerset',
				'STAFFS'=>'Staffordshire',
				'SUFF'=>'Suffolk',
				'SURREY'=>'Surrey',
				'SUSS'=>'Sussex',
				'WARKS'=>'Warwickshire',
				'WMID'=>'West Midlands',
				'WILTS'=>'Wiltshire',
				'YORK'=>'Yorkshire'

				);
			break;
			case "EI": //Irland (Eire)
    		return array(
				'un'=>'Unknown',
    			'CO ANTRIM'=>'County Antrim',
				'CO ARMAGH'=>'County Armagh',
				'CO DOWN'=>'County Down',
				'CO FERMANAGH'=>'County Fermanagh',
				'CO DERRY'=>'County Londonderry',
				'CO TYRONE'=>'County Tyrone',
				'CO CAVAN'=>'County Cavan',
				'CO DONEGAL'=>'County Donegal',
				'CO MONAGHAN'=>'County Monaghan',
				'CO DUBLIN'=>'County Dublin',
				'CO CARLOW'=>'County Carlow',
				'CO KILDARE'=>'County Kildare',
				'CO KILKENNY'=>'County Kilkenny',
				'CO LAOIS'=>'County Laois',
				'CO LONGFORD'=>'County Longford',
				'CO LOUTH'=>'County Louth',
				'CO MEATH'=>'County Meath',
				'CO OFFALY'=>'County Offaly',
				'CO WESTMEATH'=>'County Westmeath',
				'CO WEXFORD'=>'County Wexford',
				'CO WICKLOW'=>'County Wicklow',
				'CO GALWAY'=>'County Galway',
				'CO MAYO'=>'County Mayo',
				'CO LEITRIM'=>'County Leitrim',
				'CO ROSCOMMON'=>'County Roscommon',
				'CO SLIGO'=>'County Sligo',
				'CO CLARE'=>'County Clare',
				'CO CORK'=>'County Cork',
				'CO KERRY'=>'County Kerry',
				'CO LIMERICK'=>'County Limerick',
				'CO TIPPERARY'=>'County Tipperary',
				'CO WATERFORD'=>'County Waterford'
				);
			break;
      /*
       default:
    		return array(
		    		'AL'=>'Alberta',
					'BC'=>'British Columbia',
					'MA'=>'Manitoba',
					'NB'=>'New Brunswick',
					'NL'=>'Newfoundland and Labrador',
					'NT'=>'Northwest Territories',
					'NS'=>'Nova Scotia',
					'NU'=>'Nunavut',
					'ON'=>'Ontario',
					'PI'=>'Prince Edward Island',
					'QU'=>'Quebec',
					'SA'=>'Saskatchewan',
					'YU'=>'Yukon Territory'
				);
			break; */

    }

}

function languageArray(){

	return array(
	'EN'=>'English',
	'SP'=>'Spanish',
	'FR'=>'French',
	'NO'=>'Norwegian',
	'DE'=>'German',
	'NL'=>'Nederlands',
	'IT'=>'Italian',
	'RU'=>'Russian',
	'CH'=>'Chinese',
	'JP'=>'Japanese',
	'MO'=>'Others'

	);
}

	/*function  validate_telephone_number($number){
	$formats  = array('###-###-####', '####-###-###', '(###) ###-####', '####-####-####', '##-###-####-####', '####-####', '###########','#-###-###-####', '##########', '+#-###-###-####', '-#-###-###-####', '(###)#######', '#(###)#######', '+#(###)#######');

	$format = trim(ereg_replace("[0-9]", "#", $number));

	return (in_array($format, $formats)) ? true : false;
	}*/
function  validate_telephone_number($number){
	#preg_replace('/\d{3}([().-\s[\]]*)\d{3}([().-\s[\]]*)\d{4}/',  "123$1456$27890", $number);
	$format = trim($number);

	return  $format;
	}
	/*function  validate_cedula($number){
	$formats  = array('###-#######-#', '###########');

	$format = trim(ereg_replace("[0-9]", "#", $number));

	return (in_array($format, $formats)) ? true : false;
}*/
function  validate_cedula($number){
	//$formats  = array('###-#######-#', '###########');

	//$format = trim(ereg_replace("[0-9]", "#", $number));

	return $number;
}
function valName($name){
	$name = preg_replace('�/[\s]+/is�, � �', $name);
    $name = trim($name);
	return preg_match('�/^[a-z\s]+$/i�', $name);
}



function normalize ($string) {
    $table = array(
        '�'=>'S', '�'=>'s', '�'=>'Dj', 'd'=>'dj', '�'=>'Z', '�'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
        '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E',
        '�'=>'E', '�'=>'E', '�'=>'I', '�'=>'I', '�'=>'I', '�'=>'I', '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O',
        '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'U', '�'=>'U', '�'=>'U', '�'=>'U', '�'=>'Y', '�'=>'B', '�'=>'Ss',
        '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'c', '�'=>'e', '�'=>'e',
        '�'=>'e', '�'=>'e', '�'=>'i', '�'=>'i', '�'=>'i', '�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o',
        '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'u', '�'=>'u', '�'=>'u', '�'=>'y', '�'=>'y', '�'=>'b',
        '�'=>'y', 'R'=>'R', 'r'=>'r',
    );
    return strtr($string, $table);
}

function validate_texto($nombre){
	//$nombre=eliminar_acentos($nombre);
	$result=preg_match("#^[-A-Za-z' ]*$#",$nombre);

	return $result;
}

function isLength($s,$min,$max){ //string_to_be_validate,minimum_length,maximum_length
    $curLength = strlen($s);
    return (($curLength >= (int)($min)) && ($curLength <= (int)($max)))? true : false;
}

function dayPeriod($ending, $starting){ //SAME AS NIGHT QTY FUNCTIONS
      $inicio=strtotime($starting); //return in seconds the introduced date
      $final=strtotime($ending);

      $result=floor(($final-$inicio)/(60*60*24));

     return $result;
   }



function  validate_date($date){ //well only check numbers no dates exactly
	#$formats  = array('####-##-##');

	#$format = trim(ereg_replace("[0-9]", "#", $date));

	#return (in_array($format, $formats)) ? true : false;
	return $date;
}

function IsDate($Str)   //no working propertly
{
  $Stamp = strtotime( $Str );
  $Month = date( 'm', $Stamp );
  $Day   = date( 'd', $Stamp );
  $Year  = date( 'Y', $Stamp );

  return checkdate( $Month, $Day, $Year );
}

function is_date($date) //this function is wonderful to check any date
    {
        $date = str_replace(array('\'', '-', '.', ','), '/', $date);
        $date = explode('/', $date);

        if(    count($date) == 1 // No tokens
            and    is_numeric($date[0])
            and    $date[0] < 20991231 and
            (    checkdate(substr($date[0], 4, 2)
                        , substr($date[0], 6, 2)
                        , substr($date[0], 0, 4)))
        )
        {
            return true;
        }

        if(    count($date) == 3
            and    is_numeric($date[0])
            and    is_numeric($date[1])
            and is_numeric($date[2]) and
            (    checkdate($date[0], $date[1], $date[2]) //mmddyyyy
            or    checkdate($date[1], $date[0], $date[2]) //ddmmyyyy
            or    checkdate($date[1], $date[2], $date[0])) //yyyymmdd
        )
        {
            return true;
        }

        return false;
    }

/*=============================================================================================*/
 function send_email_smtp($from, $to, $subject, $body){
  require_once("Mail.php");

	//$from = "Your Name <email@blahblah.com>";
	//$to = "Their Name <ing.joseluis@msn.com>";
	//$subject = "Subject";


	//$host = "mailserver.blahblah.com";
	$host = "smtp.ent.lyse.net";
	$username = "smtp_username";
	$password = "smtp_password";

	$headers = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'MIME-Version' => '1.0',
	        'Content-Type' => "text/html; charset=ISO-8859-1");

	$smtp = Mail::factory('smtp', array ('host' => $host,
	                                     'auth' => false,
	                                     'username' => $username,
	                                     'password' => $password));

	$mail = $smtp->send($to, $headers, $body);
 }
 /*=============================================================================================*/
/* function send_email_smtp_bcc($from, $to, $subject, $body){
  require_once("Mail.php");

	//$from = "Your Name <email@blahblah.com>";
	//$to = "Their Name <ing.joseluis@msn.com>";
	//$subject = "Subject";


	//$host = "mailserver.blahblah.com";
	$host = "smtp.ent.lyse.net";
	$username = "smtp_username";
	$password = "smtp_password";

	$headers = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'MIME-Version' => '1.0',
	        'Content-Type' => "text/html; charset=ISO-8859-1","Bcc: ".ADMIN_EMAIL);

	$smtp = Mail::factory('smtp', array ('host' => $host,
	                                     'auth' => false,
	                                     'username' => $username,
	                                     'password' => $password));

	$mail = $smtp->send($to, $headers, $body);
 }

 function send_email_smtp_cc($from, $to, $subject, $body){
  require_once("Mail.php");

	//$from = "Your Name <email@blahblah.com>";
	//$to = "Their Name <ing.joseluis@msn.com>";
	//$subject = "Subject";


	//$host = "mailserver.blahblah.com";
	$host = "smtp.ent.lyse.net";
	$username = "smtp_username";
	$password = "smtp_password";

	$headers = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'MIME-Version' => '1.0',
	        'Content-Type' => "text/html; charset=ISO-8859-1","Bcc: ".ADMIN_EMAIL,"CC: ".RESERVATIONS_EMAIL);

	$smtp = Mail::factory('smtp', array ('host' => $host,
	                                     'auth' => false,
	                                     'username' => $username,
	                                     'password' => $password));

	$mail = $smtp->send($to, $headers, $body);
 } */
 /*=============================================================================================*/
    function sendMail($body, $address, $subject, $from_add, $from_name) {
		
		$extra_header  = '';
		$extra_header  .= "MIME-Version: 1.0\n";
		$extra_header  .= "Content-type: text/html; charset=utf-8\n";
		$extra_header  .= "Content-transfer-encoding: 8bit\n";
		$extra_header  .= "Date: ". date('r'). "\n";
		$extra_header  .= "X-Priority: 3\n";   // send email with high priority; 3 is normal, 1 is high and 5 is de lowest.
		$extra_header  .= "X-Mailer: PHP\n";
		$extra_header  .= "From: $from_name <$from_add>\n";
		$extra_header  .= "Reply-to: <$from_add>\n";
		$extra_header  .= "Return-path: $from_name <$from_add>\n";
		$extra_header  .= "Bcc: ".ADMIN_EMAIL."\n";
		
		#require ($_SERVER['DOCUMENT_ROOT'].'Norway06-04-2015/booking/inc/PHPMailer/ex/gmail.php');
		#sendGmail($emailTo=$address, $nameTo='', $subject, $from_add, $from_name, $body, $emailCC='', $emailBCC=ADMIN_EMAIL);/*LOCALHOST OWN SANDBOX ENVIROMENT*/
		$mailsend = mail($address, $subject, $body, $extra_header); /*	ONLINE CPANEL*/
		return true;

	}

	function sendMail_copy_reservations($body, $address, $subject, $from_add, $from_name) {
	
		$extra_header  = '';
		$extra_header  .= "MIME-Version: 1.0\n";
		$extra_header  .= "Content-type: text/html; charset=utf-8\n";
		$extra_header  .= "Content-transfer-encoding: 8bit\n";
		$extra_header  .= "Date: ". date('r'). "\n";
		$extra_header  .= "X-Priority: 3\n";   // send email with high priority; 3 is normal, 1 is high and 5 is de lowest.
		$extra_header  .= "X-Mailer: PHP\n";
		$extra_header  .= "From: $from_name <$from_add>\n";
		$extra_header  .= "Reply-to: <$from_add>\n";
		$extra_header  .= "Return-path: $from_name <$from_add>\n";
		$extra_header  .= "Bcc: ".ADMIN_EMAIL."\n";
		$extra_header  .= "CC: ".RESERVATIONS_EMAIL."\n";

		#require ($_SERVER['DOCUMENT_ROOT'].'Norway06-04-2015/booking/inc/PHPMailer/ex/gmail.php');
		#sendGmail($emailTo=$address, $nameTo='', $subject, $from_add, $from_name, $body, $emailCC=RESERVATIONS_EMAIL, $emailBCC=ADMIN_EMAIL);/*LOCALHOST OWN SANDBOX ENVIROMENT*/
		$mailsend = mail($address, $subject, $body, $extra_header); /*	ONLINE CPANEL*/
       
		return true;

	}
	function sendMail_services_contracted($to_add, $to_name, $subject, $from_add, $from_name, $villa_no) {
		
		$extra_header  = '';
		$extra_header  .= "MIME-Version: 1.0\n";
		$extra_header  .= "Content-type: text/html; charset=utf-8\n";
		$extra_header  .= "Content-transfer-encoding: 8bit\n";
		$extra_header  .= "Date: ". date('r'). "\n";
		$extra_header  .= "X-Priority: 3\n";   // send email with high priority; 3 is normal, 1 is high and 5 is de lowest.
		$extra_header  .= "X-Mailer: PHP\n";
		$extra_header  .= "From: $from_name <$from_add>\n";
		$extra_header  .= "Reply-to: <$from_add>\n";
		$extra_header  .= "Return-path: $from_name <$from_add>\n";
		$extra_header  .= "Bcc: ".ADMIN_EMAIL."\n";
		$body="<!doctype html>
		<html>
		<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>Notification-Residencial Casa Linda</title>
		<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
		</head>


		<body>
		<div class=\"container\">
		<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

		<p>&nbsp;</p>
		<p>Dear $to_name,</p>

		<p>$from_name has changed or created information on the services contracted for villa $villa_no at Residencial Casa Linda<br/>
		</p>
		
		<p>Please, login to the system to see more details about this notification.</p>
		
		
		<p>Best wishes,
		  The Casa Linda team!</p>
		<p><br>
		  Residencial Casa Linda <br>
		  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
		  Tel: +1 809 571 1190 <br>
		  <a href=\"mailto:$from_add\">$from_add</a><br>
		  <a href=\"mailto:info@casalindacity.com\">info@casalindacity.com</a></p>
		</div>
		</body>
		</html>";
		$mailsend = mail($to_add, $subject, $body, $extra_header); /*	ONLINE CPANEL*/
		return true;

	}
/*
	function sendMail_no_copies($body, $address, $subject, $from_add, $from_name) {
       
		$extra_header  = '';
		$extra_header  .= "MIME-Version: 1.0\n";
		$extra_header  .= "Content-type: text/html; charset=utf-8\n";
		$extra_header  .= "Content-transfer-encoding: 8bit\n";
		$extra_header  .= "Date: ". date('r'). "\n";
		$extra_header  .= "X-Priority: 3\n";   // send email with high priority; 3 is normal, 1 is high and 5 is de lowest.
		$extra_header  .= "X-Mailer: PHP\n";
		$extra_header  .= "X-MSMail-Priority: Normal\n";
		$extra_header  .= "From: $from_name <$from_add>\n";
		$extra_header  .= "Reply-to: <$from_add>\n";
		$extra_header  .= "Return-path: $from_name <$from_add>\n";
		//$extra_header  .= "Bcc: ".ADMIN_EMAIL."\n";


		$mailsend = mail($address, $subject, $body, $extra_header);
        
        $from="$from_name <$from_add>";

        send_email_smtp($from, $to=$address, $subject, $body);
		return true;

	}*/

	function month_letters_2(){
	return array(
	 '01'=>'Jan',
	 '02'=>'Feb',
	 '03'=>'Mar',
	 '04'=>'Apr',
	 '05'=>'May',
	 '06'=>'Jun',
	 '07'=>'Jul',
	 '08'=>'Aug',
	 '09'=>'Sep',
	 '10'=>'Oct',
	 '11'=>'Nov',
	 '12'=>'Dec'
	);
}


function vehicles(){

	return array(
	'Abarth'=>'Abarth',
	'Alfa Romeo'=>'Alfa Romeo',
	'Artega'=>'Artega',
	'Aston Martin'=>'Aston Martin',
	'Audi'=>'Audi',
	'Bentley'=>'Bentley',
	'Bertone'=>'Bertone',
	'BMW'=>'BMW',
	'Bugatti'=>'Bugatti',
	'Buick'=>'Buick',
	'BYD'=>'BYD',
	'Cadillac'=>'Cadillac',
	'Caterham'=>'Caterham',
	'Chevrolet'=>'Chevrolet',
	'Chrysler'=>'Chrysler',
	'Citro�n'=>'Citro�n',
	'Corvette'=>'Corvette',
	'Dacia'=>'Dacia',
	'Daihatsu'=>'Daihatsu',
	'Dodge'=>'Dodge',
	'Exagon'=>'Exagon',
	'Ferrari'=>'Ferrari',
	'Fiat'=>'Fiat',
	'Fisker'=>'Fisker',
	'Ford'=>'Ford',
	'Fornasari'=>'Fornasari',
	'Geely'=>'Geely',
	'GTA'=>'GTA',
	'Hamann'=>'Hamann',
    'Honda'=>'Honda',
    'Hummer'=>'Hummer',
    'Hurtan'=>'Hurtan',
    'Hyundai'=>'Hyundai',
    'Infiniti'=>'Infiniti',
    'Isuzu'=>'Isuzu',
    'Jaguar'=>'Jaguar',
    'Jeep'=>'Jeep',
    'Kia'=>'Kia',
    'KTM'=>'KTM',
    'Lamborghini'=>'Lamborghini',
    'Lancia'=>'Lancia',
    'Land Rover'=>'Land Rover',
    'Lexus'=>'Lexus',
    'Lotus'=>'Lotus',
    'Mansory'=>'Mansory',
    'Maserati'=>'Maserati',
    'Maybach'=>'Maybach',
    'Mazda'=>'Mazday',
    'McLaren'=>'McLaren',
    'Mercedes'=>'Mercedes',
    'Mini'=>'Mini',
    'Mitsubishi'=>'Mitsubishi',
    'Morgan'=>'Morgan',
    'Nissan'=>'Nissan',
    'Opel'=>'Opel',
    'Pagani'=>'Pagani',
    'Peugeot'=>'Peugeot',
    'PGO'=>'PGO',
    'Porsche'=>'Porsche',
    'Renault'=>'Renault',
    'Rolls Royce'=>'Rolls Royce',
    'Saab'=>'Saab',
    'Santana'=>'Santana',
    'Seat'=>'Seat',
    'Skoda'=>'Skoda',
    'Smart'=>'Smart',
    'SsangYong'=>'SsangYong',
    'Subaru'=>'Subaru',
    'Suzuki'=>'Suzuki',
    'Tata'=>'Tata',
    'Tazzari'=>'Tazzari',
    'Tesla'=>'Tesla',
    'Think'=>'Think',
    'Toyota'=>'Toyota',
    'Volkswagen'=>'Volkswagen',
    'Volvo'=>'Volvo',
	'Wiesmann'=>'Wiesmann'
	);
}


function colors(){

	return array(
	'Yellow'=>'Yellow',
	'Blue'=>'Blue',
	'White'=>'White',
    'Gray'=>'Gray',
	'Brown'=>'Brown',
	'Orange'=>'Orange',
	'Black'=>'Black',
	'Red'=>'Red',
	'Green'=>'Green',
	'Violet'=>'Violet',
	'Navy'=>'Navy blue',
	'#6CD2FD'=>'Sky blue',
	'#FAAF3D'=>'Golden',
	'Fuchsia'=>'Fuchsia',
	'#8b4513'=>'Chestnut',
	'LightGreen'=>'Light green',
	'LightGray'=>'Light gray',
	'Maroon'=>'Maroon',
	'Purple'=>'Purple',
	'Silver'=>'Silver',
	'Pink'=>'Pink',
	'#ADEAEA'=>'Turquoise',
	'DarkGreen'=>'Dark green',
	'DarkGray'=>'Dark gray',
	);
}

function paymentsType(){
	return array(
	'1'=>'Cash',
	'2'=>'Credit Card',
	'3'=>'Paypal',
    '4'=>'Bank transfer',
	'5'=>'Move to Ref',
	'6'=>'Others'
	);
}
function paymentsClass(){
	return array(
	'1'=>'Payment',
	'2'=>'Payment Refund',
	'3'=>'Security Deposit',
	'4'=>'Security Refund',
	'5'=>'Transfer to booking'
	);
}
/*
function sent_tripadvisor_request($array, $ref){

	    $body_client='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Checkoout-Msg</title>
		<style type="text/css">
		<!--
		p.MsoNormal {
		margin:0in;
		margin-bottom:.0001pt;
		font-size:11.0pt;
		font-family:"Calibri","sans-serif";
		}
		-->
		</style>
		</head>

		<body>
		<p class="MsoNormal">Hello '.$array['name'].' '.$array['lastname'].'!</p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal">It was great hosting you here in Casa Linda recently! We do  hope that everything went perfect during your stay and we will be fortunate  enough to host you again in the near future. As always if you have any question  about <u>villa purchasing</u>, <u>future reservations</u>, or <u>any  constructive criticism</u> from your stay, feel free to e-mail me at any time  and I&rsquo;ll be sure to respond as soon as possible.</p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal">If you felt your time here was enjoyable, <strong><u>I would  really appreciate</u></strong> a positive review on Trip Advisor from you! This  helps people to know what great things are happening in our subdivision that  maybe they aren&rsquo;t aware of as they&rsquo;ve never had the privilege to stay here. You  can do this by clicking the link I&rsquo;ve posted below:</p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal"><span style="font-family:\'Verdana\',\'sans-serif\'; font-size:8.0pt; color:#2C2C2C; "><a href="http://www.tripadvisor.com/UserReview-g317144-d638839-m11765-Residencial_Casa_Linda-Cabarete_Dominican_Republic.html">http://www.tripadvisor.com/UserReview-g317144-d638839-m11765-Residencial_Casa_Linda-Cabarete_Dominican_Republic.html</a></span></p>
		<p class="MsoNormal"><span style="font-family:\'Verdana\',\'sans-serif\'; font-size:8.0pt; color:#2C2C2C; ">&nbsp;</span></p>
		<p class="MsoNormal"><span style="color:#2C2C2C; ">I  hope </span>your trip<span style="color:#2C2C2C; "> home was smooth and I  look forward to speaking with you again!</span></p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal"><span style="color:#1F497D; ">Regards,</span><span style="font-size:14.0pt; color:#1F497D; "><br />
		  <br />
		  <br />
		  Chris Lawson</span></p>
		<p class="MsoNormal"><span style="font-size:9.0pt; color:#1F497D; ">Rental Manager</span></p>
		<p class="MsoNormal"><span style="font-size:6.0pt; color:#1F497D; ">&nbsp;</span></p>
		<p class="MsoNormal"><span style="color:#1F497D; "><img border="0" width="309" height="71" src="https://www.casalindacity.com/msg_ckout/clip_image001.jpg" alt="Logo horizontal-jpg" /></span><span style="color:#1F497D; "> </span></p>
		<p class="MsoNormal"><span style="color:#1F497D; ">Tel.: (+1809) 571 1190</span></p>
		<p class="MsoNormal"><span style="color:#1F497D; ">Fax: (+1809) 571 1411</span></p>
		<p class="MsoNormal"><a href="mailto:chris@casalindacity.com">Chris@CasaLindaCity.com</a><span style="color:#1F497D; "><br />
		</span><a href="http://www.casalindacity.com/">www.CasaLindaCity.com</a><span style="color:#1F497D; "> </span></p>
		<p class="MsoNormal"><span style="font-size:10.0pt; "><br />
		  For all Reservation inquiries including bookings, pricing, and availability,  please e-mail the main reservations mailbox at </span><a href="mailto:Reservations@CasaLindaCity.com"><span style="font-size:10.0pt; ">Reservations@CasaLindaCity.com</span></a><span style="font-size:10.0pt; ">.</span></p>
		</body>
		</html>';

  		@sendMail_copy_reservations($body_client, $array['email'], "Thank you for staying in Residencial Casa Linda", RESERVATIONS_EMAIL, "RCL Booking System");//send to client
		//echo $body_client;

		//guardar booking ref. en tabla tripadvisor
		$db=new DB();
		$db->insertar_tripadvisor($ref);

		//return $body_client;

		return '<p style="text-align:center; font-size:14px; color:white; background-color:green; font-weight:bold;">TripAdvisor Request Sent!</p>';

	}*/
    /*
	function tripadvisor_question(){

		echo '<p style="border:1px solid green; clear:both; padding:3px; text-transform:uppercase; color:green; font-weight:bold;">Do you want to send <img src="images/TripAdvisor.jpg" alt="TripAdvisor"/> request? <input type="radio" name="tripadvisor" value="yes" >Yes
								<input type="radio" name="tripadvisor" value="no" checked="checked">No</p>';

	} */
  //===================================================FUNCTION FOR CREATING SERVICES ON A BOOKING===================================
	function nuevo_servicios_bookings($array_servicios_activos,$qty_nights){
      //presentar como elegir un servicio aqui
      // incluyendo el array que contiene los id de los servicios que se seleccionaran con los codigos html
       $services_type=array();
       foreach($array_servicios_activos AS $s){
       	 	if(!in_array($s['type'],$services_type)){//si este tipo de servicio no esta en el arreglo de tipos de servicios
                array_push($services_type,$s['type']);//se introduce el tipo en el arreglo
        	}
       }

		foreach($services_type AS $st){
         if($st!='Car_Rental'){
  			 ?>

              <p style="text-align:right; font-weight:bold; padding:0; margin:0;padding-bottom:5px;"><span id="td0"><?=$st?></span> <select name="servicios_id[]" class="azul">
          	<?
          	$count=0;$countlaundry=0;
  		 	foreach($array_servicios_activos AS $s){

          	//enmpiea parrafo y el input select aqui

             if($st==$s['type']){//solo para los value option
              $count++;
               if($st=='Laundry'){
                $countlaundry++;
                if ($countlaundry==1) echo "<option value='0'>None</option>";
                 $laun_qty=explode('-', $s['description']);
                 $laun_qty2=explode(' ', $laun_qty[1]);
			     if(($qty_nights>=$laun_qty[0])&&($qty_nights<=$laun_qty2[0])){
	             	?>
	             	<option value="<?=$s['id']?>"><?=substr($s['name'],0,15)." ".$s['price']?></option>
	             	<?
                 }
                  /*echo $qty_nights."(nights)";
			     	echo $laun_qty[0]."(dia 1)";
			     	echo $laun_qty2[0]."(dia 2)"; */
               }else{
               	if ($count==1) echo "<option value='0'>None</option>";

             	if($st!='Car_Rental'){/*if it is not car rentar*/?>
             	<option value="<?=$s['id']?>"><?=substr($s['name'],0,15)." ".$s['price']?></option>
                <?}else{
             	?>
             	<option value="<?=$s['id']?>"><?=substr($s['name'],0,15)?></option>
             	<?
             	}
               }
             }
          	}
             ?>
             </select>
                <?
           if($st=='Massage'){
             ?>
              <span id="td0">Days </span><select class="azul" style="text-align:right" name="qty[<?=$st.'2'?>]" size=1>
			   <? for($i=1; $i<=10; $i++){
				 ?>
		         <option value="<?=$i?>"><?=$i;?></option>
		         <?
			   }
		   ?></select>
		   <?}?>

		     <?
           if($st=='Personal_Driver'){
             ?>
&nbsp;<!--//&nbsp;<span id="td0">Days&nbsp;</span>//--><select class="azul" style="text-align:right" name="qty[<?=$st?>]" size=1>
			   <? for($i=1; $i<=90; $i++){
				 ?>
		         <option value="<?=$i?>"><?=$i;?></option>
		         <?
			   }
		   ?></select>
		   <?}?>

		   <?
             ?>
             </p>
          	<?
         }/*if not a rental car shows services*/
		}
	}

     //========================================FUNCTION FOR EDITING SEVICES ON A BOOKING===============================================
	function editar_servicios_bookings($array_servicios_activos,$qty_nights,$array_servicios_este_booking,$id_reserva){
      //presentar como elegir un servicio aqui
      // incluyendo el array que contiene los id de los servicios que se seleccionaran con los codigos html
      /*print_r($array_servicios_este_booking);
      echo "<pre>";
      print_r($array_servicios_activos);
      echo "</pre>"; */
       $services_type=array();
       foreach($array_servicios_activos AS $s){
       	 	if(!in_array($s['type'],$services_type)){//si este tipo de servicio no esta en el arreglo de tipos de servicios
                array_push($services_type,$s['type']);//se introduce el tipo en el arreglo
        	}
       }

		foreach($services_type AS $st){
            ?>
          
            

             <?if($st!='Car_Rental'){?>
             <p style="text-align:right; font-weight:bold; padding:0; margin:0;padding-bottom:5px;"><span id="td0"><?=$st?></span> <select name="servicios_id[]" class="azul">
             <?}?>

          	<?
          	$count=0;$countlaundry=0;
  		 	foreach($array_servicios_activos AS $s){

          	//enmpiea parrafo y el input select aqui

             if($st==$s['type']){//solo para los value option DE ESTE TIPO DE SERVICIO Y ASI NO INCLUIMOS LOS CARROS*/
              $count++;
               if($st=='Laundry'){ /*SOLO SI ES LAVANDERIA*/
                $countlaundry++;
                if ($countlaundry==1) echo "<option value='0'>None</option>";
                 $laun_qty=explode('-', $s['description']);
                 $laun_qty2=explode(' ', $laun_qty[1]);
			     if(($qty_nights>=$laun_qty[0])&&($qty_nights<=$laun_qty2[0])){
	             	?>
	             	<option value="<?=$s['id']?>" <? if (in_array($s['id'], $array_servicios_este_booking)) {echo " SELECTED";} ?>><?=substr($s['name'],0,15)." ".$s['price']?></option>
	             	<?
                 }

               }else{  /*ABOVE ONLY LAUNDRY*/
                if($st!='Car_Rental'){
               		if ($count==1) echo "<option value='0'>None</option>";
               	}else{
               		/* sie es rental cars viejos*/
               		/* if (in_array($s['id'], $array_servicios_este_booking)) {
               		?>
                    <input type="hidden" name="servicios_id[]" value="<?=$s['id']?>"/>
                    <input type="hidden" name="servicios_id[]" value=""/>
                    <input type="hidden" name="servicios_id[]" value=""/>
               		<?

               		}*/
               	}

             	if($st!='Car_Rental'){/*if it is not car rentar*/?>
             	<option value="<?=$s['id']?>" <? if (in_array($s['id'], $array_servicios_este_booking)) {echo " SELECTED";} ?>><?=substr($s['name'],0,15)." ".$s['price']?></option>
             	<?}else{/*
             	?>
             	<option value="<?=$s['id']?>" <? if (in_array($s['id'], $array_servicios_este_booking)) {echo " SELECTED";} ?>><?=substr($s['name'],0,15)?></option>
             	<?*/
             	}
               }
             }
          	}
             ?>
             <?if($st!='Car_Rental'){?>
             </select>
             <?}?>
            
           

		     <?
           if($st=='Personal_Driver'){/*IF IT IS A PERSONAL DRIVER SERVICE*/
           	//incluir archivo de db query aqui
           		require_once('class/getQueries.php');
           		$db=new getQueries;
           		$chofer_seleccionado=array();
           		 foreach($array_servicios_este_booking AS $serviceid){
                 	if(!$chofer_seleccionado){/*si no hay informacion en el arreglo*/
                 	  $chofer_seleccionado=$db->cosulta_servicio($serviceid, 'Personal_Driver');
                     /*print_r($chofer_seleccionado); */

                      $chofer_d=$db->servicio_reservado_id($chofer_seleccionado['id'], $id_reserva);
                 	}else{

                 		/*echo "detalles cofer: "; print_r($chofer_d);*/
                 		break;
                 	}
                 }
             ?>
              <span id="td0">Qty. days </span><select class="azul" style="text-align:right" name="qty[<?=$st?>]" size=1>
			   <? for($i=1; $i<=90; $i++){
				 ?>
		         <option value="<?=$i?>"<? if($chofer_d['qty']==$i){ echo 'selected="selected"';}?>><?=$i;?></option>
		         <?
			   }
		   ?></select>
		   <?/*echo "consulta";*/ /* echo $id_reserva;*//* echo $chofer_seleccionado['id']*//* print_r($chofer_seleccionado);*/print_r($chofer_deta);  ?>
		   <?}/*DO ABOVE ONLY IF PERSONAL DRIVER*/?>

		  <?if($st!='Car_Rental'){?>
		  </p>
          <?}?>

          	<?

		}/*END SERVICES TYPE*/

	}


   //===========================FUNCTION FOR ESPECIAL EVENT MANAGMENT==============================================================
   function special_event($starting_date, $ending_date, $price){
     //buscar evento en estas fechas del booking  que estan activos
     require_once('class/getQueries.php');
     $db=new getQueries;
     $evento=$db->active_event($starting_date, $ending_date);
     //sin encontro eventos aplicar los nuevos aumentos  o descenso de precios
     if($evento){
     	 if($evento[0]['type']==1){/*percent*/
          $cantidad_precio=$price*($evento[0]['qty']/100);
     	 }else{/*suponemos que es (2) o amount*/
          $cantidad_precio=$evento[0]['qty'];
     	 }

     	 if($evento[0]['increase']==1){/*increase*/
           $new_price=$price+$cantidad_precio;  /*increase priding*/
     	 }else{/*suponemos que es descontar*/
           $new_price=$price-$cantidad_precio; /*decrease pricing*/
     	 }
     	 //GUARDAR EVENTO AQUI EN UNA VARIABLE DE SESSION
         $_SESSION['evento']=$evento[0];
     }else{
     //sino encontro eventos dejar el precio igual.
       $new_price=$price;
     }
     /* return $evento;*/
   return $new_price;
   }

   function quitar_evento(){
    //quitar evento antes de realizar un booking que se le aplica el evento. (por se habia una seccion guardada de otro booking)
   	 if($_SESSION['evento']){ unset($_SESSION['evento']);}

   }
   
   function select_status(){
      $estados=array(0=>'Cancelled',
					  1=>'Checked in-Short',
					  2=>'Confirmed-Short',
					  3=>'No Confirmed-Short',
					  4=>'Checked out-Short',
					  5=>'Maintenance',
					  6=>'Checked in-VIP Short',
					  7=>'Checked in-Owner Short',
					  8=>'Checked in-Long<',
					  9=>'>Confirmed-Long',
					  10=>'No Confirmed-Long',
					  11=>'Checked Out-Long',
					  12=>'Confirmed-VIP Short',
					  13=>'No Confirmed-VIP Short',
					  14=>'Checked Out-VIP Short',
					  15=>'Checked in-VIP Long',
					  16=>'Confirmed-VIP Long',
					  17=>'No Confirmed-VIP Long',
					  18=>'Checked Out-VIP Long',
					  19=>'Confirmed-Owner Short',
					  20=>'No confirmed-Owner Short',
					  21=>'Checked Out-Owner Short',
					  22=>'Checked in-Owner Long',
					  23=>'Confirmed-Owner Long',
					  24=>'No confirmed-Owner Long',
					  25=>'Checked Out-Owner Long',
					  26=>'Checked in-Buyer Long',
					  27=>'No Confirmed-Buyer Long',
					  28=>'Confirmed-Buyer Long',
					  29=>'Checked Out-Buyer Long',
					  30=>'Checked in-Buyer Short',
					  31=>'No Confirmed-Buyer Short',
					  32=>'Confirmed-Buyer Short',
					  33=>'Checked Out-Buyer Short',
					  34=>'Mid term-checked in',
					  35=>'Mid term-No confirmed',
					  36=>'Mid term-Confirmed',
					  37=>'Mid term-Check out',
					  50=>'Invalid-No paid');
	  return $estados;
   }
   
   function booking_status($status){
      switch ($status){
		       	case 0:
		         	$status_booking="<span style='color:red'>Cancelled</span>";
			       	break;
		       	case 1:
		         	$status_booking="<span class='azul2'>Checked in - Short</span>";
			       	break;
			    case 2:
		         	$status_booking="<span class='azul2'>Confirmed - Short</span>";
			       	break;
			    case 3:
		         	$status_booking="<span class='morado'>No Confirmed - Short </span>";
			       	break;
				case 4:
		         	$status_booking="<span class='outck'>Checked out - Short</span>";
			       	break;
			    case 5:
		         	$status_booking="<span style='color:red'>Maintenance (out of service)</span>";
			       	break;
			   case 6:
		         	$status_booking="<span class='r_vip'>Checked in - VIP, Short</span>";
			       	break;
			    case 7:
		         	$status_booking="<span class='r_owner'>Checked in - Owner, Short</span>";
			       	break;
			    case 8:
		         	$status_booking="<span class='r_long'>Checked in - Long</span>";
			       	break;
			    case 9:
		         	$status_booking="<span class='r_long'>Confirmed - Long</span>";
			       	break;
			 	case 10:
		         	$status_booking="<span class='r_long'>No Confirmed - Long</span>";
			       	break;
			    case 11:
		         	$status_booking="<span class='r_long'>Checked Out - Long</span>";
			       	break;
			 	case 12:
		         	$status_booking="<span class='r_vip'>Confirmed - VIP, Short</span>";
			       	break;
			    case 13:
		         $status_booking="<span class='r_vip'>No Confirmed - VIP, Short</span>";
			       	break;
			 	case 14:
		         	$status_booking="<span class='r_vip'>Checked Out - VIP, Short</span>";
			       	break;
			    case 15:
		         	$status_booking="<span class='r_vip'>Checked in - VIP, Long</span>";
			       	break;
			 	case 16:
		         	$status_booking="<span class='r_vip'>Confirmed - VIP, Long</span>";
			       	break;
			    case 17:
		         	$status_booking="<span class='r_vip'>No Confirmed - VIP, Long</span>";
			       	break;
			 	case 18:
		         	$status_booking="<span class='r_vip'>Checked Out - VIP, Long</span>";
			       	break;
			    case 19:
		         	$status_booking="<span class='r_long'>Confirmed - Owner, Short</span>";
			       	break;
			 	case 20:
		         	$status_booking="<span class='r_long'>No confirmed - Owner, Short</span>";
			       	break;
			    case 21:
		         	$status_booking="<span class='r_long'>Checked Out - Owner, Short</span>";
			       	break;
			 	case 22:
		         	$status_booking="<span class='r_long'>Checked in - Owner, Long</span>";
			       	break;
			    case 23:
		         	$status_booking="<span class='r_long'>Confirmed - Owner, Long</span>";
			       	break;
			 	case 24:
		         	$status_booking="<span class='r_long'>No confirmed - Owner, Long</span>";
			       	break;
			    case 25:
		         	$status_booking="<span class='r_long'>Checked Out - Owner, Long</span>";
			       	break;
			    case 26:  /*Buyer Long check in*/
		         	$status_booking="<span class='r_long'>Checked in - Buyer Long</span>";
			       	break;
				case 27: /* Buyer Long no confirmed*/
		         	$status_booking="<span class='r_long'>No Confirmed - Buyer Long</span>";
			       	break;
				case 28:  /*Buyer Long confirmed*/
		         	$status_booking="<span class='r_long'>Confirmed - Buyer Long</span>";
			       	break;
				case 29: /*Buyer Long checked out*/
		         	$status_booking="<span class='r_long'>Checked Out - Buyer Long</span>";
			       	break;
				case 30:  /*Buyer Short check in*/
		         	$status_booking="<span class='r_long'>Checked in - Buyer Short</span>";
			       	break;
				case 31: /* Buyer Short no confirmed*/
		         	$status_booking="<span class='r_long'>No Confirmed - Buyer Short</span>";
			       	break;
				case 32:  /*Buyer Short confirmed*/
		         	$status_booking="<span class='r_long'>Confirmed - Buyer Short</span>";
			       	break;
				case 33: /*Buyer Short checked out*/
		         	$status_booking="<span class='r_long'>Checked Out - Buyer Short</span>";
			       	break;
				case 34: /*Mid term checked in*/
		         	$status_booking="<span class='r_long'>Mid term - checked in</span>";
			       	break;
				case 35: /*Mid term - No confirmed*/
		         	$status_booking="<span class='r_long'>Mid term - No confirmed</span>";
			       	break;
				case 36: /*Mid term confirmed*/
		         	$status_booking="<span class='r_long'>Mid term - Confirmed</span>";
			       	break;
				case 37: /*Mid term checked out*/
		         	$status_booking="<span class='r_long'>Mid term - Check out</span>";
			       	break;
				case 38: /*Try and Buy - Check in*/
		       $status_booking="<span class='r_long'>Try and Buy - Check in</span>";
			       break;
				case 39: /*Try and Buy - No confirmed*/
		       $status_booking="<span class='r_long'>Try and Buy - No confirmed</span>";
			       break;
				case 40: /*Try and Buy - Confirmed*/
		       $status_booking="<span class='r_long'>Try and Buy - Confirmed</span>";
			       break;
				case 41: /*Mid term checked out*/
		       $status_booking="<span class='r_long'>Try and Buy - Check out</span>";
			       break;
				case 50: /*Umcompleted booking (no valid if don't pay)*/
		         	$status_booking="<span class='r_long' style='color:red; background-color:yellow; font-weight:bold;'>Invalid-No paid</span>";
			       	break;
		       	default:
			       $status_booking="<span class='negro'><u>Unavailabe</u></span>";
			       #	break;
	  }

	  return $status_booking;
   }
   
   function monto_mes_booking($fechainicia, $fechafinal, $montotal, $mes_year){
	  /* if(!$mes_year){
		   $mes=date('m');
		   $year=date('Y');
	   }else{
		   $current_date= explode("-", $mes_year);
		   $year=$current_date[0];
		   $mes=$current_date[1]; 
	   }
	    $primer_dia_mes=$year.'-'.$mes.'-01';
	  //echo "<br/>";
	    $ultimo_dia_mes=date("Y-m-t", strtotime($primer_dia_mes));
	//  echo "<br/>";
	    $primer_dia_next_month=$year.'-'.($mes+1).'-01';
	   
	   $primer_dia_mes=strtotime($primer_dia_mes);
	   $ultimo_dia_mes=strtotime($ultimo_dia_mes);
	   $primer_dia_next_month=strtotime();
	   $fechainicia=strtotime();
	   $fechafinal=strtotime();*/
	  // si la fecha final es mayor que el primero del proximo mes
	  #if($fechafinal>1ro next month)
	  #if($fechainicia<1ro this month)
		//ENTONCES:

		//-ver monto total
		//-dividir por qty noches totales
		//-calcular noches hasta el primero del proximo mes
		//-precio a sumar en el mes es igual al precio por noches x qty noches este mes

		//parametros de la funcion(fechainicia, fechafinal, montotal)
		//return $montotal;
   }

  //------------------FIND OUT WHEN A VILLA IS AVAILABLE OR NOT TO MAKE A BOOKING OR EDIT A BOOKING------------------
   function check_villa_new($id_villa, $start_date, $end_date){ /*CHECK IF THIS VILLA IS BUSY WHILE CREATING A NEW BOOKING*/
       //buscar todas esas ocupaciones
         //SI ARRAY COUNT ES MAYOR QUE 0 ENTONCES HAY RESERVAS
     require_once('class/getQueries.php');
     $db=new getQueries;
     $ocupaciones=$db->availability_new_booking($id_villa, $start_date, $end_date);
     return $ocupaciones;
   }

   function check_villa_edit($id_villa, $start_date, $end_date, $id_this_reserve){ /*CHECK IF A VILLA IS OCCUPIED WHILE CHANGING A RESERVATION*/
      require_once('class/getQueries.php');
     $db=new getQueries;
     $ocupaciones=$db->availability_edit_booking($id_villa, $start_date, $end_date, $id_this_reserve);


     return $ocupaciones;
   }

   function new_booking_busy_error($from, $to, $link){
   	?>
     <h1><span style="color:red">ERROR:</span> We are sorry, this villa is now occupied between <u><?=date("d M Y",strtotime($from))?></u> to <u><?=date("d M Y",strtotime($to))?></u>, please try again.</h1>

     <h2><a href="<?=$link?>" alt="">Click here to select other villa</a></h2>
   	<?
   }

   function change_booking_busy_error($from, $to){
    ?>
      <h1><span style="color:red">ERROR:</span> It is impossible to change this booking, because this villa is occupied between <u><?=date("d M Y",strtotime($from))?></u> to <u><?=date("d M Y",strtotime($to))?></u></h1>
   	<?
   }
  //-----------------------------determinar la tarifa semanal y mensual para los administradores----------------------------------------------------
   function price_rent($qty_nights, $normal_price){
    //apply to short term and rental online
    require_once('class/getQueries.php');
     $db=new getQueries;
     $price_settings=$db->show1_active('price_settings');
    //rate weekly
     if(($qty_nights>=$price_settings['week_nights'])&&($qty_nights<$price_settings['month_nights'])){
         $percent_to_reduce=(1-($price_settings['week_disc']/100));
         $rate_per_nights=$normal_price*$percent_to_reduce;

     }elseif(($qty_nights>=$price_settings['month_nights'])&&($qty_nights<$price_settings['Long_nights'])){
      //rate monthly
       $percent_to_reduce=(1-($price_settings['month_disc']/100));
       $rate_per_nights=$normal_price*$percent_to_reduce;

      //hacer un error igual al long term aqui para clientes online

     }elseif($qty_nights>=$price_settings['Long_nights']){  //apply long term pricing
     	//lanzar error decir que se debe elegir de largo plazo, si admin
     	//hacer un error aqui para los clientes enlinea tambiem
       /*die('This booking must be a long term, go back and try again');*/
	    $percent_to_reduce=(1-($price_settings['month_disc']/100));/*calculate per months anyways*/
       $rate_per_nights=$normal_price*$percent_to_reduce;/*calculate per months anyways*/
     }else{ //apply normal pricing
     	//corresponden precios sin descuentos, menos de una semana
      $rate_per_nights=$normal_price;
     }

    return $rate_per_nights;
   }
    //-----------------------------determinar la tarifa semanal y mensual para los clientes online----------------------------------------------------
	function price_rent_online($qty_nights, $normal_price, $bed){
      //apply to short term and rental online
    require_once('class/getQueries.php');
     $db=new getQueries;
     $price_settings=$db->show1_active('price_settings');
    //rate short
     if(($qty_nights>=$price_settings['short_m_night'])&&($qty_nights<$price_settings['mid_m_night'])){/*short term*/
		switch($bed){
			case 2: $rate_per_nights=$normal_price*(1-($price_settings['short2bdr']/100)); break;
			case 3: $rate_per_nights=$normal_price*(1-($price_settings['short3bdr']/100)); break;
			case 4: $rate_per_nights=$normal_price*(1-($price_settings['short4bdr']/100)); break;
			case 5: $rate_per_nights=$normal_price*(1-($price_settings['short5bdr']/100)); break;
			case 6: $rate_per_nights=$normal_price*(1-($price_settings['short6bdr']/100)); break;
			default:  $rate_per_nights=$normal_price;
		}
        
		//$percent_to_reduce=(1-($price_settings['week_disc']/100));
       //$rate_per_nights=$normal_price*$percent_to_reduce;
	   
     }elseif(($qty_nights>=$price_settings['mid_m_night'])&&($qty_nights<$price_settings['long_m_night'])){/*mid term*/
      //rate mid
       //$percent_to_reduce=(1-($price_settings['month_disc']/100));
      // $rate_per_nights=$normal_price*$percent_to_reduce;
	   	switch($bed){
			case 2: $rate_per_nights=$normal_price*(1-($price_settings['mid2bdr']/100)); break;
			case 3: $rate_per_nights=$normal_price*(1-($price_settings['mid3bdr']/100)); break;
			case 4: $rate_per_nights=$normal_price*(1-($price_settings['mid4bdr']/100)); break;
			case 5: $rate_per_nights=$normal_price*(1-($price_settings['mid5bdr']/100)); break;
			case 6: $rate_per_nights=$normal_price*(1-($price_settings['mid6bdr']/100)); break;
			default:  $rate_per_nights=$normal_price;
		}
     }elseif($qty_nights>=$price_settings['long_m_night']){  //apply long term pricing
       die('Please, contact us at: reservations@CasaLindaCity.com, in order to make this booking.');
     }else{ //apply normal pricing
     	//corresponden precios sin descuentos, menos de una semana
      $rate_per_nights=$normal_price;
     }
    return $rate_per_nights;
	}
   //-------------------------------------determinar el monto semanal-------------------------------------------------
	function weekly_rate($normal_price){
     //apply to short term and rental online
	  require_once('class/getQueries.php');
     $db=new getQueries;
     $price_settings=$db->show1_active('price_settings');
     //rate weekly
         $percent_to_reduce=(1-($price_settings['week_disc']/100));
         $rate_per_week=($normal_price*$percent_to_reduce)*$price_settings['week_nights'];
     return $rate_per_week;
	}
    //------------------------------------determinar el monto mensual--------------------------------------------------
	function monthly_rate($normal_price){
       //apply to short term and rental online
    require_once('class/getQueries.php');
     $db=new getQueries;
     $price_settings=$db->show1_active('price_settings');
    //rate monthly
       $percent_to_reduce=(1-($price_settings['month_disc']/100));
       $rate_per_month=($normal_price*$percent_to_reduce)*$price_settings['month_nights'];

    return $rate_per_month;

	}

	function flat_amount($ref, $flat_type, $flat_amount){
       /* $flat_type=1 monthly flat*/ /* $flat_type=2 booking flat*/
         require_once('class/getQueries.php'); //llamar las consultas
         require_once('class/DB_class.php');  //llamar a insertar
         $db=new getQueries; //consulta
         $data= new DB;

         //buscar referencia en flat
         $flat_guardado=$db->show_active_limit1($table='flat_amount_long', $field='ref', $value=$ref, $operator='=');

         if ($flat_guardado[0]){/*si enontro flat activo*/
          //si la encuentro actualizo y pongo active en 0
          //e inserto un nuevo flat(para que tengan diferentes id admin si son diferentes)
       	  $data->update_flat_disable($flat_guardado[0]['id']);
          $data->insert_flat_pricing($date=date("Y-m-d G:i:s"), $type=$flat_type, $amount=$flat_amount, $ref, $id_adm=$_SESSION['info']['id'], $active='1');
         }else{
           	//si no la encuentro entonces inserto un nuevo record flat, solamente.
           $data->insert_flat_pricing($date=date("Y-m-d G:i:s"), $type=$flat_type, $amount=$flat_amount, $ref, $id_adm=$_SESSION['info']['id'], $active='1');
         }
	}

	function price_vehicle($id, $start_date, $days){
     require_once('class/getQueries.php');
     $db=new getQueries;
     $this_vehicule=$db->show_id($table='serv_add', $id);/*get details for this service*/
     //$Date = "2010-09-17";
	 $car_end=date('Y-m-d', strtotime($start_date. ' + '.$days.' days'));

     $setting_guardado=$db->show_any_data_limit1($table='vehicle_HS', $field='id', $value='1', $operator='='); /*get vehicle seasons*/
     $HS_F=$setting_guardado[0]['hs_from'];/*empieza la temporada alta*/
     $HS_T=$setting_guardado[0]['hs_to']; /*termina la temporada alta*/

     $cs=strtotime($start_date); /*car start*/
     $ce=strtotime($car_end); /*car end*/
     $ss=strtotime($HS_F); /*season start*/
     $se=strtotime($HS_T); /*season end*/

     $LS_P=$this_vehicule[0]['price']; /*precio teporada baja por menos de 5 dias*/
     $LS_PM=$this_vehicule[0]['price_min'];/*precio temporada bajo por mas de 5 dias*/
     $HS_P=$this_vehicule[0]['hs_price'];/*precio temporada alta*/
     $HS_PM=$this_vehicule[0]['hs_price2'];/*precio temporada alta minimo*/

	 if(($cs<=$se)&&($ce>=$ss)){/*precio temporada alta*/
      #$price=$HS_P;
        if($days>=5){ /*precio minimo de la temporada*/
          $price=$HS_PM;
      	}else{
          $price=$HS_P;
      	}
	 }else{/*precio temporada baja*/
        if($days>=5){ /*precio minimo de la temporada*/
          $price=$LS_PM;
      	}else{
          $price=$LS_P;
      	}
	 }
      //SI HAY PRECIOS DE TEMPRADA ALTA Y TEMPORADA BAJA
      //ENTONCES SOLO PONER PRECIO DE TEMPORADA ALTA
	return $price;
	}

 function fecha_in($y, $m, $d){
 	$fe=$y.'-'.$m.'-'.$d;
   	$date=date("Y-m-d",strtotime($fe));
   return $date;
 }

 function sp2($va){
  $num=str_pad($va, 2, '0', STR_PAD_LEFT);
 return $num;
 }

 function fecha_insert($name_add, $fecha){

    if(($fecha!='')&&($fecha!='1969-12-31')&&($fecha!='0000-00-00')){
	 $f0=strtotime($fecha);
	 $fh['d']=date("d",$f0); /* echo "<br/>"; */
	 $fh['mo']=date("m",$f0); /*echo "<br/>";*/
	 $fh['y']=date("Y",$f0); /*echo "<br/>";*/
	}else{
      $fh['d']='00';
      $fh['mo']='00';
      $fh['y']='0000';
	}

 ?>
     <!--//D  day//-->
      <select name="day<?=$name_add?>">
      <!--//	<option value="00" <? if($fh['d']=='00'){?> selected="selected" <?}?> >&nbsp;</option>//-->
      	<?
      	for($i=1; $i<=31; $i++){?>
         <option value="<?=sp2($i)?>" <? if($fh['d']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
      <!--//  month//-->
      <select name="month<?=$name_add?>">
      	<!--//<option value="00" <? if($fh['mo']=='00'){?> selected="selected" <?}?> >&nbsp;</option>//-->
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($fh['mo']==sp2($i)){?> selected="selected" <?}?> ><?=date('F',strtotime(sp2('2012-'.$i.'-01')))?></option>
	      <?
	      }
      	?>
      </select>

      <!--// year //--><select name="year<?=$name_add?>">
     <!--// <option value="0000" <? if($fh['y']=='0000'){?> selected="selected" <?}?> >&nbsp;</option>//-->
      	<?
      	for($i=(date('Y')-5); $i<=date('Y')+1; $i++){?>
         <option value="<?=$i?>" <? if($fh['y']==$i){?> selected="selected" <?}?> ><?=$i?></option>
	      <?
	      }
      	?>
      </select>
 <?
 }

 function expedia_fields($id_exp, $amount_exp){
 	if($_SESSION['exp_id']){ unset($_SESSION['exp_id']);}
 	if($_SESSION['exp_amount']){ unset($_SESSION['exp_amount']);}
 	?>
 	  <p style="text-align:right; font-size:10px; font-weight:bold; padding:0; margin:0;">
 	  Expedia ID<input  style="padding:" type="text" name="exp_id" value="<?=$id_exp?>"/>
 	  Expedia Amount<input type="text" name="exp_amount" value="<?=$amount_exp?>"/>
 	  </p>
 	<?
 }

 function nextId($table){/*get the next id to insert*/
		//$link = mysql_connect(SERVER, USER, PASS);
		//mysql_select_db(DB);
		
		$mysqli = new mysqli(SERVER, USER, PASS, DB);
		$result=$mysqli->query("SHOW TABLE STATUS LIKE '".DB_PREFIX.$table."'");
		$data =$result->fetch_assoc();
		//$result =mysql_query("SHOW TABLE STATUS LIKE '".DB_PREFIX.$table."'");
		//$data =mysql_fetch_assoc($result);
		$next_increment = $data['Auto_increment'];
		//mysql_close( $mysqli );
		$mysqli->close();
	return $next_increment;
 }

  function insert_or_update_exp($rcl_ref, $id_referral, $expedia_id, $expedia_amount){
		    $link= new getQueries();
		    $expedia=$link->show_any_data_limit1('expedia', 'rcl_ref', $rcl_ref, '=');
		    $db= new subDB (); //CONNECT TO DATABASE
			  if ($expedia){
			    $actualizado=$db->update_expedia($expedia[0]['id'], $rcl_ref, $id_referral, $expedia_id, $expedia_amount);
			  }else{
				$result=$db->insert_expedia($rcl_ref, $id_referral, $expedia_id, $expedia_amount);
			  }
			  //$db debe existir como la clase de insertar los campos
  }

  function days_dates($start, $end){
	  if($end==''){
	    $now = time(); // or your date as well
	  }else{
	    $now =strtotime($end);
	  }
     $your_date = strtotime($start);
     $datediff = $now - $your_date;
     return floor($datediff/(60*60*24));
  }

  function AgentClient($tipo, $idclient){
	 $link= new getQueries();
	 if($tipo=='sale'){
		$result=$link->getAgCl("`id_client`='".$idclient."' AND `id_sale`<>'0' AND `active`='1'");
	 }elseif($tipo=='rental'){
		$result=$link->getAgCl("`id_client`='".$idclient."' AND `id_rental`<>'0'  AND `active`='1'");
	 }
	 return $result[0];
	}

	function client_agent_update($id,$value=0, $type){
		$db= new DB;
		if($type=='sale'){
			$info=array('id_seller'=>$value);
			$db->update_gral($id, $info, 'customers');
		}elseif($type=='rental'){
			$info=array('id_commission'=>$value);
			$db->update_gral($id, $info, 'customers');
		}
	}
	function agent_referred_update($id, $value=0, $type){
		$db= new DB;
		  if($type=='sale'){
			$info=array('id_sale'=>$value);
			$db->update_gral($id, $info, 'clients_referred');
		  }elseif($type=='rental'){
			$info=array('id_rental'=>$value);
			$db->update_gral($id, $info, 'clients_referred');
		  }else{/*disable*/
			$info=array('active'=>$value);
			$db->update_gral($id, $info, 'clients_referred');
		  }
	}

 function sendMailText($body, $address, $subject, $from_add, $from_name) {

		$extra_header  = '';
		$extra_header  .= "MIME-Version: 1.0\n";
		$extra_header  .= "Content-type: text/html; charset=utf-8\n";
		$extra_header  .= "Content-transfer-encoding: 8bit\n";
		$extra_header  .= "Date: ". date('r'). "\n";
		$extra_header  .= "X-Priority: 3\n";   // send email with high priority; 3 is normal, 1 is high and 5 is de lowest.
		$extra_header  .= "X-Mailer: PHP\n";
		$extra_header  .= "X-MSMail-Priority: Normal\n";
		$extra_header  .= "From: $from_name <$from_add>\n";
		$extra_header  .= "Reply-to: <$from_add>\n";
		$extra_header  .= "Return-path: $from_name <$from_add>\n";
		$extra_header  .= "Bcc: ".ADMIN_EMAIL."\n";
		$extra_header  .= "CC: ".RESERVATIONS_EMAIL."\n";


		$mailsend = mail($address, $subject, $body, $extra_header);

		return true;

}

function mes($mes){
	switch($mes){
		case 1: $month="January"; break;
		case 2:  $month="February"; break;
		case 3:  $month="March"; break;
		case 4:  $month="April"; break;
		case 5:  $month="May"; break;
		case 6:  $month="June"; break;
		case 7:  $month="July"; break;
		case 8:  $month="August"; break;
		case 9:  $month="September"; break;
		case 10:  $month="October"; break;
		case 11:  $month="November"; break;
		case 12:  $month="December"; break;
		default: $month="unknown";
	}
	return $month;
}
?>
