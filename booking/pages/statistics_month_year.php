<?php

function monthStatistic($month, $year){
  	$link= new getQueries ();
	$v="villas";   $cond="able_r=1";  $order="no";
	$villas4rent=$link->showTable_restrinted($v,$cond,$order); /*get villas for rent*/
   /*
	if(($_GET['m']!='')&&($_GET['y']!='')){
     $_POST['m']=$_GET['m'];
     $_POST['y']=$_GET['y'];
	}

	if(($_POST['m']!='')&&($_POST['y']!='')){
     $this_month=$_POST['m']; $this_year=$_POST['y'];
	}else{
	 $this_month=date('m'); $this_year=date('Y');
	}  */
	$this_month=$month; $this_year=$year;

	$ultimo_dia = ultimoDia($mes=$this_month,$ano=$this_year);

    $v="villas";   $cond="able_r=0";  $order="no";
	$villasNOrent=$link->showTable_restrinted($v,$cond,$order);/* get villas not for rent*/
    $x=0;
    $arr_totals=array();

      $fecha_final_mes=$this_year.'-'.$this_month.'-'.$ultimo_dia;
      $fecha_inicial_mes=$this_year.'-'.$this_month.'-01';
     /* $dias_arreglos_mes=arreglos_days($start_date='2013-04-01', $end_date='2013-04-30');  */
     $dias_arreglos_mes=arreglos_days($start_date=$fecha_inicial_mes, $end_date=$fecha_final_mes);
     /*============================================VILLAS FOR RENT WITH BOOKINGS========================================*/
     $array_villas['villas']=array(); /*No rental villas*/

    		foreach($villas4rent AS $vn){
              $busy=$link->c_bookings($villa_id=$vn['id'], $fecha_inicio=$fecha_inicial_mes, $fecha_fin=$fecha_final_mes);
              if(count($busy)>0){  /*si hay booginks en esta villa*/
               $array_villas[$vn['id']]=array(); /*bookings for this no rental villas*/
               $can_bc=count($busy);
               if($can_bc==1){
                   if($busy[0]['status']!=5){/* if the booking found is not a mantenances PUT IT ON THE ARRAY*/
                       array_push($array_villas['villas'], $vn);
                       array_push($array_villas[$vn['id']], $busy);
                   }
               }else{
               	/*poner informacion del booking y la villa aqui*/
				 array_push($array_villas[$vn['id']], $busy);
				 array_push($array_villas['villas'], $vn);
               }
              }

			} /*end villas not for rent*/
    	/*=================================================================================================================*/
          /* 	$array_not_rental_villas['villas']=array(); *//*no rental villas*/

    		foreach($villasNOrent AS $vn){
              $busy0=$link->c_bookings($villa_id=$vn['id'], $fecha_inicio=$fecha_inicial_mes, $fecha_fin=$fecha_final_mes);
              if(count($busy0)>0){  /*si hay booginks en esta villa*/
               $array_villas[$vn['id']]=array(); /*bookings for this no rental villas*/
               $can_bc=count($busy0);
               if($can_bc==1){
                   if($busy0[0]['status']!=5){/* if the booking found is not a mantenances*/
                       array_push($array_villas['villas'], $vn);
                       /*array_push($array_villas[$vn['id']], $busy0);*/
                   }
               }else{
				 /*array_push($array_villas[$vn['id']], $busy0);*/
				 array_push($array_villas['villas'], $vn);
                }
     		  }

			} /*end villas not for rent*/
           /*
			foreach($array_not_rental_villas['villas'] AS $V){//only villas for rent here
				$v_long=0;//long nights for this villa
             	$v_short=0;
             	$v_owner=0;
             	$v_mant=0;
                $n_occupied=0;//total nights occupied for this villa
                $v_bookings=0;
				 $busy=$link->c_bookings($villa_id=$V['id'], $fecha_inicio=$fecha_inicial_mes, $fecha_fin=$fecha_final_mes);
				if(count($busy)>0){//hacer esto solo se encuentran bookings para esta villa en el mes indicado
				 foreach($busy AS $k){
                      $v_bookings++;//cuenta los bookings de una villa
				     $resultado_booking=noches_del_mes_en_booking($array_days_month=$dias_arreglos_mes, $array_booking=$k,$last_date_month=$fecha_final_mes);
				    // echo '-'.$resultado_booking['nights_occupied']; echo $resultado_booking['status']."<br/>";
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
                 $arr_totals['total']['long']+=$v_short;
                 $arr_totals['total']['owner']+=$v_owner;
                }
                $noches_rentable=$ultimo_dia-$v_mant;
                $arr_totals['total']['bdrs']+=$V['bed'];
                $arr_totals['total']['nights_rentable']+=$noches_rentable;

				switch($V['bed']){
					case 2: //2 bedrooms
					     $arr_totals['total']['2bdr']['qty']+=$V['bed'];
					     $arr_totals['total']['2bdr']['occ']+=$n_occupied;
					     $arr_totals['total']['2bdr']['rent']+=$noches_rentable;
                         break;
					case 3: //3 bedrooms
						$arr_totals['total']['3bdr']['qty']+=$V['bed'];
					     $arr_totals['total']['3bdr']['occ']+=$n_occupied;
					     $arr_totals['total']['3bdr']['rent']+=$noches_rentable;
					     break;
					case 4: //4 bedrooms
						$arr_totals['total']['4bdr']['qty']+=$V['bed'];
					     $arr_totals['total']['4bdr']['occ']+=$n_occupied;
					     $arr_totals['total']['4bdr']['rent']+=$noches_rentable;
					     break;
					case 6: //6 bedrooms
						$arr_totals['total']['6bdr']['qty']+=$V['bed'];
					     $arr_totals['total']['6bdr']['occ']+=$n_occupied;
					     $arr_totals['total']['6bdr']['rent']+=$noches_rentable;
					     break;
				}

			}
               */
              /* print_r($array_villas['villas']); */

			if($array_villas['villas']){ //Villa not rentable here
              foreach($array_villas['villas'] AS $vn){

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
				   $arr_totals['total']['short']+=$v_short;
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
					case 6: //6 bedrooms
						$arr_totals['total']['6bdr']['qty']+=$vn['bed'];
					     $arr_totals['total']['6bdr']['occ']+=$n_occupied;
					     $arr_totals['total']['6bdr']['rent']+=$noches_rentable;
					     break;
				}
			  }
			}
              if($arr_totals['total']['nights_rentable']!=0){
				$arr_totals['total']['occ_rate']=($arr_totals['total']['nights_occupied']/$arr_totals['total']['nights_rentable'])*100;
			  }
				if($arr_totals['total']['2bdr']['rent']!=0){
				$arr_totals['total']['2bdr']['rate']=($arr_totals['total']['2bdr']['occ']/$arr_totals['total']['2bdr']['rent'])*100;
				}

			if($arr_totals['total']['3bdr']['rent']!=0){
                $arr_totals['total']['3bdr']['rate']=($arr_totals['total']['3bdr']['occ']/$arr_totals['total']['3bdr']['rent'])*100;
			}

			 if($arr_totals['total']['4bdr']['rent']!=0){
                $arr_totals['total']['4bdr']['rate']=($arr_totals['total']['4bdr']['occ']/$arr_totals['total']['4bdr']['rent'])*100;
    		 }

             if($arr_totals['total']['6bdr']['rent']!=0){
                $arr_totals['total']['6bdr']['rate']=($arr_totals['total']['6bdr']['occ']/$arr_totals['total']['6bdr']['rent'])*100;
             }

