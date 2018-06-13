<link href="RTF_html/rte.css" rel="stylesheet" type="text/css" />

<div id="content">
<p class="header">Emailing Owners</p>
<!--<hr />-->
	<!-- To decrease bandwidth, change the src to richtext_compressed.js //-->
	<script language="JavaScript" type="text/javascript" src="RTF_html/richtext.js"></script>
  <!--  <script language="JavaScript" type="text/javascript" src="jquery/jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="jquery/searchbox.js"></script>-->

  <? if (!$_POST['send']){?>
	<form  method="post" name="RTEDemo" action="send_emails.php">
	<table><tr><td>
	Subject:</td><td><input type="text" size="70" name="subject" /></td></tr>
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

	<tr><td><!--//<p>Langage:</p>//--></td><td><p><!--//<select name="language" size="1">
	            <option value="All">All</option>
				<option value="English">English</option>
	            <option value="Spanish">Spanish</option>
	            <option value="German">German</option>
	            <option value="French">French</option>
                </select>//-->
	            Owners:
	            <select name="type" size="1">
	            <option value="1">All</option>
				<option value="2">Rental pool</option>
	            <option value="3">No rental pool</option>
                  </select>
	          </p>
			</td></tr>

	<tr><td colspan="2"><input class="book_but" type="submit" name="send" value="send" onClick="submitForm()" /></td></tr>
	</table>

	</form>
	<? //echo "<br><a href=\"index.php\">Go Home</a> - <a href=\"view_owners.php\">View Owners</a>";

	}else{
//----------------------------------------------------------------------
		function rteSafe($strText) {
   //returns safe code for preloading in the RTE
   $tmpString = $strText;

   //convert all types of single quotes
   $tmpString = str_replace(chr(145), chr(39), $tmpString);
   $tmpString = str_replace(chr(146), chr(39), $tmpString);
   $tmpString = str_replace("'", "'", $tmpString);

	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);

	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);

	return $tmpString;
}

// echo 'hola<br/>';
 //echo htmlentities(stripslashes(rteSafe($_POST['rft_text'])));
  //$body=htmlentities(stripslashes(rteSafe($_POST['rft_text'])));
  $body=stripslashes(rteSafe($_POST['rft_text']));
 //-----------------------------------------------------------------------------------------
    // echo $_POST['type'];
     //echo $body;
	 $data=new getQueries();
     $owner_list=$data->send_email_owners($_POST['type'], $language="");

	 $count=0;

	// print_r($owner_list);
	 //echo $users[0]['name'];
		 if (!empty($owner_list)){
		 //$email=new drawer();
		 //echo "<table border='0' cellpadding='3'><tr class='head'><td class='center'><strong>Email</strong></td><td class='center'><strong>Villa No:</strong></td><td class='center'><strong>Language</strong></td></tr>";
			$class=0;
			foreach ($owner_list as $o){
			 $em=sendMail_no_copies($body, $o['email'], $_POST['subject'], RESERVATIONS_EMAIL, "RCL Booking System");
             #$em=$email->sendMail(/*$_POST['body']*/$body, $o['email'], $_POST['subject'], $_SESSION['user']['email'], $_SESSION['user']['name']);
				//echo "<tr class=\"class$class\"><td>".$o['email']."</td><td>".$o['villa']."</td><td>".$o['language']."</td></tr>";
				//echo $o['name']." ".$o['email']." ".$o['villa'];
				//echo "<br/>";
				$count++;
				 if ($class==0){
					$class++;
				 } elseif ($class==1){
					$class--;
				 }
			}
			//echo "</table>";
			//insertar in sent items
			//$save=new Inserter();
			//$save->insert_sent_msg($_POST['subject'],$_POST['body'], $_POST['language'], "$count");
				if ($em){
					echo "Message successfully sent to $count Owners<br>";
                    //sent to reservations
                    sendMail($body, RESERVATIONS_EMAIL, "Notification: This email have been sent to $count Owners", "Online.Booking@CasaLindaCity.com", "RCL Booking System");
				}else{
					echo "Error: could not send to $count Owners<br>";
				}
			//echo "<br><a href=\"index.php\">Go Home</a> - <a href=\"view_owners.php\">View Owners</a>";
		  // }
		 }else{
		 	//echo "<br><a href=\"index.php\">Go Home</a> - <a href=\"view_owners.php\">View Owners</a>";
			echo ('<br>No owners found to send this email');
		 }
  }
?>

</div>
