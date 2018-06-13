<?php
$data= new getQueries ();
$users=$data->show_all('users', 'id');
?>
<? include('menu_CSS/menu-admin.php');?>
<p class="header">Showing all our users</p><hr />
<table align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><td class='centro' id="td">USER</td><td class='centro' id="td">NAME</td><td class='centro' id="td">LEVEL</td><td class='centro' id="td">EMAIL</td><td class='centro' id="td">PHONE</td><td class='centro' id="td">STATUS</td></tr>
<?php
$x=0;
foreach ($users as $k){
#echo $customers['4']['name'];
echo "<tr class='fila$x'><td class='derecha' id='td'>".$k['user']."</td>".
"<td id='td'> ".$k['name']." ".utf8_encode($k['lastname'])."</td>".
"<td class='centro' id='td'>".$k['level']."</td>".
"<td id='td'>".$k['email']."</td>".
"<td id='td'>".$k['phone']."</td>";
if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }

 if ($x==0){$x++;} elseif ($x==1){$x--;}
}
?>
</table>
