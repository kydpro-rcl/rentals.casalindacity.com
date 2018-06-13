<? session_start();
if ($_SESSION['referal']){

  require_once('init.php');
  $_GET['main']=2;   $_GET['secund']=2.1;
  if (!$_SESSION['RCL1']=="rcladministraciones") die('Restricted area...');
   //unset($_SESSION['RCL1']);
 $_SESSION['RCL1B']="rcladministraciones";

  dibujar('create_booking2');
}else{
	header('Location:login.php');
	die();
}
?>

