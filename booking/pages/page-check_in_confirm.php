<?
$id=$_GET['id'];
$ref=$_GET['r'];

if (!$_GET['id']) $id=$_POST['id'];
if (!$_GET['r']) $ref=$_POST['r'];

$date=date("Y-m-d G:i:s"); $id_adm=$_SESSION['info']['id'];
// echo $id;
$db=new getQueries();
$busy_details=$db->see_occupancy_ref($ref);

$customer_info=$db->customer($busy_details[0]['client']);

//print_r ($customer_info);

if ($id && $ref) {
    ?>
    <?/*=$busy_details[0]['status']*/?>

    <br>
    <p><a href="check-in.php"><img style="float:left" src="images/button/back.jpg"  border="0" width="55" height="20"/></a></p>

    <h1 style="text-align:center">Confirm Check in</h1>
    <hr>
    <? if (($busy_details[0]['status']==3) || ($busy_details[0]['status']==2) || ($busy_details[0]['status']==12) || ($busy_details[0]['status']==13) || ($busy_details[0]['status']==19) || ($busy_details[0]['status']==20)){?>
	    <? if (!$_POST['checkin']){?>
	    <table align="center" style="clear:both;"><tr><td>
	    <div style="border-width: 1px; border-style: solid; border-color:#999; width: 600px; height: 256px;  margin-top: 12px; margin-bottom: 12px;"> <img style="float:left" src="images/warning140.gif" />
	    <p style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;"><span style="color:red;">Note:</span> <span style="color:#36F">Before confirm this check in, be sure print an invoice and charge to client the right amount on it; also make him/her sign an register sheet first.</span></p>
	    <p style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;"><span style="color:red;">Nota:</span> <span style="color:#36F">Antes de confirmar esta entrada, est&eacute; seguro de imprimir una factura y cobrarle al cliente, tambien h&aacute;galo firmar una hoja de registro primero.</span></p>
	    <table style="clear:both;" align="center"><tr><td bgcolor="#0099CC" style="border: 1px solid #D5D5D5; border-radius: 5px 5px 5px 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.15); margin-bottom: 20px; padding:5px;">
		<form  name="invoice" method="post" action="customers_invoices_print.php" target="_blank">
	    <input type="hidden" name="ref" value="<?=$ref?>"/>
	    <!--//PAYABLE TO://-->
	    <p>PAYABLE TO:<br/>
	     	<select name="payable_to">
	     		<option value="1" <? if (($busy_details[0]['status']!=19)||($busy_details[0]['status']!=20)){?>selected="selected"<?}?>>The Tenant</option>
	     		<option value="2">Neguen, SRL</option>
	     		<option value="3">RCL Administraciones, SRL.</option>
	     		<option value="4">Owner of the Villa</option>
	     		<?
	     		//only if referal
	     		if ($customer_info['id_commission']>"0"){
		     		?>
		     		<option value="5">Referal Agent</option>
		     		<?
	     		}
	     		//only if referal
	     		?>

	     		<?if (($busy_details[0]['status']==19) || ($busy_details[0]['status']==20)
	     		){
		     		?>
		     		<option value="6" selected="selected">Void (no charges)</option>
		     		<?
	     		}?>
	     	</select>
	     	<?
	     		//only if referal
	     		if ($customer_info['id_commission']>"0"){
		     		?>
		     		<input type="hidden" name="referal_id" value="<?=$customer_info['id_commission']?>">
		     		<?
	     		}


	     		//only if referal
	     		?>
     	<input class="book_but" type="submit" name="invoice" value="Print Invoice" onClick="this.disabled=true; this.value='Printing...'; this.form.submit(); document.ckin.checkin.disabled=false;"/></p>

	    <!--//PAYABLE TO://-->

	    </form>

		</td><td bgcolor="#CC3300" style="border: 1px solid #D5D5D5; border-radius: 5px 5px 5px 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.15); margin-bottom: 20px; padding:5px;">

		<form  name="register_sheet" method="post" action="customers_register_print.php" target="_blank">
	     <input type="hidden" name="ref" value="<?=$ref?>"/>
	     <p id="fields" style="padding-right:5px; text-align:left;">Language:<br/> <select name="lang" ><option value="1" selected="selected">English</option><option value="2">Spanish</option></select> <input class="book_but" type="submit" name="register" value="Register Sheet" onClick="this.disabled=true; this.value='Printing...'; this.form.submit();" /></p>

	    </form>

		</td></tr></table>
	    <!--<p> <img src="images/button/invoice.jpg"  border="0" width="106" height="20"/> &nbsp; <img src="images/button/register_sheet.jpg"  border="0" width="117" height="18"/></p>-->
	    </div></td></tr><tr><td>

	    <form  name="ckin" method="post" action="check_in_confirm.php">
	    <input type="hidden" name="id" value="<?=$id?>" />
	    <input type="hidden" name="r" value="<?=$ref?>" />
	    <input type="hidden" name="estado" value="<?=$busy_details[0]['status']?>" />

	    <input class="book_but" type="submit" name="checkin" value="Confirm" disabled="disabled" />
	    </form>
	    </td></tr></table>
	    <? }else{
	    $link=new DB(); //connect to db
	     if (($_POST['estado']==2)||($_POST['estado']==3)) $status="1";
	     if (($_POST['estado']==12)||($_POST['estado']==13)) $status="6";
	     if (($_POST['estado']==19)||($_POST['estado']==20)) $status="7";
	    $result=$link->check_in($id,$status); //update an reserve as checked in
	    //print_r($result);
	    //echo $id;
	    $id_checkin=$link->check_in_insert($ref, $date, $id_adm); //save record for checked in
	    //==============INSERT A COMMENT AS A BOOKING CHANGE IN A EDITION OF A BOOKING=========================
   				  $fecha=date("Y-m-d G:i:s");
                  $insert_comment=$link->insert_comments($ref,'',$tipo='4'/*mean booking changed*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='1'/*mean check in*/, $id_villa='', $id_ocupacion_mod=$id_checkin);
		//=====================================================================================================
	    echo '<p style=\'text-align:center\' ><img src=\'images/home/checkin_icon2.png\' width=\'68\' height=\'83\'></p>';
		echo '<h2 style=\'text-align:center\'>Checked in successfully</h2>';
	    }
     }//END IF IT IS SHORT TERM -1

     if (($busy_details[0]['status']==9) || ($busy_details[0]['status']==10)){
     	$link=new DB(); //connect to db
	    $status="8";
	    $result=$link->check_in($id,$status); //update an reserve as checked in
	    //print_r($result);
	    //echo $id;
	    $id_checkin=$link->check_in_insert($ref, $date, $id_adm); //save record for checked in
	    echo '<p style=\'text-align:center\' ><img src=\'images/home/checkin_icon2.png\' width=\'68\' height=\'83\'></p>';
		echo '<h2 style=\'text-align:center\'>Checked in successfully</h2>';
     }// END IF IT IS LONG TERM-8

     if (($busy_details[0]['status']==16) || ($busy_details[0]['status']==17)){
        $link=new DB(); //connect to db
	    $status="15";
	    $result=$link->check_in($id,$status); //update an reserve as checked in
	    //print_r($result);
	    //echo $id;
	    $id_checkin=$link->check_in_insert($ref, $date, $id_adm); //save record for checked in
	    echo '<p style=\'text-align:center\' ><img src=\'images/home/checkin_icon2.png\' width=\'68\' height=\'83\'></p>';
		echo '<h2 style=\'text-align:center\'>Checked in successfully</h2>';


     }// END IF IT IS VIP LONG TERM-15


     if (($busy_details[0]['status']==23) || ($busy_details[0]['status']==24)){
        $link=new DB(); //connect to db
	    $status="22";
	    $result=$link->check_in($id,$status); //update an reserve as checked in
	    //print_r($result);
	    //echo $id;
	   $id_checkin=$link->check_in_insert($ref, $date, $id_adm); //save record for checked in
	    echo '<p style=\'text-align:center\' ><img src=\'images/home/checkin_icon2.png\' width=\'68\' height=\'83\'></p>';
		echo '<h2 style=\'text-align:center\'>Checked in successfully</h2>';

     }// END IF IT IS OWNER LONG TERM-22

       if (($busy_details[0]['status']==27) || ($busy_details[0]['status']==28)){
        $link=new DB(); //connect to db
	    $status="26";
	    $result=$link->check_in($id,$status); //update an reserve as checked in
	    //print_r($result);
	    //echo $id;
	   $id_checkin=$link->check_in_insert($ref, $date, $id_adm); //save record for checked in
	    echo '<p style=\'text-align:center\' ><img src=\'images/home/checkin_icon2.png\' width=\'68\' height=\'83\'></p>';
		echo '<h2 style=\'text-align:center\'>Checked in successfully</h2>';

     }// END IF IT IS OWNER LONG TERM-22


	  if (($busy_details[0]['status']!=3) && ($busy_details[0]['status']!=2) && ($busy_details[0]['status']!=12) && ($busy_details[0]['status']!=13) && ($busy_details[0]['status']!=19) && ($busy_details[0]['status']!=20)){
          	//==============INSERT A COMMENT AS A BOOKING CHANGE IN A EDITION OF A BOOKING=========================
   				  $fecha=date("Y-m-d G:i:s");
                  $insert_comment=$link->insert_comments($ref,'',$tipo='4'/*mean booking changed*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='1'/*mean check in*/, $id_villa, $id_ocupacion_mod=$id_checkin);
		//=====================================================================================================
      }/*solo si no es de corto plazo*/

}else{
echo("<meta http-equiv=\"refresh\" content=\"0;url=check-in.php\">");
}
    ?>