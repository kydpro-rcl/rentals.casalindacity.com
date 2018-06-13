<?php
require_once('inc/session.php');
header('Content-type: application/vnd.ms-excel');
$an=$_GET['desde']; 
header("Content-Disposition: attachment; filename=WeeklyCheckin-out$an.xls");
header("Pragma: no-cache");
header("Expires: 0");
require_once('init.php');
$db=new getQueries();

$_POST['desde']=$an;

if($_POST['desde']==''){	
	$nextMonday = strtotime('next Monday');	
}else{
	$nextMonday = $an;	
}



$martes=strtotime('+1 day', $nextMonday);
$miercoles=strtotime('+2 day', $nextMonday);
$jueves=strtotime('+3 day', $nextMonday);
$viernes=strtotime('+4 day', $nextMonday);
$sabado=strtotime('+5 day', $nextMonday);
$domingo=strtotime('+6 day', $nextMonday);

$checkin1=$db->arriving_date(date('Y-m-d',$nextMonday)); 
$checkin2=$db->arriving_date(date('Y-m-d',$martes)); 
$checkin3=$db->arriving_date(date('Y-m-d',$miercoles)); 
$checkin4=$db->arriving_date(date('Y-m-d',$jueves)); 
$checkin5=$db->arriving_date(date('Y-m-d',$viernes)); 
$checkin6=$db->arriving_date(date('Y-m-d',$sabado)); 
$checkin7=$db->arriving_date(date('Y-m-d',$domingo)); 
$max_checkin=max(count($checkin1),count($checkin2),count($checkin3),count($checkin4),count($checkin5),count($checkin6),count($checkin7));


$checkout1=$db->departuring_date(date('Y-m-d',$nextMonday));
$checkout2=$db->departuring_date(date('Y-m-d',$martes));
$checkout3=$db->departuring_date(date('Y-m-d',$miercoles));
$checkout4=$db->departuring_date(date('Y-m-d',$jueves));
$checkout5=$db->departuring_date(date('Y-m-d',$viernes));
$checkout6=$db->departuring_date(date('Y-m-d',$sabado));
$checkout7=$db->departuring_date(date('Y-m-d',$domingo));
$max_checkout=max(count($checkout1),count($checkout2),count($checkout3),count($checkout4),count($checkout5),count($checkout6),count($checkout7));
 	?>
	<p>&nbsp;</p>
	
	

	
	<h3 style="text-align:center;">Llegadas</h3>
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
	<tr class="title"><td colspan="7" align="center"><strong>Totals</strong></td></tr>
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
<h3 style="text-align:center;">Salidas</h3>
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
	
	<tr class="title"><td colspan="7" align="center"><strong>Totals</strong></td></tr>
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
