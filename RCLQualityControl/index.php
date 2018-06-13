<?session_start();
if ($_SESSION['rqc']){
require_once('inc/all_files.php');
display('index');

}else{
	header('Location:login.php');
	die();
}
?>
<?php

?>
<?php

?>
