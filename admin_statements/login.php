<?php
  require_once('initbooking.php');
  if(!$_SESSION['info']){
  output('login');
  }else{
	  header('Location:index.php');  
  }
?>