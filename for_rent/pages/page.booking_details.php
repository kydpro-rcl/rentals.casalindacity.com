<?php
$db=new getQueries ();
if ($_POST['continuar']=="continue"){
	unset($_SESSION['total']); $_SESSION['total']=$_POST['g_total'];
	unset($_SESSION['desde']); $_SESSION['desde']=$_POST['desde'];
	unset($_SESSION['hasta']); $_SESSION['hasta']=$_POST['hasta'];
	unset($_SESSION['total_noches']); $_SESSION['total_noches']=$_POST['T_nights'];
	unset($_SESSION['noches_LS']); $_SESSION['noches_LS']=$_POST['LS_nights'];
	unset($_SESSION['noches_HS']); $_SESSION['noches_HS']=$_POST['HS_nights'];
	unset($_SESSION['price_LS']); $_SESSION['price_LS']=$_POST['LS_price'];
	unset($_SESSION['price_HS']); $_SESSION['price_HS']=$_POST['HS_price'];
	unset($_SESSION['itbis']);$_SESSION['itbis']=$_POST['itbis'];
	unset($_SESSION['villa']); $_SESSION['villa']=$_POST['v'];
	if($_POST['agent']!=''){
		unset($_SESSION['agent_id']); $_SESSION['agent_id']=$_POST['agent'];
	}
	unset($_SESSION['villa_details']);

		$informacion_villa=$db->villa($_SESSION['villa']);
		$_SESSION['villa_details']=$informacion_villa[0];
}

?>

<h3 style="color:#06F; text-align:center;">BOOKING DETAILS:<br/>
	 <span style="color:#cc1c0a; text-transform:uppercase;">Villa No. <?=$_SESSION['villa_details']['no']?> (<?=$_SESSION['villa_details']['bed']?> Bedrooms)</span><br/>
	 From:  <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['desde'])))?></span> To: <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['hasta'])))?></span></h3>
 <!--//<p style="background-color:#FFF; color:#cc1c0a;">NOTE: After provide your detials, please, agree to our Terms and Conditions and then click "Continue booking" button at the bottom</p>//-->


<!--//End showing steps//-->
 <? if (!$_SESSION['customer']){?>
	<form method="post" action="booking_details.php" style="background-color:#FFF; ">
	<fieldset id="fieldsets"><legend id="legends" style="color:#9c0000;font-weight:bold;">Already a Customer?</legend>
	<p style="text-align:center; color:#9c0000;">Email:<input type="text" name="mail" value="<?=$_POST['mail']?>" /> Password: <input type="password" name="pass" value="<?=$_POST['pass']?>"  />
	<input type="submit" name="login" value="login" class="boton" /><br/>
	 <a href="JavaScript:void(0);" onclick="windowOpener('350','500','Fogotten_Password','forgot_pass.php');" alt="" >Forgot your password?</a> /
	<a href="JavaScript:void(0);" onclick="windowOpener('350','500','Fogotten_Password','change_pass.php');" alt="" >Change your password</a></p>
	<p style="text-align:center" id="error_s"><?=$_GET['e']['both']?></p>
	</fieldset>
	</form>
 <?}?>
<hr style="border: 1px solid #9c0000;"/>

