<? include('menu_CSS/menu-villas.php');?>
<?
if ($_GET ['id']) {
	?>

	<?
	$data = new getQueries ();
	$interm = $data->show_id ('commission', $_GET ['id'] );
	$agency = $data->show_data($table='commission', $condition="`active`='1' AND `agency`='1'", $order='id');
	$it = $interm [0];
	?>

<p class="header">Changing a Referral Agent</p>
<hr />
<form name="new_villa" method="post" action="edit-interm.php">
<table border="0" align="center" width="700" cellpadding="2"
	cellspacing="0">
	<tr>
		<td width="50%"><!--<fieldset><legend>FEATURES</legend>-->
		<p id="fields">Name:<input class="input" type="text" name="name"
			value="<?
	if ($_POST ['name']) {
		echo $_POST ['name'];
	} else {
		echo $it ['name'];
	}
	?>" /><br />
		<span id="error_s"><?=$_GET ['error']['name']?></span></p>
		<p id="fields">Last Name: <input class="input" type="text"
			name="lastname"
			value="<?
	if ($_POST ['lastname']) {
		echo $_POST ['lastname'];
	} else {
		echo $it ['lastname'];
	}
	?>" /><br />
		<span id="error_s"><?=$_GET ['error']['lastname']?></span></p>
		<p id="fields">Email: <input class="input" type="text" name="email"
			value="<?
	if ($_POST ['email']) {
		echo $_POST ['email'];
	} else {
		echo $it ['email'];
	}
	?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['email']?></span></p>
		<!-- <input class="input" type="hidden" name="ft2"  value="" />-->
		<p id="fields">URL: <input class="input" type="text" name="url"
			value="<?
	if ($_POST ['url']) {
		echo $_POST ['url'];
	} else {
		echo $it ['url'];
	}
	?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['url']?></span></p>

		<!-- <input class="input" type="hidden" name="capacity"  value="" />-->
		<!--</fieldset>--></td>
		<td>
		<p id="fields">Active: <select class="input" name="active">
			<option value="1"
				<?
	if ($it ['active'] == 1)
		echo 'selected=selected';
	?>>Yes</option>
			<option value="0"
				<?
	if ($it ['active'] == 0)
		echo 'selected=selected';
	?>>No</option>
		</select></p>
		<p id="fields">Phone: <input class="input" type="text" name="phone"
			value="<?
	if ($_POST ['phone']) {
		echo $_POST ['phone'];
	} else {
		echo $it ['phone'];
	}
	?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['phone']?></span></p>
		<p id="fields">Percent short: <input class="input" type="text"
			name="percent"
			value="<?
	if ($_POST ['percent']) {
		echo $_POST ['percent'];
	} else {
		echo ($it ['percent'] * 100);
	}
	?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['percent']?></span></p>
		<p id="fields">Percent Long: <input class="input" type="text"
			name="percentl"
			value="<?
	if ($_POST ['percent']) {
		echo $_POST ['percentl'];
	} else {
		echo ($it ['long_percent'] * 100);
	}
	?>" /><br />
		<span id="error_s"><?=$_GET ['error'] ['percent']?></span></p>
		<p id="fields">Password: <input class="input" type="text"
			name="pass"
			value="<?
	if ($_POST ['pass']) {
		echo $_POST ['pass'];
	} else {
		echo $it ['password'];
	}
	?>" /><br />
		<span style="font-size: 9px; color: grey;"><?
	echo $it ['password'];
	?></span></p>
		</td>
	</tr>
	<tr>
		<td colspan="2">
    <?
	if ($it ['tipo'] == 1) {
		?>
	<div style="float: left;">CODE FOR WIDGET BELOW<BR />
		<textarea class="input" name="comment" style="max-width: 400px;"
			cols="50" rows="5"><iframe width="213" height="193" scrolling="no"
			src="https://www.casalindacity.com/for_rent/widget_200x193.php?url=<?=$it ['url'];?>&rid=<?=$it ['id'];?>"
			frameborder="0"></iframe></textarea></div>
    <?
	}
	?>
   <div>
		<p id="fields">Comment: <textarea class="input" name="comment"
			style="max-width: 400px;" cols="50" rows="5"><?
	if ($_POST ['comment']) {
		echo $_POST ['comment'];
	} else {
		echo $it ['comment'];
	}
	?></textarea></p>
		<p id="fields">Referal Type: <select class="input" name="tipo">
			<option value="0" <?
	if ($it ['tipo'] == 0)
		echo 'selected=selected';
	?>>Rental Agent</option>
			<option value="1" <?
	if ($it ['tipo'] == 1)
		echo 'selected=selected';
	?>>WebSite</option>
	<option value="2" <?
	if ($it ['tipo'] == 2)
		echo 'selected=selected';
	?>>Sale Agent</option>
    <option value="3" <?
	if ($it ['tipo'] == 3)
		echo 'selected=selected';
	?>>Booking Engine</option>
		</select></p>
		<?
		if(!$_GET['a']){
			if ($it ['agency'] == 1){$_GET['a']=11;}
		}
		?>
		<p id="fields">Owner of Agency?: <select class="input" onchange="window.location='edit-interm.php?id=<?=$_GET['id']?>&a='+this.value+1" name="agency">
			<option value="0"  <?if($_GET['a']==01) echo 'selected="selected"';?>>No</option>
			<option value="1" <?if($_GET['a']==11) echo 'selected="selected"';?>>Yes</option>
		</select> 
		<? if(($_GET['a']==01)||($_GET['a']==0)){?>
		Connected to agency?:
		<select class="input" name="agency_user">
			<option value="0">None</option>
			<? if($agency){
				foreach($agency AS $k){?>
				<option value="<?=$k['id']?>" <? if ($it ['agency_user'] == $k['id']) echo 'selected="selected"'; ?>><?=$k['name']?> <?=$k['lastname']?></option>	
				<?	
				}				
			}?>
		</select>
		<?}?>
		</p>
		</div>

		<!--</fieldset>--> <input type="hidden" name="id"
			value="<?=$_GET ['id']?>" /> <input type="submit" name="new"
			value="Update" class="book_but" /></td>
	</tr>
</table>
</form>
<hr />

<?
} else {
	?>

	<?php
	$data = new getQueries ();
	$commisioners = $data->show_all ( 'commission', 'id' );
	?>
<!--<p>&nbsp;</p>-->
<br />
<p class="header">Click on a Referal Angent to change it</p>
<table align="center" cellpadding="2" cellspacing="2" border="0">
	<tr class="title">
		<td class='centro' id="td">NAME</td>
		<td class='centro' id="td">EMAIL</td>
		<td class='centro' id="td">URL</td>
		<td class='centro' id="td">PHONE</td>
		<td class='centro' id="td">SHORT %</td>
		<td class='centro' id="td">LONG %</td>
		<td class='centro' id="td">STATUS</td>
	</tr>
    <?php
	$x = 0;
	foreach ( $commisioners as $k ) {
		#echo $customers['4']['name'];
		echo "<tr class='fila$x' onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='edit-interm.php?id=" . $k ['id'] . "'\"><td class='derecha' id='td'>" . $k ['name'] . " " . $k ['lastname'] . "</td>" . "<td id='td'>" . $k ['email'] . " </td>" . "<td id='td'>" . $k ['url'] . "</td>" . "<td id='td'>" . $k ['phone'] . "</td>" . "<td id='td'>" . ($k ['percent'] * 100) . " % </td>" . "<td id='td'>" . ($k ['long_percent'] *100) . " % </td>";
		if ($k ['active'] == 1) {
			echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }

     if ($x==0){$x++;} elseif ($x==1){$x--;}
    }
    ?>
    </table>
<? }?>