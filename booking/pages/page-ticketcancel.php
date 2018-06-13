<p class="header">CANCELLING TICKET <?=$_GET['cancel']?></p>
<?php
	$data= new getQueries ();
	$ticket=$data->singleTicket($ticketid=$_GET['cancel']);
	?>
<?php if(!$_GET['success']){?>

		<? if($_GET['error']){?>

		<p style="text-align:center;font-size:16px;background-color:yellow; margin:5px; padding:5px;"><?php echo $_GET['error'];?></p>
		
		<? }?>
<form method="post" action="ticketcancel.php">
		<table align="center" cellpadding="2" cellspacing="2" border="0" >

			<tr >
				<td>
					Reason
				</td>
				<td>
					<textarea name="details" cols="50" rows="10" required="required"></textarea>
					<input type="hidden" name="ticketno" value="<?=$ticket['id']?>"/>
				</td>
			</tr>
				<tr >
				<td colspan=2>
				<input type="submit" name="create" value="Cancel Ticket">
				</td>
			</tr>
		</table>
</form>
<?php }else{
	echo "<p style='text-align:center; color:red; font-size:16px;'>".$_GET['success']."</p>";
}