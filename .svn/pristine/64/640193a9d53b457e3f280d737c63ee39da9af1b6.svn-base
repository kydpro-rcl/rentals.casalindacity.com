<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		  require_once('init.php');

		  	$data= new getQueries ();
			$villas=$data->show_all('villas', 'id');
            $contador=0;
			foreach($villas AS $k){            $contador++;
	            if($k['bed']==2){//if villa has two bedrooms            	 $villa_de2++;	            }
	            if($k['bed']==4){//if villa has three bedrooms
            	 $villa_de2++;
	            }
	            if($k['bed']==4 && ){//if villa has four bedrooms and it is not ultima
            	 $villa_de2++;
	            }
			}
			echo $contador." Total Villas<br/>";
			echo $villa_de2." de dos dormitorios<br/>";


    }else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>