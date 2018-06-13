<?php


/*
echo "<pre>";
print_r($promocion);
echo "</pre>";*/


		if(!$_POST['fecha_ini']){ $_POST['fecha_ini']=date('m/d/Y'); }
		if(!$_POST['fecha_ter']){ 
			$_POST['fecha_ter']=strtotime("+3 day", strtotime($_POST['fecha_ini']));
			$_POST['fecha_ter']=date('m/d/Y', $_POST['fecha_ter']);
		}
		
		   $link=new getQueries;
		   
			$precios_2bdr_pre=$link->display_table($table='prices_villas', $condition=" beds='2' AND type='1' AND active='1'", $order='id');
		 $precios_2bdr_del=$link->display_table($table='prices_villas', $condition=" beds='2' AND type='2' AND active='1'", $order='id');
		 
		 $precios_3bdr_pre=$link->display_table($table='prices_villas', $condition=" beds='3' AND type='1' AND active='1'", $order='id');
		 $precios_3bdr_del=$link->display_table($table='prices_villas', $condition=" beds='3' AND type='2' AND active='1'", $order='id');
		 
		 $precios_4bdr_pre=$link->display_table($table='prices_villas', $condition=" beds='4' AND type='1' AND active='1'", $order='id');
		 $precios_4bdr_del=$link->display_table($table='prices_villas', $condition=" beds='4' AND type='2' AND active='1'", $order='id');
		 
		 $precios_5bdr_pre=$link->display_table($table='prices_villas', $condition=" beds='5' AND type='1' AND active='1'", $order='id');
		 $precios_5bdr_del=$link->display_table($table='prices_villas', $condition=" beds='5' AND type='2' AND active='1'", $order='id');
		 
		 $precios_6bdr_pre=$link->display_table($table='prices_villas', $condition=" beds='6' AND type='1' AND active='1'", $order='id');
		 $precios_6bdr_del=$link->display_table($table='prices_villas', $condition=" beds='6' AND type='2' AND active='1'", $order='id');

		 /*if($_POST['promotion_code']!=''){
			 $pro=$link->display_table($table='promotion', $condition=" code='".trim($_POST['promotion_code'])."' AND active='1'", $order='id');
		 }*/
		 
		 ?>

<div class="container">

<h3 style="color:#333; text-align:center;">Your search result for:<br/><br/>

  <?php /*if(trim($_SESSION['uniqueVilla'])!=''){
	$villas_no=$db->singleVilla4rent($id=$_SESSION['uniqueVilla']); //villas for rent with this bedrooms qty.
	?>
  <span style="color:#0098da; text-transform:uppercase;">villa
  <?=$villas_no[0]['no']?>
  </span><br/>
  <?}else{?>
  <span style="color:#0098da; text-transform:uppercase;">
  <?=$_POST['beds']?>
  Bedrooms villas</span><br/>
  <?}*/?>
  <span style="color:#333; text-transform:uppercase;">From: </span> 
  <span style="color:#0098da; text-transform:uppercase;">
  <?=formatear_fecha(date('Y-m-d',strtotime($_POST['fecha_ini'])))?>
  </span>
  <span style="color:#333; text-transform:uppercase;">To: </span>
  <span style="color:#0098da; text-transform:uppercase;">
  <?=formatear_fecha(date('Y-m-d',strtotime($_POST['fecha_ter'])))?>
  </span>
  </h3>
  <hr style="border: 1px solid #9c0000;"/>
