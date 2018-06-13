<? include('menu_CSS/menu-admin.php');?>

<?
$db=new getQueries();
include('inc/date-picker1.php');

if($_POST['desde']==''){	
	$nextMonday = strtotime('next Monday');	
}else{
	$nextMonday = strtotime($_POST['desde']);	
}

?>

	<form method="post" action="weekly_in_out.php" >
		 <p id="fields" style="text-align:center;">
         <span style="font-size:10px; color:red;"></span>Show from date:
		 <input type="text" name="desde" value="<?=date('Y-m-d',$nextMonday);?>" id="datepicker" size="10"/> <input class="book_but" type="submit" name="save" value="Show"/>
         <br/><span id="error_s"><?=$_GET['error']['desde']?></span><span style="font-size:10px; color:gray;">YYYY-MM-DD</span>
		 
        </p>
	</form>
	
	<p id="fields" style="text-align:right;"><a href="export_checkin-out.php?desde=<?=$nextMonday?>" target="_blank" alt="">Export to Excel</a></p>

<?php

$martes=strtotime('+1 day', $nextMonday);
$miercoles=strtotime('+2 day', $nextMonday);
$jueves=strtotime('+3 day', $nextMonday);
$viernes=strtotime('+4 day', $nextMonday);
$sabado=strtotime('+5 day', $nextMonday);
$domingo=strtotime('+6 day', $nextMonday);

$checkin1=$db->arriving_date_paid(date('Y-m-d',$nextMonday)); 
$checkin2=$db->arriving_date_paid(date('Y-m-d',$martes)); 
$checkin3=$db->arriving_date_paid(date('Y-m-d',$miercoles)); 
$checkin4=$db->arriving_date_paid(date('Y-m-d',$jueves)); 
$checkin5=$db->arriving_date_paid(date('Y-m-d',$viernes)); 
$checkin6=$db->arriving_date_paid(date('Y-m-d',$sabado)); 
$checkin7=$db->arriving_date_paid(date('Y-m-d',$domingo)); 
$max_checkin=max(count($checkin1),count($checkin2),count($checkin3),count($checkin4),count($checkin5),count($checkin6),count($checkin7));


$checkout1=$db->departuring_date_paid(date('Y-m-d',$nextMonday));
$checkout2=$db->departuring_date_paid(date('Y-m-d',$martes));
$checkout3=$db->departuring_date_paid(date('Y-m-d',$miercoles));
$checkout4=$db->departuring_date_paid(date('Y-m-d',$jueves));
$checkout5=$db->departuring_date_paid(date('Y-m-d',$viernes));
$checkout6=$db->departuring_date_paid(date('Y-m-d',$sabado));
$checkout7=$db->departuring_date_paid(date('Y-m-d',$domingo));
$max_checkout=max(count($checkout1),count($checkout2),count($checkout3),count($checkout4),count($checkout5),count($checkout6),count($checkout7));
 	?>
	<p>&nbsp;</p>
	
	

	
	<h3 style="text-align:center;">Checkin list</h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td"><?=date('d/m/Y',$nextMonday)?></td>
		<td id="td"><?=date('d/m/Y',$martes)?></td>
		<td id="td"><?=date('d/m/Y',$miercoles)?></td>
		<td id="td"><?=date('d/m/Y',$jueves)?></td>
		<td id="td"><?=date('d/m/Y',$viernes)?></td>
		<td id="td"><?=date('d/m/Y',$sabado)?></td>
		<td id="td"><?=date('d/m/Y',$domingo)?></td>
	</tr>
