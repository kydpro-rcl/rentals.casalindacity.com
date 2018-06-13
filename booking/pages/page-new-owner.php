<? include('menu_CSS/menu-villas.php');?>
<p class="header">New Owner</p>
<hr />
<form name="owners" method="post"  action="new-owner.php" enctype="multipart/form-data">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<!--<fieldset><legend>FEATURES</legend>-->
<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Name:<input class="input" type="text" name="name"  value="<?=$_POST['name']?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Last name: <input class="input" type="text" name="lastname"  value="<?=$_POST['lastname']?>" /><br /><span id="error_s"><?=$_GET['error']['lastname']?></span></p>
<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> E-mail: <input class="input" type="text" name="email"  value="<?=$_POST['email']?>" /><br /><span id="error_s"><?=$_GET['error']['email']?></span></p>
<p id="fields">Passport: <input class="input" type="text" name="passport2"  value="<?=$_POST['passport2']?>" /></p>
<p id="fields">Cedula: <input class="input" type="text" name="cedula2"  value="<?=$_POST['cedula2']?>" /><br /><span id="error_s"><?=$_GET['error']['cedula']?></span></p>
<p id="fields">2nd Name and Lastname: <input class="input" type="text" name="passport"  value="<? if ($_POST['passport']){ echo $_POST['passport']; }else{ echo $ow['passport']; }?>" /></p>
<p id="fields">2nd email: <input class="input" type="text" name="cedula"  value="<? if ($_POST['cedula']){ echo $_POST['cedula']; }else{ echo $ow['cedula']; }?>" /><br /><span id="error_s"><?=$_GET['error']['cedula']?></span></p>

<p id="fields">Phone: <input class="input" type="text" name="phone"  value="<?=$_POST['phone']?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
<p id="fields">Movil: <input class="input" type="text" name="movil"  value="<?=$_POST['movil']?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
<p id="fields">Fax: <input class="input" type="text" name="fax"  value="<?=$_POST['fax']?>" /></p>
<p id="fields">Zip: <input class="input" type="text" name="zip"  value="<?=$_POST['zip']?>" /></p>


<!--</fieldset>--></td>
<td>
<!--<fieldset><legend>PRICES</legend>-->
<p id="fields">Active: <select class="input" name="active" ><!--only for admin empty for others-->
<option value="1" selected="selected">Yes</option>
<option value="0">No</option>
</select></p>

<p id="fields">Language: <select class="input" name="language" ><!--only for admin empty for others-->
<?
$idiomas=languageArray();
foreach($idiomas as $k=>$v){?>
	<option value="<?=$k?>" <? if ($_POST['language']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
	<?
	}
	echo "</select>";
?>
</p>
<!-- <input class="input" type="hidden" name="ft2"  value="" />-->

<p id="fields">Country:
<?
$country=countryArray();
echo "<select class='input' size=1 name='country'>";
foreach($country as $k=>$v){
	?>
	<option value="<?=$k?>" <? if ($_POST['country']==$k) echo "selected='selected'"; ?> ><?=$v?></option>";
	<?
	}
	echo "</select>";
?>
 </p>
 <input type="hidden" name="MAX_FILE_SIZE" value="500000"><!--500 KB-->
<p id="fields">Address: <input class="input" type="text" name="address" size="35"  value="<?=$_POST['address']?>" /></p>
<p id="fields">Photo: <input class="input" name="photo" type="file" value="" /><br /><span id="error_s"><?=$_GET['error']['photo']?></span></p>
<p id="fields">Rent Contract: <input class="input" name="rent" type="file" value="" /><br /><span id="error_s"><?=$_GET['error']['rent']?></span></p>
<p id="fields">Service Contract: <input class="input" name="services" type="file" value="" /><br /><span id="error_s"><?=$_GET['error']['service']?></span></p>

<p id="fields" style="color:#00F"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Username: <input class="input" type="text" name="user"  value="<?=$_POST['user']?>" /><br /><span id="error_s"><?=$_GET['error']['user']?></span></p>
<p id="fields" style="color:#00F"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Password: <input class="input" type="password" name="pass"  value="<?=$_POST['pass']?>" /><br /><span id="error_s"><?=$_GET['error']['pass']?></span></p><!--only for admin empty for others-->
<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Company:<input class="input" size="35" type="text" name="company"  value="<? if ($_POST['company']){ echo $_POST['company']; }else{ echo $ow['company']; }?>" /></p>

<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> RNC:<input class="input" type="text" name="rnc"  value="<? if ($_POST['rnc']){ echo $_POST['rnc']; }else{ echo $ow['RNC']; }?>" /></p>


<!--</fieldset>--></td></tr><tr><td colspan="2">

<!--<fieldset><legend>DETAILS</legend>-->

<p id="fields">Aditional Info: <textarea class="input" name="info" style="max-width:400px;" cols="50" rows="5"><?=$_POST['info']?></textarea></p>

<!--</fieldset>-->
<input type="submit" name="new"  value="Create" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td></tr></table>
</form>
<hr />