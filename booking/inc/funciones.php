<?php

function ticketsSearch($page2go){
	
	$data= new getQueries ();
	
	$villasrcl=$data->all_villas();
	?>
	
	<form action="<?=$page2go?>.php" method="post">
	<p>SEARCH</p>
		<table align="center">
			<tr>
				<td align="right">
					Nr: <input type="text" value="<?=$_SESSION['search']['nr']?>" name="nr">
				</td>
				<td align="right">
					Villa: <select name="villa_id">
								<option value="">See All</option>
								<? foreach ($villasrcl as $k){?>
									<option value="<?=$k['id']?>" <? if ($k['id']==$_SESSION['search']['villa_id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
								<? }?>
							</select>
				</td>
				<td align="right">
				<?php if($_SESSION['info']['report']==6){?>
					Dep.: <select name="dep" >
								<?php
								$options=departmentsList();
								foreach($options as $k=>$v){
									?>
									<option value="<?=$k?>" <?php if($k==$_SESSION['search']['dep']){ echo 'selected="selected"'; }?>><?=$v?></option>
								<?php
								}
								?>
							</select>
				<?php } ?>
				</td>
			</tr>
			<tr>
				<td align="right">
					 Subject:
					<select name="subject" >
					<option value="">See All</option>
							<?php
							$options=tickets_subjects();
							foreach($options as $k=>$v){
								?>
								<option value="<?=$k?>" <?php if($k==$_SESSION['search']['subject']){ echo 'selected="selected"'; }?>><?=$v?></option>
							<?php
						}
						?>
					</select>					
				</td>
				<td align="right">
					From<span style="font-size:8px;">(YYYY-MM-DD)</span>:<input type="text" value="<?=$_SESSION['search']['start']?>" name="start" />
				</td>
				<td align="right">
					To<span style="font-size:8px;">(YYYY-MM-DD)</span>:<input type="text" value="<?=$_SESSION['search']['end']?>" name="end" />
				</td>
			</tr>
			<tr>
				<td colspan="3" align="right">
					<input type="submit" value="Search" name="buscar" />
				</td>
			</tr>
			</table>
	</form>
	<hr />
	<p>&nbsp;</p>
	
					<?
	
}
function time2string($endtime, $starttime) {
   $time=$endtime-$starttime;
	$d = floor($time/86400);
    $_d = ($d < 10 ? '0' : '').$d;

    $h = floor(($time-$d*86400)/3600);
    $_h = ($h < 10 ? '0' : '').$h;

    $m = floor(($time-($d*86400+$h*3600))/60);
    $_m = ($m < 10 ? '0' : '').$m;

    $s = $time-($d*86400+$h*3600+$m*60);
    $_s = ($s < 10 ? '0' : '').$s;

    $time_str = $_d.':'.$_h.':'.$_m.':'.$_s;

    return $time_str;
}

function priceRentalCar($idCar, $start_date, $qtyDays){
	 $db=new getQueries;
     $this_vehicule=$db->show_id($table='carros', $idCar);/*get details for this service*/
     //$Date = "2010-09-17";
	 $car_end=date('Y-m-d', strtotime($start_date. ' + '.$qtyDays.' days'));

     $setting_guardado=$db->show_any_data_limit1($table='vehicle_HS', $field='id', $value='1', $operator='='); /*get vehicle seasons*/
     $HS_F=$setting_guardado[0]['hs_from'];/*empieza la temporada alta*/
     $HS_T=$setting_guardado[0]['hs_to']; /*termina la temporada alta*/

     $cs=strtotime($start_date); /*car start*/
     $ce=strtotime($car_end); /*car end*/
     $ss=strtotime($HS_F); /*season start*/
     $se=strtotime($HS_T); /*season end*/

     $LS_Max=$this_vehicule[0]['LS_max']; /*precio teporada baja por menos de 5 dias*/
     $LS_Min=$this_vehicule[0]['LS_min'];/*precio temporada bajo por mas de 5 dias*/
     $HS_Max=$this_vehicule[0]['HS_max'];/*precio temporada alta*/
     $HS_Min=$this_vehicule[0]['HS_min'];/*precio temporada alta minimo*/

	 if(($cs>=$ss)&&($cs<=$se)){/*precio temporada alta*/
      #$price=$HS_P;
        if($qtyDays>=5){ /*precio minimo de la temporada*/
          $price=$HS_Min;
      	}else{
          $price=$HS_Max;
      	}
	 }else{/*precio temporada baja*/
        if($qtyDays>=5){ /*precio minimo de la temporada*/
          $price=$LS_Min;
      	}else{
          $price=$LS_Max;
      	}
	 }
	return $price;
}
/*
function tickets_subjects(){
	 $tickets=array(
					'2'=>'No Water',
					'3'=>'No Hot Water',
					'6'=>'Insects',
					'13'=>'Inventory',
					'14'=>'Construction',
					'4'=>'TV',
					'16'=>'Cable',
					'5'=>'Air Conditioning',
					'7'=>'Safe',
					'8'=>'Lights',
					'9'=>'Doors/Keys',
					'10'=>'Maid Service',
					'11'=>'Pool & Garden',
					'1'=>'Internet connection',
					'15'=>'Jacuzzi',
					'12'=>'Maintenance',
					'17'=>'House Keeping',
					'18'=>'Painting'
					);
	return $tickets;
}*/


function tickets_subjects_maint(){
	 $tickets=array('44'=>'MAINTENANCE',
					'45'=>'&nbsp;&nbsp;AC',
					'66'=>'&nbsp;&nbsp;appliances',
					'46'=>'&nbsp;&nbsp;carpentry',
					'47'=>'&nbsp;&nbsp;electrical',
					'48'=>'&nbsp;&nbsp;doors/windows',
					'49'=>'&nbsp;&nbsp;gas',
					'50'=>'&nbsp;&nbsp;jacuzzi',
					'51'=>'&nbsp;&nbsp;lights',
					'52'=>'&nbsp;&nbsp;masonry/tiles',
					'53'=>'&nbsp;&nbsp;not hot water',
					'54'=>'&nbsp;&nbsp;not water',
					'55'=>'&nbsp;&nbsp;painting',
					'67'=>'&nbsp;&nbsp;pipes and drains',
					'56'=>'&nbsp;&nbsp;pump',
					'57'=>'&nbsp;&nbsp;safe 5-11pm',
					'58'=>'&nbsp;&nbsp;TV',
					'66'=>'&nbsp;&nbsp;diverse',
					'59'=>'',
					'60'=>'',
					'1'=>'CONSTRUCTION',
					'2'=>'&nbsp;NEW VILLAS 7/8',
					'3'=>'&nbsp;&nbsp;AC',
					'4'=>'&nbsp;&nbsp;Cracks',
					'5'=>'&nbsp;&nbsp;Electrical',
					'6'=>'&nbsp;&nbsp;Filtration',
					'7'=>'&nbsp;&nbsp;Garden',
					'8'=>'&nbsp;&nbsp;hot water',
					'9'=>'&nbsp;&nbsp;Painting',
					'10'=>'&nbsp;&nbsp;pool',
					'11'=>'&nbsp;&nbsp;Pipes',
					'12'=>'&nbsp;&nbsp;pump',
					'13'=>'&nbsp;&nbsp;Toilet/shower',
					'14'=>'&nbsp;CONSTRUCTION GUARANTEE',
					'15'=>'&nbsp;&nbsp;AC',
					'16'=>'&nbsp;&nbsp;Cracks',
					'17'=>'&nbsp;&nbsp;Electrical',
					'18'=>'&nbsp;&nbsp;Filtration',
					'19'=>'&nbsp;&nbsp;Garden',
					'20'=>'&nbsp;&nbsp;hot water',
					'21'=>'&nbsp;&nbsp;Painting',
					'22'=>'&nbsp;&nbsp;pool',
					'23'=>'&nbsp;&nbsp;Pipes',
					'24'=>'&nbsp;&nbsp;pump',
					'25'=>'&nbsp;&nbsp;Toilet/shower',
					'26'=>'',
					'27'=>'',
					'28'=>'HOUSE KEEPING',
					'29'=>'&nbsp;&nbsp;Cable',
					'30'=>'&nbsp;&nbsp;cleaning',
					'31'=>'&nbsp;&nbsp;Furniture',
					'32'=>'&nbsp;&nbsp;Insects',
					'33'=>'&nbsp;&nbsp;Inventory',
					'34'=>'&nbsp;&nbsp;Linens and Towels',
					'35'=>'&nbsp;&nbsp;Maid Service',
					'36'=>'&nbsp;&nbsp;Missing key',
					'37'=>'&nbsp;&nbsp;Remote Control',
					'38'=>'&nbsp;&nbsp;Safe 8-4pm',
					'39'=>'',
					'40'=>'',
					'41'=>'GARDEN/POOL',
					'42'=>'',
					'43'=>'',
					'61'=>'TECNICAL',
					'62'=>'&nbsp;&nbsp;Cameras',
					'63'=>'&nbsp;&nbsp;Internet connection',
					'64'=>'&nbsp;&nbsp;Phone',
					'65'=>'&nbsp;&nbsp;Repairs/setup'
					);
	return $tickets;
}
function tickets_subjects(){
	 $tickets=array(
					'28'=>'HOUSE KEEPING',
					'29'=>'&nbsp;&nbsp;Cable',
					'30'=>'&nbsp;&nbsp;cleaning',
					'31'=>'&nbsp;&nbsp;Furniture',
					'32'=>'&nbsp;&nbsp;Insects',
					'33'=>'&nbsp;&nbsp;Inventory',
					'34'=>'&nbsp;&nbsp;Linens and Towels',
					'35'=>'&nbsp;&nbsp;Maid Service',
					'36'=>'&nbsp;&nbsp;Missing key',
					'37'=>'&nbsp;&nbsp;Remote Control',
					'38'=>'&nbsp;&nbsp;Safe 8-4pm',
					'39'=>'',
					'40'=>'',
					'41'=>'GARDEN/POOL',
					'42'=>'',
					'43'=>'',
					'61'=>'TECNICAL',
					'62'=>'&nbsp;&nbsp;Cameras',
					'63'=>'&nbsp;&nbsp;Internet connection',
					'64'=>'&nbsp;&nbsp;Phone',
					'65'=>'&nbsp;&nbsp;Repairs/setup',
					'26'=>'',
					'27'=>'',
					'1'=>'CONSTRUCTION',
					'2'=>'&nbsp;NEW VILLAS 7/8',
					'3'=>'&nbsp;&nbsp;AC',
					'4'=>'&nbsp;&nbsp;Cracks',
					'5'=>'&nbsp;&nbsp;Electrical',
					'6'=>'&nbsp;&nbsp;Filtration',
					'7'=>'&nbsp;&nbsp;Garden',
					'8'=>'&nbsp;&nbsp;hot water',
					'9'=>'&nbsp;&nbsp;Painting',
					'10'=>'&nbsp;&nbsp;pool',
					'11'=>'&nbsp;&nbsp;Pipes',
					'12'=>'&nbsp;&nbsp;pump',
					'13'=>'&nbsp;&nbsp;Toilet/shower',
					'14'=>'&nbsp;CONSTRUCTION GUARANTEE',
					'15'=>'&nbsp;&nbsp;AC',
					'16'=>'&nbsp;&nbsp;Cracks',
					'17'=>'&nbsp;&nbsp;Electrical',
					'18'=>'&nbsp;&nbsp;Filtration',
					'19'=>'&nbsp;&nbsp;Garden',
					'20'=>'&nbsp;&nbsp;hot water',
					'21'=>'&nbsp;&nbsp;Painting',
					'22'=>'&nbsp;&nbsp;pool',
					'23'=>'&nbsp;&nbsp;Pipes',
					'24'=>'&nbsp;&nbsp;pump',
					'25'=>'&nbsp;&nbsp;Toilet/shower'
					
					);
	return $tickets;
}
function tickets_status($status){
	switch($status){
		case 1: $tickets='<span style="color:#337AB7; font-weight:bold;">Reported</span>'; break;
		case 2: $tickets='<span style="color:#3C763D; font-weight:bold;">In process</span>'; break;
		case 3: $tickets='<span style="color:#31708F; font-weight:bold;">Completed</span>'; break;
		case 4: $tickets='<span style="color:#8A6D3B; font-weight:bold;">Cancelled</span>'; break;
		case 5: $tickets='<span style="color:#A94442; font-weight:bold;">Changed</span>'; break;
		case 6: $tickets='<span style="color:#31708F; font-weight:bold;">Completed Note changed</span>'; break;
		default:$tickets='unknown';
	}
	return $tickets;
}
function departments(){
	 $depart=array(	'0'=>'None',
					'1'=>'Maintenance',
					'3'=>'House Keeping',
					'4'=>'Technical',
					'5'=>'Construction',
					'7'=>'Pool & Garden',
					'6'=>'See all'
					);
	return $depart;
}
function departmentsList(){
	 $depart=array(	''=>'See all',
					'1'=>'Maintenance',
					'3'=>'House Keeping',
					'4'=>'Technical',
					'5'=>'Construction'
					);
	return $depart;
}
/*
function department_no($subject_no){
	$departmentnumber='';
	
	switch($subject_no){
		
		case 2: $departmentnumber=1; break;
		case 3: $departmentnumber=1; break;
		case 6: $departmentnumber=3; break;
		case 13: $departmentnumber=3; break;
		case 14: $departmentnumber=5; break;
		case 4: $departmentnumber=3; break;
		case 5: $departmentnumber=1; break;
		case 7: $departmentnumber=1; break;
		case 8: $departmentnumber=1; break;
		case 9: $departmentnumber=1; break;
		case 10: $departmentnumber=3; break;
		case 11: $departmentnumber=1; break;
		case 1: $departmentnumber=4; break;
		case 15: $departmentnumber=1; break;
		case 12: $departmentnumber=1; break;
		case 16: $departmentnumber=3; break;
		case 17: $departmentnumber=3; break;
		case 18: $departmentnumber=1; break;
		default:$departmentnumber=1;
	}
	return $departmentnumber;
}*/
function department_no($subject_no){
	$departmentnumber='';
	if(($subject_no>=1)&&($subject_no<=25)){
		$departmentnumber=5;//construction
	}elseif(($subject_no>=28)&&($subject_no<=38)){
		$departmentnumber=3;//house keeping
	}elseif(($subject_no>=44)&&($subject_no<=58)){
		$departmentnumber=1;//maintenance
	}elseif(($subject_no>=61)&&($subject_no<=65)){
		$departmentnumber=4;//TECNICAL
	}elseif($subject_no==41){
		$departmentnumber=7;//pool and garden
	}
	return $departmentnumber;
}
function notifyTicketDep_details($depart, $details, $tickedno, $fromNamelastname){
	$db=new getQueries;
	//select user where dept = to this
	$users=$db->usersDepartment($depart);
	//if result
	if($users){
		 $data= new DB();
		foreach($users AS $k){
		 if($k['noemails']!=1){
			$toNameLastname=$k['name'].' '.$k['lastname'];
			$bodyhtml=infoTicketHtml_details($ticket, $details, $toNameLastname, $fromNamelastname);
			//send email to each user
			sendMail($bodyhtml, $address=$k['email'], $subject="Ticket number $tickedno", $from_add='noreply@casalindacity.com', $from_name='Residencial Casa Linda');
			//save notification
			$fields2=array('reportid'=>$tickedno,
						  'email'=>$k['email'], 
						  'body'=>htmlentities($bodyhtml, ENT_QUOTES),
						  'userid'=>$_SESSION['info']['id'],
						  'date'=>time());
			$reporthistid=$data->insert($fields2, $table='reportemail');
		 }
		}
	}
}
function notifyTicketDep($depart, $tickedno, $fromNamelastname){
	$db=new getQueries;
	//select user where dept = to this
	$users=$db->usersDepartment($depart);
	//if result
	if($users){
		 $data= new DB();
		foreach($users AS $k){
		 if($k['noemails']!=1){
			$toNameLastname=$k['name'].' '.$k['lastname'];
			$bodyhtml=infoTicketHtml($tickedno, $toNameLastname, $fromNamelastname);
			//send email to each user
			sendMail($bodyhtml, $address=$k['email'], $subject="Ticket number $tickedno", $from_add='noreply@casalindacity.com', $from_name='Residencial Casa Linda');
			//save notification
			$fields2=array('reportid'=>$tickedno,
						  'email'=>$k['email'], 
						  'body'=>htmlentities($bodyhtml, ENT_QUOTES),
						  'userid'=>$_SESSION['info']['id'],
						  'date'=>time());
			$reporthistid=$data->insert($fields2, $table='reportemail');
		 }
		}
	}
}
function notifyTicketDep1($depart, $tickedno, $fromNamelastname){
	$db=new getQueries;
	//select user where dept = to this
	$users=$db->usersDepartment($depart);
	//if result
	if($users){
		 $data= new DB();
		foreach($users AS $k){
			if($k['noemails']!=1){
				$toNameLastname=$k['name'].' '.$k['lastname'];
				$bodyhtml=infoTicketHtml1($tickedno, $toNameLastname, $fromNamelastname);
				//send email to each user
				sendMail($bodyhtml, $address=$k['email'], $subject="Ticket number $tickedno", $from_add='noreply@casalindacity.com', $from_name='Residencial Casa Linda');
				//save notification
				$fields2=array('reportid'=>$tickedno,
							  'email'=>$k['email'], 
							  'body'=>htmlentities($bodyhtml, ENT_QUOTES),
							  'userid'=>$_SESSION['info']['id'],
							  'date'=>time());
				$reporthistid=$data->insert($fields2, $table='reportemail');
			}
		}
	}
}

function notifyTicketCancel($depart, $tickedno, $fromNamelastname, $creator){
	$db=new getQueries;
	 $data= new DB();
	$toNameLastname=$creator['name'].' '.$creator['lastname'];
			$bodyhtml=infoTicketHtml2($tickedno, $toNameLastname, $fromNamelastname);
			//send email to each user
			sendMail($bodyhtml, $address=$creator['email'], $subject="Ticket number $tickedno", $from_add='noreply@casalindacity.com', $from_name='Residencial Casa Linda');
			//save notification
			$fields2=array('reportid'=>$tickedno,
						  'email'=>$k['email'], 
						  'body'=>htmlentities($bodyhtml, ENT_QUOTES),
						  'userid'=>$_SESSION['info']['id'],
						  'date'=>time());
			$reporthistid=$data->insert($fields2, $table='reportemail');
	
	//select user where dept = to this
	$users=$db->usersDepartment($depart);
	//if result
	if($users){
		
		foreach($users AS $k){
			if($k['noemails']!=1){
				$toNameLastname=$k['name'].' '.$k['lastname'];
				$bodyhtml=infoTicketHtml2($tickedno, $toNameLastname, $fromNamelastname);
				//send email to each user
				sendMail($bodyhtml, $address=$k['email'], $subject="Ticket number $tickedno", $from_add='noreply@casalindacity.com', $from_name='Residencial Casa Linda');
				//save notification
				$fields2=array('reportid'=>$tickedno,
							  'email'=>$k['email'], 
							  'body'=>htmlentities($bodyhtml, ENT_QUOTES),
							  'userid'=>$_SESSION['info']['id'],
							  'date'=>time());
				$reporthistid=$data->insert($fields2, $table='reportemail');
			}
		}
	}
}

function fechaLegible($fechatime)
{
	
	echo date("j,M,y g:ia", $fechatime);
}
function selectServices($start_date){
  $db=new getQueries;
  $rantals_car=$db->show_all_active($table='carros', $order='id');


     if($rantals_car){?>

          <table cellpadding="0px" style="border: 1px solid #9c0000;" width="100%"><tr>
	          <td><strong>Select</strong></td>
	          <td align="center"><strong>Car rental</strong></td>
	          <td><strong>Days</strong></td>
          </tr>
         <?

         foreach ($rantals_car AS $k) {
            $precio_carro=priceRentalCar($idCar=$k['id'], $start_date, $qtyDays='1');
         ?>
			<tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">
				<td>
					<input type="checkbox" value="<?=$k['id']?>" name="car[<?=$k['id']?>]" >
				</td>
				<td>
					<?=substr($k['name'], 0, 20);?>
					(US$ <?=number_format($precio_carro,0)?>)
				</td>
				<td>
					<select name="car_qty[<?=$k['id']?>]">
						<?for($i=1; $i<=50; $i++){?>
						<option value="<?=$i;?>" ><?=$i;?></option>
						<?}?>
					</select>
		 			<input type="hidden" name="car_price[<?=$k['id']?>]" value="<?=$precio_carro?>"/>
		 		</td>
		 	</tr>
		 <?
		 }
         ?>
		</table>
		<?
       }

}

function ChangeServices($reference, $start_date){
  $db=new getQueries;
  $rantals_car=$db->show_all_active($table='carros', $order='id');
  $services_booked=$db->showTable_r($table='cars_rented', $field='ref', $value=$reference, $operator='=');
  /* echo "<pre>";
   print_r($services_booked);
   echo "</pre>";*/
     if($rantals_car){?>

          <table cellpadding="0px" style="border: 1px solid #9c0000; clear:Left;" align="right"><tr>
	          <td><strong>Select</strong></td>
	          <td align="center"><strong>Car rental</strong></td>
	          <td><strong>Days</strong></td>
          </tr>
         <?

         foreach ($rantals_car AS $k) {
            $precio_carro=priceRentalCar($idCar=$k['id'], $start_date, $qtyDays='1');
            if($services_booked){
            	foreach($services_booked AS $k2){
                  if($k['id']==$k2['id_car']){
                  	 $checked='checked="checked"';
                     $select='selected="selected"';
                     $qty_cars=$k2['qty_days'];
                  }
            	}
            }
         ?>
			<tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">
				<td>
					<input type="checkbox" value="<?=$k['id']?>" name="car[<?=$k['id']?>]" <?=$checked;?>>
				</td>
				<td>
					<?=substr($k['name'], 0, 20);?>
					(US$ <?=number_format($precio_carro,0)?>)
				</td>
				<td>
					<select name="car_qty[<?=$k['id']?>]">
						<?for($i=1; $i<=50; $i++){?>
						<option value="<?=$i;?>" <? if($qty_cars==$i){?> <?=$select;?> <?}?> ><?=$i;?></option>
						<?}?>
					</select>
		 			<input type="hidden" name="car_price[<?=$k['id']?>]" value="<?=$precio_carro?>"/>
		 		</td>
		 	</tr>
		 <?
		 if($checked){ unset($checked);} /*quitar las variables para que no se seleccionen los servicios siguientes*/
		 if($select){ unset($select);} /*quitar las variables para que no se seleccionen los servicios siguientes*/
		 if($qty_cars){ unset($qty_cars);}  /*quitar las variables para que no se seleccionen los servicios siguientes*/
		 }
         ?>
		</table>
		<?
       }

}

function price_water($bed){
  switch($bed){
		case 2:
			$price=25;
			break;
		case 3:
			$price=25;
			break;
		case 4:
			$price=30;
			break;
		case 5:
			$price=30;
			break;
		case 6:
			$price=35;
			break;
		default:
	      $price=35;
	}
	return $price;
}

function price_gas($bed){
	switch($bed){
		case 2:
			$price=15;
			break;
		case 3:
			$price=20;
			break;
		case 4:
			$price=25;
			break;
		case 5:
			$price=30;
			break;
		case 6:
			$price=35;
			break;
		default:
	      $price=35;
	}
	return $price;
}
?>