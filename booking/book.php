<? require_once('inc/session.php');
if ($_SESSION['info']){
require_once('template/head.php');
require_once('init.php');
$_SESSION['consultas']=new getQueries ();
$_SESSION['subDB']=new subDB;
   if (!$_POST){
         if ($villa!=$v2){
		       // $villa1=new getQueries;
			   $villa1=$_SESSION['consultas'];
				$v1=$villa1->villa($villa);
				foreach($v1 as $keyv1)
				//echo $keyv1['no'];
				 $villa2=$_SESSION['consultas'];
				$v2=$villa2->villa($v2);
				foreach($v2 as $keyv2)
			//	echo $keyv2['no'];
		?>
        <table border="0" cellpadding="0" cellspacing="0"><tr><td>
        <img src="images/error.jpg" title="Error" alt="Error Villa" width="50" width="50" class="img_left"/></td><td><p class="error">We sorry, There was an error: <u>Different Villas Selected.</u></p></td>
        <!--<hr />--></tr></table>


        <br /><br /><br />
		<fieldset id="fieldset"><legend>Error Details</legend>

        <p class="p_azul">You can't choose: <strong>Starting villa No. <?=$keyv1['no']?></strong> and <strong>Ending villa No.<?=$keyv2['no']?></strong>, between dates.</p>
        <p class="p_azul">Close this windows and start again.</p>
		<p class="p_center"><img src="images/unallow_houses.png" title="Choose only one house" alt="Different Villas" /></p>
</fieldset>

		<?
		//die("Villas Diferentes");
		die();
		}

		$result_dias=$_SESSION['subDB'];
		 // $result_dias=new subDB;
		  $noches=$result_dias->daysDifference($end,$start);  //say how many niths between ending date minus starting one
		//echo $a."noches";
		if ($noches==0){

			//die("fechas iguales");

				#$fecha_start=strtotime($start);
				#$fecha_end=strtotime($end);
		  		//  $fecha_inicio1=date('Y-m-d', $fecha_inicio);
				#$fecha1=date('D. F j, Y', $fecha_start);
				#$fecha2=date('D. F j, Y', $fecha_end);
			?>
        <table border="0" cellpadding="0" cellspacing="0"><tr><td>
        <img src="images/error.jpg" title="Error" alt="Error Villa" width="50" width="50" class="img_left"/></td><td><p class="error">We sorry, There was an error: <u>Dates are the Same.</u></p></td>
        <!--<hr />--></tr></table>


        <br /><br /><br />
		<fieldset id="fieldset"><legend>Error Details</legend>

        <p class="p_azul">You can't choose: Starting at <strong><?=formatear_fecha($start);?> </strong>and Ending <strong> <?=formatear_fecha($end);?></strong>.</p>
        <p class="p_azul">Please, Close this windows and choose different dates.</p>
		<p class="p_center"><img src="images/wrong_dates.png" title="Choose different dates" alt="Same dates" /></p>
</fieldset>

		<?
		die();

			}

		if ($noches<0){
				$fecha_start=strtotime($start);
				$fecha_end=strtotime($end);
		  		//  $fecha_inicio1=date('Y-m-d', $fecha_inicio);
				$fecha1=date('D. F j, Y', $fecha_start);
				$fecha2=date('D. F j, Y', $fecha_end);
			?>
        <table border="0" cellpadding="0" cellspacing="0"><tr><td>
        <img src="images/error.jpg" title="Error" alt="Error Villa" width="50" width="50" class="img_left"/></td><td><p class="error">We sorry, There was an error: <u>Problem with dates.</u></p></td>
        <!--<hr />--></tr></table>


        <br /><br /><br />
		<fieldset id="fieldset"><legend>Error Details</legend>

        <p class="p_azul">You can't choose: Starting date <strong><?=formatear_fecha($start);?> </strong>and Ending <strong> <?=formatear_fecha($end);?></strong>.</p>
        <p class="p_azul">Note: <strong>Ending date must be later than starting date.</strong></p>
        <p class="p_azul">Please, Close this windows and choose different dates.</p>
		<p class="p_center"><img src="images/wrong_dates.png" title="Choose different dates" alt="Same dates" /></p>
</fieldset>

		<?
		die();
			//die("fechas inicio debe ser menor que la de termino");

			}

		if ($noches>0){// STARTING PROCCESS WHEN ALL IS RIGHT
			//echo("$a Nights");
			 #$o=new getQueries;
			 $o=$_SESSION['consultas'];

			 //if villa is busy in that period

			 $fecha_rota=explode('-',$start);
			// echo $fecha_rota[1];
			 $mes=$fecha_rota[1]; $year=$fecha_rota[0];
             $busy=$o->see_occupancy_filtred($villa, $mes, $year);
              $counting=0;
              foreach ($busy as $occ){
               for ($i=0; $i<$noches; $i++){
	               $alojamiento=strtotime($year."-".$mes."-".($fecha_rota[2]+$i));
	               $f_a=date('Y-m-d',$alojamiento);
	               //echo "fechas de estadia $f_a<br>";
	               //echo "Inicia".$occ['start']."<br>";
	               if ($f_a==$occ['start']){
                    die ("Busy Period");
	               }
               }
              //echo $occ['busyid']."<br>";
              //echo $occ['start']."<br>";
              $counting++;
              }
            //  echo "$counting ocupaciones de villa id $villa Mes $mes ano $year<br>";

		//if everything is right on the selections
				$r=$o->villa($villa);
				foreach($r as $k)
				//echo $k['no'];
			//	echo $k['no'];
			$_SESSION['info_villa']=$k;
			$_SESSION['noches']=$noches;
		   if (!$_GET['destine']){
		   ?>
           <img src="images/logo.gif" border="0" style="float:left">
           <br /><br /><br />

		  <table><tr><td  valign="middle" width="300">
          <fieldset id="fieldset"><legend>Villa Details</legend><img width="153" height="103" style="float:left; padding-right:5px; padding-bottom:5px;" src="<?=$k['pic']?>" border="0" align="Villa No. <?=$k['no']?>" title="Villa No. <?=$k['no']?>" />
           <p id="td"><strong>Villa No:</strong><span class="azul"> <?=$k['no']?></span></p>
           <p id="td"><strong>Villa Type:</strong><span class="azul"> <?=$k['type']?></span></p>
           <p id="td"><strong>Dimensions:</strong><br /><span class="azul"> <?=number_format($k['ft2'])?> ft&sup2;</span> / <span class="azul"><?=$k['m2']?> m&sup2;</span></p>
           <p id="td"><strong><!--Maximum-->Max. People:</strong> <span class="azul"><?=$k['capacity']?> persons</span></p>

            <p id="td" style="clear:both"><strong>Bedrooms: </strong><span class="azul"><?=$k['bed']?></span><br />
           <strong>Bathrooms: </strong><span class="azul"><?=$k['bath']?></span><br />
            <strong>Airconditioners: </strong><span class="azul"><?=$k['AC']?></span></p>
             <?

				$owner=$o->owners_details($k['owner']);
			//	foreach($owner as $ow)
              ?>
            <p id="td"><strong>Owner: </strong><span class="rojo"><?=$owner[0]['name']?></span></p>
            <p id="td" style="text-align:right; padding-right:10px;"><strong>Price per Night: </strong><span class="azul">Low season US$ <?=number_format($k['p_low'], 2);?></span> </p>
           <p id="td" style="text-align:right; padding-right:10px;"><strong>Price per Night: </strong><span class="azul">Hight season US$ <?=number_format($k['p_high'], 2);?></span></p>
            </fieldset>
		   </td><td width="300"><fieldset id="fieldset"><legend>Time Selected</legend>
           <!-- <a href="nights.php" target="_blank">New customer</a>-->
           <br />
		     <form name="reserva" method="post" action="<?php echo $PHP_SELF;?>">

		      <input type="hidden" name="nights" value="<?=$noches?>" />
		       <input type="hidden" name="villa_id" value="<?=$villa?>" />
             <?
              /*	$fecha_start=strtotime($start);
				$fecha_end=strtotime($end);
		  		//  $fecha_inicio1=date('Y-m-d', $fecha_inicio);
				$fecha1=date('D. F j, Y', $fecha_start);
				$fecha2=date('D. F j, Y', $fecha_end);    */

				$fecha1=formatear_fecha($start);
				$fecha2=formatear_fecha($end);

			 ?>
			   <input type="hidden" name="start" value="<?=$start;?>" />
		       <input type="hidden" name="end" value="<?=$end?>" />
              <table>
              <tr><td id="td">Villa selected: </td><td class="big"><strong>Villa No. <?=$k['no']?> </strong> </td></tr>
              <tr><td id="td">From:</td><td class="big"><strong> <?=$fecha1?></strong></td></tr>
              <tr><td id="td">To:</td><td class="big"><strong> <?=$fecha2?></strong></td></tr>
              <tr><td id="td">Nights between period:</td><td class="big"> <strong><?=$noches?> nights</strong></td></tr>
              <tr><td colspan="2">
              <hr />
              <p id="fields" style="text-align:center"> What To Do With Selected Period?</p></td></tr>
		      <tr><td colspan="2" align="center"> <select name="destination">
               	  <option value="mantenimiento">Maintenance</option>
		          <option value="regular" selected="selected">Short Term Rental</option>
		          <option value="long">Long Term Rental</option>
		      </select>
		      <input type="hidden" name="price" value="<?=$k['p_low']?>">  <!--SUPONIENDO QUE ES TEMPORADA BAJA-->

		      <!--DEBE SER QUE SI ES TEMPORADA ALTA Y BAJA MARCA AMBOS PRECIOS-->
		     <!--SINO EL PRECIO DE LA TEMPORADA CORRESPONDIENTE-->

		      <input  class="book_but" type="submit" name="next" value="Next" title="Go to next step"></td></tr></table>
		     </form>
		   <!--  <FORM>
		<INPUT TYPE="button" onClick="history.go(0)" VALUE="Refresh">
		</FORM>  --></fieldset>


           </td></tr></table>

            <?
            }
			}
 }
  //  echo $_POST['destination'];
    if ($_GET['destine']){
    	$destine=$_GET['destine'];
    }else{
		$destine=$_POST['destination'];
	}

	/*switch ($destine) {
    case 0:
        echo "i equals 0";
        break;
    case 1:
        echo "i equals 1";
        break;
    case 2:
        echo "i equals 2";
        break;
}*/

 switch ($destine) {
    case "mantenimiento":
      //  echo "i equals 0";
	  ?>
	  <form method="post" action="maitenance.php">
      <p>Mantenimiento</p>
      <input type="submit" name="confirm" value="Confirmed"   />
      </form>
	  <?
        break;
    case "regular":
		//header('location:regular_reserves.php');
       // echo "i equals 1";
       $price_default=$_SESSION['info_villa']['p_low'];
       $qty_nights=$_SESSION['noches'];
       #$qty_nights=$noches;
       $starting_date=$start;
       $ending_date=$end;
      $selected_villa_id=$_SESSION['info_villa']['id'];
     /*  $qty_nights=$_POST['nights'];//save in section  //VALOR MISSING CON GET
       $price_default=$_POST['price'];  //ESTO DARA UN ERROR SI ES GET
       $starting_date=$_POST['start'];  //save in section
       $ending_date=$_POST['end'];  //save in section */
	   $casa=$_SESSION['info_villa'];
	   ?>

	   <img src="images/logo.gif" border="0" style="float:left"><br/>
       <h2 style="text-align:center; color:#06C;">Short Term Rental Booking</h2
       ><hr />
       <form method="post" action="short_reserves.php">
       <table><tr><td width="235"><fieldset><legend>Villa details</legend>
       <!--INFORMACIONES DE LA VILLAS INICIAN-->
       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
       <p id="td" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
       <p id="td" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
       <p  id="td" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>
       <p  id="td" style="font-weight:bold;">Maximum People: <span class="azul"><?=$casa['capacity']?></span> Price US$ <span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span></p>


       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
       </fieldset></td><td><fieldset><legend>Additional Services</legend>
       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
       <? $masaje=$_SESSION['consultas']->services("massage");?>
      <p id="fields"><span id="td" > Massages: </span><!--<br />--><select class="azul" style="text-align:right" name="massage" size=1>
           <option value="0" >None</option>
	   <? foreach($masaje as $masaje){
	     // echo $masaje['name']."<br>";
		 ?>
         <option value=<?=$masaje['id']?><? if ($post['massage'] == $masaje['id']) {echo " SELECTED";} ?>><?=$masaje['name']." ".$masaje['price']?></option>
         <?
	   }
	   ?></select></p>
       <!--<br />-->
         <? $pickup=$_SESSION['consultas']->services("Airport Pick Up");?>
       <p style="text-align:right; font-weight:bold"><span id="td">Airport Pick up: </span><!--<br />--><select class="azul" style="text-align:right" name="pickup" size=1>
       <option value="0" >None</option>
	   <? foreach($pickup as $pickup){
	     // echo $masaje['name']."<br>";
		 ?>
         <option value=<?=$pickup['id']?><? if ($post['pickup'] == $pickup['id']) {echo " SELECTED";} ?>><?=$pickup['name']." ".$pickup['price']?></option>
         <?
	   }
	   ?></select></p>
       <!--<br />-->
        <? $VIPpickup=$_SESSION['consultas']->services("VIP Airport Pick Up");?>
       <p style="text-align:right; font-weight:bold"><span id="td">VIP Airport Pick up: </span><!--<br />--><select class="azul" style="text-align:right" name="VIPpickup" size=1>
       <option value="0" >None</option>
	   <? foreach($VIPpickup as $VIPpickup){
	     // echo $masaje['name']."<br>";
		 ?>
         <option value=<?=$VIPpickup['id']?><? if ($post['VIPpickup'] == $VIPpickup['id']) {echo " SELECTED";} ?>><?=$VIPpickup['name']." ".$VIPpickup['price']?></option>
         <?
	   }
	   ?></select></p>
       <!--<br />-->
        <? $chef=$_SESSION['consultas']->services("chef");?>
       <p style="text-align:right; font-weight:bold"><span id="td">On Site Chef: </span><!--<br />--><select  class="azul" style="text-align:right" name="chef" size=1>
       <option value="0" >None</option>
	   <? foreach($chef as $chef){
	     // echo $masaje['name']."<br>";
		 ?>
         <option value=<?=$chef['id']?><? if ($post['chef'] == $chef['id']) {echo " SELECTED";} ?>><?=$chef['name']." ".$chef['price']?></option>
         <?
	   }
	   ?></select></p>
       <!--<br />-->
        <? $fridge=$_SESSION['consultas']->services("Filled Fridge");?>
       <p style="text-align:right; font-weight:bold"><span id="td">Filled Fridge: </span><!--<br />--><select class="azul" style="text-align:right" name="fridge" size=1>
       <option value="0" >None</option>
	   <? foreach($fridge as $fridge){
	     // echo $masaje['name']."<br>";
		 ?>
         <option value=<?=$fridge['id']?><? if ($post['fridge'] == $fridge['id']) {echo " SELECTED";} ?>><?=$fridge['name']." ".$fridge['price']?></option>
         <?
	   }
	   ?></select></p>

       <!--aeropuerto vip->choose->cantidad(Note:______)<br />-->
       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
       </fieldset></td></tr>
       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
       <!--INFORMACIONES DE LA RENTA INICIA-->
      <p style="text-align:right; font-weight:bold"><span id="td"> Adults: <select name="adults">
       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
       <? } ?>
       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
       <? for ($i=0; $i<=$casa['capacity'];$i++){?>
       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
       <? } ?>
       </select>&nbsp;&nbsp;&nbsp;
	   <? $custormers=$_SESSION['consultas']->customers();?>
		 Customer: <select name="client" size=1><? foreach ($custormers as $cu ) {     //$owner as $k => $v
							?><option value=<?=$cu['id']?><? if ($post['client'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?><?
						} ?></select> <a href="#">New User</a></span>&nbsp;&nbsp;&nbsp;</p>

      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Total nights: </span><u><span style="color:#09F"><?=$qty_nights?></span></u></p>
      <p style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Status:</span><span style="color:#09F"><input type="radio" name="status" value="1">Checking in <input type="radio" name="status" value="2">Confirmed <input type="radio" name="status" value="3" checked>Transit <!--<input type="radio" name="status" value="3" checked> Checked in<input type="radio" name="status" value="4"> Checked out--></span><p>
      <p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> <p>


       </fieldset></td></tr>

       <tr><td><!--<INPUT class="submit" TYPE="button" onClick="history.go(-1)" VALUE="Back"></td><td><input class="submit" type="submit" name="next" value="Next"   />
       <INPUT class="submit" TYPE="button" onClick="parent.location='book.php?villa=<?=$selected_villa_id?>&v2=<?=$selected_villa_id?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" VALUE="Back"></td><td><input class="submit" type="submit" name="next" value="Next"   />-->
       <INPUT class="book_but" TYPE="button" onClick="location.href='book.php?villa=<?=$selected_villa_id?>&v2=<?=$selected_villa_id?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" VALUE="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
       </table></form>
   <!--INFORMACIONES DE LA RENTA TERMINAN-->
     <!-- <p>Regular</p>-->
      <? /*echo  $_SESSION['info_villa']['no']."<br>"*/
       /*echo  $_SESSION['info']['name']."<br>"*/

    /* $link = new getQueries; $owner=$link->owners();*/


        break;
    case "long":
       // echo "i equals 2";
	    ?>
	  <form method="post" action="long_term_rental.php">
      <p>Long Term Rental</p>
      <input type="book_but" name="confirm" value="Confirmed"   />
      </form>
	  <?
        break;
 }

 require_once('template/foot.php');
}else{
	header('Location:login.php');
	die();
	
  //die ("<html><head></head><body> <img src='https://casalindacity.com/images/logo.gif' style='clear:both;'/><br>You are not logged in,<br/>Please, <a href=\"../login.php\" target=\"_blank\">login</a> first.</body></html>");
 // echo ("<meta http-equiv=\"refresh\" content=\"0;url=../login.php\">");
  }
?>
