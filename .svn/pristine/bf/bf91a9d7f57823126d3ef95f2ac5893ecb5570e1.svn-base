<?session_start();
if ($_SESSION['rqc']){
require_once('inc/all_files.php');
	if($_POST){       $db=new Consultas();

		$fields=array('no'=>$_POST['villa'], 'user_id'=>'', 'date'=>'');
		$table='villa';
        $result=$db->insert($fields, $table);
        if($result){
        $_GET['msg']='Information successfully submitted';        }	}

display('villa');

}else{
	header('Location:login.php');
	die();
}
?>
