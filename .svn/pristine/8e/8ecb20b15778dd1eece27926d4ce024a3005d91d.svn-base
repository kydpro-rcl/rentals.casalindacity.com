<?php
/********************************************************
GetExpressCheckoutDetails.php

This functionality is called after the buyer returns from
PayPal and has authorized the payment.

Displays the payer details returned by the
GetExpressCheckoutDetails response and calls
DoExpressCheckoutPayment.php to complete the payment
authorization.

Called by ReviewOrder.php.

Calls DoExpressCheckoutPayment.php and APIError.php.

********************************************************/

session_start();

/* Collect the necessary information to complete the
   authorization for the PayPal payment
   */

$_SESSION['token']=$_REQUEST['token'];
$_SESSION['payer_id'] = $_REQUEST['PayerID'];

$_SESSION['paymentAmount']=$_REQUEST['paymentAmount'];
$_SESSION['currCodeType']=$_REQUEST['currencyCodeType'];
$_SESSION['paymentType']=$_REQUEST['paymentType'];

$resArray=$_SESSION['reshash'];
$_SESSION['TotalAmount']= $resArray['AMT'] + $resArray['SHIPDISCAMT'];

/* Display the  API response back to the browser .
   If the response from PayPal was a success, display the response parameters
   */
if($_SESSION['villa_details']){
	$new_busy=check_villa_new($_SESSION['villa_details']['id'], $_SESSION['desde'], $_SESSION['hasta']);/*check if this villa is available*/
	 $cant_new=count($new_busy);
	if(!$cant_new>0){/*if villa is available*/
		$link=new DB;
		$saved_tk=$link->checkTokenDetails($tk=$_SESSION['token']);
		if(!$saved_tk){
				$saveDetails=$link->paypalDetails($tk=$_SESSION['token'], $data=json_encode($resArray));
		}
		//Presentar resumen de orden y boton de pago aqui
		?>
		<html>
		<head>
			<title>Residencial Casa Linda www.CasaLindaCity.com</title>
			<link href="sdk.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
		<div class="cuerpo">
		<center>
			<font size=2 color=black face=Verdana><b><span style="text-transform:uppercase;">Order Review</span></b></font>
			<br><br></center>
			<form action="DoExpressCheckoutPayment.php" method="POST">
			 <center>
				   <table width ="100%">			
				<?php 
					/*require_once 'ShowAllResponse.php';*/
					require_once 'order_review.php';
				 ?>
				  <!--<tr>
						<td><b>Order Total:</b></td>
						<td>
						  <?php  echo $_REQUEST['currencyCodeType'];   echo $resArray['AMT'] ?></td>
					</tr>-->
					<tr>
						<td class="thinfield">
							<p style="text-align:right; margin-right:50px;">
							 <input type="submit" value="Pay Now" class="boton" />
							 </p>
							 
							 <p style="text-align:right; margin-right:50px;">
							 <input class="boton" style="background-color:grey;" type="button" name="Cancel" value="Cancel" onclick="window.location = 'http://casalindacity.com' " />
							 </p>
							 
							 
						</td>
					</tr>
				</table>
			</center>
			</form>
		<?/* echo "session villas"; echo $_SESSION['villa'];*/?>
		 </div> 
		</body>
		</html>

		<?
	}else{
	?>
	<html>
		<head>
			<title>Residencial Casa Linda www.CasaLindaCity.com</title>
			<link href="sdk.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
		<div class="cuerpo">
	<?
		new_booking_busy_error($_SESSION['desde'], $_SESSION['hasta'], $link="../availability_result.php");/*get error if villa is not available*/
		//presentar este error en cuerpo html
		?>
		 </div> 
		</body>
		</html>
		<?
	}
	
 }else{
	?>
	<html>
		<head>
			<title>Residencial Casa Linda www.CasaLindaCity.com</title>
			<link href="sdk.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
		<div class="cuerpo">
		<p> Error no villa Selected; to try again, please <a href="../m.availability.php" alt="click to return">Click Here</a>
		 </div> 
		</body>
		</html>
		<?
 }
?>



