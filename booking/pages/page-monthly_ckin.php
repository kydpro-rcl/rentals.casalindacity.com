<? include('menu_CSS/menu-admin.php');?>

<p class="header">Check in from date to date</p>

	<form method="post" action="monthly_ckin.php" >
		<p style="padding-left:15px;">Starting Date:<input type="text" name="fecha" value="<?=$_POST['fecha']?>" placeholder="YYYY-MM-DD" required="required"/>
		<!--<select name="w">
			<option value="1" <? if($_POST['w']==1){ echo 'selected="selected"';} ?>>Arrivals</option>
			<option value="2" <? if($_POST['w']==2){ echo 'selected="selected"';} ?>>Departures</option>
		</select>-->
		Ending Date:<input type="text" name="fechaf" value="<?=$_POST['fechaf']?>" placeholder="YYYY-MM-DD" required="required"/>
		<input type="hidden" name="w" value="1"/>
		<input class="book_but" type="submit" name="go" value="Search"/></p>

	</form>
<hr />
<? if ($_POST){?>

	<?
	$db=new getQueries();

	switch($_POST['w']){
		case 1:
			$f_inicio=strtotime('-1 day', strtotime($_POST['fecha']));
			$f_final=strtotime('+1 day', strtotime($_POST['fechaf']));
			$checkin=$db->arriving_dateft(date('Y-m-d',$f_inicio), date('Y-m-d',$f_final)); break;
		case 2:
			$checkin=$db->departuring_date($_POST['fecha']); break;
	}
	 $total=$db->getAffectedRows();
	 ?>
	 
	 <?
	switch($_POST['w']){
		case 1:?>
			<h2 class="centro">Arriving from <?=formatear_fecha($_POST['fecha'])?> (<?=$total?>)</h2>
			<? break;
		case 2:?>
			<h2 class="centro">Departing from <?=formatear_fecha($_POST['fecha'])?> (<?=$total?>)</h2>
			<? break;
	}?>
 
 
 
 
 <hr>
 <? if (!empty($checkin)){?>
	  <table cellpadding="2" cellspacing="2" align="center"><tr class="title"><td id="td">VILLA NO.</td><td id="td">REFERENCE</td><td id="td">STARTING</td><td id="td">ENDING</td><td id="td">CUSTOMER</td><td id="td">EMAIL</td><td id="td">PHONE</td><td id="td">ADULTS</td><td id="td">KIDS</td><td id="td">STATUS</td></tr>
	 <? $x=0;
	foreach ($checkin as $in){
		$villa=$db->villa($in['villa']);
		$client=$db->customer($in['client']);
		?>
		<tr class='fila<?=$x?>' bgcolor="#e2e1e1" onclick="reserva('reserva_details.php?id=<?=$in['reserveid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
		<td id="td"><?=$villa[0]['no']?></td><td id="td"><?=$in['ref']?></td><td id="td"><?=formatear_fecha($in['start'])?></td><td id="td"><?=formatear_fecha($in['end'])?></td><td id="td"><? echo $client['name'].' '.$client['lastname']?></td>
		<td id="td"><? echo $client['email'];?></td>
		<td id="td"><? echo $client['phone'];?></td>
		
		<td id="td"><?=$in['adults']?></td><td id="td"><?=$in['kids']?></td> <td id="td"> <?=booking_status($in['status']);?></td>
		</tr>
	<?
    if ($x==0){$x++;} elseif ($x==1){$x--;}
	}?>

 </table>
 <?} else{
 	echo "<h3 class=\"centro\">There is not arrivals for the selected dates</h3>";
 	}
 }	?>