<?php
if($_POST['desde']==''){	
?>	
	<tr class="title">
		<td id="td">LUNES</td>
		<td id="td">MARTES</td>
		<td id="td">MIERCOLES</td>
		<td id="td">JUEVES</td>
		<td id="td">VIERNES</td>
		<td id="td">SABADO</td>
		<td id="td">DOMINGO</td>
	</tr>
	<?php
}
	$countin1=0;
	$countin2=0;
	$countin3=0;
	$countin4=0;
	$countin5=0;
	$countin6=0;
	$countin7=0;
	$countin8=0;
	
	for($i=0; $i<$max_checkin; $i++){
		$villa1=$db->villa($checkin1[$i]['villa']);
		$villa2=$db->villa($checkin2[$i]['villa']);
		$villa3=$db->villa($checkin3[$i]['villa']);
		$villa4=$db->villa($checkin4[$i]['villa']);
		$villa5=$db->villa($checkin5[$i]['villa']);
		$villa6=$db->villa($checkin6[$i]['villa']);
		$villa7=$db->villa($checkin7[$i]['villa']);
		
		
		?>
		<tr >
		<td id="td"><?php if ($villa1[0]['no']){ echo $villa1[0]['no']; echo "-".date('d/m',strtotime($checkin1[$i]['end'])); echo  "<br/>".ltrim($checkin1[$i]['ref'], '0'); $countin1+=1;}?></td>
		<td id="td"><?php if ($villa2[0]['no']){ echo $villa2[0]['no']; echo "-".date('d/m',strtotime($checkin2[$i]['end'])); echo  "<br/>".ltrim($checkin2[$i]['ref'], '0'); $countin2+=1;}?></td>
		<td id="td"><?php if ($villa3[0]['no']){ echo $villa3[0]['no']; echo "-".date('d/m',strtotime($checkin3[$i]['end'])); echo  "<br/>".ltrim($checkin3[$i]['ref'], '0'); $countin3+=1;}?></td>
		<td id="td"><?php if ($villa4[0]['no']){ echo $villa4[0]['no']; echo "-".date('d/m',strtotime($checkin4[$i]['end'])); echo  "<br/>".ltrim($checkin4[$i]['ref'], '0'); $countin4+=1;}?></td>
		<td id="td"><?php if ($villa5[0]['no']){ echo $villa5[0]['no']; echo "-".date('d/m',strtotime($checkin5[$i]['end'])); echo  "<br/>".ltrim($checkin5[$i]['ref'], '0'); $countin5+=1;}?></td>
		<td id="td"><?php if ($villa6[0]['no']){ echo $villa6[0]['no']; echo "-".date('d/m',strtotime($checkin6[$i]['end'])); echo  "<br/>".ltrim($checkin6[$i]['ref'], '0'); $countin6+=1;}?></td>
		<td id="td"><?php if ($villa7[0]['no']){ echo $villa7[0]['no']; echo "-".date('d/m',strtotime($checkin7[$i]['end'])); echo  "<br/>".ltrim($checkin7[$i]['ref'], '0'); $countin7+=1;}?></td>
	</tr>
		
	<?php }?>
	<tr class="title"><td colspan="7" align="center"><strong>Totals arriving</strong></td></tr>
	<tr>
		<td ><strong><?=$countin1?></strong></td>
		<td ><strong><?=$countin2?></strong></td>
		<td ><strong><?=$countin3?></strong></td>
		<td ><strong><?=$countin4?></strong></td>
		<td ><strong><?=$countin5?></strong></td>
		<td ><strong><?=$countin6?></strong></td>
		<td ><strong><?=$countin7?></strong></td>
	</tr>
</table>
<h3 style="text-align:center;">Checkout list</h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td"><?=date('d/m/Y',$nextMonday)?></td>
		<td id="td"><?=date('d/m/Y',$martes)?></td>
		<td id="td"><?=date('d/m/Y',$miercoles)?></td>
		<td id="td"><?=date('d/m/Y',$jueves)?></td>
		<td id="td"><?=date('d/m/Y',$viernes)?></td>
		<td id="td"><?=date('d/m/Y',$sabado)?></td>
		<td id="td"><?=date('d/m/Y',$domingo)?></td>
	</tr>
	<?php
