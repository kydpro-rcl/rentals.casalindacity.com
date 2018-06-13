<? session_start();
if ($_SESSION['referal']){  $_GET['main']=1;   $_GET['secund']=1.3;
  require_once('init.php');
  dibujar('agency_users');
}else{
	header('Location:login.php');
	die();
}
?>