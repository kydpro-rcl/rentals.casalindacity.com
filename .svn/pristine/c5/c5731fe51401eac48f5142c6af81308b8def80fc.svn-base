<? session_start();
if ($_SESSION['owner']){
  unset($_SESSION['owner']);
  //require_once('init.php');
 // dibujar('logout');
 header('Location:login.php');
 die();
}else{
	header('Location:login.php');
	die();
}
?>