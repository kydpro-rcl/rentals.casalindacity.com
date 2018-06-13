<p class="header">Search Customer</p>

<div style="padding-left:35px"><form method="post" action="find-client.php">
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

	/*switch ($_POST['findby']){
		  case "name":
		  break;

		  case "lastname":
		  break;

		  case "email":
		  break;

		  case "cedula":
		  break;

		  case "passport":
		  break;
		}*/

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
	}?>
 </div>