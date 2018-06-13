<? session_start();
if ($_SESSION['info']){
require_once('template/head.php');require_once('init.php');
//require_once('template/head.php');
//require_once('init.php');
?>
<img src="images/logo.gif" border="0" style="float:left"><br/>
 <form method="post" action="short_confirmation.php">
      <p>Step 3</p>
      <hr />
      <? /*echo  $_SESSION['info_villa']['no']."<br>"*/?>
    <? /*echo  $_SESSION['info']['name']."<br>"*/?>
   <table><tr><td width="270">
     <fieldset><legend>Adults Names</legend>
  <? for ($i=1; $i<=$adults;$i++){
       // if ($adults==1){
       if ($i==1){
          $custom=new getQueries; $client_name=$custom->customer($client); //$cm=$client_name['name']." ".$client_name['lastname'];
        	?>
        <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td"><?=$i;?> Name: <input type="text" size="7" name="a_name<?=$i;?>" value="<?=$client_name['name']?>" /> Last.: <input type="text" size="7" name="a_lastname<?=$i;?>" value="<?=$client_name['lastname'];?>" /></p>
      <? }else{  ?>
       <p style="text-align:right;  padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
       <?=$i;?> Name: <input type="text" size="7" name="a_name<?=$i;?>" value="" /> Last.: <input type="text" size="7" name="a_lastname<?=$i;?>" value="" /></p>
     <?  }
   } ?>
      </fieldset><br>

      <? if($children>0){?>
           <fieldset><legend>Children Names</legend>
          <?for ($i=1; $i<=$children;$i++){?>
           <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td"><?=$i;?> Name: <input type="text" size="7" name="c_name<?=$i;?>" value="" /> Last.: <input type="text" size="7" name="c_lastname<?=$i;?>" value="" /></p>
          <? }  ?>
        </fieldset>
      <? }?>
        <? if ($massage>0 || $pickup>0 || $VIPpickup>0 || $chef>0 || $fridge>0){?>
			   <fieldset><legend>Services Notes</legend>
			   <? if($massage>0){?>
				   <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Massage: <input type="text" name="massage_comment" value="" /></p>
			  <? }?>
              <? if($pickup>0){?>
				  <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Pickup: <input type="text" name="pickup_comment" value="" /></p>
			  <? }?>
              <? if($VIPpickup>0){?>
				  <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">VIP Pickup: <input type="text" name="VIPpickup_comment" value="" /></p>
			  <? }?>
              <? if($chef>0){?>
				   <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Chef: <input type="text" name="chef_comment" value="" /></p>
			  <? }?>
              <? if($fridge>0){?>
				 <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Filled Fridge: <input type="text" name="fridge_comment" value="" /></p>
			  <? }?>
              </fieldset>
           <? }?>
</td><td valign="top">
<!--EMPIEZO A MOSTRAR RESUMEN DE LAS INFORMACIONES SELECCIONADAS PARA LA RESERVA-->
<table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;"><tr><td colspan="2" bgcolor="#eeeeee">
Booking information</td></tr>
			<tr><td id="td" colspan="2">Booked Villa No.<strong><?=$villa_no?></strong><br /> Staying from <strong><?=formatear_fecha($starting);?></strong> to <strong><?=formatear_fecha($ending);?></strong></td></tr>
            <tr><td id="td" style="text-align:right;"><?=$nights?> Nights x US$ <?=$price;?> =</td><td id="td" width="90" style="text-align:right;"> <? $amount_nights=($nights*$price); echo "US$ ".number_format($amount_nights,2); ?></td></tr>
            <tr><td id="td" style="text-align:right;">VAT - 16% of <?=number_format($amount_nights,2);?> =</td><td id="td" style="text-align:right;"><? $itbis=($amount_nights*0.16); echo "US$ ".number_format($itbis,2); ?></td></tr>

            <tr><td id="td" style="text-align:right;"><strong>Sub total =</strong></td><td id="td" style="text-align:right;"><? $sub_total=($amount_nights+$itbis); echo "<strong>US$ ".number_format($sub_total,2)."</strong>";?></td></tr>


            <!--SERVICES ADDITIONALS-->
            <?  if ($massage>0 || $pickup>0 || $VIPpickup>0 || $chef>0 || $fridge>0){
				$result= new getQueries;
					if ($massage>0){
					//$result=$_SESSION['consultas'];
					$massage_details=$result->additional_service($massage, 'massage');
					?>
					<tr><td id="td" style="text-align:right; color:#00F;">Massage <?=$massage_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_massage=$massage_details['price']; echo $amount_massage; ?></td></tr>
                    <input type="hidden" name="massage_id" value="<?=$massage;?>" />
             		<input type="hidden" name="massage_amount" value="<?=$amount_massage;?>" />
					<? } ?>

					 <?
					if ($pickup>0){
					//$result= new getQueries;
					$pickup_details=$result->additional_service($pickup, 'Airport Pick Up');
					?>
					<tr><td id="td" style="text-align:right;  color:#00F;"><?=$pickup_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_pickup=$pickup_details['price']; echo $amount_pickup; ?></td></tr>
                    <input type="hidden" name="pickup_id" value="<?=$pickup;?>" />
             		<input type="hidden" name="pickup_amount" value="<?=$amount_pickup;?>" />
					<? } ?>

				 	<?
					if ($VIPpickup>0){
					//$result= new getQueries;
					$VIPpickup_details=$result->additional_service($VIPpickup, 'VIP Airport Pick Up');
					?>
					<tr><td id="td" style="text-align:right;  color:#00F;"><?=$VIPpickup_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_VIPpickup=$VIPpickup_details['price']; echo $amount_VIPpickup; ?></td></tr>
                    <input type="hidden" name="VIPpickup_id" value="<?=$VIPpickup;?>" />
             		<input type="hidden" name="VIPpickup_amount" value="<?=$amount_VIPpickup;?>" />
					<? } ?>

					 <?
					if ($chef>0){
					//	$result= new getQueries;
					$chef_details=$result->additional_service($chef, 'chef');
					?>
					<tr><td id="td" style="text-align:right;  color:#00F;"> <?=$chef_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_chef=$chef_details['price']; echo $amount_chef; ?></td></tr>
                    <input type="hidden" name="chef_id" value="<?=$chef;?>" />
             		<input type="hidden" name="chef_amount" value="<?=$amount_chef;?>" />
					<? } ?>

					<?
					if ($fridge>0){
					//$result= new getQueries;
					$fridge_details=$result->additional_service($fridge, 'Filled Fridge');
					?>
					<tr><td id="td" style="text-align:right;  color:#00F;">Filled Fridge <?=$fridge_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_fridge=$fridge_details['price']; echo $amount_fridge; ?></td></tr>
                    <input type="hidden" name="fridge_id" value="<?=$fridge;?>" />
             		<input type="hidden" name="fridge_amount" value="<?=$amount_fridge;?>" />
					<? }
					$sub_services=($amount_massage+$amount_fridge+$amount_chef+$amount_VIPpickup+$amount_pickup); ?>
                    <tr><td id="td" style="text-align:right;  color:#00F; font-weight:bold;">Total additionals services=</td><td id="td" style="text-align:right; color:#00F; font-weight:bold;">US$ <?=number_format($sub_services,2); ?></td></tr>
                    <input type="hidden" name="services_amount" value="<?=$sub_services;?>" />

		<?	}?>
            <!--SERVICES ADDITIONALS-->
            <tr><td id="td" style="text-align:right;"><strong>GENERAL AMOUNT = </strong></td><td id="td" style="text-align:right;"><? $general_amount=$sub_total+$sub_services; echo "<strong>US$ ".number_format($general_amount,2)."</strong>"; ?></td></tr></table>
                                        <hr />
           <table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;"><tr><td colspan="4" bgcolor="#eeeeee">Booking Details</td></tr>

			<tr><td  id="td"><strong>Adults:</strong></td><td id="td"><span style="color:#3b3838;"> <?=$adults?>  Person(s)</span> </td><td id="td"><strong>Chidrem:</strong></td><td id="td"><span style="color:#3b3838">  <?=$children?> kid(s)</span></td></tr>
            <? $db=new getQueries; $client_details=$db->customer($client);?>
   			  <tr><td id="td"> <strong>Customer:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['name']." ".$client_details['lastname'];?></span></td><td id="td"> <strong>Email:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['email'];?></span></td></tr>
              <? if ($client_details['phone']!=''){?>
               <tr><td id="td"><!--<br />--><strong> Phone:</strong></td><td colspan="3" id="td"><span style="color:#3b3838"> <?=$client_details['phone'];?></span></td></tr>
               <? }?>
               <? if ($client_details['address']!=''){?>
                <tr><td id="td"><!--<br />--><strong>Address:</strong></td><td colspan="3" id="td"><span style="color:#3b3838"><?=$client_details['address'].", ".$client_details['country'];?></span></td></tr>
               <? }?>
              <? if ($client_details['id_commission']>0){
				  $r=new getQueries; $intermediario=$r->intermediario($client_details['id_commission']);
				  ?>
				  <tr><td id="td"><!--<br />--><strong>Refered&nbsp;by:</strong></td><td colspan="3" id="td"> <span style="color:#3b3838;"><? echo $intermediario['name']." ".$intermediario['lastname']; echo "-".($intermediario['percent']*100)."%"?> </span></td></tr>
                  <? $total_comision=$amount_nights*$intermediario['percent']; ?>
                 <input type="hidden" name="amount_commision" value="<?=$total_comision;?>"/>
                  <? } ?>
               <? if ($comment!=''){?>
           <tr><td id="td" colspan="4"> <strong>Reserve's Comment:</strong><br /><span style="color:#3b3838;"> <?=wordwrap($comment, 75, "\n", true);?> </span><?}?></td></tr>
            <tr><td id="td" style="text-align:right"> <strong>Status: </strong></td><td id="td" nowrap="nowrap"><? //=$status
			switch ($status){
				case 1: echo "<span style='color:green;'>Checking in</span>"; break;
				case 2: echo "<span style='color:#00F;'>Confirmed</span>";
				        echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=000.00>";
						break;

				case 3: echo "<span style='color:#FF0000;'>Transit</span>";
						echo " - <span style='color:green;'>Deposit</span> <input type=text name=deposit size=5 value=000.00>";
						break;
			}
			?> </td><td id="td" style="text-align:right"><strong>Made by: </strong></td><td id="td"><span style="color:#3b3838;"><?=$_SESSION['info']['name']?></span></td></tr></table>
<!--TERMINO DE MOSTRAR RESUMEN DE LAS INFORMACIONES SELECCIONADAS PARA LA RESERVA-->
</td></tr></table>  <hr />
<!--campos que envian datos a la seccion final-->
<input type="hidden" name="id_villa" value="<?=$villa_id;?>" />
<input type="hidden" name="id_customer" value="<?=$client;?>" />
<input type="hidden" name="id_adm" value="<?=$_SESSION['info']['id'];?>" />
<input type="hidden" name="starting_date" value="<?=$starting;?>" />
<input type="hidden" name="ending_date" value="<?=$ending;?>" />
<input type="hidden" name="qty_nights" value="<?=$nights;?>" />
<input type="hidden" name="price_per_night" value="<?=$price;?>" />
<input type="hidden" name="amount_per_nights" value="<?=$amount_nights;?>" />
<input type="hidden" name="ITBIS" value="<?=$itbis;?>" />
<input type="hidden" name="sub_total_rent" value="<?=$sub_total;?>" />
<input type="hidden" name="general_amount" value="<?=$general_amount;?>" />

<? if ($children>0){?>
<input type="hidden" name="children_qty" value="<?=$children;?>" />
<?}?>
<input type="hidden" name="adults_qty" value="<?=$adults;?>" />
<? if ($client_details['id_commission']>0){?>
<input type="hidden" name="interm_id" value="<?=$client_details['id_commission'];?>" />
<?}?>

<input type="hidden" name="reserve_comment" value="<?=$comment;?>" />

<input type="hidden" name="status" value="<?=$status;?>" />

<!--campos que envian datos a la seccion final-->
    <INPUT class="book_but" TYPE="button" onClick="location.href='book.php?villa=<?=$villa_id?>&v2=<?=$villa_id?>&start=<?=$starting?>&end=<?=$ending?>&destine=regular'"  VALUE="Back" title="Hit to go back">
    <input class="book_but" type="submit" name="confirm" value="Done"  title="Save Reservation" /> <span style="font-size:10px; color: #06F; font-family:Arial, Helvetica, sans-serif;"><span style="color:red"><strong>WARNING!:</strong></span> Make sure that all information is correct before confirming reservation</span>
     <!-- <input class="submit" onmouseover="this.className='submitover'" onmouseout="this.className='submit'" type="submit" name="confirm" value="Done"  title="Save Reservation" />-->
      </form>

<? require_once('template/foot.php');

}else{
  die ("<html><head></head><body> <img src='https://casalindacity.com/images/logo.gif' style='clear:both;'/><br>You are not logged in,<br/>Please, <a href=\"../login.php\" target=\"_blank\">login</a> first.</body></html>");
 // echo ("<meta http-equiv=\"refresh\" content=\"0;url=../login.php\">");

  }
?>