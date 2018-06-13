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

	<form method="post" action="workordermaid.php" >
		 <p id="fields" style="text-align:center;">
         <span style="font-size:10px; color:red;"></span>Show from date:
		 <input type="text" name="desde" value="<?=date('Y-m-d',$nextMonday);?>" id="datepicker" size="10"/> <input class="book_but" type="submit" name="save" value="Show"/>
         <br/><span id="error_s"><?=$_GET['error']['desde']?></span><span style="font-size:10px; color:gray;">YYYY-MM-DD</span>
		 
        </p>
	</form>
	
	<!--<p id="fields" style="text-align:right;"><a href="export_checkin-out.php?desde=<?=$nextMonday?>" target="_blank" alt="">Export to Excel</a></p>-->

<?php

$martes=strtotime('+1 day', $nextMonday);
$miercoles=strtotime('+2 day', $nextMonday);
$jueves=strtotime('+3 day', $nextMonday);
$viernes=strtotime('+4 day', $nextMonday);
$sabado=strtotime('+5 day', $nextMonday);
$domingo=strtotime('+6 day', $nextMonday);

$book_1=$db->bookings_of_the_day(date('Y-m-d',$nextMonday));
$book_2=$db->bookings_of_the_day(date('Y-m-d',$martes));
$book_3=$db->bookings_of_the_day(date('Y-m-d',$miercoles));
$book_4=$db->bookings_of_the_day(date('Y-m-d',$jueves));
$book_5=$db->bookings_of_the_day(date('Y-m-d',$viernes));
$book_6=$db->bookings_of_the_day(date('Y-m-d',$sabado));
$book_7=$db->bookings_of_the_day(date('Y-m-d',$domingo));

 	?>
	<p>&nbsp;</p>
	
	

	
	<h3 style="text-align:center;"><?=date('l jS \of F Y',$nextMonday);?></h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td">Booking</td>
		<td id="td">Villa</td>
		<td id="td">Bedrooms</td>
		<td id="td">Status</td>
		<td id="td">&nbsp;</td>
	</tr>
<?php

	foreach($book_1 AS $k){	
	  $villa=$db->villa($k['villa']);
		?>
		<tr >
		<td id="td"><?=$k['ref']?></td>
		<td id="td"><?=$villa[0]['no']?></td>
		<td id="td"><?=$villa[0]['bed']?></td>
		<td id="td"><?=$k['status']?></td>
		<td id="td"><a href="maid_work_request.php?ref=<?=$k['ref']?>&d=<?=$nextMonday?>" target=_blank">Print Work Order</a></td>
	</tr>
		
	<?php }
	
	//print_r($villa);
	?>
</table>


	<h3 style="text-align:center;"><?=date('l jS \of F Y',$martes);?></h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td">Booking</td>
		<td id="td">Villa</td>
		<td id="td">Bedrooms</td>
		<td id="td">Status</td>
		<td id="td">&nbsp;</td>
	</tr>
<?php

	foreach($book_2 AS $k){	
	  $villa=$db->villa($k['villa']);
		?>
		<tr >
		<td id="td"><?=$k['ref']?></td>
		<td id="td"><?=$villa[0]['no']?></td>
		<td id="td"><?=$villa[0]['bed']?></td>
		<td id="td"><?=$k['status']?></td>
		<td id="td"><a href="maid_work_request.php?ref=<?=$k['ref']?>&d=<?=$martes?>" target=_blank">Print Work Order</a></td>
	</tr>
		
	<?php }
	
	//print_r($villa);
	?>
</table>

	<h3 style="text-align:center;"><?=date('l jS \of F Y',$miercoles);?></h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td">Booking</td>
		<td id="td">Villa</td>
		<td id="td">Bedrooms</td>
		<td id="td">Status</td>
		<td id="td">&nbsp;</td>
	</tr>
