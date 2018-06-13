<p class="header">CHANGING TICKET TO BE COMPLETED</p>

    <? if ($_GET['t']!=''){
		//$data= new getQueries ();
		?>
		<p style="text-align:center;font-weight:bold;font-size:18px;">Ticket number: <?=$_GET['t']?></p>
		<? if($_GET['error']){?>

		<p style="text-align:center;font-size:16px;background-color:yellow; margin:5px; padding:5px;"><?php echo $_GET['error'];?></p>
		
		<? }?>
		<table align="center"><tr><td>
		<form method="post" action="change2completed.php">
			<p style="text-align:left;">Note: <textarea name="delegated" cols="50" rows="10" ><?=$_POST['delegated']?></textarea></p>
			<p style="text-align:right;">Price to charge RD$: <input type="text" name="price" value="<?=$_POST['price']?>"/></p>
			<p style="text-align:right;"><input type="hidden" name="ticketno" value="<?=$_GET['t']?>"/>
			<input type="submit" name="process" value="Process Ticket"/></p>
		</form>
		</td></tr></table>
		<?
		
	}else{
        echo "<p style='text-align:center; color:red; font-size:16px;'>NO TICKET FOUND</p>";
	 }?>