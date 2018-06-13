<?
$consulta=new getQueries();
$villasrcl=$consulta->all_villas();
$db=new DATA();//connect to database
$bal=$db->statement_id($_GET['id']);
?>
<h1>Cambiar archivos</h1>

<hr/>
<div style="background-color:#0FF; color:#000; text-align:center; font-weight:bold;" >
<? if ($_GET['msg']){
	echo $_GET['msg'];
	}
?>
</div>
<? if($bal){?>
	<div style="background-color:#FF0; color:#F00; text-align:center; font-weight:bold;" ><?=$_GET['error']?></div>
	<form action="change_statement.php" method="post" enctype="multipart/form-data">
	<table align="center" style="border: 1px solid green; background-color:#DDEDF9;"><tr><td>
	<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">

	Villa <select name="villa_id">
			<? foreach ($villasrcl as $k){?>
	        	<option value="<?=$k['id']?>" <? if ($bal['id_villa']==$k['id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
	        <? }?>
	      </select>

	Mes <select name="month">
			<? for($i=1; $i<=12; $i++){
				$i=str_pad($i, 2, "0", STR_PAD_LEFT);

			?>
			<option value="<?=$i?>" <? if ($i==$bal['month']){ echo 'selected="selected"'; } ?> ><?=dame_nombre_mes($i)?></option>
	        <? }?>
	      </select>
	Año <select name="year">
			<? for($i=2008; $i<=date('Y'); $i++){?>
			<option value="<?=$i?>" <? if ($i==$bal['year']){ echo 'selected="selected"'; } ?> ><?=$i?></option>
	        <? }?>
	     </select>
	</p>

	<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
	Estado: <input type="file" name="statement" />
	<input type="hidden" name="old_file" value="<?=$bal['archivo']?>"/>
	</p>

	<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
	Electricidad: <input type="file" name="electricity" />
	<input type="hidden" name="old_elect" value="<?=$bal['electricity']?>"/>
	</p>

	<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
	Sub-division Fee: <input type="file" name="subdivition" />
	<input type="hidden" name="old_sud" value="<?=$bal['subdivition']?>"/>
	</p>

	<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
	Servicios: <input type="file" name="services" />
	<input type="hidden" name="old_services" value="<?=$bal['services']?>"/>
	</p>
    <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
	
	<p><input type="submit" name="submit" value="Actualizar" /></p>
	
	</td></tr></table>
	</form>
<?}else{
echo "No archivos encontrados";

}?>