<?
$consulta=new getQueries();
$villasrcl=$consulta->all_villas();
 if($_GET['villa']){ $_POST['villa_id']=$_GET['villa']; }
?>
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

<h1>Delete statements</h1>
<h3>Please, select a villa to delete some statements</h3>
<table align="center" style="border: 1px solid green; background-color:#DDEDF9;" cellpadding="0" cellspacing="0"><tr><td>
	<p style="text-transform:uppercase; padding:0; margin:0; font-weight:bold; color: #09F;">delete statements</p>
	<form method="post" action="delete_some_statements.php">
	<p style="padding:3px; margin:3px;">
		 Villa <select name="villa_id">
         		<!--//<option value="all" <? if ($_POST['villa_id']=='all'){ echo 'selected="selected"'; } ?> >All</option>//-->
         		<option value="none">Select</option>
				<? foreach ($villasrcl as $k){?>
		        	<option value="<?=$k['id']?>" <? if ($k['id']==$_POST['villa_id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
		        <? }?>
		      </select>

		<input type="submit" name="go" value="See files"/>
	</p>
	</form>
</td></tr></table>

<hr/>
<?php
 $db=new DATA();//connect to database
 if ($_POST['go']){

     $statement_uploaded=$db->search_uploaded($_POST['villa_id'], $month='0', $year='all');
 }
?>

 <? if(!$_POST['id_file']){?>
    <form method="post" action="delete_some_statements.php" onsubmit="confirmSubmitText('Seguro que quieres borrar los seleccionados?')">
    <!--<input type="hidden" name="villa_id" value="<?=$_POST['villa_id']?>"/> -->
	<?
	$_GET['villa']=$_POST['villa_id'];

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
	 	<td>&nbsp;</td><td style="padding:5px;">DATE</td><td style="padding:5px;">VILLA</td><td style="padding:5px;">MONTH</td><td style="padding:5px;">YEAR</td><td style="padding:5px;">FILE</td><td style="padding:5px;">BALANCE</td><td style="padding:5px;">EDIT</td><td style="padding:5px;">UPLOADED BY</td><!--//<td style="padding:5px;">DELETE</td>//-->
	 </tr>
	 <? $rowclass = 0;
		foreach($statement_uploaded AS $k){
			$consulta=new getQueries();
		  	$selected_villa=$consulta->villa($k['id_villa']); //details for filla selected
			?>
		  <tr style="text-align:right;" class="row<?= $rowclass ?>">
		  <td><input type="checkbox" name="id_file[]" value="<?=$k['id']?>"/></d>
		  	<td><?=$k['fecha']?></d>
		  	<td><?=$selected_villa[0]['no']?></d>
		  	<td><?=dame_nombre_mes($k['month']);?></d>
		  	<td><?=$k['year']?></d>

		  	<td><a href="../owners_portal/statements/villa<?=$selected_villa[0]['no']?>/<?=$k['archivo']?>" target="_blank" id="statement<?=$k['id']?>">Click here to view statement</a></d>
             <td><span <? if ($k['balance']<0) echo 'style="color:red"'; ?> ><? if ($k['moneda']==1){ echo "US$"; }elseif($k['moneda']==2){ echo "RD$"; }?> <?=number_format($k['balance'],2)?></span></d>
		  	<td><a href="change_statement.php?id=<?=$k['id']?>">Edit</a></d>
		  	<td><?
		  	  $link= new DB(); $made=$link->getUserDetails($k['id_admin']);
		  	echo '<span style="font-size:10px;">';
		  	echo $made[0]['name'];  ?></span></d>
		  	<!--//<td><input type="checkbox" name="seleccionados[]" value="<?=$k['id']?>" id="delete" onclick="" />Delete</d>//-->
		  </tr>
		<?  $rowclass = 1 - $rowclass;
		}?>
	 </table>

       <input type="submit" name="borrar" value="Delete Selected" />
	 </form>
		<?
	 }else{
	  	echo "<p style=\"color:red;\">No balances found in your search<br/>Please, try changing the filter parameters above</p>";
	 }
 }else{

   $cantid=0;
	 foreach($_POST['id_file'] as $k=>$v){
	    $cantid++;
        $db->borrar($v, 'statements');
     }
   echo "<h2 style=\"color:red;\">$cantid statements files deleted</h2>";
   ?>
 <?}?>

<?php
 /*
 if ($_POST['go']=="Delete"){ 	if($_POST['villa_id']!="none"){
	 $db=new DATA();//connect to database
	 $db->borrar_todos($table='statements', $campo='id_villa', $valor=$_POST['villa_id']);
	 echo "<h2 style=\"color:red;\">All the statements records has been delected for the villa selected.</h2>";
	}else{	echo "<h2 style=\"color:red;\">Please, choose one villa above to delete it records</h2>";
	}
 } */
?>


