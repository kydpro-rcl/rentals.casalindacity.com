<? session_start();
if ($_SESSION['owner']){  $_GET['main']=7;   //$_GET['secund']=1.1;
  require_once('init.php');
  salida('new_booking');
}else{
	header('Location:login.php');
	die();
}
?>