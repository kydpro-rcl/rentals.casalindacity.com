<? include('menu_CSS/menu-villas.php');?>
<?php
$data= new getQueries ();
$villas=$data->show_id('villas', $_GET['id']);
//echo 'Details: ';
//echo $_GET['id'];
//print_r($villas);

$v=$villas[0];
$s=$data->services_contracted($_GET['id']);
//echo $v['no'];
?>
<p class="header">Details for Villa No. <?=$v['no']?></p><hr />

<div class="villa_detail1" ><p><a href="../photos/reorder_del.php?id=<?=$v['id']?>" target="_blank" ><img src="<?=$v['pic']?>" width="239px" height="200px" alt="Villa Picture" title="Villa Picture" /></a></p>
<p><span class="blue_head">Available for monthly rent?:</span> <? if ($v['able_s']==1){ echo 'NO'; }else{ echo 'Yes'; }?></p>
<p><span class="blue_head">Available for rent?:</span> <? if ($v['able_r']==1){ echo 'Yes'; }else{ echo 'No'; }?></p>
<p><span class="blue_head" style="color:#003">Available for Long Term?:</span> <? if ($v['long_able']==0){ echo 'Yes'; }else{ echo 'No'; }?></p>
<p><span class="blue_head">Last Modified on:</span> <?=$v['date']?></p>

</div><!--end first column-->
<div class="villa_detail2" >
<p><span class="blue_head">Type:</span> <?=$v['type']?></p>
<p><span class="blue_head">Size M&sup2;:</span> <?=$v['m2']?></p>
<p><span class="blue_head">Size Ft&sup2;:</span> <?=$v['ft2']?></p>
<p><span class="blue_head">Bedrooms:</span> <?=$v['bed']?></p>
<p><span class="blue_head">Bathrooms:</span> <?=$v['bath']?></p>
<p><span class="blue_head">AC:</span> <?=$v['AC']?></p>
<p><span class="blue_head">Max. Persons:</span> <?=$v['capacity']?></p>
<? $owner=$data->show_id('owners',$v['id_owner']);?>
<p><span class="blue_head">Owner:</span> <a href="view-owners-details.php?id=<?=$owner[0]['id']?>" target="_blank"><? echo $owner[0]['name'].' '.$owner[0]['lastname'];?></a></p>
<p><span class="blue_head">Owner's email:</span> <a href="view-owners-details.php?id=<?=$owner[0]['id']?>" target="_blank"><? echo $owner[0]['email'];?></a></p>
</div><!--end second column-->
<div class="villa_detail3" >
<p><span class="blue_head">Price Low Season:</span> US$ <?=number_format($v['p_low'],2)?></p>
<p><span class="blue_head">Price Shoulder Season:</span> US$ <?=number_format($v['p_shoulder'],2)?></p>
<p><span class="blue_head">Price High Season:</span> US$ <?=number_format($v['p_high'],2)?></p>
<p><span class="blue_head" style="color:#003">Price Long Term:</span> US$ <?/*=$v['p_long']*/?> <? $long_term=$v['p_long']+$v['maintenance']+$v['water_long']+($v['p_out_clear']*0.70); echo number_format($long_term,2); ?> Total </p>
<p><span class="blue_head" style="color:#003">Subdivision fee:</span> US$ <?=$v['maintenance']?></p>
<p><span class="blue_head" style="color:#003">Water Service:</span> US$ <?=$v['water_long']?></p>
<p><span class="blue_head" style="color:#003">Maid Service:</span> US$ <?=$v['p_in_clear']?></p>
<p><span class="blue_head" style="color:#003">Garden and Pool:</span> US$ <?=$v['p_out_clear']?></p>
<p><span class="blue_head" style="color:red;">WEEKLY:</span> US$ <?=number_format(weekly_rate($v['p_low']),2)?> - <?=number_format(weekly_rate($v['p_high']),2)?></p>
<p><span class="blue_head" style="color:red;">MONTHLY:</span> US$ <?=number_format(monthly_rate($v['p_low']),2)?> - <?=number_format(monthly_rate($v['p_high']),2)?></p>

