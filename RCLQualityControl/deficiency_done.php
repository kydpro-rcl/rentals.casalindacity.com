<?session_start();
if ($_SESSION['rqc']){
require_once('inc/all_files.php');
display('deficiency_done');

}else{
	header('Location:login.php');
	die();
}
?>
