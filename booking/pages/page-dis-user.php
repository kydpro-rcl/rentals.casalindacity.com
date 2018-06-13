<? include('menu_CSS/menu-admin.php');?>
<script type="text/javascript" src="js/confirm.js"></script>
<?
$data= new getQueries ();
$users=$data->show_all_different_to('users', $_SESSION['info']['id']);
	?>
<p class="header">Click on delete symbol to erase</p><hr />
	<table align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><td class='centro' id="td">USER</td><td class='centro' id="td">NAME</td><td class='centro' id="td">LEVEL</td><td class='centro' id="td">EMAIL</td><td class='centro' id="td">PHONE</td><td class='centro' id="td">STATUS</td></tr>
	<?php
	$x=0;
	//onclick=\"location.href='edit-user.php?id=".$k['id']."'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"
	foreach ($users as $k){
	#echo $customers['4']['name'];
	echo "<tr class='fila$x' ><td class='derecha' id='td'>"; ?>
	<a href="dis-user.php?del=<?=$k['id']?>" onclick="return confirmSubmit()" > <img src="images/b_drop.png" title="delete" alt="delete" width="16px" height="16px" border="0" /></a>
	<?
	echo $k['user']."</td>".
	"<td id='td'> ".$k['name']." ".utf8_encode($k['lastname'])."</td>".
	"<td class='centro' id='td'>".$k['level']."</td>".
	"<td id='td'>".$k['email']."</td>".
	"<td id='td'>".$k['phone']."</td>";
	if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }

	 if ($x==0){$x++;} elseif ($x==1){$x--;}
	}
	echo '</table>';

	?>