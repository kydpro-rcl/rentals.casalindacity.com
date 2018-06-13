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
 echo 'hola<br/>';
 echo htmlentities(rteSafe($_POST['test_field']));
 echo '<br/>';
echo htmlentities($_POST['rte1']);

echo '<br/>';
//echo html_entity_decode($_POST['rte1']);

 //take off backslashes
 echo stripslashes($_POST['rte1']);
}
?>

</body></html>