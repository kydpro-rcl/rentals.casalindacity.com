 <?if ((!$_POST)||($_POST['date']=='')){?>
	<h2 class="centro">Check in & Out past time</h2>
	<hr/>
	<form name="" method="post">
		<p class="centro" style="font-weight:bold;">DATE <span style="font-size:9px; font-weight:bold; color:blue;">(YYYY-MM-DD)</span> <input type="text" name="date" size="10"/><select name="i_o"><option value="1">Check in</option><option value="2">Check out</option>
		<input type="submit" name="go" value="Go" class="book_but"/></p>

	</form>
 <? } ?>
<?
if ($_POST['date']!=''){
	//validate fecha
	if (!validate_date($_POST['date'])){
		echo "<h2 class='centro'>Check in & check Out</h2><hr/><p class='error centro'>Invalid date</p>";
    }else{
    //	echo "valida";
    $db=new getQueries();

	 if ($_POST['i_o']==1){  //CHECKIN
	 	 $checkin=$db->check_in($_POST['date']);
    	  $total=$db->getAffectedRows();
			 ?>
			 <h2 class="centro">Checking In <?=$_POST['date']?> (<?=$total?>)</h2>
			 <hr>
			 <? if (!empty($checkin)){?>
				  <table cellpadding="2" cellspacing="2" align="center"><tr class="title"><td id="td">VILLA NO.</td><td id="td">REFERENCE</td><td id="td">STARTING</td><td id="td">ENDING</td><td id="td">CUSTOMER</td><td id="td">ADULTS</td><td id="td">KIDS</td></tr>
				 <? $x=0;
				foreach ($checkin as $in){
					$villa=$db->villa($in['villa']);
					$client=$db->customer($in['client']);
					?>
					<tr class='fila<?=$x?>' bgcolor="#e2e1e1" onclick="location.href='check_in_confirm.php?id=<?=$in['reserveid']?>&r=<?=$in['ref']?>'" title="" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
					<td id="td"><?=$villa[0]['no']?></td><td id="td"><?=$in['ref']?></td><td id="td"><?=formatear_fecha($in['start'])?></td><td id="td"><?=formatear_fecha($in['end'])?></td><td id="td"><? echo $client['name'].' '.$client['lastname']?></td><td id="td"><?=$in['adults']?></td><td id="td"><?=$in['kids']?></td>
					</tr>
				<?
			    if ($x==0){$x++;} elseif ($x==1){$x--;}
				}?>

			 </table>
			 <?} else{
			 	echo "<h3 class=\"centro\">There is No Check In for ".$_POST['date']."</h3>";
			 	}

	 }

	 if ($_POST['i_o']==2){ //CHECK OUT
	 	 $checkout=$db->check_out($_POST['date']);

         $total=$db->getAffectedRows();
		 ?>
		 <h2 class="centro">Checking Out for <?=$_POST['date']?> (<?=$total?>)</h2>
		 <hr>
		 <? if (!empty($checkout)){?>
			  <table cellpadding="2" cellspacing="2" align="center"><tr class="title"><td id="td">VILLA NO.</td><td id="td">REFERENCE</td><td id="td">STARTING</td><td id="td">ENDING</td><td id="td">CUSTOMER</td><td id="td">ADULTS</td><td id="td">KIDS</td></tr>
			 <? $x=0;
			foreach ($checkout as $out){
				$villa=$db->villa($out['villa']);
				$client=$db->customer($out['client']);
				?>
				<tr class='fila<?=$x?>' bgcolor="#e2e1e1" onclick="location.href='check_out_confirm.php?id=<?=$out['reserveid']?>&ref=<?=$out['ref']?>'" title="" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
				<td id="td"><?=$villa[0]['no']?></td><td id="td"><?=$out['ref']?></td><td id="td"><?=formatear_fecha($out['start'])?></td><td id="td"><?=formatear_fecha($out['end'])?></td><td id="td"><? echo $client['name'].' '.$client['lastname']?></td><td id="td"><?=$out['adults']?></td><td id="td"><?=$out['kids']?></td>
				</tr>
			<?
		    if ($x==0){$x++;} elseif ($x==1){$x--;}
			}?>

		 </table>
		 <?} else{
		 	echo "<h3 class=\"centro\">There is No Check Out for ".$_POST['date']."</h3>";
		 	}

	 }
	}
	//si in or out


 }
?>