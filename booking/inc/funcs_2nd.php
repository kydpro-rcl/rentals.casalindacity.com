<?
		function arreglos_days($start_date, $end_date){
		    $brk1 = explode("-", $start_date);
		    $brk2 = explode("-", $end_date);

			if(strtotime($start_date)>=strtotime($end_date)){ /*die('Error: Staring date must be minor than the ending date');*/ } /*para no permitir que fecha final sea igual o menor que fecha inicial*/


		    $y1=$brk1[0];/*year 1*/
		    $y2=$brk2[0]; /*year 2*/
		    $m1=$brk1[1]; /*month 1*/
		    $m2=$brk2[1]; /*month 2*/
		    $d1=$brk1[2]; /*day 1*/
		    $d2=$brk2[2]; /*day 2*/

			$array_days=array();/*contiene cada dia desde la fecha inicial a la final*/
			if($y2>$y1){  /*si los a�os son diferentes*/
		      for($y=$y1; $y<=$y2; $y++){  /*years*/
		          if($y==$y1){$mes_inicial=$m1;}else{ $mes_inicial='01';} /*si es el primer a�o inicia el mes de fecha de inicio*/
		          if($y==$y2){$mes_final=$m2;}else{ $mes_final='12';} /*si es el ultimo a�o termina el mes de la fecha final*/


		        for($m=$mes_inicial; $m<=$mes_final; $m++){ /*months*/
		           $ultimo_dia_mes = ultimoDia($mes=$m,$ano=$y);/*get the last day in this month and year*/

				   if(($y==$y1)&&($m==$m1)){$dia_inical=$d1;}else{ $dia_inical='01';} /*First day of the current month and year*/

		           if(($y==$y2)&&($m==$m2)){ $dia_final=$d2;}else{ $dia_final=$ultimo_dia_mes;} /*Last day of the current month and year*/

		            for($d=$dia_inical; $d<=$dia_final; $d++){ /*days*/
		             array_push($array_days, array(date('Y-m-d',strtotime($y.'-'.$m.'-'.$d))));
		        	}
		        }

		      }

			}else{/*entonces se presume que es el mismo a�o*/
			   $y=$y1;  /*y1 and y2 are the same*/
		      for($m=$m1; $m<=$m2; $m++){ /*months*/
		           $ultimo_dia_mes = ultimoDia($mes=$m,$ano=$y);/*get the last day in this month and year NOTE: year1 is iqual to year2*/

				   if($m==$m1){$dia_inical=$d1;}else{ $dia_inical='01';} /*First day of the current month and year*/

		           if($m==$m2){ $dia_final=$d2;}else{ $dia_final=$ultimo_dia_mes;} /*Last day of the current month and year*/

		            for($d=$dia_inical; $d<=$dia_final; $d++){ /*days*/
		             array_push($array_days, array(date('Y-m-d',strtotime($y.'-'.$m.'-'.$d))));
		        	}
		        }
			}


		return $array_days;
		}

		function noches_del_mes_en_booking($array_days_month, $array_booking, $last_date_month){
			/*$start_date='2013-04-01';
			$end_date='2013-04-29'; */
			$start_date=$array_booking['start'];
			$end_date=$array_booking['end'];
	        $dias_arreglos_bookings=arreglos_days($start_date, $end_date);
	        foreach($dias_arreglos_bookings AS $k=>$v){
	           if (in_array($v, $array_days_month)) {
	            $array_info['nights_occupied']++;
	           }
	        }

	        if(strtotime($end_date)>strtotime($last_date_month)){

	          /*si la fecha final del booking es mayor que el ultimo dias del mes el arreglo de conteo de noches se queda igual*/
	        }else{
	          $array_info['nights_occupied']--;/*si la fecha final es menor o igual al ultimo dia del mes entonces se resta 1 porque el ultimo dia no es una noche valida*/
	        }
	         //case of status (3 numbers are one only status)
	        $s=$array_booking['status'];
	         if(($s==1)||($s==2)||($s==3)||($s==4)||($s==6)||($s==12)||($s==13)||($s==14)||($s==30)||($s==31)||($s==32)||($s==33)){/*short term*/
	           $estado='short';
	         }elseif(($s==8)||($s==9)||($s==10)||($s==11)||($s==15)||($s==16)||($s==17)||($s==18)||($s==26)||($s==27)||($s==28)||($s==29)){/*long term*/
	           $estado='long';
	         }elseif(($s==7)||($s==19)||($s==20)||($s==21)||($s==22)||($s==23)||($s==24)||($s==25)){/*owner term*/
	           $estado='owner';
	         }elseif($s==5){/*maintenance*/
	           $estado='maintenance';
	         }else{/*unknown*/
	           $estado='unknown';
	         }
			$array_info['status']=$estado;


		return $array_info;
		}

         function month_rate_villa($id_villa, $month, $year){         	require_once('class/getQueries.php');
         	$db= new getQueries ();
         	$last_day = ultimoDia($month,$year);/*get the last day in this month and year NOTE: year1 is iqual to year2*/         	$busy=$db->c_bookings($id_villa, $fecha_inicio=$year.'-'.$month.'-01', $fecha_fin=$year.'-'.$month.'-'.$last_day);

            $fecha_final_mes=$year.'-'.$month.'-'.$last_day;
            $fecha_inicial_mes=$year.'-'.$month.'-01';
    		$dias_arreglos_mes=arreglos_days($start_date=$fecha_inicial_mes, $end_date=$fecha_final_mes);

          	 if(count($busy)>0){  /*si hay booginks en esta villa*/
              $total_noches=0;  //total de noches ocupada en el mes
              $total_mant=0;  //total de noches en mantenimiento en el mes
              $noches_mes=$last_day; //cantidad de noches durante el mes

              foreach($busy AS $k){              	$resultado_booking=noches_del_mes_en_booking($array_days_month=$dias_arreglos_mes, $array_booking=$k,$last_date_month=$fecha_final_mes);
                 if($resultado_booking['status']=='maintenance'){
                   $total_mant+=$resultado_booking['nights_occupied'];
				 }else{                   $total_noches+=$resultado_booking['nights_occupied'];				 }              }

              $noches_rentable=($noches_mes-$total_mant);/*cantidad de noches rentables en el mes para esta villa*/
          	 }            if($noches_rentable!=0){
            	$rate_v=(($total_noches/$noches_rentable)*100);
            }else{            	$rate_v=0;            }
            $villa_rate=number_format($rate_v,2);


            return $villa_rate;         }

		 function Occupancy_Rate_villa($idvilla, $start_month_year, $end_month_year){
			$sd=explode( '-', $start_month_year );
			$ed=explode( '-', $end_month_year );

			$s_month=$sd[0]; $s_year=$sd[1]; $e_month=$ed[0]; $e_year=$ed[1];
             if($s_year==$e_year){                for($i=$s_month; $i<=$e_month; $i++){ /* running months in this year*/                 $mes=$i; $year=$s_year; $id_villa=$idvilla;
                 //buscar el rate de esta villa en estes mes y a�o
                }
             }elseif($s_year<$e_year){             	 for($y=$s_year; $y<=$e_year; $y++){                        switch($y){                           case $s_year:
                           		//statements;
                           		$first_month=$s_month; $last_month=12;
                           		break;
                           case $e_year:
                           		//statements;
                           		$first_month=01; $last_month=$e_month;
                           		break;
                           default:
                           		  //statements;
                           		$first_month=01; $last_month=12;
                        }

                       for($i=$first_month; $i<=$last_month; $i++){ /*running months for each year*/
	                   $mes=$i; $year=$y; $id_villa=$idvilla;
	                   //buscar el rate de esta villa en estes mes y a�o

	                   }
             	 }

             }else{             	die('Error: Starting year is bigger than ending year');
             }

			$v="villas";   $cond="able_r=1";  $order="no";
			$villas4rent=$link->showTable_restrinted($v,$cond,$order);




			$information['rates']='';
			$information['villa']='Villa #';
			$information['meses']='';

		 return $information;
		 }

		 ?>