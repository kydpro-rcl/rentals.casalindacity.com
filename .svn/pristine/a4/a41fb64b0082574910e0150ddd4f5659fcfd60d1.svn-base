<?
$data= new getQueries ();
$serv_t=$data->show_all('service_type', 'id');
?>
<? include('menu_CSS/menu-services.php');?>
<p class="header">New Car Rental</p>
<hr />
<form name="new_villa" method="post"  action="cars_new.php">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">

<p id="fields" style="text-align:right;">Name:<input class="input" type="text" name="name"   size="40" value="<?=$_POST['name']?>" /><br /><?=$_GET['error']['name']?></span></p>

	<p id="fields">
	Price LS Max.: <input class="input" type="text" name="LSma"  value="<?=$_POST['LSma']?>" /><br />
	<span id="error_s"><?=$_GET['error']['price']?></span>
	Price LS Min.: <input class="input" type="text" name="LSmi"  value="<?=$_POST['LSmi']?>" /><br/>
	  Price HS Max.: <input class="input" type="text" name="HSma"  value="<?=$_POST['HSma']?>" /><br/>
	  Price HS Min.: <input class="input" type="text" name="HSmi"  value="<?=$_POST['HSmi']?>" /><br/>
	</p>

	</td>
<td>

<p id="fields">Active: <select class="input" name="active" >
<option value="1" selected="selected">Yes</option>
<option value="0">No</option>

</select></p>


<p id="fields" style="text-align:left; padding-bottom:0px; margin-bottom:0px;" >Description:</p><p id="fields">
<textarea class="input" name="desc" style="max-width:400px;" cols="50" rows="5"><?=$_POST['description']?></textarea></p>
</td></tr><tr><td colspan="2">
<input type="submit" name="new"  value="Create" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td></tr></table>
</form>
<hr />