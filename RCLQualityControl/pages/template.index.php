<meta http-equiv="refresh" content="600"/>
<div class="art-box-body art-post-body">
<p style="color:red"><span style="color:#0091c0;">Last updated:</span> <?=date("d M Y - g:i:s A")?>
<?php

?>
<?php

?></p>
<table border="0" cellspacing="0" align="center" class="main_table" width="100%">
   <tr class="row_head">
   		<td class="cell" colspan="8" align="center" style="background-color:#58c1df;"><b>CONSTRUCTION DEPARTMENT</b></td>
   		<td class="cell" style="background-color:#fcd826;color:green;"  align="center"><b>RENTAL</b></td>
   		<td class="cell"  style="background-color:#0091c0;"  align="center"><b>ADMINISTRACION</b></td>
   	</tr>
   	<tr class="row_head">
   		<td class="cell">Villa</td>
   		<td class="cell">Builder</td>
   		<td class="cell">Doc#</td>
   		<td class="cell">Deficiencies</td>
   		<td class="cell">Def. Promised</td>
   		<td class="cell">Stage</td>
   		<td class="cell">Delivered</td>
   		<td class="cell">Rental</td>
   		<td class="cell">Availability</td>
   		<td class="cell">Maintenance</td>
   	</tr>
   	<?
   	  $data=new Consultas();
          $villas=$data->consulta_villas();
          ?>
          <script type="text/javascript">
		$(document).ready(function() {
			/*$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});*/

            <?	foreach($villas AS $k){?>
				$("a#example<?=$k['id']?>").fancybox({
					'titlePosition'		: 'outside',
					'overlayColor'		: '#000',
					'overlayOpacity'	: 0.7,
					'transitionIn'	: 'elastic',
					'transitionOut'	: 'none'
				});

				$("a#maintenance<?=$k['id']?>").fancybox({
					'titlePosition'		: 'outside',
					'overlayColor'		: '#000',
					'overlayOpacity'	: 0.7,
					'transitionIn'	: 'elastic',
					'transitionOut'	: 'none'
				});

    			$("a#bookings<?=$k['id']?>").fancybox({
					'titlePosition'		: 'outside',
					'overlayColor'		: '#000',
					'overlayOpacity'	: 0.7,
					'transitionIn'	: 'elastic',
					'transitionOut'	: 'none'
				});
			<?}?>

		});
	</script>
          <?
   	foreach($villas AS $k){
          // deficiencias
          $defi=$data->SeeTable($table='deficiencies', $condition_sql='id_villa='.$k['id'].' AND status=\'1\'', $order_field='id', $order_type='ASC');
          //doc numbers
          $doc_no=$data->SeeTable($table='doc_number', $condition_sql='id_villa='.$k['id'], $order_field='id', $order_type='ASC');
          // maintenance que debe coincidir con la fecha y hora actual en la actividad
          $fecha_de_ahora=date("Y-m-d G:i:s");
          $maint=$data->SeeTable($table='maintenance', $condition_sql='id_villa='.$k['id'].' AND active=\'1\' AND  	desde<=\''.$fecha_de_ahora.'\' AND hasta>=\''.$fecha_de_ahora.'\'', $order_field='id', $order_type='ASC');
          //villa details
          $const=$data->SeeTable($table='villa_details', $condition_sql='id_villa='.$k['id'], $order_field='id', $order_type='ASC');
   		?>
   		<tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#b5dae5';" >
	   		<td class="cell"><?=$k['no']?></td>
	   		<td class="cell"><?=$const[0]['builder']?></td>
	   		<td class="cell"><? foreach($doc_no AS $d){ echo $d['doc_no'].'-'; }?></td>
	   		<td class="cell" align="center"><a href="show_details.php?i=d&v=<?=$k['id']?>"  target="_blank" id="example<?=$k['id']?>" title="Deficiencies for villa <?=$k['no']?>"><? if (count($defi)) echo count($defi); ?></a></td>
	   		<td class="cell"><? if(($const[0]['promised']!='1969-12-31')&&($const[0]['promised']!='')){ echo date("d M Y",strtotime($const[0]['promised'])); }?></td>
	   		<td class="cell"><?
	   		   switch($const[0]['stage']){
	   			case 1: echo 'Under construction';
	   					break;
	   			case 2: echo 'Near completion';
	   					break;
	   			case 3: echo 'Owner occupied';
	   					break;
	   		}
	   		?></td>
	   		<td class="cell"><? if($const[0]['delivered']==1){echo "Yes";?> (<?=date("d M Y",strtotime($const[0]['deliver_date']))?>)<?}?></td>
	   		<td class="cell"><?

	   		switch($const[0]['rental']){
	   			case 2: echo 'Prospect';
	   					break;
	   			case 3: echo 'Yes';
	   					break;
	   			case 4: echo 'No';
	   					break;
	   		}
	   		?></td>
	   		<td class="cell">
	   		 <?
               $link=new getQueries();
               $bo=$link->show_data($table='villas', $condition="`no` LIKE '".trim($k['no'])."'", $order='id');
               ?>
               <? if($bo[0]['able_r']==1){/*if found this villa and is rentable*/
                    $book=$link->bookings_construction($villa_id=$bo[0]['id'], $date=date('Y-m-d')); /* buscar disponibilidad o bookings*/

               		if($book){/*si encuentra bookings*/               			$stat="occupied";
               			$colo='#000000;';
               			$bg='yellow;';
               		}else{/*si no encuentra bookings*/
               			$stat="available";
               			$colo='#0925f6;';
               			$bg='transparent;';
               		}
               		?>
	        	  <a style="color:<?=$colo?> background-color:<?=$bg?>" href="availability.php?v=<?=$bo[0]['id']?>" targe="_blank" title="Bookings villa <?=$k['no']?>" id="bookings<?=$k['id']?>">
	               <? /*echo $bo[0]['p_high'];*/ echo $stat; /*print_r($book);*/?>
		   		  </a>
		   	   <?}?>
	   		</td>
	   		<td class="cell" align="center">

	   		<? if($maint[0]['title']){/*si encontre un mantenimiento para esta fecha y hora actual*/?>
	   		<a href="show_details.php?i=m&v=<?=$k['id']?>"  target="_blank" title="Maintenance villa <?=$k['no']?>" id="maintenance<?=$k['id']?>">
	   		<? switch($maint[0]['title']){	   			case 1: echo 'Renovation';
	   					break;
	   		    case 2:echo 'Repairing pool';
	   					break;
	   			case 3:echo 'Regular maintenance';
	   					break;
	   			case 4: echo 'Painting the house';
	   					break;
	   			case 5: echo 'Appliance repair';
	   					break;
	   			case 6: echo 'Roof filtration';
	   					break;
	   			case 7: echo 'Deep cleaning';
	   					break;	   		}?>
	   		<?}else{?>
	   		 &nbsp;
	   		<?}?>

	   		</a></td>
   		</tr>
   		<?   	}?>
   </table>
</div>