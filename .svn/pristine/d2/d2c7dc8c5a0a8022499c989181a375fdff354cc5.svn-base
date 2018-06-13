<!--// <p class="header">Search Customer</p>//-->

<div style="padding-left:35px"><form method="post" action="clients_list.php">
Search <input class="input" type="text" size="50" name="search" value="<?=$_POST['search']?>"  /> by <select class="input" name="findby">
<option  <? if (!$_POST['findby']){?> selected="selected" <? }?> <? if ($_POST['findby']=="id"){?> selected="selected" <? }?>value="id">No</option>
<option <? if ($_POST['findby']=="name"){?> selected="selected" <? }?> value="name">Name</option>
<option <? if ($_POST['findby']=="lastname"){?> selected="selected" <? }?> value="lastname">Last name</option>
</select><input class="book_but" type="submit" name="find" value="Find" />
</form></div>
<hr />
<div style="padding-left:35px">
<?/* if ($_POST['find']){//SOLO SI SE BUSCAN CLIENTES

		if ($_POST['search']) $_POST['search']=trim($_POST['search']);
		if 	($_POST['search']!=''){
			$db= new getQueries();
				if (($_POST['findby']=="name")||($_POST['findby']=="lastname")){
					$result=$db->showSearch_like('customers','id',$_POST['search'],$_POST['findby']);
					$total_records=$db->getAffectedRows();
				}else{
					$result=$db->showSearch('customers','id',$_POST['search'],$_POST['findby']);
					$total_records=$db->getAffectedRows();
				}



			    if ($result){
				echo "<p style='text-align:center; font-size:10px; font-weight:bold' >Found ". $total_records." Customer(s)</p><br>";
					  ?>
						<table  align="center" cellpadding="2" cellspacing="2" border="0">
							
								<tr class="title">
									<td class='centro' id="td">NO</td>
									<td class='centro' id="td">FIRST NAME</td>
									<td class='centro' id="td">LAST NAME</td>
									<td class='centro' id="td">STATUS</td>
									<td class='centro' id="td">COUNTRY</td>
									<td class='centro' id="td">ST</td>
									<td class='centro' id="td">AGENT FOR</td>
								</tr>
						<?php
					$x=0;
					foreach ($result as $k){

						echo "<tr class='fila$x' >
						<td id='td' class='derecha'>".$k['id']."</td>";

						echo "<td id='td'>".$k['name']."</td>";
                        echo "<td id='td'>".utf8_encode($k['lastname'])."</td>";

						if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }


							 $paises=countryArray();
							 $states=cities($k['country']);
							 $provincia=$states[$k['state']];

								  echo "<td id='td'>".$paises[$k['country']]."</td>";

								 if ($provincia){
									echo "<td id='td'>".$provincia."</td>";
								 }else{
								    echo  "<td id='td'>".$k['state']."</td>";
								 }
								 ?>
								 <td>Rental-Sale</td></tr>
								 <?

						 if ($x==0){$x++;} elseif ($x==1){$x--;}
					}
                    ?>
					</table>
					<?
				}else{
					echo "<p>&nbsp;</p>";
					echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No Result Found</p>";
				}
		}else{
		echo "<p>&nbsp;</p>";
		echo "<p style='color:red; text-align:center; font-weight:bold;'>Please, type in the searching box what you want to find.</p>";
		}
	}*/?>
 </div>

 <?/* if (!$_POST){*//*SOLO SI SE BUSCAN CLIENTES*/?>
		<?php
		$data= new getQueries ();
		if (!$_GET['sort']){
		//$customers=$data->show_all('customers', 'id');
		$customers=$data->show_data('customers', "`id_commission`='".$_SESSION['referal']['id']."' OR 	`id_seller`='".$_SESSION['referal']['id']."'", 'country');
		$total_records=$data->getAffectedRows();
		}else{

		 switch ($_GET['sort']){
		 case "no":
		 			$customers=$data->show_all('customers', 'id');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "status":
		 			$customers=$data->show_all('customers', 'active');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "name":
		 			$customers=$data->show_all('customers', 'name');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "email":
		 			$customers=$data->show_all('customers', 'email');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "phone":
		 			$customers=$data->show_all('customers', 'phone');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "country":
		 			$customers=$data->show_all('customers', 'country');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "state":
		 			$customers=$data->show_all('customers', 'state');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 default	:
		 			$customers=$data->show_all('customers', 'id');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 }
		}
		?>

		<!--//<p class="header">All our customers</p>//-->
		<p style="font-size:10px; padding-left:15px;"><strong>Total customers found: <?=$total_records?></strong></p>
		<hr />
		<table  align="center" cellpadding="2" cellspacing="2" border="0">

			<tr class="title">
				<td class='centro' id="td">
					NO
				</td>
				<td class='centro' id="td">
					FIRST NAME
				</td>
				<td class='centro' id="td">
					LAST NAME
				</td>
				<td class='centro' id="td">
					STATUS
				</td>
				<td class='centro' id="td">
					COUNTRY
				</td>
				<td class='centro' id="td">
					STATE
				</td>
				<td class='centro' id="td">AGENT FOR</td>
			</tr>
		<?php

		$x=0;
		foreach ($customers as $k){
		#echo $customers['4']['name'];
		echo "<tr class='fila$x' >
		<td id='td' class='derecha'>".$k['id']."</td>";

		echo "<td id='td'>".$k['name']."</td>";
		echo "<td id='td'>".($k['lastname'])."</td>";

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

		 $paises=countryArray();
		 $states=cities($k['country']);
		 $provincia=$states[$k['state']];

			  echo "<td id='td'>".$paises[$k['country']]."</td>";

			 if ($provincia){
				echo "<td id='td'>".$provincia."</td>";
			 }else{
			    echo  "<td id='td'>".$k['state']."</td>";
			 }
			 
			  ?>
			<td>
			<?if($k['id_commission']==$_SESSION['referal']['id']){?>
				Rental
			<?}?>-
			<?if($k['id_seller']==$_SESSION['referal']['id']){?>
			Sale
			<?}?>
			</td></tr>
			<?

		 if ($x==0){$x++;} elseif ($x==1){$x--;}
		}
		//.utf8_encode($k['lastname'])
		?>
		</table>

 <?/* } */?>
