<? session_start();
if ($_SESSION['referal']){
  $_GET['main']=1;   $_GET['secund']=1.2;
  require_once('init.php');

  dibujar('success');
}else{
	header('Location:login.php');
	die();
}
?>