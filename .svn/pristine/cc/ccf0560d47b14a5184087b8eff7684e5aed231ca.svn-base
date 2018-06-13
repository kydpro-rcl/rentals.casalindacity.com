<?php
$data= new getQueries ();
$services=$data->show_all('service_type', 'id');
?>
<p class="header">Booking system - Type of Services</p>

<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%"><tr class="title" ><td class='centro' id="td">TYPE</td><td class='centro' id="td">MSG</td><td class='centro' id="td">NAME LINK</td><td class='centro' id="td">LINK</td></tr>
<?php
$x=0;
foreach ($services as $k){
#echo $customers['4']['name'];
?>
<tr <? if ($_SESSION['info']['level']==1){?>onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" onclick="location.href='edit-service_type.php?id=<?=$k['id']?>'"<?}?> class="fila<?=$x?>"><td class="derecha" id='td'><?=$k['tipo']?></td>
<td class='centro' id='td'><?=ucfirst($k['message'])?> </td>
<td class='derecha' id='td'><?=$k['name_link']?> </td>
<td class='descrip' ><?=$k['link']?></td>
<?


 if ($x==0){$x++;} elseif ($x==1){$x--;}
}
?>
</table>
