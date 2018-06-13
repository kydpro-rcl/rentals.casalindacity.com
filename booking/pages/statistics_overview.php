<?
//set_time_limit(60);/*60 seconds for execution*/
set_time_limit(0); //will set the time unlimited
 $link= new getQueries ();
	$v="villas";   $cond="able_r=1 AND vonline=0";  $order="no";
	$villas4rent=$link->showTable_restrinted($v,$cond,$order);

	if(($_GET['m']!='')&&($_GET['y']!='')){
     $_POST['m']=$_GET['m'];
     $_POST['y']=$_GET['y'];
	}

	if(($_POST['m']!='')&&($_POST['y']!='')){
     $this_month=$_POST['m']; $this_year=$_POST['y'];
	}else{
	 $this_month=date('m'); $this_year=date('Y');
	}

	$ultimo_dia = ultimoDia($mes=$this_month,$ano=$this_year);

    $v="villas";   $cond="able_r=0";  $order="no";
	$villasNOrent=$link->showTable_restrinted($v,$cond,$order);
   /* $busy=$link->c_bookings($villa_id='65', $fecha_inicio='2013-04-01', $fecha_fin='2013-04-30'); */
	//funcion que devulve en un arreglo los dias rentados en el mes de una villa y que tipo de renta son cada dias.
	// funcion que devulve los dias en mantenimientos de una villa
   /* echo "<pre>";
	print_r($busy);
	echo "</pre>";*/

  /*
 echo "<pre>";
  print_r($dias_arreglos_mes);
  print_r($resultado_booking);
 echo "</pre>"; */

?>
<style  type="text/css">
.colum{
  padding-left:5px; padding-right:5px;
 }
</style>

<p class="header">Statistical Overview</p>

<? if(!$_GET['y']){?>
<form method="post" action="stat_overview.php" >
	<p id="fields" style="text-align:center;">Month:
	     <select name="m">
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($_POST['m']==sp2($i)){?> selected="selected" <?} if(!$_POST){?> <? if(date('m')==sp2($i)){?> selected="selected" <?}}?>  ><?=date('F',strtotime(sp2('2012-'.$i.'-01')))?></option>
	      <?
	      }
      	?>
      </select>
      Year:
   	<select name="y">
      	<?
      	for($i=(date('Y')-3); $i<=(date('Y')+1); $i++){?>
         <option value="<?=$i?>" <? if($_POST['y']==$i){?> selected="selected" <?} if(!$_POST){?>  <? if(date('Y')==$i){?> selected="selected" <?}}?> ><?=$i?></option>
	      <?
	    }
      	?>
      </select>

      <input class="book_but" type="submit" name="go" value="go"/>
	</p>
</form>
 <?}else{

 	echo "<p>RCL Booking System - Statistics Report for ".date('F', strtotime('2013-'.$this_month.'-01'))." ".$this_year."</p>";
 }?>
<hr />

