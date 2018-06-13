<? include('menu_CSS/menu-villas.php');?>



<?php
//delete the owner said here
if ($_SESSION['info']['services']==1){
	if($_GET['id']){
		$db= new subDB();
		$fecha=date("Y-m-d G:i:s");
		$fields=array('active'=>$active, 'id_adm'=>$_SESSION['info']['id']);
		$datos=$db->update($id=$_GET['id'], $fields, 'owners');
	}
}
$data= new getQueries ();
if($_GET['sort']){
 $owners=$data->show_all_active('owners', $_GET['sort']);
}else{
$owners=$data->show_all_active('owners', 'name');
}
?>
 <? if ($_SESSION['info']['level']<=3){?>
	<p class="header">Click on view column to show owner's details</p>
	<a href="export_to_excel_owners.php?sort=<?=$_GET['sort']?>">Export to Excel</a>
	<hr />
 <?}else{?>
   <p class="header">Owners</p><hr />
 <?}?>
<table align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title">
<td class='centro' id="td"><a href="view-owners.php?sort=name">ID</a></td>
<td class='centro' id="td"><a href="view-owners.php?sort=lastname">LASTNAME</a></td>
<td class='centro' id="td"><a href="view-owners.php?sort=name">NAME</a></td>
 <? /*if ($_SESSION['info']['level']<=3){*/?>
 	<td class='centro' id="td"><a href="view-owners.php?sort=email">EMAIL</a></td>
	<td class='centro' id="td" ><a href="view-owners.php?sort=phone">PHONE</a></td>
	<td class='centro' id="td"><a href="view-owners.php?sort=country">COUNTRY</a></td>
	<td class='centro' id="td"><a href="view-owners.php?sort=language">LANGUAGE</a></td>
 <?/*}*/?>
  <td class='centro' id="td"><a href="view-owners.php?sort=language">VILLA (S)</a></td>
 <?/* if ($_SESSION['info']['level']<=3){*/?>
	<td class='centro' id="td"><a href="view-owners.php?sort=active">View</a></td>
	
<?php
if ($_SESSION['info']['services']==1){
	?>
	<td class='centro' id="td"><a href="view-owners.php?sort=active">Delete</a></td>
<?}?>	
	
	
	</tr>
  <?/*}*/?>
<?php
$x=0;
foreach ($owners as $k){
#echo $customers['4']['name'];
?>
<tr class="fila<?=$x?>" >
<td class='derecha' id='td'><?=$k['id']?></td>
<td class='derecha' id='td'><?=utf8_encode($k['lastname'])?></td>
<td class='derecha' id='td'><?=$k['name']?></td>
<?/* if ($_SESSION['info']['level']<=3){*/?>
	<td id='td'><?=$k['email']?></td>
	<td id='td'><?=$k['phone']?></td>
	<td id='td'><?=$k['country']?></td>
	<td id='td'><?=$k['language']?></td>
<?/*}*/?>

	<? $villas=$data->show_data('villas', "`id_owner`=".$k['id'], 'id');

	?>

<td id='td'>
	<? foreach( $villas as $vi){
		echo "(".$vi['no'].") ";
	  }
	?></td>
	<td <? if ($_SESSION['info']['level']<=3){?> onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" onclick="location.href='view-owners-details.php?id=<?=$k['id']?>'" <?}?> >Details</td>

<?php
if ($_SESSION['info']['services']==1){
	?>	
<td align="center"><a href="view-owners.php?id=<?=$k['id']?>" onclick="return confirmSubmitText('Are you sure you want to delete <?=$k['name']?> <?=utf8_encode($k['lastname'])?> from owner?');" title="Delete <?=$k['name']?> <?=utf8_encode($k['lastname'])?>"><img src="images/DeleteGray.png" alt="Delete" width="10" height="10" border="0"></a></td>
<?}?>	

 <? /*if ($_SESSION['info']['level']<=3){*/?>
 <?
 	/*if ($k['active']==1){echo "<td class='centro' id='td'>X</td>";}else{echo "<td class='centro rojo' id='td'>X</td>"; }*/
/* }*/
 if ($x==0){$x++;} elseif ($x==1){$x--;}
}
?>
</table>
