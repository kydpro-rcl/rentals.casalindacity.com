<div class="art-box-body art-post-body">
	<h1>Make deficiency complete</h1>
<?php
		/*$data= new getQueries ();*/
		$data=new Consultas();
        $DEFIC=$data->consulta_def_undone();

 if(!$_POST['def_id']){	?>

      <? if ($DEFIC){

      ?>
      <form method="post" action="deficiency_done.php">
      <p style="font-size:10px; padding-left:15px; color:blue;"><strong>Total found: <?=count($DEFIC)?> deficiencies</strong> </p>
		<hr />
      <table border="0" cellspacing="2" cellspacing="2" align="center" class="main_table2" width="100%">
		   <tr class="row_head2">
		   		<td class="cell2" colspan="4" align="center" style="background-color:#58c1df;"><b>SHOWING DEFICIENCIES PENDING</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Villa No.</td>
		   		<td class="cell2">Details</td>
		   		<td class="cell2">Status</td>
                <td class="cell2">Select</td>
		   	</tr>
		   	<?
		   	$x=0;
		   	foreach($DEFIC AS $k){?>
			   	<tr class="fi<?=$x?>">
			   		<td class="cell2" align="center"><? $vi=$data->get_id($id=$k['id_villa'], $table='villa'); echo $vi['no']; ?></td>
			   		<td class="cell2" align="left"><?=$k['details']?></td>
			   		<td class="cell2" align="center"><? if($k['status']==1){ echo 'pending';}else{ echo 'Done';}?></td>
			   		<td align="center"><input type="checkbox" name="def_id[]" value="<?=$k['id']?>"/></td>
			   	</tr>
			<?
			if ($x==0){$x++;} elseif ($x==1){$x--;}
			}?>
		   </table>

       <p style="margin-right:3px; text-align:right;"><input  class="boton" type="submit" name="imprimir" value="Make selected done"/></p>
       </form>
	  <?}else{
        echo "<p style='text-align:center; color:red; font-size:16px;'>There is no deficiencies pending</p>";

	  }?>

 <?}else{
 // print_r($_POST['def_id']);
 $cantid=0;

      foreach($_POST['def_id'] as $k=>$v){
      $cantid++;
      	$data->make_def_done($v); /*made deficiency done*/

      	$fields=array('id_def'=>$v, 'user_id'=>$_SESSION['rqc']['id'], 'date'=>date("Y-m-d G:i:s"));
      	$data->insert($fields, $table='deficiencies_done');    /*save change history*/
      }
	$msg="$cantid deficiencies done";
       /*enviar email a todos los usuarios activos*/
          $usuarios=$data->consulta_activos($table='users');
          $asunto='System change';
          //------------------START BODY----------------------
          $contenido_html='';
          $contenido_html.='<p> A change has been made in the system with the following message:</p>';
          $contenido_html.='<p>'.$msg.'</p>';
          $contenido_html.='<p>&nbsp;</p>';
          $contenido_html.='<p>Made by: '.$_SESSION['rqc']['name'].''.$_SESSION['rqc']['lastname'].'</p>';

          //------------------END BODY------------------
          $desde_nombre='www.RCLQualityControl.Com';
          $desde_email='no-reply@RCLQualityControl.com';
          foreach($usuarios AS $u){
		  	@$send_email=enviar_email($enviar_a=trim($u['email']), $asunto, $contenido_html, $desde_nombre, $desde_email);/*notificar a todos los usuarios*/
    	  }
		/*termino de enviar el email*/
   echo "<p>&nbsp;</p>";
   echo "<h3 style='color:red'>$msg</h3>";

 }?>


</div>