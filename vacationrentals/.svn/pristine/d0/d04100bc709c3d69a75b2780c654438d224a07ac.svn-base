	<?php
		$date_today = date('Y-m-d');
		$end_date=date('m/d/Y', strtotime($date_today. ' + 5 days'));
	?>

	<form action="vacation-villas-search.php" method="post" name="FormX">
				<div class="secondary-search-main">
					
					<input type="hidden" name="Complete" value="Yes">
					<input type="hidden" name="Searchform" class="search-form" value="1">
					
					
					
					<input type="hidden" name="pagedataid" value="0">
					
					
						<input type="hidden" name="communityid" value="0">
					
					
					
					<!-- mobile dates -->
					<div id="s-dates-mobile" class="row visible-xs">
						<div id="s-arrival-mobile" class="col-xs-12">
							<div class="form-group">
								<label for="txtStartDate-mobile">Arriving</label>
								<div class="left-inner-addon">
									<i class="fa fa-calendar-o"></i>
									<input type="text" class="form-control input-sm mobile-datepicker start-date" value="<?=date('m/d/Y');?>" id="txtStartDate-mobile" name="txtStartDate-mobile" readonly>
								</div>
							</div>
						</div>
						<div id="s-departure-mobile" class="col-xs-12">
							<div class="form-group">
								<label for="txtEndDate-mobile">Departing</label>
								<div class="left-inner-addon">
									<i class="fa fa-calendar-o"></i>
									<input type="text" class="form-control input-sm mobile-datepicker end-date" value="<?=$end_date;?>" id="txtEndDate-mobile" name="txtEndDate-mobile" readonly>
								</div>
							</div>
						</div>
					</div>
					
					<!-- desktop dates -->
					<div id="s-dates" class="row hidden-xs input-daterange datepicker-range secondary-search-dates">
						<div id="s-arrival" class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="txtStartDate">Arriving</label>
								<div class="left-inner-addon">
									<i class="fa fa-calendar-o"></i>
									<input type="text" class="form-control input-sm start-date" value="<?=date('m/d/Y');?>" id="txtStartDate" name="fecha_ini" readonly>
								</div>
							</div>
						</div>
						<div id="s-departure" class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="txtEndDate">Departing</label>
								<div class="left-inner-addon">
									<i class="fa fa-calendar-o"></i>
									<input type="text" class="form-control input-sm end-date" value="<?=$end_date;?>" id="txtEndDate" name="fecha_ter" readonly>
								</div>
							</div>
						</div>
					</div>
					
					<div id="s-submit">
						
						<button type="submit" class="btn btn-primary btn-block">Check Availability</button>
						
					</div>
				
				</div>
			
				
					
				<div id="secondary-bedrooms-sleeps" class="row" style="margin-bottom: 5px;">		
					<div class="col-xs-6" id="secondary-bedrooms">
						<div class="input-group">
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
								
					<div class="col-xs-6" id="secondary-guests">
						<div class="input-group">
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
						
				
				<div id="secondary-location" class="search-margin-bottom ">
					<div class="form-group">
						<label for="LocationDataID">Bedrooms</label>
							<select name="beds" class="form-control input-sm search-item" id="Bedrooms">
								<!--<option value="10" selected >All</option>-->
											<option value="1" <? if($_GET['b']=='1'){ echo 'selected="selected"'; }?> >
												1 Bedroom
											</option>
											<option value="2" <? if($_GET['b']=='2'){ echo 'selected="selected"'; }?> <? if($_GET['b']==''){ echo 'selected="selected"'; }?>>
												2 Bedrooms
											</option>
											<option value="3" <? if($_GET['b']=='3'){ echo 'selected="selected"'; }?> >
												3 Bedrooms
											</option>
											<option value="4"  <? if($_GET['b']=='4'){ echo 'selected="selected"'; }?> >
												4 Bedrooms
											</option>
											<option value="5" <? if($_GET['b']=='5'){ echo 'selected="selected"'; }?> >
												5 Bedrooms
											</option>
											<option value="6" <? if($_GET['b']=='6'){ echo 'selected="selected"'; }?> >
												6 Bedrooms
											</option>
							</select>
					</div>
				</div>
				
			
			</form>