			<?  
		if($_POST['promotion_code']!=''){	
			$_POST['promotion_code']=trim($_POST['promotion_code']);
				$amount_nights='';
				
   			  if ($_POST['promotion_code']!=""){
   			 	$db= new getQueries;
                $this_pro=$db->show_active_limit1("promotion", "code", $_POST['promotion_code'], "=");
                $pro_found=$this_pro[0];
              if(!$pro_found){
                	$_GET['promotion_error']="Promotion code not found or disabled in our system.";
        	    }else{
                	//entonces hacer procedimientos de calculos con esta promocion
                    //$_GET['promotion_error']="Promotion encontrada id->".$pro_found['id'];
                    //variables
                    $inicia_pro=strtotime($pro_found['desde']);
                    $fin_pro=strtotime($pro_found['hasta']);

                    $today_date=strtotime(date('Y-m-d'));

                    //----------------------------------------------------------------------------------------
                   if ($fin_pro<$today_date){ //si la promocion ya paso
                    $_GET['promotion_error']="We sorry this promotion is over now";
                   }
                    if ($inicia_pro>$today_date){ //si la promocion ya paso
                    $_GET['promotion_error']="This promotion is coming soon, not active yet.";
                   }
                   //--------limit date to book---------------------------
                  $only_book_from=strtotime($pro_found['bookingfrom']);
                  $only_book_to=strtotime($pro_found['bookingto']);

                  $fecha_inicio_booking=strtotime($empieza);
                  $fecha_termina_booking=strtotime($termina);
                   /*echo*/ $APF=$only_book_from;/* echo '<br/>';  echo $pro_found['bookingfrom']; echo '<br/>'; */
                   /*echo*/ $APT=$only_book_to;/* echo '<br/>';  echo $pro_found['bookingto']; echo '<br/>'; */
                   /*echo*/ $A1=$fecha_inicio_booking; /*echo '<br/>'; echo $starting; echo '<br/>';*/
                  /*echo*/  $B1=$fecha_termina_booking; /* echo '<br/>';  echo $ending; echo '<br/>';*/

                 if((($A1>=$APF)&&($A1<=$APT))||(($B1>=$APF)&&($B1<=$APT))){
                   //esta correcto la fecha
                    $fecha_promocion_validad="Yes";
                 }else{
                    //arrojar un error
                    $fecha_promocion_validad="No";
                    $_GET['promotion_error']="This promotion is only valid for bookings from: ".$pro_found['bookingfrom']." to: ".$pro_found['bookingto'];
                 }
                  //------------limit date to book here ------------------


                   if ((($inicia_pro)<=($today_date))&&(($fin_pro)>=($today_date))&&($fecha_promocion_validad=="Yes")){ //esta activa
                    //hacer calculos
                    $amount_nightsLS=($LS_nights*$price);
                    $amount_nightsHS=($HS_nights*$priceHS);
                    $amount_nights=$amount_nightsLS+$amount_nightsHS;

                     if  ($pro_found['tipo']=="2"){   //Amount
                      //vefiricar aqui que el monto no sea mayor que la renta, si es asi no descontar nada
                      /*  if  ($pro_found['cant_porc']>=$amount_nights){   //Amount
                            $_GET['promotion_error']="This promotion is not applicable to this booking.";
                        }else{*/
							  $valor_amount=$pro_found['cant_porc'];
							
                           $descuento=($pro_found['cant_porc']);
                           $variable_descuento="US$ ".$pro_found['cant_porc']." ";
                           $tipo_dsec="monto";
                           $promotion_code=$pro_found['code'];
                       /* }*/
                     }elseif($pro_found['tipo']=="1"){ //percent
							$valor_amount=$pro_found['cant_porc'];
                        $descuento=($amount_nights*($pro_found['cant_porc']/100));
                         $variable_descuento=number_format($pro_found['cant_porc'],0)." % ";
                         $tipo_dsec="porcient";
                         $promotion_code=$pro_found['code'];
                     }elseif($pro_found['tipo']=="3"){  //days
						 $valor_amount=$pro_found['qty_days'];

                      if($nights>=$pro_found['min_days']){
                        if ($LS_nights!=0 &&  $HS_nights==0){//solo low season
                           $descuento=$price*$pro_found['qty_days'];
                        }

                        if (($LS_nights==0)&&($HS_nights!=0)){//solo High season
                           $descuento=$priceHS*$pro_found['qty_days'];
                        }

                        if ($LS_nights!=0 &&  $HS_nights!=0){//ambas season
                          if($LS_nights>=$pro_found['qty_days']){
                         	$descuento=$price*$pro_found['qty_days'];
                          }else{
                          	$descuento=$price*$LS_nights;
                          	$descuento+=$priceHS*($pro_found['qty_days']-$LS_nights);
                          }
                        }

                         $variable_descuento=$pro_found['qty_days']." Nights ";
                         $tipo_dsec="days";
                         $promotion_code=$pro_found['code'];
                      }else{
                       /*$_GET['promotion_error']="This promotion requires minimun ".$pro_found['min_days']." nights";*/
                      }
                     }
                    $pro_id=$pro_found['id'];
                   }
                }
   			  }

			if ($_GET['promotion_error']){?>
			 	<div style="text-align:center; color:#080563; background-color:yellow;">Warning: <?=$_GET['promotion_error'];?></div>
			 <?}else{ 
			 ?>
			 <p style="background-color:#FFF; font-weight:bold; text-align:center;border: 1px solid red;">
			 <?
					echo 'PROMOTION DETAILS: <BR/> code: <span style="text-transform:uppercase">'.$_POST['promotion_code'].'</span> - ';
					switch($pro_found['tipo']){
						case '1': //percent
								$var_promo="$valor_amount percent discount to price below";
								break;
						case '2': //amount
								$var_promo="$valor_amount USD discount to price below";
								break;
						case '3': //nights
								$var_promo="$valor_amount night(s) discount to price below";
								break;
						default:
							$var_promo="Promo type error: please, contact us";
					}
					$_SESSION['promo_amt']=$valor_amount;
					$_SESSION['promo_type']=$pro_found['tipo'];
					$_SESSION['promo_code']=$pro_found['code'];
					$_SESSION['promo_id']=$pro_found['id'];
					
					$_SESSION['promo_minDays']=$pro_found['min_days'];
					/*$_SESSION['promo_from']=$pro_found['desde'];
					$_SESSION['promo_to']=$pro_found['hasta'];*/
					
				echo $var_promo;
			 ?>
			 </p>
			 <?
			 }
			 
		}?>