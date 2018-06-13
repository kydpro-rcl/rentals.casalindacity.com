<?
$consulta=new getQueries();
$villasrcl=$consulta->all_villas();

?>
<h1>Archivos subidos</h1>
<table align="center" style="border: 1px solid green; background-color:#DDEDF9;" cellpadding="0" cellspacing="0"><tr><td>
	<p style="text-transform:uppercase; padding:0; margin:0; font-weight:bold; color: #09F;">Filtro (Busqueda)</p>
	<form method="post" action="view_statement.php">
	<p style="padding:3px; margin:3px;">
		 Villa <select name="villa_id">
         		<option value="all" <? if ($_POST['villa_id']=='all'){ echo 'selected="selected"'; } ?> >Todos</option>
				<? foreach ($villasrcl as $k){?>
		        	<option value="<?=$k['id']?>" <? if ($k['id']==$_POST['villa_id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
		        <? }?>
		      </select>

		Mes <select name="month">

				<? for($i=0; $i<=12; $i++){
					$i=str_pad($i, 2, "0", STR_PAD_LEFT);
				?>
				<option value="<?=$i?>" <? if ($i==$_POST['month']){ echo 'selected="selected"'; } if (!$_POST['month']) {if (($i+1)==date('m')){ echo 'selected="selected"'; }}?> >
				<? if ($i==0){ echo "Todos"; }else{ echo dame_nombre_mes($i); } ?>
                </option>
		        <? }?>
		      </select>
		Año <select name="year">
        		<option value="all" <? if ($_POST['year']=='all'){ echo 'selected="selected"'; } ?> >Todos</option>
				<? for($i=2008; $i<=date('Y'); $i++){?>
				<option value="<?=$i?>" <? if ($i==$_POST['year']){ echo 'selected="selected"'; } if (!$_POST['year']) { if ($i==date('Y')){ echo 'selected="selected"'; }}?> ><?=$i?></option>
		        <? }?>
		     </select>
		<input type="submit" name="go" value="Ver"/>
	</p>
	</form>
</td></tr></table>

<hr/>


<?php
 $db=new DATA();//connect to database
 if (!$_POST['go']=="Go"){
 	$mes_anterior=str_pad((date('m')-1), 2, "0", STR_PAD_LEFT);
 	$statement_uploaded=$db->uploaded_mes_ano($mes_anterior, date('Y'));
 }else{
     $statement_uploaded=$db->search_uploaded($_POST['villa_id'], $_POST['month'], $_POST['year']);
 }
?>

 <? if(!$_POST['seleccionados']){?>
    <form method="post" action="view_statement.php">
	<?
	 if ($statement_uploaded){?>

	 	<script type="text/javascript">
				$(document).ready(function(name) {
                <? foreach($statement_uploaded AS $k){ ?>
				$("#statement<?=$k['id']?>").fancybox({
						'width'				: '75%',
						'height'			: '95%',
						'autoScale'			: true,
						'transitionIn'		: 'elastic',
						'transitionOut'		: 'elastic',
						'type'				: 'iframe'
					});
				<?}?>
				});
			</script>

	 <table align="center" cellpadding="1" cellspacing="1" style="border: 1px solid green; " >
	 <tr style="text-align:center; font-weight:bold; background-color:#2A6EBB;color:#FFFFFF;">
	 	<td style="padding:5px;">FECHA</td>
		<td style="padding:5px;">VILLA</td>
		<td style="padding:5px;">MES</td>
		<td style="padding:5px;">AÑO</td>
		<td style="padding:5px;">ESTADO</td>
		<td style="padding:5px;">ELECTRICIDAD</td>
		<td style="padding:5px;">SUBDIVISION</td>
		<td style="padding:5px;">SERVICIOS</td>
		<td style="padding:5px;">&nbsp;</td>
		<td style="padding:5px;">SUBIDO POR</td>
	 </tr>
	 <? $rowclass = 0;
		foreach($statement_uploaded AS $k){
			$consulta=new getQueries();
		  	$selected_villa=$consulta->villa($k['id_villa']); //details for filla selected
			?>
		  <tr style="text-align:center;" class="row<?= $rowclass ?>">
		  	<td><?=$k['fecha']?></td>
		  	<td><?=$selected_villa[0]['no']?></td>
		  	<td><?=dame_nombre_mes($k['month']);?></td>
		  	<td><?=$k['year']?></td>
			<?php
			$estado_file="../owners_portal/statements/villa".$selected_villa[0]['no']."/".$k['archivo'];
			$electricity_file="../owners_portal/statements/villa".$selected_villa[0]['no']."/".$k['electricity'];
			$subdivition_file="../owners_portal/statements/villa".$selected_villa[0]['no']."/".$k['subdivition'];
			$services_file="../owners_portal/statements/villa".$selected_villa[0]['no']."/".$k['services'];
			?>
		  	<td>
					<?php if (is_file($estado_file)) {?>
						<a href="../owners_portal/statements/villa<?=$selected_villa[0]['no']?>/<?=$k['archivo']?>" target="_blank" id="statement<?=$k['id']?>"><img style="float:left;margin:0;" src="images/details.png" width="20px" alt="Ver" title="Ver"/></a>
					<?php }?>
				<? if ($_SESSION['info']['contabilidad']==1){?>	
						<a href="change_file.php?id=<?=$k['id']?>&f=1" ><img style="float:left;margin:0;" src="images/edit.png" width="20px" alt="Cambiar" title="Cambiar"/></a>
					<?php if (is_file($estado_file)) {?>
						<a href="delete_files.php?id=<?=$k['id']?>&f=1" onclick="return confirmSubmitText('¿Estas seguro que quieres borrar el Estado?');"><img style="float:left;margin:0;" src="images/delete.png" width="23px" alt="Borrar" title="Borrar"/></a>
					<?php }?>
				<?php }?>
			</td>
			<td>
				<?php if (is_file($electricity_file)) {?>
				<a href="../owners_portal/statements/villa<?=$selected_villa[0]['no']?>/<?=$k['electricity']?>" target="_blank" id="statement<?=$k['id']?>"><img style="float:left;margin:0;margin-left:20px;" src="images/details.png" width="20px" alt="Ver" title="Ver"/></a>
				<?php }?>
				<? if ($_SESSION['info']['contabilidad']==1){?>	
					<a href="change_file.php?id=<?=$k['id']?>&f=2" ><img style="float:left;margin:0;" src="images/edit.png" width="20px" alt="Cambiar" title="Cambiar"/></a>
					<?php if (is_file($electricity_file)) {?>
					<a href="delete_files.php?id=<?=$k['id']?>&f=2" onclick="return confirmSubmitText('¿Estas seguro que quieres borrar la electricidad?');"><img style="float:left;margin:0;" src="images/delete.png" width="23px" alt="Borrar" title="Borrar"/></a>
					<?php }?>
				<?php }?>
			</td>
			<td>
				<?php if (is_file($subdivition_file)) {?>
				<a href="../owners_portal/statements/villa<?=$selected_villa[0]['no']?>/<?=$k['subdivition']?>" target="_blank" id="statement<?=$k['id']?>"><img style="float:left;margin:0;margin-left:20px;" src="images/details.png" width="20px" alt="Ver" title="Ver"/></a>
				<?php }?>
				<? if ($_SESSION['info']['contabilidad']==1){?>	
					<a href="change_file.php?id=<?=$k['id']?>&f=3" ><img style="float:left;margin:0;" src="images/edit.png" width="20px" alt="Cambiar" title="Cambiar"/></a>
					<?php if (is_file($subdivition_file)) {?>
						<a href="delete_files.php?id=<?=$k['id']?>&f=3" onclick="return confirmSubmitText('¿Estas seguro que quieres borrar el Subdivision?');"><img style="float:left;margin:0;" src="images/delete.png" width="23px" alt="Borrar" title="Borrar"/></a>
					<?php }?>
				<?php }?>	
			</td>
           <td>
			   <?php if (is_file($services_file)) {?>
			   <a href="../owners_portal/statements/villa<?=$selected_villa[0]['no']?>/<?=$k['services']?>" target="_blank" id="statement<?=$k['id']?>"><img style="float:left;margin:0;margin-left:7px;" src="images/details.png" width="20px" alt="Ver" title="Ver"/></a>
			   <?php }?>
			   <? if ($_SESSION['info']['contabilidad']==1){?>	
				   <a href="change_file.php?id=<?=$k['id']?>&f=4" ><img style="float:left;margin:0;" src="images/edit.png" width="20px" alt="Cambiar" title="Cambiar"/></a>
					<?php if (is_file($services_file)) {?>
					
					<a href="delete_files.php?id=<?=$k['id']?>&f=4" onclick="return confirmSubmitText('¿Estas seguro que quieres borrar los Servicios?');"><img style="float:left;margin:0;" src="images/delete.png" width="23px" alt="Borrar" title="Borrar"/></a>
				   <?php }?>
			   <?php }?>
		   </td>
		  	<td>
			  <? if ($_SESSION['info']['contabilidad']==1){?>
				<a href="change_statement.php?id=<?=$k['id']?>"><img style="float:left;margin:0;" src="images/edit.png" width="25px" alt="Cambiar Todo" title="Cambiar Todo"/></a>
				<a href="delete_files.php?id=<?=$k['id']?>" onclick="return confirmSubmitText('¿Estas seguro que quieres borrar los 4 archivos?');"><img style="float:left;margin:0;" src="images/delete.png" width="30px" alt="Borrar Todo" title="Borrar Todo"/></a>
			 <?php }?>
			</td>
		  	<td><?
		  	  $link= new DB(); $made=$link->getUserDetails($k['id_admin']);
		  	echo '<span style="font-size:10px;">';
		  	echo $made[0]['name'];  ?></span></td>
		  	
		  </tr>
		<?  $rowclass = 1 - $rowclass;
		}?>
	 </table>
	 <script type="text/javascript">
	  function f_boxcheck()
		{
			if(document.getElementById("delete").checked){
				document.getElementById("borrador").disabled=false;
			}else {document.getElementById("borrador").disabled=true;}
		}
		document.getElementById("delete").onclick=f_boxcheck;

	  function confirmSubmitText(mensaje)
		{
			var agree=confirm(mensaje);
			if (agree)
				return true ; //aceptar
			else
				return false ; //cancelar
		}
	 </script>

	 </form>
		<?
	 }else{
	  	echo "<p style=\"color:red;\">No encontramos archivos en su busqueda<br/>Por favor, trate cambiando los paremetros de su busqueda</p>";
	 }
 }else{

 $cantid=0;

   // $table_borrar="idiomas";
	 foreach($_POST['seleccionados'] as $k=>$v){
	    $cantid++;
        $db->borrar($v, 'statements');
     }
   echo "<h2 style=\"color:red;\">$cantid Statements files deleted</h2>";
   ?>
  <!--//<p><a href="ver_idiomas.php" >Click aqui para volver</a></p>//-->
 <?}?>


