<!--//<script language="JavaScript" src="js/javascripts.js"></script>//-->
	<!--<link rel="STYLESHEET" type="text/css" href="../for_rent/arrival_departure/dates/estilo.css">  -->
<!--Data picker-->
		<script type="text/javascript" src="../data_picker/js/datepicker.js"></script>
        <link href="../data_picker/css/demo.css"       rel="stylesheet" type="text/css" />
        <link href="../data_picker/css/datepicker.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript">
//<![CDATA[

/*
        A "Reservation Date" example using two datePickers
        --------------------------------------------------

        * Functionality

        1. When the page loads:
                - We clear the value of the two inputs (to clear any values cached by the browser)
                - We set an "onchange" event handler on the startDate input to call the setReservationDates function
        2. When a start date is selected

                - We set the low range of the endDate datePicker to be the start date the user has just selected
                - If the endDate input already has a date stipulated and the date falls before the new start date then we clear the input's value

        * Caveats (aren't there always)

        - This demo has been written for dates that have NOT been split across three inputs

*/

function makeTwoChars(inp) {
        return String(inp).length < 2 ? "0" + inp : inp;
}

function initialiseInputs() {
        // Clear any old values from the inputs (that might be cached by the browser after a page reload)
        document.getElementById("sd").value = "";
        document.getElementById("ed").value = "";

        // Add the onchange event handler to the start date input
        datePickerController.addEvent(document.getElementById("sd"), "change", setReservationDates);
}

var initAttempts = 0;

function setReservationDates(e) {
        // Internet Explorer will not have created the datePickers yet so we poll the datePickerController Object using a setTimeout
        // until they become available (a maximum of ten times in case something has gone horribly wrong)

        try {
                var sd = datePickerController.getDatePicker("sd");
                var ed = datePickerController.getDatePicker("ed");
        } catch (err) {
                if(initAttempts++ < 10) setTimeout("setReservationDates()", 50);
                return;
        }

        // Check the value of the input is a date of the correct format
        var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

        // If the input's value cannot be parsed as a valid date then return
        if(dt == 0) return;

        // At this stage we have a valid YYYYMMDD date

        // Grab the value set within the endDate input and parse it using the dateFormat method
        // N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
        var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

        // Set the low range of the second datePicker to be the date parsed from the first
        ed.setRangeLow( dt );

        // If theres a value already present within the end date input and it's smaller than the start date
        // then clear the end date value
        if(edv < dt) {
                document.getElementById("ed").value = "";
        }
}

function removeInputEvents() {
        // Remove the onchange event handler set within the function initialiseInputs
        datePickerController.removeEvent(document.getElementById("sd"), "change", setReservationDates);
}

datePickerController.addEvent(window, 'load', initialiseInputs);
datePickerController.addEvent(window, 'unload', removeInputEvents);

//]]>
</script>
<!--Data Picker-->
<h3 style="color:green; text-align:center;">Special search only for Referral Agents</h3>
  <hr/>
  <p>&nbsp;</p>


    <table align="center" style="border: #666 solid 1px;" bgcolor="#b4c38a" cellpadding="2" cellspacing="2" ><tr><td>
    <!--<form name="bookform" id="bookform" method="post" action="https://www.casalindacity.com/for_rent/availability_result.php?ref=<?=$_SESSION['referal']['id']?>" target="_blank">-->
	<form name="bookform" id="bookform" method="post" action="create_booking1.php" >
    <p style="text-align:right">
       <span style="color:white; font-weight:bold;"> Arrival date:</span>
		<input type="text" class="w8em format-m-d-y highlight-days-67 range-low-today" name="fecha_ini" id="sd" value="" maxlength="10" />
      <?php
    	/*escribe_formulario_fecha_vacio("fecha_ini","bookform");*/
		?>
		<br><span style="color:white; font-weight:bold; font-size:8px;">MM/DD/YYYY</span>
    </p>

    <p style="text-align:right">
        <span style="color:white; font-weight:bold;"> Departure date: </span>
		<input type="text" class="w8em format-m-d-y highlight-days-67 range-low-today" name="fecha_ter" id="ed" value="" maxlength="10" />
        <?php
			/*escribe_formulario_fecha_vacio("fecha_ter","bookform");*/

		?><br><span style="color:white; font-weight:bold; font-size:8px;">MM/DD/YYYY</span>
    </p >
    <p style="text-align:right" >
         <span style="color:white; font-weight:bold;">Bedrooms:</span>
         <select name="beds" id="NumBeds" >
            <option value="2">Two</option>
            <option value="3">Three</option>
            <option value="4">Four</option>
			<option value="5">Five</option>
            <option value="6">six</option>
        </select>

        <!--<select name="show" id="mostar" >
            <option value="1" selected="selected">All Inventory</option>
            <option value="2">Only Available</option>
        </select>-->
     </p>

     <p><input id="boton" type="submit" value="SEARCH" name="go" /> </p>
     </form>
    </td></tr></table>

<br/>
<p style="clear:both; text-align:center; color:green;">Please, select your arrival date, departure date and quantity of bedrooms required,<br/> And click the "Search" button.<br/><!--<br/>Please be aware that when quoting the price to the client, price shown on next page does not include the CC fee we charge for the deposits.<br/> CC fee equals Price of Villa (including tax) plus 4.95% and 30 cents--></p>

<!--END CONTENT FOR BOOK SEARCH-->