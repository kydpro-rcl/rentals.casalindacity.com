<? session_start();
if ($_SESSION['referal']){
	
  require_once('init.php');
  $_GET['main']=2;   $_GET['secund']=2.1;
  $_SESSION['RCL']="rcladministraciones";
  require_once ("../for_rent/arrival_departure/dates/arrival_departure.php");
  dibujar('create_booking');
}else{
	header('Location:login.php');
	die();
}
?>

