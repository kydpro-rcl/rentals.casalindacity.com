<? include('menu_CSS/menu-villas.php');?>
<?php
$data= new getQueries ();
if (!$_GET['sort']){
$villas=$data->show_all_int('villas', 'no');
}else{
 switch ($_GET['sort']){
 case "no":
 			$villas=$data->show_all_int('villas', 'no');
 			break;
 case "type":
 			$villas=$data->show_all('villas', 'type');
 			break;
 case "bed":
 			$villas=$data->show_all('villas', 'bed');
 			break;
 case "bath":
 			$villas=$data->show_all('villas', 'bath');
 			break;
 case "ac":
 			$villas=$data->show_all('villas', 'AC');
 			break;
 case "per":
 			$villas=$data->show_all('villas', 'capacity');
 			break;
 case "rent":
 			$villas=$data->show_all('villas', 'able_r');
 			break;
 case "size":
 			$villas=$data->show_all('villas', 'm2');
 			break;
 default	:
 			$villas=$data->show_all_int('villas', 'no');
 			break;
 }
}
?>

<p class="header">For details click on a villa below</p><hr />
<table align="center" cellpadding="2" cellspacing="2" border="0">
	<tr class="title">
		<td class='centro' id="td">
			<?if (($_GET['sort']!="")&&($_GET['sort']!="no")){?>
			<a href="view-villas.php?sort=no" title="Sort by numbers">NO</a>
			<?}else{?>
			 NO
			<?}?>
		</td>
		<td class='centro' id="td" >
			<?if (($_GET['sort']!="type")){?>
			<a href="view-villas.php?sort=type" title="Sort by type">TYPE</a>
			<?}else{?>
			 TYPE
			<?}?>
		</td>
		<td class='centro' id="td">
			<?if (($_GET['sort']!="bed")){?>
			<a href="view-villas.php?sort=bed" title="Sort by bedrooms">BDR</a>
			<?}else{?>
			 BEDROOMS
			<?}?>
		</td>
		<td class='centro' id="td">
			<?if (($_GET['sort']!="bath")){?>
			<a href="view-villas.php?sort=bath" title="Sort by bathrooms">BATH</a>
			<?}else{?>
			 BATHROOM
			<?}?>
		</td>
		<td class='centro' id="td" >
			<?if (($_GET['sort']!="ac")){?>
			<a href="view-villas.php?sort=ac" title="Sort by Air conditioners">AC</a>
			<?}else{?>
			 AC
			<?}?>
		</td>
		<!--<td class='centro' id="td">
			<?if (($_GET['sort']!="per")){?>
			<a href="view-villas.php?sort=per" title="Sort by Maximum Persons supported">MAX. PERSONS<a/>
			<?}else{?>
			 MAX. PERSONS
			<?}?>
		</td>-->
		<td class='centro' id="td">
			<?if (($_GET['sort']!="rent")){?>
			<a href="view-villas.php?sort=rent" title="Sort by Rent">RENT</a>
			<?}else{?>
			 RENT
			<?}?>
		</td>
		<!--<td class='centro' id="td">
			<?if (($_GET['sort']!="size")){?>
			<a href="view-villas.php?sort=size" title="Sort by size">SIZE</a>
			<?}else{?>
			 SIZE
			<?}?>
		</td>-->
		<td class='centro' id="td">
		Price LS
		</td>
		<td class='centro' id="td">
		Price HS
		</td>
		<td class='centro' id="td">
		Owner
		</td>
		<td class='centro' id="td">
		Email
		</td>
		<td class='centro' id="td">
		Phone
		</td>
		<td class='centro' id="td">
		online
		</td>
	</tr>
<?php
$x=0;
foreach ($villas as $k){
#echo $customers['4']['name'];
?>
<tr class='fila<?=$x?>' onclick="location.href='view-villas-details.php?id=<?=$k['id']?>'" onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';"><td class='derecha' id='td'><?=$k['no']?></td>
<td id='td'><?=$k['type']?></td><td class='centro' id='td'><?=$k['bed']?></td>
<td class='centro' id='td'><?=$k['bath']?></td>
<td class='centro' id='td'><?=$k['AC']?></td>

<?php
if ($k['able_r']==1){echo "<td class='centro' id='td'><strong>Yes</strong></td>";}elseif($k['able_r']==2){echo "<td class='centro' id='td'>PR</td>";}else{echo "<td class='centro rojo' id='td'>No</td>"; }
/*echo"<td id='td'>".number_format($k['m2'],0)." m&sup2; - ".number_format($k['ft2'],0)." ft&sup2;</td>";*/

 if ($x==0){$x++;} elseif ($x==1){$x--;}
   $owner=$data->show_id('owners',$k['id_owner']);
 ?>
		<td  id="td">
		<?=number_format($k['p_low'],2)?>
		</td>
		<td  id="td">
		<?=number_format($k['p_high'],2)?>
		</td>

		
   		<td  id="td">
		<? echo $owner[0]['name'].' '.$owner[0]['lastname'];?>
		</td>
		<td id="td">
		<? echo $owner[0]['email'];?>
		</td>
		<td  id="td">
		<? echo $owner[0]['phone'];?>
		</td>
		<td  id="td">
		<? echo $k['vonline'];?>
		</td>
<?
echo "</tr>";
}

?>
</table>
