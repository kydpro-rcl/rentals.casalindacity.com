<?session_start();
if ($_SESSION['rqc']){
require_once('inc/all_files.php');
	if($_POST){
		$date=date("Y-m-d G:i:s");
		$user_id=$_SESSION['rqc']['id'];
       $db=new Consultas();
        switch($_POST['item']){
        	case 1:/*crear una villa*/
				$fields=array('no'=>$_POST['villa'], 'user_id'=>$user_id, 'active'=>'1', 'date'=>$date);
				$table='villa';
				$villa_no=$_POST['villa'];/*villa number*/
                $msg='Villa successfully updated';
		     break;
		     case 2:/*crear nuevo numero de documento*/
		     	$vi=$db->get_id($id=$_POST['villa_id'], $table='villa'); $villa_no=$vi['no'];
				$fields=array('doc_no'=>$_POST['doc'], 'id_villa'=>$_POST['villa_id'], 'user_id'=>$user_id, 'date'=>$date);
				$table='doc_number';
                $msg='Document number successfully updated';
		     break;
		     case 3:/*crear detalles de la construccion*/
		     	$vi=$db->get_id($id=$_POST['villa_id'], $table='villa'); $villa_no=$vi['no'];
		     	$delivered_date=fecha_in($y=$_POST['year1'], $m=$_POST['month1'], $d=$_POST['day1']);
		        $promised_date=fecha_in($y=$_POST['year2'], $m=$_POST['month2'], $d=$_POST['day2']);
				$fields=array('id_villa'=>$_POST['villa_id'], 'builder'=>$_POST['build'], 'rental'=>$_POST['rental'], 'stage'=>$_POST['stage'], 'delivered'=>$_POST['delivered'], 'deliver_date'=>$delivered_date, 'promised'=>$promised_date, 'user_id'=>$user_id, 'date'=>$date);
				$table='villa_details';
		        $msg='Construction details successfully updated';
		     break;
		     case 4:/*crear una nueva deficiencia*/
		     	$vi=$db->get_id($id=$_POST['villa_id'], $table='villa'); $villa_no=$vi['no'];
				/*$fields=array('id_villa'=>$_POST['villa_id'], 'details'=>$_POST['deficiency'], 'status'=>'1', 'user_id'=>$user_id, 'date'=>$date); */
				$fields=array('id_villa'=>$_POST['villa_id'], 'details'=>$_POST['deficiency'], 'status'=>'1');
				$table='deficiencies';
		       	$msg='Deficiency successfully updated';
		     break;
		     case 5:/*crear un nuevo mantenimiento*/
		     	$vi=$db->get_id($id=$_POST['villa_id'], $table='villa'); $villa_no=$vi['no'];
				 if($_POST['tf']=='pm'){
			        $h=$_POST['hf']+12;
			        if($h=='24'){ $h='00';}
			     }else{
			      	$h=$_POST['hf'];
			     }
                $from=fecha_in($y=$_POST['yearf'], $m=$_POST['monthf'], $d=$_POST['dayf']);
			    $from.=' '.hora_in($h=$h, $m=$_POST['mf'], $s=$_POST['sf']);

       			 if($_POST['tu']=='pm'){
			        $h1=$_POST['hu']+12;
			        if($h1=='24'){ $h1='00';}
			     }else{
			      	$h1=$_POST['hu'];
			     }
                $until=fecha_in($y=$_POST['yearu'], $m=$_POST['monthu'], $d=$_POST['dayu']);
                $until.=' '.hora_in($h=$h1, $m=$_POST['mu'], $s=$_POST['su']);

				$fields=array('title'=>$_POST['title'], 'note'=>$_POST['note'], 'priority'=>$_POST['prio'], 'id_villa'=>$_POST['villa_id'], 'desde'=>$from, 'hasta'=>$until, 'user_id'=>$user_id, 'active'=>'1', 'date'=>$date);
				$table='maintenance';
                $msg='Maintenance successfully updated';
		     break;
	    }
	    $result=$db->update($id=$_POST['id'],$fields, $table);
	    if($result){
		  $_GET['msg']=$msg;

		  /*enviar email a todos los usuarios activos*/
          $usuarios=$db->consulta_activos($table='users');
          $asunto='System change';
          //------------------START BODY----------------------
          $contenido_html='';
          $contenido_html.='<p> A change has been made in the system with the following message:</p>';
          $contenido_html.='<p>'.$msg.'</p>';
          $contenido_html.='<p>Applied to house #'.$villa_no.'</p>';
          $contenido_html.='<p>&nbsp;</p>';
          $contenido_html.='<p>Made by: '.$_SESSION['rqc']['name'].''.$_SESSION['rqc']['lastname'].'</p>';

          //------------------END BODY------------------
          $desde_nombre='www.RCLQualityControl.Com';
          $desde_email='no-reply@RCLQualityControl.com';
          /*foreach($usuarios AS $u){
		  	@$send_email=enviar_email($enviar_a=trim($u['email']), $asunto, $contenido_html, $desde_nombre, $desde_email);//notificar a todos los usuarios
    	  }*/
		  /*termino de enviar el email*/
		}
		$_GET['id']=$_POST['id'];
		$_GET['i']=$_POST['item'];
    }
display('modify_item');

}else{
	header('Location:login.php');
	die();
}
?>
