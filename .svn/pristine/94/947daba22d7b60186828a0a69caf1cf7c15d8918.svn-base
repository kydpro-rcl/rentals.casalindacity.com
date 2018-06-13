<?
//echo $_GET['ref'];
$db=new getQueries();

if ($_POST['ref']){$_GET['ref']=$_POST['ref'];}
if ($_POST['id']){$_GET['id']=$_POST['id'];}

$oc=$db->see_occupancy_ref($_GET['ref']);
$villa=$db->villa($oc[0]['villa']);
$cl=$db->customer($oc[0]['client']);

$actual_time=strtotime(date('G:i:s'));// returm a date or time in seconds
#$actual_time=date('h:m:s');
$limit_time=strtotime('13:00:00'); //returm a date or time in seconds
#echo $actual_time.'<br/>';
#echo $limit_time.'<br/>';
$ref=$_GET['ref'];
$id=$oc[0]['reserveid'];
$over_limit_time=strtotime('18:00:00'); //returm a date or time in seconds
		if (($actual_time>$limit_time)&&($actual_time<$over_limit_time)){
			#echo 'yes';
			switch($villa[0]['bed']){
				case 2:
				   $late_check_out=25.00;
				   break;
				case 3:
				   $late_check_out=35.00;
				   break;
				case 4:
				   $late_check_out=50.00;
				   break;
			}
		}elseif($actual_time>=$over_limit_time){
			//temporada alta o baja
			//late check out = mitad del precio de la villa
			#echo 'no';
			$late_check_out=($villa[0]['p_low']/2);
		}else{
			 $late_check_out=0.00;
		}
