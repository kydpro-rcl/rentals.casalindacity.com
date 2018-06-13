<?php
$db= new getQueries ();
$villas_for_rent=$db->singleVilla4rent($id=trim($_GET['v']));
$v=$villas_for_rent[0];
if(!$v){
	die('Error: villa not found!'); // stop here is villa is not available online
}
//echo "<pre>";
//print_r($villas_for_rent);
//echo "<pre>";
$feature=$db->villa_1_ramdom_online($beds=$v['bed']);

	$date_today = date('Y-m-d');
	$end_date=date('m/d/Y', strtotime($date_today. ' + 5 days'));		
$loc=$db->location($v['id']);	

$seasons=$db->seasons3();

//print_r($loc);
?>

<style type="text/css">
@media(max-width:768px) {
    body,
    html {
        max-width: 100vw !important;
        overflow-x: hidden !important;
    }
}
</style>
<div id="Top" class="main-wrapper">
	
	<div class="container">
		<div class="row breadcrumb-wrapper">
			<div class="col-xs-12">
				<ol class="breadcrumb">
					<li>
						<a href="index.php">Home</a>
					</li>
					
					<li>
						<a href="vacation-villas-search.php?b=<?=$v['bed']?>&i=<?=date('m/d/Y');?>&t=<?=$end_date?>">Search Results</a>
					</li>
					
					<li>
						<span class="pid-text">Code:</span> Villa-<?=$v['no']?>
					</li>
					
				</ol>
			</div>
		</div>
		
		<div class="row mrg-top-1 mrg-bottom-50">
			<div class="col-xs-12">
			<?php
			if($v['headline']!=''){
				//$pos=strpos($v['headline'], ' ', 100);
				$title=substr($v['headline'],0,100 ); 
			}else{
				$title=$v['bed']." Bedroom Villa";
			}
			?>
				<h1 class="property-page-title"><?=$title?><!--<?=$v['bed']?> Bedroom Villa--></h1>
				
			</div>
		</div>
		<div class="property-page-details-menu-wrapper property-page-fixed-items">
	<div class="property-page-details-menu-container container">
		<div class="row">
			<div class="col-xs-12">
				<ul class="list-inline property-page-details-menu">
					
					<li class="property-page-details-menu-item"><a href="#" class="" data-toggle="modal" data-target="#propGalleryModal">Photos</a></li>
					
					<li class="property-page-details-menu-item"><a href="#Description" class="">Description</a></li>
					
					<li class="property-page-details-menu-item"><a href="#Amenities" class="">Amenities</a></li>
					
					<li class="property-page-details-menu-item"><a href="#Map" class="">Map</a></li>
					
					<li class="property-page-details-menu-item"><a href="#Calendar" class="">Calendar</a></li>
					
					<li class="property-page-details-menu-item"><a href="#Rates" class="">Rates</a></li>
					
						<!--<li class="property-page-details-menu-item"><a href="#Reviews" class="">Reviews</a></li>-->
					
					<li class="property-page-details-menu-item pull-right btn-property-back-to-top"><a href="#" class="">Back to Top</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
		
		<div class="row main-content-row">	
				
			<div class="col-xs-12 col-sm-4 col-md-3 pull-right" id="content2Left">
			
				<div class="property-instant-quote-affix property-page-fixed-items">
					
					

<script>
var OnlineBookings = true;
</script>


<style>

.datepicker table tr td{	
	border-radius: 0px !important;
}

.datepicker table tr td.disabled{
	background: #e9e9e9 !important;
	color: #dadada !important;	
}

.datepicker table tr td.active:active, .datepicker table tr td.selected{	
	background: #C0C081 !important;
	color: #444444 !important;	
}

.datepicker table tr td.range{	
	background: #FFCC66 !important;
	color: #444444 !important; 		
} 

.datepicker table tr td.active:active.disabled, .datepicker table tr td.selected.disabled, .datepicker table tr td.disabled.range{
	color: #F37A81 !important;
	font-weight: bold;	
}

.datepicker-overlay{
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	z-index: 6000;
	background: rgba(255,255,255,0.75);
	text-align: center;
}

