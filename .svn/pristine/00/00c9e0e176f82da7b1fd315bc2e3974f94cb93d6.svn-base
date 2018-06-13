<? session_start();
if ($_SESSION['owner']){  $_GET['main']=3;  // $_GET['secund']=1.1;
  require_once('init.php');

  if ($_POST){
   switch(trim($_POST['question'])){    case 1:
    		$sent_to='RentalManager@casalindacity.com'; 
    		$name_sent_to="Rental Manager";
    		$question='Occupancy or availability';
    		break;
    case 2:
    		$sent_to='accounting@CasaLindaCity.com';  
    		$name_sent_to="Accounting";
    		$question='Accounting';
    		break;
    case 3:
    		$sent_to='tony@CasaLindaCity.com';  
    		$name_sent_to="Eric Sandmael";
    		$question='Villas sales';
    		break;
    case 4:
    		$sent_to='RentalManager@casalindacity.com'; 
    		$name_sent_to="Rental Manager";
    		$question='Contracts and agreements';
    		break;
    case 5:
    		$sent_to='lo@CasaLindaCity.com';  
    		$name_sent_to="Owners Liaison";
    		$question='Services (Pools/garden, maid, maintenance)';
    		break;
    case 6:
    		$sent_to='RentalManager@casalindacity.com'; 
    		$name_sent_to="Rental Manager";
    		$question='Amenities (shuttle bus, chef, massage, etc)';
    		break;
    case 7:
    		$sent_to='security@CasaLindaCity.com';  
    		$name_sent_to="Security";
    		$question='Security';
    		break;
    case 8:
    		$sent_to='lo@CasaLindaCity.com';  
    		$name_sent_to="Owners Liaison";
    		$question='Others';
    		break;
    default:
    		$_GET['error']="Please, choose at least one question";
   }

   if (trim($_POST['mensaje'])=="") $_GET['error']="Email Message is required";


	if (!$_GET['error']){
	 $correo_owner=$_POST['owner_email'];
	 $db= new getQueries();
	 $villas_para_dueno=$db->villas_for_owner($_POST['owner_id']);
  		foreach ($villas_para_dueno AS $vi){
				$villa_numbers.=" (".$vi['no'].")";
		}
     $nombre=$_SESSION['owner']['name']." ".$_SESSION['owner']['lastname'];
	 //enviar elmensaje
	 $body="";$body.="<html><head></head><body>";
     $body.="<p>Hello $name_sent_to,</p>"; $body.="<p>&nbsp;</p>";
     $body.="<p>My Questions is about: $question</p>";
     $body.="<p>".$_POST['mensaje']."</p>";
      $body.="<p>&nbsp;</p>";
       $body.="<p>&nbsp;</p>";
       $body.="<p>SENT FROM: ";
       $body.="<b>".$nombre."</b>";
       $body.=" VILLA: <b>".$villa_numbers."</b></p>";
	 $body.="</body>";
	 //buscar formato de html en internet
	 //guardar mensaje en base de datos aqui.
     //=====================================================================================================
	 $fecha=date("Y-m-d H:i:s");
	 $from_name=$nombre;
	 $from_email=$correo_owner;
	 $villa=$villa_numbers;
	 $to=$sent_to;
	 $subject=$question;
	 $msg=$body;
	 $from_ip=$_SERVER['SERVER_ADDR'];
	 $data=new DATA();//connect to database
	 $data->insert_msg($fecha, $from_name, $from_email, $villa, $to, $subject, $msg, $from_ip);
     //======================================================================================================

	 $envio=sendMail($body, $sent_to, $question, $correo_owner, "RCL Owners Portal");//send to RCL from (owner)
     $_GET['sent']= "Message sent, please wait for an answer shortly in your email inbox. ($correo_owner)<br/>Thank you for your inquiry";	}  }

  salida('communicate');
}else{
	header('Location:login.php');
	die();
}
?>