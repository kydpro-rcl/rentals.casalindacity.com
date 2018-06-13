<?php
 session_start();
  if($_SESSION['info']){      $_GET['actual']=1;
	  require_once('initbooking.php');
	  output('index');
  }else{      header('Location: login.php');  }
?>
<?php

?>
<?php

?>