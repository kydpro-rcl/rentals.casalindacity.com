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
	<form method="post" action="labor_housekeeping.php" >
		 <p id="fields" style="text-align:center;">
         <span style="font-size:10px; color:red;"></span>Starting Date:
		 <input type="text" name="desde" value="<?=date('Y-m-d',$nextMonday);?>" id="datepicker" size="10"  /> <input class="book_but" type="submit" name="save" value="Go"/>
         <br/><span id="error_s"><?=$_GET['error']['desde']?></span><span style="font-size:10px; color:gray;">YYYY-MM-DD</span>
		 
        </p>
	</form>

<?php

$martes=strtotime('+1 day', $nextMonday);
$miercoles=strtotime('+2 day', $nextMonday);
$jueves=strtotime('+3 day', $nextMonday);
$viernes=strtotime('+4 day', $nextMonday);
$sabado=strtotime('+5 day', $nextMonday);
$domingo=strtotime('+6 day', $nextMonday);

 ?>
	
<?php
/*if($_POST['desde']==''){*/	
?>	
	<h1 style="text-align:center;">Inhouse Details</h1>
	<p>&nbsp;</p>
	<h3 style="text-align:center;">Checkout </h3>
	<table cellpadding="2" cellspacing="0" align="center" border=1>
		<tr class="title" style="background-color:yellow">
			<td id="td">&nbsp;</td>
			<td id="td"><?=date('d/m/Y',$nextMonday)?></td>
			<td id="td"><?=date('d/m/Y',$martes)?></td>
			<td id="td"><?=date('d/m/Y',$miercoles)?></td>
			<td id="td"><?=date('d/m/Y',$jueves)?></td>
			<td id="td"><?=date('d/m/Y',$viernes)?></td>
			<td id="td"><?=date('d/m/Y',$sabado)?></td>
			<td id="td"><?=date('d/m/Y',$domingo)?></td>
		</tr>

		<tr class="title" style="background-color:yellow">
			<td id="td">&nbsp;</td>
			<td id="td">LUNES</td>
			<td id="td">MARTES</td>
			<td id="td">MIERCOLES</td>
			<td id="td">JUEVES</td>
			<td id="td">VIERNES</td>
			<td id="td">SABADO</td>
			<td id="td">DOMINGO</td>
		</tr>
		
		<?php
			$ckoutlu2=count($db->inhouse_ckout($date=date('Y-m-d',$nextMonday), $beds=2));
			$ckoutma2=count($db->inhouse_ckout($date=date('Y-m-d',$martes), $beds=2));
			$ckoutmi2=count($db->inhouse_ckout($date=date('Y-m-d',$miercoles), $beds=2));
			$ckoutju2=count($db->inhouse_ckout($date=date('Y-m-d',$jueves), $beds=2));
			$ckoutvi2=count($db->inhouse_ckout($date=date('Y-m-d',$viernes), $beds=2));
			$ckoutsa2=count($db->inhouse_ckout($date=date('Y-m-d',$sabado), $beds=2));
			$ckoutdo2=count($db->inhouse_ckout($date=date('Y-m-d',$domingo), $beds=2));
		?>
		<tr>
			<td >2 Bdrs</td>
			<td ><?=$ckoutlu2?></td>
			<td ><?=$ckoutma2?></td>
			<td ><?=$ckoutmi2?></td>
			<td ><?=$ckoutju2?></td>
			<td ><?=$ckoutvi2?></td>
			<td ><?=$ckoutsa2?></td>
			<td ><?=$ckoutdo2?></td>
		</tr>
		<?php
			$ckoutlu3=count($db->inhouse_ckout($date=date('Y-m-d',$nextMonday), $beds=3));
			$ckoutma3=count($db->inhouse_ckout($date=date('Y-m-d',$martes), $beds=3));
			$ckoutmi3=count($db->inhouse_ckout($date=date('Y-m-d',$miercoles), $beds=3));
			$ckoutju3=count($db->inhouse_ckout($date=date('Y-m-d',$jueves), $beds=3));
			$ckoutvi3=count($db->inhouse_ckout($date=date('Y-m-d',$viernes), $beds=3));
			$ckoutsa3=count($db->inhouse_ckout($date=date('Y-m-d',$sabado), $beds=3));
			$ckoutdo3=count($db->inhouse_ckout($date=date('Y-m-d',$domingo), $beds=3));
		?>
		<tr>
			<td >3 Bdrs</td>
			<td ><?=$ckoutlu3?></td>
			<td ><?=$ckoutma3?></td>
			<td ><?=$ckoutmi3?></td>
			<td ><?=$ckoutju3?></td>
			<td ><?=$ckoutvi3?></td>
			<td ><?=$ckoutsa3?></td>
			<td ><?=$ckoutdo3?></td>
		</tr>
		<?php
			$ckoutlu4=count($db->inhouse_ckout($date=date('Y-m-d',$nextMonday), $beds=4));
			$ckoutma4=count($db->inhouse_ckout($date=date('Y-m-d',$martes), $beds=4));
			$ckoutmi4=count($db->inhouse_ckout($date=date('Y-m-d',$miercoles), $beds=4));
			$ckoutju4=count($db->inhouse_ckout($date=date('Y-m-d',$jueves), $beds=4));
			$ckoutvi4=count($db->inhouse_ckout($date=date('Y-m-d',$viernes), $beds=4));
			$ckoutsa4=count($db->inhouse_ckout($date=date('Y-m-d',$sabado), $beds=4));
			$ckoutdo4=count($db->inhouse_ckout($date=date('Y-m-d',$domingo), $beds=4));
		?>
		<tr>
			<td >4 Bdrs</td>
			<td ><?=$ckoutlu4?></td>
			<td ><?=$ckoutma4?></td>
			<td ><?=$ckoutmi4?></td>
			<td ><?=$ckoutju4?></td>
			<td ><?=$ckoutvi4?></td>
			<td ><?=$ckoutsa4?></td>
			<td ><?=$ckoutdo4?></td>
		</tr>
		<?php
			$ckoutlu5=count($db->inhouse_ckout($date=date('Y-m-d',$nextMonday), $beds=5));
			$ckoutma5=count($db->inhouse_ckout($date=date('Y-m-d',$martes), $beds=5));
			$ckoutmi5=count($db->inhouse_ckout($date=date('Y-m-d',$miercoles), $beds=5));
			$ckoutju5=count($db->inhouse_ckout($date=date('Y-m-d',$jueves), $beds=5));
			$ckoutvi5=count($db->inhouse_ckout($date=date('Y-m-d',$viernes), $beds=5));
			$ckoutsa5=count($db->inhouse_ckout($date=date('Y-m-d',$sabado), $beds=5));
			$ckoutdo5=count($db->inhouse_ckout($date=date('Y-m-d',$domingo), $beds=5));
		?>
		<tr>
			<td >5 Bdrs</td>
			<td ><?=$ckoutlu5?></td>
			<td ><?=$ckoutma5?></td>
			<td ><?=$ckoutmi5?></td>
			<td ><?=$ckoutju5?></td>
			<td ><?=$ckoutvi5?></td>
			<td ><?=$ckoutsa5?></td>
			<td ><?=$ckoutdo5?></td>
		</tr>
		
		<?php
			$ckoutlu6=count($db->inhouse_ckout($date=date('Y-m-d',$nextMonday), $beds=6));
			$ckoutma6=count($db->inhouse_ckout($date=date('Y-m-d',$martes), $beds=6));
			$ckoutmi6=count($db->inhouse_ckout($date=date('Y-m-d',$miercoles), $beds=6));
			$ckoutju6=count($db->inhouse_ckout($date=date('Y-m-d',$jueves), $beds=6));
			$ckoutvi6=count($db->inhouse_ckout($date=date('Y-m-d',$viernes), $beds=6));
			$ckoutsa6=count($db->inhouse_ckout($date=date('Y-m-d',$sabado), $beds=6));
			$ckoutdo6=count($db->inhouse_ckout($date=date('Y-m-d',$domingo), $beds=6));
		?>
		<tr>
			<td >6 Bdrs</td>
			<td ><?=$ckoutlu6?></td>
			<td ><?=$ckoutma6?></td>
			<td ><?=$ckoutmi6?></td>
			<td ><?=$ckoutju6?></td>
			<td ><?=$ckoutvi6?></td>
			<td ><?=$ckoutsa6?></td>
			<td ><?=$ckoutdo6?></td>
		</tr>
		
		<?php
			$fecha_entrada=date('Y-m-d', $nextMonday);
			$ckoutlu=count($db->inhouse_ckout($date=$fecha_entrada, $beds=10));
			$ckoutma=count($db->inhouse_ckout($date=date('Y-m-d',$martes), $beds));
			$ckoutmi=count($db->inhouse_ckout($date=date('Y-m-d',$miercoles), $beds));
			$ckoutju=count($db->inhouse_ckout($date=date('Y-m-d',$jueves), $beds));
			$ckoutvi=count($db->inhouse_ckout($date=date('Y-m-d',$viernes), $beds));
			$ckoutsa=count($db->inhouse_ckout($date=date('Y-m-d',$sabado), $beds));
			$ckoutdo=count($db->inhouse_ckout($date=date('Y-m-d',$domingo), $beds));
		?>
		<tr>
			<td ><strong>Totals</strong></td>
			<td ><strong><?=$ckoutlu?> </strong></td>
			<td ><strong><?=$ckoutma?> </strong></td>
			<td ><strong><?=$ckoutmi?> </strong></td>
			<td ><strong><?=$ckoutju?> </strong></td>
			<td ><strong><?=$ckoutvi?> </strong></td>
			<td ><strong><?=$ckoutsa?> </strong></td>
			<td ><strong><?=$ckoutdo?> </strong></td>
		</tr>
		<?php
		$ve=1;
		$cktimelu=($ckoutlu2*(45*$ve))+($ckoutlu3*(60*$ve))+($ckoutlu4*(90*$ve))+($ckoutlu5*(120*$ve))+($ckoutlu6*(130*$ve));
		$ckemplu=($cktimelu/370);
		
		$cktimema=($ckoutma2*(45*$ve))+($ckoutma3*(60*$ve))+($ckoutma4*(90*$ve))+($ckoutma5*(120*$ve))+($ckoutma6*(130*$ve));
		$ckempma=($cktimema/370);
		
		$cktimemi=($ckoutmi2*(45*$ve))+($ckoutmi3*(60*$ve))+($ckoutmi4*(90*$ve))+($ckoutmi5*(120*$ve))+($ckoutmi6*(130*$ve));
		$ckempmi=($cktimemi/370);
		
		$cktimeju=($ckoutju2*(45*$ve))+($ckoutju3*(60*$ve))+($ckoutju4*(90*$ve))+($ckoutju5*(120*$ve))+($ckoutju6*(130*$ve));
		$ckempju=($cktimeju/370);
		
		$cktimevi=($ckoutvi2*(45*$ve))+($ckoutvi3*(60*$ve))+($ckoutvi4*(90*$ve))+($ckoutvi5*(120*$ve))+($ckoutvi6*(130*$ve));
		$ckempvi=($cktimelu/370);
		
		$cktimesa=($ckoutsa2*(45*$ve))+($ckoutsa3*(60*$ve))+($ckoutsa4*(90*$ve))+($ckoutsa5*(120*$ve))+($ckoutsa6*(130*$ve));
		$ckempsa=($cktimesa/370);
		
		$cktimedo=($ckoutdo2*(45*$ve))+($ckoutdo3*(60*$ve))+($ckoutdo4*(90*$ve))+($ckoutdo5*(120*$ve))+($ckoutdo6*(130*$ve));
		$ckempdo=($cktimedo/370);
		
		?>
		<tr>
			<td ><strong>Labor time</strong></td>
			<td ><strong><?=$cktimelu?></strong></td>
			<td ><strong><?=$cktimema?></strong></td>
			<td ><strong><?=$cktimemi?></strong></td>
			<td ><strong><?=$cktimeju?></strong></td>
			<td ><strong><?=$cktimevi?></strong></td>
			<td ><strong><?=$cktimesa?></strong></td>
			<td ><strong><?=$cktimedo?></strong></td>
		</tr>
		<tr>
			<td ><strong>Employees</strong></td>
			<td ><strong><?=number_format($ckemplu,1)?></strong></td>
			<td ><strong><?=number_format($ckempma,1)?></strong></td>
			<td ><strong><?=number_format($ckempmi,1)?></strong></td>
			<td ><strong><?=number_format($ckempju,1)?></strong></td>
			<td ><strong><?=number_format($ckempvi,1)?></strong></td>
			<td ><strong><?=number_format($ckempsa,1)?></strong></td>
			<td ><strong><?=number_format($ckempdo,1)?></strong></td>
		</tr>
	</table>
	
	<h3 style="text-align:center;">Arrivals Details</h3>
	<table cellpadding="2" cellspacing="0" align="center" border=1>
		<tr class="title">
			<td id="td">&nbsp;</td>
			<td id="td"><?=date('d/m/Y',$nextMonday)?></td>
			<td id="td"><?=date('d/m/Y',$martes)?></td>
			<td id="td"><?=date('d/m/Y',$miercoles)?></td>
			<td id="td"><?=date('d/m/Y',$jueves)?></td>
			<td id="td"><?=date('d/m/Y',$viernes)?></td>
			<td id="td"><?=date('d/m/Y',$sabado)?></td>
			<td id="td"><?=date('d/m/Y',$domingo)?></td>
		</tr>

		<tr class="title">
			<td id="td">&nbsp;</td>
			<td id="td">LUNES</td>
			<td id="td">MARTES</td>
			<td id="td">MIERCOLES</td>
			<td id="td">JUEVES</td>
			<td id="td">VIERNES</td>
			<td id="td">SABADO</td>
			<td id="td">DOMINGO</td>
		</tr>
		
		<?php
			$arrlu2=count($db->inhouse_arrivals($date=date('Y-m-d',$nextMonday), $beds=2));
			$arrma2=count($db->inhouse_arrivals($date=date('Y-m-d',$martes), $beds=2));
			$arrmi2=count($db->inhouse_arrivals($date=date('Y-m-d',$miercoles), $beds=2));
			$arrju2=count($db->inhouse_arrivals($date=date('Y-m-d',$jueves), $beds=2));
			$arrvi2=count($db->inhouse_arrivals($date=date('Y-m-d',$viernes), $beds=2));
			$arrsa2=count($db->inhouse_arrivals($date=date('Y-m-d',$sabado), $beds=2));
			$arrdo2=count($db->inhouse_arrivals($date=date('Y-m-d',$domingo), $beds=2));
		?>
		<tr>
			<td >2 Bdrs</td>
			<td ><?=$arrlu2?></td>
			<td ><?=$arrma2?></td>
			<td ><?=$arrmi2?></td>
			<td ><?=$arrju2?></td>
			<td ><?=$arrvi2?></td>
			<td ><?=$arrsa2?></td>
			<td ><?=$arrdo2?></td>
		</tr>
		<?php
			$arrlu3=count($db->inhouse_arrivals($date=date('Y-m-d',$nextMonday), $beds=3));
			$arrma3=count($db->inhouse_arrivals($date=date('Y-m-d',$martes), $beds=3));
			$arrmi3=count($db->inhouse_arrivals($date=date('Y-m-d',$miercoles), $beds=3));
			$arrju3=count($db->inhouse_arrivals($date=date('Y-m-d',$jueves), $beds=3));
			$arrvi3=count($db->inhouse_arrivals($date=date('Y-m-d',$viernes), $beds=3));
			$arrsa3=count($db->inhouse_arrivals($date=date('Y-m-d',$sabado), $beds=3));
			$arrdo3=count($db->inhouse_arrivals($date=date('Y-m-d',$domingo), $beds=3));
		?>
		<tr>
			<td >3 Bdrs</td>
			<td ><?=$arrlu3?></td>
			<td ><?=$arrma3?></td>
			<td ><?=$arrmi3?></td>
			<td ><?=$arrju3?></td>
			<td ><?=$arrvi3?></td>
			<td ><?=$arrsa3?></td>
			<td ><?=$arrdo3?></td>
		</tr>
		<?php
			$arrlu4=count($db->inhouse_arrivals($date=date('Y-m-d',$nextMonday), $beds=4));
			$arrma4=count($db->inhouse_arrivals($date=date('Y-m-d',$martes), $beds=4));
			$arrmi4=count($db->inhouse_arrivals($date=date('Y-m-d',$miercoles), $beds=4));
			$arrju4=count($db->inhouse_arrivals($date=date('Y-m-d',$jueves), $beds=4));
			$arrvi4=count($db->inhouse_arrivals($date=date('Y-m-d',$viernes), $beds=4));
			$arrsa4=count($db->inhouse_arrivals($date=date('Y-m-d',$sabado), $beds=4));
			$arrdo4=count($db->inhouse_arrivals($date=date('Y-m-d',$domingo), $beds=4));
		?>
		<tr>
			<td >4 Bdrs</td>
			<td ><?=$arrlu4?></td>
			<td ><?=$arrma4?></td>
			<td ><?=$arrmi4?></td>
			<td ><?=$arrju4?></td>
			<td ><?=$arrvi4?></td>
			<td ><?=$arrsa4?></td>
			<td ><?=$arrdo4?></td>
		</tr>
		<?php
			$arrlu5=count($db->inhouse_arrivals($date=date('Y-m-d',$nextMonday), $beds=5));
			$arrma5=count($db->inhouse_arrivals($date=date('Y-m-d',$martes), $beds=5));
			$arrmi5=count($db->inhouse_arrivals($date=date('Y-m-d',$miercoles), $beds=5));
			$arrju5=count($db->inhouse_arrivals($date=date('Y-m-d',$jueves), $beds=5));
			$arrvi5=count($db->inhouse_arrivals($date=date('Y-m-d',$viernes), $beds=5));
			$arrsa5=count($db->inhouse_arrivals($date=date('Y-m-d',$sabado), $beds=5));
			$arrdo5=count($db->inhouse_arrivals($date=date('Y-m-d',$domingo), $beds=5));
		?>
		<tr>
			<td >5 Bdrs</td>
			<td ><?=$arrlu5?></td>
			<td ><?=$arrma5?></td>
			<td ><?=$arrmi5?></td>
			<td ><?=$arrju5?></td>
			<td ><?=$arrvi5?></td>
			<td ><?=$arrsa5?></td>
			<td ><?=$arrdo5?></td>
		</tr>
		
		<?php
			$arrlu6=count($db->inhouse_arrivals($date=date('Y-m-d',$nextMonday), $beds=6));
			$arrma6=count($db->inhouse_arrivals($date=date('Y-m-d',$martes), $beds=6));
			$arrmi6=count($db->inhouse_arrivals($date=date('Y-m-d',$miercoles), $beds=6));
			$arrju6=count($db->inhouse_arrivals($date=date('Y-m-d',$jueves), $beds=6));
			$arrvi6=count($db->inhouse_arrivals($date=date('Y-m-d',$viernes), $beds=6));
			$arrsa6=count($db->inhouse_arrivals($date=date('Y-m-d',$sabado), $beds=6));
			$arrdo6=count($db->inhouse_arrivals($date=date('Y-m-d',$domingo), $beds=6));
		?>
		<tr>
			<td >6 Bdrs</td>
			<td ><?=$arrlu6?></td>
			<td ><?=$arrma6?></td>
			<td ><?=$arrmi6?></td>
			<td ><?=$arrju6?></td>
			<td ><?=$arrvi6?></td>
			<td ><?=$arrsa6?></td>
			<td ><?=$arrdo6?></td>
		</tr>
		
		<?php
			$arrlu=count($db->inhouse_arrivals($date=date('Y-m-d',$nextMonday), $beds=10));
			$arrma=count($db->inhouse_arrivals($date=date('Y-m-d',$martes), $beds=10));
			$arrmi=count($db->inhouse_arrivals($date=date('Y-m-d',$miercoles), $beds=10));
			$arrju=count($db->inhouse_arrivals($date=date('Y-m-d',$jueves), $beds=10));
			$arrvi=count($db->inhouse_arrivals($date=date('Y-m-d',$viernes), $beds=10));
			$arrsa=count($db->inhouse_arrivals($date=date('Y-m-d',$sabado), $beds=10));
			$arrdo=count($db->inhouse_arrivals($date=date('Y-m-d',$domingo), $beds=10));
		?>

		
		<tr>
			<td ><strong>Totals</strong></td>
			<td ><strong><?=$arrlu?> </strong></td>
			<td ><strong><?=$arrma?> </strong></td>
			<td ><strong><?=$arrmi?> </strong></td>
			<td ><strong><?=$arrju?> </strong></td>
			<td ><strong><?=$arrvi?> </strong></td>
			<td ><strong><?=$arrsa?> </strong></td>
			<td ><strong><?=$arrdo?> </strong></td>
		</tr>
		<?php
		$arrtimelu=($arrlu2*(45*$ve))+($arrlu3*(60*$ve))+($arrlu4*(90*$ve))+($arrlu5*(120*$ve))+($arrlu6*(130*$ve));
		$arremplu=($arrtimelu/370);
		
		$arrtimema=($arrma2*(45*$ve))+($arrma3*(60*$ve))+($arrma4*(90*$ve))+($arrma5*(120*$ve))+($arrma6*(130*$ve));
		$arrempma=($arrtimema/370);
		
		$arrtimemi=($arrmi2*(45*$ve))+($arrmi3*(60*$ve))+($arrmi4*(90*$ve))+($arrmi5*(120*$ve))+($arrmi6*(130*$ve));
		$arrempmi=($arrtimemi/370);
		
		$arrtimeju=($arrju2*(45*$ve))+($arrju3*(60*$ve))+($arrju4*(90*$ve))+($arrju5*(120*$ve))+($arrju6*(130*$ve));
		$arrempju=($arrtimeju/370);
		
		$arrtimevi=($arrvi2*(45*$ve))+($arrvi3*(60*$ve))+($arrvi4*(90*$ve))+($arrvi5*(120*$ve))+($arrvi6*(130*$ve));
		$arrempvi=($arrtimelu/370);
		
		$arrtimesa=($arrsa2*(45*$ve))+($arrsa3*(60*$ve))+($arrsa4*(90*$ve))+($arrsa5*(120*$ve))+($arrsa6*(130*$ve));
		$arrempsa=($arrtimesa/370);
		
		$arrtimedo=($arrdo2*(45*$ve))+($arrdo3*(60*$ve))+($arrdo4*(90*$ve))+($arrdo5*(120*$ve))+($arrdo6*(130*$ve));
		$arrempdo=($arrtimedo/370);
		
		?>
		<tr>
			<td ><strong>Labor time</strong></td>
			<td ><strong><?=$arrtimelu?></strong></td>
			<td ><strong><?=$arrtimema?></strong></td>
			<td ><strong><?=$arrtimemi?></strong></td>
			<td ><strong><?=$arrtimeju?></strong></td>
			<td ><strong><?=$arrtimevi?></strong></td>
			<td ><strong><?=$arrtimesa?></strong></td>
			<td ><strong><?=$arrtimedo?></strong></td>
		</tr>
		<tr>
			<td ><strong>Employees</strong></td>
			<td ><strong><?=number_format($arremplu,1)?></strong></td>
			<td ><strong><?=number_format($arrempma,1)?></strong></td>
			<td ><strong><?=number_format($arrempmi,1)?></strong></td>
			<td ><strong><?=number_format($arrempju,1)?></strong></td>
			<td ><strong><?=number_format($arrempvi,1)?></strong></td>
			<td ><strong><?=number_format($arrempsa,1)?></strong></td>
			<td ><strong><?=number_format($arrempdo,1)?></strong></td>
		</tr>
	</table>
	
	
	<h3 style="text-align:center;">Stay over</h3>
	<table cellpadding="2" cellspacing="0" align="center" border=1>
		<tr class="title" style="background-color:green; color: white;">
			<td id="td">&nbsp;</td>
			<td id="td"><?=date('d/m/Y',$nextMonday)?></td>
			<td id="td"><?=date('d/m/Y',$martes)?></td>
			<td id="td"><?=date('d/m/Y',$miercoles)?></td>
			<td id="td"><?=date('d/m/Y',$jueves)?></td>
			<td id="td"><?=date('d/m/Y',$viernes)?></td>
			<td id="td"><?=date('d/m/Y',$sabado)?></td>
			<td id="td"><?=date('d/m/Y',$domingo)?></td>
		</tr>

		<tr class="title" style="background-color:green; color: white;">
			<td id="td">&nbsp;</td>
			<td id="td">LUNES</td>
			<td id="td">MARTES</td>
			<td id="td">MIERCOLES</td>
			<td id="td">JUEVES</td>
			<td id="td">VIERNES</td>
			<td id="td">SABADO</td>
			<td id="td">DOMINGO</td>
		</tr>
		
		<?php
			$overlu2=count($db->inhouse_stayover($date=date('Y-m-d',$nextMonday), $beds=2));
			$overma2=count($db->inhouse_stayover($date=date('Y-m-d',$martes), $beds=2));
			$overmi2=count($db->inhouse_stayover($date=date('Y-m-d',$miercoles), $beds=2));
			$overju2=count($db->inhouse_stayover($date=date('Y-m-d',$jueves), $beds=2));
			$overvi2=count($db->inhouse_stayover($date=date('Y-m-d',$viernes), $beds=2));
			$oversa2=count($db->inhouse_stayover($date=date('Y-m-d',$sabado), $beds=2));
			$overdo2=count($db->inhouse_stayover($date=date('Y-m-d',$domingo), $beds=2));
		?>
		<tr>
			<td >2 Bdrs</td>
			<td ><?=$overlu2?></td>
			<td ><?=$overma2?></td>
			<td ><?=$overmi2?></td>
			<td ><?=$overju2?></td>
			<td ><?=$overvi2?></td>
			<td ><?=$oversa2?></td>
			<td ><?=$overdo2?></td>
		</tr>
		<?php
			$overlu3=count($db->inhouse_stayover($date=date('Y-m-d',$nextMonday), $beds=3));
			$overma3=count($db->inhouse_stayover($date=date('Y-m-d',$martes), $beds=3));
			$overmi3=count($db->inhouse_stayover($date=date('Y-m-d',$miercoles), $beds=3));
			$overju3=count($db->inhouse_stayover($date=date('Y-m-d',$jueves), $beds=3));
			$overvi3=count($db->inhouse_stayover($date=date('Y-m-d',$viernes), $beds=3));
			$oversa3=count($db->inhouse_stayover($date=date('Y-m-d',$sabado), $beds=3));
			$overdo3=count($db->inhouse_stayover($date=date('Y-m-d',$domingo), $beds=3));
		?>
		<tr>
			<td >3 Bdrs</td>
			<td ><?=$overlu3?></td>
			<td ><?=$overma3?></td>
			<td ><?=$overmi3?></td>
			<td ><?=$overju3?></td>
			<td ><?=$overvi3?></td>
			<td ><?=$oversa3?></td>
			<td ><?=$overdo3?></td>
		</tr>
		<?php
			$overlu4=count($db->inhouse_stayover($date=date('Y-m-d',$nextMonday), $beds=4));
			$overma4=count($db->inhouse_stayover($date=date('Y-m-d',$martes), $beds=4));
			$overmi4=count($db->inhouse_stayover($date=date('Y-m-d',$miercoles), $beds=4));
			$overju4=count($db->inhouse_stayover($date=date('Y-m-d',$jueves), $beds=4));
			$overvi4=count($db->inhouse_stayover($date=date('Y-m-d',$viernes), $beds=4));
			$oversa4=count($db->inhouse_stayover($date=date('Y-m-d',$sabado), $beds=4));
			$overdo4=count($db->inhouse_stayover($date=date('Y-m-d',$domingo), $beds=4));
		?>
		<tr>
			<td >4 Bdrs</td>
			<td ><?=$overlu4?></td>
			<td ><?=$overma4?></td>
			<td ><?=$overmi4?></td>
			<td ><?=$overju4?></td>
			<td ><?=$overvi4?></td>
			<td ><?=$oversa4?></td>
			<td ><?=$overdo4?></td>
		</tr>
		<?php
			$overlu5=count($db->inhouse_stayover($date=date('Y-m-d',$nextMonday), $beds=5));
			$overma5=count($db->inhouse_stayover($date=date('Y-m-d',$martes), $beds=5));
			$overmi5=count($db->inhouse_stayover($date=date('Y-m-d',$miercoles), $beds=5));
			$overju5=count($db->inhouse_stayover($date=date('Y-m-d',$jueves), $beds=5));
			$overvi5=count($db->inhouse_stayover($date=date('Y-m-d',$viernes), $beds=5));
			$oversa5=count($db->inhouse_stayover($date=date('Y-m-d',$sabado), $beds=5));
			$overdo5=count($db->inhouse_stayover($date=date('Y-m-d',$domingo), $beds=5));
		?>
		<tr>
			<td >5 Bdrs</td>
			<td ><?=$overlu5?></td>
			<td ><?=$overma5?></td>
			<td ><?=$overmi5?></td>
			<td ><?=$overju5?></td>
			<td ><?=$overvi5?></td>
			<td ><?=$oversa5?></td>
			<td ><?=$overdo5?></td>
		</tr>
		
		<?php
			$overlu6=count($db->inhouse_stayover($date=date('Y-m-d',$nextMonday), $beds=6));
			$overma6=count($db->inhouse_stayover($date=date('Y-m-d',$martes), $beds=6));
			$overmi6=count($db->inhouse_stayover($date=date('Y-m-d',$miercoles), $beds=6));
			$overju6=count($db->inhouse_stayover($date=date('Y-m-d',$jueves), $beds=6));
			$overvi6=count($db->inhouse_stayover($date=date('Y-m-d',$viernes), $beds=6));
			$oversa6=count($db->inhouse_stayover($date=date('Y-m-d',$sabado), $beds=6));
			$overdo6=count($db->inhouse_stayover($date=date('Y-m-d',$domingo), $beds=6));
		?>
		<tr>
			<td >6 Bdrs</td>
			<td ><?=$overlu6?></td>
			<td ><?=$overma6?></td>
			<td ><?=$overmi6?></td>
			<td ><?=$overju6?></td>
			<td ><?=$overvi6?></td>
			<td ><?=$oversa6?></td>
			<td ><?=$overdo6?></td>
		</tr>
		
		<?php
			$overlu=count($db->inhouse_stayover($date=date('Y-m-d',$nextMonday), $beds=10));
			$overma=count($db->inhouse_stayover($date=date('Y-m-d',$martes), $beds=10));
			$overmi=count($db->inhouse_stayover($date=date('Y-m-d',$miercoles), $beds=10));
			$overju=count($db->inhouse_stayover($date=date('Y-m-d',$jueves), $beds=10));
			$overvi=count($db->inhouse_stayover($date=date('Y-m-d',$viernes), $beds=10));
			$oversa=count($db->inhouse_stayover($date=date('Y-m-d',$sabado), $beds=10));
			$overdo=count($db->inhouse_stayover($date=date('Y-m-d',$domingo), $beds=10));
		?>
		<tr>
			<td ><strong>Totals</strong></td>
			<td ><strong><?=$overlu?> </strong></td>
			<td ><strong><?=$overma?> </strong></td>
			<td ><strong><?=$overmi?> </strong></td>
			<td ><strong><?=$overju?> </strong></td>
			<td ><strong><?=$overvi?> </strong></td>
			<td ><strong><?=$oversa?> </strong></td>
			<td ><strong><?=$overdo?> </strong></td>
		</tr>
		<?php
		
		$overtimelu=($overlu2*(45*$ve))+($overlu3*(60*$ve))+($overlu4*(90*$ve))+($overlu5*(120*$ve))+($overlu6*(130*$ve));
		$overemplu=($overtimelu/370);
		
		$overtimema=($overma2*(45*$ve))+($overma3*(60*$ve))+($overma4*(90*$ve))+($overma5*(120*$ve))+($overma6*(130*$ve));
		$overempma=($overtimema/370);
		
		$overtimemi=($overmi2*(45*$ve))+($overmi3*(60*$ve))+($overmi4*(90*$ve))+($overmi5*(120*$ve))+($overmi6*(130*$ve));
		$overempmi=($overtimemi/370);
		
		$overtimeju=($overju2*(45*$ve))+($overju3*(60*$ve))+($overju4*(90*$ve))+($overju5*(120*$ve))+($overju6*(130*$ve));
		$overempju=($overtimeju/370);
		
		$overtimevi=($overvi2*(45*$ve))+($overvi3*(60*$ve))+($overvi4*(90*$ve))+($overvi5*(120*$ve))+($overvi6*(130*$ve));
		$overempvi=($overtimelu/370);
		
		$overtimesa=($oversa2*(45*$ve))+($oversa3*(60*$ve))+($oversa4*(90*$ve))+($oversa5*(120*$ve))+($oversa6*(130*$ve));
		$overempsa=($overtimesa/370);
		
		$overtimedo=($overdo2*(45*$ve))+($overdo3*(60*$ve))+($overdo4*(90*$ve))+($overdo5*(120*$ve))+($overdo6*(130*$ve));
		$overempdo=($overtimedo/370);
		
		?>
		<tr>
			<td ><strong>Labor time</strong></td>
			<td ><strong><?=$overtimelu?></strong></td>
			<td ><strong><?=$overtimema?></strong></td>
			<td ><strong><?=$overtimemi?></strong></td>
			<td ><strong><?=$overtimeju?></strong></td>
			<td ><strong><?=$overtimevi?></strong></td>
			<td ><strong><?=$overtimesa?></strong></td>
			<td ><strong><?=$overtimedo?></strong></td>
		</tr>
		<tr>
			<td ><strong>Employees</strong></td>
			<td ><strong><?=number_format($overemplu,1)?></strong></td>
			<td ><strong><?=number_format($overempma,1)?></strong></td>
			<td ><strong><?=number_format($overempmi,1)?></strong></td>
			<td ><strong><?=number_format($overempju,1)?></strong></td>
			<td ><strong><?=number_format($overempvi,1)?></strong></td>
			<td ><strong><?=number_format($overempsa,1)?></strong></td>
			<td ><strong><?=number_format($overempdo,1)?></strong></td>
		</tr>
	</table>
	
	
	
	
	
