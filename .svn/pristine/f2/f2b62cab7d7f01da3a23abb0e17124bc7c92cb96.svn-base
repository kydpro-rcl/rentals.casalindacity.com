<? include('menu_CSS/menu-admin.php');?>

<link type="text/css" href="../for_rent/datapicker-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="../for_rent/datapicker-ui/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../for_rent/datapicker-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			numberOfMonths: 1,
			showButtonPanel: true
		});
		$( "#datepicker2" ).datepicker({
			numberOfMonths: 1,
			showButtonPanel: true
		});
	});
	</script>

<?php
$data= new getQueries ();
/*$services=$data->show_all('special_events', 'id');*/
$event=$data->show_id('special_events', $_GET['id']);
$ev=$event[0];
?>
<p class="header" style="text-align:left">Special Events Management (Edit)</p>
<hr />
<? if(!$_GET['guardado']){?>
	<? if ($_GET['error']){?>
        <p class="error" style="background-color:yellow; color:red; font-size:10px; text-align:center; text-transform:uppercase;"><?=$_GET['error']?></p>
    <? }?>

    <form method="post" action="special_events_edit.php">
      <table align="center"><tr><td>
      	<p align="right">Name: <input type="text" name="name" value="<?=$ev['name']?>" /></p>
        <p align="right">Date Start: <input type="text" id="datepicker" name="start" value="<?=$ev['from_date']?>" /></p>
        <p align="right">Date End: <input type="text" id="datepicker2" name="end" value="<?=$ev['to_date']?>" /></p>
        <p align="right">Amount/Percent: <input type="text" name="qty" value="<?=$ev['qty']?>" /></p>
        <p align="right">Event Type: <select name="type">
        <option value="1" <? if($ev['type']==1){ echo 'selected="selected"'; }?>>Percentage per nights</option>
        <option value="2" <? if($ev['type']==2){ echo 'selected="selected"'; }?>>Amount per nights</option>
        </select>
        </p>

        <p align="right">Increase <input type="radio" name="increase" value="1" <? if($ev['increase']==1){ echo 'checked="checked"'; }?> />
        <br/> Decrease <input type="radio" name="increase" value="2" <? if($ev['increase']==2){ echo 'checked="checked"'; }?> /> </p>

        <p align="right">Event Status: <select name="status">
        <option value="1" <? if($ev['active']==1){ echo 'selected="selected"'; }?>>activated</option>
        <option value="0" <? if($ev['active']==0){ echo 'selected="selected"'; } ?>>disabled</option>
        </select>
        </p>
        <input type="hidden" name="id" value="<?=$ev['id']?>" />
        <p align="right"><input class="book_but" type="submit" name="Create" value="Change Event" /></p>

        </td></tr></table>
    </form>
    <hr />
 <? }else{ ?>
 	  <p class="error" style="background-color:blue; color:white; font-size:14px; text-align:center; text-transform:uppercase;"><?=$_GET['guardado']?></p>
 <? } ?>