<?php
if ($_POST['sender']=="valid"){
	if($_POST['T_nights']>30){ die('error on length');}
	$db=new getQueries ();
	unset($_SESSION['total']); $_SESSION['total']=$_POST['g_total'];//$_SESSION['total']=number_format($_POST['g_total'],2);
	unset($_SESSION['desde']); $_SESSION['desde']=$_POST['desde'];
	unset($_SESSION['hasta']); $_SESSION['hasta']=$_POST['hasta'];
	unset($_SESSION['total_noches']); $_SESSION['total_noches']=$_POST['T_nights'];
	unset($_SESSION['noches_LS']); $_SESSION['noches_LS']=$_POST['LS_nights'];
	unset($_SESSION['noches_HS']); $_SESSION['noches_HS']=$_POST['HS_nights'];
	unset($_SESSION['itbis']);$_SESSION['itbis']=$_POST['itbis'];// $_SESSION['itbis']=number_format($_POST['itbis'],2);
	unset($_SESSION['villa']); $_SESSION['villa']=$_POST['v'];
	unset($_SESSION['villa_details']);
		$informacion_villa=$db->villa($_SESSION['villa']);
		$_SESSION['villa_details']=$informacion_villa[0];
		$_SESSION['villa_details']['p_low']=$_POST['LS_price'];
		$_SESSION['villa_details']['p_high']=$_POST['HS_price'];
}
//print_r($_GET['error']); echo "Error";
if ($_POST['services']=="Next"){
	unset($_SESSION['massage']); $_SESSION['massage']=$_POST['massage'];
	unset($_SESSION['pickup']); $_SESSION['pickup']=$_POST['pickup'];
	unset($_SESSION['fridge']); $_SESSION['fridge']=$_POST['fridge'];
	unset($_SESSION['VIPpickup']); $_SESSION['VIPpickup']=$_POST['VIPpickup'];
	unset($_SESSION['chef']); $_SESSION['chef']=$_POST['chef'];
	unset($_SESSION['comment']); $_SESSION['comment']=$_POST['comment'];
 }
?>
<p>&nbsp;</p>
<h1 style="text-align:center">Client information</h1>
<link type="text/css" rel="stylesheet" href="../for_rent/steps/style.css">
<?
if ($_GET['clie']>0){
	$coneccion=new subDB;
	$customerinfo=$coneccion->customerDetails($_GET['clie']);
	if ($customerinfo) $_SESSION['customer'] = $customerinfo;
}
if ($_GET['clie']=="none") { unset($_SESSION['customer']);}
?>
<!--//End showing steps//-->
<form name="new_villa" method="post"  action="create_booking4.php" >
 <? if (!$_SESSION['customer']){
	 $data= new getQueries ();
	 $customers=$data->show_data('customers', "`id_commission`='".$_SESSION['referal']['id']."'", 'country');
	 ?>
	<fieldset id="fieldsets"><legend id="legends">Customer Registered?</legend>
	<p style="text-align:center">Choose client: <select name="client_id" onchange="window.location='create_booking3.php?clie='+this.value" > <option value="none">None</option> <? foreach ($customers as $cu){?>
			<option value="<?=$cu['id']?>" <? if ($_POST['client_id']==$cu['id']) echo 'selected="selected"';?>><?=$cu['name']." ".$cu['lastname'];?></option>
		<? } ?></select></p>
	</fieldset>
 <?}?>