.datepicker-overlay i.fa-spin{
	font-size: 26px;
	color: #3498DB;
	margin-top: 60%;
}
.strikeout{
	text-decoration: line-through;
}
</style>
<div class="property-instant-quote panel panel-primary">
	<div class="panel-heading">

	
		<h4 class="text-center property-instant-quote-heading property-instant-quote-heading-default">
			Check Availability
		</h4>
		
		<div class="property-instant-quote-heading property-instant-quote-heading-available hidden">
			<h4 class="text-center">
				Your <strong><span class="property-instant-quote-num-nights"></span> Night</strong> Quote
			</h4>			
			<h6 class="text-center">
				(<span class="property-instant-quote-start-date"></span> - <span class="property-instant-quote-end-date"></span>)
			</h6>
		</div>
			
	</div>
	
	
	<div class="panel-body">
	
		<div class="property-instant-quote-loading text-center hidden">
			<i class="fa fa-circle-o-notch fa-spin"></i> Loading
		</div>	
	
		<!-- available -->
		<div class="property-instant-quote-available hidden">
			<table class="table table-bordered instant-quote-table">
				<tbody>
					<tr> 
						<td>
							<div class="has-specials hidden">$<span class="property-instant-quote-nightly-rate-before-specials"></span></div>
							<div class="discounted-rent">$<span class="property-instant-quote-nightly-rate"></span> X <span class="property-instant-quote-num-nights"></span> nights</div>
						</td>
						<td>
							<div class="has-specials hidden">$<span class="property-instant-quote-rent-before-specials"></span></div>
							<div class="discounted-rent">$<span class="property-instant-quote-rent"></span></div>
						</td>
					</tr>
					<tr class="quote-fee-row hidden">
						<td>
							Required Fees: 						
						</td>
						<td class="totalPrice TotalSpecialOptionTotal">
							$<span class="property-instant-quote-fees"></span>
						</td>
					</tr> 
					<tr> 
						<td> 
							Tax: 
						</td>
						<td class="totalPrice TotalSpecialOptionTotal">
							$<span class="property-instant-quote-tax"></span>
						</td>
					</tr>
					<tr>
						<td>
							<strong>Total Price: </strong>
						</td>
						<td class="totalPrice TheCompleteTotal">
							<strong>
							$<span class="property-instant-quote-total-price"></span>
							</strong>
						</td>
					</tr>
					<tr>
						<td>
							Due at Booking: 
						</td>
						<td class="totalPrice Deposit">
							$<span class="property-instant-quote-deposit-due"></span>
						</td>
					</tr>
				</tbody>
			</table>
			
		</div>
		
		<!-- unavailable or error-->
		<div class="property-instant-quote-message-holder">	
			<!--<div class="property-instant-quote-message hidden alert alert-danger" role="alert"></div>	-->		
		</div>
		
		<!-- changing dates -->
		<form method="post" action="vacation-villas-search.php">
		
		<div class="property-instant-quote-dates">
			
			<!-- mobile -->
			<div id="s-dates-mobile" class="row visible-xs">
				<div id="s-arrival-mobile" class="col-md-6">
					<div class="form-group">
						<label for="property-start-mobile">Arriving</label>
						<div class="left-inner-addon">
							<i class="fa fa-calendar-o"></i>
							<input type="text" class="form-control input-sm mobile-datepicker property-iq-date property-start" value="<?=date('m/d/Y');?>" id="iq-start-mobile" readonly>
						</div>
					</div>
				</div>
				<div id="s-departure-mobile" class="col-md-6">
					<div class="form-group">
						<label for="txtEndDate-mobile">Departing</label>
						<div class="left-inner-addon">
							<i class="fa fa-calendar-o"></i>
							<input type="text" class="form-control input-sm mobile-datepicker property-iq-date property-end" value="<?=$end_date;?>" id="iq-end-mobile" readonly>
						</div>
					</div>
				</div>
			</div>		
			
			<div id="s-dates-mobile" class="row visible-xs">
				<div id="s-arrival-mobile" class="col-md-6">
					<div class="form-group">
						<label for="AmenBedrooms">Adults</label>
							<select name="adults" class="form-control input-sm search-item" id="Bedrooms">
									<?php
									for ($i=1; $i<=12; $i++){?>
											<option value="<?=$i?>"  >
												<?=$i?> guests
											</option>
									<?php
									}
									?>
							</select>
					</div>
				</div>
				<div id="s-departure-mobile" class="col-md-6">
					<div class="form-group">
						<label for="MaxPersons">Children</label>
							<select name="kids" class="form-control input-sm search-item" id="Guests">
								<option value="0">None</option>
											<?php
									for ($i=1; $i<=15; $i++){?>
											<option value="<?=$i?>"  >
												<?=$i?> guests
											</option>
									<?php
									}
									?>
							</select>
					</div>
				</div>
			</div>		
			
			<!-- desktop -->
			<div id="s-dates-desktop" class="row input-daterange instant-quote-daterange hidden-xs">
				<div id="s-arrival-desktop" class="col-sm-12 col-lg-6">
					<div class="form-group">
						<label for="property-start-desktop">Arriving</label>
						<div class="left-inner-addon">
							<i class="fa fa-calendar-o"></i>
							<input type="text" class="form-control input-sm property-iq-date property-start" value="<?=date('m/d/Y');?>" name="fecha_ini" id="txtStartDate" readonly>
						</div>
					</div>
				</div>
				<div id="s-departure-desktop" class="col-sm-12 col-lg-6">
					<div class="form-group">
						<label for="property-end-desktop">Departing</label>
						<div class="left-inner-addon">
							<i class="fa fa-calendar-o"></i>
							<input type="text" class="form-control input-sm property-iq-date property-end" value="<?=$end_date;?>" name="fecha_ter" id="txtEndDate" readonly>
						</div>
					</div>
				</div>
				
				<div id="s-arrival-desktop" class="col-sm-12 col-lg-6">
					<div class="form-group">
						<label for="AmenBedrooms">Adults</label>
							<select name="adults" class="form-control input-sm search-item" id="Bedrooms">
									<?php
									for ($i=1; $i<=12; $i++){?>
											<option value="<?=$i?>"  >
												<?=$i?> guests
											</option>
									<?php
									}
									?>
							</select>
					</div>
				</div>
				<div id="s-departure-desktop" class="col-sm-12 col-lg-6">
					<div class="form-group">
						<label for="MaxPersons">Children</label>
							<select name="kids" class="form-control input-sm search-item" id="Guests">
								<option value="0">None</option>
											<?php
									for ($i=1; $i<=15; $i++){?>
											<option value="<?=$i?>"  >
												<?=$i?> guests
											</option>
									<?php
									}
									?>
							</select>
					</div>
				</div>
			</div>
			
			<!-- dates need to stay in imperial format always for book it now and quote --> 
			<!--<input type="hidden" id="property-instant-quote-start-date" value="<?=date('m/d/Y');?>">
			<input type="hidden" id="property-instant-quote-end-date" value="<?=$end_date;?>">
			<input type="hidden" id="property-instant-quote-adults" value="0">
			<input type="hidden" id="property-instant-quote-children" value="0">-->
			
			<input type="hidden" name="beds" value="<?=$v['bed']?>">
			<input type="hidden" name="uniqueVilla" value="<?=$v['id']?>">
			<!--<button type="button" class="btn btn-primary btn-block property-instant-quote-button">Search</button>-->
			<button type="submit" class="btn btn-primary btn-block property-instant-quote-button">Search</button>
			
		</div>
		</form>
	
	</div>
	
	<div class="panel-footer">
		
		<div class="property-instant-quote-action">
			<!--<a href="javascript: void(0)" class="btn btn-success btn-block hidden property-instant-quote-action-button property-instant-quote-button-book" data-button-type="book">
				Book it Now
			</a>-->
			<a href="javascript: void(0)" class="btn btn-success btn-block hidden property-instant-quote-action-button property-instant-quote-button-contact" data-button-type="contact">
				Contact Manager
			</a>
		</div>
			
		<div class="property-instant-quote-marketing-text text-center">   
			
			<small class="property-instant-quote-marketing-text-default">Available to Reserve Online 24/7</small>
			
		</div>
			
		<a href="javascript: void(0)" class="btn btn-link btn-block property-instant-quote-change-dates hidden">
			Change Dates
		</a>

	</div>
