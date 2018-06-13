<h2 class="centro">Changes made on a booking</h2>
<hr/>
<? if (!$_POST){?>
<form name="" method="post">
	<p class="centro">Reference <input type="text" name="ref" />
	<input type="submit" name="go" value="Go" class="book_but" /></p>
</form>
<?}?>
<?php
 if ($_POST){
	$ref=$_POST['ref'];
	$data= new getQueries ();
	$ref=str_pad($ref, 9, "0", STR_PAD_LEFT);
	$books_mod=$data->see_occupancy_mod_ref($ref);
	$total_records=$data->getAffectedRows();
	if (!empty($books_mod)){
		?>
		<p style="font-size:10px; padding-left:15px;"><strong>Total modifications for <u><?=$ref?></u>: (<?=$total_records?>)</strong></p>
		<!--<hr /> -->
		<table width=400 align="center" cellpadding="2" cellspacing="2" border="0">
			<tr class="title">
				<td class='centro' id="td">VILLA</td>
				<td class='centro' id="td">CLIENT</td>
				<td class='centro' id="td">STARTING</td>
				<td class='centro' id="td">ENDING</td>
				<td class='centro' id="td">DATE MODIFIED</td>
				<td class='centro' id="td" nowrap="nowrap">MODIFIED BY</td>
			</tr>
		<?php

		$x=0;
		$count=1;
		foreach ($books_mod as $k){
		#echo $customers['4']['name'];
		$id=$k['busyid'];
		$villa=$data->villa($k['villa']);
		?>
		<tr class="fila<?=$x?>"  onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" onclick="reserva('reserva_mod_details.php?id=<?=$id?>','Details for Selection', 530, 800)" >
			<td id='td' class='derecha'><?=$villa[0]['no']?></td>
			<td id='td' class='derecha' nowrap="nowrap"><? $cl=$data->customer($k['client']); echo $cl['name']." ".$cl['lastname']." (".$cl['id'].")"; ?></td>
			<td id='td' nowrap="nowrap"><?=$k['start']?></td>
			<td id='td' nowrap="nowrap"><?=$k['end']?></td>
			<td id='td' class='derecha' nowrap="nowrap"><?=$k['date']?></td>
			<td id='td' nowrap="nowrap"><? $users=new subDB(); $user=$users->userDetails($k['adm']); echo $user['name'];?></td>
		</tr>
		<?
		 if ($x==0){$x++;} elseif ($x==1){$x--;}
		#echo $k['date_mod']."<br>";
		$count++;
		}

		?>
		</table>
 <?
    }else{?>
      <p class="error">No changes made on this booked or wrong booking reference number</p>
    <? }
  }?>