<?php
 session_start();
  if($_SESSION['info']){
      $_GET['actual']=4;
	  require_once('initbooking.php');
	  output('delete_some_statements');
  }else{
      header('Location: login.php');
  }
?>