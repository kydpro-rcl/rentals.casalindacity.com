<?php
$data= new getQueries ();
$customers=$data->show_client_mod($_GET['id']);
$total_records=$data->getAffectedRows();
?>

<p class="header">Modifications for Customer Number <?=$_GET['id']?></p>
<p style="font-size:10px; padding-left:15px;"><strong>Total modifications: <?=$total_records?></strong></p>
<hr />
<table width=400 align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><tr class="title"><td class='centro' id="td">NO</td><td class='centro' id="td">DATE</td><td class='centro' id="td">BY</td></tr>
<?php

$x=0;
$count=1;
foreach ($customers as $k){
#echo $customers['4']['name'];
$id=$k['id'];
echo "<tr class='fila$x'  onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"onmouseout=\"this.style.backgroundColor=''\" onclick=\"reserva('client_modification_details.php?id=$id','Details for Selection', 530, 800)\" >
<td id='td' class='derecha'>".$count."</td>".
"<td id='td'>".$k['date_mod']."</td>";?>
<td id='td'><? $users=new subDB(); $user=$users->userDetails($k['id_adm_mod']); echo $user['name'];?></td></tr>
<?
 if ($x==0){$x++;} elseif ($x==1){$x--;}
#echo $k['date_mod']."<br>";
$count++;
}

?>
</table>
