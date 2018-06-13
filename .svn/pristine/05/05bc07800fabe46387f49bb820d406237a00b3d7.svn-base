<? include('menu_CSS/menu-admin.php');?>
<?php
$data= new getQueries ();

if (!$_GET['id']){
	$users=$data->show_all_different_to('users', $_SESSION['info']['id']);
	?>
<p class="header">Click on a user to edit</p><hr />
	<table align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><td class='centro' id="td">USER</td><td class='centro' id="td">NAME</td><td class='centro' id="td">LEVEL</td><td class='centro' id="td">EMAIL</td><td class='centro' id="td">PHONE</td><td class='centro' id="td">STATUS</td></tr>
	<?php
	$x=0;
	foreach ($users as $k){
	#echo $customers['4']['name'];
	echo "<tr class='fila$x' onclick=\"location.href='edit-user.php?id=".$k['id']."'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"><td class='derecha' id='td'>".$k['user']."</td>".
	"<td id='td'> ".$k['name']." ".utf8_encode($k['lastname'])."</td>".
	"<td class='centro' id='td'>".$k['level']."</td>".
	"<td id='td'>".$k['email']."</td>".
	"<td id='td'>".$k['phone']."</td>";
	if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }

	 if ($x==0){$x++;} elseif ($x==1){$x--;}
	}
	echo '</table>';
}else{
	//echo $_GET['id'];
	$user=$data->show_id('users', $_GET['id']);
	$u=$user[0];
?>
	<p class="header">Changing User</p>
	<hr />
	<form name="edituser" method="post"  action="edit-user.php">
	<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
	<!--<fieldset><legend>FEATURES</legend>-->
	<p id="fields">Name:<input class="input" type="text" name="name"  value="<?=$u['name']?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
	<p id="fields">Last Name<input class="input" type="text" name="lastname"  value="<?=$u['lastname']?>" /><br /><span id="error_s"><?=$_GET['error']['lastname']?></span></p>
	<p id="fields">E-mail: <input class="input" type="text" name="email"  value="<?=$u['email']?>" /><br /><span id="error_s"><?=$_GET['error']['email']?></span></p>
	<p id="fields">Phone: <input class="input" type="text" name="phone"  value="<?=$u['phone']?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>


	</td>
	<td>

	<? if ($u['level']!=1){ ?>
    <p id="fields">Level: <select class="input" name="level" ><!--only for admin empty for others-->
	<!--<option value="1">Level 1</option>--><!--ESTA OPTION DEBE APARECER COMENTADA-->
	<option value="2" <? if ($u['level']==2) echo 'Selected=\"selected\"';?> >Level 2</option>
	<option value="3" <? if ($u['level']==3) echo 'Selected=\"selected\"';?> >Level 3</option>
	<option value="4" <? if ($u['level']==4) echo 'Selected=\"selected\"';?> >Level 4</option>
	<option value="5" <? if ($u['level']==5) echo 'Selected=\"selected\"';?> >Level 5</option>
	<option value="6" <? if ($u['level']==6) echo 'Selected=\"selected\"';?> >Tickets</option>
	</select></p>
    <? }else{ ?>
    <input type="hidden" name="level" value="<?=$u['level']?>" />
    <? } ?>
	<p id="fields">Active:<select name="active" class="input" >
	<option value="1" <? if ($u['active']==1) echo 'Selected=\"selected\"';?> >Yes</option>
	<option value="0" <? if ($u['active']==0) echo 'Selected=\"selected\"';?> >No</option>
	</select>
	</p>
	<p id="fields">
		Receive Tickets:
		<select name="report" class="input" >
			<?php
				$options=departments();
				foreach($options as $k=>$v){
					?>
					<option value="<?=$k?>" <? if ($u['report']==$k) echo 'Selected=\"selected\"';?> ><?=$v?></option>
					<?php
				}
			?>
		</select>
	</p>
	<p id="fields">Receive Email:<select name="noemails" class="input" >
	<option value="0" <? if ($u['noemails']==0) echo 'Selected=\"selected\"';?> >Yes</option>
	<option value="1" <? if ($u['noemails']==1) echo 'Selected=\"selected\"';?> >No</option>
	</select>
	</p>
	</td></tr><tr><td colspan="2">
	<p id="fields">Aditional Info: <textarea class="input" name="info" style="max-width:400px;" cols="50" rows="5"> <?=$u['info']?> </textarea></p>

	<!--</fieldset>-->
	<input type="hidden" name="id" value="<?=$_GET['id']?>" />
	<input type="submit" name="update"  value="update" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td></tr></table>
	</form>
	<hr />
<?
}
?>

