<?php
 session_start();
  if($_SESSION['info']){
	  $serverFTP_user='';
	  $serverFTP_pass='';
	  $serverFTP_host='';
	  
      $_GET['actual']=1;
	  require_once('initbooking.php');

	  if($_POST){
	  	$db=new DATA();//connect to database
	  		  //verificar que este estado no esta subido, para esta villa, mes y año
	  	$statement_uploaded=$db->check_uploaded($_POST['villa_id'], $_POST['month'], $_POST['year']);// check if balanced uploaded
	  	$consulta=new getQueries();
	  	$selected_villa=$consulta->villa($_POST['villa_id']); //details for filla selected

        if (!$statement_uploaded){ //si no hay records encontrado para este mes y año en esa villa
			//===========================UPLOAD STATEMENTS=========================================================================
		   if($_FILES['statement']['name']==''){  //validar archivo que no esta bacio

	       $_GET['error']="Archivo de Estado es requerido";
	       }else{
	       $no_villa=$selected_villa[0]['no'];
	        $rep_dest="owners_portal/statements/villa".$no_villa."/";
			
			if (!file_exists($rep_dest)){ /*se crea la carpeta*/
				mkdir($rep_dest);
				chmod($rep_dest, 0755);
		    }
	       
			// procee with uploading
				$nombre_archivo1 = time().$_FILES['statement']['name']; $tipo_archivo = $_FILES['statement']['type']; // $tamano_archivo = $_FILES['statement']['size'];
				$path1=$rep_dest.$nombre_archivo1;
					if (!(strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "PDF"))) {
					    $_GET['error']="Archivo de estado deber ser .pdf";

					}else{
					   	if (move_uploaded_file($_FILES['statement']['tmp_name'],$path1 )){
					      $statement_file=$nombre_archivo1;//mean all is ok with file
					   	}
					}

	       }
			//===========================END UPLOAD STATEMENTS=========================================================================
	      
		  //===========================UPLOAD ELECTRICITY=========================================================================
			
			$nombre_archivo2 = time().$_FILES['electricity']['name']; $tipo_archivo = $_FILES['electricity']['type']; // $tamano_archivo = $_FILES['statement']['size'];
			$path2=$rep_dest.$nombre_archivo2;
			if (move_uploaded_file($_FILES['electricity']['tmp_name'],$path2 )){
				$electricity_file=$nombre_archivo2;//mean all is ok with file
			}
			//===========================END UPLOAD ELECTRICITY=========================================================================
			//===========================UPLOAD Sub-divition Fee=========================================================================
			$nombre_archivo3 = time().$_FILES['subdivition']['name']; $tipo_archivo = $_FILES['subdivition']['type']; // $tamano_archivo = $_FILES['statement']['size'];
			$path3=$rep_dest.$nombre_archivo3;
			if (move_uploaded_file($_FILES['subdivition']['tmp_name'],$path3 )){
				$sudivision_file=$nombre_archivo3;//mean all is ok with file
			}
			//===========================END UPLOAD Sub-division Fee=========================================================================
			 //===========================UPLOAD Servicios=========================================================================
			$nombre_archivo4 = time().$_FILES['services']['name']; $tipo_archivo = $_FILES['services']['type']; // $tamano_archivo = $_FILES['statement']['size'];
			$path4=$rep_dest.$nombre_archivo4;
			if (move_uploaded_file($_FILES['services']['tmp_name'],$path4 )){
				$services_file=$nombre_archivo4;//mean all is ok with file
			}
			//===========================END UPLOAD Servicios=========================================================================
			
			
	       /*if(!$_GET['error']){
		       //search owner email
		       $owner_id=$selected_villa[0]['id_owner'];
	           $owner=$consulta->show_id('owners',$owner_id); // get information for this owner
	          // if(!filter_var($owner[0]['email'], FILTER_VALIDATE_EMAIL)) { $_GET['error']="Antes de subir archivos para esta villa,<br/> por favor,  arreglar el email del propietario"; }
           }*/

	       if(!$_GET['error']){
            $fecha=date("Y-m-d G:i:s");
			
	        $db->insert_statement($_POST['villa_id'], $fecha, $_POST['month'], $_POST['year'], $tipoarch=1, $statement_file, $electricity_file, $sudivision_file, $services_file, $_SESSION['info']['id']);
	        $_GET['msg']="Archivos exitosamente subido a villa ".$selected_villa[0]['no']."<br> Se ha enviado un correo al propietario";
	        //enviar email al dueño
            $body="<html><head></head><body>";

            $body.="<p style=\"text-align:center;\"><a href=\"http://www.casalindacity.com\" alt=\"\"><img src=\"https://rentals.casalindacity.com/owners_portal/images/owners-system.jpg\" alt=\"Residencial Casa Linda\" border=\"0\" width=\"820px;\" height=\"172px;\"></a></p>";
            $body.="<hr/>";
			$body.="<p>Dear ".$owner[0]['name']." ".$owner[0]['lastname'].",</p>";
            $body.="<p>&nbsp;</p>";
            $body.="<p>Great News!</p>";
            $body.="<p>Your <strong>".dame_nombre_mes($_POST['month'])." ".$_POST['year']."</strong> statement for <strong>villa ".$selected_villa[0]['no']."</strong> is ready for viewing on your owners portal.</p>";
            $body.="<p>To login, please, <a href=\"https://rentals.casalindacity.com/owners_portal/login.php\">click here</a></p>";
            $body.="<p>&nbsp;</p>";
            $body.="<p><b>Sincerely,</b></p>";
            $body.="<p><b>Your RCL Team</b></p>";

            $body.="</body>";

            $address=$owner[0]['email'];//owner email
            //$address='webmaster@casalindacity.com';
            $subject="New files for Month: ".$_POST['month']." Year: ".$_POST['year']." Villa No.: ".$selected_villa[0]['no'];     //asunto
            sendMail_to_owner($body, $address, $subject, MANAGING_EMAIL, 'RCL Administraciones - Owners Portal');
			 sendMail_no_copy($body, 'infanteoficina@hotmail.com', $subject, $from_add=MANAGING_EMAIL, $from_name='RCL Administraciones - Owners Portal');
			 if($owner[0]['cedula']!=''){
			   if(filter_var($owner[0]['cedula'], FILTER_VALIDATE_EMAIL)){
					sendMail_to_owner($body, $owner[0]['cedula'], $subject, MANAGING_EMAIL, 'RCL Administraciones - Owners Portal (2nd)');
				}
			 }
	       }

	    }else{
			//print_r($statement_uploaded);
          $_GET['error']="Esta villa (".$selected_villa[0]['no'].") ya tiene archivos para el mes: ".$_POST['month']." a&ntilde;o: ".$_POST['year'].",<br/> Si usted quiere cambiarlos, Por favor click aqui, <a href='change_statement.php?id=".$statement_uploaded[0]['id']."' >click aqui</a>";
	    }
	  }

	  output('new_statement');
  }else{
      header('Location: login.php');
  }
?>