if($_POST['desde']==''){	
?>	
	<tr class="title">
		<td id="td">LUNES</td>
		<td id="td">MARTES</td>
		<td id="td">MIERCOLES</td>
		<td id="td">JUEVES</td>
		<td id="td">VIERNES</td>
		<td id="td">SABADO</td>
		<td id="td">DOMINGO</td>
	</tr>
	
	<?php
}
	$countout1=0;
	$countout2=0;
	$countout3=0;
	$countout4=0;
	$countout5=0;
	$countout6=0;
	$countout7=0;
	$countout8=0;

	for($i=0; $i<$max_checkout; $i++){
		$villa11=$db->villa($checkout1[$i]['villa']);
		$villa12=$db->villa($checkout2[$i]['villa']);
		$villa13=$db->villa($checkout3[$i]['villa']);
		$villa14=$db->villa($checkout4[$i]['villa']);
		$villa15=$db->villa($checkout5[$i]['villa']);
		$villa16=$db->villa($checkout6[$i]['villa']);
		$villa17=$db->villa($checkout7[$i]['villa']);
		?>
		<tr >
		<td id="td"><?php if ($villa11[0]['no']){ echo $villa11[0]['no'];  $countout1+=1;}?></td>
		<td id="td"><?php if ($villa12[0]['no']){ echo $villa12[0]['no']; $countout2+=1;}?></td>
		<td id="td"><?php if ($villa13[0]['no']){ echo $villa13[0]['no']; $countout3+=1;}?></td>
		<td id="td"><?php if ($villa14[0]['no']){ echo $villa14[0]['no']; $countout4+=1;}?></td>
		<td id="td"><?php if ($villa15[0]['no']){ echo $villa15[0]['no']; $countout5+=1;}?></td>
		<td id="td"><?php if ($villa16[0]['no']){ echo $villa16[0]['no']; $countout6+=1;}?></td>
		<td id="td"><?php if ($villa17[0]['no']){ echo $villa17[0]['no']; $countout7+=1;}?></td>
	</tr>
		
	<?php }?>
	
	<tr class="title"><td colspan="7" align="center"><strong>Totals departuring</strong></td></tr>
	<tr>
		<td ><strong><?=$countout1?></strong></td>
		<td ><strong><?=$countout2?></strong></td>
		<td ><strong><?=$countout3?></strong></td>
		<td ><strong><?=$countout4?></strong></td>
		<td ><strong><?=$countout5?></strong></td>
		<td ><strong><?=$countout6?></strong></td>
		<td ><strong><?=$countout7?></strong></td>
	</tr>
</table>


	<h3 style="text-align:center;">Inhouse</h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td"><?=date('d/m/Y',$nextMonday)?></td>
		<td id="td"><?=date('d/m/Y',$martes)?></td>
		<td id="td"><?=date('d/m/Y',$miercoles)?></td>
		<td id="td"><?=date('d/m/Y',$jueves)?></td>
		<td id="td"><?=date('d/m/Y',$viernes)?></td>
		<td id="td"><?=date('d/m/Y',$sabado)?></td>
		<td id="td"><?=date('d/m/Y',$domingo)?></td>
	</tr>
<?php
if($_POST['desde']==''){	
?>	
	<tr class="title">
		<td id="td">LUNES</td>
		<td id="td">MARTES</td>
		<td id="td">MIERCOLES</td>
		<td id="td">JUEVES</td>
		<td id="td">VIERNES</td>
		<td id="td">SABADO</td>
		<td id="td">DOMINGO</td>
	</tr>
	<?php
}