<table  align="center" cellpadding="0" cellspacing="1" border="0" style="font-weight:normal; font-family:arial;">
			<tr style="background-color:#80abca;">
				<td class="colum">
					Villa
				</td >
				<td class="colum">
					# Bdr
				</td>
				<td class="colum">
					Nights occupied
				</td>
				<td class="colum">
					Bookings
				</td>
				<td class="colum">
					Nights Maint.
				</td>
				<td class="colum">
					Nights Rentable
				</td>
				<td class="colum">
					Villa occ. rate
				</td>
				<td class="colum">
					Long Term
				</td>
				<td class="colum">
					Owner term
				</td>
				<td class="colum" >
					Comments
				</td>
			</tr>
			<?



			 $x=0;

             /*$t_2bed=0; $t_3bed=0; $t_4bed=0; $t_6bed=0;*/

             $arr_totals=array();

             $fecha_final_mes=$this_year.'-'.$this_month.'-'.$ultimo_dia;
             $fecha_inicial_mes=$this_year.'-'.$this_month.'-01';
    		/* $dias_arreglos_mes=arreglos_days($start_date='2013-04-01', $end_date='2013-04-30');  */
    		$dias_arreglos_mes=arreglos_days($start_date=$fecha_inicial_mes, $end_date=$fecha_final_mes);
           	$array_not_rental_villas['villas']=array(); /*no rental villas*/
    		foreach($villasNOrent AS $vn){

              $busy0=$link->c_bookings($villa_id=$vn['id'], $fecha_inicio=$fecha_inicial_mes, $fecha_fin=$fecha_final_mes);
              if(count($busy0)>0){  /*si hay booginks en esta villa*/
               $array_not_rental_villas[$vn['id']]=array(); /*bookings for this no rental villas*/
               $can_bc=count($busy0);
               if($can_bc==1){
                   if($busy0[0]['status']!=5){/* if the booking found is not a mantenances*/
                   	 /*poner informacion del booking y la filla aqui*/
                       /*echo '<pre>'; print_r($busy0[0]); echo '</pre>';
                       echo '<pre>'; print_r($vn); echo '</pre>'; */

                       array_push($array_not_rental_villas['villas'], $vn);
                       array_push($array_not_rental_villas[$vn['id']], $busy0);
                   }
               }else{
               	/*poner informacion del booking y la villa aqui*/
                 /*foreach($busy0 AS $bc){

				 }*/
				 array_push($array_not_rental_villas[$vn['id']], $busy0);
				 array_push($array_not_rental_villas['villas'], $vn);
				 /*echo '<pre>'; print_r($busy0); echo '</pre>';
                 echo '<pre>'; print_r($vn); echo '</pre>';*/
                }
               }

			} /*end villas not for rent*/

			foreach($villas4rent AS $V){/*only villas for rent here*/
				$v_long=0;/*long nights for this villa*/
             	$v_short=0;
             	$v_owner=0;
             	$v_mant=0;
                $n_occupied=0;/*total nights occupied for this villa*/
                $v_bookings=0;
				 $busy=$link->c_bookings($villa_id=$V['id'], $fecha_inicio=$fecha_inicial_mes, $fecha_fin=$fecha_final_mes);
				
				
				if($busy){
					if(count($busy)>0){/*hacer esto solo se encuentran bookings para esta villa en el mes indicado*/
					 foreach($busy AS $k){
						  $v_bookings++;/*cuenta los bookings de una villa*/
						 $resultado_booking=noches_del_mes_en_booking($array_days_month=$dias_arreglos_mes, $array_booking=$k,$last_date_month=$fecha_final_mes);
						/* echo '-'.$resultado_booking['nights_occupied']; echo $resultado_booking['status']."<br/>";*/
						 if($resultado_booking['status']=='long'){
							$v_long+=$resultado_booking['nights_occupied'];
						 }elseif($resultado_booking['status']=='short'){
							$v_short+=$resultado_booking['nights_occupied'];
						 }elseif($resultado_booking['status']=='owner'){
							 $v_owner+=$resultado_booking['nights_occupied'];
						 }elseif($resultado_booking['status']=='maintenance'){
							  $v_mant+=$resultado_booking['nights_occupied'];
							  $v_bookings--;/*resta este mantenimiento de los bookings de una villa*/
						 }
					 }
					 $n_occupied=$v_long+$v_short+$v_owner;
					 $arr_totals['total']['nights_occupied']+=$n_occupied;
					 $arr_totals['total']['bookings']+=$v_bookings;
					 $arr_totals['total']['maint']+=$v_mant;
					 $arr_totals['total']['long']+=$v_long;
					 $arr_totals['total']['owner']+=$v_owner;
					}
					$noches_rentable=$ultimo_dia-$v_mant;
					$arr_totals['total']['bdrs']+=$V['bed'];
					$arr_totals['total']['nights_rentable']+=$noches_rentable;

					switch($V['bed']){
						case 2: /*2 bedrooms*/
							 $arr_totals['total']['2bdr']['qty']+=$V['bed'];
							 $arr_totals['total']['2bdr']['occ']+=$n_occupied;
							 $arr_totals['total']['2bdr']['rent']+=$noches_rentable;
							 break;
						case 3: /*3 bedrooms*/
							$arr_totals['total']['3bdr']['qty']+=$V['bed'];
							 $arr_totals['total']['3bdr']['occ']+=$n_occupied;
							 $arr_totals['total']['3bdr']['rent']+=$noches_rentable;
							 break;
						case 4: /*4 bedrooms*/
							$arr_totals['total']['4bdr']['qty']+=$V['bed'];
							 $arr_totals['total']['4bdr']['occ']+=$n_occupied;
							 $arr_totals['total']['4bdr']['rent']+=$noches_rentable;
							 break;
						case 5: //5 bedrooms
							$arr_totals['total']['5bdr']['qty']+=$vn['bed'];
							 $arr_totals['total']['5bdr']['occ']+=$n_occupied;
							 $arr_totals['total']['5bdr']['rent']+=$noches_rentable;
							 break;
						case 6: /*6 bedrooms*/
							$arr_totals['total']['6bdr']['qty']+=$V['bed'];
							 $arr_totals['total']['6bdr']['occ']+=$n_occupied;
							 $arr_totals['total']['6bdr']['rent']+=$noches_rentable;
							 break;
					}

					?>
					<tr class='fila<?=$x;?>'>
						<td><a href="chart_trends.php?id=<?=$V['id']?>&m=<?=$this_month?>&y=<?=$this_year?>" target="_blank" title="See trend chart villa <?=$V['no']?> "><?=$V['no']?></a></td>
						<td><?=$V['bed']?></td>
						<td><? if($n_occupied!=0) echo $n_occupied;?></td>
						<td><? if($v_bookings!=0) echo $v_bookings?></td>
						<td><? if($v_mant!=0) echo $v_mant?></td>
						<td><?=$noches_rentable?></td>
						<td><?
							if($noches_rentable!=0){
							  $occ_rate=$n_occupied/$noches_rentable*100;
							}else{
								$occ_rate=0;
							}
						?>

						<?=number_format($occ_rate,2)?>%</td>
						<td><? if($v_long!=0) echo $v_long;?></td>
						<td><? if($v_owner!=0) echo $v_owner;?></td>
						<td>
						<?
						if(($v_bookings==1)&&($v_long>0)){
						   $cl=$link->customer($array_booking['client']);
						   echo $cl['name'].' '.$cl['lastname'];
						}
						?>
						</td>
					</tr>
				<?
				 if ($x==0){$x++;} elseif ($x==1){$x--;}
				}else{
					$villas_minus++;
				}
			}
				?>


			<?
			if($array_not_rental_villas['villas']){ //Villa not rentable here
              foreach($array_not_rental_villas['villas'] AS $vn){

              	$v_long=0;//long nights for this villa
             	$v_short=0;
             	$v_owner=0;
             	$v_mant=0;
                $n_occupied=0;//total nights occupied for this villa
                $v_bookings=0;


              	$busy0=$link->c_bookings($villa_id=$vn['id'], $fecha_inicio=$fecha_inicial_mes, $fecha_fin=$fecha_final_mes);
              	if(count($busy0)>0){//hacer esto solo se encuentran bookings para esta villa en el mes indicado
				 foreach($busy0 AS $k){
                      $v_bookings++;//cuenta los bookings de una villa
				     $resultado_booking=noches_del_mes_en_booking($array_days_month=$dias_arreglos_mes, $array_booking=$k,$last_date_month=$fecha_final_mes);

				     if($resultado_booking['status']=='long'){
                        $v_long+=$resultado_booking['nights_occupied'];
				     }elseif($resultado_booking['status']=='short'){
                        $v_short+=$resultado_booking['nights_occupied'];
				     }elseif($resultado_booking['status']=='owner'){
                         $v_owner+=$resultado_booking['nights_occupied'];
				     }elseif($resultado_booking['status']=='maintenance'){
                          $v_mant+=$resultado_booking['nights_occupied'];
                          $v_bookings--;//resta este mantenimiento de los bookings de una villa
				     }
                 }
                 $n_occupied=$v_long+$v_short+$v_owner;
                 $arr_totals['total']['nights_occupied']+=$n_occupied;
                 $arr_totals['total']['bookings']+=$v_bookings;
                 $arr_totals['total']['maint']+=$v_mant;
                 $arr_totals['total']['long']+=$v_long;
                 $arr_totals['total']['owner']+=$v_owner;
                }
                $noches_rentable=$ultimo_dia-$v_mant;
                $arr_totals['total']['bdrs']+=$vn['bed'];
                $arr_totals['total']['nights_rentable']+=$noches_rentable;

				switch($V['bed']){
					case 2: //2 bedrooms
					     $arr_totals['total']['2bdr']['qty']+=$vn['bed'];
					     $arr_totals['total']['2bdr']['occ']+=$n_occupied;
					     $arr_totals['total']['2bdr']['rent']+=$noches_rentable;
                         break;
					case 3: //3 bedrooms
						$arr_totals['total']['3bdr']['qty']+=$vn['bed'];
					     $arr_totals['total']['3bdr']['occ']+=$n_occupied;
					     $arr_totals['total']['3bdr']['rent']+=$noches_rentable;
					     break;
					case 4: //4 bedrooms
						$arr_totals['total']['4bdr']['qty']+=$vn['bed'];
					     $arr_totals['total']['4bdr']['occ']+=$n_occupied;
					     $arr_totals['total']['4bdr']['rent']+=$noches_rentable;
					     break;
					case 5: //5 bedrooms
						$arr_totals['total']['5bdr']['qty']+=$vn['bed'];
					     $arr_totals['total']['5bdr']['occ']+=$n_occupied;
					     $arr_totals['total']['5bdr']['rent']+=$noches_rentable;
					     break;
					case 6: //6 bedrooms
						$arr_totals['total']['6bdr']['qty']+=$vn['bed'];
					     $arr_totals['total']['6bdr']['occ']+=$n_occupied;
					     $arr_totals['total']['6bdr']['rent']+=$noches_rentable;
					     break;
				}?>
               <tr style="background-color:#fabf8f;">
		              <td><?=$vn['no']?></td>
					<td><?=$vn['bed']?></td>
					<td><? if($n_occupied!=0) echo $n_occupied;?></td>
					<td><? if($v_bookings!=0) echo $v_bookings?></td>
					<td><? if($v_mant!=0) echo $v_mant?></td>
					<td><?=$noches_rentable?></td>
					<td><?
						if($noches_rentable!=0){
						  $occ_rate=$n_occupied/$noches_rentable*100;
						}else{
							$occ_rate=0;
						}
					?>

					<?=number_format($occ_rate,2)?>%</td>
					<td><? if($v_long!=0) echo $v_long;?></td>
					<td><? if($v_owner!=0) echo $v_owner;?></td>
					<td>
					<?
					if(($v_bookings==1)&&($v_long>0)){
	                   $cl=$link->customer($array_booking['client']);
	                   echo $cl['name'].' '.$cl['lastname'];
					}
					?>
					</td>
	            </tr>
              <?}
			}
			?>

			<?
				if($arr_totals['total']['nights_occupied']!=0){ $arr_totals['total']['occ_rate']=($arr_totals['total']['nights_occupied']/$arr_totals['total']['nights_rentable'])*100; }
				
				if($arr_totals['total']['2bdr']['occ']!=0){ $arr_totals['total']['2bdr']['rate']=($arr_totals['total']['2bdr']['occ']/$arr_totals['total']['2bdr']['rent'])*100; }
				
              if($arr_totals['total']['3bdr']['occ']!=0){ $arr_totals['total']['3bdr']['rate']=($arr_totals['total']['3bdr']['occ']/$arr_totals['total']['3bdr']['rent'])*100; }
				
              if($arr_totals['total']['5bdr']['occ']!=0){ $arr_totals['total']['5bdr']['rate']=($arr_totals['total']['5bdr']['occ']/$arr_totals['total']['5bdr']['rent'])*100; }
				 
              if($arr_totals['total']['4bdr']['occ']!=0){ $arr_totals['total']['4bdr']['rate']=($arr_totals['total']['4bdr']['occ']/$arr_totals['total']['4bdr']['rent'])*100; }
				
              if($arr_totals['total']['6bdr']['occ']!=0){ $arr_totals['total']['6bdr']['rate']=($arr_totals['total']['6bdr']['occ']/$arr_totals['total']['6bdr']['rent'])*100; }
			  
			?>

			<tr style="background-color:orange;">
				<td>Total:</td>
				<td><?=$arr_totals['total']['bdrs']?></td>
				<td><?=$arr_totals['total']['nights_occupied']?></td>
				<td><?=$arr_totals['total']['bookings']?></td>
				<td><?=$arr_totals['total']['maint']?></td>
				<td><?=$arr_totals['total']['nights_rentable']?></td>
				<td><?=number_format($arr_totals['total']['occ_rate'],2)?>%</td>
				<td><?=$arr_totals['total']['long']?></td>
				<td><?=$arr_totals['total']['owner']?></td>
				<td>&nbsp;</td>
			</tr>
