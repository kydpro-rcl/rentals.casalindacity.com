<?php
 session_start();
  if($_SESSION['info']){
      $_GET['actual']=2;
	  require_once('initbooking.php');
	  output('languages');
  }else{
      header('Location: login.php');
  }
?>