/*


 <p>&nbsp;<p>

<table align="center" celspacing="2" cellpadding="2" border="0" width="100%"><tr><td>
<table border="1" cellspacing="0" cellpadding="1" style="border:1px solid black; font-size:10px;background-color:orange;">
	<tr>
		<td colspan="3" align="center"><span style="text-transform:uppercase;">Rental Report of <?=date('F', strtotime('2013-'.$this_month.'-01'));?> <?=$this_year?></span></td>

	</tr>
	<? $qty_villas=count($villas4rent)+count($array_not_rental_villas['villas']);?>
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
		<td align="center"><? $percent_rate_long=($arr_totals['total']['long']/$nights_sub_rentable*100);?> <?=number_format($percent_rate_long,2)?>%</td>
	</tr>
	<tr  >
		<td>Nights on short term rental:</td>
		<td align="center"><? $short_term_qty=($arr_totals['total']['nights_occupied']-$arr_totals['total']['long']-$arr_totals['total']['owner']); echo $short_term_qty;?></td>
		<td align="center"><? $percent_rate_short=($short_term_qty/$nights_sub_rentable*100);?> <?=number_format($percent_rate_short,2)?>%</td>
	</tr>
    <tr >
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>

	<tr >
		<td>Occupancy rate:</td>
		<td align="center"><? $Total_short_n_long=$arr_totals['total']['long']+$short_term_qty; echo $Total_short_n_long; ?></td>
		<td align="center"><? $percent_rate_occupancy=($Total_short_n_long/$nights_sub_rentable*100);?> <?=number_format($percent_rate_occupancy,2)?>%</td>
	</tr>
</table>
*/



//# of villas
$month_info['qty_villas']=count($array_villas['villas']);
//Avilable bedrooms to rent
$month_info['qty_bdr']=$arr_totals['total']['bdrs'];
//Nights in the Month:
$month_info['nights_month']=$ultimo_dia;
//Sub-total # of rentable nights  (noches in month por qty_villas)
$month_info['sub_nights']=($month_info['qty_villas']*$month_info['nights_month']);
//Owner Occupied Nights: (74-5.82%)
$month_info['own_occ']=$arr_totals['total']['owner'];
//# maintenance nights:  (25-1.97%)
$month_info['maint_nights']=$arr_totals['total']['maint'];
//# rentable nights:
$month_info['rentable_nights']=$month_info['sub_nights']-$month_info['maint_nights'];
//Nights on long term rental: (465-36.59%)
$month_info['long']=$arr_totals['total']['long'];
//Nights on short term rental:  (236-18.57%)
//$month_info['short']=($arr_totals['total']['nights_occupied']-($month_info['long']-$month_info['own_occ']-$month_info['maint_nights']));
$month_info['short']=$arr_totals['total']['short'];
//Occupancy rate:     (701-55.15%)

  return $month_info;
}?>