</div>

<!-- book it now form -->
<form action="#" id="property-quote-form-book" class="property-action-form" method="POST" id="form_reserve" name="form_reserve">
	<input type="hidden" name="AD" value="<?=date('m/d/Y');?>">
	<input type="hidden" name="DD" value="<?=$end_date;?>">
	<input type="Hidden" name="PageDataID" value=116273>
	<input type="Hidden" name="InventoryUnitDataID" value="0">
	<input type="Hidden" name="WebReferenceID" value="1376">
	<input type="Hidden" name="DynSiteID" value="1376">
	<input type="Hidden" name="WebReferencePageDataID" value=116273>
	
	<input type="hidden" name="NavisCode" ID="NavisCode" value="">
	<input type="hidden" name="LeadID" class="hiddenLeadID" value="">
	<input type="hidden" name="uniqueVilla" value="<?=$v['id']?>">
	
	
</form>

<!-- contact form -->
<form action="contact-information.php" id="property-quote-form-contact" class="property-action-form" method="post">
	<input type="Hidden" name="AD" class="form-property-start" value="<?=date('m/d/Y');?>">
	<input type="Hidden" name="DD" class="form-property-end" value="<?=$end_date;?>">
	<input type="Hidden" name="PageDataID" value="116273">
</form>
	
	
<script>
 var PageDataID = 116273;

