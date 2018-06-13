<?
$consulta=new getQueries();
$villasrcl=$consulta->all_villas();

?>
<h1>Subir nuevos archivos</h1>

<hr/>
<div style="background-color:#0FF; color:#000; text-align:center; font-weight:bold;" >
<? if ($_GET['msg']){
		/*foreach ($villasrcl as $k){
			if ($k['id']==$_POST['villa_id']){ $_SESSION['villano']=$k['no'];}
		}*/
	echo $_GET['msg'];
	}
?>
</div>
<div style="background-color:#FF0; color:#F00; text-align:center; font-weight:bold;" ><?=$_GET['error']?></div>
<form action="new_statement.php" method="post" enctype="multipart/form-data">
<table align="center" style="border: 1px solid green; background-color:#DDEDF9;"><tr><td>
<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">

Villa <select name="villa_id">
		<? foreach ($villasrcl as $k){?>
        	<option value="<?=$k['id']?>" <? if ($k['id']==$_POST['villa_id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
        <? }?>
      </select>

Mes <select name="month">
		<? for($i=1; $i<=12; $i++){
			$i=str_pad($i, 2, "0", STR_PAD_LEFT);

		?>
		<option value="<?=$i?>" <? if ($i==$_POST['month']){ echo 'selected="selected"'; } if (!$_POST['month']) {if (($i+1)==date('m')){ echo 'selected="selected"'; }}?> ><?=dame_nombre_mes($i)?></option>
        <? }?>
      </select>
Año <select name="year">
		<? for($i=2008; $i<=date('Y'); $i++){?>
		<option value="<?=$i?>" <? if ($i==$_POST['year']){ echo 'selected="selected"'; } if (!$_POST['year']) { if ($i==date('Y')){ echo 'selected="selected"'; }}?> ><?=$i?></option>
        <? }?>
     </select>
</p>

<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
Estado: <input type="file" name="statement" />
</p>

<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
Electricidad: <input type="file" name="electricity" />
</p>

<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
Sub-division Fee: <input type="file" name="subdivition" />
</p>

<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
Servicios: <input type="file" name="services" />
</p>


<p><input type="submit" name="submit" value="Subir archivos" /></p>
</td></tr></table>
</form>