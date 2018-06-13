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
/*$data= new getQueries ();
$services=$data->show_all('special_events', 'id');*/
?>

<p class="header" style="text-align:left">Special Events Management (New)</p>
<hr />
<? if(!$_GET['guardado']){?>
	<? if ($_GET['error']){?>
        <p class="error" style="background-color:yellow; color:red; font-size:10px; text-align:center; text-transform:uppercase;"><?=$_GET['error']?></p>
    <? }?>

    <form method="post" action="special_events_new.php">
      <table align="center"><tr><td>
      	<p align="right">Name: <input type="text" name="name" value="<?=$_POST['name']?>" /></p>
        <p align="right">Date Start: <input id="datepicker" type="text" name="start" value="<?=$_POST['start']?>" /></p>
        <p align="right">Date End: <input id="datepicker2" type="text" name="end" value="<?=$_POST['end']?>" /></p>
        <p align="right">Amount/Percent: <input type="text" name="qty" value="<?=$_POST['qty']?>" /></p>
        <p align="right">Event Type: <select name="type">
        <option value="1" <? if($_POST['type']==1){ echo 'selected="selected"'; }?>>Percentage per nights</option>
        <option value="2" <? if($_POST['type']==2){ echo 'selected="selected"'; }?>>Amount per nights</option>
        </select>
        </p>

        <p align="right">Increase <input type="radio" name="increase" value="1" <? if($_POST['increase']==1){ echo 'checked="checked"'; }?> />
        <br/> Decrease <input type="radio" name="increase" value="2" <? if($_POST['increase']==2){ echo 'checked="checked"'; }?> /> </p>


        <p align="right">Event Status: <select name="status">
        <option value="1" <? if($_POST['status']==1){ echo 'selected="selected"'; }?>>activated</option>
        <option value="0" <? if ($_POST){ if($_POST['status']==0){ echo 'selected="selected"'; } }?>>disabled</option>
        </select>
        </p>
         <p align="right"><input class="book_but" type="submit" name="Create" value="Create Event" /></p>
        </td></tr></table>
    </form>
    <hr />
 <? }else{ ?>
 	  <p class="error" style="background-color:blue; color:white; font-size:14px; text-align:center; text-transform:uppercase;"><?=$_GET['guardado']?></p>
 <? } ?>