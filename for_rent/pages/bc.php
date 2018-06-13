<?/*if (!$_SESSION['referal']){*/?>


<script language="JavaScript" src="arrival_departure/dates/javascripts.js"></script>
	<link rel="STYLESHEET" type="text/css" href="arrival_departure/dates/estilo.css">

		<link type="text/css" href="datapicker-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="datapicker-ui/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="datapicker-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
        <script>
			/* $(function() {
				$( "#datepicker" ).datepicker({
					numberOfMonths: 2,
					showButtonPanel: true
				});
			});

			$(function() {
				$( "#datepicker1" ).datepicker({
					numberOfMonths: 2,
					showButtonPanel: true
				});
			}); */
       </script>
	<script>
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
	</script>

		<style type="text/css">
			/*#datepicker { font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}  */
			/*#ui-datepicker-div { font-size:10px;}*/
		</style>
<style>
  body{
background-color:#384244;
}
</style>

<div style="float:left; padding:0; margin:0;">
<a href="http://casalindacity.com/" target="_blank"><img src="images/casalindalogo.png" alt=""/></a>
    <table align="center" style="border: #666 solid 1px; margin:0; padding:0;" bgcolor="#384244" cellpadding="0" cellspacing="" ><tr><td>
    <form name="bookform" id="bookform" method="post" action="availability_result.php" style="margin:0; padding:0;" target="_blank">

    <p style="text-align:right;  margin:0; padding:0;">
       <span style="color:white;"> Arrival date:</span>
      <input type="text" name="fecha_ini" value="" class="inputfecha" id="from" />
      <?php
    	//escribe_formulario_fecha_vacio("fecha_ini","bookform");
		?>
		<br><span style="color:white; font-weight:bold; font-size:8px;">MM/DD/YYYY</span>
    </p>
    <!--TERMINA FECHA DE INICIO Y EMPIEZA FECHA DE SALIDA-->
    <p style="text-align:right; margin:0; padding:0;">
        <span style="color:white; "> Departure date: </span>
       <input type="text" name="fecha_ter" value="" class="inputfecha" id="to" />
        <?php
			//escribe_formulario_fecha_vacio("fecha_ter","bookform");
			/*error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);*/
		?><br><span style="color:white; font-weight:bold; font-size:8px;">MM/DD/YYYY</span>
    </p >
    <p style="text-align:left; padding:0; margin:0; margin-left:43px;" >
         <span style="color:white;">Bedrooms:</span>
    </p>
    <p style="text-align:right; margin:0; padding:0;" >
         <select name="beds" id="NumBeds" >
            <option value="2">Two</option>
            <option value="3">Three</option>
            <option value="4">Four</option>
            <option value="6">Six</option>
        </select>

        <select name="show" id="mostar" >
            <option value="1" selected="selected">All Inventory</option>
            <option value="2">Only Available</option>
        </select>
     </p>
      <p style="text-align:right; margin:0; padding:0;"><span style="color:white; font-weight:bold; font-size:10px; ">PROMOTION CODE</span> <span style="color:white; font-weight:bold; font-size:10px;">(Optional)</span><br/>
      <input type="text" size="12" name="promotion_code" value="<?=$_POST['promotion_code']?>" />
      </p>
     <p style="text-align:right; margin:0; padding:0;"><input id="boton" type="submit" value="Search" name="go" /> </p>
     </form>
     <img src="images/rentalbookingback2.jpg" style=" margin:0; padding:0;"/>
    </td></tr></table>
</div>
