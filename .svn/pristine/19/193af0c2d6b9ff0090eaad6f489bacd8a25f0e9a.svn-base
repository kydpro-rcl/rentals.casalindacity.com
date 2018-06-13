<?
$consulta=new getQueries();
$villasrcl=$consulta->all_villas();

?>
<h1>Delete villa statements</h1>
<h3>Please, select a villa to delete all it records</h3>
<table align="center" style="border: 1px solid green; background-color:#DDEDF9;" cellpadding="0" cellspacing="0"><tr><td>
	<p style="text-transform:uppercase; padding:0; margin:0; font-weight:bold; color: #09F;">delete statements</p>
	<form method="post" action="delete_record_to_villa.php">
	<p style="padding:3px; margin:3px;">
		 Villa <select name="villa_id">
         		<!--//<option value="all" <? if ($_POST['villa_id']=='all'){ echo 'selected="selected"'; } ?> >All</option>//-->
         		<option value="none">Select</option>
				<? foreach ($villasrcl as $k){?>
		        	<option value="<?=$k['id']?>" <? if ($k['id']==$_POST['villa_id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
		        <? }?>
		      </select>

		<!--//Month <select name="month">

				<? for($i=0; $i<=12; $i++){
					$i=str_pad($i, 2, "0", STR_PAD_LEFT);
				?>
				<option value="<?=$i?>" <? if ($i==$_POST['month']){ echo 'selected="selected"'; } if (!$_POST['month']) {if (($i+1)==date('m')){ echo 'selected="selected"'; }}?> >
				<? if ($i==0){ echo "All"; }else{ echo dame_nombre_mes($i); } ?>
                </option>
		        <? }?>
		      </select>
		Year <select name="year">
        		<option value="all" <? if ($_POST['year']=='all'){ echo 'selected="selected"'; } ?> >All</option>
				<? for($i=2008; $i<=date('Y'); $i++){?>
				<option value="<?=$i?>" <? if ($i==$_POST['year']){ echo 'selected="selected"'; } if (!$_POST['year']) { if ($i==date('Y')){ echo 'selected="selected"'; }}?> ><?=$i?></option>
		        <? }?>
		     </select>//-->
		<input type="submit" name="go" value="Delete"/>
	</p>
	</form>
</td></tr></table>

<hr/>


<?php

 if ($_POST['go']=="Delete"){ 	if($_POST['villa_id']!="none"){
	 $db=new DATA();//connect to database
	 $db->borrar_todos($table='statements', $campo='id_villa', $valor=$_POST['villa_id']);
	 echo "<h2 style=\"color:red;\">All the statements records has been delected for the villa selected.</h2>";
	}else{		echo "<h2 style=\"color:red;\">Please, choose one villa above to delete it records</h2>";	}
 }
?>