</table>
 <p>&nbsp;<p>

<table border="0" cellspacing="0" cellpadding="1" style="border:1px solid black; font-size:10px;">
	<tr>
		<td colspan="2" align="center"><span style="text-transform:uppercase;">Totals Overview</span></td>
	</tr>
	<tr style="background-color:#63fa8e;">
		<td>Average nights per clients</td>
		<td align="center"><?=number_format($arr_totals['total']['nights_occupied']/$arr_totals['total']['bookings'],2)?></td>
	</tr>
	<tr style="background-color:#63c3fa;">
		<td ># Nights on Maintenance</td>
		<td align="center"><?=$arr_totals['total']['maint']?></td>
	</tr>
	<tr style="background-color:#fa563b;">
		<td>Overall Occupancy Rate:</td>
		<td align="center"><?=number_format($arr_totals['total']['occ_rate'],2)?>%</td>
	</tr>
	<tr style="background-color:#f8bcb2;" >
		<td>2 Bdr Occupancy Rate:</td>
		<td align="center"><?=number_format($arr_totals['total']['2bdr']['rate'],2)?>%</td>
	</tr>
	<tr  style="background-color:#fa563b;">
		<td>3 Bdr Occupancy Rate:</td>
		<td align="center"><?=number_format($arr_totals['total']['3bdr']['rate'],2)?>%</td>
	</tr>
	<tr style="background-color:#f8bcb2;" >
		<td>4 Bdr Occupancy Rate:</td>
		<td align="center"><?=number_format($arr_totals['total']['4bdr']['rate'],2)?>%</td>
	</tr>
	<tr style="background-color:#fa563b;" >
		<td>5 Bdr Occupancy Rate:</td>
		<td align="center"><?=number_format($arr_totals['total']['5bdr']['rate'],2)?>%</td>
	</tr>
	<tr  style="background-color:#f8bcb2;">
		<td>6 Bdr Occupancy Rate:</td>
		<td align="center"><?=number_format($arr_totals['total']['6bdr']['rate'],2)?>%</td>
	</tr>
