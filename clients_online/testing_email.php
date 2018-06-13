<html>

<head>
  <title></title>
</head>

<body>

<?php
 require_once('init.php');
if($_GET['email']=='yes'){     $body1=email_template($email_client='webmaster@casalindacity.com', $booking_no='000003469', $array_info=$_SESSION['all_info'], $ip=$_SERVER['REMOTE_ADDR']);
     $body2=email_template($email_client='webmaster@casalindacity.com', $booking_no='000003469', $array_info=$_SESSION['all_info'], $ip='');

     sendMail($body1, $to='ing.joseluisdr@gmail.com',$subject="Booking No: ".$ref, $from_add="online.booking@casalindacity.com", $from_name="RCL Booking System");//send to reservations
     sendMail($body2, $to='ing.joseluis@msn.com', $subject="Booking No: ".$ref, $from_add="Reservations@CasaLindaCity.com", $from_name="www.CasaLindaCity.com");//send to client
     echo "Email enviado";}

?>

</body>

</html>