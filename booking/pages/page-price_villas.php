<? include('menu_CSS/menu-admin.php');?>

<?
if($_POST){
	if($_POST['price']!=0){
		$_GET['result']="New prices for villas saved";
	}
}
?>


<p class="header">Prices for villas</p>
	<?php
	if($_GET['result']){
	?>
      <p style="text-align:center;font-weight:bold; color: white; background-color:green; padding:10px;"> <?=$_GET['result']?></p>
    <?
	}
	?>

	<form method="post" action="price_villas.php" >

	
	<table align="center">
		<tr>
			<td>
				<p style="font-size:12px; text-align:right;">Bedrooms
					<select name="beds"  style="font-size:12px; text-align:right;">
						<? for($i=1; $i<=6; $i++){?>
						<option value="<?=$i?>" <? if($_POST['beds']==$i){ echo "selected='selected'"; } ?>><?=$i?></option>
						<?}?>
					</select>
						Type
					<select name="villatype"  style="font-size:12px; text-align:right;">
						<option value="1"  <? if($_POST['villatype']==1){ echo "selected='selected'"; } ?>>A</option>
						<option value="2"  <? if($_POST['villatype']==2){ echo "selected='selected'"; } ?>>B</option>
						<option value="3"  <? if($_POST['villatype']==3){ echo "selected='selected'"; } ?>>C</option>
						<option value="4"  <? if($_POST['villatype']==4){ echo "selected='selected'"; } ?>>D</option>
					</select>
					<select name="season"  style="font-size:12px; text-align:right;">
						<option value="1" <? if($_POST['season']==1){ echo "selected='selected'"; } ?> >All Season</option>
						<option value="2" <? if($_POST['season']==2){ echo "selected='selected'"; } ?> >High Season</option>
						<option value="3" <? if($_POST['season']==3){ echo "selected='selected'"; } ?> >Low Season</option>
						<option value="4" <? if($_POST['season']==4){ echo "selected='selected'"; } ?> >Shoulder Season</option>
					</select>
						Price
					<input type="text" name="price" value="<?=$_POST['price']?>" /> 
					<input class="book_but" type="submit" name="save" value="Submit"/>
				</p>
			</td>
		</tr>
	</table>
	</form>
<hr />
<? 

$link= new getQueries ();

