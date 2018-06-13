<p class="header">Create New Customer</p>
<hr />
<form name="new_villa" method="post"  action="new-client.php" enctype="multipart/form-data">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">

<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Name:<input class="input" type="text" name="name"  value="<?=$_POST['name']?>" />
<br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Last name: <input class="input" type="text" name="lastname"  value="<?=$_POST['lastname']?>" />
<br /><span id="error_s"><?=$_GET['error']['lastname']?></span></p>

<p id="fields">Passport: <input class="input" type="text" name="passport"  value="<?=$_POST['passport']?>" />
<br /><span id="error_s"><?=$_GET['error']['passport']?></span></p>
<p id="fields">Cedula: <input class="input" type="text" name="cedula"  value="<?=$_POST['cedula']?>" />
<br /><span id="error_s"><?=$_GET['error']['cedula']?></span></p>

<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> E-mail: <input class="input" type="text" name="email"  value="<?=$_POST['email']?>" />
<br /><span id="error_s"><?=$_GET['error']['email']?></span></p>
<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Phone: <input class="input" type="text" name="phone"  value="<?=$_POST['phone']?>" />
<br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
<p id="fields">Phone 2: <input class="input" type="text" name="phone2"  value="<?=$_POST['phone2'];?>" /></p>
<p id="fields">Fax: <input class="input" type="text" name="fax"  value="<?=$_POST['fax']?>" /></p>
</td>
<td>

<p id="fields">
	Active:
    <select class="input" name="active" >
    	<option value="1" <? if (!$_POST['active']){?> selected="selected" <? }?> <? if ($_POST['active']=='1'){?>selected="selected" <? }?>> Yes </option>
		<option value="0" <? if ($_POST['active']=='0'){?> selected="selected" <? }?>> No </option>
	</select>
</p>
<p id="fields">
	Language:
    <select class="input" name="language" >
		<?
		$idiomas=languageArray();
		foreach($idiomas as $k=>$v){?>
			<option value="<?=$k?>" <? if ($_POST['language']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
		<? } ?>
	</select>
</p>
<p id="fields">Country:
<!--//NUEVO CODIGO AQUI//-->
 <select class="input" id='countrySelect' name='country'  onchange='populateState()'>
    </select>
<!--//NUEVO CODIGO AQUI//-->
 </p>

<!--//BELOW STARTING CITIES FOR COUNTRY//-->
<p id="fields">State/Province:

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

<p id="fields">City/Town: <input class="input" type="text" name="city" value="<?=$_POST['city']?>"/></p>
<p id="fields">Zip: <input class="input" type="text" name="zip"  value="<?=$_POST['zip']?>" /></p>
<p id="fields">Address: <input class="input" type="text" name="address" size="35"  value="<?=$_POST['address']?>" /></p>




<? /*conectar a base de datos para extraer los id de los intermediarios*/?>
<p id="fields">Rental Agent: <select class="input" name="intermediario" ><!--only for admin empty for others-->
<option value="0" selected="selected">None</option>
<? $int=new getQueries(); $inter=$int->show_all_active('commission','id');
foreach ($inter as $k){?>
	<option value="<?=$k['id']?>" <? if ($_POST['intermediario']==$k['id']) echo "selected='selected'"; ?>><? echo $k['name']." ".$k['lastname'];?></option>
<?	//echo "<option value=\"".$k['id']."\">".$k['name']." ".$k['lastname']."</option>";

	}
?>


</select></p>

<p id="fields">Sale Agent: <select class="input" name="sale" ><!--only for admin empty for others-->
<option value="0" selected="selected">None</option>
<? $int=new getQueries(); $inter=$int->show_all_active('commission','id');
foreach ($inter as $k){?>
	<option value="<?=$k['id']?>" <? if ($_POST['sale']==$k['id']) echo "selected='selected'"; ?>><? echo $k['name']." ".$k['lastname'];?></option>
<?	//echo "<option value=\"".$k['id']."\">".$k['name']." ".$k['lastname']."</option>";

	}
?>


</select></p>



<p id="fields">Photo: <input type="hidden" name="MAX_FILE_SIZE" value="500000"><!--500 KB-->
<input class="input" name="photo" type="file" value="<?=$_POST['photo']?>">
<br /><span id="error_s"><?=$_GET['error']['photo']?></span></p>



 <? if ($_SESSION['info']['level']==1){?>
	<p id="fields">Classification:
	<select class="input" name="class" >
		<option value="0" selected="selected">Normal</option>
		<option value="1" >VIP</option>
	</select>
	</p>
  <? }else{?>
   		<input type="hidden" name="class"  value="0" />
   <? }?>

   <p id="fields">Password: <input class="input" type="password" name="password"  value="<?=$_POST['password']?>" /></p>
</td></tr><tr>
<td>
<fieldset><legend>Emergency Contact</legend>
<!--<p id="fields">Emergency Contact</p>-->
<p id="fields">Name: <input class="input" type="text" name="name_emerg" size="35"  value="<?=$_POST['name_emerg']?>" /></p>
<p id="fields">Phone: <input class="input" type="text" name="phone_emerg"  value="<?=$_POST['phone_emerg']?>" /></p>
</fieldset>
</td>
<td >



<p id="fields" style="text-align:left;">Aditional Info: <textarea class="input" name="info" style="max-width:400px;" cols="50" rows="5"><?=$_POST['info']?></textarea></p>
</td></tr>

<tr><td><input type="submit" name="new"  value="Create" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td><td align="right"> <span style="color:red; font-size:10px; margin:0px; padding:0px; text-align:right">* Required Fields</span></td></tr></table>
</form>
<hr />