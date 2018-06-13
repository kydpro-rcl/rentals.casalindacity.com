<?php
if ($_GET['id']!=''){
	header("Content-type: text/xml");
	require_once('../../booking/init.php');

	//$_GET['property_id']='22';
	 if ($_GET['property_id']){ }
	 $link= new getQueries();
	 //$bookings=$link->availability_flipkey($_GET['property_id']);
	 
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	echo '<!--Sample XML file generated by XMLSpy v2016 rel. 2 sp1 (http://www.altova.com)-->';
	echo '<unitAvailabilityContent>';
		echo '<listingExternalId>'.$_GET['id'].'</listingExternalId>';
		echo '<unitExternalId>'.$_GET['id'].'</unitExternalId>';
		echo '<unitAvailability>';
			echo '<availabilityDefault>Y</availabilityDefault>';
			echo '<availableUnitCountDefault>1</availableUnitCountDefault>';
			echo '<changeOverDefault>X</changeOverDefault>';
			echo '<dateRange>';
				echo '<beginDate>'.date("Y-m-d").'</beginDate>';
				echo '<endDate>'.date('Y-m-d', strtotime("+2 months", time())).'</endDate>';
			echo '</dateRange>';
			$fecha_de_inicio=date("Y-m-d");
			$fecha_de_termino=date('Y-m-d', strtotime("+2 months", time()));
			
			$dates_length=dates_between($s=$fecha_de_inicio, $e=$fecha_de_termino);
			
			$night_qty=daysDifference2($fecha_de_termino, $fecha_de_inicio);
			
			$busy=$link->see_occupancy_online_3($fecha_de_inicio, $fecha_de_termino, $_GET['id']);
			if($busy){
				foreach($busy AS $k){
					$dates_occupied=dates_between($s=$k['start'], $e=$k['end']);
					//$occupied[]=$dates_occupied;
					
					foreach($dates_occupied AS $a=>$b){
						$occupied[]=$b;
					}
				}
			}
			
			//$occupied[]='2019-10-20';
			$items_in_length=count($dates_length);
			
			$items_in_busy=count($occupied);
			
			//$availability=array();
			$av=''; $max_stay='';
			$minPriorNotifyDefault='14';
			$mpnd=''; $availableUnitCount=''; $changeOver='';
			$stayIncrementDefault='D'; $stayIncrement='';
			$minStayDefault='2'; $minStay='';
			
			if($occupied){
				
				for($i=0; $i < $items_in_length; $i++){
					if (in_array($dates_length[$i], $occupied)) {
						$av.='N'; $changeOver.='C';$stayIncrement.=$stayIncrementDefault;
						if($i < ($items_in_length-1)){
							$mpnd.=$minPriorNotifyDefault.',';
							$max_stay.=$night_qty.',';
							$availableUnitCount.='0,';
							$minStay.=$minStayDefault.',';
						}else{
							$max_stay.=$night_qty;
							$mpnd.=$minPriorNotifyDefault;
							$availableUnitCount.='0';
							$minStay.=$minStayDefault;
						}
						//echo $dates_length[$i];
						//echo "Got Irix"; echo "<br/>";
					}else{
						// $dates_length[$i];
						//echo "<br/>";
						$av.='Y';
						$changeOver.='C';
						$stayIncrement.=$stayIncrementDefault;
						
						if($i < ($items_in_length-1)){
							$mpnd.=$minPriorNotifyDefault.',';
							$max_stay.=$night_qty.',';
							$availableUnitCount.='1,';
							$minStay.=$minStayDefault.',';
						}else{
							$max_stay.=$night_qty;
							$mpnd.=$minPriorNotifyDefault;
							$availableUnitCount.='1';
							$minStay.=$minStayDefault;
						}
					}
				}
				
				/*for($i=0; $i < $items_in_busy; $i++){
					if (in_array($occupied[$i], $dates_length)) {
						echo $occupied[$i];
						echo "Got Irix"; echo "<br/>";
					}
				}*/
				
				/*if (in_array($occupied, $dates_length)) {
						echo "Got Irix"; echo "<br/>";
				}*/
			}else{
				for($i=0; $i < $items_in_length; $i++){
					$av.='Y'; $changeOver.='C';$stayIncrement.=$stayIncrementDefault;
					
					if($i < ($items_in_length-1)){
						$mpnd.=$minPriorNotifyDefault.',';
						$max_stay.=$night_qty.',';
						$availableUnitCount.='1,';
						$minStay.=$minStayDefault.',';
					}else{
						$max_stay.=$night_qty;
						$mpnd.=$minPriorNotifyDefault;
						$availableUnitCount.='1';
						$minStay.=$minStayDefault;
					}
				}
			}
			//$lastday = date('t',strtotime('2018-02-01'));
			//echo $av;
			//echo $lastday;
			/*echo "<pre>";
			print_r($occupied);
			echo "</pre>";
			echo "<pre>";
			print_r($dates_length);
			echo "</pre>";*/
			echo '<maxStayDefault>'.$night_qty.'</maxStayDefault>';
			echo '<minPriorNotifyDefault>'.$minPriorNotifyDefault.'</minPriorNotifyDefault>';
			echo '<minStayDefault>'.$minStayDefault.'</minStayDefault>';
			echo '<stayIncrementDefault>'.$stayIncrementDefault.'</stayIncrementDefault>';
			echo '<unitAvailabilityConfiguration>';
				echo '<availability>'.$av.'</availability>';
				echo '<availableUnitCount>'.$availableUnitCount.'</availableUnitCount>';
				echo '<changeOver>'.$changeOver.'</changeOver>';
				echo '<maxStay>'.$max_stay.'</maxStay>';
				echo '<minPriorNotify>'.$mpnd.'</minPriorNotify>';
				echo '<minStay>'.$minStay.'</minStay>';
				echo '<stayIncrement>'.$stayIncrement.'</stayIncrement>';
			echo '</unitAvailabilityConfiguration>';
		echo '</unitAvailability>';
	echo '</unitAvailabilityContent>';
}