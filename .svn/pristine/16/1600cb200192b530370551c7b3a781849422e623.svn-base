<?php
 session_start();
  if($_SESSION['info']){
      $_GET['actual']=3;
	  require_once('initbooking.php');
	  output('translations');
  }else{
      header('Location: login.php');
  }
?>