(function(window, $){
	
	$( document ).ready(function(){ 
	
		var getPropertyQuote = function(){		
			
			LIVEREZ.InstantQuote.removeError();
			LIVEREZ.InstantQuote.hidePricing();
			LIVEREZ.InstantQuote.hideDates();
			LIVEREZ.InstantQuote.showLoading();	
			LIVEREZ.InstantQuote.showButton('');		
		
			LIVEREZ.InstantQuote.getQuote({
				PageDataID: PageDataID, // comes from property page
				StartDate: $('#property-instant-quote-start-date').val() || '',
				EndDate: $('#property-instant-quote-end-date').val() || '',
				Adults: $('#property-instant-quote-adults').val() || 2,
				Children: $('#property-instant-quote-children').val() || 0
			});		
			
		}		
		
		// hide & show elements when changing dates
		$('.property-instant-quote-change-dates').on('click', function() {
			LIVEREZ.InstantQuote.changeDates();
			LIVEREZ.InstantQuote.hidePricing();
			LIVEREZ.InstantQuote.removeError();
		});	
		
		// keep all the dates in sync
		$('.property-start').on('change', function() {		
			$('#property-instant-quote-start-date').val(LIVEREZ.DynsiteFunctions.fixEuroDatesForAPI($(this).val(), dateFormatType));
			$('.property-action-form > input[name="AD"]').val($('#property-instant-quote-start-date').val());		
		});
		
		// keep all the dates in sync
		$('.property-end').on('change', function() {	
			$('#property-instant-quote-end-date').val(LIVEREZ.DynsiteFunctions.fixEuroDatesForAPI($(this).val(), dateFormatType));		
			$('.property-action-form > input[name="DD"]').val($('#property-instant-quote-end-date').val());
		});		
			
		// get quote when you click the 'get quote' button
		$('.property-instant-quote-button').on('click', function(){ 
			getPropertyQuote();
		});	
		
		// get quote when you click the button
		$('.property-instant-quote-action-button').on('click', function(){ 
			LIVEREZ.InstantQuote.submitForm($(this).data('button-type'));
		});

		
		

		var datepickerAvailability = new LIVEREZ.CalendarAvailability(DYN_SITE_ID, ADMIN_CUST_DATA_ID, PageDataID);
		var datepickerOverlay = $('<div/>').addClass('datepicker-overlay').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
		
		// ********* desktop datepickers **********
		$('.instant-quote-daterange').datepicker({
			beforeShowDay: function(date){
				return {
					enabled: new Date(date).setHours(0,0,0,0) <  new Date().setHours(0,0,0,0) ? false : true
				};
			}, 
			format: dateFormat,
			immediateUpdates: true,
			autoclose: true
		})
		.on('show', function(e){
			$('.datepicker-overlay').remove();
			queryUnavailableDates(e.date.getFullYear());
			
		})
		.on('changeMonth', function(e) { 
			 
			setTimeout(function(){
				
				var parts = $('.datepicker-days th.datepicker-switch').text().split(' ');
				var month = parts[0]; 
				var year = parseInt(parts[1]);
				
				queryUnavailableDates(year);
			
			},0);
			
		})
		.on('changeDate', function(e) {
		
			queryUnavailableDates(e.date.getFullYear());
			
			if(datepickerAvailability.findDateConflicts($('#txtStartDate').val(), $('#txtEndDate').val())){
				$('.property-instant-quote-message').html('Your travel dates contain unavailable nights. Please select new dates.').removeClass('hidden');
				$('.property-instant-quote-button').addClass('hidden');
			} else {
			
				if(e.target.id == 'txtStartDate'){
			 
					var startDate = new Date(e.date);	
				
					// this really only matters if the device is resized
					//$('#iq-start-mobile').mobiscroll('setDate', startDate);		
					$('#iq-start-mobile').val(LIVEREZ.DynsiteFunctions.DateShort(startDate));
				
					var newDate = new Date(e.date)
					newDate.setDate(newDate.getDate() + defaultSearchDepartureDays);
								
					$('#txtEndDate').datepicker('setDate', newDate);				
									
				};
				
				if(e.target.id == 'txtEndDate'){
				
					var endDate = new Date(e.date);		
					// this really only matters if the device is resized
					$//('#iq-end-mobile').mobiscroll('setDate', endDate);
					$('#iq-end-mobile').val(LIVEREZ.DynsiteFunctions.DateShort(endDate));
					
				}
			
				$('.property-instant-quote-message').empty().addClass('hidden');
				$('.property-instant-quote-button').removeClass('hidden');
				
			}
			
		});		
		
		LIVEREZ.Publisher.subscribe('mobiscroll-loaded', function(message){
			
			// ********* mobile datepickers *********
			$('#iq-start-mobile').mobiscroll().calendar({
				theme: 'bootstrap',
				display: 'modal',
				controls: ['calendar'],
				minDate :  new Date(),
				dateFormat: dateFormat,
				closeOnSelect: true,
				onBeforeShow: function(inst){
					inst.setDate( new Date($('#txtStartDate').val()));
					queryUnavailableDates(inst.getDate().getFullYear(), inst);
				},
				onDayChange: function(day, instance){
								
					// keep mobile in sync with desktop
					$('#txtEndDate').datepicker('setDate', day.date);
					$("#txtStartDate").val(LIVEREZ.DynsiteFunctions.DateShort(day.date)); 

					var startDate = day.date;
					
					var newDate = new Date(startDate)
					newDate.setDate(newDate.getDate() + defaultSearchDepartureDays);						
					$('#txtEndDate').datepicker('setDate', newDate);	 	
					
					var endDate = new Date($("#iq-end-mobile").val());

					if(startDate > endDate){
						$('#iq-end-mobile').mobiscroll('setDate', startDate);
						$('#iq-end-mobile').mobiscroll('option', 'minDate', startDate);
						$('#iq-end-mobile').val(LIVEREZ.DynsiteFunctions.DateShort(startDate));
						$('#txtEndDate').datepicker('setDate', startDate);
					}
					
				},
				onMonthChange: function(year, month, inst){
					queryUnavailableDates(year, inst);
				},
				invalid: datepickerAvailability.unavailableDateObjs
			});
			
			$('#iq-end-mobile').mobiscroll().calendar({
				theme: 'bootstrap',
				display: 'modal',
				controls: ['calendar'],
				minDate : new Date(),
				dateFormat: dateFormat,
				closeOnSelect: true,
				onBeforeShow: function(inst){
					inst.setDate( new Date($('#txtEndDate').val()));
					queryUnavailableDates(inst.getDate().getFullYear(), inst);
				},
				onDayChange: function(day, instance){			
					$('#txtEndDate').datepicker('setDate', day.date);
					$("#txtEndDate").val(LIVEREZ.DynsiteFunctions.DateShort(day.date));			
				},
				onMonthChange: function(year, month, inst){			
					queryUnavailableDates(year, inst);			
				},
				invalid: datepickerAvailability.unavailableDateObjs
			});
	
		});
				
		function queryUnavailableDates(year, instance){
			
			var _this = this;
			
			if(datepickerAvailability.queriedYears.indexOf(year) === -1){		
				
				$('.datepicker-days').css({'position' :  'relative'}).append(datepickerOverlay);
				
				// wait for the modal to open
				setTimeout(function(){
					$('.dwcc').css({'position' :  'relative'}).append(datepickerOverlay);
				}, 50);
				
				datepickerAvailability.getCalendarData(
					LIVEREZ.DynsiteFunctions.DateShort(new Date(year, 0, 1)),
					LIVEREZ.DynsiteFunctions.DateShort(new Date(year, 11, 31)),	
					function(){ 
						
						$('#txtStartDate').datepicker('setDatesDisabled', datepickerAvailability.unavailableDateObjs);
						$('#txtEndDate').datepicker('setDatesDisabled', datepickerAvailability.unavailableDateObjs); 								
						
						if(instance){
							instance.refresh();
						}
						
						setTimeout(function(){
							$('.datepicker-overlay').remove();
						}, 200);
						
					});	
					
			} else {
				
				$('.datepicker-overlay').remove();
				
			}
						
		};
		
	});

})(this, lrjQ); 
</script>

					
				</div>

				<div class="row">
	<div class="col-xs-12">
		<!--<ul class="list-inline social-widgets mrg-bottom-0">
			<li><strong>Share:</strong></li>
			<li>
				<a href="#" title="Send to a Friend"><i class="fa fa-envelope-o"></i></a>
			</li>
			
		</ul>-->
	</div>
