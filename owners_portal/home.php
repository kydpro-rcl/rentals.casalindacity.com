<? session_start();
if ($_SESSION['owner']){  $_GET['main']=1;   //$_GET['secund']=1.1;
  require_once('init.php');
  salida('home');
}else{
	header('Location:login.php');
	die();
}
?>
<?php

?>
<?php

?>