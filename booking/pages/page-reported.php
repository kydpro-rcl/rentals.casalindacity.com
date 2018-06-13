<?php require_once('fancybox2.php');
//$data= new getQueries ();
//$villasrcl=$data->all_villas();
if($_GET['search']==1){
	ticketsSearch('reported');
}else{
	echo "<p><a href='reported.php?search=1'>Show search</a></p>";
}

	if($_POST['buscar']){
		/*$_SESSION['search']['nr']=$_POST['nr'];
		$_SESSION['search']['villa_id']=$_POST['villa_id'];
		$_SESSION['search']['dep']=$_POST['dep'];
		$_SESSION['search']['subject']=$_POST['subject'];
		$_SESSION['search']['start']=$_POST['start'];
		$_SESSION['search']['end']=$_POST['end'];*/
		/*$snr=$_SESSION['search']['nr'];
		$svilla=$_SESSION['search']['villa_id'];
		$sdep=$_SESSION['search']['dep'];
		$ssub=$_SESSION['search']['subject'];
		$ssta=$_SESSION['search']['start'];
		$send=$_SESSION['search']['end'];*/
		$snr=$_POST['nr'];
		$svilla=$_POST['villa_id'];
		$sdep=$_POST['dep'];
		$ssub=$_POST['subject'];
		$ssta=$_POST['start'];
		$send=$_POST['end'];
	}
	
	
	if($_GET['sort']){
		$value_1=1;
		$value_2=2;
		$value_3=3;
		$value_4=4;
		$value_5=5;
		$value_6=6;
		$value_7=7;
		$value_8=8;
		$value_9=9;
		switch($_GET['sort']){
			case 1:$value_1=10;break;
			case 2:$value_2=20;break;
			case 3:$value_3=30;break;
			case 4:$value_4=40;break;	
			case 5:$value_5=50;break;
			case 6:$value_6=60;break;
			case 7:$value_7=70;break;
			case 8:$value_8=80;break;	
			case 9:$value_9=90;break;
		}
	}else{
		$value_1=1;
		$value_2=2;
		$value_3=3;
		$value_4=4;
		$value_5=5;
		$value_6=6;
		$value_7=7;
		$value_8=8;
		$value_9=9;
	}
	//echo $sort_new;
	
?>

<p class="header">NEW TICKETS</p>
<?php
	$data= new getQueries ();
	
	if($_POST['buscar']){
		if($_SESSION['info']['report']==6){
			$tickets=$data->tickets1($status=1,$snr,$svilla,$sdep,$ssub,$ssta,$send);
		}else{
			$tickets=$data->ticketsByDepart1($status=1, $depart=$_SESSION['info']['report'],$snr,$svilla,$sdep,$ssub,$ssta,$send);
		}
	}else{
		if($_SESSION['info']['report']==6){
			//$tickets=$data->tickets($status=1);
			$tickets=$data->tickets2($status=1, $_GET['sort']);
		}else{
			//$tickets=$data->ticketsByDepart($status=1, $depart=$_SESSION['info']['report']);
			$tickets=$data->ticketsByDepart2($status=1, $depart=$_SESSION['info']['report'],$_GET['sort']);
		}
	}
	//print_r($tickets);
	?>

    <? if ($tickets){
		/*echo $_GET['sort'];
	    echo "<pre>";
		print_r($tickets);
		echo "</pre>";*/
		?>
		<table align="center" cellpadding="2" cellspacing="2" border="0" >
			<tr class="title">
			<td>&nbsp;</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_1?>" title="" alt="">No.</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_5?>" title="" alt="">Department</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_3?>" title="" alt="">Need</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_4?>" title="" alt="">Details</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_2?>" title="" alt="">Villa</a>
				</td>
				
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_9?>" title="" alt="">Last Edit</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_6?>" title="" alt="">Priority</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_7?>" title="" alt="">Villa&nbsp;Status</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_8?>" title="" alt="">Date submitted</a>
				</td>
				
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<?php
			$x=0;$z=0;
		foreach($tickets AS $k){
			$z++;
			$options=tickets_subjects();
			$dep=departments();
			$username=$data->givemeUsername($k['userid']);
			?>
			<tr  class="fila<?=$x?>">
				<td class="tickets">
						<?=$z?>
				</td>
				<td class="tickets">
				<?php /*if($_SESSION['info']['report']==6){*/?>
					
				<?php/* } */?>
				<?=$k['id']?>
				<?php /*if($_SESSION['info']['report']==6){*/?>
				
				<?php /*}*/?>	
				</td>
				<td class="tickets">
					<?=$dep[$k['department']]?>
				</td>
				<td class="tickets">
					<?=str_replace("&nbsp;","",trim(strtolower($options[$k['subject']])))?>
				</td>
				<td class="tickets">
					<a class="fancybox fancybox.iframe" href="ticketDetails.php?t=<?=$k['id']?>">
					
					<?php
					// strip tags to avoid breaking any html
						$string = strip_tags($k['details']);
						$string=strtolower($string);
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
					<?php echo "<span style='font-size:10px;'>"; fechaLegible($k['date']); echo "</span>";?>
				</td>
			
				<td align="center" class="tickets">
					<a href="ticketedit.php?t=<?=$k['id']?>" alt="" title=""><img src="images/edit_ticket.png" width="15" alt="" title="Edit ticket <?=$k['id']?>"/></a>
				</td>
				<td align="center" class="tickets">
					<?php /*if($_SESSION['info']['report']!=6){*/?>
						<a href="change2inprocess.php?t=<?=$k['id']?>"><img src="images/Order-icon.png" width="15" alt="" title="Process ticket <?=$k['id']?>"/></a>
					<?php /*}*/?>
				</td>
				<td class="tickets">
					<span class="delete"><a href="ticketcancel.php?cancel=<?=$k['id']?>"><img src="images/DeleterRed.png" title="Cancel ticket <?=$k['id']?>" alt="Delete" width="10" height="10" border="0"/></a></span>
				</td>
			</tr>
		<?php
			if ($x==0){$x++;} elseif ($x==1){$x--;}
		}
		?>
		</table>
		<?php
	}else{
        echo "<p style='text-align:center; color:red; font-size:16px;'>NO TICKETS NEW FOUND</p>";
	 }?>
	 
