<? include('menu_CSS/menu-admin.php');?>
<p class="header">Search Clients per Referral</p>
<form method="post" action="search_clients_referal.php" >
	<p id="fields" style="text-align:center;">Referral:<?
	$data= new getQueries ();
  	$commisioners=$data->show_all('commission', 'id');
	?>
	<select class='input' size=1 name='referal' onchange="window.location='search_clients_referal.php?re='+this.value">
	<?
	foreach($commisioners as $k){
	?>
	    <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_GET['re']==$k['id'])) echo "selected='selected'"; ?> ><?=$k['name']." ".$k['lastname'];?></option>
	    <?
		}
		echo "</select>";
	?>
	<input class="book_but" type="submit" name="go" value="go"/>
	</p>
</form>

<hr />
<?
if ($_POST['referal']) $referal=$_POST['referal'];
if ($_GET['re']) $referal=$_GET['re'];
?>

 <? if ($referal){?>
<?php

		if (!$_GET['sort']){
		$customers=$data->show_data('customers', "`id_commission`='".$referal."'", 'country');
		$total_records=$data->getAffectedRows();
		}else{

		 switch ($_GET['sort']){
		 case "no":
		 			$customers=$data->show_data('customers', "`id_commission`='".$referal."'", 'id');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "status":
		 			$customers=$data->show_data('customers', "`id_commission`='".$referal."'", 'active');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "name":
		 			$customers=$data->show_data('customers', "`id_commission`='".$referal."'", 'name');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "email":
		 			$customers=$data->show_data('customers', "`id_commission`='".$referal."'", 'email');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "phone":
		 			$customers=$data->show_data('customers', "`id_commission`='".$referal."'", 'phone');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "country":
		 			$customers=$data->show_data('customers', "`id_commission`='".$referal."'", 'country');
		 			//$customers=$data->show_all('customers', 'country');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "state":
		 			$customers=$data->show_data('customers', "`id_commission`='".$referal."'", 'state');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 default	:
		 			$customers=$data->show_data('customers', "`id_commission`='".$referal."'", 'country');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 }
		}
		?>

      <? if ($customers){

      ?>
		<p style="font-size:10px; padding-left:15px; color:blue;"><strong>Total customers found: <?=$total_records?></strong></p>
		<hr />
		<table  align="center" cellpadding="2" cellspacing="2" border="0">

			<tr class="title">
				<td class='centro' id="td">
					<?if (($_GET['sort']!="")&&($_GET['sort']!="no")){?>
		            <a href="search_clients_referal.php?sort=no&re=<?=$referal?>" title="Sort by numbers">NO</a>
					<?}else{?>
					NO
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="status"){?>
		            <a href="search_clients_referal.php?sort=status&re=<?=$referal?>" title="Sort by status">STATUS</a>
					<?}else{?>
					STATUS
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="name"){?>
		            <a href="search_clients_referal.php?sort=name&re=<?=$referal?>" title="Sort by names">NAME</a>
					<?}else{?>
					NAME
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="email"){?>
		            <a href="search_clients_referal.php?sort=email&re=<?=$referal?>" title="Sort by emails">EMAIL</a>
					<?}else{?>
					EMAIL
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="phone"){?>
		            <a href="search_clients_referal.php?sort=phone&re=<?=$referal?>" title="Sort by phones">PHONE</a>
					<?}else{?>
					PHONE
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="country"){?>
		            <a href="search_clients_referal.php?sort=country&re=<?=$referal?>" title="Sort by countries">COUNTRY</a>
					<?}else{?>
					COUNTRY
					<?}?>
				</td>
				<td class='centro' id="td">
					<?if ($_GET['sort']!="state"){?>
		            <a href="search_clients_referal.php?sort=state&re=<?=$referal?>" title="Sort by States">STATE</a>
					<?}else{?>
					STATE
					<?}?>
				</td>
			</tr>
		<?php

		$x=0;
		foreach ($customers as $k){

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

	  <?}else{        echo "<p style='text-align:center; color:red; font-size:16px;'>There is not client found for selected Referal.</p>";
	  }?>

 <? }?>