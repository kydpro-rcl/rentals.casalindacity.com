<? include('menu_CSS/menu-services.php');?>
<? if ($_GET['id']){ ?>

	<?
    $data= new getQueries ();
    $service=$data->show_id('carros', $_GET['id']);
    $se=$service[0];
    //$serv_t=$data->show_all('service_type', 'id');
    ?>

    <p class="header">Changing Car Rental</p>
    <hr />
    <form name="new_villa" method="post"  action="cars_edit.php">
    <table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">

    <p id="fields" style="text-align:right;">Name:<input class="input" type="text" name="name"   size="40" value="<?=$se['name']?>" /><br /><?=$_GET['error']['name']?></span></p>

	<p id="fields">
	Price LS Max.: <input class="input" type="text" name="LSma"  value="<?=$se['LS_max']?>" /><br />
	<span id="error_s"><?=$_GET['error']['price']?></span>
	Price LS Min.: <input class="input" type="text" name="LSmi"  value="<?=$se['LS_min']?>" /><br/>
	  Price HS Max.: <input class="input" type="text" name="HSma"  value="<?=$se['HS_max']?>" /><br/>
	  Price HS Min.: <input class="input" type="text" name="HSmi"  value="<?=$se['HS_min']?>" /><br/>
	</p>

    </td>
    <td>
  <p id="fields">Active: <select class="input" name="active" >
<option value="1" <? if($se['active']==1){?> selected="selected" <?}?>>Yes</option>
<option value="0" <? if($se['active']==0){?> selected="selected" <?}?>>No</option>

</select></p>


<p id="fields" style="text-align:left; padding-bottom:0px; margin-bottom:0px;" >Description:</p><p id="fields">
<textarea class="input" name="desc" style="max-width:400px;" cols="50" rows="5"><?=$se['description']?></textarea></p>

</td></tr><tr><td colspan="2">
    <input type="hidden" name="id" value="<?=$_GET['id']?>" />
    <input type="submit" name="new"  value="Update" class="book_but" />&nbsp;</td></tr></table>
    </form>
    <hr />
<? }else{?>
	<?php
	$data= new getQueries ();
	$services=$data->show_all('services', 'id');
	?>
	<!--<p>&nbsp;</p>--><p class="header">Click on a Service bellow to change it</p>
	<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%">
	<tr class="title">

		<td class='centro' id="td">DESC</td>
		<td class='centro' id="td">PRICE</td>
		<td class='centro' id="td">TAX</td>
		<td class='centro' id="td">BDR</td>
		<td class='centro' id="td">OPTIONAL</td>

	</tr>
	<?php
	$x=0;
	foreach ($services as $k){
	#echo $customers['4']['name'];
	echo "<tr onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='services_edit.php?id=".$k['id']."'\" class='fila$x'>".
	"<td class='centro' id='td'>".ucfirst($k['descrip'])." </td>".
	"<td class='derecha' id='td'>".$k['price']."</td>".
	"<td class='derecha' id='td'>".$k['tax']."</td>".
	"<td class='derecha' id='td'>".$k['beds']."</td>";
	if($k['optional']==2){
		echo "<td class='derecha' id='td'>required</td>";
	}else{
		echo "<td class='derecha' id='td'>optional</td>";
	}
	
	

	 if ($x==0){$x++;} elseif ($x==1){$x--;}
	}
	?>
	</table>
<? } ?>