<?	 
/*if($_GET['search']==1){
	ticketsSearch('inprocess');
}else{
	echo "<p><a href='inprocess.php?search=1'>Show search</a></p>";
}*/
	if($_POST['buscar']){
		$snr=$_POST['nr'];
		$svilla=$_POST['villa_id'];
		$sdep=$_POST['dep'];
		$ssub=$_POST['subject'];
		$ssta=$_POST['start'];
		$send=$_POST['end'];
	}		
?>
<p class="header">TICKETS IN PROCESS</p>
<?php
	$data= new getQueries ();
	
	if($_POST['buscar']){
		if($_SESSION['info']['report']==6){
			$tickets=$data->tickets1($status=2,$snr,$svilla,$sdep,$ssub,$ssta,$send);
		}else{
			$tickets=$data->ticketsByDepart1($status=2, $depart=$_SESSION['info']['report'],$snr,$svilla,$sdep,$ssub,$ssta,$send);
		}
	}else{
		if($_SESSION['info']['report']==6){
			$tickets=$data->tickets2($status=2, $_GET['sort']);
		}else{
			$tickets=$data->ticketsByDepart2($status=2, $depart=$_SESSION['info']['report'], $_GET['sort']);
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
			<td>&nbsp;</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_1?>" title="" alt="">No.</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_5?>" title="" alt="">Department</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_3?>" title="" alt="">Need</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_4?>" title="" alt="">Details</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_2?>" title="" alt="">Villa</a>
				</td>
				
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_1?>" title="" alt="">Assigned to</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_9?>" title="" alt="">Last Edit</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_6?>" title="" alt="">Priority</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_7?>" title="" alt="">Villa Status</a>
				</td>
				<td class="tickets">
					<a href="reported.php?sort=<?=$value_8?>" title="" alt="">Date Assigned</a>
				</td>
				<?php /*if($_SESSION['info']['report']!=6){*/?>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<?php /*}*/?>
			</tr>
			<?php
			$x=0;$z=0;
		foreach($tickets AS $k){
			$z++;
			$options=tickets_subjects();
			$dep=departments();
			$proccess=$data->ticketHistory($k['id'], $k['status']);
			$username=$data->givemeUsername($proccess['userid']);
			?>
			<tr  class="fila<?=$x?>">
			<td class="tickets">
					<?=$z?>
				</td>
				<td class="tickets">
				<?php /*if($_SESSION['info']['report']==6){*/?>
					
				<?php/* } */?>
				<?=$k['id']?>
				<?php /*if($_SESSION['info']['report']==6){*/?>
					
				<?php /*}*/?>	
				</td>
				<td class="tickets">
					<?=$dep[$k['department']]?>
				</td>
				<td class="tickets">
					<?=str_replace("&nbsp;","",trim(strtolower($options[$k['subject']])))?>
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
					<span style='font-size:10px;'><?=$proccess['notereasondelegate']?></span>
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
				
				<?php /*if($_SESSION['info']['report']!=6){*/?>
				<td align="center" class="tickets">
					<a href="ticketedit.php?t=<?=$k['id']?>" alt="" title=""><img src="images/edit_ticket.png" width="15" alt="" title="Edit ticket <?=$k['id']?>"/></a>
				</td>
				<td align="center" class="tickets">
					<a href="change2completed.php?t=<?=$k['id']?>"><img src="images/completed.png" width="15" alt="" title="Mark ticket <?=$k['id']?> as complete"/></a>
				</td>
				<td class="tickets">
					<span class="delete"><a href="ticketcancel.php?cancel=<?=$k['id']?>"><img src="images/DeleterRed.png" title="Cancel ticket <?=$k['id']?>" alt="Delete" width="10" height="10" border="0"/></a></span>
				</td>
				<?php /*}*/?>
			</tr>
		<?php
			if ($x==0){$x++;} elseif ($x==1){$x--;}
		}
		?>
		</table>
		<?php
	}else{
        echo "<p style='text-align:center; color:red; font-size:16px;'>NO TICKETS INPROCESS FOUND</p>";
	 }?>	 