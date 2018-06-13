<?php
$data= new getQueries ();
$villas=$data->show_all('villas', 'id');
?>
<p class="header">To edit click on a villa below</p><hr />
<table align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><td class='centro' id="td">NO</td><td class='centro' id="td">TYPE</td><td class='centro' id="td">BEDROOMS</td><td class='centro' id="td">BATHROOM</td><td class='centro' id="td" >AC</td><td class='centro' id="td">MAX. PERSONS</td><td class='centro' id="td">RENT</td><td class='centro' id="td">SIZE</td></tr>
<?php
$x=0;
foreach ($villas as $k){
#echo $customers['4']['name'];
echo "<tr class='fila$x' onclick=\"location.href='edit-villas-details.php?id=".$k['id']."'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"><td class='derecha' id='td'>".$k['no']."</td>".
"<td id='td'>".$k['type']."</td><td class='centro' id='td'>".$k['bed']."</td>".
"<td class='centro' id='td'>".$k['bath']."</td>".
"<td class='centro' id='td'>".$k['AC']."</td><td class='centro' id='td'>".$k['capacity']."</td>";
if ($k['able_r']==1){echo "<td class='centro' id='td'>Yes</td>";}else{echo "<td class='centro rojo' id='td'>No</td>"; }
echo"<td id='td'>".number_format($k['m2'],0)." m&sup2; - ".number_format($k['ft2'],0)." ft&sup2;</td></tr>";
 if ($x==0){$x++;} elseif ($x==1){$x--;}
}
?>
</table>