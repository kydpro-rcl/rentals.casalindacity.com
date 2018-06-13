<?
if (($_GET['no']!='')||($_POST['no']!='')){
 // echo "Find client";
  if ($_GET['no']) $id=$_GET['no'];
  if ($_POST['no']) $id=$_POST['no'];
  $db= new getQueries();
  $result=$db->customer($id);
  if ($result){
	  /*START EDITING CUSTOMERS*/
	  	/*$ag=AgentClient($tipo='sale',$idclient='3904',$idagent='165');
		print_r($ag);*/
		/*
		  $agr=AgentClient($tipo='rental',$idclient=7);	#rental agent
		  
		  print_r($agr);
		  echo "<br/>";
		  echo $agr['fecha'];
		  echo "<br/>";
		  $start=date('Y-m-d',strtotime($agr['fecha']));
		  $diasFechas=days_dates($start, $end='');# 18 meses rental
		  
		  echo $diasFechas;
		  echo "<br/>";
		  echo AGENTTIME;*/
	  ?>
	  
		<p class="header">Changing Customer</p>
		<hr />
		<form name="new_villa" method="post"  action="edit-clients.php" enctype="multipart/form-data">
		<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
		<!--<fieldset><legend>FEATURES</legend>-->
		<p id="fields">Name:<input class="input" type="text" name="name"  value="<?=$result['name']?>" />
		<br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
		<p id="fields">Last name: <input class="input" type="text" name="lastname"  value="<?=$result['lastname']?>" />
		<br /><span id="error_s"><?=$_GET['error']['lastname']?></span></p>

		<p id="fields">Passport: <input class="input" type="text" name="passport"  value="<?=$result['passport']?>" />
		<br /><span id="error_s"><?=$_GET['error']['passport']?></span></p>
		<p id="fields">Cedula: <input class="input" type="text" name="cedula"  value="<?=$result['cedula']?>" />
		<br /><span id="error_s"><?=$_GET['error']['cedula']?></span></p>

		<p id="fields">E-mail: <input class="input" type="text" name="email"  value="<?=$result['email']?>" />
		<br /><span id="error_s"><?=$_GET['error']['email']?></span></p>
		<p id="fields">Phone: <input class="input" type="text" name="phone"  value="<?=$result['phone']?>" />
		<br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
		<p id="fields">Phone 2: <input class="input" type="text" name="phone2"  value="<?=$result['phone2']?>" /></p>
		<p id="fields">Fax: <input class="input" type="text" name="fax"  value="<?=$result['fax']?>" /></p>
		</td>
		<td>

		<p id="fields">Active: <select class="input" name="active" ><!--only for admin empty for others-->
		<option value="1" <? if ($result['active']=='1'){?>selected="selected" <? }?>>Yes</option>
		<option value="0" <? if ($result['active']=='0'){?>selected="selected" <? }?>>No</option>
		</select></p>
		<p id="fields">Language: <select class="input" name="language" >
		<?
		$idiomas=languageArray();
		foreach($idiomas as $k=>$v){?>
			<option value="<?=$k?>" <? if ($result['language']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
			<?
			}

		?>
		</select></p>
		<p id="fields">Country:
		<?
		$country=countryArray();
		echo "<select class='input' size=1 name='country' onchange=\"window.location='edit-clients.php?no=$id&co='+this.value\">";
		foreach($country as $k=>$v){

			?>
			<option value="<?=$k?>" <? if (!$_GET['co']){if ($result['country']==$k) echo "selected='selected'"; }else{if ($_GET['co']==$k) echo "selected='selected'";}?> ><?=$v?></option>
			<?
			}
			echo "</select>";
		?>
		 </p>

	<!--//BELOW STARTING CITIES FOR COUNTRY//-->
	<p id="fields">State/Province: <?

	if (!$_GET['co'])$_GET['co']=$result['country'];

	$states=cities($_GET['co']);

		if ($states){?>
			<select class='input' size=1 name='state' >
			<?
			foreach($states as $k=>$v){?>
			    <option value="<?=$k?>" <? if ($result['state']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
			<?}
			 echo "</select>";
		}else{?>
			<input class="input" type="text" name="state" value="<?=$result['state']?>"/>
		<?}?>
	</p>
	<!--//country state end//-->

	<p id="fields">City/Municipe: <input class="input" type="text" name="city" value="<?=$result['city']?>"/></p>
    <p id="fields">Zip: <input class="input" type="text" name="zip"  value="<?=$_POST['zip']?>" /></p>
	<p id="fields">Address: <input class="input" type="text" name="address" size="35"  value="<?=$result['address']?>" /></p>

		<? /*conectar a base de datos para extraer los id de los intermediarios*/?>
		<p id="fields">Rental Agent: <select class="input" name="intermediario" ><!--only for admin empty for others-->
		<option value="0" selected="selected">None</option>
		<? $int=new getQueries(); $inter=$int->show_all_active('commission','id');
		foreach ($inter as $k){?>
			<option value="<?=$k['id']?>" <? if ($result['id_commission']==$k['id']) echo "selected='selected'"; ?>><? echo $k['name']." ".$k['lastname'];?></option>
		<?

			}
		?>
		</select></p>
		
		<p id="fields">Sale Agent: <select class="input" name="sale" ><!--only for admin empty for others-->
		<option value="0" selected="selected">None</option>
		<? $int=new getQueries(); $inter=$int->show_all_active('commission','id');
		foreach ($inter as $k){?>
			<option value="<?=$k['id']?>" <? if ($result['id_seller']==$k['id']) echo "selected='selected'"; ?>><? echo $k['name']." ".$k['lastname'];?></option>
		<?

			}
		?>
		</select></p>



		<p id="fields">Photo: <input type="hidden" name="MAX_FILE_SIZE" value="500000"><!--500 KB-->
		<input class="input" name="photo" type="file" value="<?=$result['photo']?>">
		<br /><span id="error_s"><?=$_GET['error']['photo']?></span><? if ($result['photo']!=''){?><br />
        <span style="color:#999; font-weight:normal; font-size:9px;"><?=$result['photo']?></span><? }?></p>
		<!--only for admin empty for others-->


<!--<fieldset><legend>DETAILS</legend>-->
        <? if ($_SESSION['info']['level']==1){?>
			<p id="fields">Classification:
			<select class="input" name="class" >
				<option value="0" <? if ($result['classify_cust']==0){?> selected="selected" <?}?>>Normal</option>
				<option value="1" <? if ($result['classify_cust']==1){?> selected="selected" <?}?>>VIP</option>
			</select>
			</p>
	 	<? }else{?>
	   		<input type="hidden" name="class"  value="<?=$result['classify_cust']?>" />
	   	<? }?>

<p id="fields">Change password: <input class="input" type="password" name="password"  value="<?=$result['password']?>" /><br/><span style="font-size:9px; color:green;"> Current Password: </span><span style="color:red;"><?=$result['pass']?></span></p>
		<!--</fieldset>--></td></tr><tr>
<td>
<fieldset><legend>Emergency Contact</legend>
<!--<p id="fields">Emergency Contact</p>-->
<p id="fields">Name: <input class="input" type="text" name="name_emerg" size="35"  value="<?=$result['ename']?>" /></p>
<p id="fields">Phone: <input class="input" type="text" name="phone_emerg"  value="<?=$result['ephone']?>" /></p>
</fieldset>
<input type="submit" name="update"  value="Update" class="book_but" />
</td>

	<td >	<p id="fields" style="text-align:left;">Aditional Info: <textarea class="input" name="info" style="max-width:400px;" cols="50" rows="5"><?=$result['info']?></textarea></p>

		<!--</fieldset>-->
        <input type="hidden" name="no" value="<?=$id?>" />
		&nbsp;<!--<input type="reset" name="clear"  value="Clean" class="book_but" />--></td></tr>	</table>

		</form>
		<hr /><?
	    /*END EDITING CUSTOMERS*/
	  }else{
		echo "<p>&nbsp;</p>";
		echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No customer found with this number.<p><br>";
		echo "<p class='centro'><img src=\"images/loading.gif\"/> Going back in 3 seconds...</p><br>";
		echo ("<meta http-equiv=\"refresh\" content=\"3;url=edit-clients.php\">");
	  }

}else{
?>
<div style="padding-left:35px">

<p class="header">Type customer's number to edit below</p>
<p>&nbsp;</p>
<form method="post" action="edit-clients.php">
Customer Number: <input class="input" type="text" size="10" name="no" value="<?=$_POST['search']?>"  />
<input class="book_but" type="submit" name="edit" value="Change" />
</form></div><hr />
<?
}
?>