<? include('menu_CSS/menu-admin.php');?>
<p class="header"><? 
switch($_GET['c']){
	case 1:
		echo "All";break;
	case 2:
		echo "Sales";break;
	case 3:
		echo "Rental";break;
	default:
		echo "Sales";
}?> Clients</p>

<div style="padding-left:35px">

<form method="post" action="Sale_clients.php">
Search <input class="input" type="text" size="50" name="search" value="<?=$_POST['search']?>"  /> by <select class="input" name="findby">
<option  <? if ($_POST['findby']=="id"){?> selected="selected" <? }?>value="id">No</option>
<option <? if (!$_POST['findby']){?> selected="selected" <? }?> <? if ($_POST['findby']=="name"){?> selected="selected" <? }?> value="name">Name</option>
<option <? if ($_POST['findby']=="lastname"){?> selected="selected" <? }?> value="lastname">Last name</option>
<option <? if ($_POST['findby']=="email"){?> selected="selected" <? }?>value="email">Email</option>
<option <? if ($_POST['findby']=="cedula"){?> selected="selected" <? }?> value="cedula">Cedula</option>
<option <? if ($_POST['findby']=="passport"){?> selected="selected" <? }?> value="passport">Passport</option>
</select><input class="book_but" type="submit" name="find" value="Find" />


<p style="float:right;margin-right:51px;">To show: <select name="client_toshow" onchange="window.location='Sale_clients.php?c='+this.value">
<option value="1" <? if($_GET['c']==1){?>selected="selected"<? }?>>All</option>
<option value="2" <? if(!$_GET['c']){?>selected="selected"<? }?> <? if($_GET['c']==2){?>selected="selected"<? }?>>Sales</option>
<option value="3" <? if($_GET['c']==3){?>selected="selected"<? }?>>Rental</option></select></p>
</form>

</div>

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
 }else{?>

		<!--<form method="post" action="search_clients_referal.php" >
			<p id="fields" style="text-align:center;">Referal:<?
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
		</form>-->

		<hr />
		<?
		if ($_POST['referal']) $referal=$_POST['referal'];
		if ($_GET['re']) $referal=$_GET['re'];

		switch($_GET['c']){
			case 1:
				//echo "All";
				$customers=$data->show_all('customers', 'id');//All cliente
				break;
			case 2:
				//echo "Sales";
				$customers=$data->show_data('customers', "`id_seller`<>'0'", 'id');//sales cliente
				break;
			case 3:
				//echo "Rental";
				$customers=$data->show_data('customers', "`id_seller`<>'0'", 'id');//Rental cliente
				break;
			default:
				$customers=$data->show_data('customers', "`id_seller`<>'0'", 'id');//sales cliente BY DEFAULT
				//echo "Sales";
		}

		$total_records=$data->getAffectedRows();
		?>

		 <?/* if ($referal){*/?>
		<?php


		?>

			  <? if ($customers){

			  ?>
				<p style="font-size:10px; padding-left:15px; color:blue;"><strong>Total customers found: <?=$total_records?></strong></p>
				<hr />
				<table  align="center" cellpadding="2" cellspacing="2" border="0">

					<tr class="title">
						<td class='centro' id="td">
							NO
						</td>
						<td class='centro' id="td">
							STATUS
						</td>
						<td class='centro' id="td">
							NAME
						</td>
						<td class='centro' id="td">
							EMAIL
						</td>
						<td class='centro' id="td">
							PHONE
						</td>
						<td class='centro' id="td">
							COUNTRY
						</td>
						<td class='centro' id="td">
						   DATE REGISTERED
						</td>
						<?php
							switch($_GET['c']){
								case 1:
									//echo "All";
									?>
									
									<?
									break;
								case 2:
									//echo "Sales";
									?>
									<td class='centro' id="td">
									   AGENT
									</td>
									<td class='centro' id="td">
									   DAYS TO EXPIRE
									</td>
									<?
									break;
								case 3:
									//echo "Rental";
									?>
									
									<?
									break;
								default:
									?>
									<td class='centro' id="td">
									   AGENT
									</td>
									<td class='centro' id="td">
									   DAYS TO EXPIRE
									</td>
									<?
									//echo "Sales";
							}
						?>
						
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

					  
						
					 ?>
					
					 <td><?=date('M j, Y',strtotime($k['date']))?></td>
		<?php
							switch($_GET['c']){
								case 1:
									//echo "All";
									?>
									
									<?
									break;
								case 2:
									//echo "Sales";
									?>
										 <td><?
											$ag=AgentClient($tipo='sale',$idclient=$k['id']);	#sale agent	
											if($ag){				
											 $diasFechas=days_dates($start=date('Y-m-d',strtotime($ag['fecha'])), $end='');# 18 meses rental
											 $remaining=(AGENTTIME-$diasFechas);
											}
											$agent=$data->showTable_r($table='commission', $field='id', $value=$k['id_seller'], $operator='=');

											echo $agent[0]['name']." ".$agent[0]['lastname'];?></td>
											
											<?php
										 if($remaining<=0){/*CLIENT HAS EXPIRED*/
											 $remaining=0; /*reset value in case many days overdue*/
											 /*REMOVE THE SALE CLIENT AGENT FROM THE CLIENT*/
											 $database=new DB();
											 $database->removeSalesAgent($clientID=$k['id']);
										 }
										 ?>
										 
										 <td><?=$remaining?> Days </td>
									<?
									break;
								case 3:
									//echo "Rental";
									?>
									
									<?
									break;
								default:
									?>
										 <td><?
											$ag=AgentClient($tipo='sale',$idclient=$k['id']);	#sale agent	
											if($ag){				
											 $diasFechas=days_dates($start=date('Y-m-d',strtotime($ag['fecha'])), $end='');# 18 meses rental
											 $remaining=(AGENTTIME-$diasFechas);
											}
											$agent=$data->showTable_r($table='commission', $field='id', $value=$k['id_seller'], $operator='=');
											echo $agent[0]['name']." ".$agent[0]['lastname'];?></td>
										
										<?php
										 if($remaining<=0){/*CLIENT HAS EXPIRED*/
											 $remaining=0; /*reset value in case many days overdue*/
											 /*REMOVE THE SALE CLIENT AGENT FROM THE CLIENT*/
											 $database=new DB();
											 $database->removeSalesAgent($clientID=$k['id']);
										 }
										 ?>
										 
										 <td><?=$remaining?> Days </td>
									<?
									//echo "Sales";
							}
						?>
					 </tr>
					 <?

				 if ($x==0){$x++;} elseif ($x==1){$x--;}
				}
				//.utf8_encode($k['lastname'])
				?>
				</table>

			  <?}else{/* IF THRE IS NOT CLIENT TO SHOW */
				echo "<p style='text-align:center; color:red; font-size:16px;'>There is not client found for selected Referal.</p>";

			  }?>

 <? }?>