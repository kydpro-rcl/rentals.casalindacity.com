<? session_start();
if ($_SESSION['owner']){  $_GET['main']=5;  // $_GET['secund']=1.1;
  require_once('init.php');

  salida('news');
}else{
	header('Location:login.php');
	die();
}
?>