<?php
$db=new getQueries ();
/*if ($_POST['continue']){*/
	/*echo "hola";*/
	if($_POST){
		unset($_SESSION['amount_discounted']); $_SESSION['amount_discounted']=$_POST['amount_discounted'];
		unset($_SESSION['promo_id']); $_SESSION['promo_id']=$_POST['id_promocion'];
		
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
	}
	if($_POST['agent']!=''){
		unset($_SESSION['agent_id']); $_SESSION['agent_id']=$_POST['agent'];
	}
	unset($_SESSION['villa_details']);
		$informacion_villa=$db->villa($_SESSION['villa']);
		$_SESSION['villa_details']=$informacion_villa[0];
/*}*/
// $servicios=$db->show_all($table='services', $order='id');
$required_fee=$db->shows_required_fee($beds=$_SESSION['villa_details']['bed']);
/*print_r($required_fee);*/
?>

<div class="container">
  <h3 style="color:#06F; text-align:center;">BOOKING DETAILS:<br/>
    <span style="color:#cc1c0a; text-transform:uppercase;">Villa No.
    <?=$_SESSION['villa_details']['no']?>
    (
    <?=$_SESSION['villa_details']['bed']?>
    Bedrooms)</span><br/>
    From: <span style="color:#cc1c0a; text-transform:uppercase;">
    <?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['desde'])))?>
    </span> To: <span style="color:#cc1c0a; text-transform:uppercase;">
    <?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['hasta'])))?>
    </span></h3>
  <hr style="border: 1px solid #9c0000;"/>
  <p>&nbsp;</p>
  <?PHP
  if($_SESSION['error']){?>
  <div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span><?php if(!$_SESSION['error']['blacklisted']){?> Change a few things up and try submitting again.<?php }else{?>
  Dear client, unfortunately you have been blacklisted in our system due to previous stays or other reasons. 
If you feel that this may be faulty please contact our staff at reception@casalindacity.com or call +1 8095711190
  <?php }?>
  </div>
 <?PHP }?>
  <form name="new_villa" method="post"  action="PayPal/ReviewOrder.php">
  <?php
	//servicios_reserva_hidden($servicios,$qty_nights=$_SESSION['total_noches'], $beds=$_SESSION['villa_details']['bed']);
  ?>
    <!--<input type="hidden" name="adults" value="<?=$_POST['adults']?>"/>
    <input type="hidden" name="kids" value="<?=$_POST['kids']?>"/>-->
    <input type="hidden" name="paymentType" value="Sale"/>
    <input type="hidden" name="currencyCodeType" value="USD">
    <?
	/*apply promotion*/
