<?php
//=====================================================CHANGES MADE ON THIS BOOKING============================================
     $link=new getQueries (); //connect and make a query - Ej. get info from a ref number
    $busy=$link->see_occupancy_id($_GET['id']);
	$ocupabilidad=$busy[0];
   $books_mod=$link->see_occupancy_mod_ref($ref=$ocupabilidad['ref']);
   $total_records=$link->getAffectedRows();


   $chout_info=$link->show_any_data($table='checkout', $field='reser_no', $value=$ocupabilidad['ref'], $operator='=');
    $ckin_info=$link->show_any_data($table='checkin', $field='reser_no', $value=$ocupabilidad['ref'], $operator='=');
   //comparar las fechas de  startind date y ending date (starting and/or ending date changed)
   //comprar villa id  (moved from villa to villa)
   //comparar id_cliente (cliente changed)
   //comparar adults and children   (qty person comming)
   //compara vehicules  (vehicles add)
   //id_interm (referal) (if referal)
   //cantidad de noches (va con la fecha de inicio y de termino si la cambian)
   //cantidad de noches de estancion alta y estacion baja
   //precio por noche en un short term, verificar si cambia   (price changed)
   //precio HS en un short term verificar si cambia  (price HS changed)
   //se puede chequear la comision
   //verificar si cambion el monto
   //si los impuestos fueron cambiado
   //que no vario o si el monto por servicios [como se verifican si los servicios cambiaron]
   //¿como se verifica si hay excursiones o si se cambiaron....INVESTIGAR
   //verificar si cambio el deposito [agregado o quidado]
   // que el total es el mismo
   //que el estatus es el mismo
   //=====================SPECIALMENTE SI ES LONG TERM RENTAL=====================================
   //QUE LA CANTIDAD DE PAGOS ES LA MISMA
   //QUE MONTO POR PAGOS NO HA VARIADO
   //SI VARIO EL PRECIO POR RENTA DE LARGO PLAZO
   //SI VARIARON LAS NOCHES EXTRAS

   //no necesito presentar los cambios en los comentarios porque todos se podran ver a primera vista al mirar los detalles de un booking

   //EN CADA CAMBIO PODER VER EL BOOKING COMPLETO COMO SE VEIA ANTES DE CAMBIARLO. (QUIZAS HACIENDO APARECER UN FANCY BOX)

  if (!empty($books_mod)){/*SOLO HAGO ESTO SI HAY ALGUNA MODIFICACIONES EN ESTE BOOKING*/
    //ARREGLO CON EL NUEMRO DE ID DE MODIFICACION ['6068'] PARA LOS CAMBIOS HECHOS EN ESTA MODIFICION
     $cambios_en_booking=array();

   $total_elementos=count($books_mod); //get numbers a elements on an array
   # $ultimo_elmento=end($books_mod); //get the last elemento for an array

   if($total_elementos>1){/*si tiene mas de una modificaicon*/
    for($e=($total_elementos-1); $e>=1; $e--){

      $modification=$books_mod[$e];  $comparar_con=$books_mod[$e-1];
      //COMPARO MODIFICACIONES CON EL MISMO ARRAY EN UN ID MENOS
      $cambios_en_booking[$modification['busyid']]['user']=$modification['adm'];//USER RESPONSABLE TO MAKE DE CHANGES
      $cambios_en_booking[$modification['busyid']]['fecha_y_hora']=date("d M Y - g:i:s A",strtotime($modification['date']))."</br>";


        if($modification['villa']!=$comparar_con['villa']){/*moved from one villa to the other*/
        	$from_villa=$link->villa($modification['villa']); $to_villa=$link->villa($comparar_con['villa']);
        	$cambios_en_booking[$modification['busyid']]['villa']="Moved booking from villa ".$from_villa[0]['no']." to ".$to_villa[0]['no']."</br>";
        }
        if($modification['dep']!=$comparar_con['dep']){/*deposit changed*/
        	$cambios_en_booking[$modification['busyid']]['deposit']="Deposit changed from: ".$modification['dep']." to: ".$comparar_con['dep']."</br>";
        }
        if(($modification['start']!=$comparar_con['start'])||($modification['end']!=$comparar_con['end'])){/*dates changed*/
        	$cambios_en_booking[$modification['busyid']]['dates']="Modified booking. Now from: <u>".date("d M Y",strtotime($comparar_con['start']))."</u> to <u>".date("d M Y",strtotime($comparar_con['end']))."</u></br>";
        }
        //---------------------------------------------------------------------------------------------------------------------------------------
        // si estados es igual a algun check in o check out, buscar en tablas de check in or check out
        // si no lo encuentras entonces hace el proceso de cambio de estados para mostrar
        // si lo encuentro presento el check in o check out y por quien
       switch($comparar_con['status']){
    	case 1: $status_checkin=1;$status_checkout=0; break;
    	case 4: $status_checkin=0;$status_checkout=1; break;
    	case 6: $status_checkin=1;$status_checkout=0; break;
    	case 7: $status_checkin=1;$status_checkout=0; break;
    	case 8: $status_checkin=1;$status_checkout=0; break;
    	case 11: $status_checkin=0;$status_checkout=1; break;
    	case 14: $status_checkin=0;$status_checkout=1; break;
    	case 15: $status_checkin=1;$status_checkout=0; break;
    	case 18: $status_checkin=0;$status_checkout=1; break;
    	case 21: $status_checkin=0;$status_checkout=1; break;
    	case 22: $status_checkin=1;$status_checkout=0; break;
    	case 25: $status_checkin=0;$status_checkout=1; break;
    }

	   if((!$ckin_info)&&($status_checkin==1)||(!$chout_info)&&($status_checkout==1)||(!$status_checkin)&&(!$status_checkout)){
       /*if(($comparar_con['status']!=1)&&($comparar_con['status']!=4)&&($comparar_con['status']!=6)&&($comparar_con['status']!=7)&&($comparar_con['status']!=8)&&($comparar_con['status']!=11)&&($comparar_con['status']!=14)&&($comparar_con['status']!=15)&&($comparar_con['status']!=18)&&($comparar_con['status']!=21)&&($comparar_con['status']!=22)&&($comparar_con['status']!=25)){*//*fi not checked in or checkout*/
	        if($modification['status']!=$comparar_con['status']){  /*statu changed*/
	        	$cambios_en_booking[$modification['busyid']]['status']="Booking status changed from ".booking_status($modification['status'])." to ".booking_status($comparar_con['status'])."</br>";
	        }
	   }
        //---------------------------------------------------------------------------------------------------------------------------------------
        if(($modification['ppn']!=$comparar_con['ppn'])||($modification['PHS']!=$comparar_con['PHS'])){ /*if price per nights changed*/
        	if($modification['ppn']!=$comparar_con['ppn']){ $cambios_en_booking[$modification['busyid']]['priceLS']="Price per night (LS) change from ".$modification['ppn']." to ".$comparar_con['ppn']."</br>"; }
        	if($book['PHS']>0){//hacer esto solo si hay noches HS en el booking
        	   if($modification['PHS']!=$comparar_con['PHS']){$cambios_en_booking[$modification['busyid']]['priceHS']="Price per night (HS) change from ".$modification['PHS']." to ".$comparar_con['PHS']."</br>";}
        	}
        }
        if($modification['client']!=$comparar_con['client']){/*if the tenent is owner and it was chenged*/
        	if (($modification['status']==7)||($modification['status']==19)||($modification['status']==20)||($modification['status']==21)){
        		 $owner_from=$link->show_id('owners', $modification['client']); $owner_to=$link->show_id('owners', $comparar_con['client']);
                 $cambios_en_booking[$modification['busyid']]['client']="Owner changed from <u>".$owner_from[0]['name'].' '.$owner_from[0]['lastname']."</u> to <u>".$owner_to[0]['name'].' '.$owner_to[0]['lastname']."</u></br>";
        	}else{ /*if client had been changed*/
        		$cl_f=$link->customer($modification['client']); $cl_t=$link->customer($comparar_con['client']);
        		$cambios_en_booking[$modification['busyid']]['client']="Client changed from <u>".$cl_f['name'].' '.$cl_f['lastname']."</u> to <u>".$cl_t['name'].' '.$cl_t['lastname']."</u></br>";
        	}
        }
        if(($modification['adults']!=$comparar_con['adults'])||($modification['kids']!=$comparar_con['kids'])){ /*if qty adults or qty children changed*/
        	if($modification['adults']!=$comparar_con['adults']){$cambios_en_booking[$modification['busyid']]['adults']="Quantity of adults changed from ".$modification['adults']." to ".$comparar_con['adults']."</br>";}
        	if($modification['kids']!=$comparar_con['kids']){$cambios_en_booking[$modification['busyid']]['kids']="Quantity of children changed from ".$modification['kids']." to ".$comparar_con['kids']."</br>";}
        }


          //person modified, added or deleted
        $gente_mod=$link->people_mod($modification['busyid']); $gente_comp=$link->people_mod($comparar_con['busyid']);
        $qty_gente_mod=count($gente_mod);$qty_gente_comp=count($gente_comp);
         if ($qty_gente_mod<$qty_gente_comp){
              $cantidad_efecto=$qty_gente_comp-$qty_gente_mod;  //determina la diferencia
              $cambios_en_booking[$modification['busyid']]['gente']=$cantidad_efecto." people added.<br/>";
         }elseif($qty_gente_mod>$qty_gente_comp){
         	 $cantidad_efecto=$qty_gente_mod-$qty_gente_comp;//determina la diferencia
         	 $cambios_en_booking[$modification['busyid']]['gente']=$cantidad_efecto." people removed.<br/>";
         }else{
         //es igual - comparar si se cambiaron
          $nombres_cambiados=0;
	         for($i=0; $i<$qty_gente_mod; $i++){
                if(($gente_mod[$i]['name']!=$gente_comp[$i]['name'])||($gente_mod[$i]['lastname']!=$gente_comp[$i]['lastname'])){
                 $nombres_cambiados++;

                }

	         }
            if($nombres_cambiados) $cambios_en_booking[$modification['busyid']]['gente_names']=$nombres_cambiados." Names of people changed.<br/>";
         }
        //servicios
	 	$servicios_mod=$link->services_reserved_mod($modification['busyid']); $servicios_comp=$link->services_reserved_mod($comparar_con['busyid']);
         $qty_service_mod=count($servicios_mod);$qty_service_comp=count($servicios_comp);
         if ($qty_service_mod<$qty_service_comp){
              $cantidad_efecto=$qty_service_comp-$qty_service_mod;  //determina la diferencia
              $cambios_en_booking[$modification['busyid']]['qty_service']=$cantidad_efecto." services added.<br/>";
         }elseif($qty_service_mod>$qty_service_comp){
         	 $cantidad_efecto=$qty_service_mod-$qty_service_comp;//determina la diferencia
         	 $cambios_en_booking[$modification['busyid']]['qty_service']=$cantidad_efecto." services removed.<br/>";
         }else{
         //es igual - comparar si se cambiaron
         $services_cambiados=0;
	         for($i=0; $i<$qty_service_mod; $i++){
                if(($servicios_mod[$i]['serviceid']!=$servicios_comp[$i]['serviceid'])||($servicios_mod[$i]['qty']!=$servicios_comp[$i]['qty'])||($servicios_mod[$i]['price']!=$servicios_comp[$i]['price'])){
                 $services_cambiados++;
                  /*echo "<pre>";
		            print_r($servicios_mod[$i]);
		            print_r($servicios_comp[$i]);
		            echo "</pre>"; */
                }

	         }
            if($services_cambiados) $cambios_en_booking[$modification['busyid']]['services_chg']=$services_cambiados." services changed.<br/>";

         }
        //excursiones
   		$exc_mod=$link->excrusion_reserved_mod($modification['busyid']); $exc_comp=$link->excrusion_reserved_mod($comparar_con['busyid']);
         $qty_exc_mod=count($exc_mod);$qty_exc_comp=count($exc_comp);
         if ($qty_exc_mod<$qty_exc_comp){
              $cantidad_efecto=$qty_exc_comp-$qty_exc_mod;  //determina la diferencia
              $cambios_en_booking[$modification['busyid']]['qty_exc']=$cantidad_efecto." excursions added.<br/>";
         }elseif($qty_exc_mod>$qty_exc_comp){
         	 $cantidad_efecto=$qty_exc_mod-$qty_exc_comp;//determina la diferencia
         	 $cambios_en_booking[$modification['busyid']]['qty_exc']=$cantidad_efecto." excursions removed.<br/>";
         }else{
         //es igual - comparar si se cambiaron
         $exc_cambiados=0;
	         for($i=0; $i<$qty_exc_mod; $i++){
                if(($exc_mod[$i]['qty_a']!=$exc_comp[$i]['qty_a'])||($exc_mod[$i]['qty_c']!=$exc_comp[$i]['qty_c'])||($exc_mod[$i]['price_a']!=$exc_comp[$i]['price_a'])||($exc_mod[$i]['price_c']!=$exc_comp[$i]['price_c'])||($exc_mod[$i]['total']!=$exc_comp[$i]['total'])){
                 $exc_cambiados++;

                }

	         }
	         if($exc_cambiados) $cambios_en_booking[$modification['busyid']]['exc_chg']=$exc_cambiados." excursions changed.<br/>";
         }
        //codigo de promocion

        //------vehiculos en esta renta--------------------
         if($modification['vehicles']!=$comparar_con['vehicles']){
        	$cambios_en_booking[$modification['busyid']]['vehicles']="Modified vehicles from: <u>".$modification['vehicles']."</u> to <u>".$comparar_con['vehicles']."</u></br>";
        }
    }/*terminos de comparar modificaciones*/
   }/*si hay mas de una modificaicon*/
   $book=$ocupabilidad;   //la actualizacion actual del booking en cuestion
   $last_mod=$books_mod[0];   //la ultima modificacion hecha al booking
   //============COMPARO BOOKING ACTUAL CON LA ULTIMA MODIFICACION======================
        $cambios_en_booking[$last_mod['busyid']]['user']=$last_mod['adm'];//USER RESPONSABLE TO MAKE DE CHANGES
        $cambios_en_booking[$last_mod['busyid']]['fecha_y_hora']=date("d M Y - g:i:s A",strtotime($last_mod['date']))."</br>";

        if($last_mod['villa']!=$book['villa']){
        	$from_villa=$link->villa($last_mod['villa']); $to_villa=$link->villa($book['villa']);
        	$cambios_en_booking[$last_mod['busyid']]['villa']="Moved booking from villa ".$from_villa[0]['no']." to ".$to_villa[0]['no']."</br>";
        }
        if($last_mod['dep']!=$book['dep']){
        	$cambios_en_booking[$last_mod['busyid']]['deposit']="Deposit changed from: ".$last_mod['dep']." to: ".$book['dep']."</br>";
        }
        if(($last_mod['start']!=$book['start'])||($last_mod['end']!=$book['end'])){
        	$cambios_en_booking[$last_mod['busyid']]['dates']="Modified booking. Now from: <u>".date("d M Y",strtotime($book['start']))."</u> to <u>".date("d M Y",strtotime($book['end']))."</u></br>";
        }

    //---------------------------------------------------------------------------------------------------------------------------------------
    switch($book['status']){
    	case 1: $status_checkin=1;$status_checkout=0; break;
    	case 4: $status_checkin=0;$status_checkout=1; break;
    	case 6: $status_checkin=1;$status_checkout=0; break;
    	case 7: $status_checkin=1;$status_checkout=0; break;
    	case 8: $status_checkin=1;$status_checkout=0; break;
    	case 11: $status_checkin=0;$status_checkout=1; break;
    	case 14: $status_checkin=0;$status_checkout=1; break;
    	case 15: $status_checkin=1;$status_checkout=0; break;
    	case 18: $status_checkin=0;$status_checkout=1; break;
    	case 21: $status_checkin=0;$status_checkout=1; break;
    	case 22: $status_checkin=1;$status_checkout=0; break;
    	case 25: $status_checkin=0;$status_checkout=1; break;
    }

	if((!$ckin_info)&&($status_checkin==1)||(!$chout_info)&&($status_checkout==1)||(!$status_checkin)&&(!$status_checkout)){
    /* if(($book['status']!=1)&&($book['status']!=4)&&($book['status']!=6)&&($book['status']!=7)&&($book['status']!=8)&&($book['status']!=11)&&($book['status']!=14)&&($book['status']!=15)&&($book['status']!=18)&&($book['status']!=21)&&($book['status']!=22)&&($book['status']!=25)){*//*fi not checked in or checkout*/
   		if($last_mod['status']!=$book['status']){
        	$cambios_en_booking[$last_mod['busyid']]['status']="Booking status changed from ".booking_status($last_mod['status'])." to ".booking_status($book['status'])."</br>";
        }
     }
        //---------------------------------------------------------------------------------------------------------------------------------------
        if(($last_mod['ppn']!=$book['ppn'])||($last_mod['PHS']!=$book['PHS'])){
        	if($last_mod['ppn']!=$book['ppn']){ $cambios_en_booking[$last_mod['busyid']]['priceLS']="Price per night (LS) change from ".$last_mod['ppn']." to ".$book['ppn']."</br>"; }
        	if($book['PHS']>0){//hacer esto solo si hay noches HS en el booking
        		if($last_mod['PHS']!=$book['PHS']){$cambios_en_booking[$last_mod['busyid']]['priceHS']="Price per night (HS) change from ".$last_mod['PHS']." to ".$book['PHS']."</br>";}
        	}
        }
        if($last_mod['client']!=$book['client']){
        	//$cambios_en_booking[$last_mod['busyid']]['client']="<p>Client changed from ".$last_mod['client']." to ".$book['client']."</p>";

        	if (($last_mod['status']==7)||($last_mod['status']==19)||($last_mod['status']==20)||($last_mod['status']==21)){
        		 $owner_from=$link->show_id('owners', $last_mod['client']); $owner_to=$link->show_id('owners', $book['client']);
                 $cambios_en_booking[$last_mod['busyid']]['client']="Owner changed from <u>".$owner_from[0]['name'].' '.$owner_from[0]['lastname']."</u> to <u>".$owner_to[0]['name'].' '.$owner_to[0]['lastname']."</u></br>";
        	}else{
        		$cl_f=$link->customer($last_mod['client']); $cl_t=$link->customer($book['client']);
        		$cambios_en_booking[$last_mod['busyid']]['client']="Client changed from <u>".$cl_f['name'].' '.$cl_f['lastname']."</u> to <u>".$cl_t['name'].' '.$cl_t['lastname']."</u></br>";
        	}
        }
        if(($last_mod['adults']!=$book['adults'])||($last_mod['kids']!=$book['kids'])){
        	if($last_mod['adults']!=$book['adults']){$cambios_en_booking[$last_mod['busyid']]['adults']="Quantity of adults changed from ".$last_mod['adults']." to ".$book['adults']."</br>";}
        	if($last_mod['kids']!=$book['kids']){$cambios_en_booking[$last_mod['busyid']]['kids']="Quantity of children changed from ".$last_mod['kids']." to ".$book['kids']."</br>";}
        }
   //====================================================================================
   	$modification['busyid']=$last_mod['busyid'];    $comparar_con['busyid']=$book['busyid']; /*booking actual*/

   	  //person modified, added or deleted
        $gente_mod=$link->people_mod($modification['busyid']); $gente_comp=$link->people($comparar_con['busyid']);
        $qty_gente_mod=count($gente_mod);$qty_gente_comp=count($gente_comp);
         if ($qty_gente_mod<$qty_gente_comp){
              $cantidad_efecto=$qty_gente_comp-$qty_gente_mod;  //determina la diferencia
              $cambios_en_booking[$modification['busyid']]['gente']=$cantidad_efecto." people added.<br/>";
         }elseif($qty_gente_mod>$qty_gente_comp){
         	 $cantidad_efecto=$qty_gente_mod-$qty_gente_comp;//determina la diferencia
         	 $cambios_en_booking[$modification['busyid']]['gente']=$cantidad_efecto." people removed.<br/>";
         }else{
         //es igual - comparar si se cambiaron
          $nombres_cambiados=0;
	         for($i=0; $i<$qty_gente_mod; $i++){
                if(($gente_mod[$i]['name']!=$gente_comp[$i]['name'])||($gente_mod[$i]['lastname']!=$gente_comp[$i]['lastname'])){
                 $nombres_cambiados++;

                }

	         }
            if($nombres_cambiados) $cambios_en_booking[$modification['busyid']]['gente_names']=$nombres_cambiados." Names of persons changed.<br/>";
         }
   		 //servicios
	 	$servicios_mod=$link->services_reserved_mod($modification['busyid']); $servicios_comp=$link->services_reserved($comparar_con['busyid']);
         $qty_service_mod=count($servicios_mod);$qty_service_comp=count($servicios_comp);
         if ($qty_service_mod<$qty_service_comp){
              $cantidad_efecto=$qty_service_comp-$qty_service_mod;  //determina la diferencia
              $cambios_en_booking[$modification['busyid']]['qty_service']=$cantidad_efecto." services added.<br/>";
         }elseif($qty_service_mod>$qty_service_comp){
         	 $cantidad_efecto=$qty_service_mod-$qty_service_comp;//determina la diferencia
         	 $cambios_en_booking[$modification['busyid']]['qty_service']=$cantidad_efecto." services removed.<br/>";
         }else{
         //es igual - comparar si se cambiaron
         $services_cambiados=0;
	         for($i=0; $i<$qty_service_mod; $i++){
                if(($servicios_mod[$i]['serviceid']!=$servicios_comp[$i]['serviceid'])||($servicios_mod[$i]['qty']!=$servicios_comp[$i]['qty'])||($servicios_mod[$i]['price']!=$servicios_comp[$i]['price'])){
                 $services_cambiados++;
                     /*echo "Last one";
                    // echo "<pre>";

		            print_r($servicios_mod[$i]);
		            print_r($servicios_comp[$i]);
		           // echo "</pre>"; */

                }

	         }
            if($services_cambiados) $cambios_en_booking[$modification['busyid']]['services_chg']=$services_cambiados." services changed.<br/>";

         }
        //excursiones
   		$exc_mod=$link->excrusion_reserved_mod($modification['busyid']); $exc_comp=$link->excrusiones_reserved($comparar_con['busyid']);
         $qty_exc_mod=count($exc_mod);$qty_exc_comp=count($exc_comp);
         if ($qty_exc_mod<$qty_exc_comp){
              $cantidad_efecto=$qty_exc_comp-$qty_exc_mod;  //determina la diferencia
              $cambios_en_booking[$modification['busyid']]['qty_exc']=$cantidad_efecto." excursions added.<br/>";
         }elseif($qty_exc_mod>$qty_exc_comp){
         	 $cantidad_efecto=$qty_exc_mod-$qty_exc_comp;//determina la diferencia
         	 $cambios_en_booking[$modification['busyid']]['qty_exc']=$cantidad_efecto." excursions removed.<br/>";
         }else{
         //es igual - comparar si se cambiaron
         $exc_cambiados=0;
	         for($i=0; $i<$qty_exc_mod; $i++){
                if(($exc_mod[$i]['qty_a']!=$exc_comp[$i]['qty_a'])||($exc_mod[$i]['qty_c']!=$exc_comp[$i]['qty_c'])||($exc_mod[$i]['price_a']!=$exc_comp[$i]['price_a'])||($exc_mod[$i]['price_c']!=$exc_comp[$i]['price_c'])||($exc_mod[$i]['total']!=$exc_comp[$i]['total'])){
                 $exc_cambiados++;

                }

	         }
	         if($exc_cambiados) $cambios_en_booking[$modification['busyid']]['exc_chg']=$exc_cambiados." Excursions changed.<br/>";
         }
        //codigo de promocion

        //------vehiculos en esta renta--------------------
         if($last_mod['vehicles']!=$book['vehicles']){
        	$cambios_en_booking[$modification['busyid']]['vehicles']="Modified vehicles from: <u>".$modification['vehicles']."</u> to <u>".$comparar_con['vehicles']."</u></br>";
        }
  }
