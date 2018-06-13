<link href="RTF_html/rte.css" rel="stylesheet" type="text/css" />

<div id="content">
<p class="header">Emailing to all ours clients</p>
<!--<hr />-->
	<!-- To decrease bandwidth, change the src to richtext_compressed.js //-->
	<script language="JavaScript" type="text/javascript" src="RTF_html/richtext.js"></script>
  <!--  <script language="JavaScript" type="text/javascript" src="jquery/jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="jquery/searchbox.js"></script>-->

  <? if (!$_POST['send']){?>
	<form  method="post" name="RTEDemo" action="send_emails_clients.php">
	<table><tr><td>
	Subject:</td><td><input type="text" size="70" name="subject" /> From client:<input type="text" name="from" value="" size="7"/> to:<input type="text" name="to" size="7" value=""/></td></tr>
	<tr><td>Body:</td><td><!--<textarea name="body" cols="70" rows="20"></textarea>-->
						 <script language="JavaScript" type="text/javascript">
                            <!--
                            function submitForm() {
                                //make sure hidden and iframe values are in sync before submitting form
                                //to sync only 1 rte, use updateRTE(rte)
                                //to sync all rtes, use updateRTEs
                                updateRTE('rte1');
                                //updateRTEs();
                               // alert("rte1 = " + document.RTEDemo.rte1.value);
                                document.RTEDemo.rft_text.value=document.RTEDemo.rte1.value;
								//alert("trf TXT = " + document.RTEDemo.rft_text.value);
                                //alert("rte2 = " + document.RTEDemo.rte2.value);
                                //alert("rte3 = " + document.RTEDemo.rte3.value);

                                //change the following line to true to submit form
                                return false;
                            }

                            //Usage: initRTE(imagesPath, includesPath, cssFile)
                            initRTE("imagesrtf/", "", "");
                            //-->
                            </script>
                            <noscript><p><b>Javascript must be enabled to use this form.</b></p></noscript>

                             <script language="JavaScript" type="text/javascript">
                            <!--
                            //Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
                            writeRichText('rte1', 'Type your text here...', 620, 300, true, false);

                            /*document.writeln('<br><br>');
                            writeRichText('rte2', 'preloaded <b>text</b>', 560, 100, true, false);

                            document.writeln('<br><br>');
                            writeRichText('rte3', 'preloaded <b>text</b>', 450, 100, true, true);*/
                            //-->
                            </script>
                            <!--<input type="text" name="rte1" value="Type your text here..." class="text" id="rte1" />-->

                            <input type="hidden" name="rft_text" value="" />
                            <!--<p>Click submit to show the value of the text box.</p>-->


    </td></tr>

	<tr><td></td><td><!--//<p>
	            Owners:
	            <select name="type" size="1">
	            <option value="1">All</option>
				<option value="2">Rental pool</option>
	            <option value="3">No rental pool</option>
                  </select>
	          </p>//-->
			</td></tr>

	<tr><td colspan="2"><input class="book_but" type="submit" name="send" value="send" onClick="submitForm()" /></td></tr>
	</table>

	</form>
	<? //echo "<br><a href=\"index.php\">Go Home</a> - <a href=\"view_owners.php\">View Owners</a>";

	}else{
//----------------------------------------------------------------------
		function rteSafe($strText) {

   $tmpString = $strText;

   $tmpString = str_replace(chr(145), chr(39), $tmpString);
   $tmpString = str_replace(chr(146), chr(39), $tmpString);
   $tmpString = str_replace("'", "'", $tmpString);

	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);

	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);

	return $tmpString;
}


  $body=stripslashes(rteSafe($_POST['rft_text']));
 //-----------------------------------------------------------------------------------------

	 $data=new getQueries();

      //$client_list=array(array('name'=>'Amanda Lawson', 'email'=>'amanda@casalindacity.com'),array('name'=>'Chris Lawson', 'email'=>'chris@casalindacity.com'), array('name'=>'Joseluis', 'email'=>'ing.joseluis@msn.com'));
	$_POST['from']=trim($_POST['from']); $_POST['to']=($_POST['to']);
	
	if (($_POST['from']!="")&&($_POST['to']!="")){
		 $client_list=$data->customers_from_to($_POST['from'],$_POST['to']);	
	}else{
      $client_list=$data->customers();
	}

	 $count=0;

		 if (!empty($client_list)){

			$class=0;
			foreach ($client_list as $o){
			 $em=sendMail_no_copies($body, $o['email'], $_POST['subject'], RESERVATIONS_EMAIL, "RCL Booking System");
                //  echo $o['email']."<br/>";
				$count++;
				 if ($class==0){
					$class++;
				 } elseif ($class==1){
					$class--;
				 }
			}

				if ($em){
					echo "<h1>Message successfully sent to $count Clients</h1><br>";

                   sendMail($body, RESERVATIONS_EMAIL, "Notification: This email have been sent to $count Clients", "Online.Booking@CasaLindaCity.com", "RCL Booking System");
				}else{
					echo "Error: could not send to $count Clients<br>";
				}

		 }else{

			echo ('<br>No clients found to send this email');
		 }
  }
?>

</div>
