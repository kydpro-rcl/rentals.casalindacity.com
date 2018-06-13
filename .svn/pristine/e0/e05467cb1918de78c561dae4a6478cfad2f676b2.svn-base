<?php
 session_start();
  if($_SESSION['info']){
      $_GET['actual']=1;
	  require_once('initbooking.php');
	  output('view_statement');
  }else{
      header('Location: login.php');
  }
?>