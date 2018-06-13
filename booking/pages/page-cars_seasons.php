<? include('menu_CSS/menu-admin.php');?>

<?
$db= new getQueries ();

  if($_POST){  	//buscar a ver si encuentro guardada alguna configuracion de precios  	$setting_guardado=$db->show_any_data_limit1($table='vehicle_HS', $field='id', $value='1', $operator='=');
  	$set=$setting_guardado[0];

  	$data= new DB;
  	$id_adm=$_SESSION['info']['id']; $date=date("Y-m-d G:i:s");
     $f1=fecha_in($y=$_POST['year1'], $m=$_POST['month1'], $d=$_POST['day1']);
     $t1=fecha_in($y=$_POST['year2'], $m=$_POST['month2'], $d=$_POST['day2']);
    if($set){       //si hay configuracion actualizo
     $guardar_setting=$data->upd_HScars($id=$set['id'], $f1, $t1, $id_adm, $date);    }else{    	//si no hay configuracion inserto
      $guardar_setting=$data->ins_HScars($f1, $t1, $id_adm, $date);    }


   if($guardar_setting){
    $_GET['result']="Vehicles season successfully saved";
   }  }

  $setting_guardado=$db->show_any_data_limit1($table='vehicle_HS', $field='id', $value='1', $operator='=');
  $set=$setting_guardado[0];
?>


<p class="header">High Season for Vehicles</p>
	<? if($_GET['result']){?>
      <p style="text-align:center;font-weight:bold; color: white; background-color:green; padding:10px;"> <?=$_GET['result']?></p>
    <?}?>

	<form method="post" action="cars_seasons.php" >
	<table align="center"><tr><td>
	<fieldset style="background-color:#cdcdfe; padding:3px;"><legend>Seaons</legend>
		<p style="font-size:12px; text-align:right;">From
		       <?=fecha_insert($name_add='1', $fecha=$set['hs_from']);?>
		</p>

		 <p style="font-size:12px; text-align:right;">To
			 <?=fecha_insert($name_add='2', $fecha=$set['hs_to']);?>
		</p>
      </fieldset>

		<p style="font-size:12px; text-align:right;"><input class="book_but" type="submit" name="go" value="Submit"/></p>
     </td></tr></table>

	</form>
<hr />
<? if ($_POST){?>



	<?php
	/*$data= new getQueries ();
	$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
	$invoices=$data->show_any_data('invoice', 'ref', $_POST['ref'], '=');
	$total_records=$data->getAffectedRows();*/?>


<? }?>