<?php
	function display($page){
		include_once('templates/template.header.php');
		include_once('pages/template.'.$page.'.php');
		include_once('templates/template.footer.php');
	}
?>

<?
function sp2($va){
  $num=str_pad($va, 2, '0', STR_PAD_LEFT);
 return $num;
 }

 function hora_in($h, $m, $s){
 	$ho=$h.':'.$m.':'.$s;
    $hora=date("G:i:s",strtotime($ho));
  return $hora;
 }

 function fecha_in($y, $m, $d){
 	$fe=$y.'-'.$m.'-'.$d;
   	$date=date("Y-m-d",strtotime($fe));
   return $date;
 }


 function escribe_fecha_hora($name_add){
 ?>
     <!--//D  day//-->
      <select name="day<?=$name_add?>">
      	<?
      	for($i=1; $i<=31; $i++){?>
         <option value="<?=sp2($i)?>" <? if($_POST['day']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
      <!--//  month//-->
      <select name="month<?=$name_add?>">
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($_POST['month']==sp2($i)){?> selected="selected" <?}?> ><?=date('F',strtotime(sp2('2012-'.$i.'-01')))?></option>
	      <?
	      }
      	?>
      </select>

      <!--// year //--><select name="year<?=$name_add?>">
      	<?
      	for($i=(date('Y')-1); $i<=date('Y')+1; $i++){?>
         <option value="<?=$i?>" <? if($_POST['year']==$i){?> selected="selected" <?}?> ><?=$i?></option>
	      <?
	      }
      	?>
      </select>
      <!--//===========================================================================================//-->
      <!--// Hours//<br/>-->T
      <select name="h<?=$name_add?>">
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($_POST['h']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
     <!--//Minutes//-->:
      <select name="m<?=$name_add?>">
      	<?
      	for($i=0; $i<=60; $i++){?>
         <option value="<?=sp2($i)?>" <? if($_POST['m']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
    <!--// Seconds//-->:
      <select name="s<?=$name_add?>">
      	<?
      	for($i=0; $i<=60; $i++){?>
         <option value="<?=sp2($i)?>"  <? if($_POST['s']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
       <select name="t<?=$name_add?>">
         <option value="am" <? if($_POST['t']=='am'){?> selected="selected" <?}?> >AM</option>
	     <option value="pm" <? if($_POST['t']=='pm'){?> selected="selected" <?}?> >PM</option>
      </select>
 <?
 }

 function fecha_h($fecha){ 	$f_format=date("d M Y - g:i:s A", strtotime($fecha));
 	return $f_format; }

 function fecha($fecha){

 	$f_format=date("d M Y", strtotime($fecha));
 	return $f_format;
 }

  function modifica_fecha_hora($name_add, $fecha_y_hora){
  $f0=strtotime($fecha_y_hora);

 /* echo*/ $fh['d']=date("d",$f0); /* echo "<br/>"; */
  /*echo*/ $fh['mo']=date("m",$f0); /*echo "<br/>";*/
 /* echo*/  $fh['y']=date("Y",$f0); /*echo "<br/>";*/
  $fh['h']=date("G",$f0);
  $fh['m']=date("i",$f0);
  $fh['s']=date("s",$f0);
 ?>
     <!--//D  day//-->
      <select name="day<?=$name_add?>">
      	<?
      	for($i=1; $i<=31; $i++){?>
         <option value="<?=sp2($i)?>" <? if($fh['d']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
      <!--//  month//-->
      <select name="month<?=$name_add?>">
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($fh['mo']==sp2($i)){?> selected="selected" <?}?> ><?=date('F',strtotime(sp2('2012-'.$i.'-01')))?></option>
	      <?
	      }
      	?>
      </select>

      <!--// year //--><select name="year<?=$name_add?>">
      	<?
      	for($i=(date('Y')-1); $i<=date('Y')+1; $i++){?>
         <option value="<?=$i?>" <? if($fh['y']==$i){?> selected="selected" <?}?> ><?=$i?></option>
	      <?
	      }
      	?>
      </select>
      <!--//===========================================================================================//-->
      <!--// Hours//<br/>-->T
      <select name="h<?=$name_add?>">
      	<?
      		if($fh['h']<=12){      			if($fh['h']!='0'){      				$fh['h']=$fh['h']; $fh['tanda']='am';
      			}
      		}else{      			$fh['h']-=12;
      			$fh['tanda']='pm';      		}

      	for($i=1; $i<=12; $i++){
      		?>
         <option value="<?=sp2($i)?>" <? if($fh['h']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
     <!--//Minutes//-->:
      <select name="m<?=$name_add?>">
      	<?
      	for($i=0; $i<=60; $i++){?>
         <option value="<?=sp2($i)?>" <? if($fh['m']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
    <!--// Seconds//-->:
      <select name="s<?=$name_add?>">
      	<?
      	for($i=0; $i<=60; $i++){
      		?>
         <option value="<?=sp2($i)?>"  <? if($fh['s']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
       <select name="t<?=$name_add?>">
         <option value="am" <? if($fh['tanda']=='am'){?> selected="selected" <?}?> >AM</option>
	     <option value="pm" <? if($fh['tanda']=='pm'){?> selected="selected" <?}?> >PM</option>
      </select>
 <?
 }

 function enviar_email($enviar_a, $asunto, $contenido_html, $desde_nombre, $desde_email){

           $MailBody='';
           $MailBody.='<html><head></head>';
           $MailBody.='<body>'.$contenido_html.'</body></html>';

		/*$MailSubject = $site. " ".$langue.". ".$objet. " (".$ville.")";*/
		$MailHeader="";
        $MailHeader.="MIME-Version: 1.0\n";
		$MailHeader.="Content-type: text/html; charset=utf-8\n";
		$MailHeader.="Content-transfer-encoding: 8bit\n";
		$MailHeader.="Date: ". date('r'). "\n";
		$MailHeader.="X-Priority: 3\n";   // send email with high priority; 3 is normal, 1 is high and 5 is de lowest.
		$MailHeader.="X-Mailer: PHP\n";
		$MailHeader.="X-MSMail-Priority: Normal\n";
		$MailHeader.='From: '.$desde_nombre.' <'.$desde_email.'>'."\n";
		$MailHeader.='Reply-To: '.$desde_email."\n";
		/*$MailHeader .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
		$MailHeader .='Content-Transfer-Encoding: 8bit'; */

		$res=mail($enviar_a, $asunto, $MailBody, $MailHeader);
		return $res;
	}


 function fecha_insert($name_add, $fecha){
    if(($fecha!='')&&($fecha!='1969-12-31')&&($fecha!='0000-00-00')){
	 $f0=strtotime($fecha);
	 $fh['d']=date("d",$f0); /* echo "<br/>"; */
	 $fh['mo']=date("m",$f0); /*echo "<br/>";*/
	 $fh['y']=date("Y",$f0); /*echo "<br/>";*/
	}else{      $fh['d']='00';
      $fh['mo']='00';
      $fh['y']='0000';
	}

 ?>
     <!--//D  day//-->
      <select name="day<?=$name_add?>">
      	<option value="00" <? if($fh['d']=='00'){?> selected="selected" <?}?> >&nbsp;</option>
      	<?
      	for($i=1; $i<=31; $i++){?>
         <option value="<?=sp2($i)?>" <? if($fh['d']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
      <!--//  month//-->
      <select name="month<?=$name_add?>">
      	<option value="00" <? if($fh['mo']=='00'){?> selected="selected" <?}?> >&nbsp;</option>
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($fh['mo']==sp2($i)){?> selected="selected" <?}?> ><?=date('F',strtotime(sp2('2012-'.$i.'-01')))?></option>
	      <?
	      }
      	?>
      </select>

      <!--// year //--><select name="year<?=$name_add?>">
      <option value="0000" <? if($fh['y']=='0000'){?> selected="selected" <?}?> >&nbsp;</option>
      	<?
      	for($i=(date('Y')-5); $i<=date('Y')+1; $i++){?>
         <option value="<?=$i?>" <? if($fh['y']==$i){?> selected="selected" <?}?> ><?=$i?></option>
	      <?
	      }
      	?>
      </select>
 <?
 }
?>