<?php
 session_start();
  if($_SESSION['info']){
	  
	$actual_directory= dirname($_SERVER['SCRIPT_FILENAME']);
	$home_directory=substr($actual_directory, 0, -16);
	  
      $_GET['actual']=1;
	  require_once('initbooking.php');

	  if($_POST){
	  	$_GET['id']=$_POST['id'];
	  	$db=new DATA();//connect to database

	  	$statement_uploaded=$db->check_uploaded_noid($_POST['id'], $_POST['villa_id'], $_POST['month'], $_POST['year']); // check if balanced uploaded
	  	$consulta=new getQueries();
	  	$selected_villa=$consulta->villa($_POST['villa_id']); //details for villa selected

        /*if (!$statement_uploaded){*/ //si no hay otros archivos encontrados para esta misma fecha de la villa, entonces actulizar estos
			$no_villa=$selected_villa[0]['no'];
	        $rep_dest=$home_directory."owners_portal/statements/villa".$no_villa."/";
			
			if (!file_exists($rep_dest)){ /*se crea la carpeta*/
				mkdir($rep_dest);
				chmod($rep_dest, 0755);
		    }
			
			
			
		   if($_FILES['statement']['name']==''){  //validar archivo que no esta bacio
            $statement_file=$_POST['old_file'];
	       }else{
	       
			
				$nombre_archivo = time().$_FILES['statement']['name']; $tipo_archivo = $_FILES['statement']['type']; // $tamano_archivo = $_FILES['statement']['size'];
				$path1=$rep_dest.$nombre_archivo;
					if (!(strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "PDF"))) {
					    $_GET['error']="Statement file must be .pdf";

					}else{
					   	if (move_uploaded_file($_FILES['statement']['tmp_name'],$path1 )){
					      $statement_file=$nombre_archivo;//mean all is ok with file
					   	}
					}

	       }//end uploading statement and creating folders
		   
		     //===========================UPLOAD ELECTRICITY=========================================================================
			  if($_FILES['electricity']['name']==''){  //validar archivo que no esta vacio
				$electricity_file=$_POST['old_elect'];
			  }else{
				
					$nombre_archivo2 = time().$_FILES['electricity']['name']; $tipo_archivo = $_FILES['electricity']['type']; // 
					$path2=$rep_dest.$nombre_archivo2;
					if (move_uploaded_file($_FILES['electricity']['tmp_name'],$path2 )){
						$electricity_file=$nombre_archivo2;//mean all is ok with file
					}
			   }
			//===========================END UPLOAD ELECTRICITY=========================================================================
		  
			//===========================UPLOAD Sub-divition Fee=========================================================================
			 if($_FILES['subdivition']['name']==''){  //validar archivo que no esta vacio
				$sudivision_file=$_POST['old_sud'];
			  }else{
					
					$nombre_archivo3 = time().$_FILES['subdivition']['name']; $tipo_archivo = $_FILES['subdivition']['type']; // $tamano_archivo = $_FILES['statement']['size'];
					$path3=$rep_dest.$nombre_archivo3;
					if (move_uploaded_file($_FILES['subdivition']['tmp_name'],$path3 )){
						$sudivision_file=$nombre_archivo3;//mean all is ok with file
					}
			  }
			//===========================END UPLOAD Sub-division Fee=========================================================================
			 //===========================UPLOAD Servicios=========================================================================
			  if($_FILES['services']['name']==''){  //validar archivo que no esta vacio
				$services_file=$_POST['old_services'];
			  }else{
					$nombre_archivo4 = time().$_FILES['services']['name']; $tipo_archivo = $_FILES['services']['type']; // $tamano_archivo = $_FILES['statement']['size'];
					$path4=$rep_dest.$nombre_archivo4;
					if (move_uploaded_file($_FILES['services']['tmp_name'],$path4 )){
						$services_file=$nombre_archivo4;//mean all is ok with file
					}
			  }
			//===========================END UPLOAD Servicios=========================================================================

	       /*if(!$_GET['error']){
		       //search owner email
		       $owner_id=$selected_villa[0]['id_owner'];
	           $owner=$consulta->show_id('owners',$owner_id); // get information for this owner
	           if(!filter_var($owner[0]['email'], FILTER_VALIDATE_EMAIL)) { $_GET['error']="Before to upload statement for this villa,<br/> please,  fix the email address for the owner"; }
           }*/

	       if(!$_GET['error']){
            $fecha=date("Y-m-d G:i:s");
	        #$db->insert_statement($_POST['villa_id'], $fecha, $_POST['month'], $_POST['year'], $tipoarch=1, $statement_file, $_POST['tipomoneda'], $_POST['balance'], $_SESSION['rcl']['id']);
	        $db->update_statement($_POST['id'], $_POST['villa_id'], $fecha, $_POST['month'], $_POST['year'], $tipoarch=1, $statement_file, $electricity_file, $sudivision_file, $services_file, $_SESSION['info']['id']);

	        $_GET['msg']="Archivo exitosamente cambiado para villa ".$selected_villa[0]['no'];
	
	       }

        /*}else{
          //$_GET['error']="Villa ".$selected_villa[0]['no']." Ya tiene otro balance para ".dame_nombre_mes($_POST['month'])." ".$_POST['year'].",<br/>Estados y facturas solo pueden ser uno por mes, a&ntilde;o y villa.";
	    }*/	  }

	  output('change_file');
  }else{
      header('Location: login.php');
  }
?>