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

  <h3 style="color:#06F; text-align:center;">Searching Villa Availability</h3>
  <hr/>
  <p>&nbsp;</p>
<div style="float:left; padding:0; padding-left:300px;">

    <table align="center" style="border: #666 solid 1px;" bgcolor="#b4c38a" cellpadding="2" cellspacing="2" ><tr><td>
    <form name="bookform" id="bookform" method="post" action="availability_result.php">

    <p style="text-align:right">
       <span style="color:white; font-weight:bold;"> Arrival date:</span>
      <input type="text" name="fecha_ini" value="" class="inputfecha" id="from" />
      <?php
    	//escribe_formulario_fecha_vacio("fecha_ini","bookform");
		?>
		<br><span style="color:white; font-weight:bold; font-size:8px;">MM/DD/YYYY</span>
    </p>
    <!--TERMINA FECHA DE INICIO Y EMPIEZA FECHA DE SALIDA-->
    <p style="text-align:right">
        <span style="color:white; font-weight:bold;"> Departure date: </span>
       <input type="text" name="fecha_ter" value="" class="inputfecha" id="to" />
        <?php
			//escribe_formulario_fecha_vacio("fecha_ter","bookform");
			/*error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);*/
		?><br><span style="color:white; font-weight:bold; font-size:8px;">MM/DD/YYYY</span>
    </p >
    <p style="text-align:right" >
         <span style="color:white; font-weight:bold;">Bedrooms:</span>
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
      <p><span style="color:white; font-weight:bold; font-size:10px;">PROMOTION CODE:</span><input type="text" size="12" name="promotion_code" value="<?=$_POST['promotion_code']?>" /><span style="color:white; font-weight:bold; font-size:10px;">(Optional)</span></p>
     <p style="text-align:center"><input id="boton" type="submit" value="Search" name="go" /> </p>
     </form>
    </td></tr></table>
</div>
<p>&nbsp;</p>
<br/>
<p style="clear:both; text-align:center; color:green;">Please, select your arrival date, departure date and quantity of bedrooms required,<br/> And click the "Search" button.</p>
<?/*}else{?>
<h3 style="color:green; text-align:center;">Dear, Referal Agent:<br/>If you are planning to make a booking as a client, please logout first.</h3>
<?
}*/?>
<!--END CONTENT FOR BOOK SEARCH-->