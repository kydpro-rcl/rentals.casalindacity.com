<!--//<p class="header">Search Customer</p>//-->
<p>&nbsp;</p>
<div style="padding-left:35px"><form method="post" action="view-clients.php">
Search <input class="input" type="text" size="50" name="search" value="<?=$_POST['search']?>"  /> by <select class="input" name="findby">
<option  <? if ($_POST['findby']=="id"){?> selected="selected" <? }?>value="id">No</option>
<option <? if (!$_POST['findby']){?> selected="selected" <? }?> <? if ($_POST['findby']=="name"){?> selected="selected" <? }?> value="name">Name</option>
<option <? if ($_POST['findby']=="lastname"){?> selected="selected" <? }?> value="lastname">Last name</option>
<option <? if ($_POST['findby']=="email"){?> selected="selected" <? }?>value="email">Email</option>
<option <? if ($_POST['findby']=="cedula"){?> selected="selected" <? }?> value="cedula">Cedula</option>
<option <? if ($_POST['findby']=="passport"){?> selected="selected" <? }?> value="passport">Passport</option>
</select><input class="book_but" type="submit" name="find" value="Find" />
</form></div>
<hr />
<div style="padding-left:35px">
 <? if ($_POST['find']){
	//echo "Search results";

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
						                       <table  align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><tr class="title"><td class='centro' id="td">NO</td><td class='centro' id="td">NAME</td><td class='centro' id="td">EMAIL</td><td class='centro' id="td">PHONE</td><td class='centro' id="td">STATUS</td><td class='centro' id="td">PASSPORT</td><td class='centro' id="td">CEDULA</td></tr>
						<?php
					$x=0;
					foreach ($result as $k){
							//echo $k['cedula']." ".$k['cedula'];
	                      // shoing result




						#echo $customers['4']['name'];
						echo "<tr class='fila$x'  onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='view-clients-details.php?id=".$k['id']."'\" >
						<td id='td' class='derecha'>".$k['id']."</td>".
						"<td id='td'>".$k['name']." ".utf8_encode($k['lastname'])."</td>".
						"<td id='td'>".$k['email']."</td>".
						"<td id='td'>".$k['phone']."</td>";
						if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }
						echo"<td id='td'>".$k['passport']."</td><td id='td'>".$k['cedula']."</td></tr>";
						 if ($x==0){$x++;} elseif ($x==1){$x--;}



                      //showing result

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
 }/*else{?>

   <?php
$data= new getQueries ();
if (!$_GET['sort']){
$customers=$data->show_all('customers', 'id');
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
 case "lastname":
 			$customers=$data->show_all('customers', 'lastname');
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

	<p class="header">All our customers</p>
	<p style="font-size:10px; padding-left:15px;"><strong>Total customers found: <?=$total_records?></strong> | <a href="export_to_excel_clients.php">Export to Excel</a> | <a href="clients_list_print.php">Print list</a></p>
	<hr />
	<table  align="center" cellpadding="2" cellspacing="2" border="0">

		<tr class="title">
			<td class='centro' id="td">
				<?if (($_GET['sort']!="")&&($_GET['sort']!="no")){?>
	            <a href="view-clients.php?sort=no" title="Sort by numbers">NO</a>
				<?}else{?>
				NO
				<?}?>
			</td>
			<td class='centro' id="td">
				<?if ($_GET['sort']!="status"){?>
	            <a href="view-clients.php?sort=status" title="Sort by status">STATUS</a>
				<?}else{?>
				STATUS
				<?}?>
			</td>
			<td class='centro' id="td">
				<?if ($_GET['sort']!="lastname"){?>
	            <a href="view-clients.php?sort=lastname" title="Sort by lastnames">LASTNAME</a>
				<?}else{?>
				LASTNAME
				<?}?>
			</td>
			<td class='centro' id="td">
				<?if ($_GET['sort']!="name"){?>
	            <a href="view-clients.php?sort=name" title="Sort by names">NAME</a>
				<?}else{?>
				NAME
				<?}?>
			</td>
			
			<td class='centro' id="td">
				<?if ($_GET['sort']!="email"){?>
	            <a href="view-clients.php?sort=email" title="Sort by emails">EMAIL</a>
				<?}else{?>
				EMAIL
				<?}?>
			</td>
			<td class='centro' id="td">
				<?if ($_GET['sort']!="phone"){?>
	            <a href="view-clients.php?sort=phone" title="Sort by phones">PHONE</a>
				<?}else{?>
				PHONE
				<?}?>
			</td>
			<td class='centro' id="td">
				<?if ($_GET['sort']!="country"){?>
	            <a href="view-clients.php?sort=country" title="Sort by countries">COUNTRY</a>
				<?}else{?>
				COUNTRY
				<?}?>
			</td>
			<td class='centro' id="td">
				<?if ($_GET['sort']!="state"){?>
	            <a href="view-clients.php?sort=state" title="Sort by cities">STATE</a>
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



	echo "<td id='td'>".($k['lastname'])."</td><td id='td'>".$k['name']."</td>".
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


 <?}*/?>
 </div>