$fecha_entrada=date('Y-m-d', $nextMonday);


	$inhouselu=count($db->inhouse_villas_paid($date=$fecha_entrada, $beds));
	$inhousema=count($db->inhouse_villas_paid($date2=date('Y-m-d',$martes), $beds));
	$inhousemi=count($db->inhouse_villas_paid($date3=date('Y-m-d',$miercoles), $beds));
	$inhouseju=count($db->inhouse_villas_paid($date4=date('Y-m-d',$jueves), $beds));
	$inhousevi=count($db->inhouse_villas_paid($date5=date('Y-m-d',$viernes), $beds));
	$inhousesa=count($db->inhouse_villas_paid($date6=date('Y-m-d',$sabado), $beds));
	$inhousedo=count($db->inhouse_villas_paid($date7=date('Y-m-d',$domingo), $beds));
	
	$Inhouse1=$db->inhouse_date_paid($date);
	$Inhouse2=$db->inhouse_date_paid($date2);
	$Inhouse3=$db->inhouse_date_paid($date3);
	$Inhouse4=$db->inhouse_date_paid($date4);
	$Inhouse5=$db->inhouse_date_paid($date5);
	$Inhouse6=$db->inhouse_date_paid($date6);
	$Inhouse7=$db->inhouse_date_paid($date7);
	
	/*$inhouselu=count($Inhouse1);
	$inhousema=count($Inhouse2);
	$inhousemi=count($Inhouse3);
	$inhouseju=count($Inhouse4);
	$inhousevi=count($Inhouse5);
	$inhousesa=count($Inhouse6);
	$inhousedo=count($Inhouse7);*/
	
	$max_inhouse=max(count($Inhouse1),count($Inhouse2),count($Inhouse3),count($Inhouse4),count($Inhouse5),count($Inhouse6),count($Inhouse7));
	
	
	for($i=0; $i<$max_inhouse; $i++){
		$v1=$db->villa($Inhouse1[$i]['villa']);
		$v2=$db->villa($Inhouse2[$i]['villa']);
		$v3=$db->villa($Inhouse3[$i]['villa']);
		$v4=$db->villa($Inhouse4[$i]['villa']);
		$v5=$db->villa($Inhouse5[$i]['villa']);
		$v6=$db->villa($Inhouse6[$i]['villa']);
		$v7=$db->villa($Inhouse7[$i]['villa']);
	?>
	<tr >
		<td id="td"><?php if ($v1[0]['no']){ echo $v1[0]['no'];}?></td>
		<td id="td"><?php if ($v2[0]['no']){ echo $v2[0]['no'];}?></td>
		<td id="td"><?php if ($v3[0]['no']){ echo $v3[0]['no'];}?></td>
		<td id="td"><?php if ($v4[0]['no']){ echo $v4[0]['no'];}?></td>
		<td id="td"><?php if ($v5[0]['no']){ echo $v5[0]['no'];}?></td>
		<td id="td"><?php if ($v6[0]['no']){ echo $v6[0]['no'];}?></td>
		<td id="td"><?php if ($v7[0]['no']){ echo $v7[0]['no'];}?></td>
	</tr>
	<?
	}
		?>

	<tr class="title"><td colspan="7" align="center"><strong>Totals Inhouse</strong></td></tr>
	<tr>
		<td ><strong><?=$inhouselu?></strong></td>
		<td ><strong><?=$inhousema?></strong></td>
		<td ><strong><?=$inhousemi?></strong></td>
		<td ><strong><?=$inhouseju?></strong></td>
		<td ><strong><?=$inhousevi?></strong></td>
		<td ><strong><?=$inhousesa?></strong></td>
		<td ><strong><?=$inhousedo?></strong></td>
	</tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<hr/>
<h1 style="text-align:center;">Booking list unpaid</h1>
<?php

$all_unpaid1=$db->weeklyList_all_unpaid(date('Y-m-d',$nextMonday));
$all_unpaid2=$db->weeklyList_all_unpaid(date('Y-m-d',$martes));
$all_unpaid3=$db->weeklyList_all_unpaid(date('Y-m-d',$miercoles));
$all_unpaid4=$db->weeklyList_all_unpaid(date('Y-m-d',$jueves));
$all_unpaid5=$db->weeklyList_all_unpaid(date('Y-m-d',$viernes));
$all_unpaid6=$db->weeklyList_all_unpaid(date('Y-m-d',$sabado));
$all_unpaid7=$db->weeklyList_all_unpaid(date('Y-m-d',$domingo));
$max_list=max(count($all_unpaid1),count($all_unpaid2),count($all_unpaid3),count($all_unpaid4),count($all_unpaid5),count($all_unpaid6),count($all_unpaid7));
 	?>
	<p>&nbsp;</p>
	
	

	
	<h3 style="text-align:center;">All booking without payment</h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td"><?=date('d/m/Y',$nextMonday)?></td>
		<td id="td"><?=date('d/m/Y',$martes)?></td>
		<td id="td"><?=date('d/m/Y',$miercoles)?></td>
		<td id="td"><?=date('d/m/Y',$jueves)?></td>
		<td id="td"><?=date('d/m/Y',$viernes)?></td>
		<td id="td"><?=date('d/m/Y',$sabado)?></td>
		<td id="td"><?=date('d/m/Y',$domingo)?></td>
	</tr>
