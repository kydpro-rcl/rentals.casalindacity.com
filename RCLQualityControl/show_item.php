<?session_start();
if ($_SESSION['rqc']){
require_once('inc/all_files.php');

display('show_item');

}else{
	header('Location:login.php');
	die();
}
?>
