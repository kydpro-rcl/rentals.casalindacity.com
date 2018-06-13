<p>&nbsp;</p>
<p class="header">CHANGING TICKET TO BE IN PROCESS</p>

    <? if ($_GET['t']!=''){
		//$data= new getQueries ();
		?>
		<p>&nbsp;</p>
		<p style="text-align:center;font-weight:bold;font-size:18px;">Ticket number: <?=$_GET['t']?></p>
		<? if($_GET['error']){?>

		<p style="text-align:center;font-size:16px;background-color:yellow; margin:5px; padding:5px;"><?php echo $_GET['error'];?></p>
		
		<? }?>
		<table align="center"><tr><td>
		<form method="post" action="change2inprocess.php">
			<p>Delegated to: <input type="text" name="delegated" value="<?=$_POST['delegated']?>" required="required"/></p>
			<p>Estimated Time: 
				H:
				<select name="h">
					<?php  for ($i=0; $i<=24; $i=$i+0.5){?>
					<option value="<?=$i?>"><?=$i?></option>
					<?php }?>
				</select>
				D:
				<select name="d">
					<?php  for ($i=0; $i<=30; $i++){?>
					<option value="<?=$i?>"><?=$i?></option>
					<?php }?>
				</select>
			</p>
			<p style="text-align:right;"><input type="hidden" name="ticketno" value="<?=$_GET['t']?>"/>
			<input type="submit" name="process" value="Process Ticket"/></p>
		</form>
		</td></tr></table>
		<?
		
	}else{
        echo "<p style='text-align:center; color:red; font-size:16px;'>NO TICKET FOUND</p>";
	 }?>