<p>&nbsp;</p>
<!--<p class="header">Customer Details</p>-->
<!--<hr />-->
<form name="new_villa" method="post"  action="PayPal/ReviewOrder.php" >

 <? if (!$_SESSION['customer']){?>
	<fieldset id="fieldsets"><legend id="legends">Customer Details</legend>


	<table border="0" align="center" width="" cellpadding="2" cellspacing="0">
		<tr>
	    	<td rowspan="2" >
				<table>
	            	<tr>
	                	<td align="right">
	                        <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Name:
	                     </td>
	                     <td>
	                        <input class="input" type="text" name="name"  value="<?=$_SESSION['C']['n']?>" />
	                        <br /><span id="error_s"><?=$_SESSION['error']['name']?></span>
	                     </td>
	                 </tr>
	                 <tr>
	                 	<td align="right">
	                        <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span>&nbsp;Last&nbsp;name:
	                     </td>
	                     <td>
	                        <input class="input" type="text" name="lastname"  value="<?=$_SESSION['C']['ln']?>" />
	                        <br /><span id="error_s"><?=$_SESSION['error']['lastname']?></span>
	                     </td>
	                  </tr>
	                  <tr>
	                  	<td align="right">
	                       Passport:
	                    </td>
	                    <td>
	                        <input class="input" type="text" name="passport"  value="<?=$_SESSION['C']['p']?>" />
	                        <br /><span id="error_s"><?=$_GET['error']['passport']?></span>
	                     </td>
	                  </tr>
	                  <tr>
	                  	<td align="right">
	                        Cedula:
	                     </td>
	                     <td>
	                        <input class="input" type="text" name="cedula"  value="<?=$_SESSION['C']['c']?>" />
	                        <br /><span id="error_s"><?=$_GET['error']['cedula']?></span>
	                     </td>
	                   </tr>
	                   <tr>
	                   	 <td align="right">
	                        <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> E-mail:
	                     </td>
	                     <td>
	                        <input class="input" type="text" name="email"  value="<?=$_SESSION['C']['el']?>" />
	                        <br /><span id="error_s"><?=$_SESSION['error']['email']?></span>
	                      </td>
	                    </tr>
						<tr>
	                   	 <td align="right">
	                        <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Confirm Email:
	                     </td>
	                     <td>
	                        <input class="input" type="text" name="cemail"  value="<?=$_SESSION['C']['el']?>" />
	                        <br /><span id="error_s"><?=$_SESSION['error']['email']?></span>
	                      </td>
	                    </tr>
	                    <tr>
	                    	<td align="right">
	                        <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> Phone:
	                        </td>
	                        <td>
	                       <input class="input" type="text" name="phone"  value="<?=$_SESSION['C']['ph']?>" />
	                        <br /><span id="error_s"><?=$_SESSION['error']['phone']?></span>
	                        </td>
	                    </tr>
	                    <tr>
	                    	<td align="right">
	                        Phone 2:
	                        </td>
	                        <td >
	                        <input class="input" type="text" name="phone2"  value="<?=$_SESSION['C']['ph2'];?>" />
	                        </td>
	                    </tr>
	                    <tr>
	                        <td align="right">
	                        	Fax:
	                        </td>
	                     	<td>
	                        	<input class="input" type="text" name="fax"  value="<?=$_SESSION['C']['fx']?>" />
	                        </td>
	                    </tr>
	                    <tr>
	           		<td align="right">
	                <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span>Password:
	                 </td>
	                <td>
	                <input class="input" type="password" name="password"  value="<?=$_SESSION['C']['pa']?>" /><a href="#" onMouseover="ddrivetip('Must be minimum 6 characters; It will be use for future bookings.','yellow', 200)"; onMouseout="hideddrivetip()" ><span style="font-size:9px;">What&nbsp;is&nbsp;this?</span></a>
	                <br /><span id="error_s"><?=$_SESSION['error']['pass']?></span>


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
	                        <option value="<?=$k?>" <? if ($_SESSION['C']['lg']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
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
				 <td align="right">State: </td>
				 <td>

     					<select class="input" id='stateSelect' name='state'>
					    </select>
					         <? if (!$_POST['country']) $default="US"; if ($_SESSION['C']['cy']) $default=$_SESSION['C']['cy']; ?>
					            <script type="text/javascript">
					            <!--//
					            initCountry('<?=$default?>');
					            //-->
					     		</script>
					</td>
				</tr>


				<tr>
					<td align="right">City:</td>
					<td><input class="input" type="text" name="city" value="<?=$_SESSION['C']['city']?>"/></td>
				</tr>
	           <!--//country state end//-->

	           <tr>
	           		<td align="right">
	                Zip:
	                 </td>
	                <td>
	                <input class="input" type="text" name="zip"  value="<?=$_SESSION['C']['zp']?>" /></p>
	             </td>
	           </tr>
	           <tr>
	           		<td align="right">
	                	Address:
	                   </td>
	                <td>
	                    <input class="input" type="text" name="address" size="30"  value="<?=$_SESSION['C']['ad']?>" />
	                  </td>
	          </tr>

	          <tr>
	           		<td align="right">

	                </td>
	                <td ><!--onchange="window.location='booking_details.php?ref='+this.value"-->
	                How did you hear about us?:<br/>
	                <select name="hear_about" >
	                    <option value="Internet" selected="selected">Internet</option>
	                    <option value="Friend/Family" >Friend/Family</option>
	                    <option value="Promotional_Material" >Promotional Material</option>
	                    <option value="Referal" >Referal</option>

	                 </select>

	                 <br /><span style="font-size:9px; color:red;"> Referal Name:</span><span style="font-size:9px;">(ONLY IF REFERAL)</span> <br /> <input type="text" name="referal_name" value="<?=$_POST['referal_name']?>"/>

	                </td>
	              </tr>
	             </table>


	            <fieldset id="fieldsets" style="width:300px;"><legend id="legends">Emergency Contact</legend>
	                <p id="fields">Name: <input class="input" type="text" name="name_emerg" size="35"  value="<?=$_SESSION['C']['ne']?>" /></p>
	        		<p id="fields">Phone: <input class="input" type="text" name="phone_emerg"  value="<?=$_SESSION['C']['phe']?>" /></p>
	        	</fieldset>
			</td>
	   </tr>
	</table>
	</fieldset>
 <?}else{?><!--END WITH CLIENT INFO-->
   <h1 style="font-size:18px; color:blue;"><span style="color:black;">Welcome back:</span> <? echo utf8_decode($_SESSION['customer']['name'])." ".utf8_decode($_SESSION['customer']['lastname']); ?></h1>
   <p>&nbsp;</p>
 <?}?>
 
 	<input type="hidden" name="paymentType" value="Sale"/>
	<input type="hidden" name="currencyCodeType" value="USD">
	<?
	/*apply promotion*/

	if($_SESSION['promo_id']){
	
		$total_noches=$_SESSION['noches_LS']+$_SESSION['noches_HS'];
		switch($_SESSION['promo_type']){
			case 1:/*percent*/
					$_SESSION['price_LS']-=$_SESSION['price_LS']*($_SESSION['promo_amt']/100);
					$_SESSION['price_HS']-=$_SESSION['price_HS']*($_SESSION['promo_amt']/100);
					break;
			case 2:/*amt*/
					
					
					if(($_SESSION['noches_LS']>0)&&($_SESSION['noches_HS']>0)){
						$totalLS=$_SESSION['noches_LS']*$_SESSION['price_LS'];
						$totalLSWithDiscount=$totalLS-($_SESSION['promo_amt']/2);
						$newPriceLS=$totalLSWithDiscount/$_SESSION['noches_LS'];
						
						$TotalHS=$_SESSION['noches_HS']*$_SESSION['price_HS'];
						$TotalHSWithDiscount=$TotalHS-($_SESSION['promo_amt']/2);
						
						$newPriceHS=$TotalHSWithDiscount/$_SESSION['noches_HS'];
						
						$_SESSION['price_LS']=$newPriceLS;
						$_SESSION['price_HS']=$newPriceHS;
					}else{
						if($_SESSION['noches_LS']>0){
							$totalPrice=$total_noches*$_SESSION['price_LS'];
							$totalWithDiscount=$totalPrice-$_SESSION['promo_amt'];
							$newPrice=$totalWithDiscount/$total_noches;
							$_SESSION['price_LS']=$newPrice;
						}
						if($_SESSION['noches_HS']>0){
							$totalPrice=$total_noches*$_SESSION['price_HS'];
							$totalWithDiscount=$totalPrice-$_SESSION['promo_amt'];
							$newPrice=$totalWithDiscount/$total_noches;
							$_SESSION['price_HS']=$newPrice;							
						}
					}
					
					break;
			case 3:/*nights*/
						$LS_nights=$_SESSION['noches_LS'];
						$HS_nights=$_SESSION['noches_HS'];
						$priceLS=$_SESSION['price_LS'];
						$priceHS=$_SESSION['price_HS'];
						
						if($total_noches>=$_SESSION['promo_minDays']){
                        if ($LS_nights!=0 &&  $HS_nights==0){//solo low season
                           $descuento=$priceLS*$_SESSION['promo_amt'];
                        }

                        if (($LS_nights==0)&&($HS_nights!=0)){//solo High season
                           $descuento=$priceHS*$_SESSION['promo_amt'];
                        }

                        if ($LS_nights!=0 &&  $HS_nights!=0){//ambas season
                          if($LS_nights>=$_SESSION['promo_amt']){
                         	$descuento=$priceLS*$_SESSION['promo_amt'];
                          }else{
                          	$descuento=$priceLS*$LS_nights;
                          	$descuento+=$priceHS*($_SESSION['promo_amt']-$LS_nights);
                          }
                        }

							//*promotion converted to amount below
							if(($_SESSION['noches_LS']>0)&&($_SESSION['noches_HS']>0)){
								$totalLS=($_SESSION['noches_LS']*$_SESSION['price_LS']);
								$totalLSWithDiscount=($totalLS-($descuento/2));
								$newPriceLS=($totalLSWithDiscount/$_SESSION['noches_LS']);
								
								$TotalHS=$_SESSION['noches_HS']*$_SESSION['price_HS'];
								$TotalHSWithDiscount=$TotalHS-($descuento/2);
								$newPriceHS=$TotalHSWithDiscount/$_SESSION['noches_HS'];
								
								$_SESSION['price_LS']=$newPriceLS;
								$_SESSION['price_HS']=$newPriceHS;
							}else{
								if($_SESSION['noches_LS']>0){
									$totalPrice=$total_noches*$_SESSION['price_LS'];
									$totalWithDiscount=$totalPrice-$descuento;
									$newPrice=$totalWithDiscount/$total_noches;
									$_SESSION['price_LS']=$newPrice;
								}
								if($_SESSION['noches_HS']>0){
									$totalPrice=$total_noches*$_SESSION['price_HS'];
									$totalWithDiscount=$totalPrice-$descuento;
									$newPrice=$totalWithDiscount/$total_noches;
									$_SESSION['price_HS']=$newPrice;							
								}
							}
                      }
					
					break;
		}
		$_SESSION['price_LS']=number_format($_SESSION['price_LS'],2);
		$_SESSION['price_HS']=number_format($_SESSION['price_HS'],2);
	}
	/*above applied promotion*/
	$_SESSION['qty_item']="0";
	?>
<? if($_SESSION['noches_LS']>0){?>
	<input type="hidden" name="L_NAME<?=$_SESSION['qty_item'];?>" value="Villa <?=$_SESSION['villa_details']['no']?>">
	<input type="hidden" name="L_AMT<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['price_LS']?>">
	<input type="hidden" name="L_QTY<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['noches_LS']?>">
	<input type="hidden" name="L_DESC<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['noches_LS']?> LS nights">
	<? $itebis_ls=(($_SESSION['price_LS']*$_SESSION['noches_LS'])*0.18);
	   $_SESSION['qty_item']++;
	?>
<?}?>
<? if($_SESSION['noches_HS']>0){?>
	<input type="hidden" name="L_NAME<?=$_SESSION['qty_item'];?>" value="Villa <?=$_SESSION['villa_details']['no']?>">
	<input type="hidden" name="L_AMT<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['price_HS']?>">
	<input type="hidden" name="L_QTY<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['noches_HS']?>">
	<input type="hidden" name="L_DESC<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['noches_HS']?> HS nights">
	<? $itebis_hs=(($_SESSION['price_HS']*$_SESSION['noches_HS'])*0.18);
	$_SESSION['qty_item']++;
	?>
<?}?>	
	<input type="hidden" name="TAXAMT" value="<?=number_format(($itebis_ls+$itebis_hs),2)?>">
	
<fieldset id="fieldsets"><legend id="legends">Bookings information</legend>
<div style="width:50%;float:left;">
 <p id="fields">Adults coming:
     <select name="adults">
           <? for ($i=1; $i<=$_SESSION['villa_details']['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($_SESSION['C']['a'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
      </select>&nbsp;
         Children coming:
      <select name="kids">
         <? for ($i=0; $i<=($_SESSION['villa_details']['capacity']/2);$i++){?>
	       <option value="<?=$i?>" <? if ($_SESSION['C']['k'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
      </select>
	  &nbsp;<input type="hidden" name="promotion_code" value="<?=$_SESSION['promotion']?>"/>
</p>
<? 
$data=new subDB();
$daysToStart=$data->daysDifference($_SESSION['desde'],date('Y-m-d'));
/*echo $_SESSION['desde']; echo "<br/>"; echo date('Y-m-d');
echo "<br/>"; echo $daysToStart;*/
if($daysToStart>30){
//1 nights
//50
//100
?>
<p id="fields">Payment to apply now:<select name="paynow">
<option value="1" selected="selected">1 night</option>
<option value="50">50 %</option>
<option value="100" >100 %</option>
</select></p>
<?
}elseif(($daysToStart<=30)&&($daysToStart>8)){
//50
//100
?>
<p id="fields">Payment to apply now:<select name="paynow">
<option value="50" selected="selected">50 %</option>
<option value="100" >100 %</option>
</select></p>
<?
}elseif(($daysToStart>=0)&&($daysToStart<=7)){
//100
?>
<p id="fields">Payment to apply now:<select name="paynow">
<option value="100" selected="selected">100 %</option>
</select></p>
<?
}else{
	die('Unknown remaining day to start');
}
 
 ?>
</div>
 <div style="width:48%;float:right;">
<p id="fields" style="padding:0px; margin:0px;text-align:justify;">Invoices will be sent to you as per cancellation rules (see in terms and conditions). In order to keep your reservation and avoid a cancellation you need to pay accordingly.</p>
</div>

</fieldset>
      <? /*print_r($_SESSION['villa_details']);*//*?>

<!--CAPTCHA-->
<div style="width: 430px; float: left; height: 90px">
      <img id="siimage" width="130px" height="45px" align="left" style="padding-right: 5px; border: 0" src="captchas/securimage_show.php?sid=<?php echo md5(time()) ?>" />

        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
			    <param name="allowScriptAccess" value="sameDomain" />
			    <param name="allowFullScreen" value="false" />
			    <param name="movie" value="captchas/securimage_play.swf?audio=captchas/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
			    <param name="quality" value="high" />

			    <param name="bgcolor" value="#ffffff" />
			    <embed src="captchas/securimage_play.swf?audio=captchas/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			  </object>

        <br />

        <!-- pass a session id to the query string of the script to prevent ie caching -->
        <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'captchas/securimage_show.php?sid=' + Math.random(); return false"><img src="captchas/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
Captcha Code:
<!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
<input type="text" name="code" size="12" value="<?=$_POST['code']?>" /> <span id="error_s"><?=$_GET['error']['captcha']?></span><br /></div>
<!--CAPTCHA-->
<?*/?>
<p>Choose payment method</p>
    <li style="list-style:none; float:left;">
                                            <table border=0><tr><td>
											<input type="radio" id="payWithCC" name="PaymentType" value="CC" class="pay-select"  checked="true" style="margin:30px 3px 0; margin-bottom:15px;padding-bottom:15px;"  />
											</td><td>
                                            <label for="payWithCC" class="clickable">
                                                <img src="images/cclogo.jpg"   alt="Credit Card" />
                                                <p style="margin: 2px 0 0 0;"><span style="margin: 0 0 0 3px;color:#00bcfc;font-weight:bold;font-size:10px;">Debit or Credit Card</span></p>
                                            </label>
											</td></tr></table>
                                        </li>
                                        <li style="height: 75px; list-style:none; float:left;clear:right;">
										<table border=0><tr><td>
                                            <input type="radio" id="payWithPP" name="PaymentType" value="PayPal" class="pay-select"  />
											</td><td>
                                            <label for="payWithPP" class="clickable" style="position:relative; top:0px;">
                                                <img src="images/PPPPLOGO.jpg"  alt="PayPal" />
                                                <p style="margin: 2px 0 0 0;"><span style="margin: 0 0 0 3px;color:#00bcfc;font-weight:bold;font-size:10px;">PayPal Account</span></p>
                                            </label>
											</td></tr></table>
                                        </li>


<p style="text-align:left; padding-right:12px; clear:both;"><input type="checkbox" name="agree" id="myCheck" value="Iagree" onclick="" />
<script type="text/javascript">
<!--
	function f_boxcheck()
	{

	if(document.getElementById("myCheck").checked){
	document.getElementById("mybutton").disabled=false;

	}else {document.getElementById("mybutton").disabled=true;}
	}

	document.getElementById("myCheck").onclick=f_boxcheck;
-->
</script>
<!---->

I Agree to <a href="http://www.casalindacity.com/Terms_and_conditions.php" target="_blank" alt="Terms and Conditions">RCL Terms and Conditions.</a> &nbsp;<!--<input id="mybutton" type="submit" disabled="disabled" name="new_client"  value="Continue booking"  class="" />-->

<? if ($_SESSION['error']['agree']){?> <span id="error_s"><?=$_SESSION['error']['agree']?></span><?}?></p>
<p style="text-align:right; padding-right:12px; clear:both;"><input type="image" name="submit" src="images/Check_out_0.png" /></p>
</form>
<!--<input type="image" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" />-->
<!--<hr />-->
<!--DEBAJO CODIGO PARA LA PEQUENA VENTANITA ONMOUSE OVER-->
<div id="dhtmltooltip"></div>
<script type="text/javascript">

/***********************************************
* Cool DHTML tooltip script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var offsetxpoint=-60 //Customize x offset of tooltip
var offsetypoint=20 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)
var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function ddrivetip(thetext, thecolor, thewidth){
if (ns6||ie){
if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor
tipobj.innerHTML=thetext
enabletip=true
return false
}
}

function positiontip(e){
if (enabletip){
var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20

var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000

//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<tipobj.offsetWidth)
//move the horizontal position of the menu to the left by it's width
tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
else if (curX<leftedge)
tipobj.style.left="5px"
else
//position the horizontal position of the menu where the mouse is positioned
tipobj.style.left=curX+offsetxpoint+"px"

//same concept with the vertical position
if (bottomedge<tipobj.offsetHeight)
tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
else
tipobj.style.top=curY+offsetypoint+"px"
tipobj.style.visibility="visible"
}
}

function hideddrivetip(){
if (ns6||ie){
enabletip=false
tipobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''
}
}

document.onmousemove=positiontip

</script>