<p><span class="blue_head" style="color:green;">AVAILABLE ONLINE?:</span> <span style="color:black;"><strong><? if($v['vonline']==1){ echo "NO"; }else{ echo "YES"; } ?></strong></span></p>

<p><span class="blue_head" style="color:blue;">AVAILABLE FOR AGENT?:</span> <?  if($v['vrap']==1){ echo "NO"; }else{ echo "YES"; } ?></p>

<p><span class="blue_head" style="color:blue;">VILLA TYPE:</span> <?  
 switch($v['classification']){
		 	   case 1:          
	  				echo 'A';
		 	   		  break;
		 	   case 2:          
		 	   		echo 'B';
		 	   		  break;
		       case 3:          
		       		echo 'C';
		 	   		  break;
		 	  case 4:          
		       		echo 'D';
		 	   		  break;
		 } ?></p>

</div><!--end thirth column-->
<div class="villa_detail4" >
<p><span class="blue_head">Referal wished?:</span> <? if ($v['wish_referal']==0){ echo 'Yes'; }else{ echo 'No'; }?></p>
<p><span class="blue_head">Villa type:</span> <? if ($v['classification']==1){ echo 'Yes'; }elseif($v['classification']==2){ echo 'No'; }?></p>
<?
$clean=$data->clean($v['id']); //get information for actual villa in cleaning table
	 switch($clean['status']){
		 	   case 1:          //ready cleaned
	  				  $color_de_fondo="#1818f6";
		  			  $color_de_letra="white";
		  			 // $textclean="Already cleaned";
		 	   		  break;
		 	   case 2:           //dirty
		 	   		  $color_de_fondo="#0f0f0f";
		  			  $color_de_letra="white";
		  			 // $textclean="Dirty";
		 	   		  break;
		       case 3:           //in process - cleaning
		       		  $color_de_fondo="#f9a334";
		  			  $color_de_letra="blue";
		  			  //$textclean="Cleaning Now";
		 	   		  break;
		 	   default:			//unknown
					  $color_de_fondo="white";
		  			  $color_de_letra="black";
		  			 // $textclean="Unknown";
		 }
		 $link= new DB(); $made=$link->getUserDetails($clean['id_adm']);
?>
	<? if($clean){?>
		<fieldset style="background-color:<?=$color_de_fondo?>; color:<?=$color_de_letra?>;"><legend style="background-color:<?=$color_de_fondo?>; color:<?=$color_de_letra?>;">HOUSE KEEPING NOTE</legend>
		 <p style="background-color:<?=$color_de_fondo?>; color:<?=$color_de_letra?>;font-size:12px;"><? if (trim($clean['nota'])!=''){ echo $clean['nota']; }else{ echo "There is not Note"; }?> </p>
         <p style="background-color:<?=$color_de_fondo?>; color:<?=$color_de_letra?>; font-size:10px;">LAST UPDATE:<BR/><?=date("D dS \of M Y h:i:s A",strtotime($clean['fecha']))?><br> BY: <?=$made[0]['name'].' '.$made[0]['lastname']?> </p>
		</fieldset>
	<?}?>
	<!--<p style="text-align:right; clear:both;"><a href="photos_galleries.php?v=<?=$v['no']?>" target="_blank" ><img src="images/photos_gallery.png"/></a></p>-->
	<p style="text-align:right; clear:both;"><a href="../photos/reorder_del.php?id=<?=$v['id']?>" target="_blank" ><img src="images/photos_gallery.png"/></a></p>
</div><!--end forth column-->
<?php
$margenes='style="padding:0; margin:0;"';
?>
<fieldset><legend>SERVICES CONTRACTED WITH RCL</legend>
<table width="100%">
<tr>
<td valign="top">

