<?php
$data= new getQueries ();
$ticket=$data->singleTicket($ticketid=$_GET['t']);
$completedby=$data->ticketHistory($ticket['id'],3);
?>

<p class="header">CHANGING INFO ON COMPLETED</p>

    <? if ($_GET['t']!=''){
		//$data= new getQueries ();
		?>
		<p style="text-align:center;font-weight:bold;font-size:18px;">Ticket number: <?=$_GET['t']?></p>
		<? if($_GET['error']){?>

		<p style="text-align:center;font-size:16px;background-color:yellow; margin:5px; padding:5px;"><?php echo $_GET['error'];?></p>
		
		<? }?>
		<table align="center"><tr><td>
		<form method="post" action="changeTicketPrice.php">
			<p style="text-align:left;">Note: <textarea name="delegated" cols="50" rows="10" ><?=$completedby['notereasondelegate']?></textarea></p>
			<p style="text-align:right;">Price to charge RD$: <input type="text" name="price" value="<?=$completedby['etc']?>"/></p>
			<p style="text-align:right;"><input type="hidden" name="cno" value="<?=$completedby['id']?>"/>
			<p style="text-align:right;"><input type="hidden" name="tiketnr" value="<?=$ticket['id']?>"/>
			<input type="submit" name="process" value="Change price"/></p>
		</form>
		</td></tr></table>
		<?
		
	}else{
        echo "<p style='text-align:center; color:red; font-size:16px;'>NO TICKET FOUND</p>";
	 }?>