<hr />
<p>&nbsp;</p>
 <? if (!$_SESSION['customer']){?>
	<fieldset id="fieldsets"><legend id="legends">Customer Details (Only if it is not registered)</legend>
	<table border="0" align="center" width="716" cellpadding="2" cellspacing="0">
		<tr>
	    	<td rowspan="2" >
				<table>
	            	<tr>
	                	<td align="right">
	                        <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Name:
	                     </td>
	                     <td>
	                        <input class="input" type="text" name="name"  value="<?=$_POST['name']?>" />
	                        <br /><span id="error_s"><?=$_GET['error']['name']?></span>
	                     </td>
	                 </tr>
	                 <tr>
	                 	<td align="right">
	                        <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span>&nbsp;Last&nbsp;name:
	                     </td>
	                     <td>
	                        <input class="input" type="text" name="lastname"  value="<?=$_POST['lastname']?>" />
	                        <br /><span id="error_s"><?=$_GET['error']['lastname']?></span>
	                     </td>
	                  </tr>
	                  <tr>
	                  	<td align="right">
	                       Passport:
	                    </td>
	                    <td>
	                        <input class="input" type="text" name="passport"  value="<?=$_POST['passport']?>" />
	                        <br /><span id="error_s"><?=$_GET['error']['passport']?></span>
	                     </td>
	                  </tr>
	                  <tr>
	                  	<td align="right">
	                        Cedula:
	                     </td>
	                     <td>
	                        <input class="input" type="text" name="cedula"  value="<?=$_POST['cedula']?>" />
	                        <br /><span id="error_s"><?=$_GET['error']['cedula']?></span>
	                     </td>
	                   </tr>
	                   <tr>
	                   	 <td align="right">
	                        <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> E-mail:
	                     </td>
	                     <td>
	                        <input class="input" type="text" name="email"  value="<?=$_POST['email']?>" />
	                        <br /><span id="error_s"><?=$_GET['error']['email']?></span>
	                      </td>
	                    </tr>
						 <tr>
	                   	 <td align="right">
	                        <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span>Confirm email:
	                     </td>
	                     <td>
	                        <input class="input" type="text" name="email2"  value="<?=$_POST['email']?>" />
	                        <br /><span id="error_s"><?=$_GET['error']['email']?></span>
	                      </td>
	                    </tr>
	                    <tr>
	                    	<td align="right">
	                        <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Phone:
	                        </td>
	                        <td>
	                       <input class="input" type="text" name="phone"  value="<?=$_POST['phone']?>" />
	                        <br /><span id="error_s"><?=$_GET['error']['phone']?></span>
	                        </td>
	                    </tr>
	                    <tr>
	                    	<td align="right">
	                        Phone 2:
	                        </td>
	                        <td >
	                        <input class="input" type="text" name="phone2"  value="<?=$_POST['phone2'];?>" />
	                        </td>
	                    </tr>
	                    <tr>
	                        <td align="right">
	                        	Fax:
	                        </td>
	                     	<td>
	                        	<input class="input" type="text" name="fax"  value="<?=$_POST['fax']?>" />
	                        </td>
	                    </tr>
	         </table>
			</td>
			<td>
	           <table>
	           <tr>
	           		<td align="right">
	                	Language:
	                </td>
	                <td>
	                <select class="input" name="language" >
	                    <?
	                    $idiomas=languageArray();
	                    foreach($idiomas as $k=>$v){?>
	                        <option value="<?=$k?>" <? if ($_POST['language']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
	                    <? } ?>
	                </select>
	                </td>
	            </tr>
	             <tr>
	           		<td align="right">
	                Country:
	                </td>
	                <td>
			           <select class="input" id='countrySelect' name='country'  onchange='populateState()'>
		    		   </select>
	            <!--//BELOW STARTING CITIES FOR COUNTRY//-->
                   </td>
				<tr>
				 <td align="right">State/Province: </td>
				 <td>
     					<select class="input" id='stateSelect' name='state'>
					    </select>
					         <? if (!$_POST['country']) $default="CA"; if ($_POST['country']) $default=$_POST['country']; ?>
					            <script type="text/javascript">initCountry('<?=$default?>');
					     		</script>
					</td>
				</tr>
				<tr>
					<td align="right">City/Town:</td>
					<td><input class="input" type="text" name="city" value="<?=$_POST['city']?>"/></td>
				</tr>
	           <!--//country state end//-->

	           <tr>
	           		<td align="right">
	                Zip:
	                 </td>
	                <td>
	                <input class="input" type="text" name="zip"  value="<?=$_POST['zip']?>" /></p>
	             </td>
	           </tr>
	           <tr>
	           		<td align="right">
	                	Address:
	                   </td>
	                <td>
	                    <input class="input" type="text" name="address" size="35"  value="<?=$_POST['address']?>" />
	                  </td>
	          </tr>
	             </table>
	            <fieldset id="fieldsets"><legend id="legends">Emergency Contact</legend>
	                <p id="fields">Name: <input class="input" type="text" name="name_emerg" size="35"  value="<?=$_POST['name_emerg']?>" /></p>
	        		<p id="fields">Phone: <input class="input" type="text" name="phone_emerg"  value="<?=$_POST['phone_emerg']?>" /></p>
	        	</fieldset>
			</td>
	   </tr>
	</table>
	</fieldset>
 <?}else{?><!--END WITH CLIENT INFO-->
   <h1 style="font-size:18px; color:blue;"><span style="color:black;">Client Selected:</span> <? echo utf8_decode($_SESSION['customer']['name'])." ".utf8_decode($_SESSION['customer']['lastname']); ?></h1>
   <p>&nbsp;</p>
   <?
    $data= new getQueries ();
	 $customers=$data->show_data('customers', "`id_commission`='".$_SESSION['referal']['id']."'", 'country');
	 ?>
	<p style="text-align:center">Choose another Client: <select name="client_id"  onchange="window.location='create_booking3.php?clie='+this.value"> <option value="none">None</option> <? foreach ($customers as $cu){?>
			<option value="<?=$cu['id']?>" <? if ($cu['id']==$_SESSION['customer']['id']) echo 'selected="selected"';?>><?=$cu['name']." ".$cu['lastname'];?></option>
		<? } ?></select></p>
 <?}?>
<fieldset id="fieldsets"><legend id="legends">Bookings information</legend>
 <p id="fields">Adults coming:
     <select name="adults">
           <? for ($i=1; $i<=$_SESSION['villa_details']['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
      </select>&nbsp;
         Children coming:
      <select name="kids">
         <? for ($i=0; $i<=$_SESSION['villa_details']['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
      </select><br/>
	  <!-- &nbsp;/* Promotion code:<input type="text" size="7" name="promotion_code" value="<?=$_POST['promotion_code']?>" /> -->
	  
	  <?php
	  $price_settings=$data->show1_active('price_settings');  //get the price settings details
	  
	  ?>
	  Discount from my commision:
      <select name="discountc">
	  <?php if($_SESSION['total_noches']>=$price_settings['mid_m_night']){?>
	  
			<? for ($i=0; $i<=($_SESSION['referal']['long_percent']*100);$i+=5){?>
				<option value="<?=$i?>" <? if ($post['discout'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>

	  <?php }else{?>
		   
		   <? for ($i=0; $i<=($_SESSION['referal']['percent']*100);$i+=5){?>
				<option value="<?=$i?>" <? if ($post['discout'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	  <?php } ?>
      </select> %
</p>
</fieldset>
<!--<p><a href="create_booking2.php"><img src="images/goback.jpg" alt="Go Back" border="0" /></a></p>-->
<p style="text-align:right; padding-right:12px;"><input type="checkbox" name="agree" id="myCheck" onclick="" />
<script type="text/javascript">
function f_boxcheck()
{

if(document.getElementById("myCheck").checked){
document.getElementById("mybutton").disabled=false;

}else {document.getElementById("mybutton").disabled=true;}
}

document.getElementById("myCheck").onclick=f_boxcheck;
</script>
<!---->

I Agree to <a href="http://casalindacity.com/Terms_and_conditions.php" target="_blank" alt="Terms and Conditions">RCL Terms and Conditions.</a> &nbsp;<input id="mybutton" type="submit" disabled="disabled" name="new_client"  value="Continue"  class="book_but" /><? if ($_GET['error']['agree']){?><br /><span id="error_s"><?=$_GET['error']['agree']?></span><?}?></p>
<p>&nbsp;</p>
</form>
