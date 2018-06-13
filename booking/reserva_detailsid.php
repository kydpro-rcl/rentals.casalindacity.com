<?php
error_reporting(E_ALL & ~E_NOTICE);// Report all errors except E_NOTICE
 require_once('inc/session.php');
 ?>
<html>
<head>
  <title>EasyTabs Demo</title>
  <!--<script src="js/tabs/vendor/jquery-1.7.1.min.js" type="text/javascript"></script> 
  <script src="js/tabs/vendor/js/jquery.hashchange.min.js" type="text/javascript"></script>
  <script src="js/tabs/lib/jquery.easytabs.min.js" type="text/javascript"></script>-->

  <style>
    /* Example Styles for Demo */
    .etabs { margin: 0; padding: 0; }
    .tab { display: inline-block; zoom:1; *display:inline; background: #eee; border: solid 1px #999; border-bottom: none; -moz-border-radius: 4px 4px 0 0; -webkit-border-radius: 4px 4px 0 0; }
    .tab a { font-size: 14px; line-height: 2em; display: block; padding: 0 10px; outline: none; }
    .tab a:hover { text-decoration: underline; }
    .tab.active { background: #fff; padding-top: 6px; position: relative; top: 1px; border-color: #666; }
    .tab a.active { font-weight: bold; }
    .tab-container .panel-container { background: #fff; border: solid #666 1px; padding: 10px; -moz-border-radius: 0 4px 4px 4px; -webkit-border-radius: 0 4px 4px 4px; }
    .panel-container { margin-bottom: 10px; }
  </style>

  <script type="text/javascript">
    $(document).ready( function() {
      $('#tab-container').easytabs();
    });
  </script>
</head>
<body>
<?

if($_POST['idreserva']) $_GET['id']=$_POST['idreserva'];
//================SAVE THE NOTE FOR THIS BOOKING=============================================
  if(trim($_POST['comment'])!=''){ /*solo inserta el comentario si la caja no esta vacia*/
  	require_once('init.php');
 	 $link=new getQueries (); //connect and make a query - Ej. get info from a ref number

 	$busy=$link->see_occupancy_id($_GET['id']);
	$ocupabilidad=$busy[0];

    $db= new DB();
    $fecha=date("Y-m-d G:i:s");
    switch($_POST['tipo']){
    	case 2: //manager note
    	     $tipo=2;  break;
    	case 3: //complaint note
    	     $tipo=3;
    	     $complaint_no=$_POST['complaint'];
    	     $villa_id=$_POST['villa'];
    	     break;
    	default: //imagine that it is a normal note with tipo value=1
    		$tipo=1;
   	}
	$complainid=$db->insert_comments($ocupabilidad['ref'],$_POST['comment'],$tipo,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no, $villa_id, $id_reserv_mod='');
	
		if(($tipo==3)&&($_POST['ticket']=='1')){/*save report if it's a complain and create a ticket is yes*/
		/*	$deparmentNumber=department_no($complaint_no);
			$fields=array('villa_id'=>$villa_id,
						  'subject'=>$complaint_no, 
						  'details'=>htmlentities($_POST['comment'], ENT_QUOTES),
						  'status'=>1, 
						  'userid'=>$_SESSION['info']['id'], 
						  'date'=>time(),
						  'department'=>$deparmentNumber, 
						  'complain'=>$complainid);
			$reporid=$db->insert($fields, $table='reports');
			
			$fields2=array('reportid'=>$reporid,
						  'status'=>1, 
						  'userid'=>$_SESSION['info']['id'],
						  'date'=>time(),
						  'notereasondelegate'=>'');
			$reporthistid=$db->insert($fields2, $table='reporthistory');
			$fromNamelastname=$_SESSION['info']['name'].' '.$_SESSION['info']['lastname'];
			notifyTicketDep($deparmentNumber, $reporid, $fromNamelastname);
			//echo $deparmentNumber;
			*/
	  }/*end creating report*/
  }//finaliza si de insertar comentario
  //========= END SAVING NOTES==============================================================
 if($_SESSION['info']['manager']==1){  /*only delete note if manager user*/
   if(trim($_GET['del_note'])!=''){
     //update this note in id.
     require_once('init.php');
     $db= new DB();
     $delete_comment=$db->delete_comments($_GET['del_note']);
   }
 }
?>

<div id="tab-container" class='tab-container'>
 <ul class='etabs'>
   <li class='tab'><a href="#tabs1-DETAILS">DETAILS</a></li>
   <li class='tab'><a href="#tabs1-NOTES">NOTES</a></li>
   <!--<li class='tab'><a href="#tabs1-css">Example CSS</a></li>-->
 </ul>
 <div class='panel-container'>
  <div id="tabs1-DETAILS">
	<? require_once('reserva_details_tab1.php');?>
  </div>
   <div id="tabs1-NOTES">
    <? require_once('reserva_details_tab2.php');  ?>
  </div>
 <!-- <div id="tabs1-css">
   <h2>CSS Styles for these tabs</h2>
  </div>-->
 </div>
</div>

</body>
</html>