<?
$consulta=new getQueries();
//$villasrcl=$consulta->all_villas();
$db=new DATA();//connect to database
$bal=$db->statement_id($_GET['id']);
?>
<h1>Cambiar archivo</h1>

<hr/>
<div style="background-color:#0FF; color:#000; text-align:center; font-weight:bold;" >
<? if ($_GET['msg']){
	echo $_GET['msg'];
	}
?>
</div>
<? 
if (!$_GET['msg']){

	if($bal){?>
		<div style="background-color:#FF0; color:#F00; text-align:center; font-weight:bold;" ><?=$_GET['error']?></div>
		<form action="change_file.php" method="post" enctype="multipart/form-data">
		<table align="center" style="border: 1px solid green; background-color:#DDEDF9;"><tr><td>
		
		<input type="hidden" name="villa_id" value="<?=$bal['id_villa']?>"/>
		<input type="hidden" name="month" value="<?=$bal['month']?>"/>
		<input type="hidden" name="year" value="<?=$bal['year']?>"/>
		
		<? if($_GET['f']==1){?>
		<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
		Estado: <input type="file" name="statement" />
		
		</p>
		<? }?>
	 <input type="hidden" name="old_file" value="<?=$bal['archivo']?>"/>
		<? if($_GET['f']==2){?>
		<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
		Electricidad: <input type="file" name="electricity" />
		
		</p>
		<? }?>
	<input type="hidden" name="old_elect" value="<?=$bal['electricity']?>"/>
		<? if($_GET['f']==3){?>
		<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
		Sub-division Fee: <input type="file" name="subdivition" />
		
		</p>
		<? }?>
	<input type="hidden" name="old_sud" value="<?=$bal['subdivition']?>"/>
		<? if($_GET['f']==4){?>
		<p style="font-family:Arial, Helvetica, sans-serif; color: #666; padding:10px;">
		Servicios: <input type="file" name="services" />
		
		</p>
		<? }?>
		<input type="hidden" name="old_services" value="<?=$bal['services']?>"/>
		<input type="hidden" name="id" value="<?=$_GET['id']?>"/>
		
		<p><input type="submit" name="submit" value="Actualizar" /></p>
		
		</td></tr></table>
		</form>
	<?}else{
	echo "No archivos encontrados";

	}
}
?>

