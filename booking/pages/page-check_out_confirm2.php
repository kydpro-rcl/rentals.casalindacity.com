<?
$vk=$_POST['vk'];//villa key
$sk=$_POST['sk']; //safe key
$fi=$_POST['fi'];//furnishing inventory
$oc=$_POST['oc']; //others charges
$l_check=$_POST['late_checkout'];
$ref=$_POST['ref'];
$id=$_POST['id_reserve'];

if ((!$_POST['ref'])||(!$_POST['id_reserve'])){
echo("<meta http-equiv=\"refresh\" content=\"0;url=check-out.php\">");
//header('Location:check-out.php');
die();
}
$db=new getQueries();
$oc=$db->see_occupancy_ref($_POST['ref']);
     //  $total_generado=$vk+$sk+$fi+$oc+$l_check;
      $cargos_checkout=$vk+$sk+$fi+$l_check;
	if (($vk==0)&&($sk==0)&&($fi==0)&&($l_check==0)){
		
		
		put_villa_dirty($villaid=$oc[0]['villa']);
		
	  //send email to to this client for tripadvisor
		$date=date("Y-m-d G:i:s"); $id_adm=$_SESSION['info']['id'];
		$link=new DB(); //connect to class
		$status="4";
	    $result=$link->check_out($id,$status); //make checkout for this reserve
	    $id_checkout=$link->check_out_insert($ref, $date, $id_adm); //save checkout record
		echo '<p style=\'text-align:center\'><img src=\'images/home/checkout_icon2.png\' width=\'74\' height=\'89\'></p>';
		echo '<h2 style=\'text-align:center\'>Successfully Checked Out</h2>';

		  //enviar email de trip advisor.
	        /*$db= new getQueries();
	        $cl=$db->customer($oc[0]['client']);//get cliente details
	         if($_POST['tripadvisor']=="yes"){
	   			$tripadvisor1=sent_tripadvisor_request($cl, $ref);
	   			echo $tripadvisor1;
	   		 }
              */

    	//==============INSERT A COMMENT AS A BOOKING CHANGE IN A EDITION OF A BOOKING=========================
   				  $fecha=date("Y-m-d G:i:s");
                  $insert_comment=$link->insert_comments($ref,'',$tipo='4'/*mean booking changed*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='2'/*mean check out*/, $id_villa, $id_ocupacion_mod=$id_checkout);
		//=====================================================================================================
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
	        #$db= new getQueries();
	        /*$cl=$db->customer($oc[0]['client']);//get cliente details */
           /*
	        $owner=$db->show_id('owners', $oc[0]['client']); //if owner staying
	        $cl=$owner[0];//get owner details
	         if($_POST['tripadvisor']=="yes"){
	        	$tripadvisor1=sent_tripadvisor_request($cl, $ref);
	        	echo $tripadvisor1;
	         }

            */

          //==============INSERT A COMMENT AS A BOOKING CHANGE IN A EDITION OF A BOOKING=========================
   				  $fecha=date("Y-m-d G:i:s");
                  $insert_comment=$link->insert_comments($ref,'',$tipo='4'/*mean booking changed*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='2'/*mean check out*/, $id_villa, $id_ocupacion_mod=$id_checkout);
		//=====================================================================================================

	}elseif($cargos_checkout>0){
		?>
	    <h2>Charge Per Check Out Generated</h2>
	    <hr />
	    <p class="paraf"><span style="color:red">Note:</span> This client must pay the checkout invoce befere leave. Print the invoice, below.</p>
	    <p class="paraf"><span style="color:red">Nota:</span> Este Cliente tiene que pagar la factura de checkout antes de irse. Imprima la factura, mas abajo.</p>

	    <form method="post" name="invoice" target="_blank" action="invoice_per_checkout.php">
		 <table align="center" width="500"><tr><td>
	     <fieldset style="width:250" align="center"><legend>Invoice per Check out</legend>
		<?

		//si late out ->$l_check value + taxs - only service
		if ($vk==1){// if lost villa key
			//echo $vk.' VK<br>';
			$desc1='Lost villa key';
			$price_per_vk=50;
			echo '<P id=\'fields\'> US$ '.$price_per_vk.' Charged per '.$desc1.'</p>';
			?>
			<input type="hidden" name="desc1" value="<?=$desc1?>" />
	        <input type="hidden" name="price1" value="<?=$price_per_vk?>" />
	        <?
		}

		if ($sk==1){// if lost safe key
			$desc2='Lost safe key';
			$price_per_sk=150;
			//echo $sk.' SK<br>';
			echo '<P id=\'fields\'> US$ '.$price_per_sk.' Charged per '.$desc2.'</p>';
			?>
			<input type="hidden" name="desc2" value="<?=$desc2?>" />
	        <input type="hidden" name="price2" value="<?=$price_per_sk?>" />
	        <?
		}

		if ($fi==1){ //if broken furnishing
			//si $fi desc + price included 16$
			?>
	        <p id="fields" style="text-align:center; color:#09F;">FURNISHING AND/OR INVENTORY</p>
	       <p id="fields">Description <input type="text" name="desc3" value="" class="input" /> Price <input type="text" name="price3" value="" class="input" /></p>

	        <?
			//echo $fi.' FI<br>';
		}

		if ($oc==1){ //if other charge
			//si $oc desc + price included 16$
			?>
	        <p id="fields" style="text-align:center; color:#09F;">OTHER CHARGES</p>
	        <p id="fields" >Description <input class="input" type="text" name="desc4" value="" /> Price <input type="text" name="price4" value="" size="5" class="input" /></p>

	        <?
			//echo $oc.' OC<br>';
		}

		if ($l_check>0){ //invoice per services - value of late check out
			$desc5='Late Check Out';
			$price_per_ckout=$l_check;
			echo '<P id=\'fields\'> US$ '.$price_per_ckout.' Charged per '.$desc5.'</p>';
			?>
			<input type="hidden" name="desc5" value="<?=$desc5?>" />
	        <input type="hidden" name="price5" value="<?=$price_per_ckout?>" />
	        <?
		}
		?>

	    <input type="hidden" name="ref" value="<?=$ref?>" />
	    <input type="hidden" name="id_reserva" value="<?=$id?>" />
	    <p id="fields"><input class="book_but" type="submit" value="Print Invoice" onClick="this.disabled=true; this.value='Printing...'; this.form.submit(); document.ckout.checkout.disabled=false;"/></p>
	    </fieldset>
	    </form>
	    </td></tr></table>

	    <form method="post"  name="ckout" target="_self" action="check_out_done.php">
	    <input type="hidden" name="ref" value="<?=$ref?>" />
	    <input type="hidden" name="id_reserva" value="<?=$id?>" />
	    <input type="hidden" name="tripadvisor" value="<?=$_POST['tripadvisor']?>" />
	    <p><input class="book_but" type="submit" name="checkout" value="Checkout"  disabled="disabled" /></p>
	    </form>
	    <?
	}
?>
