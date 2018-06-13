<? include('menu_CSS/menu-villas.php');?>
<?php
$data= new getQueries ();
$owners=$data->show_all('owners', 'id');
?>
<p class="header">To change click on a owner below</p><hr />
<table align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><td class='centro' id="td">NAME</td><td class='centro' id="td">EMAIL</td><td class='centro' id="td" >PHONE</td><td class='centro' id="td">COUNTRY</td><td class='centro' id="td">LANGUAGE</td><td class='centro' id="td">VILLA (S)</td><td class='centro' id="td">STATUS</td></tr>
<?php
$x=0;
foreach ($owners as $k){
#echo $customers['4']['name'];
echo "<tr class='fila$x' onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='edit-owner-details.php?id=".$k['id']."'\">
<td class='derecha' id='td'>".$k['name']." ".utf8_encode($k['lastname'])."</td>".
"<td id='td'>".$k['email']."</td>".
"<td id='td'>".$k['phone']."</td>".
"<td id='td'>".$k['country']."</td>".
"<td id='td'>".$k['language']."</td>";

$villas=$data->show_data('villas', "`id_owner`=".$k['id'], 'id');

  ?>
		<td id='td'> <? foreach( $villas as $vi){ echo "(".$vi['no'].") "; }?></td>

	  <?

if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }

 if ($x==0){$x++;} elseif ($x==1){$x--;}
}
?>
</table>