<?php
if($_POST['desde']==''){	
?>	
	<tr class="title">
		<td id="td">LUNES</td>
		<td id="td">MARTES</td>
		<td id="td">MIERCOLES</td>
		<td id="td">JUEVES</td>
		<td id="td">VIERNES</td>
		<td id="td">SABADO</td>
		<td id="td">DOMINGO</td>
	</tr>
	<?php
}
	$countin1=0;
	$countin2=0;
	$countin3=0;
	$countin4=0;
	$countin5=0;
	$countin6=0;
	$countin7=0;
	$countin8=0;
	
	for($i=0; $i<$max_list; $i++){
		$villa1=$db->villa($all_unpaid1[$i]['villa']);
		$villa2=$db->villa($all_unpaid2[$i]['villa']);
		$villa3=$db->villa($all_unpaid3[$i]['villa']);
		$villa4=$db->villa($all_unpaid4[$i]['villa']);
		$villa5=$db->villa($all_unpaid5[$i]['villa']);
		$villa6=$db->villa($all_unpaid6[$i]['villa']);
		$villa7=$db->villa($all_unpaid7[$i]['villa']);
		
		
		?>
		<tr >
		<td id="td"><?php if ($villa1[0]['no']){ echo $villa1[0]['no']; echo "-".date('d/m',strtotime($all_unpaid1[$i]['end'])); echo  "<br/>".ltrim($all_unpaid1[$i]['ref'], '0'); $countin1+=1;}?></td>
		<td id="td"><?php if ($villa2[0]['no']){ echo $villa2[0]['no']; echo "-".date('d/m',strtotime($all_unpaid2[$i]['end'])); echo  "<br/>".ltrim($all_unpaid2[$i]['ref'], '0'); $countin2+=1;}?></td>
		<td id="td"><?php if ($villa3[0]['no']){ echo $villa3[0]['no']; echo "-".date('d/m',strtotime($all_unpaid3[$i]['end'])); echo  "<br/>".ltrim($all_unpaid3[$i]['ref'], '0'); $countin3+=1;}?></td>
		<td id="td"><?php if ($villa4[0]['no']){ echo $villa4[0]['no']; echo "-".date('d/m',strtotime($all_unpaid4[$i]['end'])); echo  "<br/>".ltrim($all_unpaid4[$i]['ref'], '0'); $countin4+=1;}?></td>
		<td id="td"><?php if ($villa5[0]['no']){ echo $villa5[0]['no']; echo "-".date('d/m',strtotime($all_unpaid5[$i]['end'])); echo  "<br/>".ltrim($all_unpaid5[$i]['ref'], '0'); $countin5+=1;}?></td>
		<td id="td"><?php if ($villa6[0]['no']){ echo $villa6[0]['no']; echo "-".date('d/m',strtotime($all_unpaid6[$i]['end'])); echo  "<br/>".ltrim($all_unpaid6[$i]['ref'], '0'); $countin6+=1;}?></td>
		<td id="td"><?php if ($villa7[0]['no']){ echo $villa7[0]['no']; echo "-".date('d/m',strtotime($all_unpaid7[$i]['end'])); echo  "<br/>".ltrim($all_unpaid7[$i]['ref'], '0'); $countin7+=1;}?></td>
	</tr>
		
	<?php }?>
	<tr class="title"><td colspan="7" align="center"><strong>Totals unpaid</strong></td></tr>
	<tr>
		<td ><strong><?=$countin1?></strong></td>
		<td ><strong><?=$countin2?></strong></td>
		<td ><strong><?=$countin3?></strong></td>
		<td ><strong><?=$countin4?></strong></td>
		<td ><strong><?=$countin5?></strong></td>
		<td ><strong><?=$countin6?></strong></td>
		<td ><strong><?=$countin7?></strong></td>
	</tr>
</table>


<?php
	/*echo $max_inhouse;
	echo "<pre>";
	print_r($Inhouse1);
	echo "</pre>";*/
	/*echo $fecha_entrada;
	$inhouse=$db->inhouse_villas($date=$fecha_entrada, $beds);
	echo "<br/>";
	echo count($inhouse);*/
	
	/*$inhouse2=$db->inhouse_villas($date=$fecha_entrada, $beds=2);
	echo "<br/> de dos: ";
	echo count($inhouse2);
	
	$inhouse3=$db->inhouse_villas($date=$fecha_entrada, $beds=3);
	echo "<br/> de tres: ";
	echo count($inhouse3);
	
	$inhouse4=$db->inhouse_villas($date=$fecha_entrada, $beds=4);
	echo "<br/> de cuatro: ";
	echo count($inhouse4);
	
	$inhouse5=$db->inhouse_villas($date=$fecha_entrada, $beds=5);
	echo "<br/> de cinco: ";
	echo count($inhouse5);
	
	
	$inhouse6=$db->inhouse_villas($date=$fecha_entrada, $beds=6);
	echo "<br/> de seais: ";
	echo count($inhouse6);*/
	//echo "<pre>";
	//print_r($inhouse);
	//echo "</pre>";
?>

