	<?
	$data= new getQueries ();
	$interm=$data->show_id('commission', $_SESSION['referal']['id']);
	$it=$interm[0];
	// $link= new getQueries();
	$detalles_anterior=$data->show_any_data_limit1('referral_details', 'referral', $it['id'], '=');
	$det=$detalles_anterior[0];
	?>
	<p style="clear:both;">&nbsp;</p>
	<p class="header" style="clear:both;"><h1>Changing Personal Details</h1></p>
	<hr />
	<form name="new_villa" method="post"  action="profile.php" enctype="multipart/form-data">
	<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
	<input type="hidden" name="name" value="<?=$it['name']?>"/>
	<input type="hidden" name="lastname" value="<?=$it['lastname']?>"/>
	<input type="hidden" name="url" value="<?=$it['url']?>"/>


     <?
			 $agencies=array(0=>"None",
							 23=>"Coldwell Banker",
 							 1=>"Hispaniola Real-estate",
 							 2=>"Prima Properties",
 							 3=>"Re-Max Coral Bay",
 							 4=>"Property Center",
 							 5=>"Gomez Tours",
 							 6=>"Golden Treasures Real Estate",
 							 7=>"Palm Hills Real Estate",
 							 8=>"DR Properties",
 							 9=>"Immobilier Republique Dominicaine",
 							 10=>"Re-Max Ocean Side Realty",
 							 11=>"ABC Imobilaria",
 							 12=>"Karibik Invest",
 							 13=>"Olima Real Estate",
 							 14=>"Caraibi Dream",
 							 15=>"Sun and Sea Property",
 							 16=>"Century 21",
 							 17=>"Caraibi",
 							 18=>"Cabarete Real Estate",
 							 19=>"West Indies Real Estate",
 							 20=>"Re-Max Carabi Realty",
							 22=>"Dubaisa Atlantic Realty",
							 24=>"Remax Realty Specialists Inc.",
 							 21=>"Others"
 				);
    ?>
    <!--nuevos campos abajo de aqui en esta columna-->
    <p id="fields" style="text-align:right">Agency: <select name="agencies" class="input">
            <? foreach($agencies as $ag){?> <option value="<?=$ag?>" <? if ($det['agency']==$ag) echo 'selected="selected"';?> ><?=$ag?></option><?}?>

			</select></p>
			<?
			 $idiomas=array(
 							 "EN"=>"English",
 							 "SP"=>"Spanish",
 							 "FR"=>"French",
 							 "NO"=>"Norwegian",
 							 "DE"=>"German",
 							 "NL"=>"Nederlands",
 							 "IT"=>"Italian",
 							 "RU"=>"Chinese",
 							 "CH"=>"Chinese",
 							 "JP"=>"Japanese",
 							 "MO"=>"Others"
 			);
    ?>

	<p id="fields" style="text-align:right">Language: <select name="language" class="input">
             <? foreach($idiomas as $kl=>$vl){?> <option value="<?=$kl?>" <? if ($det['language']==$kl) echo 'selected="selected"';?> ><?=$vl?></option><?}?>
			</select></p>
</td>
	<td width="50%">

	<p id="fields" style="text-align:right">Office #: <input class="input" type="text" name="phone"  value="<? if ($_POST['phone']){ echo $_POST['phone']; }else{ echo $it['phone'];}?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>
        <input type="hidden" name="pass" value="<?=$it['password']?>"/>


    <p id="fields" style="text-align:right">Cell #: <input class="input" type="text" name="cell"  value="<? if ($_POST['cell']){ echo $_POST['cell']; }else{ echo $det['cell'];}?>" /><br/></p>


    <? /*print_r($security_questions);*/ ?>

	</td></tr><tr><td colspan="2">
               <input type="hidden" name="question1" value="<?=$det['question1']?>"/>
                <input type="hidden" name="question2" value="<?=$det['question2']?>"/>
                 <input type="hidden" name="answer1" value="<?=$det['answer1'];?>"/>
                  <input type="hidden" name="answer2" value="<?=$det['answer2'];?>"/>


    <? /**100;*/ /*echo $porciente*/?>
	<input type="hidden" name="id" value="<?=$_SESSION['referal']['id']?>" />
	<input type="hidden" name="email" value="<?=$it['email']?>" />
	<input type="hidden" name="active" value="<?=$it['active']?>" />
	<input type="hidden" name="percent" value="<?=$it['percent'];?>" />
	<input type="hidden" name="tipo" value="<?=$it['tipo']?>" />

	
	</td></tr></table>
	<p><img src="../for_rent1/<?=$det['logo']?>" height="86px" alt=""/><input type="hidden" name="oldLogo" value="<?=$det['logo']?>"/></p>
	<p>Upload logo:<input type="file" name="logo" value=""/><br/> <span style="font-weight:bold; font-size:10px;">Logo requirements: width 350px, height 86px, 1 MB Max.</span><br/><span id="error_s"><?=$_GET['error']['logo']?></span></p>
	
	
	
	
	<p><input type="submit" name="update"  value="Update" class="book_but" /></p>
	</form>
		<?/* print_r($_GET['error']);*/?>
	<hr />
<p>My link for bookings: <input type="text" name="link" size="100"  value="https://rentals.casalindacity.com/for_rent1/availability_result.php?ref=<?=$_SESSION['referal']['id']?>" class="book_but" /></p>
