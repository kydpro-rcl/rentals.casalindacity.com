<?php
$data= new getQueries ();
$services=$data->show_all('serv_add', 'id');
?>
<? include('menu_CSS/menu-services.php');?>
<p class="header">Booking system - Additional Services</p>

<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%"><tr class="title" ><td class='centro' id="td">NAME</td><td class='centro' id="td">TYPE</td><td class='centro' id="td">PRICE</td><td class='centro' id="td">DESCRIPTION</td><td class='centro' id="td">STATUS</td></tr>
<?php
$x=0;
foreach ($services as $k){
#echo $customers['4']['name'];
?>
<tr <? if ($_SESSION['info']['level']==1){?>onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" onclick="location.href='edit-services.php?id=<?=$k['id']?>&t=<?=$k['type']?>'"<?}?> class="fila<?=$x?>"><td class="derecha" id='td'><?=$k['name']?></td>
<td class='centro' id='td'><?=ucfirst($k['type'])?> </td>
<td class='derecha' id='td'><?=number_format($k['price'],0)?><? if ($k['type']=="Car_Rental"){ echo "-".number_format($k['price_min'],0);}?></td>
<td class='descrip' ><?=$k['description']?></td>
<?
if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }

 if ($x==0){$x++;} elseif ($x==1){$x--;}
}
?>
</table>
