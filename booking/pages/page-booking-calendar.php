 <? if ($_SESSION['info']){?>
 <div style="width:733px; float:left;background-color:green; padding:2px; border:1px solid #000000;">
	<form method="post" action="booking-calendar.php">
	  <p style="margin:0; padding:0; text-align:center;"><span style="color:#FFFFFF;"> Search </span><input type="text" name="search" value="<?=$_POST['search']?>" size="70"  style="border:1px solid gray;"/>
	  <span style="color:#FFFFFF;">  by </span><select name="searchtype" style="border:1px solid gray;">
	   		<option value="ref" <? if($_POST['searchtype']=='ref'){?> selected="selected" <?}?> >Booking No.</option>
	   		<option value="name" <? if($_POST['searchtype']=='name'){?> selected="selected" <?}?> >Main Name</option>
	   		<option value="lastname" <? if($_POST['searchtype']=='lastname'){?> selected="selected" <?}?> >Main Lastname </option>
	   		<option value="email" <? if($_POST['searchtype']=='email'){?> selected="selected"<?}?> >Email </option>
	   		<option value="guestn" <? if($_POST['searchtype']=='guestn'){?> selected="selected"<?}?> >Guest Name</option>
	   		<option value="guestl" <? if($_POST['searchtype']=='guestl'){?> selected="selected"<?}?> >Guest Lastname</option>
	   </select>
	   <input type="submit" name="go" value="Go" class="book_but"/></p>
	 </form>
 </div>
 <? if($_GET['ts']){$_SESSION['toshow']=$_GET['ts'];}/*must have value before form*/?>
 <div style="width:203px; float:right; background-color:yellow; padding:2px; border:1px solid #000000; ">
	 <form method="post" action="booking-calendar.php">
	 <p style="margin:0; padding:0; text-align:center;">Show:
	 <select name="toshow" onchange="window.location='booking-calendar.php?ts='+this.value" >
		<option value="10" <?if($_SESSION['toshow']==10){?>selected="selected"<?}?>>All Villas</option>
		<option value="1" <?if($_SESSION['toshow']==1){?>selected="selected"<?}?>>1 Bedroom</option>
		<option value="2" <?if($_SESSION['toshow']==2){?>selected="selected"<?}?> <?if($_SESSION['toshow']==''){?>selected="selected"<?}?>>2 Bedrooms</option>
		<option value="3" <?if($_SESSION['toshow']==3){?>selected="selected"<?}?>>3 Bedrooms</option>
		<option value="4" <?if($_SESSION['toshow']==4){?>selected="selected"<?}?>>4 Bedrooms</option>
		<option value="5" <?if($_SESSION['toshow']==5){?>selected="selected"<?}?>>5 Bedrooms</option>
		<option value="6" <?if($_SESSION['toshow']==6){?>selected="selected"<?}?>>6 Bedrooms</option>
	 </select>
	 <select name="showi" onchange="window.location='booking-calendar.php?ti='+this.value" >
		<option value="1" <?if($_SESSION['showi']==1){?>selected="selected"<?}?>>online</option>
		<option value="2" <?if($_SESSION['showi']==2){?>selected="selected"<?}?>>internal</option>
		<option value="3" <?if($_SESSION['showi']==3){?>selected="selected"<?}?>>all</option>
	 </select></p>
	 <!--<input type="submit" name="show" class="book_but" value="See"/>-->
	 </form>
 </div> 
 
  <? if(trim($_POST['search'])==''){?>
	<div style="position:absolute; z-index: 2; top:225px; background-color:transparent; width:112px; height:254px; float:left; padding:0px; margin:0px; margin-left:-109px;">
    <img src="images/legend_jorge2.png" alt="" width="111" height="358" />
    </div>
	
	

	<div style="position:absolute; z-index: 2; top:156px; background-color:#e0dfd4; width:117px; height:225px;  padding:0px; margin:0px; margin-left:962px;">
		   <?php
		   $link=new getQueries;
		   
			$precios_2bdr_pre=$link->display_table($table='prices_villas', $condition=" beds='2' AND type='1' AND active='1'", $order='id');
		 $precios_2bdr_del=$link->display_table($table='prices_villas', $condition=" beds='2' AND type='2' AND active='1'", $order='id');
		 
		 $precios_3bdr_pre=$link->display_table($table='prices_villas', $condition=" beds='3' AND type='1' AND active='1'", $order='id');
		 $precios_3bdr_del=$link->display_table($table='prices_villas', $condition=" beds='3' AND type='2' AND active='1'", $order='id');
		 
		 $precios_4bdr_pre=$link->display_table($table='prices_villas', $condition=" beds='4' AND type='1' AND active='1'", $order='id');
		 $precios_4bdr_del=$link->display_table($table='prices_villas', $condition=" beds='4' AND type='2' AND active='1'", $order='id');
		 
		 $precios_5bdr_pre=$link->display_table($table='prices_villas', $condition=" beds='5' AND type='1' AND active='1'", $order='id');
		 $precios_5bdr_del=$link->display_table($table='prices_villas', $condition=" beds='5' AND type='2' AND active='1'", $order='id');
		 
		 $precios_6bdr_pre=$link->display_table($table='prices_villas', $condition=" beds='6' AND type='1' AND active='1'", $order='id');
		 $precios_6bdr_del=$link->display_table($table='prices_villas', $condition=" beds='6' AND type='2' AND active='1'", $order='id');

		 ?>
		 <!--<table align="center" border="1" cellpadding="1" Cellspacing="0">
			<tr>
				<td>bed</td>
				<td></td>
				<td>price</td>
			</tr>
			<?php if($precios_2bdr_pre){?>
			<tr >
				<td><?=$precios_2bdr_pre[0]['beds']?></td>
				<td><? if($precios_2bdr_pre[0]['type']==1){ echo "prem"; }else{ echo "delu"; }?></td>
				<td><?=number_format($precios_2bdr_pre[0]['price'],0)?></td>
			</tr>
			<?php }?>
			<?php if($precios_2bdr_del){?>
			<tr style="background-color:gray; color:white;">
				<td><?=$precios_2bdr_del[0]['beds']?></td>
				<td><? if($precios_2bdr_del[0]['type']==1){ echo "prem"; }else{ echo "delu"; }?></td>
				<td><?=number_format($precios_2bdr_del[0]['price'],0)?></td>
			</tr>
			<?php }?>
			<?php if($precios_3bdr_pre){?>
			<tr>
				<td><?=$precios_3bdr_pre[0]['beds']?></td>
				<td><? if($precios_3bdr_pre[0]['type']==1){ echo "prem"; }else{ echo "delu"; }?></td>
				<td><?=number_format($precios_3bdr_pre[0]['price'],0)?></td>
			</tr>
			<?php }?>
			<?php if($precios_3bdr_del){?>
			<tr style="background-color:gray; color:white;">
				<td><?=$precios_3bdr_del[0]['beds']?></td>
				<td><? if($precios_3bdr_del[0]['type']==1){ echo "prem"; }else{ echo "delu"; }?></td>
				<td><?=number_format($precios_3bdr_del[0]['price'],0)?></td>
			</tr>
			<?php }?>
			<?php if($precios_4bdr_pre){?>
			<tr>
				<td><?=$precios_4bdr_pre[0]['beds']?></td>
				<td><? if($precios_4bdr_pre[0]['type']==1){ echo "prem"; }else{ echo "delu"; }?></td>
				<td><?=number_format($precios_4bdr_pre[0]['price'],0)?></td>
			</tr>
			<?php }?>
			<?php if($precios_4bdr_del){?>
			<tr style="background-color:gray; color:white;">
				<td><?=$precios_4bdr_del[0]['beds']?></td>
				<td><? if($precios_4bdr_del[0]['type']==1){ echo "prem"; }else{ echo "delu"; }?></td>
				<td><?=number_format($precios_4bdr_del[0]['price'],0)?></td>
			</tr>
			<?php }?>
			<?php if($precios_5bdr_pre){?>
			<tr>
				<td><?=$precios_5bdr_pre[0]['beds']?></td>
				<td><? if($precios_5bdr_pre[0]['type']==1){ echo "prem"; }else{ echo "delu"; }?></td>
				<td><?=number_format($precios_5bdr_pre[0]['price'],0)?></td>
			</tr>
			<?php }?>
			<?php if($precios_5bdr_del){?>
			<tr style="background-color:gray; color:white;">
				<td><?=$precios_5bdr_del[0]['beds']?></td>
				<td><? if($precios_5bdr_del[0]['type']==1){ echo "prem"; }else{ echo "delu"; }?></td>
				<td><?=number_format($precios_5bdr_del[0]['price'],0)?></td>
			</tr>
			<?php }?>
			<?php if($precios_6bdr_pre){?>
			<tr>
				<td><?=$precios_6bdr_pre[0]['beds']?></td>
				<td><? if($precios_6bdr_pre[0]['type']==1){ echo "prem"; }else{ echo "delu"; }?></td>
				<td><?=number_format($precios_6bdr_pre[0]['price'],0)?></td>
			</tr>
			<?php }?>
			<?php if($precios_6bdr_del){?>
			<tr style="background-color:gray; color:white;">
				<td><?=$precios_6bdr_del[0]['beds']?></td>
				<td><? if($precios_6bdr_del[0]['type']==1){ echo "prem"; }else{ echo "delu"; }?></td>
				<td><?=number_format($precios_6bdr_del[0]['price'],0)?></td>
			</tr>
			<?php }?>
		</table>-->
    </div>
	
	
	 <?
      $nuevo_mes=$_GET['nuevo_mes'];  $nuevo_ano=$_GET['nuevo_ano'];  $dia=$_GET['dia'];

	if (!$HTTP_POST_VARS && !$nuevo_mes && !$nuevo_ano && !$dia){
		$tiempo_actual = time();
		$mes = date("n", $tiempo_actual);
		$ano = date("Y", $tiempo_actual);
		$dia=date("d");
		$fecha=$ano . "-" . $mes . "-" . $dia;

	}else {
		$mes = $nuevo_mes;
		$ano = $nuevo_ano;
		$dia = $dia;
		$fecha=$ano . "-" . $mes . "-" . $dia;

	}

	 ob_start();//start buffering output
	 mostrar_meses($dia,$mes,$ano);
     $content=ob_get_contents(); //get all the buffered informations and save to content var
	 ob_end_clean(); //clean buffer
	 echo "$content";  //display buffer


	  $ti_ac = time();
	  $mes1 = date("n", $ti_ac);

	if ($mes!=$mes1){
		if (($_GET['inicio'])&&($_GET['villa'])){
			   echo"<div style=\"float:left; padding-left:12px; padding-right:0px;\"><span style=\"font-size:10px;\"><a href=\"booking-calendar.php?inicio=".$_GET['inicio']."&villa=".$_GET['villa']."\">Jump to Actual Month</a></span></div>";
		}else{
				echo"<div style=\"float:left; padding-left:12px; padding-right:0px;\"><span style=\"font-size:10px;\"><a href=\"booking-calendar.php\">Jump to Actual Month</a></span></div>";
		}
	}

      $inicio=$_GET['inicio'];
      $villa=$_GET['villa'];
	 if ($inicio){
	    $fecha_inicio=strtotime($inicio);
	    $fecha_inicio1=date('D. F j, Y', $fecha_inicio);
		$a=new getQueries;
		$resultado=$a->villa($villa);
		 if ($mes!=$mes1){

		 }
		echo "<p class=\"centro\" style=\"padding:0; margin:0; clear:both;\"><span style=\"font-size:10px;\"><strong>Villa No. </strong>".$resultado[0]['no']." - ";
		echo "<strong>Starting date:</strong> $fecha_inicio1 <a href='booking-calendar.php?dia=$dia&nuevo_mes=$mes&nuevo_ano=$ano'><img src='images/b_drop.png' alt='Delete starting date' title='Delete starting date' width='16' height='16' border='0'/></a></span></p>";
	 }

	 ?>


  <?}else{
     //echo "Resultado de la busqueda";
     switch($_POST['searchtype']){
      case 'ref'		:
      					$_POST['search']=trim($_POST['search']);
						//$reference = ereg_replace("[^0-9]", "", $_POST['search']); //take off all other characters and only left numbers
						$reference =$_POST['search'];
						if 	($reference!=''){
							$reference=str_pad($reference, 9, "0", STR_PAD_LEFT);
						      if (isLength($reference,6,10)==true){ //verify an lenght between 6 and 10

				                        $db= new getQueries();
										$result=$db->see_occupancy_ref($reference);
										//$total_records=$db->getAffectedRows();


								    if ($result){

										  ?>
										  <p>&nbsp;</p>
										  <hr/>
										<table align="center" cellpadding="2" cellspacing="2">
											<tr>
												<td colspan="7" align="center" width="85%" class="blue_light"><!--<p>--><strong>DETAILS FOR BOOKING <?=$reference?></strong><!--</p>-->
												</td>
											</tr>
				    						<tr bgcolor="#a6cdf4">
					    						<td align="center" class="blue_dark"><strong>Villa</strong>
					    						</td>
					    						<td align="center" class="blue_dark"><strong>From</strong>
					    						</td>
					    						<td  align="center" class="blue_dark"><strong>To</strong>
					    						</td>
					    						<td align="center" class="blue_dark"><strong>Price</strong>
					    						</td>
					    						<td  align="center" class="blue_dark"><strong>Comment</strong>
					    						</td>
					    						<td align="center" class="blue_dark"><strong>Ref.</strong>
					    						</td>
					    						<td  class="blue_dark" align="center"><strong>Status</strong>
					    						</td>
				    						</tr>
				    					<? foreach ($result as $b){?>
										    <tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
											    <td style="font-size:9px" ><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
											    <td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td>
											    <td style="font-size:11px"  ><?=$b['ppn']?></td>
											    <td style="font-size:11px" ><?=$b['note']?></td>
											    <td  style="font-size:11px" ><?=$b['ref']?></td>
											    <td  style="font-size:11px" >
											    	<?=booking_status($b['status']);?>

											    	<? /*switch ($b['status']){
											            case 0:
											                echo "<span style='color:red'>Cancelled</span>";
											                break;
											            case 1:
											                echo "<span class='verde'>Checked&nbsp;in</span>";
											                break;
											            case 2:
											                echo "<span class='azul2'>Confirmed</span>";
											                break;
											            case 3:
											                echo "<span class='morado'>Transit</span>";
											                break;
											            case 4:
											                echo "<span class='azul'>Checked&nbsp;out</span>";
											                break;
											            case 5:
				         									echo "<span style='color:red'>Maintenance</span>";
					       									break;
					       								case 6:
												         	echo "<span class='r_vip'>VIP Rental</span>";
													       	break;
													    case 7:
												         	echo "<span class='r_owner'>Owner in house</span>";
													       	break;
													    case 8:
												         	echo "<span class='r_long'>Long Term Rental</span>";
													       	break;
											            default:
											                echo "<span class='negro'>Unavailabe</span>";
											                break;
											        }*/?></td>
											</tr>
											    <? }?>
										    </table>
										<?
									}else{
										echo "<p>&nbsp;</p>";
										echo "<hr/>";
										echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No result found for this booking number</p>";
									}
							  }else{
								echo "<p>&nbsp;</p>";
								echo "<hr/>";
								echo "<p class='centro' style='font-weight:bold; font-size:16px;'>Invalid number, please, try again</p>";
							  }
						}else{
							echo "<p>&nbsp;</p>";
							echo "<hr/>";
							echo "<p class='centro' style='font-weight:bold; font-size:16px;'>Error: No reference number</p>";
						}
      					break;

      case 'name'		:
		                $db= new getQueries();

							$result=$db->showSearch_like('customers','id',$_POST['search'],$_POST['searchtype']);
							$total_records=$db->getAffectedRows();

					    if ($result){
					    	?>
					    	   <p>&nbsp;</p>
								<hr/>
					    	<?
						echo "<p style='text-align:center; font-size:10px; font-weight:bold' >Found ". $total_records." Customer(s)</p><br>";
							  ?>
								                       <table  align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><tr class="title"><td class='centro' id="td">NO</td><td class='centro' id="td">NAME</td><td class='centro' id="td">EMAIL</td><td class='centro' id="td">PHONE</td><td class='centro' id="td">STATUS</td><td class='centro' id="td">PASSPORT</td><td class='centro' id="td">CEDULA</td></tr>
								<?php
							$x=0;
							foreach ($result as $k){

								#echo $customers['4']['name'];
								echo "<tr class='fila$x'  onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='view-clients-details.php?id=".$k['id']."'\" >
								<td id='td' class='derecha'>".$k['id']."</td>".
								"<td id='td'>".$k['name']." ".utf8_encode($k['lastname'])."</td>".
								"<td id='td'>".$k['email']."</td>".
								"<td id='td'>".$k['phone']."</td>";
								if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }
								echo"<td id='td'>".$k['passport']."</td><td id='td'>".$k['cedula']."</td></tr>";
								 if ($x==0){$x++;} elseif ($x==1){$x--;}
							}
		                    ?>
							</table>
							<?
						}else{
							echo "<p>&nbsp;</p>";
							echo "<hr/>";
							echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No Result Found</p>";
						}
                		break;

      case 'lastname'	:
                        $db= new getQueries();

							$result=$db->showSearch_like('customers','id',$_POST['search'],$_POST['searchtype']);
							$total_records=$db->getAffectedRows();

					    if ($result){

					    ?>
					    	   <p>&nbsp;</p>
								<hr/>
					    	<?
						echo "<p style='text-align:center; font-size:10px; font-weight:bold' >Found ". $total_records." Customer(s)</p><br>";
							  ?>
								                       <table  align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><tr class="title"><td class='centro' id="td">NO</td><td class='centro' id="td">NAME</td><td class='centro' id="td">EMAIL</td><td class='centro' id="td">PHONE</td><td class='centro' id="td">STATUS</td><td class='centro' id="td">PASSPORT</td><td class='centro' id="td">CEDULA</td></tr>
								<?php
							$x=0;
							foreach ($result as $k){

								echo "<tr class='fila$x'  onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='view-clients-details.php?id=".$k['id']."'\" >
								<td id='td' class='derecha'>".$k['id']."</td>".
								"<td id='td'>".$k['name']." ".utf8_encode($k['lastname'])."</td>".
								"<td id='td'>".$k['email']."</td>".
								"<td id='td'>".$k['phone']."</td>";
								if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }
								echo"<td id='td'>".$k['passport']."</td><td id='td'>".$k['cedula']."</td></tr>";
								 if ($x==0){$x++;} elseif ($x==1){$x--;}

							}
		                    ?>
							</table>
							<?
						}else{
							echo "<p>&nbsp;</p>";
							echo "<hr/>";
							echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No Result Found</p>";
						}
                		break;

      case 'email'		:
                        $db= new getQueries();

							$result=$db->showSearch_like('customers','id',$_POST['search'],$_POST['searchtype']);
							$total_records=$db->getAffectedRows();

					    if ($result){
					    	?>
					    	   <p>&nbsp;</p>
								<hr/>
					    	<?
						echo "<p style='text-align:center; font-size:10px; font-weight:bold' >Found ". $total_records." Customer(s)</p><br>";
							  ?>
								                       <table  align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><tr class="title"><td class='centro' id="td">NO</td><td class='centro' id="td">NAME</td><td class='centro' id="td">EMAIL</td><td class='centro' id="td">PHONE</td><td class='centro' id="td">STATUS</td><td class='centro' id="td">PASSPORT</td><td class='centro' id="td">CEDULA</td></tr>
								<?php
							$x=0;
							foreach ($result as $k){
								echo "<tr class='fila$x'  onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='view-clients-details.php?id=".$k['id']."'\" >
								<td id='td' class='derecha'>".$k['id']."</td>".
								"<td id='td'>".$k['name']." ".utf8_encode($k['lastname'])."</td>".
								"<td id='td'>".$k['email']."</td>".
								"<td id='td'>".$k['phone']."</td>";
								if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }
								echo"<td id='td'>".$k['passport']."</td><td id='td'>".$k['cedula']."</td></tr>";
								 if ($x==0){$x++;} elseif ($x==1){$x--;}

							}
		                    ?>
							</table>
							<?
						}else{
							echo "<p>&nbsp;</p>";
							echo "<hr/>";
							echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No Result Found</p>";
						}
                		break;

         case 'guestn'		:  /* GUEST NAME*/
                        $db= new getQueries();

							$result=$db->showSearch_like('people','id',$_POST['search'],'name');
							$total_records=$db->getAffectedRows();

					    if ($result){

					    	?>
					    	   <p>&nbsp;</p>
								<hr/>
					    	<?
						echo "<p style='text-align:center; font-size:10px; font-weight:bold' >Found ". $total_records." Guest(s)</p><br>";
							  ?>
						<table  align="center" cellpadding="2" cellspacing="2" border="0">
								<tr class="title"><tr class="title">
									<td class='centro' id="td">FIRST NAME</td>
									<td class='centro' id="td">LAST NAME</td>
									<td class='centro' id="td">VILLA #</td>
									<td class='centro' id="td">ARRIVAL</td>
									<td class='centro' id="td">DEPARTURE</td>
									<td class='centro' id="td">MAIN CUSTOMER</td>
									<td class='centro' id="td">REF</td>
									<td>Link to Booking</td>
								</tr>
								<?php
							$x=0;
							foreach ($result as $k){
                              $booking_guest=$db->guest_search_reserveid($k['id_reserve']);
								?>
								<tr class='fila<?=$x?>' >
								<td id='td' class='derecha'><?=$k['name']?></td>
								<td id='td' class='derecha'><?=$k['lastname']?></td>
								<td id='td'><?=$booking_guest['villa_no']?></td>
								<td id='td'><?=$booking_guest['start']?></td>
								<td id='td'><?=$booking_guest['end']?></td>
								<td class='centro rojo' id='td'><?=$booking_guest['name']." ".$booking_guest['lastname']?></td>
								<td id='td'><?=$booking_guest['ref']?></td>

								  <td><a href="#" onclick="reserva('reserva_details.php?id=<?=$k['id_reserve']?>','Details for Selection', 530, 800)" title="Click to see Reservation">Details</a></td>
								</tr>
								<?
								 if ($x==0){$x++;} elseif ($x==1){$x--;}
							}
		                    ?>
							</table>
							<?
						}else{
							echo "<p>&nbsp;</p>";
							echo "<hr/>";
							echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No Result Found</p>";
						}
                		break;

            case 'guestl'	:  /* GUEST LASTNAME*/
                          $db= new getQueries();

							$result=$db->showSearch_like('people','id',$_POST['search'],'lastname');
							$total_records=$db->getAffectedRows();

					    if ($result){

					    	?>
					    	   <p>&nbsp;</p>
								<hr/>
					    	<?
						echo "<p style='text-align:center; font-size:10px; font-weight:bold' >Found ". $total_records." Guest(s)</p><br>";
							  ?>
						<table  align="center" cellpadding="2" cellspacing="2" border="0">
								<tr class="title"><tr class="title">
									<td class='centro' id="td">FIRST NAME</td>
									<td class='centro' id="td">LAST NAME</td>
									<td class='centro' id="td">VILLA #</td>
									<td class='centro' id="td">ARRIVAL</td>
									<td class='centro' id="td">DEPARTURE</td>
									<td class='centro' id="td">MAIN CUSTOMER</td>
									<td class='centro' id="td">REF</td>
									<td>Link to Booking</td>
								</tr>
								<?php
							$x=0;
							foreach ($result as $k){
                              $booking_guest=$db->guest_search_reserveid($k['id_reserve']);
								?>
								<tr class='fila<?=$x?>' >
								<td id='td' class='derecha'><?=$k['name']?></td>
								<td id='td' class='derecha'><?=$k['lastname']?></td>
								<td id='td'><?=$booking_guest['villa_no']?></td>
								<td id='td'><?=$booking_guest['start']?></td>
								<td id='td'><?=$booking_guest['end']?></td>
								<td class='centro rojo' id='td'><?=$booking_guest['name']." ".$booking_guest['lastname']?></td>
								<td id='td'><?=$booking_guest['ref']?></td>

								  <td><a href="#" onclick="reserva('reserva_details.php?id=<?=$k['id_reserve']?>','Details for Selection', 530, 800)" title="Click to see Reservation">Details</a></td>
								</tr>
								<?
								 if ($x==0){$x++;} elseif ($x==1){$x--;}
							}
		                    ?>
							</table>
							<?
						}else{
							echo "<p>&nbsp;</p>";
							echo "<hr/>";
							echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No Result Found</p>";
						}
                		break;
     }

  }
  
  
  
 }else{
 	die ("<meta http-equiv=\"refresh\" content=\"0;url=../login.php\">");
 }?>