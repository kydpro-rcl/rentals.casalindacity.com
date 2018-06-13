<script type="text/javascript" src="js/confirm.js"></script>
<? include('menu_CSS/menu-services.php');?>
<?php
$data= new getQueries ();
$services=$data->show_all('serv_add', 'id');
?>
<p class="header">Deleting - Additional Services</p>

<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%"><tr class="title" ><td class='centro' id="td">NAME</td><td class='centro' id="td">TYPE</td><td class='centro' id="td">PRICE</td><td class='centro' id="td">DESCRIPTION</td><td class='centro' id="td">STATUS</td></tr>
<?php
$x=0;
foreach ($services as $k){
#echo $customers['4']['name'];
?>
<tr class="fila<?=$x?>">
	<td class="derecha" id='td'>
  	<a href="dis-services.php?del=<?=$k['id']?>" onclick="return confirmSubmit()" >
  		<img src="images/b_drop.png" title="delete" alt="delete" width="16px" height="16px" border="0" />
  	</a>
<?=$k['name']?></td>
<td class='centro' id='td'><?=ucfirst($k['type'])?> </td>
<td class='derecha' id='td'><?=$k['price']?></td>
<td class='descrip' ><?=$k['description']?></td>
<?
if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }

 if ($x==0){$x++;} elseif ($x==1){$x--;}
}
?>
</table>