if ($_POST){

	
	if($_POST['price']!=0){
		//poner el precio a todas las villas de renta
		
		$villas_acualizar_precio=$link->display_table($table='villas', $condition=" bed='".$_POST['beds']."' AND able_r='1' AND classification='".$_POST['villatype']."'", $order='id');
		$precio_anterior=$link->display_table($table='prices_villas', $condition=" beds='".$_POST['beds']."' AND type='".$_POST['villatype']."' AND active='1' ", $order='id');
		
		/*echo "<pre>";
		print_r($villas_acualizar_precio);
		echo "</pre>";*/
		
		$data=new DB();
		//if($villas_acualizar_precio){
			switch($_POST['season']){
				case 1: /*all season*/
					 if($villas_acualizar_precio){
						foreach ($villas_acualizar_precio AS $k){
							$data->update_gral($id=$k['id'], $info=array('p_low'=>$_POST['price'],'p_shoulder'=>$_POST['price'],'p_high'=>$_POST['price']), $table='villas');
						}
					 }
					 
					if($precio_anterior){
						foreach ($precio_anterior AS $k){
							$data->update_gral($id=$k['id'], $info=array('active'=>'0'), $table='prices_villas');
						}
					}
					$info=array('beds'=>$_POST['beds'], 'type'=>$_POST['villatype'], 'price'=>$_POST['price'], 'priceshoulder'=>$_POST['price'], 'pricehs'=>$_POST['price'], 'active'=>'1', 'adm'=>$_SESSION['info']['id'], 'date'=>time());
					$data->insert($info, $table='prices_villas');
					
					break;
				case 2: /*peak*/
				 if($villas_acualizar_precio){
					foreach ($villas_acualizar_precio AS $k){
						$data->update_gral($id=$k['id'], $info=array('p_high'=>$_POST['price']), $table='villas');
					}
				 }
					if($precio_anterior){
						foreach ($precio_anterior AS $k){
							$data->update_gral($id=$k['id'], $info=array('pricehs'=>$_POST['price']), $table='prices_villas');
						}
					}else{
						$info=array('beds'=>$_POST['beds'], 'type'=>$_POST['villatype'], 'pricehs'=>$_POST['price'], 'active'=>'1', 'adm'=>$_SESSION['info']['id'], 'date'=>time());
						$data->insert($info, $table='prices_villas');
					}
					break;
				case 3: /*None peak*/
				 if($villas_acualizar_precio){
					foreach ($villas_acualizar_precio AS $k){
						$data->update_gral($id=$k['id'], $info=array('p_low'=>$_POST['price']), $table='villas');
					}
				 }
					
					if($precio_anterior){
						foreach ($precio_anterior AS $k){
							$data->update_gral($id=$k['id'], $info=array('price'=>$_POST['price']), $table='prices_villas');
						}
					}else{
						$info=array('beds'=>$_POST['beds'], 'type'=>$_POST['villatype'], 'price'=>$_POST['price'], 'active'=>'1', 'adm'=>$_SESSION['info']['id'], 'date'=>time());
						$data->insert($info, $table='prices_villas');
					}
					break;
				case 4: /*shoulder season*/
				 if($villas_acualizar_precio){
					foreach ($villas_acualizar_precio AS $k){
						$data->update_gral($id=$k['id'], $info=array('p_shoulder'=>$_POST['price']), $table='villas');
					}
				 }
				 
					if($precio_anterior){
						foreach ($precio_anterior AS $k){
							$data->update_gral($id=$k['id'], $info=array('priceshoulder'=>$_POST['price']), $table='prices_villas');
						}
					}else{
						$info=array('beds'=>$_POST['beds'], 'type'=>$_POST['villatype'], 'priceshoulder'=>$_POST['price'], 'active'=>'1', 'adm'=>$_SESSION['info']['id'], 'date'=>time());
						$data->insert($info, $table='prices_villas');
					}
					break;
				default: /*all season*/
				 if($villas_acualizar_precio){
					foreach ($villas_acualizar_precio AS $k){
						$data->update_gral($id=$k['id'], $info=array('p_low'=>$_POST['price'],'p_shoulder'=>$_POST['price'],'p_high'=>$_POST['price']),  $table='villas');
					}
				 }
					
					if($precio_anterior){
						foreach ($precio_anterior AS $k){
							$data->update_gral($id=$k['id'], $info=array('active'=>'0'), $table='prices_villas');
						}
					}
					$info=array('beds'=>$_POST['beds'], 'type'=>$_POST['villatype'], 'price'=>$_POST['price'], 'priceshoulder'=>$_POST['price'], 'pricehs'=>$_POST['price'], 'active'=>'1', 'adm'=>$_SESSION['info']['id'], 'date'=>time());
					$data->insert($info, $table='prices_villas');
					
			}
		//}
		
		
		
			//switch($_POST['season']){
			//	case 1: /*all season*/
					
					/*foreach ($villas_acualizar_precio AS $k){
						$data->update_gral($id=$k['id'], $info=array('p_low'=>$_POST['price'],'p_shoulder'=>$_POST['price'],'p_high'=>$_POST['price']), $table='villas');
					}*/
		//			break;
		//		case 2: /*peak*/
					
					/*foreach ($villas_acualizar_precio AS $k){
						$data->update_gral($id=$k['id'], $info=array('p_high'=>$_POST['price']), $table='villas');
					}*/
		//			break;
		//		case 3: /*None peak*/
					
					/*foreach ($villas_acualizar_precio AS $k){
						$data->update_gral($id=$k['id'], $info=array('p_low'=>$_POST['price']), $table='villas');
					}*/
		//			break;
		//		case 4: /*Shoulder Season*/
					
					/*foreach ($villas_acualizar_precio AS $k){
						$data->update_gral($id=$k['id'], $info=array('p_shoulder'=>$_POST['price']), $table='villas');
					}*/
		//			break;
		//		default: /*all season*/
					/*if($precio_anterior){
						foreach ($precio_anterior AS $k){
							$data->update_gral($id=$k['id'], $info=array('active'=>'0'), $table='prices_villas');
						}
					}
					$info=array('beds'=>$_POST['beds'], 'type'=>$_POST['villatype'], 'price'=>$_POST['price'], 'priceshoulder'=>$_POST['price'], 'pricehs'=>$_POST['price'], 'active'=>'1', 'adm'=>$_SESSION['info']['id'], 'date'=>time());
					$data->insert($info, $table='prices_villas');*/
					/*foreach ($villas_acualizar_precio AS $k){
						$data->update_gral($id=$k['id'], $info=array('p_low'=>$_POST['price'],'p_high'=>$_POST['price']), $table='villas');
					}*/
		//	}
		
		
		
		//desactivar todos los precios con estos criterios, pero dejar el historial
		
		
		/*echo "<pre>";
		print_r($precio_anterior);
		echo "<pre>";*/
		
		
		//insertar nuevo precio
		
	}
	//mostrar todos los precios
	
 }

 $A1=$link->display_table($table='prices_villas', $condition=" beds='1' AND type='1' AND active='1'", $order='id');
 $B1=$link->display_table($table='prices_villas', $condition=" beds='1' AND type='2' AND active='1'", $order='id');
 $C1=$link->display_table($table='prices_villas', $condition=" beds='1' AND type='3' AND active='1'", $order='id');
 $D1=$link->display_table($table='prices_villas', $condition=" beds='1' AND type='4' AND active='1'", $order='id');
 
 $A2=$link->display_table($table='prices_villas', $condition=" beds='2' AND type='1' AND active='1'", $order='id');
 $B2=$link->display_table($table='prices_villas', $condition=" beds='2' AND type='2' AND active='1'", $order='id');
 $C2=$link->display_table($table='prices_villas', $condition=" beds='2' AND type='3' AND active='1'", $order='id');
 $D2=$link->display_table($table='prices_villas', $condition=" beds='2' AND type='4' AND active='1'", $order='id');
 
 $A3=$link->display_table($table='prices_villas', $condition=" beds='3' AND type='1' AND active='1'", $order='id');
 $B3=$link->display_table($table='prices_villas', $condition=" beds='3' AND type='2' AND active='1'", $order='id');
 $C3=$link->display_table($table='prices_villas', $condition=" beds='3' AND type='3' AND active='1'", $order='id');
 $D3=$link->display_table($table='prices_villas', $condition=" beds='3' AND type='4' AND active='1'", $order='id');
 
 $A4=$link->display_table($table='prices_villas', $condition=" beds='4' AND type='1' AND active='1'", $order='id');
 $B4=$link->display_table($table='prices_villas', $condition=" beds='4' AND type='2' AND active='1'", $order='id');
 $C4=$link->display_table($table='prices_villas', $condition=" beds='4' AND type='3' AND active='1'", $order='id');
 $D4=$link->display_table($table='prices_villas', $condition=" beds='4' AND type='4' AND active='1'", $order='id');
 
 $A5=$link->display_table($table='prices_villas', $condition=" beds='5' AND type='1' AND active='1'", $order='id');
 $B5=$link->display_table($table='prices_villas', $condition=" beds='5' AND type='2' AND active='1'", $order='id');
 $C5=$link->display_table($table='prices_villas', $condition=" beds='5' AND type='3' AND active='1'", $order='id');
 $D5=$link->display_table($table='prices_villas', $condition=" beds='5' AND type='4' AND active='1'", $order='id');
 
 $A6=$link->display_table($table='prices_villas', $condition=" beds='6' AND type='1' AND active='1'", $order='id');
 $B6=$link->display_table($table='prices_villas', $condition=" beds='6' AND type='2' AND active='1'", $order='id');
 $C6=$link->display_table($table='prices_villas', $condition=" beds='6' AND type='3' AND active='1'", $order='id');
 $D6=$link->display_table($table='prices_villas', $condition=" beds='6' AND type='4' AND active='1'", $order='id');
 /*print_r($precios_2bdr_pre);
 echo "<br/>";
 print_r($precios_2bdr_del);*/
 ?>
