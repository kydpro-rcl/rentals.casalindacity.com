<? include('menu_CSS/menu-villas.php');?>
<?php
$data= new getQueries ();
if (!$_GET['sort']){
$villas = $data->showTable_restrinted("villas", "able_r=1 AND `wish_referal`='0' AND `vonline`='0'" ,'id');
}else{
 /*switch ($_GET['sort']){
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
 }*/
}
?>

<p class="header">Villas List for HomeAway</p>

<p ><strong>Total villas found: <?=count($villas)?> Units</strong></p>
<hr />
<table align="center" cellpadding="2" cellspacing="2" border="0">
	<tr class="title">
		<td class='centro' id="td">
			 NO
		</td>
		<td class='centro' id="td" >
			 TYPE
		</td>
		<td class='centro' id="td">
			 BEDROOMS
		</td>
		<td class='centro' id="td">
			 BATHROOM
		</td>
		
		<td class='centro' id="td">
		Headline (Min. 20 Max. 100)
		</td>
		<td class='centro' id="td">
		Description (Min. 400 Max. 10,000)
		</td>
		<!--<td class='centro' id="td">
		Owner
		</td>-->
		
		
		<td class='centro' id="td">
		View
		</td>
		<td class='centro' id="td">
		Edit
		</td>
		<td class='centro' id="td">
		Photos
		</td>
	</tr>
<?php
//include_once '../photos/core/db.php';
include_once '../photos/functions.php';
//$picdb = new DB();

$x=0;
foreach ($villas as $k){
$imagescount =qty_pics($villaid=$k['id']);
//$imagescount = count($db->getRows($k['id']));
#echo $customers['4']['name'];
?>
<tr class='fila<?=$x?>'  onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='yellow';"><td class='derecha' id='td'><?=$k['no']?></td>
<td id='td'><?=$k['type']?></td><td class='centro' id='td'><?=$k['bed']?></td>
<td class='centro' id='td'><?=$k['bath']?></td>
<td class='centro' id='td'>

<?php 
	$qty_headline=strlen($k['headline']);
	
	if($qty_headline<20){
		$color_headline='Red';
	}elseif($qty_headline>100){
		$color_headline='Orange';
	}else{
		$color_headline='Green';
	}
	?>

<span style="color:<?=$color_headline;?>"><?=$qty_headline?></span>
</td>

<?php
 if ($x==0){$x++;} elseif ($x==1){$x--;}
   //$owner=$data->show_id('owners',$k['id_owner']);
 ?>
		

		<td id="td">
		<?php $qty_description=strlen($k['head']); 

			
			if($qty_description<400){
				$color_description='Red';
			}elseif($qty_description>10000){
				$color_description='Orange';
			}else{
				$color_description='Green';
			}
			?>

			<span style="color:<?=$color_description;?>"><?=$qty_description?></span>
		</td>
		
		
   		<!--<td  id="td">
		<? echo $owner[0]['name'].' '.$owner[0]['lastname'];?>
		</td>-->
		
		
		<td class='centro' id="td">
			<a href="view-villas-details.php?id=<?=$k['id']?>" target="_blank">View</a>
		</td>
		<td class='centro' id="td">
			<a href="edit-villas-details.php?id=<?=$k['id']?>" target="_blank">Edit</a>
		</td>
		<td class='centro' id="td">
			<a href="../photos/index_upload.php?id=<?=$k['id']?>" target="_blank">upload (<?=$imagescount?>)</a>
		</td>
<?
echo "</tr>";
}

?>
</table>
