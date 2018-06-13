<? include('menu_CSS/menu-villas.php');?>
<?php
$data= new getQueries ();
$owners=$data->show_id('owners', $_GET['id']);
//echo $_GET['id'];
$ow=$owners[0];
?>

<p class="header">Editing Owner</p>
<hr />
<form name="owners" method="post"  action="edit-owner-details.php" enctype="multipart/form-data">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<!--<fieldset><legend>FEATURES</legend>-->
<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Name:<input class="input" type="text" name="name"  value="<? if ($_POST['name']){ echo $_POST['name']; }else{ echo $ow['name']; }?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Last name: <input class="input" type="text" name="lastname"  value="<? if ($_POST['lastname']){ echo $_POST['lastname']; }else{ echo $ow['lastname']; }?>" /><br /><span id="error_s"><?=$_GET['error']['lastname']?></span></p>
<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> E-mail: <input class="input" type="text" name="email"  value="<? if ($_POST['email']){ echo $_POST['email']; }else{ echo $ow['email']; }?>" /><br /><span id="error_s"><?=$_GET['error']['email']?></span></p>
<p id="fields">Passport: <input class="input" type="text" name="passport2"  value="<? if ($_POST['passport2']){ echo $_POST['passport2']; }else{ echo $ow['passport2']; }?>" /></p>
<p id="fields">Cedula: <input class="input" type="text" name="cedula2"  value="<? if ($_POST['cedula2']){ echo $_POST['cedula2']; }else{ echo $ow['cedula2']; }?>" /><br /><span id="error_s"><?=$_GET['error']['cedula']?></span></p>
<p id="fields">2nd Name and Lastname: <input class="input" type="text" name="passport"  value="<? if ($_POST['passport']){ echo $_POST['passport']; }else{ echo $ow['passport']; }?>" /></p>
<p id="fields">2nd email: <input class="input" type="text" name="cedula"  value="<? if ($_POST['cedula']){ echo $_POST['cedula']; }else{ echo $ow['cedula']; }?>" /><br /><span id="error_s"><?=$_GET['error']['cedula']?></span></p>


<p id="fields">Phone: <input class="input" type="text" name="phone"  value="<? if ($_POST['phone']){ echo $_POST['phone']; }else{ echo $ow['phone']; }?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
<p id="fields">Movil: <input class="input" type="text" name="movil"  value="<? if ($_POST['movil']){ echo $_POST['movil']; }else{ echo $ow['movil']; }?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
<p id="fields">Fax: <input class="input" type="text" name="fax"  value="<? if ($_POST['fax']){ echo $_POST['fax']; }else{ echo $ow['fax']; }?>" /></p>
<p id="fields">Zip: <input class="input" type="text" name="zip"  value="<? if ($_POST['zip']){ echo $_POST['zip']; }else{ echo $ow['zip']; }?>" /></p>


<!--</fieldset>--></td>
<td>
<!--<fieldset><legend>PRICES</legend>-->
<p id="fields">Active: <select class="input" name="active" ><!--only for admin empty for others-->
<option value="1" <? if ($ow['active']==1){ echo 'selected="selected"'; }?>>Yes</option>
<option value="0" <? if ($ow['active']==0){ echo 'selected="selected"'; }?>>No</option>
</select></p>

<p id="fields">Language: <select class="input" name="language" ><!--only for admin empty for others-->
<?
$idiomas=languageArray();
foreach($idiomas as $k=>$v){?>
	<option value="<?=$k?>" <? if ($ow['language']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
	<?
	}
	//echo "</select>";
?>

</select></p>
<!-- <input class="input" type="hidden" name="ft2"  value="" />-->

<p id="fields">Country:
<?
$country=countryArray();
echo "<select class='input' size=1 name='country'>";
foreach($country as $k=>$v){
	?>
	<option value="<?=$k?>" <? if ($ow['country']==$k) echo "selected='selected'"; ?> ><?=$v?></option>";
	<?
	}
	echo "</select>";
?>
 </p>

<p id="fields">Address: <input class="input" type="text" name="address" size="35"  value="<? if ($_POST['address']){ echo $_POST['address']; }else{ echo $ow['address']; }?>" /></p><input type="hidden" name="MAX_FILE_SIZE" value="500000"><!--500 KB-->
<p id="fields">Photo: <input class="input" name="photo" type="file" value="" /><br /><span style="color:#999"><?=$ow['photo']?></span><span id="error_s"><?=$_GET['error']['photo']?></span></p>
<p id="fields">Rent Contract: <input class="input" name="rent" type="file" value="" /><br /><span style="color:#999"><?=$ow['contract_rent']?></span><span id="error_s"><?=$_GET['error']['rent']?></span></p>
<p id="fields">Service Contract: <input class="input" name="services" type="file" value="" /><br /><span style="color:#999"><?=$ow['contract_serv']?></span><span id="error_s"><?=$_GET['error']['service']?></span></p>

<p id="fields" style="color:#00F"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Username: <input class="input" type="text" name="user"  value="<? if ($_POST['user']){ echo $_POST['user']; }else{ echo $ow['user']; }?>" /><br /><span id="error_s"><?=$_GET['error']['user']?></span></p>
<p id="fields" style="color:#00F"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Password: <input class="input" type="text" name="pass"  value="<? if ($_POST['pass']){ echo $_POST['pass']; }else{ echo $ow['pass']; }?>" /><br /><span id="error_s"><?=$_GET['error']['pass']?></span></p><!--only for admin empty for others-->

<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Company:<input class="input" size="35" type="text" name="company"  value="<? if ($_POST['company']){ echo $_POST['company']; }else{ echo $ow['company']; }?>" /></p>

<p id="fields"><span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> RNC:<input class="input" type="text" name="rnc"  value="<? if ($_POST['rnc']){ echo $_POST['rnc']; }else{ echo $ow['RNC']; }?>" /></p>

</td></tr><tr><td colspan="2">

<p id="fields">Aditional Info: <textarea class="input" name="info" style="max-width:400px;" cols="50" rows="5"><? if ($_POST['info']){ echo $_POST['info']; }else{ echo $ow['info']; }?></textarea></p>

<!--</fieldset>-->
<input type="hidden" name="id" value="<?=$_GET['id']?>" />
<input type="submit" name="new"  value="update" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td></tr></table>
</form>
<hr />
