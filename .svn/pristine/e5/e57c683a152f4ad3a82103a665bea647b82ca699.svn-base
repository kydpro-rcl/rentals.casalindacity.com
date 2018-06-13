	<?
	$data= new getQueries ();
	$interm=$data->show_id('commission', $_SESSION['referal']['id']);
	$it=$interm[0];
	// $link= new getQueries();
	$detalles_anterior=$data->show_any_data_limit1('referral_details', 'referral', $it['id'], '=');
	$det=$detalles_anterior[0];
	?>
	<p style="clear:both;">&nbsp;</p>
	<p class="header" style="clear:both;"><h1>Changing Secret Questions and Password</h1></p>
	<hr />
	<form name="new_villa" method="post"  action="profile1.php">
	<input type="hidden" name="name" value="<?=$it['name']?>"/>
	<input type="hidden" name="lastname" value="<?=$it['lastname']?>"/>
	<input type="hidden" name="url" value="<?=$it['url']?>"/>

	<input type="hidden" name="agencies" value="<?=$det['agency']?>"/>
	<input type="hidden" name="language" value="<?=$det['language']?>"/>
	<input type="hidden" name="cell" value="<?=$det['cell']?>"/>
	<input type="hidden" name="phone" value="<?=$it['phone']?>"/>

	<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">

     <?
			 $agencies=array(
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
 				);
    ?>
    <!--nuevos campos abajo de aqui en esta columna-->
    <!--//<p id="fields" style="text-align:right">Agency: <select name="agencies" class="input">
            <? foreach($agencies as $ag){?> <option value="<?=$ag?>" <? if ($det['agency']==$ag) echo 'selected="selected"';?> ><?=$ag?></option><?}?>

			</select></p>//-->
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


	<td width="50%">



    <?
     $security_questions=array(
 							 1=>"What was your childhood nickname?",
							2=>"In what city did you meet your spouse/significant other?",
							 3=>"What is the name of your favorite childhood friend?",
							 4=>"What street did you live on in third grade?",
							5=>"What is your oldest sibling's birthday month and year? (e.g., January 1900)",
							 6=>"What is the middle name of your youngest child?",
							 7=>"What is your oldest sibling's middle name?",
							 8=>"What school did you attend for sixth grade?",
							9=>"What was your childhood phone number including area code? (e.g., 000-000-0000)",
							 10=>"What is your oldest cousin's first and last name?",
							11=>"What was the name of your first stuffed animal?",
						12=>"In what city or town did your mother and father meet?",
							 13=>"Where were you when you had your first kiss?",
							 14=>"What is the first name of the boy or girl that you first kissed?",
							 15=>"What was the last name of your third grade teacher?",
							 16=>"In what city does your nearest sibling live?",
						17=>"What is your youngest brother's birthday month and year? (e.g., January 1900)",
							 18=>"What is your maternal grandmother's maiden name?",
							 19=>"In what city or town was your first job?",
							20=>"What is the name of the place your wedding reception was held?",
							21=>"What is the name of a college you applied to but didn't attend?",
							 22=>"Where were you when you first heard about 9/11?"
 						);
    ?>

    <? /*print_r($security_questions);*/ ?>

	</td></tr><tr><td colspan="2">

      <p id="fields" style="text-align:right">Secret Question #1: <select name="question1"> <? foreach($security_questions as $ke){?> <option value="<?=$ke?>" <? if ($det['question1']==$ke) echo 'selected="selected"';?> ><?=$ke?></option><?}?> </select></p>
           <p id="fields" style="text-align:right">Answer #1: <input class="input" type="text" name="answer1"  value="<? if ($_POST['answer1']){ echo $_POST['answer1']; }else{ echo $det['answer1'];}?>" size="50" /><br/></p>

                   <p id="fields" style="text-align:right">Secret Question #2: <select name="question2"> <? foreach($security_questions as $ke){?> <option value="<?=$ke?>" <? if ($det['question2']==$ke) echo 'selected="selected"';?> ><?=$ke?></option><?}?> </select></p>
           <p id="fields" style="text-align:right">Answer #2: <input class="input" type="text" name="answer2"  value="<? if ($_POST['answer2']){ echo $_POST['answer2']; }else{ echo $det['answer2'];}?>" size="50" /><br/></p>

   <p id="fields" style="text-align:right">Current Password: <input class="input" type="password" name="current_pass"  value="" /><br/></p>
    <p id="fields" style="text-align:right">New Password: <input class="input" type="password" name="pass"  value="" /><br/></p>

 <p id="fields" style="text-align:right">Confirm New Password: <input class="input" type="password" name="confirm_pass"  value="" /><br/></p>
<br/><p style="text-align:right"><span style="color:red; font-size:10px;"><?=$_GET['error']['pass']?></span></p>
<input type="hidden" name="current_password" value="<?=$it['password']?>" />

    <? /**100;*/ /*echo $porciente*/?>
	<input type="hidden" name="id" value="<?=$_SESSION['referal']['id']?>" />
	<input type="hidden" name="email" value="<?=$it['email']?>" />
	<input type="hidden" name="active" value="<?=$it['active']?>" />
	<input type="hidden" name="percent" value="<?=$it['percent'];?>" />
	<input type="hidden" name="tipo" value="<?=$it['tipo']?>" />

	<input type="submit" name="update"  value="Update" class="book_but" />
	</td></tr></table>
	</form>

	<hr />