?>
<?/*=$oc[0]['status']*/?>
<h2 style="text-align:center">Checking Out</h2>
    <? if ($oc[0]['status']==1){?>
		<h3 style="padding-left:15px;">Leaving from <span style="color:black">Villa No. <?=$villa[0]['no']?></span> Client: <span style="color:black"><? echo $cl['name'].' '.$cl['lastname']?></span></h3>
		<hr />
		<form method="post" name="" action="check_out_confirm2.php" >
		<table align="center" cellpadding="2" cellspacing="2" style="border-bottom:1px solid #999; border-top:1px solid #999; border-left:1px solid #999; border-right:1px solid #999;">

		<tr><td><p class="derecha">Does this client lost villa key?</p></td><td><p><select name="vk"><option class="input" value="0">No</option><option value="1">Yes</option></select></p></td></tr>

		<tr><td><p class="derecha">Does this client lost Safe Key?</p></td><td><p><select name="sk"><option class="input" value="0">No</option><option value="1">Yes</option></select></p></td></tr>

		<tr><td><p class="derecha">Extra charge by firnishings and/or inventory?</p></td><td><p><select name="fi"><option class="input" value="0">No</option><option value="1">Yes</option></select></p></td></tr>
		<tr><td><p class="derecha">Other charge?</p></td><td><p><select name="oc"><option class="input" value="0">No</option><option value="1">Yes</option></select></p></td></tr>

		<tr><td><p class="derecha">Late check out charge: US$</p></td><td><p><input class="input" size="5" type="text" name="late_checkout" value="<?=number_format($late_check_out,2)?>" >
		<!--//<input class="input" size="5" type="text" name="late_checkout" value="<?=number_format($late_check_out,2)?>" readonly>//-->
		</p></td></tr>

		<tr><td colspan="2"><p ><input class="book_but" type="submit" name="next" value="Continue" /></p></td>
		</tr></table>
		<input type="hidden" name="tripadvisor" value="<?=$_POST['tripadvisor']?>" />
		<input type="hidden" name="ref" value="<?=$_GET['ref']?>" />
		<input type="hidden" name="id_reserve" value="<?=$_GET['id']?>" />
		</form>
	<?}/*END SHORT TERM 4*/?>

	<? if ($oc[0]['status']==6){?>

		<?
		//send email to this vip client for tripadvisor
		$date=date("Y-m-d G:i:s"); $id_adm=$_SESSION['info']['id'];
		$link=new DB(); //connect to class
		$status="14";
	    $result=$link->check_out($id,$status); //make checkout for this reserve
	    $id_checkout=$link->check_out_insert($ref, $date, $id_adm); //save checkout record
		echo '<p style=\'text-align:center\'><img src=\'images/home/checkout_icon2.png\' width=\'74\' height=\'89\'></p>';
		echo '<h2 style=\'text-align:center\'>Successfully Checked Out</h2>';
		?>
		<?
		   //enviar email de trip advisor.
       # $db= new getQueries();
        #$cl=$db->customer($oc[0]['client']);//get cliente details
        /*
      if($_POST['tripadvisor']=="yes"){
    	 $tripadvisor1=sent_tripadvisor_request($cl, $ref);
    	 echo $tripadvisor1;
      }
          */
		?>

	<?}/*END VIP SHORT TERM 14*/?>

	<? if ($oc[0]['status']==7){?>

     	<?
     	//send email to this owner for tripadvisor
		$date=date("Y-m-d G:i:s"); $id_adm=$_SESSION['info']['id'];
		$link=new DB(); //connect to class
		$status="21";
	    $result=$link->check_out($id,$status); //make checkout for this reserve
	    $id_checkout=$link->check_out_insert($ref, $date, $id_adm); //save checkout record
		echo '<p style=\'text-align:center\'><img src=\'images/home/checkout_icon2.png\' width=\'74\' height=\'89\'></p>';
		echo '<h2 style=\'text-align:center\'>Successfully Checked Out</h2>';

		   //enviar email de trip advisor.
       # $db= new getQueries();
        /*$cl=$db->customer($oc[0]['client']);//get cliente details */

        #$owner=$db->show_id('owners', $oc[0]['client']); //if owner staying
        #$cl=$owner[0];//get owner details
        /*
         if($_POST['tripadvisor']=="yes"){
        	$tripadvisor1=sent_tripadvisor_request($cl, $ref);
        	echo $tripadvisor1;
         }
           */
		?>

	<?}/*END OWNER SHORT TERM 21*/?>

	<? if ($oc[0]['status']==8){?>

       <?
		$date=date("Y-m-d G:i:s"); $id_adm=$_SESSION['info']['id'];
		$link=new DB(); //connect to class
		$status="11";
	    $result=$link->check_out($id,$status); //make checkout for this reserve
	    $id_checkout=$link->check_out_insert($ref, $date, $id_adm); //save checkout record
		echo '<p style=\'text-align:center\'><img src=\'images/home/checkout_icon2.png\' width=\'74\' height=\'89\'></p>';
		echo '<h2 style=\'text-align:center\'>Successfully Checked Out</h2>';
		?>

	<?}/*END LONG TERM 11*/?>

	<? if ($oc[0]['status']==15){?>

        <?
		$date=date("Y-m-d G:i:s"); $id_adm=$_SESSION['info']['id'];
		$link=new DB(); //connect to class
		$status="18";
	    $result=$link->check_out($id,$status); //make checkout for this reserve
	    $id_checkout=$link->check_out_insert($ref, $date, $id_adm); //save checkout record
		echo '<p style=\'text-align:center\'><img src=\'images/home/checkout_icon2.png\' width=\'74\' height=\'89\'></p>';
		echo '<h2 style=\'text-align:center\'>Successfully Checked Out</h2>';
		?>


	<?}/*END VIP LONG TERM 18*/?>

	<? if ($oc[0]['status']==22){?>

	  <?
		$date=date("Y-m-d G:i:s"); $id_adm=$_SESSION['info']['id'];
		$link=new DB(); //connect to class
		$status="25";
	    $result=$link->check_out($id,$status); //make checkout for this reserve
	   $id_checkout=$link->check_out_insert($ref, $date, $id_adm); //save checkout record
		echo '<p style=\'text-align:center\'><img src=\'images/home/checkout_icon2.png\' width=\'74\' height=\'89\'></p>';
		echo '<h2 style=\'text-align:center\'>Successfully Checked Out</h2>';
		?>

	<?}/*END OWNER LONG TERM 25*/?>

  <? if ($oc[0]['status']==26){?>

	  <?
		$date=date("Y-m-d G:i:s"); $id_adm=$_SESSION['info']['id'];
		$link=new DB(); //connect to class
		$status="29";
	    $result=$link->check_out($id,$status); //make checkout for this reserve
	   $id_checkout=$link->check_out_insert($ref, $date, $id_adm); //save checkout record
		echo '<p style=\'text-align:center\'><img src=\'images/home/checkout_icon2.png\' width=\'74\' height=\'89\'></p>';
		echo '<h2 style=\'text-align:center\'>Successfully Checked Out</h2>';
		?>

	<?}/*END OWNER LONG TERM 25*/?>

	<?
    if ($oc[0]['status']!=1){/*no need to make checkout question*/
          	//==============INSERT A COMMENT AS A BOOKING CHANGE IN A EDITION OF A BOOKING=========================
   				  $fecha=date("Y-m-d G:i:s");
                  $insert_comment=$link->insert_comments($ref,'',$tipo='4'/*mean booking changed*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='2'/*mean check out*/, $id_villa, $id_ocupacion_mod=$id_checkout);
		//=====================================================================================================
    }/*no need to make check out question */
	?>