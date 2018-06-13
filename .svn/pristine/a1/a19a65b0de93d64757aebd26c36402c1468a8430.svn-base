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
	<form method="post" action="m.booking_details.php" >
	<fieldset id="fieldsets"><legend id="legends" style="color:#9c0000;font-weight:bold;">Already a Customer?</legend>
	
	<p class="parrafo">Email:<input type="text" name="mail" value="<?=$_POST['mail']?>" /></p>
	<p class="parrafo">Password: <input type="password" name="pass" value="<?=$_POST['pass']?>"  /><input type="submit" name="login" value="login" class="boton" /></p>
	<p style="text-align:center;">
	<a href="forgot_pass.php" alt="" target="_blank">Forgot your password?</a> /
	<a href="change_pass.php" alt="" target="_blank">Change your password</a>
	</p>
	<p style="text-align:center" id="error_s"><?=$_GET['e']['both']?></p>
	
	</fieldset>
	</form>
 <?}?>
<hr style="border: 1px solid #9c0000;"/>

<p>&nbsp;</p>
<!--<p class="header">Customer Details</p>-->
<!--<hr />-->
<form name="new_villa" method="post"  action="m.PayPal/ReviewOrder.php" >

 <? if (!$_SESSION['customer']){?>
 
	<p class="parrafo">
		<span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span>&nbsp;Name:&nbsp;<input class="input" type="text" name="name"  value="<?=$_SESSION['C']['n']?>" />
	                       <span id="error_s"><?=$_SESSION['error']['name']?></span>
	</p>
	<p class="parrafo">
		<span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span>&nbsp;Last&nbsp;name:<input class="input" type="text" name="lastname"  value="<?=$_SESSION['C']['ln']?>" />
	                       <span id="error_s"><?=$_SESSION['error']['lastname']?></span>

	</p>
	
	<p class="parrafo"> 
		Passport: <input class="input" type="text" name="passport"  value="<?=$_SESSION['C']['p']?>" />
									<span id="error_s"><?=$_GET['error']['passport']?></span>
	</p>								
	<p class="parrafo">								
		Cedula:<input class="input" type="text" name="cedula"  value="<?=$_SESSION['C']['c']?>" />
							   <span id="error_s"><?=$_GET['error']['cedula']?></span>	
	</p>						   
	
	<p class="parrafo">		
	<span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span> E-mail:	
	 <input class="input" type="text" name="email"  value="<?=$_SESSION['C']['el']?>" />
							   <span id="error_s"><?=$_SESSION['error']['email']?></span>
	</p>							
	<p class="parrafo">								
	<span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span>&nbsp;Phone:&nbsp;<input class="input" type="text" name="phone"  value="<?=$_SESSION['C']['ph']?>" />
								<span id="error_s"><?=$_SESSION['error']['phone']?></span>
	</p>

	<p class="parrafo">								
			<span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span>Password:						
			<input class="input" type="password" name="password"  value="<?=$_SESSION['C']['pa']?>" /><span id="error_s"><?=$_SESSION['error']['pass']?></span>
			<br/><a href="#" onMouseover="ddrivetip('Must be minimum 6 characters; It will be use for future bookings.','yellow', 200)"; onMouseout="hideddrivetip()" ><span style="font-size:9px;">What&nbsp;is&nbsp;this?</span></a>
	</p>
	<p class="parrafo">			
			Language:
						<select class="input" name="language" >
							<?
							$idiomas=languageArray();
							foreach($idiomas as $k=>$v){?>
								<option value="<?=$k?>" <? if ($_SESSION['C']['lg']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
							<? } ?>
						</select>
	</p>							
      
	<p class="parrafo">	
		Country:	
		  <select class="input" id='countrySelect' name='country'  onchange='populateState()'>
		    		   </select>
	</p>
	<p class="parrafo">	
				  State:
				 	<select class="input" id='stateSelect' name='state'>
					</select>
						
						 <? if (!$_POST['country']) $default="US"; if ($_SESSION['C']['cy']) $default=$_SESSION['C']['cy']; ?>
					            <script type="text/javascript">
					            <!--//
					            initCountry('<?=$default?>');
					            //-->
					     		</script>						
	</p>							
			 
		
	<p class="parrafo">
	City:
					<input class="input" type="text" name="city" value="<?=$_SESSION['C']['city']?>"/>
	</p>				
	<p class="parrafo">			
	                	Address:
	                 
	                    <input class="input" type="text" name="address" size="30"  value="<?=$_SESSION['C']['ad']?>" />
	              
	</p>
 <?}else{?><!--END WITH CLIENT INFO-->
   <h1 style="font-size:18px; color:blue;"><span style="color:black;">Welcome back:</span> <? echo utf8_decode($_SESSION['customer']['name'])." ".utf8_decode($_SESSION['customer']['lastname']); ?></h1>
   <p>&nbsp;</p>
 <?}?>
 
 	<input type="hidden" name="paymentType" value="Sale"/>
	<input type="hidden" name="currencyCodeType" value="USD">
	<?
	$_SESSION['qty_item']="0";
	?>
<? if($_SESSION['noches_LS']>0){?>
	<input type="hidden" name="L_NAME<?=$_SESSION['qty_item'];?>" value="Villa <?=$_SESSION['villa_details']['no']?>">
	<input type="hidden" name="L_AMT<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['price_LS']?>">
	<input type="hidden" name="L_QTY<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['noches_LS']?>">
	<input type="hidden" name="L_DESC<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['noches_LS']?> LS nights">
	<? $itebis_ls=(($_SESSION['villa_details']['p_low']*$_SESSION['noches_LS'])*0.18);
	   $_SESSION['qty_item']++;
	?>
<?}?>
<? if($_SESSION['noches_HS']>0){?>
	<input type="hidden" name="L_NAME<?=$_SESSION['qty_item'];?>" value="Villa <?=$_SESSION['villa_details']['no']?>">
	<input type="hidden" name="L_AMT<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['price_HS']?>">
	<input type="hidden" name="L_QTY<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['noches_HS']?>">
	<input type="hidden" name="L_DESC<?=$_SESSION['qty_item'];?>" value="<?=$_SESSION['noches_HS']?> HS nights">
	<? $itebis_hs=(($_SESSION['villa_details']['p_high']*$_SESSION['noches_HS'])*0.18);
	$_SESSION['qty_item']++;
	?>
<?}?>	
	<input type="hidden" name="TAXAMT" value="<?=number_format(($itebis_ls+$itebis_hs),2)?>">
	
<fieldset class="fieldsets" ><legend id="legends">Bookings information</legend>
 <p class="parrafo">Adults:
     <select name="adults">
           <? for ($i=1; $i<=$_SESSION['villa_details']['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($_SESSION['C']['a'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
      </select>&nbsp;
         Children:
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
}elseif(($daysToStart>=1)&&($daysToStart<=7)){
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
 <li style="list-style:none; float:left;">
                                            <table border=0><tr><td>
											<input type="radio" id="payWithCC" name="PaymentType" value="CC" class="pay-select"  checked="true" style="margin:30px 3px 0; margin-bottom:15px;padding-bottom:15px;"  />
											</td><td>
                                            <label for="payWithCC" class="clickable">
                                                <img src="images/PPCCLOGO.jpg"    alt="Credit Card" />
                                                <p style="margin: 2px 0 0 0;text-align:left;"><span style="margin: 0 0 0 3px;color:#00bcfc;font-weight:bold;font-size:10px;">Debit or Credit Card</span></p>
                                            </label>
											</td></tr></table>
                                        </li>
                                        <li style="height: 75px; list-style:none; float:left;clear:right;">
										<table border=0><tr><td>
                                            <input type="radio" id="payWithPP" name="PaymentType" value="PayPal" class="pay-select"  />
											</td><td align="left">
                                            <label for="payWithPP" class="clickable" style="position:relative; top:0px;">
                                                <img src="images/PPPPLOGO.jpg"   alt="PayPal" />
                                                <p style="margin: 2px 0 0 0;text-align:left;"><span style="margin: 0 0 0 3px;color:#00bcfc;font-weight:bold;font-size:10px;">PayPal Account</span></p>
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

I Agree to <a href="http://casalindacity.mobi/terms-and-conditions/" target="_blank" alt="Terms and Conditions">RCL Terms and Conditions.</a> &nbsp;<!--<input id="mybutton" type="submit" disabled="disabled" name="new_client"  value="Continue booking"  class="" />-->

<? if ($_SESSION['error']['agree']){?><br /><span id="error_s"><?=$_SESSION['error']['agree']?></span><?}?></p>
<p style="text-align:right; padding-right:12px; clear:both;"><input type="image" name="submit" src="images/Check_out_0.png" /></p>
</form>

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