</div>
	
				
				<div class="row property-side-contact-manager">
					<div class="col-xs-12">
						
						<a href="contact-information.php" class="btn btn-block btn-link">Contact Manager</a>
						
					</div>
				</div>
				
				
	<script src="https://cdn.liverez.com/0/JS/jquery-raty.2.4.5.js"></script>
	<script type="text/javascript">var PAGE_DATA_ID = 116273;</script>
	<!--<script type="text/javascript" src="https://cdn.liverez.com/3/JS/DisplayPropertyRatingsBlock.js"></script>-->


				<div class="secondary-left-content">
					<div class="secondary-left-feature hidden-xs">
	
							<h4>Featured Property</h4>
							<div class="sidebar-feature">
								<a href="villa-details.php?v=<?=$feature[0]['id']?>">
									<img class="img-responsive" src="../booking/<?=$feature[0]['pic']?>" width="250" border="1" style="margin-right:5px;float:left;">
								</a>
								<a href="villa-details.php?v=<?=$feature[0]['id']?>">
								 Villa <?=$feature[0]['no']?> - <?=$feature[0]['bed']?> Bedroom
								</a>
							</div>

						
					</div>


					<div class="secondary-left-reviews hidden-xs">
						
					</div>

					<div class="secondary-left-content hidden-xs">
						<!--<font face="arial, helvetica, sans-serif"><span style="font-size: 14px; line-height: 22.4px;">Rates include normal use of electricity. Upon arrival and departure, a reading of the electricity meter will be done. Excessed use of electricity will be charged extra upon departure. </span></font><br />-->
					&nbsp;
					</div>
				</div>

				
			
			</div>
			
			<div class="col-xs-12 col-sm-8 col-md-9" id="content2Right">
			 <?php
				$full_sized='../for_rent/tor_pics/photos/villa'.$v['no'].'/full/';//DIRECTORIO FULL
				$thumbnail='../for_rent/tor_pics/photos/villa'.$v['no'].'/thumb/';//DIRECTORIO THUMBNAILS
				$fotos = browse_images($thumbnail);
				$fotos_full = browse_images($full_sized);			
				if ($fotos){
					foreach ($fotos as $key => $image){ // Display Images
					?>
						 <li class="span3" style="display:none;"> <a   class="thumbnails" rel="lightbox[group<?=$d['no']?>]" href="<?=$fotos_full[$key]?>"><img width="50" class="group1" src="<?=$image?>" title="<?=$d['no']?>-<?=$image?>" /></a> </li>
						<!--end thumb -->
						<?php
					}
				} ?>
				
				<div id="Photos" class="listing-results-h1heroSlider">
					<!-- Single image on prop page w/ modal interation -->
					
							<div class="carousel-inner">
								<a href="" data-toggle="modal" data-target="#propGalleryModal">
									<img class="img-responsive width-100" src="../booking/<?=$v['pic']?>">
								</a>						
								<!-- Controls -->
								<a class='left carousel-control' href='#propGallery' data-toggle="modal" data-target="#propGalleryModal">
									<span class='fa fa-chevron-left'></span>
								</a>
								<a class='right carousel-control' href='#propGallery' data-toggle="modal" data-target="#propGalleryModal">
									<span class='fa fa-chevron-right'></span>
								</a>
							</div>
							
					<div class="modal property-modal" id="propGalleryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<button type="button" class="close property-modal-close" data-dismiss="modal">✕</button>
						<div id='propGalleryModalGallery' class='carousel' data-ride='carousel' data-interval="false">
							<div class="modal-dialog property-modal-dialog">
								<div class="row">
									<div class="row-same-height row-full-height property-modal-wrapper">
										<div class="col-sm-1 hidden-xs col-xs-height col-middle">
								            <!-- Controls -->
								            <a class='left carousel-control' href='#propGalleryModalGallery' data-slide='prev'>
								                <span class='fa fa-chevron-left'></span>
								            </a>
										</div>
										<div class="col-xs-12 col-sm-10 col-xs-height col-middle">
											<?php $total_fotos=count($fotos)+1; ?>
										        <div class='carousel-outer'>
										            <!-- Wrapper for slides -->
										            <div class='carousel-inner'>
								                    	
													        <div class="item active">
													        	<div class="fill" style="background-image:url('../booking/<?=$v['pic']?>'); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../booking/<?=$v['pic']?>',sizingMethod='scale'); -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../booking/<?=$v['pic']?>',sizingMethod='scale')";"></div>
																<div class="carousel-caption property-page-caption">
																	1/<?=$total_fotos?>: Unique view of the pool
																</div>
													        </div>
													        <!--.item-->
															<?php
															if ($fotos){
																$i=2;
																foreach ($fotos as $key => $image){ // Display Images
																?>
															<div class="item ">
													        	<div class="fill" style="background-image:url('<?=$fotos_full[$key]?>'); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$fotos_full[$key]?>',sizingMethod='scale'); -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$fotos_full[$key]?>',sizingMethod='scale')";"></div>
																<div class="carousel-caption property-page-caption">
																	<?=$i?>/<?=$total_fotos?>: Villa <?=$v['no']?>
																</div>
													        </div>
													        <!--.item-->
															
															<?php
																$i++;
																}
															} ?>
															
										            </div>
										            <!-- Controls -->
										            <a class='left carousel-control visible-xs' href='#propGalleryModalGallery' data-slide='prev'>
										                <span class='fa fa-chevron-left'></span>
										            </a>
										            <a class='right carousel-control visible-xs' href='#propGalleryModalGallery' data-slide='next'>
										                <span class='fa fa-chevron-right'></span>
										            </a>
										        </div>
											    <div class="clearfix"></div>

										</div>
										<div class="col-sm-1 hidden-xs col-xs-height col-middle">
								            <a class='right carousel-control' href='#propGalleryModalGallery' data-slide='next'>
								                <span class='fa fa-chevron-right'></span>
								            </a>
										</div>
									</div>
								</div>
							</div>
							<div class="carousel-caption property-page-caption">
								<div class="row">
									<div class="col-xs-12">
										<div class="new-caption-area"></div>
									</div>
								</div>
							</div>
					        <!-- Indicators -->
					        <ol class='carousel-indicators'>
		                    	
							            <li data-target='#propGalleryModalGallery' data-slide-to='0' class='active'><img src='../booking/<?=$v['pic']?>' alt='Unique view of the pool' /></li>
									<?php
									if ($fotos){
										$i=1;
										foreach ($fotos as $key => $image){ // Display Images
										?>
							            <li data-target='#propGalleryModalGallery' data-slide-to='<?=$i?>' class=''><img src='<?=$image?>' alt='Pool at night' /></li>
									<?php
										$i++;
										}
									} ?>
					        </ol>
					    </div>
					</div>

				</div>
				
				<div class="row">
					<div class="col-xs-12">
						<ul class="list-inline list-flush mrg-bottom-0">
							
									<li class="pad-top-1 pad-left-0 pad-right-50">
										<a href="" class="btn btn-link" data-toggle="modal" data-target="#propGalleryModal">All Photos</a>
									</li>
								
						</ul>
					</div>
				</div>
				
				
				
				<div class="row details-table-wrapper mrg-top-1">
					<div class="col-xs-12">
						<div class="table-responsive">
	<table class="table table-striped table-bordered">
		
		<tr class="property-page-details-item text-center">
			<td class="text-left">Guests</td>
			<td class="text-left"><strong><?=($v['bed']*2);?></strong></td>
		</tr>
	
		<tr class="property-page-details-item text-center">
			<td class="text-left">Bedrooms</td>
			<td class="text-left"><strong><?=$v['bed']?></strong></td>									
		</tr>
	
		<tr class="property-page-details-item text-center">
			<td class="text-left">Bathrooms</td>
			<td class="text-left"><strong>Total: <?=$v['bath']?></strong>
			<span style="font-size:12px;">PRIVATE: <?=$v['priv_f_bath']?> full, <?=$v['priv_h_bath']?> half / SHARED: <?=$v['shared_f_bath']?> full, <?=$v['shared_h_bath']?> half</span>
			</td>									
		</tr>
	
		<tr class="property-page-details-item text-center">
			<td class="text-left">Allows Pets</td>
			<td class="text-left"><strong>No</strong></td>					
		</tr>
	
		<tr class="property-page-details-item text-center">
			<td class="text-left">Pool</td>
			<td class="text-left"><strong>Yes</strong></td>					
		</tr>
	
		<tr class="property-page-details-item text-center">
			<td class="text-left">Property Size</td>
			<td class="text-left"><strong><?=number_format($v['ft2'])?> sq. ft.</strong></td>					
		</tr>
	
	
	</table>
