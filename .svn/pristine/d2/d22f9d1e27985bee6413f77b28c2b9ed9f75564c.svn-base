<? include('menu_CSS/menu-admin.php');?>

<?
$db= new getQueries ();

  if($_POST){
  	//buscar a ver si encuentro guardada alguna configuracion de precios
  	$setting_guardado=$db->show_any_data_limit1($table='price_settings', $field='active', $value='1', $operator='=');
  	$set=$setting_guardado[0];

  	$data= new DB;
  	$id_adm=$_SESSION['info']['id']; $date=date("Y-m-d G:i:s");
    //si hay configuracion actualizo
    if($set){
     $guardar_setting=$data->update_priceSetting(
													 $id=$set['id'], 
													 $id_adm, 
													 $date, 
													 $short_m_night=$_POST['minshort'], 
													 $mid_m_night=$_POST['minmid'], 
													 $long_m_night=$_POST['minlong'], 
													 $short2bdr=$_POST['short2b'], 
													 $short3bdr=$_POST['short3b'], 
													 $short4bdr=$_POST['short4b'], 
													 $short5bdr=$_POST['short5b'], 
													 $short6bdr=$_POST['short6b'], 
													 $mid2bdr=$_POST['mid2b'], 
													 $mid3bdr=$_POST['mid3b'], 
													 $mid4bdr=$_POST['mid4b'], 
													 $mid5bdr=$_POST['mid5b'], 
													 $mid6bdr=$_POST['mid6b']
													 );
    }else{
    	//si no hay configuracion inserto
      $guardar_setting=$data->insert_priceSetting(
													 $id_adm, 
													 $date, 													  
													 $short_m_night=$_POST['minshort'], 
													 $mid_m_night=$_POST['minmid'], 
													 $long_m_night=$_POST['minlong'], 
													 $short2bdr=$_POST['short2b'], 
													 $short3bdr=$_POST['short3b'], 
													 $short4bdr=$_POST['short4b'], 
													 $short5bdr=$_POST['short5b'], 
													 $short6bdr=$_POST['short6b'], 
													 $mid2bdr=$_POST['mid2b'], 
													 $mid3bdr=$_POST['mid3b'], 
													 $mid4bdr=$_POST['mid4b'], 
													 $mid5bdr=$_POST['mid5b'], 
													 $mid6bdr=$_POST['mid6b'], 
													  $active='1'
													 );
    }


   if($guardar_setting){
    $_GET['result']="New Settings successfully saved";
   }
  }

  $setting_guardado=$db->show_any_data_limit1($table='price_settings', $field='active', $value='1', $operator='=');
  $set=$setting_guardado[0];
?>


