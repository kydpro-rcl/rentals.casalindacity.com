<? if ($_GET['ref']) $_POST['ref']=$_GET['ref'];?>

<script type="text/javascript" src="js/confirm.js"></script>
<script language="javascript" src="js/formfields.js"></script>
<script language="javascript" src="js/formvalidation.js"></script>
<h2 class="centro">Cancelling Bookings</h2>
<hr />

<?
if ($_POST['ref']==""){
	?>
    <p>&nbsp;</p>
	<div style="text-align:center; width:400px; margin:0 auto;" >
        <form name="cancel_book" method="post" action="cancel-booking.php">
       <p id="fields" style="text-align:left;"><span style="font-size:14px; color:#000000;"> Reference Number: <input type="text" name="ref" value="<?=$_POST['ref']?>" /></span> <input type="submit" name="go" value="Go" class="book_but"/></p>

        </form>
	</div>
	<?
}
if ($_POST['ref']!=""){
	$db= new getQueries();
	$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
	$result=$db->see_occupancy_ref_no_zero($_POST['ref']);
	//$total_records=$db->getAffectedRows();

		if ($result){
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";*/
	?>
	<div class="book_inserted1" style="padding:7px 0px 12px 0px;">
   		<p>Reference: <?=$_POST['ref']?></p>
        <p class="bloques">Villa No.:<span class="info_details"><? $villa=$db->villa($result[0]['villa']); echo $villa[0]['no'];?> </span></p>
        <p class="bloques">From: <span class="info_details"><?=formatear_fecha($result[0]['start'])?> </span></p>
        <p class="bloques">To: <span class="info_details"><?=formatear_fecha($result[0]['end'])?> </span></p>
        <p  style="clear:both;">Status:<span class="info_details">
			<?=booking_status($result[0]['status']);?>
          </span></p>			
	<?php
	$estado=$result[0]['status'];
	if (($estado==7)||($estado==19)||($estado==20)||($estado==21)||($estado==22)||($estado==23)||($estado==24)||($estado==25)){
		$owner=$db->show_id('owners', $result[0]['client']);   
		$correo=$owner[0]['email'];
		$who_tosend=$owner[0]['name'].' '.$owner[0]['lastname'];		   
		
	}else{
		if($result[0]['line']==4){/*not to send to the client*/
			/*referral info*/
			$agent_comision=$db->showTable_r($table='bookingreferred', $field='ref_book', $value=$result[0]['ref'], $operator='=');
			$agent=$db->showTable_r($table='commission', $field='id', $value=$agent_comision[0]['id_referal'], $operator='=');
			$who_tosend=$agent[0]['name']." ".$agent[0]['lastname'];
			$correo=$agent[0]['email'];
		}else{
			/*client info*/
			$cl=$db->customer($result[0]['client']);
			$correo=$cl['email'];
			$who_tosend=$cl['name'].' '.$cl['lastname'];
		}
	}
		$data=new subDB();
		$daysToStart=$data->daysDifference(date('Y-m-d',strtotime($result[0]['start'])),date('Y-m-d'));
		if($daysToStart>30){
			//CHARTE ONE NIGHT
			if($result[0]['NHS']>0){
				$price_one_night_without_taxes=$result[0]['PHS'];
			}else{
				$price_one_night_without_taxes=$result[0]['ppn'];
			}
			$cancellation_fee=($price_one_night_without_taxes*1.18);
		}elseif(($daysToStart<=30)&&($daysToStart>8)){
			//CHARGE 50 PERCENT
			$cancellation_fee=number_format(($result[0]['total']/2),2);
		}elseif(($daysToStart>=0)&&($daysToStart<=7)){
			//CHARGE 100 PERCENT
			$cancellation_fee=$result[0]['total'];
		}else{
			//CHARGE 100 PERCENT
			$cancellation_fee=$result[0]['total'];
		}
		$montoTotalPagado=$db->amountRef($result[0]['ref'],'1');/*paid*/
	?>
	<table align="center">
		<tr>
			<td>Name of client: <span style="font-weight:bold;text-decoration:underline;"><? echo $who_tosend;?></span></td>
			<td>Total Reservation: <span style="font-weight:bold;text-decoration:underline;"><? echo $result[0]['total'];?></span> USD</td>
		</tr>
		<tr>
			<td>Amount Paid: <span style="font-weight:bold;text-decoration:underline;"><?=$montoTotalPagado?></span> USD</td>
			<td>Cancellation Fee: <span style="font-weight:bold;text-decoration:underline;"><?=$cancellation_fee?></span> USD</td>
		</tr>
	</table>
     </div>

	 
	 
	 
	 
	 
	 
 <div style="text-align:center; width:400px; margin:0 auto;" >
    <form name="cancel_book" method="post" action="cancel-booking.php" onSubmit="return(check(this));"><!--return confirmSubmit();-->
    <div id="globalmsg" align="center"></div>
	

	
    <p id="fields" style="text-align:left;"><span style="font-size:14px; color:#000000;">Any Reasons:</span><br /> <textarea name="why" cols="50" rows="10" valtype="mandatory" valmsg="* reasons required" valgrp="contactfrm" ></textarea>&nbsp;<span
class="form_err" id="whym">*</span><br />
    <input type="hidden" name="ref" value="<?=$result[0]['ref']?>" />
    <input type="hidden" name="id_adm" value="<?=$_SESSION['info']['id']?>" />
    <input type="hidden" name="reserveid" value="<?=$result[0]['reserveid']?>" />
	
	
	
	<input type="hidden" name="gralamount" value="<?=$result[0]['total']?>" />
    <input type="hidden" name="can_fee" value="<?=$cancellation_fee?>" />
	<input type="hidden" name="name_lastname" value="<?=$who_tosend?>" />
    <input type="hidden" name="villa_no" value="<?=$villa[0]['no']?>" />
	<input type="hidden" name="qty_nights" value="<?=$result[0]['nights']?>" />
    <input type="hidden" name="start" value="<?=$result[0]['start']?>" />
	<input type="hidden" name="ending" value="<?=$result[0]['end']?>" />
	<input type="hidden" name="email" value="<?=$correo?>" />
	
	
	</p>
	
		<p style="text-align:left"><input type="checkbox" name="sendclient" value="2" checked="checked">Send cancellation info to client/referral. </p>
	
	
    <p><input type="submit" name="cancel" value="Cancel current booking" class="book_but" onClick="return confirmSubmitText('Are you sure you want to cancel this booking?');"/>&nbsp;<input type="button" name="back" value="Go back" class="book_but" onClick="history.go(-1)"/></p>
    </form>
   </div>
    <?
        }else{
            echo "<p>&nbsp;</p>";
            echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No Result Found</p>";
        }
}
?>