</div>
					</div>
				</div>
				
				
				
				<h2 class="property-page-section-title" id="Description">Description</h2>
<div><?=$v['head']?><br />
<?php 

switch($v['bed']){
	case 2: $kilowatts=25; break;
	case 3: $kilowatts=30; break;
	case 4: $kilowatts=40; break;
	case 5: $kilowatts=50; break;
	case 6: $kilowatts=60; break;
}

?>
<p>&nbsp;</p>
<ul><li>18% tax will be added to all nightly rental rates</li>

<li>Housekeeping is included in the rental rate and will be provided every second day.</li>

<li>Pool and garden care is provided in the rental rate three times per week.</li>

<li>Electricity:  There is a normal rate of electricity used for various sized rental homes, and this amount is included in the rental rate.  A reading of the electricity meter will be done upon check in and check out.  Electricity usage exceeding the following per bedroom price will be charged at the rate of 12.3RD per kW; 
<ul><li>2-bedroom:  25 kW, 3-bedroom:  30 kW, 4-bedroom:  40 kW, 5-bedroom: 50 kW, 6-bedroom:  50 KW</li></ul>
</li>


<li>Cancellation Policy:  Bookings cancelled at least 60-days before the start of a stay get 100% refund. Bookings cancelled at least 30-days before the start of a stay get a 50% refund.  100% of the reservation costs will be charged at time of booking.</li>

