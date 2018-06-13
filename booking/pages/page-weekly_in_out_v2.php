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
	
	<!--<p id="fields" style="text-align:right;"><a href="export_checkin-out.php?desde=<?=$nextMonday?>" target="_blank" alt="">Export to Excel</a></p>-->
	
<?php

//arriving_status($date, $status)

//$max_checkin_long=max(count($checkin1),count($checkin2),count($checkin3),count($checkin4),count($checkin5),count($checkin6),count($checkin7));
/*

$checkout1=$db->departuring_date(date('Y-m-d',$nextMonday));
$checkout2=$db->departuring_date(date('Y-m-d',$martes));
$checkout3=$db->departuring_date(date('Y-m-d',$miercoles));
$checkout4=$db->departuring_date(date('Y-m-d',$jueves));
$checkout5=$db->departuring_date(date('Y-m-d',$viernes));
$checkout6=$db->departuring_date(date('Y-m-d',$sabado));
$checkout7=$db->departuring_date(date('Y-m-d',$domingo));
$max_checkout=max(count($checkout1),count($checkout2),count($checkout3),count($checkout4),count($checkout5),count($checkout6),count($checkout7));*/
//================START FUNCTION TO CREATE THE LIST===========================================================================


function create_list($date, $status, $type){
	
	//echo $date; die();
	
	$db=new getQueries();
	
	if($date==''){	
		$nextMonday = strtotime('next Monday');	
	}else{
		$nextMonday = strtotime($date);	
	}
	
	//echo $nextMonday; die();
	
	$martes=strtotime('+1 day', $nextMonday);
	$miercoles=strtotime('+2 day', $nextMonday);
	$jueves=strtotime('+3 day', $nextMonday);
	$viernes=strtotime('+4 day', $nextMonday);
	$sabado=strtotime('+5 day', $nextMonday);
	$domingo=strtotime('+6 day', $nextMonday);
	
	/*$ls1=$db->inhouse_status(date('Y-m-d',$nextMonday), $status); 
			$ls2=$db->inhouse_status(date('Y-m-d',$martes), $status); 
			$ls3=$db->inhouse_status(date('Y-m-d',$miercoles), $status); 
			$ls4=$db->inhouse_status(date('Y-m-d',$jueves), $status); 
			$ls5=$db->inhouse_status(date('Y-m-d',$viernes), $status); 
			$ls6=$db->inhouse_status(date('Y-m-d',$sabado), $status); 
			$ls7=$db->inhouse_status(date('Y-m-d',$domingo), $status); */
	
	
	switch($type){
		case 1: //in house
			$whatisit="inhouse";
			$list_name="In house list";
			$ls1=$db->inhouse_status(date('Y-m-d',$nextMonday), $status); 
			$ls2=$db->inhouse_status(date('Y-m-d',$martes), $status); 
			$ls3=$db->inhouse_status(date('Y-m-d',$miercoles), $status); 
			$ls4=$db->inhouse_status(date('Y-m-d',$jueves), $status); 
			$ls5=$db->inhouse_status(date('Y-m-d',$viernes), $status); 
			$ls6=$db->inhouse_status(date('Y-m-d',$sabado), $status); 
			$ls7=$db->inhouse_status(date('Y-m-d',$domingo), $status); 
			break;
		case 2: //ck in
			$whatisit="arriving";
			$list_name="Check in list";
			$ls1=$db->arriving_status(date('Y-m-d',$nextMonday), $status); 
			$ls2=$db->arriving_status(date('Y-m-d',$martes), $status); 
			$ls3=$db->arriving_status(date('Y-m-d',$miercoles), $status); 
			$ls4=$db->arriving_status(date('Y-m-d',$jueves), $status); 
			$ls5=$db->arriving_status(date('Y-m-d',$viernes), $status); 
			$ls6=$db->arriving_status(date('Y-m-d',$sabado), $status); 
			$ls7=$db->arriving_status(date('Y-m-d',$domingo), $status); 
			break;
		case 3: //ck out
			$whatisit="checking out";
			$list_name="Check out list";
			$ls1=$db->departuring_status(date('Y-m-d',$nextMonday), $status); 
			$ls2=$db->departuring_status(date('Y-m-d',$martes), $status); 
			$ls3=$db->departuring_status(date('Y-m-d',$miercoles), $status); 
			$ls4=$db->departuring_status(date('Y-m-d',$jueves), $status); 
			$ls5=$db->departuring_status(date('Y-m-d',$viernes), $status); 
			$ls6=$db->departuring_status(date('Y-m-d',$sabado), $status); 
			$ls7=$db->departuring_status(date('Y-m-d',$domingo), $status); 
			break;
		default: //if not in type
			$whatisit="arriving";
			$list_name="Check in list";
			$ls1=$db->arriving_status(date('Y-m-d',$nextMonday), $status); 
			$ls2=$db->arriving_status(date('Y-m-d',$martes), $status); 
			$ls3=$db->arriving_status(date('Y-m-d',$miercoles), $status); 
			$ls4=$db->arriving_status(date('Y-m-d',$jueves), $status); 
			$ls5=$db->arriving_status(date('Y-m-d',$viernes), $status); 
			$ls6=$db->arriving_status(date('Y-m-d',$sabado), $status); 
			$ls7=$db->arriving_status(date('Y-m-d',$domingo), $status); 
			break;
	}
	
	$max_ls=max(count($ls1),count($ls2),count($ls3),count($ls4),count($ls5),count($ls6),count($ls7));
	
	if($max_ls>0){//=========ONLY SHOW TABLE IF VALUE FOUND===================
		//echo $max_ls;
		?>	
		<!--<p style="text-align:center;font-weight:bold;text-transform:uppercase; color:blue;"><?=$list_name?></p>-->
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
		if($date==''){	
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
			
			for($i=0; $i<$max_ls; $i++){
				$villa1=$db->villa($ls1[$i]['villa']);
				$villa2=$db->villa($ls2[$i]['villa']);
				$villa3=$db->villa($ls3[$i]['villa']);
				$villa4=$db->villa($ls4[$i]['villa']);
				$villa5=$db->villa($ls5[$i]['villa']);
				$villa6=$db->villa($ls6[$i]['villa']);
				$villa7=$db->villa($ls7[$i]['villa']);
				
				
				?>
				<tr >
				<td id="td"><?php if ($villa1[0]['no']){ 
				echo $villa1[0]['no'];
				if($type==2){
					echo "-".date('d/m',strtotime($ls1[$i]['end'])); 
					echo  "<br/>".ltrim($ls1[$i]['ref'], '0'); 
				}
				$countin1+=1;
				
				}?></td>
				<td id="td"><?php if ($villa2[0]['no']){ 
				echo $villa2[0]['no'];
				if($type==2){
					echo "-".date('d/m',strtotime($ls2[$i]['end'])); 
					echo  "<br/>".ltrim($ls2[$i]['ref'], '0'); 
				}
				$countin2+=1;
				}?></td>
				<td id="td">
				<!--<a href="reserva_details.php?id=<?=$ls3[$i]['reserveid']?>" onclick="reserva('reserva_details.php?id=<?=$ls3[$i]['reserveid']?>','Details for Selection', 530, 800)" alt="">-->
				<?php if ($villa3[0]['no']){ 
				
				echo $villa3[0]['no']; 
				if($type==2){
					echo "-".date('d/m',strtotime($ls3[$i]['end'])); 
					echo  "<br/>".ltrim($ls3[$i]['ref'], '0'); 
				}
				$countin3+=1;
				}?>
				<!--</a>-->
				</td>
				<td id="td"><?php if ($villa4[0]['no']){ 
				echo $villa4[0]['no']; 
				if($type==2){
					echo "-".date('d/m',strtotime($ls4[$i]['end'])); 
					echo  "<br/>".ltrim($ls4[$i]['ref'], '0'); 
				}
				$countin4+=1;
				}?></td>
				<td id="td"><?php if ($villa5[0]['no']){ 
				echo $villa5[0]['no']; 
				if($type==2){
					echo "-".date('d/m',strtotime($ls5[$i]['end'])); 
					echo  "<br/>".ltrim($checkin5[$i]['ref'], '0'); $countin5+=1;
				}
				}?></td>
				<td id="td"><?php if ($villa6[0]['no']){ 
				echo $villa6[0]['no']; 
				if($type==2){
					echo "-".date('d/m',strtotime($ls6[$i]['end'])); 
					echo  "<br/>".ltrim($ls6[$i]['ref'], '0');
				}
				$countin6+=1;
				}?></td>
				<td id="td"><?php if ($villa7[0]['no']){ 
				echo $villa7[0]['no']; 
				if($type==2){
					echo "-".date('d/m',strtotime($ls7[$i]['end']));
					echo  "<br/>".ltrim($ls7[$i]['ref'], '0'); 
				}
				$countin7+=1;
				}?></td>
			</tr>
				
			<?php }?>
			<tr class="title"><td colspan="7" align="center"><strong>Totals <?=$whatisit?></strong></td></tr>
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
		<!--<p>&nbsp;</p>-->
	<?php
	}
}
//================END FUNCTION TO CREATE THE LIST===========================================================================

($_POST['desde']!='') ? $date=$_POST['desde'] : $date=''; //if post date then assign its value to date's variable or leave the variable empty "condition ? if true to this : if false do this"
?>	
	
	<h2 style="text-align:center;">SHORT TERM PAID</h2>
	<h4 style="text-align:center;margin-top:10px;">Checking list</h4>
	<?php
		create_list($date, $status=2, 2);
		//create_list($date, $status=3, 2);
	?>
	
	<h4 style="text-align:center;margin-top:10px;">In house list</h4>
	<?php
		create_list($date, $status=1, 1);
		create_list($date, $status=2, 1);
		//create_list($date, $status=3, 1);
		create_list($date, $status=4, 1);
	?>
	
	<h4 style="text-align:center;margin-top:10px;">Checkout list</h4>
	<?php
		create_list($date, $status=1, 3);
		create_list($date, $status=2, 3);
		//create_list($date, $status=3, 3);
		create_list($date, $status=4, 3);
	?>
	
	<hr/>
	<h2 style="text-align:center;">LONG TERM</h2>
	<h4 style="text-align:center;margin-top:10px;">Checking list</h4>
	<?php
		create_list($date, $status=9, 2);
	?>
	<?php
		create_list($date, $status=10, 2);
	?>
	
	
	<h4 style="text-align:center;margin-top:10px;">Checkout list</h4>
	<?php
		create_list($date, $status=11, 3);
		create_list($date, $status=8, 3);
		create_list($date, $status=9, 3);
		create_list($date, $status=10, 3);
	?>
	
	<h4 style="text-align:center;margin-top:10px;">In house list</h4>
	<?php
		create_list($date, $status=8, 1);
		create_list($date, $status=9, 1);
		create_list($date, $status=10, 1);
		create_list($date, $status=11, 1);
	?>
	<hr/>
	<h2 style="text-align:center;">OWNERS</h2>
	<!--<p style="text-align:center;">List everything at once</p>-->
	<?php
	//---------checkin list-----------------------	
		create_list($date, $status=19, 2);
		create_list($date, $status=20, 2);
	//--------in house list-----------------
		create_list($date, $status=7, 1);
		create_list($date, $status=21, 1);
		create_list($date, $status=19, 1);
		create_list($date, $status=20, 1);
	
	//---------checkout list----------------------	
		create_list($date, $status=21, 3);
		create_list($date, $status=7, 3);
		create_list($date, $status=19, 3);
		create_list($date, $status=20, 3);
		
		/*$list=$db->inhouse_status('2018-04-09', $status=8); 
		
		echo "<pre>";
		print_r($list);
		echo "</pre>";*/
		
	?>
	<hr/>
	<h2 style="text-align:center;">SHORT TERM WITH NO PAYMENT</h2>
<h4 style="text-align:center;margin-top:10px;">Checking list</h4>
	<?php
		//create_list($date, $status=2, 2);
		create_list($date, $status=3, 2);
	?>
	
	<h4 style="text-align:center;margin-top:10px;">In house list</h4>
	<?php
		//create_list($date, $status=1, 1);
		//create_list($date, $status=2, 1);
		create_list($date, $status=3, 1);
		//create_list($date, $status=4, 1);
	?>
	
	<h4 style="text-align:center;margin-top:10px;">Checkout list</h4>
	<?php
		//create_list($date, $status=1, 3);
		//create_list($date, $status=2, 3);
		create_list($date, $status=3, 3);
		//create_list($date, $status=4, 3);
	?>
	
	<hr/>


