<? session_start();
if ($_SESSION['referal']){

  require_once('init.php');
  $_GET['main']=2;   $_GET['secund']=2.1;
 /* if (!$_SESSION['RCL']=="rcladministraciones") die('Restricted area...');*/
  unset($_SESSION['RCL']);
  $_SESSION['RCL1']="rcladministraciones";
  dibujar('page.create_booking1');
}else{
	header('Location:login.php');
	die();
}
?>

