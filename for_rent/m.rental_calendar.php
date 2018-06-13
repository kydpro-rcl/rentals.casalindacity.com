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

    	<form name="bookform" id="bookform" method="post" action="m.availability.php">

	    <p class="parrafos" >
	        
	      <input type="text" name="fecha_ini" value="<? if($_POST['fecha_ini']){ echo $_POST['fecha_ini']; }?>" class="inputfecha" id="from" />Arrival
	     </p>  
		 <p class="parrafos">  
		   
	       <input type="text" name="fecha_ter" value="<? if($_POST['fecha_ter']){ echo $_POST['fecha_ter']; }?>" class="inputfecha" id="to" />Departure
	     </p> 
		<p class="parrafos"> 
		 
	         <select name="beds" class="input" >
	            <option value="2" <? if($_POST['beds']==2){ echo 'selected="selected"'; }?>>Two</option>
	            <option value="3" <? if($_POST['beds']==3){ echo 'selected="selected"'; }?>>Three</option>
	            <option value="4" <? if($_POST['beds']==4){ echo 'selected="selected"'; }?>>Four</option>
	            <option value="5" <? if($_POST['beds']==5){ echo 'selected="selected"'; }?>>Five</option>
	            <option value="6" <? if($_POST['beds']==6){ echo 'selected="selected"'; }?>>Six</option>
	        </select>Bedrooms
		</p >	
		<p class="parrafoser" >	
			<input type="hidden" name="referral" value="<?=$_GET['ref']?>" />
		 <input type="hidden" name="mostar" value="2" />
		 <input class="input" type="submit" value="Search" name="go" style="color:white; background-color:green;" />
	    </p >

	     
	      <!--<p style="margin:0; padding:0; text-align:right;margin-right:5px;"><span style="color:white; font-size:12px; padding:0; margin:0;">PROMOTION CODE: <span style="color:white; font-size:10px;">(Optional)</span></span></p>-->

	      <!--<p style="margin:0; padding:0; text-align:right; margin-right:5px; margin-bottom:15px;"><input type="text" size="12" name="promotion_code" value="<?=$_POST['promotion_code']?>" /></p>-->
	     
	     </form>
	    	
	</div>
      <!--//BOOKING CALENDAR END HERE//-->