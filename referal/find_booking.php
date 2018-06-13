<? session_start();
if ($_SESSION['referal']){
  $_GET['main']=2;   $_GET['secund']=2.2;
  require_once('init.php');
  dibujar('find_booking');
}else{
	header('Location:login.php');
	die();
}
?>