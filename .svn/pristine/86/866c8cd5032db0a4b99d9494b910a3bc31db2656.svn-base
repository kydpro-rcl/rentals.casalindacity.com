<?
$data= new getQueries ();
$serv_t=$data->show_all('service_type', 'id');
?>
<? include('menu_CSS/menu-services.php');?>
<p class="header">New Car Rental</p>
<hr />
	<table align="center"><tr><td>
	
    <form name="new_villa" method="post"  action="new_services.php">
	
	
	
	
	
		   <p id="fields" >Description:
			<input type="text" class="input" name="desc" size="50" value="<?=$se['descrip']?>" /></p>

			<p  id="fields">Price:<input class="input" type="text" name="price"   value="<?=$se['price']?>" /><br /><?=$_GET['error']['name']?></span></p>

			<p id="fields">
			Tax: <input class="input" type="text" name="tax"  value="<?=$se['tax']?>" />
			</p>
			<p id="fields">Bedrooms: <select class="input" name="beds" >
			<option value="0" <? if($se['beds']==0){?> selected="selected" <?}?>>All</option>
			<option value="2" <? if($se['beds']==2){?> selected="selected" <?}?>>2</option>
			<option value="3" <? if($se['beds']==3){?> selected="selected" <?}?>>3</option>
			<option value="4" <? if($se['beds']==4){?> selected="selected" <?}?>>4</option>
			<option value="5" <? if($se['beds']==5){?> selected="selected" <?}?>>5</option>
			<option value="6" <? if($se['beds']==6){?> selected="selected" <?}?>>6</option>
			</select></p>

			  <p id="fields" >Optional: <select class="input" name="optional" >
			<option value="1" <? if($se['optional']==1){?> selected="selected" <?}?>>Optional</option>
			<option value="2" <? if($se['optional']==2){?> selected="selected" <?}?>>Required</option>

			</select></p>

			<hr />

		<p>&nbsp;</p>
		<p id="fields">
			<input type="hidden" name="id" value="<?=$_GET['id']?>" />
			<input type="submit" name="new"  value="Update" class="book_but" />&nbsp;
		</p>
    </form>
	</td>
	</tr>
	</table>
<hr />