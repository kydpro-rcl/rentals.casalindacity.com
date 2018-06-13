<?php
 require_once('inc/session.php');
 require_once('init.php');
 $next_id=nextId($table='customers');
 echo $next_id;
?>