/*
	if($_SESSION['promo_id']){
	
		$total_noches=$_SESSION['noches_LS']+$_SESSION['noches_HS'];
		switch($_SESSION['promo_type']){
			case 1://percent
					$_SESSION['price_LS']-=$_SESSION['price_LS']*($_SESSION['promo_amt']/100);
					$_SESSION['price_HS']-=$_SESSION['price_HS']*($_SESSION['promo_amt']/100);
					break;
			case 2://amt								
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
			case 3://nights
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
	}*/
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
	
	
	
	<? if($required_fee){
		$itebis_fee=0;
		foreach($required_fee AS $f){
		?>
		<input type="hidden" name="L_NAME<?=$_SESSION['qty_item'];?>" value="Villa <?=$_SESSION['villa_details']['no']?>">
		<input type="hidden" name="L_AMT<?=$_SESSION['qty_item'];?>" value="<?=$f['price']?>">
		<input type="hidden" name="L_QTY<?=$_SESSION['qty_item'];?>" value="1">
		<input type="hidden" name="L_DESC<?=$_SESSION['qty_item'];?>" value="<?=$f['descrip']?>">
		<? $itebis_fee+=(($f['price'])*0.18);
		$_SESSION['qty_item']++;
			}
		?>
    <?}?>
	
	
    <input type="hidden" name="TAXAMT" value="<?=number_format(($itebis_ls+$itebis_hs+$itebis_fee),2)?>">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <input class="form-control" type="text" name="name"  value="<?=$_SESSION['C']['n']?>" placeholder="First name" required autofocus//>
		  <?php if($_SESSION['error']['name']){?><div class="alert alert-danger" role="alert"><?=$_SESSION['error']['name']?></div><?}?>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input class="form-control" type="text" name="lastname"  value="<?=$_SESSION['C']['ln']?>" placeholder="Last name" required />
		  <?php if($_SESSION['error']['lastname']){?><div class="alert alert-danger" role="alert"><?=$_SESSION['error']['lastname']?></div><?}?>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input class="form-control" type="email" name="email1"  value="<?=$_SESSION['C']['el']?>" placeholder="Your email" required />
		  <?php if($_SESSION['error']['email1']){?><div class="alert alert-danger" role="alert"><?=$_SESSION['error']['email1']?></div><?}?>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input class="form-control" type="email" name="email2"  value="<?=$_SESSION['C']['el2']?>" placeholder="Confirm your email"  required />
		   <?php if($_SESSION['error']['email2']){?><div class="alert alert-danger" role="alert"><?=$_SESSION['error']['email2']?></div><?}?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="phone">Your phone</label>
          <input class="form-control" type="text" name="phone" id="phone" value="<?=$_SESSION['C']['ph']?>" placeholder="Mobile number preferred" required/>
		  <?php if($_SESSION['error']['phone']){?><div class="alert alert-danger" role="alert"><?=$_SESSION['error']['phone']?></div><?}?>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="countrySelect">Country</label>
          <select class="form-control" id='countrySelect' name='country'>
            <option value="CA">Canada</option>
            <option value="US" selected="selected">United States</option>
            <option value="DO">Dominican Republic</option>
            <option value="NO">Norway</option>
            <option value="UK">United Kingdom</option>
            <option value="DE">Germany</option>
            <option value="FR">France (Includes Monaco)</option>
            <option value="FX">France, Metropolitan</option>
            <option value="ES">Spain</option>
            <option value="AF">Afghanistan</option>
            <option value="AL">Albania</option>
            <option value="DZ">Algeria</option>
            <option value="AS">American Samoa</option>
            <option value="AD">Andorra</option>
            <option value="AO">Angola</option>
            <option value="AI">Anguilla</option>
            <option value="AQ">Antarctica</option>
            <option value="AG">Antigua and Barbuda</option>
            <option value="AR">Argentina</option>
            <option value="AM">Armenia</option>
            <option value="AW">Aruba</option>
            <option value="AU">Australia</option>
            <option value="AT">Austria</option>
            <option value="AZ">Azerbaijan</option>
            <option value="AP">Azores</option>
            <option value="BS">Bahamas</option>
            <option value="BH">Bahrain</option>
            <option value="BD">Bangladesh</option>
            <option value="BB">Barbados</option>
            <option value="BY">Belarus</option>
            <option value="BE">Belgium</option>
            <option value="BZ">Belize</option>
            <option value="BJ">Benin</option>
            <option value="BM">Bermuda</option>
            <option value="BT">Bhutan</option>
            <option value="BO">Bolivia</option>
            <option value="BA">Bosnia And Herzegowina</option>
            <option value="XB">Bosnia-Herzegovina</option>
            <option value="BW">Botswana</option>
            <option value="BV">Bouvet Island</option>
            <option value="BR">Brazil</option>
            <option value="IO">British Indian Ocean Territory</option>
            <option value="VG">British Virgin Islands</option>
            <option value="BN">Brunei Darussalam</option>
            <option value="BG">Bulgaria</option>
            <option value="BF">Burkina Faso</option>
            <option value="BI">Burundi</option>
            <option value="KH">Cambodia</option>
            <option value="CM">Cameroon</option>
            <option value="CV">Cape Verde</option>
            <option value="KY">Cayman Islands</option>
            <option value="CF">Central African Republic</option>
            <option value="TD">Chad</option>
            <option value="CL">Chile</option>
            <option value="CN">China</option>
            <option value="CX">Christmas Island</option>
            <option value="CC">Cocos (Keeling) Islands</option>
            <option value="CO">Colombia</option>
            <option value="KM">Comoros</option>
            <option value="CG">Congo</option>
            <option value="CD">Congo, The Democratic Republic O</option>
            <option value="CK">Cook Islands</option>
            <option value="XE">Corsica</option>
            <option value="CR">Costa Rica</option>
            <option value="CI">Cote d` Ivoire (Ivory Coast)</option>
            <option value="HR">Croatia</option>
            <option value="CU">Cuba</option>
            <option value="CY">Cyprus</option>
            <option value="CZ">Czech Republic</option>
            <option value="DK">Denmark</option>
            <option value="DJ">Djibouti</option>
            <option value="DM">Dominica</option>
            <option value="TP">East Timor</option>
            <option value="EC">Ecuador</option>
            <option value="EG">Egypt</option>
            <option value="SV">El Salvador</option>
            <option value="GQ">Equatorial Guinea</option>
            <option value="ER">Eritrea</option>
            <option value="EE">Estonia</option>
            <option value="ET">Ethiopia</option>
            <option value="FK">Falkland Islands (Malvinas)</option>
            <option value="FO">Faroe Islands</option>
            <option value="FJ">Fiji</option>
            <option value="FI">Finland</option>
            <option value="GF">French Guiana</option>
            <option value="PF">French Polynesia</option>
            <option value="TA">French Polynesia (Tahiti)</option>
            <option value="TF">French Southern Territories</option>
            <option value="GA">Gabon</option>
            <option value="GM">Gambia</option>
            <option value="GE">Georgia</option>
            <option value="GH">Ghana</option>
            <option value="GI">Gibraltar</option>
            <option value="GR">Greece</option>
            <option value="GL">Greenland</option>
            <option value="GD">Grenada</option>
            <option value="GP">Guadeloupe</option>
            <option value="GU">Guam</option>
            <option value="GT">Guatemala</option>
            <option value="GN">Guinea</option>
            <option value="GW">Guinea-Bissau</option>
            <option value="GY">Guyana</option>
            <option value="HT">Haiti</option>
            <option value="HM">Heard And Mc Donald Islands</option>
            <option value="VA">Holy See (Vatican City State)</option>
            <option value="HN">Honduras</option>
            <option value="HK">Hong Kong</option>
            <option value="HU">Hungary</option>
            <option value="IS">Iceland</option>
            <option value="IN">India</option>
            <option value="ID">Indonesia</option>
            <option value="IR">Iran</option>
            <option value="IQ">Iraq</option>
            <option value="IE">Ireland</option>
            <option value="EI">Ireland (Eire)</option>
            <option value="IL">Israel</option>
            <option value="IT">Italy</option>
            <option value="JM">Jamaica</option>
            <option value="JP">Japan</option>
            <option value="JO">Jordan</option>
            <option value="KZ">Kazakhstan</option>
            <option value="KE">Kenya</option>
            <option value="KI">Kiribati</option>
            <option value="KP">Korea, Democratic People'S Repub</option>
            <option value="KW">Kuwait</option>
            <option value="KG">Kyrgyzstan</option>
            <option value="LA">Laos</option>
            <option value="LV">Latvia</option>
            <option value="LB">Lebanon</option>
            <option value="LS">Lesotho</option>
            <option value="LR">Liberia</option>
            <option value="LY">Libya</option>
            <option value="LI">Liechtenstein</option>
            <option value="LT">Lithuania</option>
            <option value="LU">Luxembourg</option>
            <option value="MO">Macao</option>
            <option value="MK">Macedonia</option>
            <option value="MG">Madagascar</option>
            <option value="ME">Madeira Islands</option>
            <option value="MW">Malawi</option>
            <option value="MY">Malaysia</option>
            <option value="MV">Maldives</option>
            <option value="ML">Mali</option>
            <option value="MT">Malta</option>
            <option value="MH">Marshall Islands</option>
            <option value="MQ">Martinique</option>
            <option value="MR">Mauritania</option>
            <option value="MU">Mauritius</option>
            <option value="YT">Mayotte</option>
            <option value="MX">Mexico</option>
            <option value="FM">Micronesia, Federated States Of</option>
            <option value="MD">Moldova, Republic Of</option>
            <option value="MC">Monaco</option>
            <option value="MN">Mongolia</option>
            <option value="MS">Montserrat</option>
            <option value="MA">Morocco</option>
            <option value="MZ">Mozambique</option>
            <option value="MM">Myanmar (Burma)</option>
            <option value="NA">Namibia</option>
            <option value="NR">Nauru</option>
            <option value="NP">Nepal</option>
            <option value="NL">Netherlands</option>
            <option value="AN">Netherlands Antilles</option>
            <option value="NC">New Caledonia</option>
            <option value="NZ">New Zealand</option>
            <option value="NI">Nicaragua</option>
            <option value="NE">Niger</option>
            <option value="NG">Nigeria</option>
            <option value="NU">Niue</option>
            <option value="NF">Norfolk Island</option>
            <option value="MP">Northern Mariana Islands</option>
            <option value="OM">Oman</option>
            <option value="PK">Pakistan</option>
            <option value="PW">Palau</option>
            <option value="PS">Palestinian Territory, Occupied</option>
            <option value="PA">Panama</option>
            <option value="PG">Papua New Guinea</option>
            <option value="PY">Paraguay</option>
            <option value="PE">Peru</option>
            <option value="PH">Philippines</option>
            <option value="PN">Pitcairn</option>
            <option value="PL">Poland</option>
            <option value="PT">Portugal</option>
            <option value="PR">Puerto Rico</option>
            <option value="QA">Qatar</option>
            <option value="RE">Reunion</option>
            <option value="RO">Romania</option>
            <option value="RU">Russian Federation</option>
            <option value="RW">Rwanda</option>
            <option value="KN">Saint Kitts And Nevis</option>
            <option value="SM">San Marino</option>
            <option value="ST">Sao Tome and Principe</option>
            <option value="SA">Saudi Arabia</option>
            <option value="SN">Senegal</option>
            <option value="XS">Serbia-Montenegro</option>
            <option value="SC">Seychelles</option>
            <option value="SL">Sierra Leone</option>
            <option value="SG">Singapore</option>
            <option value="SK">Slovak Republic</option>
            <option value="SI">Slovenia</option>
            <option value="SB">Solomon Islands</option>
            <option value="SO">Somalia</option>
            <option value="ZA">South Africa</option>
            <option value="GS">South Georgia And The South Sand</option>
            <option value="KR">South Korea</option>
            <option value="LK">Sri Lanka</option>
            <option value="NV">St. Christopher and Nevis</option>
            <option value="SH">St. Helena</option>
            <option value="LC">St. Lucia</option>
            <option value="PM">St. Pierre and Miquelon</option>
            <option value="VC">St. Vincent and the Grenadines</option>
            <option value="SD">Sudan</option>
            <option value="SR">Suriname</option>
            <option value="SJ">Svalbard And Jan Mayen Islands</option>
            <option value="SZ">Swaziland</option>
            <option value="SE">Sweden</option>
            <option value="CH">Switzerland</option>
            <option value="SY">Syrian Arab Republic</option>
            <option value="TW">Taiwan</option>
            <option value="TJ">Tajikistan</option>
            <option value="TZ">Tanzania</option>
            <option value="TH">Thailand</option>
            <option value="TG">Togo</option>
            <option value="TK">Tokelau</option>
            <option value="TO">Tonga</option>
            <option value="TT">Trinidad and Tobago</option>
            <option value="XU">Tristan da Cunha</option>
            <option value="TN">Tunisia</option>
            <option value="TR">Turkey</option>
            <option value="TM">Turkmenistan</option>
            <option value="TC">Turks and Caicos Islands</option>
            <option value="TV">Tuvalu</option>
            <option value="UG">Uganda</option>
            <option value="UA">Ukraine</option>
            <option value="AE">United Arab Emirates</option>
            <option value="GB">Great Britain</option>
            <option value="UM">United States Minor Outlying Isl</option>
            <option value="UY">Uruguay</option>
            <option value="UZ">Uzbekistan</option>
            <option value="VU">Vanuatu</option>
            <option value="XV">Vatican City</option>
            <option value="VE">Venezuela</option>
            <option value="VN">Vietnam</option>
            <option value="VI">Virgin Islands (U.S.)</option>
            <option value="WF">Wallis and Furuna Islands</option>
            <option value="EH">Western Sahara</option>
            <option value="WS">Western Samoa</option>
            <option value="YE">Yemen</option>
            <option value="YU">Yugoslavia</option>
            <option value="ZR">Zaire</option>
            <option value="ZM">Zambia</option>
            <option value="ZW">Zimbabwe</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="stateSelect">How did you hear about us?</label>
          <select class="form-control" name="hear_about" >
            <option value="Internet" selected="selected">Internet</option>
            <option value="Friend/Family" >Friend/Family</option>
            <option value="Promotional_Material" >Promotional Material</option>
            <option value="Referal" >Referal</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="paynow">Payment to apply now</label>
          <? 
				$data=new subDB();
				$daysToStart=$data->daysDifference($_SESSION['desde'],date('Y-m-d' ));
				/*echo $_SESSION['desde']; echo "<br/>"; echo date('Y-m-d');
				echo "<br/>"; echo $daysToStart;*/
				if($daysToStart>30){
				//1 nights
				//50
				//100
				?>
          <select class="form-control" name="paynow" id="paynow">
            <option value="1" selected="selected">1 night</option>
            <option value="50">50 %</option>
            <option value="100" >100 %</option>
          </select>
          <?
				}elseif(($daysToStart<=30)&&($daysToStart>8)){
				//50
				//100
				?>
          <select class="form-control" name="paynow" id="paynow">
            <option value="50" selected="selected">50 %</option>
            <option value="100" >100 %</option>
          </select>
          <?
				}elseif(($daysToStart>=0)&&($daysToStart<=7)){
				//100
				?>
          <select class="form-control" name="paynow" id="paynow">
            <option value="100" selected="selected">100 %</option>
          </select>
          <?
				}else{
					?>
          <select class="form-control" name="paynow" id="paynow">
            <option value="100" selected="selected">100 %</option>
          </select>
          <?
				}
				 ?>
        </div>
      </div>
    </div>
	<?php
				switch($_SESSION['villa_details']['bed']){
					case 2:
						$max_child=4;
						$max_adult=4;
						break;
					case 3:
						$max_child=6;
						$max_adult=6;
						break;
					case 4:
						$max_child=8;
						$max_adult=8;
						break;
					case 5:
						$max_child=10;
						$max_adult=10;
						break;
					case 6:
						$max_child=12;
						$max_adult=12;
						break;
					default:
						$max_child=4;
						$max_adult=4;
				}
				?>
	<div class="row">
		<div class="col-md-3">
			 <div class="form-group">
			  <label for="stateSelect">Adults</label>
			  <select class="form-control" name="adults" >
				<!--<option value="1" >Adults</option>-->
				<? for($i=1; $i<=$max_adult; $i++){?>
					<option value="<?=$i?>" <?php if($_POST['custom-select-1']==$i){ echo 'Selected="selected"'; }?>><?=$i?></option>
				<?}?>
			  </select>
			</div>
		</div>
		<div class="col-md-3">
			 <div class="form-group">
			  <label for="stateSelect">Children</label>
			  <select class="form-control" name="kids" >
				<!--<option value="0" >Children</option>-->
				<? for($i=0; $i<=$max_child; $i++){?>
					<option value="<?=$i?>" <?php if($_POST['custom-select-2']==$i){ echo 'Selected="selected"'; }?>><?=$i?></option>
				<?}?>
			  </select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-5"><p><strong>Choose Payment</strong></p></div>
	</div>
    <div class="row">
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-12"> <a href="#" onClick="selectID('payWithCC'); return false;"> <img src="images/cclogo.jpg"  class="img-responsive"  alt="Credit Card" /> </a> </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <input type="radio"  id="payWithCC" name="PaymentType" value="CC"    checked="true"  required/>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="row">
          <div class="col-md-12"> <a href="#" onClick="selectID('payWithPP'); return false;"> <img src="images/PPPPLOGO.jpg" class="img-responsive" alt="PayPal"  /> </a> </div>
        </div>
        <div class="row">
          <div class="col-md-12" >
            <div class="form-group text-left" >
              <input type="radio" id="payWithPP" name="PaymentType" value="PayPal"  required />
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <p style="color:#003699;">Invoices will be sent to you as per cancellation rules (see in terms and conditions). In order to keep your reservation and avoid a cancellation you need to pay accordingly.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="form-group"> </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input class="btn btn-primary" type="submit" id="mybutton"  disabled="disabled" value="Continue">
          <br/>
          <input type="checkbox" name="agree" id="myCheck" value="Iagree" onclick="" required/>
          I Agree to <a href="http://www.casalindacity.com/Terms_and_conditions.php" target="_blank" alt="Terms and Conditions">RCL Terms and Conditions.</a> </div>
      </div>
    </div>
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
    <script type="text/javascript" language=javascript>  
function selectID(IDS) { 
  var IDxx = document.getElementById(IDS);  
  IDxx.checked = true; 
} 
</script>
  </form>
</div>
