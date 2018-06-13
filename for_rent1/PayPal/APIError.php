<?php
/*************************************************
APIError.php

Displays error parameters.

Called by DoDirectPaymentReceipt.php, TransactionDetails.php,
GetExpressCheckoutDetails.php and DoExpressCheckoutPayment.php.

*************************************************/

session_start();
$resArray=$_SESSION['reshash']; 
?>

<html>
<head>
<title>Reservation Error</title>
<link href="sdk.css" rel="stylesheet" type="text/css"/>
</head>

<body alink=#0000FF vlink=#0000FF>
<div class="cuerpo">
<center>

<table width="280">
<tr>
		<td colspan="2" class="header">&nbsp;</td>
	</tr>

<?php  //it will print if any URL errors 
	if(isset($_SESSION['curl_error_no'])) { 
			$errorCode= $_SESSION['curl_error_no'] ;
			$errorMessage=$_SESSION['curl_error_msg'] ;	
			session_unset();
?>

   
<!--<tr>
		<td>Error Number:</td>
		<td><?php echo $errorCode; ?></td>
	</tr>
	<tr>
		<td>Error Message:</td>
		<td><?php echo $errorMessage; ?></td>
	</tr>-->
	
	</center>
	</table>
	<h2 style="text-align:left; line-height:26px; margin-left:100px;">(1) There has been a problem in the booking process.<br/> Please, try again.</h2>
<?php } else {

/* If there is no URL Errors, Construct the HTML page with 
   Response Error parameters.   
   */
?>

<center>
	<font size=2 color=black face=Verdana><b></b></font>
	<br><br>

	<b> Reservation Error!</b><br><br>
	
	<p>&nbsp;</p>
	<h2 style="text-align:left; line-height:26px; margin-left:100px;">(2) There has been a problem in the booking process.<br/> Please, try again.</h2>
	
    <table width = 400>
    	<?php 
    
    require 'ShowAllResponse.php';
    ?>
    </table>
 </center>		
	
<?php 
}// end else
?>
</center>
	</table>
<br>
<a class="home"  id="CallsLink" href="../availability_result.php"><font color=blue><B>Click here to try again<B><font></a>

</div>
</body>
</html>