//==========================================================END GETTING THE INFORMATION FOR CHANGES MADE===========================================================================================================
  echo "<h2>New comments for this booking</h2>";

  //presentar los errores debidos si el usuario no es de nivel 1
  //presentar los errores debidos si el usuario no esta logueado por seguridad
  $link=new getQueries ();
  $busy=$link->see_occupancy_id($_GET['id']);
  $ocupabilidad=$busy[0];
?>
 <script type="text/javascript">

	function setVisibility(id, visibility) {
	document.getElementById(id).style.display = visibility;
	}

	<!--
	function validate(){
	if (document.note.comment.value==""){
	  alert ("You must fill in the Comment field!")
	  return false
	 }
	 else
	 return true
	}
	//-->

</script>

<form method="post" name="note" action="reserva_details.php#tab2" onsubmit="return validate()">
	<p><textarea style="border: 1px solid  #F60; background-color: #fde1bf" name="comment" cols="100" rows="5" required="required"></textarea></p>

     <div style="float:left; margin-right:30px;background-color:#fff;padding:3px;border: 1px solid  #F60;">
     <input type="radio" name="tipo" value="0" checked="checked" onclick="setVisibility('complaint_list', 'none');"/>Normal Note&nbsp;
	 
	 
		<input type="radio" name="tipo" value="3" style="padding-left:10px; margin-left:10px;" onclick="setVisibility('complaint_list', 'inline');"/>Complaint Note
		
		<!--<span style="display:none;" id="complaint_list">
		<select name="complaint" style="margin-left:30px; text-align:left; " >
			<?php
			$options=tickets_subjects();
			foreach($options as $k=>$v){
				echo "<option value=\"$k\">$v</option>";
			}
			?>
		</select>
			<span style="color:blue;">Ticket?<input type="radio" name="ticket" value="1" checked="checked">yes<input type="radio" name="ticket" value="2">no</span>
		</span>-->
		<? if($_SESSION['info']['manager']==1){?>
			<input type="radio" name="tipo" value="2" />Manager Note&nbsp;
		<?}?>
		
	 </div>

    <input type="hidden" name="idreserva" value="<?=$_GET['id']?>" />
    <input type="hidden" name="villa" value="<?=$ocupabilidad['villa']?>" />

	<p><input class="book_but" type="submit" name="save" value="Submit" /></p>
