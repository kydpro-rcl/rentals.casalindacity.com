
<script language="JavaScript" src="../arrival_departure/dates/javascripts.js"></script>
	<link rel="STYLESHEET" type="text/css" href="../arrival_departure/dates/estilo.css">
 <?
  $estilo="float:left; padding:0; margin:0; width:200px; height:180px;";

 if ($_GET['color']){
 	$estilo.="background-color:#".$_GET['color'].";";
 }?>

<div style="<?=$estilo?>" >
 <a href="http://www.casalindacity.com" ><img src="images/logo.gif" alt="Residencial Casa Linda" border="0" width="200px;" height="50px;"/></a>
    <table align="center" style="border: #666 solid 1px;" bgcolor="#b4c38a" cellpadding="2" cellspacing="2" ><tr><td>
    <form name="bookform" id="bookform" method="post" action="availability_result.php" target="_blank">

    <p style="text-align:right; padding:0; margin:0; ">
       <span style="color:white; font-weight:bold; font-size:9px;"> Arrival date:</span>
      <?php
    	escribe_formulario_fecha_vacio("fecha_ini","bookform");
		?>
    </p>
    <p style="text-align:right; padding:0; margin:0; ">
        <span style="color:white; font-weight:bold; font-size:9px;"> Departure date: </span>

        <?php
			escribe_formulario_fecha_vacio("fecha_ter","bookform");
         ?>
    </p >
    <p style="text-align:right; padding:0; margin:0; " >
         <span style="color:white; font-weight:bold; font-size:9px;">Bedrooms:</span>
         <select name="beds" id="NumBeds" >
            <option value="2">Two</option>
            <option value="3">Three</option>
            <option value="4">Four</option>
        </select>

        <select name="show" id="mostar" >
            <option value="1" selected="selected">All Inventory</option>
            <option value="2">Only Available</option>
        </select>
     </p>

     <p style="text-align:center; padding:0; margin:0; "><input id="boton" type="submit" value="Book" name="go" /> </p>
     </form>
    </td></tr></table>
</div>
<hr/>
 To get our above widget, please, type your URL below and choose your background color.

<form method="post" action="widget_result.php">
    URL:<input type="text" name="url" />
    <input type="submit" value="go" name="go"/>
</form>