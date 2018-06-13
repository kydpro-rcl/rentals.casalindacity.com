<?php
 if ($_POST['new_client']=="Continue booking"){ //if booking details have been post
	if (!$_SESSION['customer']){
		$_SESSION['C']['n']=$_POST['name'];
		$_SESSION['C']['ln']=$_POST['lastname'];
		$_SESSION['C']['p']=$_POST['passport'];
		$_SESSION['C']['c']=$_POST['cedula'];
		$_SESSION['C']['el']=$_POST['email'];
		$_SESSION['C']['ph']=$_POST['phone'];
		$_SESSION['C']['ph2']=$_POST['phone2'];
		$_SESSION['C']['fx']=$_POST['fax'];
		$_SESSION['C']['lg']=$_POST['language'];
		$_SESSION['C']['ad']=$_POST['address'];
		$_SESSION['C']['zp']=$_POST['zip'];
		$_SESSION['C']['cy']=$_POST['country'];
		$_SESSION['C']['pa']=$_POST['password'];
		$_SESSION['C']['ha']=$_POST['hear_about'];
		$_SESSION['C']['rn']=$_POST['referal_name'];
		$_SESSION['C']['ne']=$_POST['name_emerg'];
		$_SESSION['C']['phe']=$_POST['phone_emerg'];

		//-------------------------------------------
		$_SESSION['C']['state']=$_POST['state'];
		$_SESSION['C']['city']=$_POST['city'];
	}
	$_SESSION['C']['a']=$_POST['adults'];
	$_SESSION['C']['k']=$_POST['kids'];
// $_SESSION['total'];
 }
 if ($_SESSION['C']['n']) $_POST['name']=$_SESSION['C']['n'];
 if ($_SESSION['C']['ln']) $_POST['lastname']=$_SESSION['C']['ln'];
 if ($_SESSION['C']['el']) $_POST['email']=$_SESSION['C']['el'];

// $_POST['adults'];
?>
<h3 style="color:#06F; text-align:center;">Last booking details</h3>
<hr/>
<table width="90%" align="center">
	<tr>
        <td width="50%">
        <span style="font-weight:bold;">CUSTOMER:</span><br/>
        <?if (!$_SESSION['customer']){ ?>
	        <?=$_POST['name']?> <?=$_POST['lastname']?><br/>
	        <?=$_POST['email']?><br/>
	        <?=$_POST['phone']?><br/>
	        <?=$_POST['address']?><br/>
       <? }else{?>	        <?=utf8_decode($_SESSION['customer']['name'])?> <?=utf8_decode($_SESSION['customer']['lastname'])?><br/>
	        <?=$_SESSION['customer']['email']?><br/>
	        <?=$_SESSION['customer']['phone']?><br/>
	        <?=utf8_decode($_SESSION['customer']['address'])?><br/>       <? } ?>
        </td>
        <td>
        <span style="font-weight:bold;">BOOKING DETAILS:</span><br/>
        Villa No:<?=$_SESSION['villa_details']['no']?><br/>
        From: <?=formatear_fecha($_SESSION['desde'])?> <br/>
        To: <?=formatear_fecha($_SESSION['hasta'])?><br/>
        <?=$_POST['adults']?> adults <br/>
        <?=$_POST['kids']?> children<br/>

        </td>
	</tr>
</table>
<p>&nbsp;</p>
<table width="90%" align="center">
	<tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
        <span style="color:#06F; font-weight:bold;">ORDER DETAILS:</span>
        </td>
     </tr>
     <tr>
        <td align="right" >
        Low Season nights <?=$_SESSION['noches_LS']?> x US$ <?=number_format($_SESSION['villa_details']['p_low'],2)?> = <br/>
        High Season nights <?=$_SESSION['noches_HS']?> x US$ <?=number_format($_SESSION['villa_details']['p_high'],2)?> =<br/>
        <span style="font-weight:bold;">Sub-Total =</span><br/>
        VAT-TAX 16% =<br/>
         <span style="font-weight:bold;">TOTAL =</span>
         <?
          $total_ls=($_SESSION['noches_LS']*$_SESSION['villa_details']['p_low']);
		  $total_hs=($_SESSION['noches_HS']*$_SESSION['villa_details']['p_high']);
		 ?>
        </td>
        <td align="right" width="105px">
        US$ <?=number_format($total_ls,2)?><br/>
        US$ <?=number_format($total_hs,2)?><br/>
        <span style="font-weight:bold;">
        US$ <? echo number_format(($total_ls+$total_hs),2); ?><br/>
        </span>

		US$ <?=number_format($_SESSION['itbis'],2)?><br/>
		<span style="font-weight:bold;">
        US$ <?=number_format($_SESSION['total'],2)?>
        </span>

        </td>
	</tr>
</table>
<hr/>
<p style="color:red">Due to security reasons, please type the first and last names of all guests occupying the villa.</p>
<form action="booking_confirm.php" method="post" >
    <fieldset id="fieldsets"><legend id="legends"> <?=$_POST['adults']?>Adults Names </legend>
          <?
          if ($_SESSION['C']['a']){          	$_POST['adults']=$_SESSION['C']['a'];
          }

          for ($i=1; $i<=$_POST['adults'];$i++){

               if ($i==1){
                  //$custom=new getQueries; $client_name=$custom->customer($client); //$cm=$client_name['name']." ".$client_name['lastname'];
                    ?>
                     <?if (!$_SESSION['customer']){ ?>
                    	<p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">(<?=$i;?>) Name: <input type="text" size="25" name="a_name<?=$i;?>" value="<?=$_POST['name']?>" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=$_POST['lastname'];?>" /></p>
                    <?}else{ ?>                    	<p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">(<?=$i;?>) Name: <input type="text" size="25" name="a_name<?=$i;?>" value="<?=utf8_decode($_SESSION['customer']['name'])?>" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=utf8_decode($_SESSION['customer']['lastname']);?>" /></p>
                    <?}?>
              <? }else{  ?>
                   <p style="text-align:center;  padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
                   (<?=$i;?>) Name: <input type="text" size="25" name="a_name<?=$i;?>" value="" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="" /></p>
              <?  } ?>
           <?} ?>
              </fieldset><br>

              <? if($_POST['kids']>0){?>
                   <fieldset id="fieldsets"><legend id="legends"> <?=$_POST['kids']?> Children Names </legend>
                  <? for ($i=1; $i<=$_POST['kids'];$i++){?>
                       <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
                        (<?=$i;?>) Name: <input type="text" size="25" name="c_name<?=$i;?>" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="c_lastname<?=$i;?>" />
                       </p>
                  <? }  ?>
                </fieldset>
              <? }?>
<p style="text-align:right; padding-right:12px;"><input id="boton" type="submit" name="confirm" value="Confirm Booking" onClick="return confirmSubmitText('Even if you do not have a paypal account you can pay with your debit or credit card. \n Are you sure you want to continue, payment will be apply?');"/></p>
</form>