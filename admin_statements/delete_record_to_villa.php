<?php
 session_start();
  if($_SESSION['info']){
      $_GET['actual']=3;
	  require_once('initbooking.php');
	  output('delete_record_to_villa');
  }else{
      header('Location: login.php');
  }
?>