<li>Damage deposits of $75/per bedroom must be charged and will be refunded 24-hours after check out if there are no damages or missing items in the villa.  </li>

&nbsp;</div><h2 class="property-page-section-title" id="Amenities">Amenities</h2>
<div>
All our great villas are fully equipped with everything you need for real life.  Just bring your clothes and toothbrush!  In every villa:  safes in at least one bedroom, free high speed WiFi Internet, free shuttle bus service, air conditioning in all bedrooms,  24-hour front desk, complimentary travel planning/excursion booking, cable tv, private yard/pool, optional chef/spa services (fee), tennis, mini-golf (small fee), access to onsite restaurant & mini-market,  and our best service - for every part of your stay.  
</div><h2 class="property-page-section-title" id="Map">Map</h2>				

	<div class="property-map-container">
		<div id="map_canvas" style="width:99%; height:350px"></div>			
	</div>
	
	
		<!-- google maps -->
		
			<!-- api key -->
			<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCcoICy5v6Bv4_NG2SdYRFOt5mWAbHY28o"></script>
				
		<script type="text/javascript">
			$( document ).ready(function(){
				var myLatlng = new google.maps.LatLng( <?=$loc['latitude']?> , <?=$loc['logitude']?>);
				var myOptions = {zoom: 15,center: myLatlng,navigationControl: true,scaleControl: true, scrollwheel: false,mapTypeId: google.maps.MapTypeId.ROADMAP};
				var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				var marker = new google.maps.Marker({position: myLatlng,map: map,title:" <?=$loc['locationName']?>"});
			})
		</script>
	
	
	
	
	
  
	
<!--calendar goes here-->
<?php include('inc/villa_details_calendar.php');?>
<!--rates goes here-->
    <?php include('inc/villa_details_rates.php');?>

<!--reviews goes here-->

<!--similar properties goes here-->
	<?php include('inc/similar_properties.php');?>
			</div>
			<!--content2Right -->
			
		</div>
		<!--row -->
	</div>
	<!--container -->
	
</div>
<!--main-wrapper -->