<p>&nbsp;</p>
	<?php
		/*if($pro[0]){
			
			
			//valid from to
			$fecha_checkin=strtotime($_POST['fecha_ini']);
			$fecha_checkout=strtotime($_POST['fecha_ter']);
			$valid_from=strtotime($pro[0]['desde']);
			$valid_to=strtotime($pro[0]['hasta']);
			$tobook_from=strtotime($pro[0]['bookingfrom']);
			$tobook_to=strtotime($pro[0]['bookingto']);
			$now_date=time();
			$night_qty=daysDifference2(date('Y-m-d', $fecha_checkout), date('Y-m-d', $fecha_checkin));
			
			
			if(($now_date>=$tobook_from)&&($now_date<=$tobook_to)){				
				if(($fecha_checkin>=$valid_from)&&($fecha_checkin<=$valid_to)){
					if(($night_qty>=$pro[0]['min_days'])&&($night_qty<=$pro[0]['max_days'])){
						//type
						switch($pro[0]['tipo']){
							case 1:
								//1-percent
								$promotion_apply=$pro[0]['qty']."% off";
								$discount_percent=$pro[0]['qty'];
								break;
								
							case 2://2-amount
								$promotion_apply=$pro[0]['qty']." USD off";
								#$discount_percent='';
								break;
								
							case 3://3-nights
								$promotion_apply=$pro[0]['qty']." nights free";
								#$discount_percent='';
								break;
						}
						
						$promotion_ends="Hurry! Offer ends in ".date('M j Y',strtotime($pro[0]['bookingto']));
						$promotion_sale="Sale!";
						
						#precios
						
					}else{
						//$promotion_apply="This promotion do not apply (1)";
						$discount_percent='';
					}
				}else{
					//$promotion_apply="This promotion do not apply (2)";
					$discount_percent='';
				}
			}else{
				//$promotion_apply="This promotion do not apply (3)";
				$discount_percent='';
			}	
		}*/
		$fecha_checkin=date('Y-m-d', strtotime($_POST['fecha_ini']));
		$fecha_checkout=date('Y-m-d', strtotime($_POST['fecha_ter']));
		
		$promocion=auto_promotion($fecha_checkin, $fecha_checkout, $price='100');/*WITH THIS LINE IS POSSIBLE TO GET AUTO PROMOTION ACTIVATED*/

		if($promocion){
			$promotion_apply=$promocion['title'];//title
			$promotion_ends="Hurry! Offer ends in ".date('M j Y',strtotime($promocion['fin']));
			$promotion_sale=$promocion['msg'];
			$discount_percent=$promocion['qty_perc'];
			$_POST['promotion_code']=$promocion['code'];
		}
		
		
	?>
	<div class="row rcorners2">
	  <div class="col-md-2"><img class="img-rounded" alt="Responsive image" src="images/villas/2.jpg"/></div>
	  <div class="col-md-6"><h2 class="promotion"><span class="label label-primary"><?=$promotion_apply?></span>&nbsp;</h2>
	  <p  class="fuente_parrafo bedrooms"><strong>2 Bedroom Villa</strong></p>
	  <p class="fuente_parrafo">Premium <? if($discount_percent){ 
	  $price_before1=$precios_2bdr_pre[0]['price']; 
	  $precios_2bdr_pre[0]['price']-=$precios_2bdr_pre[0]['price']*($discount_percent/100);
	  ?>
	  <strike>$<?=number_format($price_before1,0)?> </strike><? }?>
	  $<?=number_format($precios_2bdr_pre[0]['price'],0)?> per night</p>
	  <p class="fuente_parrafo">Deluxe <? if($discount_percent){ 
	  $price_before2=$precios_2bdr_del[0]['price']; 
	  $precios_2bdr_del[0]['price']-=$precios_2bdr_del[0]['price']*($discount_percent/100);
	  ?>
	  <strike>$<?=number_format($price_before2,0)?> </strike><? }?> $<?=number_format($precios_2bdr_del[0]['price'],0)?> per night</p>
	  </div>
	  <div class="col-md-4">
	 
	  <h4 class="sales"><span class="label label-success"><?=$promotion_sale?></span>&nbsp;</h4>
	  <p style="text-align:right;" class="fuente_parrafo"><?=$promotion_ends?>&nbsp;</p>
	  
	  <form method="post" action="vacation-villas-search.php#content_starts">
		<p style="text-align:right;" class="fuente_parrafo">
			<input type="hidden" name="beds" value="2"/>
			<input type="hidden" name="fecha_ini" value="<?=$_POST['fecha_ini']?>"/>
			<input type="hidden" name="fecha_ter" value="<?=$_POST['fecha_ter']?>"/>
			<input type="hidden" name="promotion_code" value="<?=$_POST['promotion_code']?>"/>
			<button class="btn btn-primary" type="submit">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 
				Book Now
			</button>
		</p>
	  </form>
	  
	  </div>
	</div>
	
	<div class="row rcorners2">
	  <div class="col-md-2"><img class="img-rounded" alt="Responsive image" src="images/villas/3.jpg"/></div>
	  <div class="col-md-6"><h2 class="promotion"><span class="label label-primary"><?=$promotion_apply?></span>&nbsp;</h2>
	  <p class="fuente_parrafo bedrooms"><strong>3 Bedroom Villa</strong></p>
	  <p class="fuente_parrafo">Premium <? if($discount_percent){ 
	  $price_before3=$precios_3bdr_pre[0]['price']; 
	  $precios_3bdr_pre[0]['price']-=$precios_3bdr_pre[0]['price']*($discount_percent/100);
	  ?>
	  <strike>$<?=number_format($price_before3,0)?> </strike><? }?> $<?=number_format($precios_3bdr_pre[0]['price'],0)?> per night</p>
	  <p class="fuente_parrafo">Deluxe <? if($discount_percent){ 
	  $price_before4=$precios_3bdr_del[0]['price']; 
	  $precios_3bdr_del[0]['price']-=$precios_3bdr_del[0]['price']*($discount_percent/100);
	  ?>
	  <strike>$<?=number_format($price_before4,0)?> </strike><? }?> $<?=number_format($precios_3bdr_del[0]['price'],0)?> per night</p>
	  </div>
	  <div class="col-md-4">
	 
	  <h4 class="sales"><span class="label label-success"><?=$promotion_sale?></span>&nbsp;</h4>
	  <p class="fuente_parrafo" style="text-align:right;"><?=$promotion_ends?>&nbsp;</p>
	  
	  <form method="post" action="vacation-villas-search.php#content_starts">
	  <p style="text-align:right;">
			<input type="hidden" name="beds" value="3"/>
			<input type="hidden" name="fecha_ini" value="<?=$_POST['fecha_ini']?>"/>
			<input type="hidden" name="fecha_ter" value="<?=$_POST['fecha_ter']?>"/>
			<input type="hidden" name="promotion_code" value="<?=$_POST['promotion_code']?>"/>
			<button class="btn btn-primary" type="submit">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 
				Book Now
			</button>
		</p>
		</form>
	  </div>
	</div>
	
	<div class="row rcorners2">
	  <div class="col-md-2"><img class="img-rounded" alt="Responsive image" src="images/villas/4.jpg"/></div>
	  <div class="col-md-6"><h2 class="promotion"><span class="label label-primary"><?=$promotion_apply?></span>&nbsp;</h2>
	  <p class="fuente_parrafo bedrooms"><strong>4 Bedroom Villa</strong></p>
	  <p class="fuente_parrafo">Premium <? if($discount_percent){ 
	  $price_before5=$precios_4bdr_pre[0]['price']; 
	  $precios_4bdr_pre[0]['price']-=$precios_4bdr_pre[0]['price']*($discount_percent/100);
	  ?>
	  <strike>$<?=number_format($price_before5,0)?> </strike><? }?> $<?=number_format($precios_4bdr_pre[0]['price'],0)?> per night</p>
	  <p class="fuente_parrafo">Deluxe <? if($discount_percent){ 
	  $price_before6=$precios_4bdr_del[0]['price']; 
	  $precios_4bdr_del[0]['price']-=$precios_4bdr_del[0]['price']*($discount_percent/100);
	  ?>
	  <strike>$<?=number_format($price_before6,0)?> </strike><? }?> $<?=number_format($precios_4bdr_del[0]['price'],0)?> per night</p>
	  </div>
	  <div class="col-md-4">
	 
	  <h4 class="sales"><span class="label label-success"><?=$promotion_sale?></span>&nbsp;</h4>
	  <p class="fuente_parrafo" style="text-align:right;"><?=$promotion_ends?>&nbsp;</p>
	  
	   <form method="post" action="vacation-villas-search.php#content_starts">
	  <p style="text-align:right;">
			<input type="hidden" name="beds" value="4"/>
			<input type="hidden" name="fecha_ini" value="<?=$_POST['fecha_ini']?>"/>
			<input type="hidden" name="fecha_ter" value="<?=$_POST['fecha_ter']?>"/>
			<input type="hidden" name="promotion_code" value="<?=$_POST['promotion_code']?>"/>
			<button class="btn btn-primary" type="submit">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 
				Book Now
			</button>
		</p>
		</form>
	  </div>
	</div>
	
	<div class="row rcorners2">
	  <div class="col-md-2"><img class="img-rounded" alt="Responsive image" src="images/villas/5.jpg"/></div>
	  <div class="col-md-6"><h2 class="promotion"><span class="label label-primary"><?=$promotion_apply?></span>&nbsp;</h2>
	  <p class="fuente_parrafo bedrooms"><strong>5 Bedroom Villa</strong></p>
	  <p class="fuente_parrafo">Premium <? if($discount_percent){ 
	  $price_before7=$precios_5bdr_pre[0]['price']; 
	  $precios_5bdr_pre[0]['price']-=$precios_5bdr_pre[0]['price']*($discount_percent/100);
	  ?>
	  <strike>$<?=number_format($price_before7,0)?> </strike><? }?> $<?=number_format($precios_5bdr_pre[0]['price'],0)?> per night</p>
	  <p class="fuente_parrafo">Deluxe <? if($discount_percent){ 
	  $price_before8=$precios_5bdr_del[0]['price']; 
	  $precios_5bdr_del[0]['price']-=$precios_5bdr_del[0]['price']*($discount_percent/100);
	  ?>
	  <strike>$<?=number_format($price_before8,0)?> </strike><? }?> $<?=number_format($precios_5bdr_del[0]['price'],0)?> per night</p>
	  </div>
	  <div class="col-md-4">
	 
	  <h4 class="sales"><span class="label label-success"><?=$promotion_sale?></span>&nbsp;</h4>
	  <p class="fuente_parrafo" style="text-align:right;"><?=$promotion_ends?>&nbsp;</p>
	  
	   <form method="post" action="vacation-villas-search.php">
	  <p style="text-align:right;">
			<input type="hidden" name="beds" value="5"/>
			<input type="hidden" name="fecha_ini" value="<?=$_POST['fecha_ini']?>"/>
			<input type="hidden" name="fecha_ter" value="<?=$_POST['fecha_ter']?>"/>
			<input type="hidden" name="promotion_code" value="<?=$_POST['promotion_code']?>"/>
			<button class="btn btn-primary" type="submit">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 
				Book Now
			</button>
		</p>
		</form>
	  </div>
	</div>
	
	<div class="row rcorners2">
	  <div class="col-md-2"><img class="img-rounded" alt="Responsive image" src="images/villas/6.jpg"/></div>
	  <div class="col-md-6"><h2 class="promotion"><span class="label label-primary"><?=$promotion_apply?></span>&nbsp;</h2>
	  <p class="fuente_parrafo bedrooms"><strong>6 Bedroom Villa</strong></p>
	  <p class="fuente_parrafo">Premium <? if($discount_percent){ 
	  $price_before9=$precios_6bdr_pre[0]['price']; 
	  $precios_6bdr_pre[0]['price']-=$precios_6bdr_pre[0]['price']*($discount_percent/100);
	  ?>
	  <strike>$<?=number_format($price_before9,0)?> </strike><? }?> $<?=number_format($precios_6bdr_pre[0]['price'],0)?> per night</p>
	  <p class="fuente_parrafo">Deluxe <? if($discount_percent){ 
	  $price_before10=$precios_6bdr_del[0]['price']; 
	  $precios_6bdr_del[0]['price']-=$precios_6bdr_del[0]['price']*($discount_percent/100);
	  ?>
	  <strike>$<?=number_format($price_before10,0)?> </strike><? }?> $<?=number_format($precios_6bdr_del[0]['price'],0)?> per night</p>
	  </div>
	  <div class="col-md-4">
	 
	  <h4 class="sales"><span class="label label-success"><?=$promotion_sale?></span>&nbsp;</h4>
	  <p class="fuente_parrafo" style="text-align:right;"><?=$promotion_ends?>&nbsp;</p>
	  
	  <form method="post" action="vacation-villas-search.php#content_starts">
	    <p style="text-align:right;">
			<input type="hidden" name="beds" value="6"/>
			<input type="hidden" name="fecha_ini" value="<?=$_POST['fecha_ini']?>"/>
			<input type="hidden" name="fecha_ter" value="<?=$_POST['fecha_ter']?>"/>
			<input type="hidden" name="promotion_code" value="<?=$_POST['promotion_code']?>"/>
			<button class="btn btn-primary" type="submit">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 
				Book Now
			</button>
		</p>
		</form>
	  </div>
	</div>
</div>