<?php
 require_once('inc/session.php');
 
if ($_SESSION['info']){
	///print_r($_SESSION['info']);
	
	if (($_SESSION['info']['manager']==1)||($_SESSION['info']['report']!=0)){
		$_GET['p']='tick'; $_GET['s']='t.m';
		require_once('init.php');
		
		if($_POST){
			
			/*if(trim($_POST['details'])==''){
				$_GET['error']="request needs a detail";
			}*/
			if(!$_GET['error']){
				
				
			/*====================================empieza formulario general==================================================================*/
				$MailHeader ='From: "'.$_SESSION['info']['name']." ".$_SESSION['info']['lastname'].'" <'.$_SESSION['info']['email'].'>'."\n";
				$MailHeader .='Reply-To: '.$_SESSION['info']['email']."\n";
				$MailHeader .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
				$MailHeader .='Content-Transfer-Encoding: 8bit';
				$MailSubject = "New maintenance request ".time()." - internal";
				
				$MailBody .= "Request from: ".$_SESSION['info']['name']." ".$_SESSION['info']['lastname']."\n";
				$MailBody .= "Email : ".$_SESSION['info']['email']."\n";
				$MailBody .= "Villa number: ".$_POST['villa_no']."\n";
				$MailBody .= "Problem type: ".$_POST['problem']."\n";
				
				
				$MailBody .= "Details of every separete items from the villa: \n";
				if($_POST['item1']!=''){
					$MailBody .= "Item 1: ".$_POST['item1']."\n";
				}
				if($_POST['item2']!=''){
					$MailBody .= "Item 2: ".$_POST['item2']."\n";
				}
				if($_POST['item3']!=''){
					$MailBody .= "Item 3: ".$_POST['item3']."\n";
				}
				if($_POST['item4']!=''){
					$MailBody .= "Item 4: ".$_POST['item4']."\n";
				}
				if($_POST['item5']!=''){
					$MailBody .= "Item 5: ".$_POST['item5']."\n";
				}
				if($_POST['item6']!=''){
					$MailBody .= "Item 6: ".$_POST['item6']."\n";
				}
				/*if($_POST['item7']!=''){
					$MailBody .= "Item 7: ".$_POST['item7']."\n";
				}
				if($_POST['item8']!=''){
					$MailBody .= "Item 8: ".$_POST['item8']."\n";
				}
				if($_POST['item9']!=''){
					$MailBody .= "Item 9: ".$_POST['item9']."\n";
				}
				if($_POST['item10']!=''){
					$MailBody .= "Item 10: ".$_POST['item10']."\n";
				}*/
				
				$MailBody .= "Date and time: ".date('l jS \of F Y h:i:s A')."\n";
				//$MailBody1 .="Voir la provenance de ce message : http://www.geoiptool.com/fr/?IP=".$ip;
			 /*====================================termina formulario============================================================*/
				$res=mail($_SESSION['info']['email'], $MailSubject, $MailBody, $MailHeader);//copia cliente
				
				$res=mail($To='casalindadr@gmail.com', $MailSubject, $MailBody, $MailHeader);//ca c'est la copie pour francois envoyée sur le site
				$res=mail('gabino@casalindacity.com', $MailSubject, $MailBody, $MailHeader);//copia cliente
			    $res=mail('RCLMAINT@emaint.com', $MailSubject, $MailBody, $MailHeader);//copia cliente
				
				$_GET['success']="<h2>Maintenance request successfully sent</br>You will receive a copy in your email</h2>";
			}
		}
		display_mobile('emaint_mobile');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>