</table>

 <p>&nbsp;<p>

<table align="center" celspacing="2" cellpadding="2" border="0" width="100%"><tr><td>
<table border="1" cellspacing="0" cellpadding="1" style="border:1px solid black; font-size:10px;background-color:orange;">
	<tr>
		<td colspan="3" align="center"><span style="text-transform:uppercase;">Rental Report of <?=date('F', strtotime('2013-'.$this_month.'-01'));?> <?=$this_year?></span></td>

	</tr>
	<? $qty_villas=count($villas4rent)+count($array_not_rental_villas['villas'])-$villas_minus;?>
	<tr >
		<td># of villas</td>
		<td align="center"> <?=$qty_villas?></td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr >
		<td >Avilable bedrooms to rent</td>
		<td align="center"><?=$arr_totals['total']['bdrs']?></td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr >
		<td>Nights in the Month:</td>
		<td align="center"><?=$ultimo_dia?></td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr >
		<td>Sub-total # of rentable nights:</td>
		<td align="center"><? $nights_sub_rentable=($ultimo_dia*$qty_villas); echo $nights_sub_rentable;?></td>
		<td align="center">&nbsp;</td>
	</tr>
    <tr >
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>

	<tr >
		<td>Owner Occupied Nights:</td>
		<td align="center"><?=$arr_totals['total']['owner']?></td>
		<td align="center"><? $percent_rate_owner=($arr_totals['total']['owner']/$nights_sub_rentable*100);?> <?=number_format($percent_rate_owner,2)?>%</td>
	</tr>
	<tr  >
		<td># maintenance nights:</td>
		<td align="center"><?=$arr_totals['total']['maint']?></td>
		<td align="center"><? $percent_rate_maint=($arr_totals['total']['maint']/$nights_sub_rentable*100);?> <?=number_format($percent_rate_maint,2)?>%</td>
	</tr>
	<tr  >
		<td># rentable nights:</td>
		<td align="center"><? $rentable_nights_qty=$nights_sub_rentable-$arr_totals['total']['maint']; echo $rentable_nights_qty;?></td>
		<td align="center">&nbsp;</td>
	</tr>
    <tr >
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr >
		<td><b>Rentals</b></td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>


	<tr  >
		<td>Nights on long term rental:</td>
		<td align="center"><?=$arr_totals['total']['long']?></td>
		<td align="center"><? $percent_rate_long=($arr_totals['total']['long']/$rentable_nights_qty*100);?> <?=number_format($percent_rate_long,2)?>%</td>
	</tr>
	<tr  >
		<td>Nights on short term rental:</td>
		<td align="center"><? $short_term_qty=($arr_totals['total']['nights_occupied']-$arr_totals['total']['long']-$arr_totals['total']['owner']); echo $short_term_qty;?></td>
		<td align="center"><? $percent_rate_short=($short_term_qty/$rentable_nights_qty*100);?> <?=number_format($percent_rate_short,2)?>%</td>
	</tr>
    <tr >
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>

	<tr >
		<td>Occupancy rate:</td>
		<td align="center"><? $Total_short_n_long=$arr_totals['total']['long']+$short_term_qty+$arr_totals['total']['owner']; echo $Total_short_n_long; ?></td>
		<td align="center"><? $percent_rate_occupancy=($Total_short_n_long/$rentable_nights_qty*100);?> <?=number_format($percent_rate_occupancy,2)?>%</td>
	</tr>
