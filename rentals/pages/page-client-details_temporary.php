<?php
$db=new getQueries ();
/*if ($_POST['continue']){*/
	/*echo "hola";*/
	if($_POST){
		unset($_SESSION['total']); $_SESSION['total']=$_POST['g_total'];
		unset($_SESSION['desde']); $_SESSION['desde']=$_POST['desde'];
		unset($_SESSION['hasta']); $_SESSION['hasta']=$_POST['hasta'];
		unset($_SESSION['total_noches']); $_SESSION['total_noches']=$_POST['T_nights'];
		unset($_SESSION['noches_LS']); $_SESSION['noches_LS']=$_POST['LS_nights'];
		unset($_SESSION['noches_HS']); $_SESSION['noches_HS']=$_POST['HS_nights'];
		unset($_SESSION['price_LS']); $_SESSION['price_LS']=$_POST['LS_price'];
		unset($_SESSION['price_HS']); $_SESSION['price_HS']=$_POST['HS_price'];
		unset($_SESSION['itbis']);$_SESSION['itbis']=$_POST['itbis'];
		unset($_SESSION['villa']); $_SESSION['villa']=$_POST['v'];
	}
	if($_POST['agent']!=''){
		unset($_SESSION['agent_id']); $_SESSION['agent_id']=$_POST['agent'];
	}
	unset($_SESSION['villa_details']);
		$informacion_villa=$db->villa($_SESSION['villa']);
		$_SESSION['villa_details']=$informacion_villa[0];
/*}*/

?>

<div class="container">
  <h3 style="color:#06F; text-align:center;">BOOKING DETAILS:<br/>
    <span style="color:#cc1c0a; text-transform:uppercase;">Villa No.
    <?=$_SESSION['villa_details']['no']?>
    (
    <?=$_SESSION['villa_details']['bed']?>
    Bedrooms)</span><br/>
    From: <span style="color:#cc1c0a; text-transform:uppercase;">
    <?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['desde'])))?>
    </span> To: <span style="color:#cc1c0a; text-transform:uppercase;">
    <?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['hasta'])))?>
    </span></h3>
  <hr style="border: 1px solid #9c0000;"/>
  <p>&nbsp;</p>
  <?PHP
  if($_SESSION['error']){?>
  <div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span><?php if(!$_SESSION['error']['blacklisted']){?> Change a few things up and try submitting again.<?php }else{?>
  Dear client, unfortunately you have been blacklisted in our system due to previous stays or other reasons. 
If you feel that this may be faulty please contact our staff at reception@casalindacity.com or call +1 8095711190
  <?php }?>
  </div>
 <?PHP }?>
  
   <div class="row">
		<div class="col-md-12"><h4>We are experiencing some difficulties when booking at the moment, our staff is working on fixing this as quick as possible. Please to go through with your reservation contact us by phone on <strong>809-571-1190</strong> or by email <strong>reservations@casalindacity.com</strong></h4></div>
   </div>
   
   <div class="row">
		<div class="col-md-12"><h4>Estamos experimentando algunas dificultades en las reservas enlinea en estos momentos, nuestro personal esta trabajando para arreglar esto tan prondo como sea posible. Por favor haga su reservacion al contactarnos por telefono al <strong>809-571-1190</strong> o por correo <strong>reservations@casalindacity.com</strong></h4></div>
   </div>
</div>
