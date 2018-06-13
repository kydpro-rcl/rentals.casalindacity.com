<? include('menu_CSS/menu-villas.php');?>
<p class="header">New Referral Agent</p>
<hr />
<?
$data = new getQueries ();
$agency = $data->show_data($table='commission', $condition="`active`='1' AND `agency`='1'", $order='id');
?>
<form name="new_villa" method="post" action="new-interm.php">
<table border="0" align="center" width="700" cellpadding="2"
	cellspacing="0">
	<tr>
		<td width="50%"><!--<fieldset><legend>FEATURES</legend>-->
		<p id="fields"><span
			style="color: red; font-size: 10px; margin: 0px; padding: 0px;">*</span>
		Name:<input class="input" type="text" name="name"
			value="<?=$_POST ['name']?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['name']?></span></p>
		<p id="fields"><span
			style="color: red; font-size: 10px; margin: 0px; padding: 0px;">*</span>
		Last name: <input class="input" type="text" name="lastname"
			value="<?=$_POST ['lastname']?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['lastname']?></span></p>
		<p id="fields"><span
			style="color: red; font-size: 10px; margin: 0px; padding: 0px;">*</span>
		Email: <input class="input" type="text" name="email"
			value="<?=$_POST ['email']?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['email']?></span></p>
		<!-- <input class="input" type="hidden" name="ft2"  value="" />-->
		<p id="fields">URL: <input class="input" type="text" name="url"
			value="<?=$_POST ['url']?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['url']?></span></p>

		<!-- <input class="input" type="hidden" name="capacity"  value="" />-->
		<!--</fieldset>--></td>
		<td>
		<p id="fields">Active: <select class="input" name="active">
			<option value="1">Yes</option>
			<option value="0">No</option>
		</select></p>
		<p id="fields"><span
			style="color: red; font-size: 10px; margin: 0px; padding: 0px;">*</span>
		Phone: <input class="input" type="text" name="phone"
			value="<?=$_POST ['phone']?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['phone']?></span></p>
		<p id="fields"><span
			style="color: red; font-size: 10px; margin: 0px; padding: 0px;">*</span>
		Percent Short: <input class="input" type="text" name="percent"
			value="<?=$_POST ['percent']?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['percent']?></span></p>
		<p id="fields"><span
			style="color: red; font-size: 10px; margin: 0px; padding: 0px;">*</span>
		Percent Long: <input class="input" type="text" name="percentl"
			value="<?=$_POST ['percentl']?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['percent']?></span></p>
		<p id="fields">Password: <input class="input" type="password"
			name="pass" value="<?
			if ($_POST ['pass']) {
				echo $_POST ['pass'];
			}
			?>" /></p>
		</td>
	</tr>
	<tr>
		<td colspan="2"><!--<fieldset><legend>DETAILS</legend>-->

		<p id="fields">Comment: <textarea class="input" name="comment"
			style="max-width: 400px;" cols="50" rows="5"><?=$_POST ['comment']?></textarea></p>
		<p id="fields">Referal Type: <select class="input" name="tipo">
			<option value="0">Rental Agent</option>
			<option value="1">WebSite</option>
			<option value="2">Sale Agent</option>
            <option value="3">Booking Engine</option>
		</select></p>
		<p id="fields">Owner of Agency?: <select class="input" onchange="window.location='new-interm.php?id=<?=$_GET['id']?>&a='+this.value" name="agency">
			<option value="0" <?if($_GET['a']==0) echo 'selected="selected"';?>>No</option>
			<option value="1"<?if($_GET['a']==1) echo 'selected="selected"';?>>Yes</option>
		</select> 
		<? if($_GET['a']==0){?>
		Connected to agency?:
		<select class="input" name="agency_user">
			<option value="0">None</option>
			<? if($agency){
				foreach($agency AS $k){?>
				<option value="<?=$k['id']?>"><?=$k['name']?> <?=$k['lastname']?></option>	
				<?	
				}			
			}?>
		</select>
		<?}?>
		</p>
		<!--</fieldset>--> <input type="submit" name="new" value="Create"
			class="book_but" />&nbsp;<input type="reset" name="clear"
			value="Clean" class="book_but" /></td>
	</tr>
</table>
</form>
<hr />