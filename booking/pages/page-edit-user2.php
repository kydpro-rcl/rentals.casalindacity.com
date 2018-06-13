<? include('menu_CSS/menu-admin.php');?>
<?php
$data= new getQueries ();

if (!$_GET['id']){
	$users=$data->show_all_different_to('users', $_SESSION['info']['id']);
	?>
<p class="header">Click on a user to edit as administrator</p><hr />
	<table align="center" cellpadding="2" cellspacing="2" border="0">
		<tr class="title">
			<td class='centro' id="td">USERNAME</td>
			<td class='centro' id="td">FULL NAME</td>
			<td class='centro' id="td">LEVEL</td>
			<td class='centro' id="td">EMAIL</td>
			<td class='centro' id="td">PHONE</td>
			<td class='centro' id="td">STATUS</td>
		</tr>
		<?php
		$x=0;
		foreach ($users as $k){
		#echo $customers['4']['name'];
		echo "<tr class='fila$x' onclick=\"location.href='edit-user2.php?id=".$k['id']."'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"><td class='derecha' id='td'>".$k['user']."</td>".
		"<td id='td'> ".$k['name']." ".utf8_encode($k['lastname'])."</td>".
		"<td class='centro' id='td'>".$k['level']."</td>".
		"<td id='td'>".$k['email']."</td>".
		"<td id='td'>".$k['phone']."</td>";
		if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }
		 if ($x==0){$x++;} elseif ($x==1){$x--;}
		}
		?>
	</table>
	
	<?
}else{
	//echo $_GET['id'];
	$user=$data->show_id('users', $_GET['id']);
	$u=$user[0];
?>
	<p class="header">Changing User as Administrator</p>
	<hr />
	<form name="edituser" method="post"  action="edit-user2.php">
	<table border="0" align="center" width="700" cellpadding="2" cellspacing="0">
		<tr>
			<td width="50%">
				<!--<fieldset><legend>FEATURES</legend>-->
				<p id="fields">Name:<input class="input" type="text" name="name"  value="<?=$u['name']?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
				<p id="fields">Last Name<input class="input" type="text" name="lastname"  value="<?=$u['lastname']?>" /><br /><span id="error_s"><?=$_GET['error']['lastname']?></span></p>
				<p id="fields">E-mail: <input class="input" type="text" name="email"  value="<?=$u['email']?>" /><br /><span id="error_s"><?=$_GET['error']['email']?></span></p>
				<p id="fields">Phone: <input class="input" type="text" name="phone"  value="<?=$u['phone']?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
				<p id="fields" style="color:red">Username: <input class="input" type="text" name="user"  value="<?=$u['user']?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
				<p id="fields" style="color:red">Password: <input class="input" type="password" name="pass"  value="<?=$u['pass']?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
				<p id="fields" style="color:red">
					Reception?:
					<select name="rep" class="input" >
						<option value="0" <? if ($u['reception']==0) echo 'Selected="selected"';?> >No</option>
						<option value="1" <? if ($u['reception']==1) echo 'Selected="selected"';?> >Yes</option>
					</select>
				</p>
				<p id="fields" style="color:red">Agentes?:<select name="agent" class="input" >
				<option value="0" <? if ($u['agentes']==0) echo 'Selected="selected"';?> >No</option>
				<option value="1" <? if ($u['agentes']==1) echo 'Selected="selected"';?> >Yes</option>
				</select>
				</p>
				<p id="fields" style="color:red">Cancelbooking?:<select name="cancel" class="input" >
				<option value="0" <? if ($u['cancelbooking']==0) echo 'Selected="selected"';?> >No</option>
				<option value="1" <? if ($u['cancelbooking']==1) echo 'Selected="selected"';?> >Yes</option>
				</select>
				</p>
				<p id="fields" style="color:red">Movevillas?:<select name="movi" class="input" >
				<option value="0" <? if ($u['movevillas']==0) echo 'Selected="selected"';?> >No</option>
				<option value="1" <? if ($u['movevillas']==1) echo 'Selected="selected"';?> >Yes</option>
				</select>
				</p>

			</td>
			<td>

				<?/* if ($u['level']!=1){*/ ?>
				<p id="fields"  style="color:red">
					Level: 
					<select class="input" name="level" >
						<option value="1" <? if ($u['level']==1) echo 'Selected="selected"';?>>Level 1</option>
						<option value="2" <? if ($u['level']==2) echo 'Selected="selected"';?> >Level 2</option>
						<option value="3" <? if ($u['level']==3) echo 'Selected="selected"';?> >Level 3</option>
						<option value="4" <? if ($u['level']==4) echo 'Selected="selected"';?> >Level 4</option>
						<option value="5" <? if ($u['level']==5) echo 'Selected="selected"';?> >Level 5</option>
						<option value="6" <? if ($u['level']==6) echo 'Selected="selected"';?> >Level 6</option>
					</select>
				</p>
				<?/* }else{ ?>
				<input type="hidden" name="level" value="<?=$u['level']?>" />
				<? }*/ ?>
				<p id="fields">Active:<select name="acti" class="input" >
					<option value="0" <? if ($u['active']==0) echo 'Selected="selected"';?> >No</option>
					<option value="1" <? if ($u['active']==1) echo 'Selected="selected"';?> >Yes</option>
				
				</select>
				</p>
				<p id="fields">
					Receive Tickets:
					<select name="report" class="input" >
						<?php
							$options=departments();
							foreach($options as $k=>$v){
								?>
								<option value="<?=$k?>" <? if ($u['report']==$k) echo 'Selected="selected"';?> ><?=$v?></option>
								<?php
							}
						?>
					</select>
				</p>
				<p id="fields">Receive Email:<select name="noemails" class="input" >
				<option value="1" <? if ($u['noemails']==1) echo 'Selected="selected"';?> >No</option>
				<option value="0" <? if ($u['noemails']==0) echo 'Selected="selected"';?> >Yes</option>

				</select>
				</p>
				<p id="fields"  style="color:red">
					Manager?:
					<select name="mana" class="input" >
						<option value="0" <? if ($u['manager']==0) echo 'Selected="selected"';?> >No</option>
						<option value="1" <? if ($u['manager']==1) echo 'Selected="selected"';?> >Yes</option>
					</select>
				</p>
				<p id="fields"  style="color:red">
					Features?:
					<select name="feat" class="input" >
						<option value="0" <? if ($u['contabilidad']==0) echo 'Selected="selected"';?> >N/A</option>
						<option value="1" <? if ($u['contabilidad']==1) echo 'Selected="selected"';?> >Accounting</option>
						<option value="2" <? if ($u['contabilidad']==2) echo 'Selected="selected"';?> >Housekeeping</option>
					</select>
				</p>
				<p id="fields"  style="color:red">
					Housekeeping?:
					<select name="hk" class="input" >
						<option value="0" <? if ($u['housekeeping']==0) echo 'Selected="selected"';?> >No</option>
						<option value="1" <? if ($u['housekeeping']==1) echo 'Selected="selected"';?> >Yes</option>
					</select>
				</p>
				<p id="fields"  style="color:red">
					Services?:
					<select name="serv" class="input" >
						<option value="0" <? if ($u['services']==0) echo 'Selected="selected"';?> >No</option>
						<option value="1" <? if ($u['services']==1) echo 'Selected="selected"';?> >Yes</option>
					</select>
				</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<hr />
				<input type="hidden" name="id" value="<?=$_GET['id']?>" />
				<input type="submit" name="update"  value="Change" class="book_but" />
			</td>
		</tr>
	
</table>
</form>
<?
}
?>

