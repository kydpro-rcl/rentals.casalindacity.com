<?php
/*print_r($_SESSION['referal']);*/
?>
<h2>Create New Customer</h2>
<hr style="clear:both"/>

<?php
 if($_GET['done']!=1){?>
	<form name="new_villa" method="post"  action="new_client.php" enctype="multipart/form-data">
	<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">

	<p class="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Name:<input class="input" type="text" name="name"  value="<?=$_POST['name']?>" />
	<br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
	<p class="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Last name: <input class="input" type="text" name="lastname"  value="<?=$_POST['lastname']?>" />
	<br /><span id="error_s"><?=$_GET['error']['lastname']?></span></p>

	<p class="fields">Passport: <input class="input" type="text" name="passport"  value="<?=$_POST['passport']?>" />
	<br /><span id="error_s"><?=$_GET['error']['passport']?></span></p>
	<p class="fields">Cedula: <input class="input" type="text" name="cedula"  value="<?=$_POST['cedula']?>" />
	<br /><span id="error_s"><?=$_GET['error']['cedula']?></span></p>

	<p class="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> E-mail: <input class="input" type="text" name="email"  value="<?=$_POST['email']?>" />
	<br /><span id="error_s"><?=$_GET['error']['email']?></span></p>
	
	<p class="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span>Confirm email: <input class="input" type="text" name="email2"  value="<?=$_POST['email']?>" />
	<br /><span id="error_s"><?=$_GET['error']['email']?></span></p>
	
	<p class="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Phone: <input class="input" type="text" name="phone"  value="<?=$_POST['phone']?>" />
	<br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
	<p class="fields">Phone 2: <input class="input" type="text" name="phone2"  value="<?=$_POST['phone2'];?>" /></p>
	<p class="fields">Fax: <input class="input" type="text" name="fax"  value="<?=$_POST['fax']?>" /></p>
	</td>
	<td>

	<p class="fields">
		Language:
		<select class="input" name="language" >
			<?
			$idiomas=languageArray();
			foreach($idiomas as $k=>$v){?>
				<option value="<?=$k?>" <? if ($_POST['language']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
			<? } ?>
		</select>
	</p>
	<p class="fields">Country:
	<!--//NUEVO CODIGO AQUI//-->
	 <select class="input" id='countrySelect' name='country'  onchange='populateState()'>
		</select>
	<!--//NUEVO CODIGO AQUI//-->
	 </p>

	<!--//BELOW STARTING CITIES FOR COUNTRY//-->
	<p class="fields">State/Province:

	<!--//NUEVO CODIGO AQUI//-->
	<select class="input" id='stateSelect' name='state'>
		</select>
			 <? if (!$_POST['country']) $default="CA"; if ($_POST['country']) $default=$_POST['country']; ?>
			   <script type="text/javascript">
				<!--//
			   initCountry('<?=$default?>');
			   //-->
			   </script>
	</p>
	<!--//country state end//-->

	<p class="fields">City/Town: <input class="input" type="text" name="city" value="<?=$_POST['city']?>"/></p>
	<p class="fields">Zip: <input class="input" type="text" name="zip"  value="<?=$_POST['zip']?>" /></p>
	<p class="fields">Address: <input class="input" type="text" name="address" size="35"  value="<?=$_POST['address']?>" /></p>

			


	   <p class="fields">Password: <input class="input" type="password" name="password"  value="<?=$_POST['password']?>" /><input type="hidden" name="class"  value="0" /></p>
	</td></tr><tr>
	<td>
	<fieldset><legend>Emergency Contact</legend>
	<!--<p id="fields">Emergency Contact</p>-->
	<p class="fields">Name: <input class="input" type="text" name="name_emerg" size="35"  value="<?=$_POST['name_emerg']?>" /></p>
	<p class="fields">Phone: <input class="input" type="text" name="phone_emerg"  value="<?=$_POST['phone_emerg']?>" /></p>
	</fieldset>
	</td>
	<td >



	<p class="fields" style="text-align:left;">Aditional Info: <textarea class="input" name="info" style="max-width:400px;" cols="50" rows="5"><?=$_POST['info']?></textarea></p>
	</td></tr>

	<tr><td><input type="submit" name="new"  value="Create" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td><td align="right"> <span style="color:red; font-size:10px; margin:0px; padding:0px; text-align:right">* Required Fields</span></td></tr></table>
	</form>
<?php
}else{
?>
<h2 style="color:green">Client successfully created</h2>
<?php
}?>
<hr />