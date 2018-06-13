<? session_start();
if ($_SESSION['referal']){
  $_GET['main']=4;   $_GET['secund']=4.1;
  require_once('init.php');
  dibujar('forum');
}else{
	header('Location:login.php');
	die();
}
?>