<h3 style="text-align:center;">Inhouse</h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td">&nbsp;</td>
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
		<td id="td">&nbsp;</td>
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

	$inhouselu=count($db->inhouse_villas($date=$fecha_entrada, $beds));
	$inhousema=count($db->inhouse_villas($date=date('Y-m-d',$martes), $beds));
	$inhousemi=count($db->inhouse_villas($date=date('Y-m-d',$miercoles), $beds));
	$inhouseju=count($db->inhouse_villas($date=date('Y-m-d',$jueves), $beds));
	$inhousevi=count($db->inhouse_villas($date=date('Y-m-d',$viernes), $beds));
	$inhousesa=count($db->inhouse_villas($date=date('Y-m-d',$sabado), $beds));
	$inhousedo=count($db->inhouse_villas($date=date('Y-m-d',$domingo), $beds));
		?>

	
	<tr>
		<td id="td">Total Inhouse</td>
		<td ><strong><?=$inhouselu?></strong></td>
		<td ><strong><?=$inhousema?></strong></td>
		<td ><strong><?=$inhousemi?></strong></td>
		<td ><strong><?=$inhouseju?></strong></td>
		<td ><strong><?=$inhousevi?></strong></td>
		<td ><strong><?=$inhousesa?></strong></td>
		<td ><strong><?=$inhousedo?></strong></td>
	</tr>
	<?php
	$totaltimelu=$overtimelu+$arrtimelu+$cktimelu;
	$totalemplu=$overemplu+$arremplu+$ckemplu;
	
	$totaltimema=$overtimema+$arrtimema+$cktimema;
	$totalempma=$overempma+$arrempma+$ckempma;
	
	$totaltimemi=$overtimemi+$arrtimemi+$cktimemi;
	$totalempmi=$overempmi+$arrempmi+$ckempmi;
	
	$totaltimeju=$overtimeju+$arrtimeju+$cktimeju;
	$totalempju=$overempju+$arrempju+$ckempju;
	
	$totaltimevi=$overtimevi+$arrtimevi+$cktimevi;
	$totalempvi=$overempvi+$arrempvi+$ckempvi;
	
	$totaltimesa=$overtimesa+$arrtimesa+$cktimesa;
	$totalempsa=$overempsa+$arrempsa+$ckempsa;
	
	$totaltimedo=$overtimedo+$arrtimedo+$cktimedo;
	$totalempdo=$overempdo+$arrempdo+$ckempdo;
	?>
	<tr>
		<td id="td">Total minutes</td>
		<td ><strong><?=$totaltimelu?></strong></td>
		<td ><strong><?=$totaltimema?></strong></td>
		<td ><strong><?=$totaltimemi?></strong></td>
		<td ><strong><?=$totaltimeju?></strong></td>
		<td ><strong><?=$totaltimevi?></strong></td>
		<td ><strong><?=$totaltimesa?></strong></td>
		<td ><strong><?=$totaltimedo?></strong></td>
	</tr>
	<tr>
		<td id="td">Total employees</td>
		<td ><strong><?=floor($totalemplu);?></strong></td>
		<td ><strong><?=floor($totalempma);?></strong></td>
		<td ><strong><?=floor($totalempmi);?></strong></td>
		<td ><strong><?=floor($totalempju);?></strong></td>
		<td ><strong><?=floor($totalempvi);?></strong></td>
		<td ><strong><?=floor($totalempsa);?></strong></td>
		<td ><strong><?=floor($totalempdo);?></strong></td>
	</tr>
</table>