</table>
</td><td>
<?
 /*===================A�O ANTERIOR=============================*/
    $ly=monthStatistic($month=$this_month, $year=($this_year-1));

    /*print_r($ly);*/

 /*===========================================================*/
?>
<table border="1" cellspacing="0" cellpadding="1" style="border:1px solid black; font-size:10px;">
	<tr>
		<td colspan="3" align="center"><span style="text-transform:uppercase;">Rental Report of <?=date('F', strtotime('2013-'.$this_month.'-01'));?> <?=$year?></span></td>

	</tr>
	<? $qty_villas=$ly['qty_villas'];?>
	<tr >
		<td># of villas</td>
		<td align="center"> <?=$qty_villas?></td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr >
		<td >Avilable bedrooms to rent</td>
		<td align="center"><?=$ly['qty_bdr']?></td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr >
		<td>Nights in the Month:</td>
		<td align="center"><?=$ly['nights_month']?></td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr >
		<td>Sub-total # of rentable nights:</td>
		<td align="center"><? $nights_sub_rentable=$ly['sub_nights']; echo $nights_sub_rentable;?></td>
		<td align="center">&nbsp;</td>
	</tr>
    <tr >
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>

	<tr >
		<td>Owner Occupied Nights:</td>
		<td align="center"><?=$ly['own_occ']?></td>
		<td align="center"><? $percent_rate_owner=($ly['own_occ']/$nights_sub_rentable*100);?> <?=number_format($percent_rate_owner,2)?>%</td>
	</tr>
	<tr  >
		<td># maintenance nights:</td>
		<td align="center"><?=$ly['maint_nights']?></td>
		<td align="center"><? $percent_rate_maint=($ly['maint_nights']/$nights_sub_rentable*100);?> <?=number_format($percent_rate_maint,2)?>%</td>
	</tr>
	<tr  >
		<td># rentable nights:</td>
		<td align="center"><? $rentable_nights_qty=$nights_sub_rentable-$ly['maint_nights']; echo $rentable_nights_qty;?></td>
		<td align="center">&nbsp;</td>
	</tr>
    <tr >
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr >
		<td><b>Rentals</b></td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>


	<tr  >
		<td>Nights on long term rental:</td>
		<td align="center"><?=$ly['long']?></td>
		<td align="center"><? $percent_rate_long=($ly['long']/$rentable_nights_qty*100);?> <?=number_format($percent_rate_long,2)?>%</td>
	</tr>
	<tr  >
		<td>Nights on short term rental:</td>
		<td align="center"><? $short_term_qty=($ly['short']); echo $short_term_qty;?></td>
		<td align="center"><? $percent_rate_short=($short_term_qty/$rentable_nights_qty*100);?> <?=number_format($percent_rate_short,2)?>%</td>
	</tr>
    <tr >
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>

	<tr >
		<td>Occupancy rate:</td>
		<td align="center"><? $Total_short_n_long=$ly['long']+$short_term_qty+$ly['own_occ']; echo $Total_short_n_long; ?></td>
		<td align="center"><? $percent_rate_occupancy=($Total_short_n_long/$rentable_nights_qty*100);?> <?=number_format($percent_rate_occupancy,2)?>%</td>
	</tr>
</table>
</td></tr></table>

