<?php require_once('fancybox2.php');
if($_GET['search']==1){
	ticketsSearch('ticketcancelled');
}else{
	echo "<p><a href='ticketcancelled.php?search=1'>Show search</a></p>";
}
	if($_POST['buscar']){
		$snr=$_POST['nr'];
		$svilla=$_POST['villa_id'];
		$sdep=$_POST['dep'];
		$ssub=$_POST['subject'];
		$ssta=$_POST['start'];
		$send=$_POST['end'];
	}	
?>
<p class="header">TICKETS CANCELLED</p>
<?php
	$data= new getQueries ();
	
	/*if($_SESSION['info']['report']==6){
		$tickets=$data->tickets($status=4);
	}else{
		$tickets=$data->ticketsByDepart($status=4, $depart=$_SESSION['info']['report']);
	}*/
	
	if($_POST['buscar']){
		if($_SESSION['info']['report']==6){
			$tickets=$data->tickets1($status=4,$snr,$svilla,$sdep,$ssub,$ssta,$send);
		}else{
			$tickets=$data->ticketsByDepart1($status=4, $depart=$_SESSION['info']['report'],$snr,$svilla,$sdep,$ssub,$ssta,$send);
		}
	}else{
		if($_SESSION['info']['report']==6){
			$tickets=$data->tickets2($status=4, $_GET['sort']);
		}else{
			$tickets=$data->ticketsByDepart2($status=4, $depart=$_SESSION['info']['report'], $_GET['sort']);
		}
	}
	?>

	<? if ($tickets){
	   /* echo "<pre>";
		print_r($tickets);
		echo "</pre>";*/
		?>
		<table align="center" cellpadding="2" cellspacing="2" border="0" >
			<tr class="title">
			
				<td class="tickets">
					<a href="ticketcancelled.php?sort=1" title="" alt="">No.</a>
				</td>
				
				<td class="tickets">
					<a href="ticketcancelled.php?sort=3" title="" alt="">Need</a>
				</td>
				<td class="tickets">
					<a href="ticketcancelled.php?sort=4" title="" alt="">Details</a>
				</td>
				<td class="tickets">
					<a href="ticketcancelled.php?sort=2" title="" alt="">Villa</a>
				</td>
				<td class="tickets">
					<a href="ticketcancelled.php?sort=5" title="" alt="">Department</a>
				</td>
				<td class="tickets">
					<a href="ticketcancelled.php?sort=9" title="" alt="">Last Edit</a>
				</td>
				<td class="tickets">
					<a href="ticketcancelled.php?sort=6" title="" alt="">Priority</a>
				</td>
				<td class="tickets">
					<a href="ticketcancelled.php?sort=7" title="" alt="">Villa Status</a>
				</td>
				<td class="tickets">
					<a href="ticketcancelled.php?sort=8" title="" alt="">Date Cancelled</a>
				</td>
				
				<!--<td>
					&nbsp;
				</td>-->
			</tr>
			<?php
			$x=0;
		foreach($tickets AS $k){
			$options=tickets_subjects();
			$dep=departments();
			$proccess=$data->ticketHistory($k['id'], $k['status']);
			$username=$data->givemeUsername($proccess['userid']);
			?>
			<tr  class="fila<?=$x?>">
		
				<td class="tickets">
					<?=$k['id']?>
				</td>
				
				<td class="tickets">
					<?=$options[$k['subject']]?>
				</td>
				<td class="tickets">
					<a class="fancybox fancybox.iframe" href="ticketDetails.php?t=<?=$k['id']?>">
					
					<?php
					// strip tags to avoid breaking any html
						$string = strip_tags($k['details']);

						if (strlen($string) > 20) {

							// truncate string
							$stringCut = substr($string, 0, 20);

							// make sure it ends in a word so assassinate doesn't become ass...
							$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a style="font-size:10px;color:green;" class="fancybox fancybox.iframe" href="ticketDetails.php?t='.$k['id'].'">Read More</a>'; 
						}
						echo "<span style='font-size:10px;'>$string</span>";
					?>
					</a>
				</td>
				<td class="tickets">
					<?=$data->villa_no($k['villa_id'])?>
				</td>
				<td class="tickets">
					<?=$dep[$k['department']]?>
				</td>
				<td class="tickets">
					<?=$username?>
				</td>
				<td class="tickets">
					<?php
					switch($k['priority']){
						case 1:
							echo "Immediately (Urgent)"; break;
						case 2:
							echo "Level 1 - (Top priority)"; break;
						case 3:
							echo "Level 2 - (Important)"; break;
						case 4:
							echo "Level 3 - (As possible)"; break;
					}
					?>
				</td>
				<td class="tickets">
					<?php
					switch($k['villastatus']){
						case 1:
							echo "Empty"; break;
						case 2:
							echo "Occupied"; break;
						case 3:
							echo "Arriving"; break;
					}
					?>
				</td>
				<td nowrap="nowrap" class="tickets">
					<?php echo "<span style='font-size:10px;'>"; fechaLegible($proccess['date']); echo "</span>";?>
				</td>
				
				<!--<td align="center" class="tickets">
					<a href="ticketedit.php?t=<?=$k['id']?>" alt="" title=""><img src="images/edit_ticket.png" width="15" alt="" title="Edit ticket <?=$k['id']?>"/></a>
				</td>-->
			</tr>
		<?php
			if ($x==0){$x++;} elseif ($x==1){$x--;}
		}
		?>
		</table>
		<?php
	}else{
        echo "<p style='text-align:center; color:red; font-size:16px;'>NO TICKETS CANCELLED FOUND</p>";
	 }?>