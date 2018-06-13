<?php
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

<form method="post" name="note" action="reserva_details.php#tab3" onsubmit="return validate()">
	<p><textarea style="border: 1px solid  #F60; background-color: #fde1bf" name="comment" cols="100" rows="5" required="required"></textarea></p>
    <? if($_SESSION['info']['manager']==1){?>
    <input type="radio" name="tipo" value="2" />Manager Note&nbsp;
    <?}?>
     <div style="float:right; margin-right:30px;background-color:red;padding:3px;border: 1px solid  #F60;">
		<input type="radio" name="tipo" value="3" style="padding-left:10px; margin-left:10px;" onclick="setVisibility('complaint_list', 'inline');"/><span style="color:white;">Complaint Note</span>
		<select name="complaint" style="margin-left:30px; text-align:left; display:none;" id="complaint_list">
			<option value="1">Internet connection</option>
			<option value="2">No Water</option>
			<option value="3">Hot Water</option>
			<option value="4">TV-Cable</option>
			<option value="5">Air Conditioning</option>
			<option value="6">Insects</option>
			<option value="7">Safe</option>
			<option value="8">Lights</option>
			<option value="9">Doors/Keys</option>
			<option value="10">Maid Service</option>
			<option value="11">Pool & Garden</option>
			<option value="12">Others</option>
		</select>
	 </div>

    <input type="hidden" name="idreserva" value="<?=$_GET['id']?>" />
    <input type="hidden" name="villa" value="<?=$ocupabilidad['villa']?>" />

	<p><input class="book_but" type="submit" name="save" value="Submit" /></p>
</form>

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
 if( $booking_comment){    ?> 	<h3 style="font-size:11px; text-transform:uppercase; font-weight:bold; padding:0; margin:0;">comments made for booking <?=$ocupabilidad['ref']?></h3>
    <?
    $x=0;

	 foreach($booking_comment AS $k){	 	 //dar la oportunidad de borrar la nota al manager only
         $data= new DB(); $made=$data->getUserDetails($k['id_adm']);
         if($x==1){ $color="#ffffff;";}else{$color="#e2eefd;";}
      if($k['deleted']!=1){//si la nota no esta borrada
	    if($made[0]['manager']==1){$color_user="red;";}else{ $color_user="#3B5998;";}
	 	?>	 	<div style="background-color:<?=$color?> padding:0; margin:0;">
	 		<div style="float:left; font-weight:bold; padding-right:30px; color:<?=$color_user?> direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; line-height: 1.28;  text-align: left;">
	 		<?=$made[0]['name']?> <?=$made[0]['lastname']?> (<?=$made[0]['user']?>)
	 		</div>
	 		<div style="float:left;color: #AAAAAA; font-weight:bold;   cursor: default;  display: inline-block;  vertical-align: top;  direction: ltr;  font-family: lucida grande,tahoma,verdana,arial,sans-serif;  font-size: 11px;  line-height: 1.28; text-align: left;">
	 		<?=date("d M Y - g:i:s A",strtotime($k['fecha']))?>
	 		</div>
	 	    <p style="clear:both;line-height: 14px; word-wrap: break-word; color: #333333; direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; text-align: left; margin-bottom:0;">
	 	    <?=$k['comment'];?>

	 	    </p>
	 	</div>	 <?
	  if ($x==0){$x++;} elseif ($x==1){$x--;}
	  }//termina condicional si la nota no esta borrada
	 }


 }else{ 	echo "<h2 style=\"color:blue;\">There is not comments for booking ".$ocupabilidad['ref']."</h2>";
 }  */
?>