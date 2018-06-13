<?php
$data= new getQueries ();
$villas=$data->show_id('villas', $_GET['id']);
//echo 'Details: ';
//echo $_GET['id'];
//print_r($villas);

$v=$villas[0];

//echo $v['no'];
?>
<p class="header">Details for Villa No. <?=$v['no']?></p><hr />

<div class="villa_detail1" ><p><img src="<?=$v['pic']?>" width="239px" height="200px" alt="Villa Picture" title="Villa Picture" /></p>
<p><span class="blue_head">Available for monthly rent?:</span> <? if ($v['able_s']==1){ echo 'NO'; }else{ echo 'Yes'; }?></p>
<p><span class="blue_head">Available for rent?:</span> <? if ($v['able_r']==1){ echo 'Yes'; }else{ echo 'No'; }?></p>
<p><span class="blue_head" style="color:#003">Available for Long Term?:</span> <? if ($v['long_able']==0){ echo 'Yes'; }else{ echo 'No'; }?></p>
<p><span class="blue_head">Last Modified on:</span> <?=$v['date']?></p>
<p><form method="get" action="edit-villas-details.php">
<input type="hidden" name="id" value="<?=$v['id']?>" />
<? if ($_SESSION['info']['level']==1){?>
	<input class="book_but" type="submit" name="update" value="Update Villa" />

<?}?>
</form>
</p>
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
<p><span class="blue_head">Price High Season:</span> US$ <?=number_format($v['p_high'],2)?></p>
<p><span class="blue_head" style="color:#003">Price Long Term:</span> US$ <?/*=$v['p_long']*/?> <? $long_term=$v['p_long']+$v['maintenance']+$v['water_long']+($v['p_out_clear']*0.70); echo number_format($long_term,2); ?> Total </p>
<p><span class="blue_head" style="color:#003">Maintenance fee:</span> US$ <?=$v['maintenance']?></p>
<p><span class="blue_head" style="color:#003">Water Service:</span> US$ <?=$v['water_long']?></p>
<p><span class="blue_head" style="color:#003">Maid Service:</span> US$ <?=$v['p_in_clear']?></p>
<p><span class="blue_head" style="color:#003">Garden and Pool:</span> US$ <?=$v['p_out_clear']?></p>
<p><span class="blue_head" style="color:red;">WEEKLY:</span> US$ <?=number_format(weekly_rate($v['p_low']),2)?> - <?=number_format(weekly_rate($v['p_high']),2)?></p>
<p><span class="blue_head" style="color:red;">MONTHLY:</span> US$ <?=number_format(monthly_rate($v['p_low']),2)?> - <?=number_format(monthly_rate($v['p_high']),2)?></p>

<p><span class="blue_head" style="color:green;">AVAILABLE ONLINE?:</span> <span style="color:black;"><strong><? if($v['vonline']==1){ echo "NO"; }else{ echo "YES"; } ?></strong></span></p>

<p><span class="blue_head" style="color:blue;">AVAILABLE FOR AGENT?:</span> <?  if($v['vrap']==1){ echo "NO"; }else{ echo "YES"; } ?></p>

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
	<p style="text-align:right; clear:both;"><a href="photos_galleries.php?v=<?=$v['no']?>" target="_blank" ><img src="images/photos_gallery.png"/></a></p>
</div><!--end forth column-->