<?php

	foreach($book_3 AS $k){	
	  $villa=$db->villa($k['villa']);
		?>
		<tr >
		<td id="td"><?=$k['ref']?></td>
		<td id="td"><?=$villa[0]['no']?></td>
		<td id="td"><?=$villa[0]['bed']?></td>
		<td id="td"><?=$k['status']?></td>
		<td id="td"><a href="maid_work_request.php?ref=<?=$k['ref']?>&d=<?=$miercoles?>" target=_blank">Print Work Order</a></td>
	</tr>
		
	<?php }
	
	//print_r($villa);
	?>
</table>

	<h3 style="text-align:center;"><?=date('l jS \of F Y',$jueves);?></h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td">Booking</td>
		<td id="td">Villa</td>
		<td id="td">Bedrooms</td>
		<td id="td">Status</td>
		<td id="td">&nbsp;</td>
	</tr>
<?php

	foreach($book_4 AS $k){	
	  $villa=$db->villa($k['villa']);
		?>
		<tr >
		<td id="td"><?=$k['ref']?></td>
		<td id="td"><?=$villa[0]['no']?></td>
		<td id="td"><?=$villa[0]['bed']?></td>
		<td id="td"><?=$k['status']?></td>
		<td id="td"><a href="maid_work_request.php?ref=<?=$k['ref']?>&d=<?=$jueves?>" target=_blank">Print Work Order</a></td>
	</tr>
		
	<?php }
	
	//print_r($villa);
	?>
</table>

	<h3 style="text-align:center;"><?=date('l jS \of F Y',$viernes);?></h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td">Booking</td>
		<td id="td">Villa</td>
		<td id="td">Bedrooms</td>
		<td id="td">Status</td>
		<td id="td">&nbsp;</td>
	</tr>
<?php

	foreach($book_5 AS $k){	
	  $villa=$db->villa($k['villa']);
		?>
		<tr >
		<td id="td"><?=$k['ref']?></td>
		<td id="td"><?=$villa[0]['no']?></td>
		<td id="td"><?=$villa[0]['bed']?></td>
		<td id="td"><?=$k['status']?></td>
		<td id="td"><a href="maid_work_request.php?ref=<?=$k['ref']?>&d=<?=$viernes?>" target=_blank">Print Work Order</a></td>
	</tr>
		
	<?php }
	
	//print_r($villa);
	?>
</table>

	<h3 style="text-align:center;"><?=date('l jS \of F Y',$sabado);?></h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td">Booking</td>
		<td id="td">Villa</td>
		<td id="td">Bedrooms</td>
		<td id="td">Status</td>
		<td id="td">&nbsp;</td>
	</tr>
<?php

	foreach($book_6 AS $k){	
	  $villa=$db->villa($k['villa']);
		?>
		<tr >
		<td id="td"><?=$k['ref']?></td>
		<td id="td"><?=$villa[0]['no']?></td>
		<td id="td"><?=$villa[0]['bed']?></td>
		<td id="td"><?=$k['status']?></td>
		<td id="td"><a href="maid_work_request.php?ref=<?=$k['ref']?>&d=<?=$sabado?>" target=_blank">Print Work Order</a></td>
	</tr>
		
	<?php }
	
	//print_r($villa);
	?>
</table>

	<h3 style="text-align:center;"><?=date('l jS \of F Y',$domingo);?></h3>
<table cellpadding="4" cellspacing="0" align="center" border=1>
	<tr class="title">
		<td id="td">Booking</td>
		<td id="td">Villa</td>
		<td id="td">Bedrooms</td>
		<td id="td">Status</td>
		<td id="td">&nbsp;</td>
	</tr>
<?php

	foreach($book_7 AS $k){	
	  $villa=$db->villa($k['villa']);
		?>
		<tr >
		<td id="td"><?=$k['ref']?></td>
		<td id="td"><?=$villa[0]['no']?></td>
		<td id="td"><?=$villa[0]['bed']?></td>
		<td id="td"><?=$k['status']?></td>
		<td id="td"><a href="maid_work_request.php?ref=<?=$k['ref']?>&d=<?=$domingo?>" target=_blank">Print Work Order</a></td>
	</tr>
		
	<?php }
	
	//print_r($villa);
	?>
</table>
