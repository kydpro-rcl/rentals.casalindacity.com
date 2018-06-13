<?php
$data= new getQueries ();
$services=$data->show_all('excursions', 'id');
?>
<? include('menu_CSS/menu-services.php');?>
<p class="header">Showing all our Excursions</p>

<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%"><tr class="title" ><td class='centro' id="td">TITLE</td><td class='centro' id="td">PRICE ADULTS</td><td class='centro' id="td">PRICE KIDS</td><td>&nbsp;</td></tr>
<?php
$x=0;
foreach ($services as $k){
#echo $customers['4']['name'];
?>
<tr <?/* if ($_SESSION['info']['level']==1){?>onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" onclick="location.href='edit-services.php?id=<?=$k['id']?>'"<?}*/?> class="fila<?=$x?>"><td class="derecha" id='td'><?=$k['title']?></td>
<td class='centro' id='td'><?=number_format($k['price_a'],2)?> </td>
<td class='derecha' id='td'><?=number_format($k['price_c'],2)?></td>
<td><a href="change_excursion.php?i=<?=$k['id']?>">Edit</a></td>
<?

 if ($x==0){$x++;} elseif ($x==1){$x--;}
}
?>
</table>
