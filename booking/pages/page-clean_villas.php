<p class="header">CLEANING ON VILLAS FOR RENT</p>
<?php


		$data= new getQueries ();

 if(!$_POST['villa_ids']){
		//$bookings_found=$data->bookings_referral_unpaid();
       //  $v="villas";   $cond="able_r=1";  $order="no";
		$bookings_found=$data->showTable_restrinted('villas','able_r=1','no');  //SHOW ONLY VILLAS AVAILABLE FOR RENT
		$total_records=$data->getAffectedRows();

		?>

      <? if ($bookings_found){

      ?>
      <form method="post" action="clean_villas.php">
		<p style="font-size:10px; padding-left:15px; color:blue;"><strong>Total Villas: <?=$total_records?></strong> </p>
		<hr />
		<table  align="center" cellpadding="2" cellspacing="2" border="0">

		<tr class="title">
			<td>&nbsp;</td>
				<td class='centro' id="td">
					VILLA NO.
				</td>
				<td class='centro' id="td">
					STATUS
				</td>
				<td class='centro' id="td">
					DATE MODIFIED
				</td>
				<td class='centro' id="td">
					UPDATED BY
				</td>
				<td class='centro' id="td">
					NOTE
				</td>
		</tr>
		<?php

		$x=0;
		$General_Totals=0;

		foreach ($bookings_found as $k){
          $clean=$data->clean($k['id']);
        ?>

		<tr class='fila<?=$x;?>'  >
			<td><input type="checkbox" name="villa_ids[]" value="<?=$k['id']?>"/></td>
           <td id='td' class='derecha'><?=$k['no']?></td>
		       <?
		 switch($clean['status']){
		 	   case 1:          //ready cleaned
	  				  $color_de_fondo="#1818f6";
		  			  $color_de_letra="white";
		  			  $textclean="Already cleaned";
		 	   		  break;
		 	   case 2:           //dirty
		 	   		  $color_de_fondo="#0f0f0f";
		  			  $color_de_letra="white";
		  			  $textclean="Dirty";
		 	   		  break;
		       case 3:           //in process - cleaning
		       		  $color_de_fondo="#f9a334";
		  			  $color_de_letra="blue";
		  			  $textclean="Cleaning Now";
		 	   		  break;
		 	   default:			//unknown
					  $color_de_fondo="white";
		  			  $color_de_letra="black";
		  			  $textclean="Unknown";
		 }

		 $link= new DB(); $made=$link->getUserDetails($clean['id_adm']);

		       ?>
           <td id='td' class='derecha' style="background:<?=$color_de_fondo?>; color:<?=$color_de_letra?>;"><?=$textclean?></td>
           <td id='td' class='derecha'><? if($clean['fecha']){?><?=date("l dS \of F Y h:i:s A",strtotime($clean['fecha']))?><?}?></td>
           <td id='td' class='derecha'><?=$made[0]['name'].' '.$made[0]['lastname']?></td>
           <td id='td' class='derecha'><textarea name="nota[<?=$k['id']?>]" cols="20" rows="2"><?=$clean['nota']?></textarea></td>
          </tr>


         <?
		 if ($x==0){$x++;} elseif ($x==1){$x--;}
		 $referal_id=$k['id_referal'];
		}
		//.utf8_encode($k['lastname'])
		?>

		</table>
		<hr/>
       <p style="margin-left:35px; text-align:center;"> <span style="margin-left:35px;">Selected Action:
	       <select name="accion">
		       <option value="1">Cleaned</option>
		       <option value="2">Dirty</option>
		       <option value="3">In Process</option>
	       </select></span>
	       <input class="book_but" type="submit" name="change_status" value="Change Status to Selected"/>

       </p>
       </form>
	  <?}else{        echo "<p style='text-align:center; color:red; font-size:16px;'>NO HAY RESERVAS SIN PAGAR.</p>";
	  }?>

 <?}else{
 // print_r($_POST['book_refs']);
 $cantid=0;
 $link=new DB();


  foreach($_POST['villa_ids'] as $k=>$v){
  	$cantid++;    $cambiado_por=$_SESSION['info']['id']; //id del usuario en session
    $villa_id=$v;//actual villa id
    $estado=$_POST['accion'];//estado de limpieza
    $clean=$data->clean($villa_id); //get information for actual villa in cleaning table
    $esta_nota=$_POST['nota'][$villa_id];
    // echo $esta_nota.'<br>';
    if ($clean){//record found
      //update this record for this villa
     //echo $villa_id.' this villa has records,<br/>';
     $link->up_clean($clean['id'], $cambiado_por, $villa_id, $estado,$esta_nota);
    }else{//there is not records found - create a new      //insert new record for this villa
      //echo $villa_id.' this villa not records,<br/>';
     $link->in_clean($cambiado_por, $villa_id, $estado,$esta_nota);    }
  }

  			switch($_POST['accion']){
		 	   case 1:          //ready cleaned
	  				  $acciones=" cleaned";
		 	   		  break;
		 	   case 2:           //dirty
		 	   		   $acciones=" dirty";
		 	   		  break;
		       case 3:           //in process - cleaning
		       		   $acciones=" on cleaning process";
		 	   		  break;
			 }

    /* echo '<pre>';
		print_r ($_POST['villa_ids']);
	echo '</pre>';
    echo '<pre>';
		print_r ($_POST['nota']);
	echo '</pre>';

	foreach($_POST['nota'] as $k=>$v){
	 echo $v.'<br>';
	}  */


   echo "<h1>$cantid Villas $acciones</h1>";

 }?>

