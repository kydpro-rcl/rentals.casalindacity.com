<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Cross-Browser Rich Text Editor</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta name="PageURL" content="http://www.kevinroth.com/rte/demo.htm" />
	<meta name="PageTitle" content="Cross-Browser Rich Text Editor" />
	<!-- To decrease bandwidth, change the src to richtext_compressed.js //-->
	<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
    <script language="JavaScript" type="text/javascript" src="jquery/jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="jquery/searchbox.js"></script>
</head>
<body>



<form name="RTEDemo" action="form.php" method="post" >

<script language="JavaScript" type="text/javascript">
<!--
function submitForm() {
	//make sure hidden and iframe values are in sync before submitting form
	//to sync only 1 rte, use updateRTE(rte)
	//to sync all rtes, use updateRTEs
	updateRTE('rte1');
	//updateRTEs();
	//alert("rte1 = " + document.RTEDemo.rte1.value);
	document.RTEDemo.rtf_text.value=document.RTEDemo.rte1.value;
	//alert("rte2 = " + document.RTEDemo.rte2.value);
	//alert("rte3 = " + document.RTEDemo.rte3.value);

	//change the following line to true to submit form
	return false;
}

//Usage: initRTE(imagesPath, includesPath, cssFile)
initRTE("images/", "", "");
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
<p><input type="submit" name="submit" value="Submit" onClick="submitForm()"></p>
</form>

</body>
</html>

<?
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

if ($_POST['submit']){
// echo 'hola<br/>';
 echo htmlentities(stripslashes(rteSafe($_POST['rft_text'])));
// echo '<br/>';
//echo htmlentities($_POST['rte1']);

//echo '<br/>';
//echo html_entity_decode($_POST['rte1']);

 //take off backslashes
 //echo stripslashes($_POST['rte1']);
}
?>
