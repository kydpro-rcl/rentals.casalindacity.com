<?
$data= new getQueries ();
$serv_t=$data->show_all('service_type', 'id');
?>
<? include('menu_CSS/menu-services.php');?>
<p class="header">New Additional Service</p>
<hr />
<form name="new_villa" method="post"  action="new-service.php">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<!--<fieldset><legend>FEATURES</legend>-->
<p id="fields">Name:<input class="input" type="text" name="name"  value="<?=$_POST['name']?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
<p id="fields">Type<select class="input" name="type" onchange="window.location='new-service.php?t='+this.value" >
<!--//<option value="Airport Pick Up" <? if($_GET['t']=='Airport Pick Up'){?> selected="selected"<?}?> >Airport Pick Up</option>
<option value="VIP Airport Pick Up" <? if($_GET['t']=='VIP Airport Pick Up'){?> selected="selected"<?}?>>VIP Airport Pick Up</option>
<option value="chef" <? if($_GET['t']=='chef'){?> selected="selected"<?}?>>Chef</option>
<option value="massage" <? if($_GET['t']=='massage'){?> selected="selected"<?}?>>Massage</option>
<option value="Filled Fridge" <? if($_GET['t']=='Filled Fridge'){?> selected="selected"<?}?>>Filled Fridge</option>
<option value="Car_Rental" <? if($_GET['t']=='Car_Rental'){?> selected="selected"<?}?>>Rental Cars</option>
<option value="Laundry" <? if($_GET['t']=='Laundry'){?> selected="selected"<?}?>>Villa Laundry</option>
<option value="Personal_Driver" <? if($_GET['t']=='Personal_Driver'){?> selected="selected"<?}?>>Personal Driver</option>//-->
<? foreach($serv_t AS $k){ ?>   <option value="<?=$k['tipo']?>" <? if($_GET['t']==$k['tipo']){?> selected="selected"<?}?>><?=$k['tipo']?></option>


<?}
?>
</select></p>
<p id="fields">Description: <input class="input" type="text" name="description"   size="40" value="<?=$_POST['description']?>" /><br /><span id="error_s"><?=$_GET['error']['desc']?></span></p>
</td>
<td>
<!--<fieldset><legend>PRICES</legend>-->

<p id="fields">Price<? if($_GET['t']=='Car_Rental'){?> LS<?}?>: <input class="input" type="text" name="price"  value="<?=$_POST['price']?>" /><br /><span id="error_s"><?=$_GET['error']['price']?></span></p>
<p id="fields">Active: <select class="input" name="active" >
<option value="1" selected="selected">Yes</option>
<option value="0">No</option>

</select></p>
  <? if($_GET['t']=='Car_Rental'){?>
	<p id="fields">Price LS Min: <input class="input" type="text" name="pricem"  value="<?=$_POST['pricem']?>" /><br/>
	  Price HS: <input class="input" type="text" name="priceHS"  value="<?=$_POST['priceHS']?>" /><br/>
	  Price HS Min: <input class="input" type="text" name="priceHSm"  value="<?=$_POST['priceHSm']?>" /><br/>
	</p>
  <?}?>
<p id="fields" style="text-align:center" >Comment:</p><p id="fields"><textarea class="input" name="comment" style="max-width:400px;" cols="50" rows="5"><?=$_POST['comment']?></textarea></p>


<!--</fieldset>--></td></tr><tr><td colspan="2">

<input type="submit" name="new"  value="Create" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td></tr></table>
</form>
<hr />