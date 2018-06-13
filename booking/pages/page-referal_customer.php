<p>&nbsp;</p>
<p>&nbsp;</p>
 <p>&nbsp;</p>
<p>&nbsp;</p>
<hr />
<form name="new_villa" method="post"  action="referal_customer.php">
<p class="header">Do you need New Referal for this client?
	<br/>
	<br/>
	<select class="input" name="referal" onchange="window.location='referal_customer.php?ref='+this.value">
		<option value="no" <? if ((!$_POST['referal'])&&(!$_GET['ref'])) echo "selected='selected'"; ?>
		<? if (($_POST['referal']=="no")||($_GET['ref']=="no")) echo "selected='selected'"; ?>>No</option>
		<option value="yes" <? if (($_POST['referal']=="yes")||($_GET['ref']=="yes")) echo "selected='selected'"; ?>>Yes</option>
	</select>

	<input type="submit" name="new"  value="Continue" class="book_but" />
</p>

</form>
<hr />