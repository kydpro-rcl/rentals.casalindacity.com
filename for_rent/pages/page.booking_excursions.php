<?php

$db=new getQueries ();
//print_r($_POST);  //para probar a post
 /*
if ($_POST['continuar']=="continue"){

	unset($_SESSION['total']); $_SESSION['total']=$_POST['g_total'];//$_SESSION['total']=number_format($_POST['g_total'],2);
	//echo "<br/>";
	unset($_SESSION['desde']); $_SESSION['desde']=$_POST['desde'];
	//echo "<br/>";
	unset($_SESSION['hasta']); $_SESSION['hasta']=$_POST['hasta'];
	//echo "<br/>";
	unset($_SESSION['total_noches']); $_SESSION['total_noches']=$_POST['T_nights'];
	//echo "<br/>";
	unset($_SESSION['noches_LS']); $_SESSION['noches_LS']=$_POST['LS_nights'];
	//echo "<br/>";
	unset($_SESSION['noches_HS']); $_SESSION['noches_HS']=$_POST['HS_nights'];
	unset($_SESSION['itbis']);$_SESSION['itbis']=$_POST['itbis'];// $_SESSION['itbis']=number_format($_POST['itbis'],2);
	unset($_SESSION['villa']); $_SESSION['villa']=$_POST['v'];
	unset($_SESSION['villa_details']);

		$informacion_villa=$db->villa($_SESSION['villa']);
		$_SESSION['villa_details']=$informacion_villa[0];
}else{	die('Sorry, we could not proccess the info');
} */

?>

<h3 style="color:#06F; text-align:center;">BOOKING DETAILS:<br/>
	 <span style="color:#cc1c0a; text-transform:uppercase;">Villa No. <?=$_SESSION['villa_details']['no']?> (<?=$_SESSION['villa_details']['bed']?> Bedrooms)</span><br/>
	 From:  <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['desde'])))?></span> To: <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['hasta'])))?></span></h3>
 <p style="background-color:#FFF; color:#cc1c0a;font-weight:bold;">NOTE: When you are done chosing excursions on this page, please click "continue" button below</p>
 <hr style="border: 1px solid #9c0000;"/>

		<?
		$data= new getQueries ();
		$excursions=$data->show_all('excursions', 'id');

		//print_r($excursions);

		//---------------FUNCION PARA LEER LOS DIRETORIOS DEBAJO--------------------
			 function dirImages($dir) {
				$d = dir($dir); //Open Directory
				while (false!== ($file = $d->read())) //Reads Directory
				{
					$extension = substr($file, strrpos($file, '.')); // Gets the File Extension
					if($extension == ".jpg" || $extension == ".jpeg" || $extension == ".gif" || $extension == ".png" || $extension == ".JPG") // Extensions Allowed
					$images[$file] = $file; // Store in Array
				}
					$d->close(); // Close Directory
					@asort($images); // Sorts the Array
				return $images;
			 }


			//----------------FUNCION PARA LEER LOS DIRECTORIOS MAS ARRIBA--------------------

		?>
		<!--//<div id="boxthree" style="background-color:red; overflow:auto; height:500px;">//-->
		<div id="boxthree" >
		     <? foreach($excursions AS $k){?>
		      <script type="text/javascript">
		          <!--

					function f_boxcheck<?=$k['id']?>()
					{

					if(document.getElementById("exc<?=$k['id']?>").checked){
						//document.getElementById("kids<?=$k['id']?>").disabled=false;
		             	document.frmexcursion.kids<?=$k['id']?>.disabled = false;
						document.frmexcursion.adults<?=$k['id']?>.disabled = false;
					}else {
						document.getElementById("kids<?=$k['id']?>").disabled=true;
						document.getElementById("adults<?=$k['id']?>").disabled=true;
						}
					}

					//document.getElementById("exc<?=$k['id']?>").onclick=f_boxcheckexc<?=$k['id']?>;
		           -->
				</script>
		      <?}?>
			<form method="post" action="booking_services.php" name="frmexcursion" id="frmexcursion">
			<input type="hidden" name="promotion_code" value="<?=$_POST['promotion_code']?>"/>
		 <? $contador=1;
		 foreach($excursions AS $k){?>

		      <div id="MonkeyJungle">
		       <div style="width:30px;float:left; padding-top:10px;">

		         <input id="exc<?=$k['id']?>" type="checkbox" onchange="javascript:f_boxcheck<?=$k['id']?>();" value="<?=$k['id']?>" name="excursions[<?=$k['id']?>]"  <? /*if ($_POST['appliances'][$k]==$k){ echo 'checked="checked"'; }*/?>   ><?/*=$v*/?>
		       </div>
		        <div id="monkeytext">
		          <p><span class="christmastext"><?=$k['title']?></span><br />
		           <?=$k['desc']?></p>

		             <p style="padding:0; margin:0;"><b>Adults: <?=$k['price_a']?> USD / Kids: <?=$k['price_c']?> USD</b><br/> <span style="color:red">
		         Select Qty. Adults: <select id="adults<?=$k['id']?>" name="adults<?=$k['id']?>" disabled="disabled"><? for($i=0; $i<=90; $i++){?><option value="<?=$i?>"><?=$i?></option><?}?></select>
		         Select Qty. Kids:<select id="kids<?=$k['id']?>" name="kids<?=$k['id']?>" disabled="disabled"><? for($i=0; $i<=90; $i++){?><option value="<?=$i?>"><?=$i?></option><?}?></select></span></p>
		          <input type="hidden" name="priceadults<?=$k['id']?>" value="<?=$k['price_a']?>"/>
		          <input type="hidden" name="pricekids<?=$k['id']?>" value="<?=$k['price_c']?>"/>
		           <input type="hidden" name="excus_title<?=$k['id']?>" value="<?=$k['title']?>"/>
		          <p style="padding:0; margin:0;"><a href="<?=$k['link']?>" target="_blank"><?=$k['link_t']?></a>
		          </p>

		        </div>
		        <div id="<?=$id3?>">
		          <div id="p7IRM_1" class="p7IRM02">
		            <div id="p7IRMow_1" class="p7IRMowrapper">
		              <div id="p7IRMw_1" class="p7IRMwrapper">
		                <div id="p7IRMdv_1" class="p7IRMdv"><a class="p7IRMlink" id="p7IRMlk_1" title=""><img class="p7IRMimage" src="../booking/<?=$k['pic']?>" alt="Picture 1" name="p7IRMim_1" width="200" height="200" id="p7IRMim_1" /></a></div>

		              </div>
		            </div>

		          </div>
		        </div>

		      </div>

		 <?	$contador++; }  ?>
		<p style=" margin-top:7px;padding-top:7px; clear:both;">&nbsp;</p>
		<hr style="border: 1px solid #9c0000; clear:both;"/>
		<p style="padding-top:5px;margin-top:5px;"> <input class="boton" type="submit" name="continuar" value="continue"/></p>
		 	</form>

  </div>