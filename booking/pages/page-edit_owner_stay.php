<?php
 if ($_SESSION['info']){

  if ((validate_date($_POST['from']))&&(validate_date($_POST['to']))){

	 $starting_date=$_POST['from']; $ending_date=$_POST['to']; $id_villa=$_POST['villa']; $ref=$_POST['ref'];
	 $qty_nights=dayPeriod($ending_date, $starting_date);  $reasons=$_POST['reasons'];  $id_customer=$_POST['customer'];
	 $status=$_POST['status'];
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
			$id_reserve_mod=$db->in_res_mod($ref, $id_ocupacion_mod, $b['client'], $b['adults'], $b['kids'], $b['interm'], $b['nights'], $b['NHS'],$b['NLS'], $b['ppn'],$b['PHS'], $b['apc'], $b['subtotal'], $b['itbis'], $b['aps'], $b['dep'], $b['total'], $b['status'],$b['rc']);

         //UPDATE NEW ONE
		$db->update_busy($b['busyid'], $f_date, $t_date, $id_villa, $_SESSION['info']['id'], $id_ocupacion_mod, $b['date']);
	    $db->update_reserva($b['reserveid'], $ref, $b['busyid'], $id_customer, $adults_qty=0, $children_qty=0, $interm_id=0, $qty_nights,  $HS_nights, $LS_nights, $price_per_night=0, $priceHS=0, $amount_commision=0, $sub_total_rent=0, $ITBIS=0, $services_amount=0, $deposit=0, $general_amount=0, $status, $reasons);
       //echo $b['rc'];
		?>
           <p class="header">Editing owner staying</p><hr />
	 <div class="book_inserted1">
	 	<p class="bloques">Villa No.:<span class="info_details"> <?=$v_now[0]['no']?></span></p>
	 	<p class="bloques">From:<span class="info_details"> <?=formatear_fecha($starting_date);?></span></p>
	 	<p class="bloques">To:<span class="info_details"> <?=formatear_fecha($ending_date);?></span></p>
	 </div><!--END SHOWING DATES AND VILLA-->

     <div class="book_inserted2">
      	<p class="bloques2">Staying reference:<span class="info_details2"> <?=$ref?></span></p>
     </div><!--END SHOWING REF NUMBER-->

     <div class="book_inserted4">
     	<h2>Owner staying successfuly Edited</h2>
     	<a href="booking-calendar.php"><img class="calendar_img" src="images/calendar_booked.png" width="127px" height="49px" alt="calendar" title="go to calendar" /></a>
        <a href="booking-calendar.php"><p class="link_calendar">Go to Calendar</p></a>
     </div>

		<?

  }else{   echo "<h2>Error in dates</h2>";
  }

 }else{
	 header('Location:login.php');
	 die();
 }
 ?>
