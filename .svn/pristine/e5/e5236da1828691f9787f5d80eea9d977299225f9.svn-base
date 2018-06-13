<h2>Cancel Booking</h2>
<p style="clear:both;">&nbsp;</p>
<hr />
<form name="new_villa" method="post"  action="cancel_booking.php">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<!--<fieldset><legend>FEATURES</legend>-->
<p id="fields" style="text-align:right">Reference Number:<input class="input" type="text" name="ref"  value="<?=$_POST['ref']?>" /><br /><span id="error_s"><?=$_GET['error']['ref']?></span></p>
<p id="fields" style="text-align:right">Cancellation from:<select name="from">
	<option value="Client" selected="selected">Client</option>
	<option value="Agent">Agent</option>
</select></span></p>
<p id="fields" style="text-align:right">Reason for Cancellation <select name="reason">
	<option value="Flights" selected="selected">Flights</option>
	<option value="Found other accommodation">Found other accommodation</option>
	<option value="Price">Price</option>
	<option value="Emergency">Emergency</option>
	<option value="Other">Other</option>
</select></p>

</td>
<td>

</td></tr>

<tr><td colspan="2">
<p id="fields">Cancellation's reasons: <textarea class="input" name="info" style="max-width:400px;" cols="50" rows="5"> <?=$_POST['info']?> </textarea><!--<br />--> <span id="error_s"><?=$_GET['error']['reasons']?></span></p>

<!--</fieldset>-->
<input type="submit" name="send"  value="Submit" class="book_but" />&nbsp;</td></tr></table>
</form>
<hr />