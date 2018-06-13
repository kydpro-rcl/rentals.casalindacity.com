<?php
 if ($_SESSION['info']){

  if ((validate_date($_POST['from']))&&(validate_date($_POST['to']))){

	 $starting_date=$_POST['from']; $ending_date=$_POST['to']; $id_villa=$_POST['villa']; $ref=$_POST['ref'];
	 //si hay errores de periodos ocupados mostrar un error y no modificar nada

				//VERIFY PERIOD############################################################################
						//$villa_id=$casa['id']; //$reserveid=$info_book['reserveid'];
						$db= new getQueries();
						$book=$db->see_occupancy_ref($ref); //get reservation details
						$reserveid=$book[0]['reserveid'];
						/*$villa_id=$id_villa;
						$fecha_rota=explode('-',$starting_date);
						$fecha_rota2=explode('-',$ending_date);
						  $mes=$fecha_rota[1]; $year=$fecha_rota[0];
			              $busy=$db->busy_availability_noID($villa_id, $mes, $year, $reserveid);//debe seleccionarse una reserva sin escoger esta para comparar
			              $counting=0;

		               //VARIABLES
		               $AI=$fecha_rota[0];
		               $MI=$fecha_rota[1];
		               $DI=$fecha_rota[2];
		               $AF=$fecha_rota2[0];
		               $MF=$fecha_rota2[1];
		               $DF=$fecha_rota2[2];

			        foreach ($busy as $occ){

				               $alojamiento=strtotime($year."-".$mes."-".($fecha_rota[2]+$i));
				               $f_a=date('Y-m-d',$alojamiento);
				              for ($z=$AI; $z<=$AF; $z++){ //años
				              	if ($z==$AI){$mes_inicial=$MI;}else{$mes_inicial=1;}
				              	if ($z==$AF){$mes_final=$MF;}else{$mes_final=12;}

				                for ($m=$mes_inicial; $m<=$mes_final; $m++){ //meses

				                	if (($z==$AI)&&($m==$MI)){ $dia_inicial=$DI; }else{$dia_inicial=1; }
				                	if (($z==$AF)&&($m==$MF)){ $dia_final=$DF; }else{ $dia_final=ultimoDia($m,$z); }

				                   for ($x=$dia_inicial; $x<=$dia_final; $x++){  //dias
				                        $contador=$x;
					      				if (($z==$AF)&&($m==$MF)&&($x==$DF)){$contador--;}//para que se pueda tomar el mismo dia que empieza otra
					      				$estadia=strtotime($z."-".$m."-".$contador);
				               			$f_a=date('Y-m-d',$estadia);

									   if ((strtotime($f_a))==(strtotime($occ['start']))){

										   echo "<h2>Error: Busy period selected</h2>";
										   die();
									   }

									}//fin dias
								 }//fin meses
							   }//fin de los años

					} *///fin ocupaciones

		$edit_busy=check_villa_edit($id_villa, $start_date=$starting_date, $end_date=$ending_date, $id_this_reserve=$reserveid);
		/* echo "villa id:".$id_villa; echo "<br/>";
	  echo "inicio:".$starting_date; echo "<br/>";
	   echo "fin:".$ending_date;  echo "<br/>";
	    echo "id reserva:".$reserveid; echo "<br/>"; */
		$cant_edit=count($edit_busy);
		if(!$cant_edit>0){
						//VERIFY ####################################################################################
		 $qty_nights=dayPeriod($ending_date, $starting_date);  $reasons=$_POST['reasons'];  $id_customer="0";
		 //VARIABLES END
		 $db= new subDB (); //CONNECT TO DATABASE
			$f_date=date_to_insert($starting_date);
			$t_date=date_to_insert($ending_date);

	            $link=new getQueries ();

	            $booked= $link->see_occupancy_ref($ref);    //get old info for this book
	            $b=$booked[0];

				$v_now=$link->villa($id_villa);   //actual villa number

				$seasons=$link->seasons();
		      	$start_HS=$seasons[0]['h_starting']; $end_HS=$seasons[0]['h_ending'];
		      	$start_LS=$seasons[0]['l_starting']; $end_LS=$seasons[0]['l_ending'];
			 //<!--START NIGHTS FOR THIS RENT-->


	            if ((strtotime($f_date))<(strtotime($start_HS))&&(strtotime($t_date))<(strtotime($start_HS))||(strtotime($f_date))>(strtotime($start_HS))&&(strtotime($f_date))>(strtotime($end_HS))){

	            	$HS_nights=0; $LS_nights=$qty_nights;

	            }elseif ((strtotime($f_date))>=(strtotime($start_HS))&&(strtotime($t_date))<=(strtotime($end_HS))){

	            	$HS_nights=$qty_nights; $LS_nights=0;

	            }elseif ((strtotime($f_date))>=(strtotime($start_HS))&&(strtotime($t_date))>(strtotime($end_HS))&&(strtotime($f_date))<=(strtotime($end_HS))){
					$HS_nights=dayPeriod($end_HS, $f_date); $LS_nights=dayPeriod($t_date, $end_HS);

	            }elseif ((strtotime($f_date))<(strtotime($start_HS))&&(strtotime($t_date))>(strtotime($start_HS))&&(strtotime($t_date))<=(strtotime($end_HS))){
	          		$LS_nights=dayPeriod($start_HS, $f_date); $HS_nights=dayPeriod($t_date, $start_HS);

	            }elseif ((strtotime($f_date))<(strtotime($start_HS))&&(strtotime($t_date))>(strtotime($end_HS))){

					$HS_nights=dayPeriod($end_HS, $start_HS); $LS_nights=($qty_nights-$HS_nights);
	            }


	             //INSERT OLD ONE
				$id_ocupacion_mod=$db->in_ocupacion_mod($b['start'], $b['end'], /*$b['type']*/1, $b['villa'], $_SESSION['info']['id'], $b['note']); //insert ocupation and returm id of insertion
				@$id_reserve_mod=$db->in_res_mod($ref, $id_ocupacion_mod, $b['client'], $b['adults'], $b['kids'], $b['interm'], $b['nights'], $b['NHS'],$b['NLS'], $b['ppn'],$b['PHS'], $b['apc'], $b['subtotal'], $b['itbis'], $b['aps'], $b['dep'], $b['total'], $b['status'],$b['rc']);

	         //UPDATE NEW ONE
			$db->update_busy($b['busyid'], $f_date, $t_date, $id_villa, $_SESSION['info']['id'], $id_ocupacion_mod, $b['date']);
		    $db->update_reserva($b['reserveid'], $ref, $b['busyid'], $id_customer, $adults_qty=0, $children_qty=0,$vehiculos=0, $interm_id=0, $qty_nights,  $HS_nights, $LS_nights, $price_per_night=0, $priceHS=0, $amount_commision=0, $sub_total_rent=0, $ITBIS=0, $services_amount=0, $deposit=0, $general_amount=0, $status=5);
	       //echo $b['rc'];

	       //==============INSERT COMENT AS NORMAL NOTE WITH THIS BOOKING=========================================
					  if(trim($_POST['reasons'])!=''){ /*solo inserta el comentario si la caja no esta vacia*/
					  	/*require_once('init.php');
					 	 $link=new getQueries (); //connect and make a query - Ej. get info from a ref number

					 	$busy=$link->see_occupancy_id($_GET['id']);
						$ocupabilidad=$busy[0];
	                    */
					    $db= new DB();
					    $fecha=date("Y-m-d G:i:s");
					    switch($_POST['tipo']){
					    	case 2: //manager note
					    	     $tipo=2;  break;
					    	case 3: //complaint note
					    	     $tipo=3;
					    	     $complaint_no=$_POST['complaint'];
					    	     $villa_id=$_POST['villa'];
					    	     break;
					    	default: //imagine that it is a normal note with tipo value=1
					    		$tipo=1;
					   	}
						$insert_comment=$db->insert_comments($ref,$_POST['reasons'],$tipo,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no, $id_villa, $id_reserv_mod='');
					  }//finaliza si de insertar comentario

			//==============INSERT A COMMENT AS A BOOKING CHANGE IN A EDITION OF A BOOKING=========================
	   				  $fecha=date("Y-m-d G:i:s");
	                  $insert_comment=$db->insert_comments($ref,'',$tipo='4'/*mean booking changed*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='', $id_villa, $id_ocupacion_mod);
			//=====================================================================================================
			?>
	           <p class="header">Editing maintenance</p><hr />
		 <div class="book_inserted1">
		 	<p class="bloques">Villa No.:<span class="info_details"> <?=$v_now[0]['no']?></span></p>
		 	<p class="bloques">From:<span class="info_details"> <?=formatear_fecha($starting_date);?></span></p>
		 	<p class="bloques">To:<span class="info_details"> <?=formatear_fecha($ending_date);?></span></p>
		 </div><!--END SHOWING DATES AND VILLA-->

	     <div class="book_inserted2">
	      	<p class="bloques2">Maintenance reference:<span class="info_details2"> <?=$ref?></span></p>
	     </div><!--END SHOWING REF NUMBER-->

	     <div class="book_inserted4">
	     	<h2>Maintenance successfuly Edited</h2>
	     	<a href="booking-calendar.php"><img class="calendar_img" src="images/calendar_booked.png" width="127px" height="49px" alt="calendar" title="go to calendar" /></a>
	        <a href="booking-calendar.php"><p class="link_calendar">Go to Calendar</p></a>
	     </div>

		<?
        }else{
            change_booking_busy_error($starting_date, $ending_date);
        }
  }else{   echo "<h2>Error in dates</h2>";
  }

 }else{
	 header('Location:login.php');
	 die();
 }
 ?>
