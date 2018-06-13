<? include('menu_CSS/menu-services.php');?>
<? if ($_GET['id']){ ?>

	<?
    $data= new getQueries ();
    $service=$data->show_id('serv_add', $_GET['id']);
    $se=$service[0];
    $serv_t=$data->show_all('service_type', 'id');
    ?>

    <p class="header">Changing Service</p>
    <hr />
    <form name="new_villa" method="post"  action="edit-services.php">
    <table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
    <!--<fieldset><legend>FEATURES</legend>-->
    <p id="fields">Name:<input class="input" type="text" name="name"  value="<? if ($_POST['name']){ echo $_POST['name']; }else{ echo $se['name'];}?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>

    <p id="fields">Type<select class="input" name="type" onchange="window.location='edit-services.php?id=<?=$_GET['id']?>&t='+this.value">
	    <!--//<option value="Airport Pick Up" <? if($_GET['t']=='Airport Pick Up'){?> selected="selected"<?}/*elseif ($se['type']=="Airport Pick Up"){  echo "selected=\"selected\"";}*/?>>Airport Pick Up</option>
	    <option value="VIP Airport Pick Up" <? if($_GET['t']=='VIP Airport Pick Up'){?> selected="selected"<?}/*elseif ($se['type']=="VIP Airport Pick Up"){  echo "selected=\"selected\"";}*/?>>VIP Airport Pick Up</option>
	    <option value="Chef" <? if($_GET['t']=='chef'){?> selected="selected"<?}/*elseif ($se['type']=="Chef"){ echo "selected=\"selected\"";}*/?>>Chef</option>
	    <option value="Massage" <? if($_GET['t']=='Massage'){?> selected="selected"<?}/*elseif ($se['type']=="Massage"){ echo "selected=\"selected\"";}*/?>>Massage</option>
	    <option value="Filled Fridge" <? if($_GET['t']=='Filled Fridge'){?> selected="selected"<?}/*elseif ($se['type']=="Filled Fridge"){  echo "selected=\"selected\"";}*/?>>Filled Fridge</option>
	    <option value="Car_Rental" <? if($_GET['t']=='Car_Rental'){?> selected="selected"<?}/*elseif ($se['type']=="Car_Rental"){  echo "selected=\"selected\"";}*/?>>Rental Cars</option>
	    <option value="Laundry" <? if($_GET['t']=='Laundry'){?> selected="selected"<?}/*elseif ($se['type']=="Laundry"){  echo "selected=\"selected\"";}*/?>>Villa Laundry</option>
        <option value="Personal_Driver" <? if($_GET['t']=='Personal_Driver'){?> selected="selected"<?}/*elseif ($se['type']=="Personal_Driver"){  echo "selected=\"selected\"";}*/?>>Personal Driver</option>//-->
        <? foreach($serv_t AS $k){ ?>
   <option value="<?=$k['tipo']?>" <? if($_GET['t']==$k['tipo']){?> selected="selected"<?}?>><?=$k['tipo']?></option>
	<?
	}
	?>
    </select></p>

    <p id="fields">Description: <input class="input" type="text" name="description"   size="40" value="<? if ($_POST['description']){ echo $_POST['description']; }else{ echo $se['description'];}?>" /><br /><span id="error_s"><?=$_GET['error']['desc']?></span></p>
    </td>
    <td>
    <!--<fieldset><legend>PRICES</legend>-->

    <p id="fields">Price <? if($_GET['t']=='Car_Rental'){?> LS<?}?>: <input class="input" type="text" name="price"  value="<? if ($_POST['price']){ echo $_POST['price']; }else{ echo number_format($se['price'],0);}?>" /><br /><span id="error_s"><?=$_GET['error']['price']?></span></p>

    <p id="fields">Active: <select class="input" name="active" >
    <option value="1" <? if ($se['active']==1) echo 'selected=selected';?>>Yes</option>
    <option value="0" <? if ($se['active']==0) echo 'selected=selected';?>>No</option>

    </select></p>
      <? if($_GET['t']=='Car_Rental'){?>
	    	<p id="fields">Price LS Min: <input class="input" type="text" name="pricem"  value="<?=number_format($se['price_min'],2);?>" /><br/>
		  Price HS: <input class="input" type="text" name="priceHS"  value="<?=number_format($se['hs_price'],2);?>" /><br/>
		  Price HS Min: <input class="input" type="text" name="priceHSm"  value="<?=number_format($se['hs_price2'],2);?>" /></p>
  	  <?}?>
    <p id="fields" style="text-align:center" >Comment:</p><p id="fields"><textarea class="input" name="comment" style="max-width:400px;" cols="50" rows="5"><? if ($_POST['comment']){ echo $_POST['comment']; }else{ echo $se['comment'];}?></textarea></p>


    <!--</fieldset>--></td></tr><tr><td colspan="2">
    <input type="hidden" name="id" value="<?=$_GET['id']?>" />
    <input type="submit" name="new"  value="Update" class="book_but" />&nbsp;</td></tr></table>
    </form>
    <hr />
<? }else{?>
	<?php
	$data= new getQueries ();
	$services=$data->show_all('serv_add', 'id');
	?>
	<!--<p>&nbsp;</p>--><p class="header">Click on an Additional Services below</p>
	<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%"><tr class="title"><td class='centro' id="td">NAME</td><td class='centro' id="td">TYPE</td><td class='centro' id="td">PRICE</td><td class='centro' id="td">DESCRIPTION</td><td class='centro' id="td">STATUS</td></tr>
	<?php
	$x=0;
	foreach ($services as $k){
	#echo $customers['4']['name'];
	echo "<tr onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='edit-services.php?id=".$k['id']."'\" class='fila$x'><td class='derecha' id='td'>".$k['name']."</td>".
	"<td class='centro' id='td'>".ucfirst($k['type'])." </td>".
	"<td class='derecha' id='td'>".$k['price']."</td>".
	"<td class='descrip' >".$k['description']."</td>";
	if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }

	 if ($x==0){$x++;} elseif ($x==1){$x--;}
	}
	?>
	</table>
<? } ?>