<?php
 if ($_SESSION['info']){

	 $starting_date=$_POST['starting']; $ending_date=$_POST['ending']; $id_villa=$_POST['villa_id'];
	 $qty_nights=$_POST['nights'];  $reasons=$_POST['reasons']; $villa_no=$_POST['villa_no'];  $id_customer=$_POST['owner'];
	 $status=$_POST['status'];
	 //VARIABLES END
	 $db= new subDB (); //CONNECT TO DATABASE
		$f_date=date_to_insert($starting_date);
		$t_date=date_to_insert($ending_date);

            $link=new getQueries ();
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

//	<!--END NIGHTS FOR THIS RENT-->

		$id_ocupacion=$db->insert_ocupacion_short_reserve($f_date, $t_date, $id_villa, $_SESSION['info']['id']); //insert ocupation and returm id of insertion
	    $ref=str_pad($id_ocupacion, 9, "0", STR_PAD_LEFT);

     	$id_reserve=$db->insert_short_reserva($ref, $id_ocupacion, $id_customer, $adults_qty=0, $children_qty=0, $interm_id=0, $qty_nights,  $HS_nights, $LS_nights, $price_per_night=0, $priceHS=0, $amount_commision=0, $sub_total_rent=0, $ITBIS=0, $services_amount=0, $deposit=0, $general_amount=0, $status, $reasons);
		//echo $_POST['reasons'];
		?>
           <p class="header">Owner in house created</p><hr />
	 <div class="book_inserted1">
	 	<p class="bloques">Villa No.:<span class="info_details"> <?=$villa_no?></span></p>
	 	<p class="bloques">From:<span class="info_details"> <?=formatear_fecha($starting_date);?></span></p>
	 	<p class="bloques">To:<span class="info_details"> <?=formatear_fecha($ending_date);?></span></p>
	 </div><!--END SHOWING DATES AND VILLA-->

     <div class="book_inserted2">
      	<p class="bloques2">Reference Number:<span class="info_details2"> <?=$ref?></span></p>
     </div><!--END SHOWING REF NUMBER-->

     <div class="book_inserted4">
     	<h2>Owner in house successfuly created</h2>
     	<a href="booking-calendar.php"><img class="calendar_img" src="images/calendar_booked.png" width="127px" height="49px" alt="calendar" title="go to calendar" /></a>
        <a href="booking-calendar.php"><p class="link_calendar">Go to Calendar</p></a>
     </div>

		<?
 }else{
	 header('Location:login.php');
	 die();
 }
 ?>