<table>
	<tr>
		<th>SERVICES</th>
		<th align="right">PRICES</th>
	</tr>
	<tr>
		<td><p id="fields" <?=$margenes?>>SUBDIVISION FEE: <input class="input" type="text" name="pg"  value="<?=$s['subdivision']?>" readonly=""/></p></td>
		<td><p id="fields" <?=$margenes?>>US$ <?=$s['subdivisionfee']?></p></td>
	</tr>
	<tr>
		<td><p id="fields" <?=$margenes?>> POOL/GARDEN: <input class="input" type="text" name="pg"  value="<?=$s['pool_garden']?>" readonly=""/></p></td>
		<td><p id="fields" <?=$margenes?>>US$ <?=$s['ppool']?></p></td>
	</tr>
	<tr>
		<td><p id="fields" <?=$margenes?>>MAID SERVICE: <input class="input" type="text" name="ms"  value="<?=$s['maid']?>" readonly=""/></p></td>
		<td><p id="fields" <?=$margenes?>>US$ <?=$s['pmaid']?></p></td>
	</tr>
	<tr>
		<td><p id="fields" <?=$margenes?>>WATER: <input class="input" type="text" name="ms"  value="<?=$s['swater']?>" readonly=""/></p></td>
		<td><p id="fields" <?=$margenes?>>US$ <?=$s['pwater']?></p></td>
	</tr>
	<tr>
		<td><p id="fields" <?=$margenes?>>INTERNET: <input class="input" type="text" name="int"  value="<?=$s['wifi']?>" readonly=""/></p></td>
		<td><p id="fields" <?=$margenes?>>US$ <?=$s['pinternet']?></p></td>
	</tr>
	<tr>
		<td><p id="fields" <?=$margenes?>>CABLE: <input class="input" type="text" name="cab"  value="<?=$s['cable']?>" readonly=""/></p></td>
		<td><p id="fields" <?=$margenes?>>US$ <?=$s['ptvcable']?></p></td>
	</tr>
	<tr>
		<td><p id="fields" <?=$margenes?>>ELECTRICITY: <input class="input" type="text" name="elec"  value="<?=$s['electricity']?>" readonly=""/></p></td>
		<td><p id="fields" <?=$margenes?>>US$ <?=$s['pelect']?></p></td>
	</tr>
	<tr>
		<td><p id="fields" <?=$margenes?>>ADMIN FEE: <input class="input" type="text" name="adm"  value="<?=$s['admdetails']?>" readonly=""/></p></td>
		<td><p id="fields" <?=$margenes?>>US$ <?=$s['admin_fee']?></p></td>
	</tr>
	<tr>
		<td><p id="fields" <?=$margenes?>>ACCOUNTING FEE: <input class="input" type="text" name="acc"  value="<?=$s['accdetails']?>" readonly=""/></p></td>
		<td><p id="fields" <?=$margenes?>>US$ <?=$s['acc_fee']?></p></td>
	</tr>
	<tr>
		<td>TOTAL SERVICES MONTHLY:</td>
		<td>US$ <?=number_format($s['acc_fee']+$s['admin_fee']+$s['pelect']+$s['ptvcable']+$s['pinternet']+$s['pwater']+$s['pmaid']+$s['ppool']+$s['subdivisionfee'],2)?></td>
	</tr>
</table>

</td>
<td valign="top">
<p id="fields" style="padding-right:55px;font-size:12px;font-weight:bold;">AGREEMENTS</p>
<p id="fields">RENTAL AGREEMENT: 
<input class="input" type="text" name="ra"  value="<?=$s['agr_rental']?>" readonly=""/>
</p>
<p id="fields">WAIVER OF FEE: 
<input class="input" type="text" name="wf"  value="<?=$s['agr_waiver']?>" readonly=""/>
</p>

<p id="fields" >RENTAL GUARANTEE: 
<input class="input" type="text" name="rg"  value="<?=$s['agr_rent_gua']?>" readonly=""/>
</p>
<p id="fields" >SPECIAL AGREEMENT: 
<input class="input" type="text" name="sa"  value="<?=$s['agr_special']?>" readonly=""/>
</p>
<p id="fields" >HOUSE INSURANCE: 
<input class="input" type="text" name="hi"  value="<?=$s['insurance']?>" readonly=""/>
</p>

<p id="fields" >OTHER AGREEMENT: 
<input class="input" type="text" name="oa"  value="<?=$s['agr_other']?>" readonly=""/>
</p>

</td></tr></table>
</fieldset>

<p>
<form method="get" action="edit-villas-details.php">
<input type="hidden" name="id" value="<?=$v['id']?>" />
	<? if ($_SESSION['info']['level']==1){?>
		<input class="book_but" type="submit" name="update" value="Update Villa" />
	<?}?>
</form>
</p>
