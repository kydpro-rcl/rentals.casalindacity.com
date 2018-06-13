<? if($_GET['ref']){$_POST['ref']=$_GET['ref'];}?>
<!--rent invoice / service invoice-->

<p class="header">Printing Invoice</p>
<hr />
<table align="center"><tr><td>
<fieldset><legend>Booking</legend>
<form method="post" name="" action="invoices.php" target="_self" >
<p id="fields" align="right" style="padding-right:5px">Reserve Reference No.: <input type="tex" name="ref" value="<?=$_POST['ref']?>" /></p>
<p align="right" style="padding-right:5px"><input class="book_but" type="submit" name="search" value="Go" /></p>
</form></fieldset>
</td></tr>
<tr><td><p style="color:red; font-weight:bold; font-size:12px; text-align:center"><?=$_GET['error']?></p></td></tr>
</table>

<!--// customers_invoices_print.php//-->

	<? if (( $_POST['search']=="Go")||($_GET['ref'])){
			
			$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
            //echo $_POST['ref'];
			$db=new getQueries();
			$busy_details=$db->see_occupancy_ref($_POST['ref']);
			$customer_info=$db->customer($busy_details[0]['client']);

			$villa_reserva=$db->villa($busy_details[0]['villa']);
			// echo $busy_details[0]['client'];
			 if ($busy_details){
			
			       switch ($busy_details[0]['status']){
			  
			       	case 1:		if($busy_details[0]['line']==3){$bookingEstado=1; }else{$bookingEstado=2; }	break;//short or apollo
						case 2:		if($busy_details[0]['line']==3){$bookingEstado=1; }else{$bookingEstado=2; }	break;
						case 3:		if($busy_details[0]['line']==3){$bookingEstado=1; }else{$bookingEstado=2; }	break;
						case 4:		if($busy_details[0]['line']==3){$bookingEstado=1; }else{$bookingEstado=2; }	break;
						
						case 8:		$bookingEstado=3;   break;//long
						case 9:		$bookingEstado=3; 	break;
						case 10:	$bookingEstado=3; 	break;
						case 11:	$bookingEstado=3; 	break;
						
						case 6:		$bookingEstado=2; 	break;//vip short
						case 12:	$bookingEstado=2; 	break;
						case 13:	$bookingEstado=2; 	break;
						case 14:	$bookingEstado=2; 	break;
						
						
						case 15:	$bookingEstado=3; 	break;//vip long
						case 16:	$bookingEstado=3; 	break;
						case 17:	$bookingEstado=3; 	break;
						case 18:	$bookingEstado=3; 	break;
						
						case 7:		$bookingEstado=2; 	break;//owner short
						case 19:	$bookingEstado=2; 	break;
						case 20:	$bookingEstado=2; 	;break;
						case 21:	$bookingEstado=2; 	break;
						
						case 22:	$bookingEstado=3; 	break;//owner long
						case 23:	$bookingEstado=3; 	break;
						case 24:	$bookingEstado=3; 	break;
						case 25:	$bookingEstado=3; 	break;
						
						case 26:  $bookingEstado=4; 	break;//buyer long
						case 27:  $bookingEstado=4; 	break;
						case 28:  $bookingEstado=4; 	break;
						case 29:  $bookingEstado=4; 	break;
						
						case 30:  $bookingEstado=4; 	break;//buyer short
						case 31:  $bookingEstado=4; 	break;
						case 32:  $bookingEstado=4; 	break;
						case 33:  $bookingEstado=4; 	break;
						
						default: $bookingEstado=2; break;
			       } 
				   
				   switch($bookingEstado){
						case 1: $urlGo='invoiceApollo.php';break;//apollo
						case 2: $urlGo='invoiceShort.php';break;//short
						case 3: $urlGo='invoices_long.php';break;//long
						case 4: $urlGo='invoices_buyer.php';break;//buyer
						//case 5: $urlGo='invoice_owners.php';break;//owners short
						//case 2: $urlGo='invoice_owners.php';break;//
						default:$urlGo='invoiceShort.php';break;//default short
				   }
				   $estados=true;
				   
				   if($estados==true){
				   ?>
				   <form action="<?=$urlGo;?>" method="post" id="dateForm">
					<input name="ref" type="hidden" value="<?=$_POST['ref']?>" />
					<!--<input name="to" type="hidden" value="2">-->
					<!--<input type="submit">-->
				   </form>

					<script type="text/javascript">
						document.getElementById('dateForm').submit(); // SUBMIT FORM
					</script>
				   <?
				   }
				   ?>
			
	        <?  }else{
	        	echo "<p style='text-align:center; color:red; background-color:yellow;'>We sorry, No booking found.</p>" ;
	        }
	}
	?>

