<?php
include ("dates/arrival_departure.php");
?>

<html>
<head>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=ISO-8859-1">
	<title>Utilización del calendario</title>
	<script language="JavaScript" src="dates/javascripts.js"></script>
	<link rel="STYLESHEET" type="text/css" href="dates/estilo.css">
</head>

<body>
<h1>Search Villas</h1>

<br>
<br>
<br>
<form name="fcalen">
Arrival:
<?php
escribe_formulario_fecha_vacio("fecha1","fcalen");
?>
<?php

?>
<br>
<br>
Departure:
<?php
escribe_formulario_fecha_vacio("fecha2","fcalen");
?>

</form>

</body>
</html>