</form>
 <hr/>
<?php
// $link=new getQueries (); //connect and make a query - Ej. get info from a ref number
 if($_POST){
	  //if trim post commentario no esta vacio entonces lo guardda
	  //echo "postearon";

      /*
	  $busy=$link->see_occupancy_id($_GET['id']);
	  $ocupabilidad=$busy[0];*/
  /*   if(trim($_POST['comment'])!=''){ //solo inserta el comentario si la caja no esta vacia
      $db= new DB();
      $fecha=date("Y-m-d G:i:s");
	  $insert_comment=$db->insert_comments($ocupabilidad['ref'],$_POST['comment'],'1',$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha);
     }*///finaliza si de insertar comentario
 }

 //=======================DELETE COMMENT OR UPDATED IT TO DELETED=======================================
   //only allow to manager if the note is not a manager note


 //=======================DELETE COMMENT OR UPDATED IT TO DELETED=======================================

 #$booking_comment=$link->show_any_data($table='comments', $field='ref', $value=$ocupabilidad['ref'], $operator='=');
  /*
 if( $booking_comment){
    ?>
 	<h3 style="font-size:11px; text-transform:uppercase; font-weight:bold; padding:0; margin:0;">comments made for booking <?=$ocupabilidad['ref']?></h3>
    <?
    $x=0;

	 foreach($booking_comment AS $k){
	 	 //dar la oportunidad de borrar la nota al manager only
         $data= new DB(); $made=$data->getUserDetails($k['id_adm']);
         if($x==1){ $color="#ffffff;";}else{$color="#e2eefd;";}
      if($k['deleted']!=1){//si la nota no esta borrada
	    if($made[0]['manager']==1){$color_user="red;";}else{ $color_user="#3B5998;";}
	 	?>
	 	<div style="background-color:<?=$color?> padding:0; margin:0;">
	 		<div style="float:left; font-weight:bold; padding-right:30px; color:<?=$color_user?> direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; line-height: 1.28;  text-align: left;">
	 		<?=$made[0]['name']?> <?=$made[0]['lastname']?> (<?=$made[0]['user']?>)
	 		</div>
	 		<div style="float:left;color: #AAAAAA; font-weight:bold;   cursor: default;  display: inline-block;  vertical-align: top;  direction: ltr;  font-family: lucida grande,tahoma,verdana,arial,sans-serif;  font-size: 11px;  line-height: 1.28; text-align: left;">
	 		<?=date("d M Y - g:i:s A",strtotime($k['fecha']))?>
	 		</div>
	 	    <p style="clear:both;line-height: 14px; word-wrap: break-word; color: #333333; direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; text-align: left; margin-bottom:0;">
	 	    <?=$k['comment'];?>

	 	    </p>
	 	</div>
	 <?
	  if ($x==0){$x++;} elseif ($x==1){$x--;}
	  }//termina condicional si la nota no esta borrada
	 }


 }else{
 	echo "<h2 style=\"color:blue;\">There is not comments for booking ".$ocupabilidad['ref']."</h2>";

 }  */

	//-----------------------------------------------------------------------------CHECK OUT--------------------------------

       /*echo "checkout";
       echo "<pre>";
       print_r($chout_info);
       echo "</pre>";*/

                 if($chout_info){
                 	$color="#edebeb;"; $color_date="black;"; $color_user="black;";
                  	$data= new DB(); $made=$data->getUserDetails($chout_info[0]['id_adm']);

                   $fecha_y_hora=$chout_info[0]['fecha'];

			 	?>
					 	<div  class="row" style="background-color:<?=$color?> padding:0; margin:0;border-bottom: 1px solid  #cecccc;">
					 		<div style="float:left; font-weight:bold; padding-right:30px; color:<?=$color_user?>  direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; line-height: 1.28;  text-align: left;">
					 		BOOKING SYSTEM - <?=$made[0]['name']?> <!--//<?=$made[0]['lastname']?> (<?=$made[0]['user']?>)//-->
					 		</div>
					 		<div class="row" style="float:left;color:<?=$color_date?>  font-weight:bold;   cursor: default;  display: inline-block;  vertical-align: top;  direction: ltr;  font-family: lucida grande,tahoma,verdana,arial,sans-serif;  font-size: 11px;  line-height: 1.28; text-align: left;">
					 		<?=date("d M Y - g:i:s A",strtotime($fecha_y_hora))?>
					 		</div>

                                <p style="clear:both;line-height: 14px; word-wrap: break-word; color:<?=$color_note?>   direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; text-align: left; margin-bottom:0;">
                                CHECKED OUT
                          </p>
					 	    <p style="margin:0; padding:0;">&nbsp;</p>
					 	</div>
					   <?
					    if ($x==0){$x++;} elseif ($x==1){$x--;}
				}
	//------------------------------------------------------------------------------CHECK IN-----------------------------------

      /* echo "checkin";
       echo "<pre>";
       print_r($ckin_info);
       echo "</pre>";  */
         if($ckin_info){
                 	$color="#edebeb;"; $color_date="black;"; $color_user="black;";
                  	$data= new DB(); $made=$data->getUserDetails($ckin_info[0]['id_adm']);

                   $fecha_y_hora=$ckin_info[0]['fecha'];

			 	?>
					 	<div  class="row" style="background-color:<?=$color?> padding:0; margin:0;border-bottom: 1px solid  #cecccc;">
					 		<div style="float:left; font-weight:bold; padding-right:30px; color:<?=$color_user?>  direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; line-height: 1.28;  text-align: left;">
					 		BOOKING SYSTEM - <?=$made[0]['name']?> <!--//<?=$made[0]['lastname']?> (<?=$made[0]['user']?>)//-->
					 		</div>
					 		<div class="row" style="float:left;color:<?=$color_date?>  font-weight:bold;   cursor: default;  display: inline-block;  vertical-align: top;  direction: ltr;  font-family: lucida grande,tahoma,verdana,arial,sans-serif;  font-size: 11px;  line-height: 1.28; text-align: left;">
					 		<?=date("d M Y - g:i:s A",strtotime($fecha_y_hora))?>
					 		</div>

                                <p style="clear:both;line-height: 14px; word-wrap: break-word; color:<?=$color_note?>   direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; text-align: left; margin-bottom:0;">
                                CHECKED IN
                          </p>
					 	    <p style="margin:0; padding:0;">&nbsp;</p>
					 	</div>
					   <?
					    if ($x==0){$x++;} elseif ($x==1){$x--;}
		 }
  /*======================NEW COMMENTS SYSTEM=================================================*/
             $booking_comment=$link->show_any_data($table='comments', $field='ref', $value=$ocupabilidad['ref'], $operator='=');

			 if( $booking_comment){
			 	//echo "comments made for booking ".$ocupabilidad['ref']."<br/>";
				 foreach($booking_comment AS $k){
				 	 //solo presentar las notas si no estan borradas
				 	 //dar la oportunidad de borrar la nota al manager only
				 	 //poder poner la nota como manager y estas no se pueden borrar
			         $data= new DB(); $made=$data->getUserDetails($k['id_adm']);
			         if($x==1){ $color="#ffffff;";}else{$color="#e2eefd;";}

			      if($k['deleted']!=1){/*si la nota no esta borrada*/
			      /* if($k['tipo']!=4){*//*BE SURE TO ONLY SHOW THE NOTES O COMMENTS THAT DON'T BELONG TO THE BOOKING SYSTEM CHANGES*/
			        if($k['tipo']==2){$color_user="red;"; $color_date="red;";}else{ $color_user="#3B5998;"; $color_date="#AAAAAA;";} //CHANGE THE COLOR TO USER AND DATE IF IT IS A MANAGER NOTE
			        if($k['tipo']==3){$color_note="black;"; $color="#ffc2c2;";$color_date="black;";$color_user="#black;";}else{ $color_note="#333333;";}  //CHANGE THE COLOR TO THE NOTE TEXT IF IT IS A COMPLAINT
			        if(($k['tipo']==4)||($k['tipo']==5)){$color="#edebeb;"; $color_date="black;"; $color_user="black;";}/*NOTA DE SYSTEMA*/
			        if($k['tipo']==4){
			        		$cam=$cambios_en_booking[$k['id_reserve_mod']];  unset($cambios_en_booking[$k['id_reserve_mod']]);/*take this element off from the array (make a pull [as there is not array_pull])*/
			        		unset($cam['user']); unset($cam['fecha_y_hora']); //to return an array cam empty if no result found
			        }

			        if((!empty($cam))||($k['tipo']!=4)){//if no found changes on this change do not show the change made
				 	?>
				 	<div  class="row" style="background-color:<?=$color?> padding:0; margin:0;border-bottom: 1px solid  #cecccc;">
				 		<div style="float:left; font-weight:bold; padding-right:30px; color:<?=$color_user?>  direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; line-height: 1.28;  text-align: left;">
				 		<? if($k['tipo']==4){ echo "BOOKING SYSTEM - "; } ?>
                         <? switch($k['tipo']){
				 			case 2: //mean that it is a manager note
				 					echo "MANAGER NOTE - ";
				 					break;
				 			case 3: //complaint note
				 					echo "COMPLAINT NOTE - ";
				 					break;
				 			case 5: //booking system note (information sent to client)
				 					echo "BOOKING SYSTEM - ";
				 					break;
				 		}?>

				 		<?=$made[0]['name']?> <!--//<?=$made[0]['lastname']?> (<?=$made[0]['user']?>)//-->
				 		</div>
				 		<div class="row" style="float:left;color:<?=$color_date?>  font-weight:bold;   cursor: default;  display: inline-block;  vertical-align: top;  direction: ltr;  font-family: lucida grande,tahoma,verdana,arial,sans-serif;  font-size: 11px;  line-height: 1.28; text-align: left;">
				 		<?=date("d M Y - g:i:s A",strtotime($k['fecha']))?>
				 		</div>
				 		<? /*if(($k['tipo']!=5)&&($k['tipo']!=4)){?>
					 		<? if($_SESSION['info']['manager']==1){?>
					 			<span class="delete"><a href="reserva_details.php?del_note=<?=$k['id']?>&id=<?=$_GET['id']?>"><img src="images/DeleteGray.png" alt="Delete" width="10" height="10" border="0"/></a></span>
					 		<?}//ONLY DELETE NOTE IF THE USER IS THE MANAGER
					 		?>
				 		<?}*/?>
				 	   <p  style="clear:both;line-height: 14px; word-wrap: break-word; color:<?=$color_note?>   direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; text-align: left; margin-bottom:0;">              <? if($k['tipo']==5){/*if it is not a booking sent info note*/?>
				 	         <span > BOOKING INFORMATION SENT TO CLIENT</span>
                       <?}elseif(($k['tipo']==4)){

                             //	if($cam['user'])	echo $cam['user'];
							 	//if($cam['fecha_y_hora'])	echo $cam['fecha_y_hora'];
							 	if($cam['villa'])	echo $cam['villa'];
							 	if($cam['deposit'])	echo $cam['deposit'];
							 	if($cam['dates'])	echo $cam['dates'];
							 	if($cam['status'])	echo $cam['status'];
							 	if($cam['priceLS'])	echo $cam['priceLS'];
							 	if($cam['priceHS'])	echo $cam['priceHS'];
							 	if($cam['client'])	echo $cam['client'];
							 	if($cam['adults'])	echo $cam['adults'];
							 	if($cam['kids'])	echo $cam['kids'];
							 	if($cam['gente'])	echo $cam['gente'];
							 	if($cam['gente_names'])	echo $cam['gente_names'];
							 	if($cam['qty_service'])	echo $cam['qty_service'];
							 	if($cam['services_chg'])	echo $cam['services_chg'];
							 	if($cam['qty_exc'])	echo $cam['qty_exc'];
							 	if($cam['exc_chg'])	echo $cam['exc_chg'];
							 	if($cam['vehicles'])	echo $cam['vehicles'];
                                //echo "<pre>"; print_r($cam); echo "</pre>";
                       }else{?>
                             <?=$k['comment'];?>
                       <?}?>
				 	    </p>
				 	    <p style="margin:0; padding:0;">&nbsp;</p>
				 	</div>
				   <?
				    if ($x==0){$x++;} elseif ($x==1){$x--;}
				    }
				  }/*termina condicional si la nota no esta borrada*/
				 }
			 }
		 /*======================NEW COMMENTS SYSTEM=================================================*/

		 //===================PRESENTANDO CAMBIOS VIEJOS PARA LOS BOOKINGS AQUI========================================



        if($cambios_en_booking){
          $cambios_en_booking=array_reverse($cambios_en_booking);//change the order of the array (last will be the first and the first will be last)
             //print_r($cambios_en_booking);
			 foreach($cambios_en_booking as $cam){

			 	/*if($cam['user'])	echo $cam['user'];
			 	if($cam['fecha_y_hora'])	echo $cam['fecha_y_hora'];
			 	if($cam['villa'])	echo $cam['villa'];
			 	if($cam['deposit'])	echo $cam['deposit'];
			 	if($cam['dates'])	echo $cam['dates'];
			 	if($cam['status'])	echo $cam['status'];
			 	if($cam['priceLS'])	echo $cam['priceLS'];
			 	if($cam['priceHS'])	echo $cam['priceHS'];
			 	if($cam['client'])	echo $cam['client'];
			 	if($cam['adults'])	echo $cam['adults'];
			 	if($cam['kids'])	echo $cam['kids'];*/
			 	//echo "<br/>";
			 	//echo "<hr/>";
                  $color="#edebeb;"; $color_date="black;"; $color_user="black;";
                   $data= new DB(); $made=$data->getUserDetails($cam['user']);

                   $fecha_y_hora=$cam['fecha_y_hora'];
                   unset($cam['user']); unset($cam['fecha_y_hora']); //quitar estos dos elementos del arreglos para si no hay mas no presentar el cambio
              if($cam){
			 	?>
					 	<div  class="row" style="background-color:<?=$color?> padding:0; margin:0;border-bottom: 1px solid  #cecccc;">
					 		<div style="float:left; font-weight:bold; padding-right:30px; color:<?=$color_user?>  direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; line-height: 1.28;  text-align: left;">
					 		BOOKING SYSTEM - <?=$made[0]['name']?> <!--//<?=$made[0]['lastname']?> (<?=$made[0]['user']?>)//-->
					 		</div>
					 		<div class="row" style="float:left;color:<?=$color_date?>  font-weight:bold;   cursor: default;  display: inline-block;  vertical-align: top;  direction: ltr;  font-family: lucida grande,tahoma,verdana,arial,sans-serif;  font-size: 11px;  line-height: 1.28; text-align: left;">
					 		<?=$fecha_y_hora?>
					 		</div>
					 		<? /*if(($k['tipo']!=5)&&($k['tipo']!=4)){?>
						 		<? if($_SESSION['info']['manager']==1){?>
						 			<span class="delete"><a href="reserva_details.php?del_note=<?=$k['id']?>&id=<?=$_GET['id']?>"><img src="images/DeleteGray.png" alt="Delete" width="10" height="10" border="0"/></a></span>
						 		<?}//ONLY DELETE NOTE IF THE USER IS THE MANAGER
						 		?>
					 		<?}*/?>
                                <p style="clear:both;line-height: 14px; word-wrap: break-word; color:<?=$color_note?>   direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; text-align: left; margin-bottom:0;">
                                 <?
	                             #	if($cam['user'])	echo $cam['user'];
								 	#if($cam['fecha_y_hora'])	echo $cam['fecha_y_hora'];
								 	if($cam['villa'])	echo $cam['villa'];
								 	if($cam['deposit'])	echo $cam['deposit'];
								 	if($cam['dates'])	echo $cam['dates'];
								 	if($cam['status'])	echo $cam['status'];
								 	if($cam['priceLS'])	echo $cam['priceLS'];
								 	if($cam['priceHS'])	echo $cam['priceHS'];
								 	if($cam['client'])	echo $cam['client'];
								 	if($cam['adults'])	echo $cam['adults'];
								 	if($cam['kids'])	echo $cam['kids'];
								 	if($cam['gente'])	echo $cam['gente'];
								 	if($cam['gente_names'])	echo $cam['gente_names'];
								 	if($cam['qty_service'])	echo $cam['qty_service'];
								 	if($cam['services_chg'])	echo $cam['services_chg'];
								 	if($cam['qty_exc'])	echo $cam['qty_exc'];
								 	if($cam['exc_chg'])	echo $cam['exc_chg'];
								 	if($cam['vehicles'])	echo $cam['vehicles'];
                                   // echo "<pre>"; print_r($cam); echo "</pre>";
	                      ?>
                          </p>
					 	    <p style="margin:0; padding:0;">&nbsp;</p>
					 	</div>
					   <?
					    if ($x==0){$x++;} elseif ($x==1){$x--;}
				}
			 }
         }
		 //=====================FIN DE PRESENTAR LOS CAMBIOS VIEJOS===================================
?>