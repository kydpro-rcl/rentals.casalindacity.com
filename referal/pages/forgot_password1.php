	<?
	/*$data= new getQueries ();
	$interm=$data->show_id('commission', $_SESSION['referal']['id']);
	//$it=$interm[0];
	// $link= new getQueries();
	$detalles_anterior=$data->show_any_data_limit1('referral_details', 'referral', $it['id'], '=');
	$det=$detalles_anterior[0];  */
	?>
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
   <img src="images/new-casa-linda-logo.gif" />
	<p class="header" style="clear:both;">Security Questions and Answers</p>
    <hr/>
	<form name="new_villa" method="post"  action="forgot_password1.php">
     <p id="fields" style="text-align:left;font-size:11px; text-transform:uppercase;" >Secret question #1: <select disabled="disabled" name="question1" style="font-size:10px;"> <? foreach($security_questions as $ke){?> <option value="<?=$ke?>" <? if (stripslashes($_SESSION['quest1'])==$ke) echo 'selected="selected"';?> ><?=$ke?></option><?}?> </select></p>
           <p id="fields" style="text-align:left;font-size:11px;text-transform:uppercase;">Answer #1: <input class="input" type="text" name="answer1"  value="<?=$_POST['answer1']?>" size="50" /><br/></p>

                   <p id="fields" style="text-align:left;font-size:11px;text-transform:uppercase;">Secret question #2: <select disabled="disabled" style="font-size:10px;" name="question2"> <? foreach($security_questions as $kee){?> <option value="<?=$kee?>" <? if (stripslashes($_SESSION['quest2'])==$kee) echo 'selected="selected"';?> ><?=$kee?></option><?}?> </select></p>
           <p id="fields" style="text-align:left;font-size:11px;text-transform:uppercase;">Answer #2: <input class="input" type="text" style="font-size:10px;" name="answer2"  value="<?=$_POST['answer2']?>" size="50" /><br/></p>

 	<p style="text-align:right"><input type="submit" name="update"  value="Continue" class="book_but" /></p>

	</form>

	<p style="color:red;"><?=$_GET['error']['securities'];?></p>
	<hr />