<p class="header">Price Settings</p>
	<? if($_GET['result']){?>
      <p style="text-align:center;font-weight:bold; color: white; background-color:green; padding:10px;"> <?=$_GET['result']?></p>
    <?}?>

	<form method="post" action="price-settings.php" >
	<table align="center"><tr><td>
	
	<table>
		<tr>
			<td>
				<fieldset style="background-color:#cdcdfe; padding:3px;"><legend><span style="text-transform:uppercase">Short Term Rate Settings</span></legend>
					<p style="font-size:12px; text-align:right;">Quantity of Nights Min.
						   <select name="minshort"  style="font-size:12px; text-align:right;">
								<? for($i=0; $i<=99; $i++){?>
									<option value="<?=$i?>" <? if($set['short_m_night']==$i){?> selected="selected"<?}?> ><?=$i?></option>
								<?}?>
						   </select>
					</p>

					 <p style="font-size:12px; text-align:right;">Percent Discounted 2bdr
						<select name="short2b"  style="font-size:12px; text-align:right;">
								<? for($i=0; $i<=99; $i++){?>
									<option value="<?=$i?>" <? if($set['short2bdr']==$i){?> selected="selected"<?}?> ><?=$i?></option>
								<?}?>
						   </select>
					</p>
					<p style="font-size:12px; text-align:right;">Percent Discounted 3bdr
						<select name="short3b"  style="font-size:12px; text-align:right;">
								<? for($i=0; $i<=99; $i++){?>
									<option value="<?=$i?>" <? if($set['short3bdr']==$i){?> selected="selected"<?}?> ><?=$i?></option>
								<?}?>
						</select>
					</p>
					<p style="font-size:12px; text-align:right;">Percent Discounted 4bdr
						<select name="short4b"  style="font-size:12px; text-align:right;">
								<? for($i=0; $i<=99; $i++){?>
									<option value="<?=$i?>" <? if($set['short4bdr']==$i){?> selected="selected"<?}?> ><?=$i?></option>
								<?}?>
						   </select>
					</p>
					<p style="font-size:12px; text-align:right;">Percent Discounted 5bdr
						<select name="short5b"  style="font-size:12px; text-align:right;">
								<? for($i=0; $i<=99; $i++){?>
									<option value="<?=$i?>" <? if($set['short5bdr']==$i){?> selected="selected"<?}?> ><?=$i?></option>
								<?}?>
						   </select>
					</p>
					<p style="font-size:12px; text-align:right;">Percent Discounted 6bdr
						<select name="short6b"  style="font-size:12px; text-align:right;">
								<? for($i=0; $i<=99; $i++){?>
									<option value="<?=$i?>" <? if($set['short6bdr']==$i){?> selected="selected"<?}?> ><?=$i?></option>
								<?}?>
						   </select>
					</p>
				</fieldset>
			
			</td>
			<td>
			
					<fieldset style="background-color:#cdffcd; padding:3px;"><legend><span style="text-transform:uppercase">Mid Term Rate Settings</span></legend>
						<p style="font-size:12px; text-align:right;">Quantity of Nights Min.
							<select name="minmid"  style="font-size:12px; text-align:right;">
									<? for($i=0; $i<=99; $i++){?>
										<option value="<?=$i?>" <? if($set['mid_m_night']==$i){?> selected="selected"<?}?> ><?=$i?></option>
									<?}?>
							</select>
						</p>

						<p style="font-size:12px; text-align:right;">Percent Discounted 2bdr
							<select name="mid2b"  style="font-size:12px; text-align:right;">
									<? for($i=0; $i<=99; $i++){?>
										<option value="<?=$i?>" <? if($set['mid2bdr']==$i){?> selected="selected"<?}?> ><?=$i?></option>
									<?}?>
							   </select>
						</p>
						<p style="font-size:12px; text-align:right;">Percent Discounted 3bdr
							<select name="mid3b"  style="font-size:12px; text-align:right;">
									<? for($i=0; $i<=99; $i++){?>
										<option value="<?=$i?>" <? if($set['mid3bdr']==$i){?> selected="selected"<?}?> ><?=$i?></option>
									<?}?>
							   </select>
						</p>
						<p style="font-size:12px; text-align:right;">Percent Discounted 4bdr
							<select name="mid4b"  style="font-size:12px; text-align:right;">
									<? for($i=0; $i<=99; $i++){?>
										<option value="<?=$i?>" <? if($set['mid4bdr']==$i){?> selected="selected"<?}?> ><?=$i?></option>
									<?}?>
							   </select>
						</p>
						<p style="font-size:12px; text-align:right;">Percent Discounted 5bdr
							<select name="mid5b"  style="font-size:12px; text-align:right;">
									<? for($i=0; $i<=99; $i++){?>
										<option value="<?=$i?>" <? if($set['mid5bdr']==$i){?> selected="selected"<?}?> ><?=$i?></option>
									<?}?>
							   </select>
						</p>
						<p style="font-size:12px; text-align:right;">Percent Discounted 6bdr
							<select name="mid6b"  style="font-size:12px; text-align:right;">
									<? for($i=0; $i<=99; $i++){?>
										<option value="<?=$i?>" <? if($set['mid6bdr']==$i){?> selected="selected"<?}?> ><?=$i?></option>
									<?}?>
							   </select>
						</p>
					 </fieldset>
			
			</td>
		</tr>
	</table>
	
    <fieldset style="background-color:#f9e3ba; padding:3px;"><legend><span style="text-transform:uppercase">Long Term</span></legend>
		<p style="font-size:12px; text-align:right;">Minimum Nights on Long Term
			<select name="minlong" style="font-size:12px; text-align:right;">
		       		<? for($i=0; $i<=999; $i++){?>
		       		    <option value="<?=$i?>" <? if($set['long_m_night']==$i){?> selected="selected"<?}?> ><?=$i?></option>
		       		<?}?>
		       </select>
		</p>
     </fieldset>

		<p style="font-size:12px; text-align:right;"><input class="book_but" type="submit" name="go" value="Submit"/></p>
     </td></tr></table>

	</form>
<hr />
<? if ($_POST){?>
	<?php
	$data= new getQueries ();
	$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
	$invoices=$data->show_any_data('invoice', 'ref', $_POST['ref'], '=');
	$total_records=$data->getAffectedRows();?>
<? }?>