<table align="center" border="1" cellpadding="4" Cellspacing="0">

	<tr>
		<td>Bedrooms</td>
		<td>A</td>
		<td>B</td>
		<td>C</td>
		<td>D</td>
	</tr>
	<tr>
		<td>1</td>
		<td>L:<?=number_format($A1[0]['price'],0)?> / S:<?=number_format($A1[0]['priceshoulder'],0)?> / H: <?=number_format($A1[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($B1[0]['price'],0)?> / S:<?=number_format($B1[0]['priceshoulder'],0)?> / H: <?=number_format($B1[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($C1[0]['price'],0)?> / S:<?=number_format($C1[0]['priceshoulder'],0)?> / H: <?=number_format($C1[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($D1[0]['price'],0)?> / S:<?=number_format($D1[0]['priceshoulder'],0)?> / H: <?=number_format($D1[0]['pricehs'],0)?> </td>
	</tr>
	<tr>
		<td>2</td>
		<td>L:<?=number_format($A2[0]['price'],0)?> / S:<?=number_format($A2[0]['priceshoulder'],0)?> / H: <?=number_format($A2[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($B2[0]['price'],0)?> / S:<?=number_format($B2[0]['priceshoulder'],0)?> / H: <?=number_format($B2[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($C2[0]['price'],0)?> / S:<?=number_format($C2[0]['priceshoulder'],0)?> / H: <?=number_format($C2[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($D2[0]['price'],0)?> / S:<?=number_format($D2[0]['priceshoulder'],0)?> / H: <?=number_format($D2[0]['pricehs'],0)?> </td>
	</tr>
	<tr>
		<td>3</td>
		<td>L:<?=number_format($A3[0]['price'],0)?> / S:<?=number_format($A3[0]['priceshoulder'],0)?> / H: <?=number_format($A3[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($B3[0]['price'],0)?> / S:<?=number_format($B3[0]['priceshoulder'],0)?> / H: <?=number_format($B3[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($C3[0]['price'],0)?> / S:<?=number_format($C3[0]['priceshoulder'],0)?> / H: <?=number_format($C3[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($D3[0]['price'],0)?> / S:<?=number_format($D3[0]['priceshoulder'],0)?> / H: <?=number_format($D3[0]['pricehs'],0)?> </td>
	</tr>
	<tr>
		<td>4</td>
		<td>L:<?=number_format($A4[0]['price'],0)?> / S:<?=number_format($A4[0]['priceshoulder'],0)?> / H: <?=number_format($A4[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($B4[0]['price'],0)?> / S:<?=number_format($B4[0]['priceshoulder'],0)?> / H: <?=number_format($B4[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($C4[0]['price'],0)?> / S:<?=number_format($C4[0]['priceshoulder'],0)?> / H: <?=number_format($C4[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($D4[0]['price'],0)?> / S:<?=number_format($D4[0]['priceshoulder'],0)?> / H: <?=number_format($D4[0]['pricehs'],0)?> </td>
	</tr>
	<tr>
		<td>5</td>
		<td>L:<?=number_format($A5[0]['price'],0)?> / S:<?=number_format($A5[0]['priceshoulder'],0)?> / H: <?=number_format($A5[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($B5[0]['price'],0)?> / S:<?=number_format($B5[0]['priceshoulder'],0)?> / H: <?=number_format($B5[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($C5[0]['price'],0)?> / S:<?=number_format($C5[0]['priceshoulder'],0)?> / H: <?=number_format($C5[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($D5[0]['price'],0)?> / S:<?=number_format($D5[0]['priceshoulder'],0)?> / H: <?=number_format($D5[0]['pricehs'],0)?> </td>
	</tr>
	<tr>
		<td>6</td>
		<td>L:<?=number_format($A6[0]['price'],0)?> / S:<?=number_format($A6[0]['priceshoulder'],0)?> / H: <?=number_format($A6[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($B6[0]['price'],0)?> / S:<?=number_format($B6[0]['priceshoulder'],0)?> / H: <?=number_format($B6[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($C6[0]['price'],0)?> / S:<?=number_format($C6[0]['priceshoulder'],0)?> / H: <?=number_format($C6[0]['pricehs'],0)?> </td>
		<td>L:<?=number_format($D6[0]['price'],0)?> / S:<?=number_format($D6[0]['priceshoulder'],0)?> / H: <?=number_format($D6[0]['pricehs'],0)?> </td>
	</tr>
</table>