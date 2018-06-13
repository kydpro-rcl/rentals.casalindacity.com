<!--// <h3 style="color:#06F; text-align:center;">Booking and customer details</h3>//-->

<?php

//$_GET['pasos']=4;

if ($_POST['services']=="Next"){

	unset($_SESSION['massage']); $_SESSION['massage']=$_POST['massage'];
	unset($_SESSION['pickup']); $_SESSION['pickup']=$_POST['pickup'];
	unset($_SESSION['fridge']); $_SESSION['fridge']=$_POST['fridge'];
	unset($_SESSION['VIPpickup']); $_SESSION['VIPpickup']=$_POST['VIPpickup'];
	unset($_SESSION['chef']); $_SESSION['chef']=$_POST['chef'];

	unset($_SESSION['carros']); $_SESSION['carros']['id']=$_POST['cars'];
	$cant_carro='qtydcars'.$_POST['cars'];	$_SESSION['carros']['qty']=$_POST[$cant_carro];

	unset($_SESSION['chofer']); $_SESSION['chofer']['id']=$_POST['chofer'];
	$cant_chofer='qtydchofer'.$_POST['chofer'];	$_SESSION['chofer']['qty']=$_POST[$cant_chofer];
   /*  echo "cant. chof:".$_POST[$cant_chofer];*/
   unset($_SESSION['laundry']); $_SESSION['laundry']=$_POST['laundry'];
	unset($_SESSION['dish']); $_SESSION['dish']=$_POST['dish'];

	unset($_SESSION['airline']); $_SESSION['airline']="arrival:".$_POST['aairline']."- Departure:".$_POST['dairline'];
	unset($_SESSION['datetime']); $_SESSION['datetime']="Arival:".$_POST['adatetime']."-Departure:".$_POST['ddatetime'];
	unset($_SESSION['buy']);$_SESSION['buy']=$_POST['buy'];
	unset($_SESSION['comment']); $_SESSION['comment']=$_POST['comment'];
	unset($_SESSION['promotion']); $_SESSION['promotion']=$_POST['promotion_code'];
 }

 if ($_POST['services']=="Next"){  $_SESSION['cars']=$_POST['car'];
  $_SESSION['cars_qty']=$_POST['car_qty'];
  $_SESSION['car_price']=$_POST['car_price'];
 }
 /*echo "<pre>";
 print_r($_SESSION['cars']);
 echo "</pre>";
 echo "<pre>";
 print_r($_SESSION['cars_qty']);
 echo "</pre>";
 echo "<pre>";
 print_r($_SESSION['car_price']);
echo "</pre>";*/
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
<form name="new_villa" method="post"  action="booking_confirm.php" >

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
	                    <tr>
	           		<td align="right">
	                <span style="color:red; font-size:10px; margin:0px; padding:0px;">*</span>Password:
	                 </td>
	                <td>
	                <input class="input" type="password" name="password"  value="<?=$_POST['password']?>" /><a href="#" onMouseover="ddrivetip('Must be minimum 6 characters; It will be use for future bookings.','yellow', 200)"; onMouseout="hideddrivetip()" ><span style="font-size:9px;">What&nbsp;is&nbsp;this?</span></a>
	                <br /><span id="error_s"><?=$_GET['error']['pass']?></span>


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
				 <td align="right">State: </td>
				 <td>

     					<select class="input" id='stateSelect' name='state'>
					    </select>
					         <? if (!$_POST['country']) $default="US"; if ($_POST['country']) $default=$_POST['country']; ?>
					            <script type="text/javascript">
					            <!--//
					            initCountry('<?=$default?>');
					            //-->
					     		</script>
					</td>
				</tr>


				<tr>
					<td align="right">City:</td>
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
	                    <input class="input" type="text" name="address" size="30"  value="<?=$_POST['address']?>" />
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
	                <p id="fields">Name: <input class="input" type="text" name="name_emerg" size="35"  value="<?=$_POST['name_emerg']?>" /></p>
	        		<p id="fields">Phone: <input class="input" type="text" name="phone_emerg"  value="<?=$_POST['phone_emerg']?>" /></p>
	        	</fieldset>
			</td>
	   </tr>
	</table>
	</fieldset>
 <?}else{?><!--END WITH CLIENT INFO-->
   <h1 style="font-size:18px; color:blue;"><span style="color:black;">Welcome back:</span> <? echo utf8_decode($_SESSION['customer']['name'])." ".utf8_decode($_SESSION['customer']['lastname']); ?></h1>
   <p>&nbsp;</p>
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
         <? for ($i=0; $i<=($_SESSION['villa_details']['capacity']/2);$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
      </select>
	  &nbsp;<input type="hidden" name="promotion_code" value="<?=$_SESSION['promotion']?>"/>
</p>
</fieldset>
      <? /*print_r($_SESSION['villa_details']);*/?>

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

<p style="text-align:right; padding-right:12px; clear:both;"><input type="checkbox" name="agree" id="myCheck" onclick="" />
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

I Agree to <a href="http://casalindacity.com/RCL_Terms_Conditions.pdf" target="_blank" alt="Terms and Conditions">RCL Terms and Conditions.</a> &nbsp;<input id="mybutton" type="submit" disabled="disabled" name="new_client"  value="Continue booking"  class="" /><? if ($_GET['error']['agree']){?><br /><span id="error_s"><?=$_GET['error']['agree']?></span><?}?></p>
<p>&nbsp;</p>
</form>
<hr style="border: 1px solid #9c0000;"/>
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