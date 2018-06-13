<?
 if ($_SESSION['info']){
   if (!$_SESSION['NO_REFRESH']) die('Impossible send info again');
	//VARIABLES START
   //----------------------------------------------------------------------
     $new_busy=check_villa_new($_POST['id_villa'], $_POST['starting_date'], $_POST['ending_date']);
	 $cant_new=count($new_busy);
	 if(!$cant_new>0){
     //-----------------------------------------------------------------------
	   if ($_POST){
	     $id_villa=$_POST['id_villa'];  $id_customer=$_POST['id_customer'];   $id_adm=$_POST['id_adm'];
	     $starting_date=$_POST['starting_date']; $ending_date=$_POST['ending_date']; $qty_nights=$_POST['qty_nights'];
	     $price_per_night=$_POST['price_per_night'];$amount_per_nights=$_POST['amount_per_nights'];$ITBIS=$_POST['ITBIS'];
	     $sub_total_rent=$_POST['sub_total_rent'];  $general_amount=$_POST['general_amount'];  // $id_ocupacion=$_POST['id_ocupacion'];
	     /*$id_reserve=$_POST['id_reserve']; */$massage_id=$_POST['massage_id']; $massage_amount=$_POST['massage_amount'];
	     $massage_comment=$_POST['massage_comment']; $pickup_id=$_POST['pickup_id']; $pickup_amount=$_POST['pickup_amount'];
	     $pickup_comment=$_POST['pickup_comment'] ; $VIPpickup_id=$_POST['VIPpickup_id'];$VIPpickup_amount=$_POST['VIPpickup_amount'];
	     $VIPpickup_comment=$_POST['VIPpickup_comment'];$chef_id=$_POST['chef_id'];$chef_amount=$_POST['chef_amount'];
	     $chef_comment=$_POST['chef_comment'];$fridge_id=$_POST['fridge_id'];$fridge_amount=$_POST['fridge_amount'];
	     $fridge_comment=$_POST['fridge_comment']; $services_amount=$_POST['services_amount']; $interm_id=$_POST['interm_id'];
	     $reserve_comment=$_POST['reserve_comment'];$status=$_POST['status'];$children_qty=$_POST['children_qty'];
	     $adults_qty=$_POST['adults_qty'];$deposit=$_POST['deposit'];

		 //---------------------------------------------------------------------------------------------
			$priceHS=$_POST['priceHS']; $LS_nights=$_POST['LS_nights']; $HS_nights=$_POST['HS_nights'];
		 //---------------------------------------------------------------------------------------------
	      //VARIABLES END
		$db= new subDB (); //CONNECT TO DATABASE

		$starting=date_to_insert($starting_date);
		$ending=date_to_insert($ending_date);
		$id_ocupacion=$db->insert_ocupacion_short_reserve($starting, $ending, $id_villa, $id_adm); //insert ocupation and returm id of insertion
	    $ref=str_pad($id_ocupacion, 9, "0", STR_PAD_LEFT);
		#$ref=$id_ocupacion.$id_customer.$id_villa; //id ocupacion + id cliente + id villa  to make the reservation reference number
		 // factura no.02201015031401  hora_ano_minutos_mes_segundos_dias   2010 03 01 02:15:14 YYYY MM DD HH:MM:SS
		if($_SESSION['apolo']==3){
			unset($_SESSION['apolo']);/*quitar apolo para que no aparezca en otro booking si no es apollo el siguiente*/
			$source=3;
		}else{	
			$source=0;
		}	
		$id_reserve=$db->insert_short_reserva($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $source);  //INSERT RESERVE AND TAKE IT ID
			
		//================================TRY AND BUY TABLE START========================================================
		if($_POST['tbt']){
			if($_POST['tbt']==1){
				$tbppn=$_POST['tbp'];
				$tbtax=($tbppn*$qty_nights)*0.18;
				$tbtotal=($tbppn*$qty_nights)+$tbtax;
			}else{
				$tbtotal=$_POST['tbp'];
				$tbtotal_sin_tax=$tbtotal/1.18;
				$tbtax=$tbtotal_sin_tax*0.18;
				$tbppn=$tbtotal_sin_tax/$qty_nights;
			}
			//$tbtax=$tbppn*0.18;
			$inf5=array('tbtype'=>$_POST['tbt'],
						'ref'=>$ref,
						'ppn'=>$tbppn,
						'qtynights'=>$qty_nights,
						'tax'=>$tbtax,
						'total'=>$tbtotal);
			$inf_desc=$db->insert_gral($inf5, $table='trynbuy');
		}
		//=============================TRY AND BUY TABLE FINISH=========================================================
		 $data=new getQueries ();
		 $villa_reserva=$data->villa($id_villa);
		 $villainfo=$villa_reserva[0];
		 if($price_per_night>0){
			  if($price_per_night!=$villainfo['p_low']){$prices_changd1="True";}//LS price changed
		 }
		 if($priceHS>0){
			 if($priceHS!=$villainfo['p_high']){$prices_changd2="True";}//HS price changed
		 }
		 
		 if($_SESSION['info']['reception']==1){
			 $sentm=1;
		 }else{
			 $sentm=0;
		 }
		 
		 /*if(($prices_changd1=="True")||($prices_changd2=="True")){
			 
		   $inf5=array('ref'=>$ref,
					    'pricevilla'=>$villainfo['p_low'],
					    'pricevilla2'=>$villainfo['p_high'],
					    'pricediscounted'=>$price_per_night,
					    'pricediscounted2'=>$priceHS,
					    'userid'=>$_SESSION['info']['id'],
					    'date'=>time(),
					    'sentmail'=>$sentm,
					    'tipo'=>'1');
		   $inf_desc=$db->insert_gral($inf5, $table='villa_discount');
		   if($sentm==1){
			   //enviar correo electronico a Christian en este caso SI EL PRECIO FUE CAMBIADO MAS CARO O MAS BARATO NO IMPORTA
			   $mailbody=infoPriceChanged($username=$_SESSION['info']['name']." ".$_SESSION['info']['lastname'], $ref, $villano=$villainfo['no']);
			   sendMail($mailbody, $address='rentalmanager@casalindacity.com', $subject="Price changed to booking no. $ref", $from_add='noreply@casalindcity.com', $from_name='Reservation System');
			   
		   }
		 }*/
		//===============================================================END SAVING PRICE CHANGED===========================================
	   }else{
		   echo ("<meta http-equiv=\"refresh\" content=\"0;url=booking-calendar.php\">"); //send people to calendar
		   die();
	   }

	   //-----------------------REFERAL FOR THIS BOOKING-------------------------------------------------------------------------------------
		   if ($_POST['id_referal']>0){
		    $link= new getQueries();
		    $referido_anterior=$link->show_any_data_limit1('bookingreferred', 'ref_book', $ref, '=');

			  if ($referido_anterior){
			  	#echo "actualizar";
			  	$id_update=$db->insert_assign_modified($referido_anterior[0]['ref_book'], $referido_anterior[0]['id_referal'], $referido_anterior[0]['id_adm'], $referido_anterior[0]['fecha']);
			  	//echo $referido_anterior[0]['id_referal'];
			    $actualizado=$db->update_assign($referido_anterior[0]['id'], $ref, $_POST['id_referal'], $id_adm, $id_update);

			  	//echo "<p>&nbsp;</p><p style='color:red; font-size:16px; text-align:center;'>Booking successfully reassigned</p>";

			  }else{

				$result=$db->Assign_a_booking($ref, $_POST['id_referal'], $id_adm);
				 if ($result){
				// echo "<p>&nbsp;</p><p style='color:blue; font-size:16px; text-align:center;'>Booking successfully assigned</p>";

				 }
			    #echo "insertar";
			  }
		    }

		    //----------------------- TERMINA REFERAL FOR THIS BOOKING ----------------------------------------------------------------------------
		    /*insert or update an expedia info below*/
		     if (($_POST['id_referal']>0)&&($_SESSION['exp_id']!='')&&($_SESSION['exp_amount']!='')){
               insert_or_update_exp($rcl_ref=$ref, $id_referral=$_POST['id_referal'], $expedia_id=$_SESSION['exp_id'], $expedia_amount=$_SESSION['exp_amount']);
		     }


	    //-----------------------DISCOUNT FOR THIS BOOKING-------------------------------------------------------------------------------------
		   if ($_POST['promotion_id']>0){
		    $link= new getQueries();
		    $descuento_anterior=$link->show_any_data_limit1('discount', 'reference', $ref, '=');//details discount before saved as discount
		    $desc=$descuento_anterior[0];
	     	$this_pro=$link->show_active_limit1("promotion", "id", $_POST['promotion_id'], "=");//details for this promotion
	     	   $pro=$this_pro[0];
			  if ($descuento_anterior){
			  	$id_upd_d=$db->insert_discount_modified($desc['fecha'],$desc['reference'],$desc['pro_code'],$desc['pro_id'],$desc['pro_from'],$desc['pro_to'],$desc['pro_type'],$desc['pro_qty'],$desc['min_days'],$desc['qty_days'], $desc['id_adm']);
			    $actualizarlo=$db->update_discount($desc['id'],$ref,$pro['code'],$pro['id'],$pro['desde'],$pro['hasta'],$pro['tipo'],$pro['cant_porc'],$pro['min_days'],$pro['qty_days'], $id_adm,$id_upd_d);
			  }else{
				$result=$db->insert_discount($ref,
											$pro['code'],
											$pro['id'],
											$pro['desde'],
											$pro['hasta'],
											$pro['tipo'],
											$pro['qty'],
											$pro['min_days'],
											$pro['max_days'],
											$pro['bookingfrom'],
											$pro['bookingto'],
											$_POST['amount_discounted'],
											$id_adm,
											$new=1);
			  }
		    }
	   //----------------------- TERMINA DISCOUNT FOR THIS BOOKING ----------------------------------------------------------------------------

	   if($_SESSION['evento']){ /* GUARDAR EVENTO SI HAY EN LA SESSION*/
	     //print_r($_SESSION['evento']);
	     $fecha=date("Y-m-d G:i:s");
	     $result=$db->insert_events_saved($fecha,$ref,$_SESSION['evento']['name'],$_SESSION['evento']['from_date'],$_SESSION['evento']['to_date'],$_SESSION['evento']['qty'],$_SESSION['evento']['type'],$_SESSION['evento']['increase'], $id_adm, $_SESSION['evento']['id']);

	   }
	   /* TERMINO DE GUARDAR LOS EVENTOS*/

		if ($adults_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
		  for ($x=1;$x<=$adults_qty; $x++){
		  	//$name=${"_POST['a_name{$x}'"}; $lastname=${"a_lastname{$x}"};
		  	# $name=${"a_name{$x}"}; $lastname=${"a_lastname{$x}"};
		  	 $a_name="a_name$x"; $a_lastname="a_lastname$x"; $a_cedula="cedula$x"; $cedula=$_POST[$a_cedula];
		  	 $name=$_POST[$a_name]; $lastname=$_POST[$a_lastname];
		    // echo "NOMBRE ADULTOS:".$name_aduts." ".$lastname."<br>";
		   // echo $name;
		   // $name = 'p_item' . $item;        $value = $$name;         ej de variable variable
		  // $item = "ABC"; ${"p_item{$item}"} print $p_itemABC;    igual que la linea anterio
		    $db->insert_adults($id_reserve, $name, $lastname, $cedula);
		  	}
		}

		if ($children_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
		  for ($c=1;$c<=$children_qty; $c++){
		  	//$name=${"c_name{$c}"}; $lastname=${"c_lastname{$c}"};
		  	$c_name="c_name$c"; $c_lastname="c_lastname$c"; $c_passport="passport$c";
		  	$name=$_POST[$c_name]; $lastname=$_POST[$c_lastname];$passport=$_POST[$c_passport];
		    $db->insert_children($id_reserve, $name, $lastname,$passport);
		  	}
		}

	    //NUEVO CODIGO PARA INSERTAR LOS SERVICIOS
	    if($_POST['ids_services']){
	      foreach($_POST['ids_services'] AS $ids){
	      	if ($_POST['qty_services'][$ids]>0){$qty=$_POST['qty_services'][$ids];}else{$qty=1;}
	         $db->insert_additional_services($ids,
											 $id_reserve,
											 $qty,
											 $_POST['amount_services'][$ids],
											 $desc=$_POST['desc_services'][$ids],
											 $tax=$_POST['tax_services'][$ids],
											 $tipo=$_POST['tipo_services'][$ids],
											 $unit=$_POST['unit_services'][$ids]);
	      }
	    }
	    //TERMINA NUEVO CODIGO PARA INSERTAR LOS SERVICIOS

	    /*===================================insert cars no charge them to RCL=======================================*/
				if($_SESSION['cars']){ /*si hay carros seleccionados*/
                 //insertarlos en la base de datos .
                  foreach($_SESSION['cars'] AS $k){
                  	$total4thiscar=$_SESSION['cars_qty'][$k]*$_SESSION['car_price'][$k];
                  	$car_taxes=$total4thiscar*0.18;
	                 $inf_data=array('ref'=>$ref,
					                 'date'=>date("Y-m-d G:i:s"),
					                 'qty_days'=>$_SESSION['cars_qty'][$k],
					                 'id_car'=>$k,
					                 'price'=>$_SESSION['car_price'][$k],
					                 'taxes'=>$car_taxes,
					                 'status'=>'1',
					                 'ip_address'=>$_SERVER['REMOTE_ADDR'],
					                 'user_id'=>$_SESSION['info']['id']);

				  	$in_cars=$db->insert_gral($inf_data, $table='cars_rented');
				  }
				  unset($_SESSION['cars']);
				}
		/*============================================================================================================*/
		 unset($_SESSION['NO_REFRESH']);

		//IF IT IS CHECK IN YOU CAN PRINT ITS INVOICE AND REGISTER SHEET SHOW REF. NUMBER
		/*TRIPADVISOR MESSAGE IS SENT BELOW*/
	    
	 	 $villa_details=$data->villa($id_villa);
	      if($status==4 || $status==14){  /*mean the the booking is checked out*/
	         //enviar email de trip advisor
	        $db= new getQueries();
	        $cl=$db->customer($id_customer);//get cliente details

	         if($_POST['tripadvisor']=="yes"){
	        	$tripadvisor1=sent_tripadvisor_request($cl, $ref);
	        	echo $tripadvisor1;
	         }

	 	 }

		?>
	     <p class="header">Booking Saved</p><hr />
		 <div class="book_inserted1">
		 	<p class="bloques">Villa No.:<span class="info_details"> <?=$villa_details[0]['no']?></span></p>
		 	<p class="bloques">From:<span class="info_details"> <?=formatear_fecha($starting_date);?></span></p>
		 	<p class="bloques">To:<span class="info_details"> <?=formatear_fecha($ending_date);?></span></p>
		 </div><!--END SHOWING DATES AND VILLA-->

	     <div class="book_inserted2">
	      	<p class="bloques2">Booking Reference Number:<span class="info_details2"> <?=$ref?></span></p>
	     </div><!--END SHOWING REF NUMBER-->
	    <? if ($status==1){?>
	     <div class="book_inserted3">

			 <!--PRINT INVOICE FOR THIS BOOK-->
			<table align="center" border="0" cellspacing="0" cellpadding="10">
				<tr>
					<td>
						<form  name="invoice" method="post" action="customers_invoices_print.php" target="_blank">
							<input type="hidden" name="ref" value="<?=$ref?>"/>
							<input class="book_but" type="submit" name="invoice" value="Print Invoice" onClick="this.disabled=true; this.value='Printing...'; this.form.submit();"/>
						    </form>
					       <!--END PRINT INVOICE FOR THIS BOOK-->
					</td>
					<td>
					       <!--PRINT REGISTER SHEET FOR THIS BOOK-->
						    <form  name="register_sheet" method="post" action="customers_register_print.php" target="_blank">
							    <input type="hidden" name="ref" value="<?=$ref?>"/>
							    <input class="book_but" type="submit" name="register" value="Register Sheet" onClick="this.disabled=true; this.value='Printing...'; this.form.submit();" />
						    </form>
					</td>
				</tr>
			</table>
			     <!--END PRINT REGISTER SHEET FOR THIS BOOK-->
			     <!-- <input class="book_but" type="submit" name="confirm" value="Sent to customer"   /> -->
		  </div>   <!--END SHOWING PRINT DETAILS FOR CKECKED IN-->
		<?}?>
	     <div class="book_inserted4">
	     	<h2>Book successfuly created</h2>
	     	<a href="booking-calendar.php"><img class="calendar_img" src="images/calendar_booked.png" width="127px" height="49px" alt="calendar" title="go to calendar" /></a>
	        <a href="booking-calendar.php"><p class="link_calendar">Go to Calendar</p></a>
	     </div>
	<?
	}else{
      	 new_booking_busy_error($_POST['starting_date'], $_POST['ending_date'], $link="booking-calendar.php");
    }
 }else{
	 header('Location:login.php');
	 die();
 }
?>