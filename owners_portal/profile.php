<? session_start();
if ($_SESSION['owner']){  $_GET['main']=4;  // $_GET['secund']=1.1;
  require_once('init.php');

  salida('profile');
}else{
	header('Location:login.php');
	die();
}
?>