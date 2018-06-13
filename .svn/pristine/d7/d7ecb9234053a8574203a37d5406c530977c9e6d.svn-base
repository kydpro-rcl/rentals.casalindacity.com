<? session_start();
if ($_SESSION['referal']){
  $_GET['main']=3;   $_GET['secund']=3.1;
  require_once('init.php');
  dibujar('clients_list');
}else{
	header('Location:login.php');
	die();
}
?>