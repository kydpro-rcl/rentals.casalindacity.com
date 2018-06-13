<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Cross-Browser Rich Text Editor</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

	<!-- To decrease bandwidth, change the src to richtext_compressed.js //-->
	<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
</head>
<body>



<form name="RTEDemo" action="demo.htm" method="post" onsubmit="return submitForm();">

<script language="JavaScript" type="text/javascript">
<!--
function submitForm() {
	//make sure hidden and iframe values are in sync before submitting form
	//to sync only 1 rte, use updateRTE(rte)
	//to sync all rtes, use updateRTEs
	//updateRTE('rte1');
	updateRTEs();
	alert("rte1 = " + document.RTEDemo.rte1.value);
	alert("rte2 = " + document.RTEDemo.rte2.value);
	alert("rte3 = " + document.RTEDemo.rte3.value);

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
writeRichText('rte1', 'here&#39;s the "<em>preloaded</em> <b>content</b>"', 520, 200, true, false);

document.writeln('<br><br>');
writeRichText('rte2', 'preloaded <b>text</b>', 560, 100, true, false);

document.writeln('<br><br>');
writeRichText('rte3', 'preloaded <b>text</b>', 450, 100, true, true);
//-->
</script>

<p>Click submit to show the value of the text box.</p>
<p><input type="submit" name="submit" value="Submit"></p>
</form>

</body>
</html>
