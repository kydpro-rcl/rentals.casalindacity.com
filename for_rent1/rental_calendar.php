<!--//START BOOKING CALENDAR HERE//-->
   <link type="text/css" href="arrival_departure/dates/estilo.css" rel="stylesheet" />
    <link type="text/css" href="datapicker-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="datapicker-ui/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="datapicker-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
    <script>
    <!--//
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: false,
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
	//-->
	</script>
    <div id="bookingbar">

    	<form name="bookform" id="bookform" method="post" action="availability_result.php">

	    <p style="text-align:right;margin:0; padding:0; margin-right:5px;">
	       <span style="color:white; padding:0; margin:0;"> Arrival date:</span>
	      <input type="text" name="fecha_ini" value="<? if($_POST['fecha_ini']){ echo $_POST['fecha_ini']; }?>" class="inputfecha" id="from" />

			<br><span style="color:white; font-size:10px;">MM/DD/YYYY</span>
	    </p>
	    <p style="text-align:right; padding:0; margin:0; margin-right:5px;">
	        <span style="color:white; padding:0; margin:0;"> Departure date: </span>
	       <input type="text" name="fecha_ter" value="<? if($_POST['fecha_ter']){ echo $_POST['fecha_ter']; }?>" class="inputfecha" id="to" />
	       <br><span style="color:white; font-size:10px;">MM/DD/YYYY</span>
	    </p >
	    <p style="text-align:left; padding:0; margin:0; margin-right:5px;" >
	         <span style="color:white; margin-left:43px;">Bedrooms:</span></p>
	    <p style="text-align:right; padding:0; margin:0; margin-right:5px;margin-bottom:15px;">
	         <select name="beds" id="NumBeds" >
	            <option value="2" <? if($_POST['beds']==2){ echo 'selected="selected"'; }?>>Two</option>
	            <option value="3" <? if($_POST['beds']==3){ echo 'selected="selected"'; }?>>Three</option>
	            <option value="4" <? if($_POST['beds']==4){ echo 'selected="selected"'; }?>>Four</option>
	            <option value="5" <? if($_POST['beds']==5){ echo 'selected="selected"'; }?>>Five</option>
	            <option value="6" <? if($_POST['beds']==6){ echo 'selected="selected"'; }?>>Six</option>
	        </select>

	        <select name="show" id="mostar" >
	            <option value="1" <? if($_POST['show']==1){ echo 'selected="selected"'; }?>>All Inventory</option>
	            <option value="2" <? if($_POST['show']==2){ echo 'selected="selected"'; }?>>Only Available</option>
	        </select>
	     </p>
	     <input type="hidden" name="referral" value="<?=$_SESSION['REFERRALID']?>" />
		  <input type="hidden" name="villa" value="<?=$_GET['villa']?>" />
	      <!--<p style="margin:0; padding:0; text-align:right;margin-right:5px;"><span style="color:white; font-size:12px; padding:0; margin:0;">PROMOTION CODE: <span style="color:white; font-size:10px;">(Optional)</span></span></p>-->

	       <!--<p style="margin:0; padding:0; text-align:right; margin-right:5px; margin-bottom:15px;"><input type="text" size="12" name="promotion_code" value="<?=$_POST['promotion_code']?>" /></p>-->
	     <p style="text-align:right;margin:0; padding:0; margin-right:5px; margin-bottom:15px;"><input id="boton" type="submit" value="Search" name="go" /> </p>
	     </form>
	    	<p style="margin:0; padding:0; text-align:right;"><!--<img src="images/rentalbookingback2.jpg" style="margin:0; padding:0;"  />--></p>
	    </div>
      <!--//BOOKING CALENDAR END HERE//-->