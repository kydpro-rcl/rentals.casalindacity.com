<? include('menu_CSS/menu-admin.php');?>

<p class="header">Search Clients per Countries and Cities</p>

	<form method="post" action="reports.php" >

	<p id="fields" style="text-align:center;">Country:<?

$country=countryArray();

?>
<select class='input' size=1 name='country' onchange="window.location='reports.php?co='+this.value">
<?
foreach($country as $k=>$v){
	//echo "<option value=\"".$k."\">".$v."</option>";
	?>
    <option value="<?=$k?>" <? if (($_POST['country']==$k)||($_GET['co']==$k)) echo "selected='selected'"; ?> ><?=$v?></option>
    <?
	}
	echo "</select>";
?>


<!--//BELOW STARTING CITIES FOR COUNTRY//-->
State/Province: <?
if ($_GET['co'])$_GET['co']=$_GET['co'];
if ($_POST['country'])$_GET['co']=$_POST['country'];
if ((!$_GET['co'])&&(!$_POST['country']))$_GET['co']="CA";

$states=cities($_GET['co']);

	if ($states){?>
		<select class='input' size=1 name='state' >
		<?
		foreach($states as $k=>$v){?>
		    <option value="<?=$k?>" <? if ($_POST['state']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
		<?}
		 echo "</select>";
	}else{?>
		<input class="input" type="text" name="state" value="<?=$_POST['state']?>"/>
	<?}?>


		<input class="book_but" type="submit" name="go" value="go"/>
</p>

	</form>
<hr />
<?
if ($_POST['country']) $pais=$_POST['country'];
if ($_POST['state']) $provincia_o_estado=$_POST['state'];
if ($_GET['c']) $pais=$_GET['c'];
if ($_GET['sta']) $provincia_o_estado=$_GET['sta'];
?>

 <? if (($pais)&&($provincia_o_estado)){?>
			<?php
		$data= new getQueries ();
		if (!$_GET['sort']){
		$customers=$data->show_data('customers', "`country`='".$pais."' AND `state` LIKE '%".$provincia_o_estado."%'", 'country');
		$total_records=$data->getAffectedRows();
		}else{

		 switch ($_GET['sort']){
		 case "no":
		 			$customers=$data->show_data('customers', "`country`='".$pais."' AND `state` LIKE '%".$provincia_o_estado."%'", 'id');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "status":
		 			$customers=$data->show_data('customers', "`country`='".$pais."' AND `state` LIKE '%".$provincia_o_estado."%'", 'active');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "name":
		 			$customers=$data->show_data('customers', "`country`='".$pais."' AND `state` LIKE '%".$provincia_o_estado."%'", 'name');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "email":
		 			$customers=$data->show_data('customers', "`country`='".$pais."' AND `state` LIKE '%".$provincia_o_estado."%'", 'email');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "phone":
		 			$customers=$data->show_data('customers', "`country`='".$pais."' AND `state` LIKE '%".$provincia_o_estado."%'", 'phone');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "country":
		 			$customers=$data->show_data('customers', "`country`='".$pais."' AND `state` LIKE '%".$provincia_o_estado."%'", 'country');
		 			//$customers=$data->show_all('customers', 'country');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "state":
		 			$customers=$data->show_data('customers', "`country`='".$pais."' AND `state` LIKE '%".$provincia_o_estado."%'", 'state');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 default	:
		 			$customers=$data->show_data('customers', "`country`='".$pais."' AND `state` LIKE '%".$provincia_o_estado."%'", 'country');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 }
		}
		?>

      <? if ($customers){
       //echo "<pre>$customers</pre>";

      ?>
		<p style="font-size:10px; padding-left:15px; color:blue;"><strong>Total customers found: <?=$total_records?></strong></p>
		<hr />
		<table  align="center" cellpadding="2" cellspacing="2" border="0">

			<tr class="title">
				<td class='centro' id="td">
					<?if (($_GET['sort']!="")&&($_GET['sort']!="no")){?>
		            <a href="reports.php?sort=no&sta=<?=$provincia_o_estado?>&c=<?=$pais?>" title="Sort by numbers">NO</a>
					<?}else{?>
					NO
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="status"){?>
		            <a href="reports.php?sort=status&sta=<?=$provincia_o_estado?>&c=<?=$pais?>" title="Sort by status">STATUS</a>
					<?}else{?>
					STATUS
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="name"){?>
		            <a href="reports.php?sort=name&sta=<?=$provincia_o_estado?>&c=<?=$pais?>" title="Sort by names">NAME</a>
					<?}else{?>
					NAME
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="email"){?>
		            <a href="reports.php?sort=email&sta=<?=$provincia_o_estado?>&c=<?=$pais?>" title="Sort by emails">EMAIL</a>
					<?}else{?>
					EMAIL
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="phone"){?>
		            <a href="reports.php?sort=phone&sta=<?=$provincia_o_estado?>&c=<?=$pais?>" title="Sort by phones">PHONE</a>
					<?}else{?>
					PHONE
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="country"){?>
		            <a href="reports.php?sort=country&sta=<?=$provincia_o_estado?>&c=<?=$pais?>" title="Sort by countries">COUNTRY</a>
					<?}else{?>
					COUNTRY
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="state"){?>
		            <a href="reports.php?sort=state&sta=<?=$provincia_o_estado?>&c=<?=$pais?>" title="Sort by States">STATE</a>
					<?}else{?>
					STATE
					<?}?>
				</td>
			</tr>
		<?php

		$x=0;
		foreach ($customers as $k){
		#echo $customers['4']['name'];
		echo "<tr class='fila$x'  onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='view-clients-details.php?id=".$k['id']."'\" >
		<td id='td' class='derecha'>".$k['id']."</td>";

		if ($k['active']==1){
			if ($k['classify_cust']==1){
				echo "<td class='centro' style='color:green;'  id='td'>Active</td>";
			}else{
				echo "<td class='centro' id='td'>Active</td>";
			}
		}else{
			if ($k['classify_cust']==1){
				echo "<td class='centro' style='color:#d91be0;' id='td'>Disabled</td>";
			}else{
				echo "<td class='centro rojo' id='td'>Disabled</td>";
			}
		}



		echo "<td id='td'>".$k['name']." ".($k['lastname'])."</td>".
		"<td id='td'>".$k['email']."</td>".
		"<td id='td'>".$k['phone']."</td>";

		//echo"<td id='td'>".$k['country']."</td><td id='td'>".$k['city']."</td></tr>";

		 $paises=countryArray();
		 $states=cities($k['country']);
		 $provincia=$states[$k['state']];

			  echo "<td id='td'>".$paises[$k['country']]."</td>";

			 if ($provincia){
				echo "<td id='td'>".$provincia."</td></tr>";
			 }else{
			    echo  "<td id='td'>".$k['state']."</td></tr>";
			 }

		 if ($x==0){$x++;} elseif ($x==1){$x--;}
		}
		//.utf8_encode($k['lastname'])
		?>
		</table>

	  <?}else{        echo "<p style='text-align:center; color:red; font-size:16px;'>There is not client found for selected country and state/province.</p>";
	  }?>

 <? }?>