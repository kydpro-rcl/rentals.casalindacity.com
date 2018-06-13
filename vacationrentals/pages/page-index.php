<div class="search-wrap">		
        
<div class="container-fluid">
	<div class="row searchbox-slideshow">
		<div class="col-xs-12 pad-0">
			<div id="full-width-slider" class="listing-results-h1heroSlider">
				<!-- Half Page Image Background Carousel Header -->
				<div id="halfPage" class="carousel slide">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#halfPage" data-slide-to="0" class="active"></li>
						<li data-target="#halfPage" data-slide-to="1"></li>
						<li data-target="#halfPage" data-slide-to="2"></li>
						<li data-target="#halfPage" data-slide-to="3"></li>
						<li data-target="#halfPage" data-slide-to="4"></li>
					</ol>
					<!-- Wrapper for Slides -->
					<div class="caption-title-container visible-lg visible-md">
	<div class="col-xs-12">
		<h2 class="caption-title text-center"></h2>
		<h3 class="caption-subtitle text-center"></h3>
	</div>
</div>
					<div class="carousel-inner">
						<div class="item active">
							<div class="fill" style="background-image:url('custimages/slide1.jpg');"></div>
						</div>
						<div class="item">
							<div class="fill" style="background-image:url('custimages/slide2.jpg');"></div>
						</div>
						<div class="item">
							<div class="fill" style="background-image:url('custimages/slide3.jpg');"></div>
						</div>
						<div class="item">
							<div class="fill" style="background-image:url('custimages/slide4.jpg');"></div>
						</div>
						<div class="item">
							<div class="fill" style="background-image:url('custimages/slide5.jpg');"></div>
						</div>
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#halfPage" data-slide="prev">
						<span class="icon-prev"></span>
					</a>
					<a class="right carousel-control" href="#halfPage" data-slide="next">
						<span class="icon-next"></span>
					</a>
				</div>
				<!-- /.carousel -->
			</div>
			<!-- /#full-width-slider -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row.search-slideshow -->
</div>
<!-- /.container-fluid -->

<script>
$( document ).ready(function(){
	$('.carousel').carousel({
		//interval: 5000 //changes the speed
	})
});
</script>

<div class="search-bar-wrap">
	<div class="container search-bar-container">
		<div class="row">
			<div class="col-xs-12 search-bar-col">
				<div class="index-search">
					<div id="s-container">
						<div id="s-Availabilty" class="row">
							<form action="vacation-villas-search.php" method="post" name="FormX">
								<input type="hidden" name="Complete" value="Yes">
								<input type="hidden" name="Searchform" value="1">
								
								
								<div class="col-sm-12 locations-title-col search-bar-title">
									<h6 class="locations-title">Locations:</h6>
								</div>									
								<div class="col-sm-12 col-md-4 faux-row locations-col">
									<div id="s-locations" class="search-margin-bottom">
										<select name="LocationDataID" id="s-locations-select" class="form-control input-md">
											<option value="0">All Locations</option>
													<option value="7867">Sosua - Cabarete</option>
										</select>
									</div> 
									<!-- /#s-locations --> 
								</div>
								<!-- /.col -->									
								<?php
								$date_today = date('Y-m-d');
								$end_date=date('m/d/Y', strtotime($date_today. ' + 5 days'));
								?>
								
								<div class="col-sm-12 col-md-4 visible-xs faux-row">
									<div id="s-dates-mobile" class="row mrg-0">
										<div id="s-arrival" class="col-xs-6 visible-xs pad-0 s-date-mobile arrival-mobile-col" >
											<div class="form-group">
												<label for="txtStartDate-mobile" class="sr-only">Arriving:</label>
												<div class="left-inner-addon">
													<i class="fa fa-calendar-o"></i>
													<input type="text" class="form-control input-md mobile-datepicker" value="<?=date('m/d/Y');?>" id="txtStartDate-mobile" name="txtStartDate-mobile" readonly>
												</div>
											</div>
										</div>
										<!-- /#s-arrival -->
										<div id="s-departure" class="col-xs-6 visible-xs pad-0 s-date-mobile departure-mobile-col">
											<div class="form-group">
												<label for="txtEndDate-mobile" class="sr-only">Departing:</label>
												<div class="left-inner-addon">
													<i class="fa fa-calendar-o"></i>
													<input type="text" class="form-control input-md mobile-datepicker" value="<?=$end_date;?>" id="txtEndDate-mobile" name="txtEndDate-mobile" readonly>
												</div>
											</div>
										</div>
										<!-- /#s-departure -->
									</div>
								</div>
								<!-- s-dates-mobile -->

								<div id="s-dates" class="hidden-xs input-daterange datepicker-range">
									<div id="s-arrival" class="col-xs-3 col-md-2 arrival-col">
										<div class="arrival-title-col search-bar-title">
											<h6 class="arrival-title">Arriving:</h6>
										</div>
										<div class="form-group">
											<!-- <label for="txtStartDate">Arriving:</label> -->
											<div class="left-inner-addon">
												<i class="fa fa-calendar-o"></i>
												<input type="text" class="form-control input-md" value="<?=date('m/d/Y');?>" id="txtStartDate" name="fecha_ini" readonly>
											</div>
										</div>
									</div>
									<!-- /#s-arrival -->
									<div id="s-departure" class="col-xs-3 col-md-2 departure-col">
										<div class="departure-title-col search-bar-title">
											<h6 class="departure-title">Departing:</h6>
										</div>
										<div class="form-group">
											<!-- <label for="txtEndDate">Departing:</label> -->
											<div class="left-inner-addon">
												<i class="fa fa-calendar-o"></i>
												<input type="text" class="form-control input-md" value="<?=$end_date;?>" id="txtEndDate" name="fecha_ter" readonly>
											</div>
										</div>
									</div>
									<!-- /#s-departure -->
								</div>
								<!-- s-dates -->
								
								
								
								<div class="col-xs-12  col-sm-3 col-md-2 faux-row bedrooms-col" id="s-bedrooms">
									<div class="bedrooms-title-col search-bar-title">
										<h6 class="bedrooms-title">Bedrooms:</h6>
									</div>
									<select name="AmenBedrooms" id="AmenBedrooms" class="form-control input-md">
										<!--<option value="10">All Bedrooms</option>-->
													<option value="1">1 Bedroom</option>
													<option value="2" selected="selected">2 Bedrooms</option>
												
													<option value="3">3 Bedrooms</option>
												
													<option value="4">4 Bedrooms</option>
												
													<option value="5">5 Bedrooms</option>
												
													<option value="6">6 Bedrooms</option>
												
									</select>
								</div>
								
								<div class="col-xs-12 col-sm-3 col-md-2 faux-row guests-col">
									<div class="guests-title-col search-bar-title">
										<h6 class="guests-title">Bedrooms:</h6>
									</div>
									<select name="beds" id="MaxPersons" class="form-control input-md">
													<!--<option value="10">All Bedrooms</option>-->
													<option value="1">1 Bedroom</option>
													<option value="2" selected="selected">2 Bedrooms</option>
													<option value="3">3 Bedrooms</option>
													<option value="4">4 Bedrooms</option>
													<option value="5">5 Bedrooms</option>
													<option value="6">6 Bedrooms</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-2 faux-row guests-col">
										<select name="adults" class="form-control input-md" id="Bedrooms2">
												<?php
												for ($i=1; $i<=12; $i++){?>
														<option value="<?=$i?>"  >
															<?=$i?> adults
														</option>
												<?php
												}
												?>
										</select>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-1 faux-row guests-col">
									
										<select name="kids" class="form-control input-md" id="Guests2">
											<option value="0">Select</option>
														<?php
												for ($i=1; $i<=15; $i++){?>
														<option value="<?=$i?>"  >
															<?=$i?> kids
														</option>
												<?php
												}
												?>
										</select>
									
								</div>
								<div class="col-xs-12 col-sm-3 col-md-1 faux-row guests-col">
										<input type="text" name="promo" class="form-control input-md" id="prom" placeholder="code">
								</div>
								
								<div class="col-xs-12 col-sm-3 col-md-2 faux-row submit-col">
									<div id="s-submit">
										<button type="submit" class="btn btn-primary btn-block">Check Availability</button>
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div> 
		
	<script type="text/javascript">
		function showResult(str)
		{
		if (str.length==0)
		  {
		  document.getElementById("livesearch").innerHTML="";
		  document.getElementById("livesearch").style.border="0px";
		  return;
		  }
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
			document.getElementById("livesearch").style.border="1px solid #A5ACB2";
			}
		  }
		xmlhttp.open("GET","livesearch.php?q="+str,true);
		xmlhttp.send();
		}
	</script>
	
        <div class="row">
         <div class="col-xs-12 col-md-4 col-md-offset-3">
            <a href="#" id="popoverExampleTwo" data-placement="bottom" class="select-home-dropdown text-center">Looking for a specific villa? <span class="caret"></span></a>
          </div>
        </div>
        <script type="text/javascript">
        $(function(){

            // Enabling Popover Example 2 - JS (hidden content and title capturing)
            $("#popoverExampleTwo").popover({
                html : true, 
                content: function() {
                  return $('#popoverExampleTwoHiddenContent').html();
                },
            });

        });
        </script>
        <!-- Popover 2 hidden content -->
        <div id="popoverExampleTwoHiddenContent" style="display: none">
        	<h2>Search Rentals</h2> 
	
<input class="lr-typeahead form-control input-sm" type="text" onkeyup="showResult(this.value)" placeholder="Search by Property Number">
<div id="livesearch"></div>	
<script>
/*$( document).ready(function(){

	var myOptions = {
		timeoutLength: 600,
		dataSource: function(callback, query){

			$.ajax({
				type: 'GET',
				url: '/api/search-villas.php',
				data: {
					AdminCustDataID: 13260,
					DynSiteID: 1376,
					q: encodeURIComponent(query)
				},
				dataType: "json",
				success: function (data) {
					callback(null, data);
				},
				error: function (data, status, error) {
					console({
						"data": data,
						"status": status,
						"error": error
					}); 
					callback(null, []);
				}
			});
			
		},
		onNewData: function(data, element){

			if(data.length){
				var retHtml = '';
				for(var i = 0; i < data.length; i++){
					retHtml += '<div><a href="javascript: LIVEREZ.DynsiteFunctions.goPropertyByID('+ data[i].pageDataID +')">' + data[i].pid + '</a></div>';
				}
				return retHtml;
			} else {
				return '<div><a href="vacation-rentals-homes.asp">No Results</a></div>';
			}
		
			

		}
	};

	$('.lr-typeahead').lrtypeahead(myOptions);

});*/
</script>



        </div> 
	</div>
</div> <!-- search-bar-wrap -->
		 
    </div>

	
<div class="index-features-section">
	<div class="container">
		
		<div class="row-same-height row-full-height index-features-wrapper">
			
			
			<div class="col-sm-1 hidden-xs col-xs-height col-middle">
				<div class="index-features-control prev">
					<a class="left carousel-control" href="#indexFeatures" data-slide="prev">
						<span class="fa fa-chevron-left"></span>
					</a>
				</div>
			</div>
						
			<?php
			$db= new getQueries();
			$features_index=$db->villas_8_ramdom_online();
			/*echo "</pre>";
			print_r($features_index);
			echo "<pre>";*/
			?>
			<div class="col-xs-12 col-sm-10 col-xs-height col-middle">
				<div id="indexFeatures" class="carousel slide index-features-carousel" data-interval="false">									
					<div class="carousel-inner index-features-carousel-inner">
						
							
							<div class="item index-features-item active">
								<div class="row">	
								<!-- open row -->
									<?php for($i=0; $i<4; $i++){ 
										$k[$i]=$features_index[$i];
									?>
									<div class="col-xs-6 col-sm-3">
										<a href="villa-details.php?v=<?=$k[$i]['id']?>" target="_blank" class="index-features-img-wrapper">
											<div class="index-features-img" style="background-image: url('../booking/<?=$k[$i]['pic']?>'); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../booking/<?=$k[$i]['pic']?>',sizingMethod='scale'); -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../booking/<?=$k[$i]['pic']?>',sizingMethod='scale')";" title="<?=$k[$i]['bed']?> Bedroom Villa"></div>
										</a>
										<div class="index-features-title">
											<a href="villa-details.php?v=<?=$k[$i]['id']?>" target="_blank">Villa-<?=$k[$i]['no']?> ( <?=$k[$i]['bed']?> Bedrooms )</a>
										</div>
									</div>											
									<?}?>
									
								</div>
							</div>
							
							<div class="item index-features-item ">
								<div class="row">	
								
									
									<?php for($i=4; $i<8; $i++){ 
										$k[$i]=$features_index[$i];
									?>
									<div class="col-xs-6 col-sm-3">
										<a href="villa-details.php?v=<?=$k[$i]['id']?>" target="_blank" class="index-features-img-wrapper">
											<div class="index-features-img" style="background-image: url('../booking/<?=$k[$i]['pic']?>'); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../booking/<?=$k[$i]['pic']?>',sizingMethod='scale'); -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../booking/<?=$k[$i]['pic']?>',sizingMethod='scale')";" title="<?=$k[$i]['bed']?> Bedroom Villa"></div>
										</a>
										<div class="index-features-title">
											<a href="villa-details.php?v=<?=$k[$i]['id']?>" target="_blank">Villa-<?=$k[$i]['no']?> ( <?=$k[$i]['bed']?> Bedrooms )</a>
										</div>
									</div>											
									<?}?>																			
								</div>
							</div>
							
							<!--<div class="item index-features-item ">
								<div class="row">	
								
									
									<div class="col-xs-6 col-sm-3">
										<a href="#" class="index-features-img-wrapper">
											<div class="index-features-img" style="background-image: url('images/features/9.jpg'); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/features/9.jpg',sizingMethod='scale'); -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/features/9.jpg',sizingMethod='scale')";" title="3 Bedroom Villa"></div>
										</a>
										<div class="index-features-title">
											<a href="#">Villa-626B ( 3 Bedrooms )</a>
										</div>
									</div>											
									
								</div>
							</div>-->
							
							
					</div><!--.carousel-inner-->
		            <!-- Controls -->
		            
			            <a class='left carousel-control visible-xs' href='#indexFeatures' data-slide='prev'>
			                <span class='fa fa-chevron-left'></span>
			            </a>
			            <a class='right carousel-control visible-xs' href='#indexFeatures' data-slide='next'>
			                <span class='fa fa-chevron-right'></span>
			            </a>
					
				</div>
			</div>
			
			
			<div class="col-sm-1 hidden-xs col-xs-height col-middle">
				<div class="index-features-control next">
					<a class="right carousel-control" href="#indexFeatures" data-slide="next">
						<span class="fa fa-chevron-right"></span>
					</a>
				</div>
			</div>
			
			
		</div>
		
	</div>
</div>


	
	<div class="index-content">
		
        <div class="container">
            <div class="row">
            	
                <div class="col-xs-12 col-sm-4 col-md-3">
				
					
	<script src="https://cdn.liverez.com/0/JS/jquery-raty.2.4.5.js"></script>
	<!--<script type="text/javascript" src="https://cdn.liverez.com/3/JS/DisplayPropertyManagerRatingsBlock.js"></script>-->


<div class="index-left-content">
	<!---left content start--->
<h1 style="color:#e9656d; font-weight:bold;">WHAT TO EXPECT?</h1>

<p><span style="color:#e9656d; font-weight:bold;">A short drive from the airport:</span> Casa Linda is only 15 minutes from the Puerto Plata airport; airport transportation is available and we can arrive to pick you up</p>

<p><span style="color:#e9656d; font-weight:bold;">No need to rent a car:</span> Casa Linda offers all day Shuttle Bus Service to Sosua and Cabarete</p>

<p><span style="color:#e9656d; font-weight:bold;">Fully Equipped Homes: </span> Bring only your clothes and toothbrush &ndash; our villas are equipped with everything else you need for a great vacation:</p>

<p><span style="color:#40c0c4; ">Kitchen:</span> fridge, stove, microwave as well as other small appliances like coffee maker, blender, etc. BBQ&#39;s in each villa. Many villas also have outdoor entertaining area</p>

<p><span style="color:#40c0c4; ">Private Pools and Yards:</span> Every villa is a tropical oasis and is completely private from all neighbors</p>

<p><span style="color:#40c0c4; ">Queen and King Size Beds: </span> All villas have comfortable beds and large bedrooms with TV&#39;s, A/C split units, and ceiling fans</p>

<p><span style="color:#40c0c4; ">Covered Outdoor Terrace:</span> It&#39;s the DR! We live life outside, either by the pool or under a lovely outdoor patio.</p>

<p><span style="color:#e9656d; font-weight:bold;">Onsite Services and Amenities:</span></p>
<!--<p><span style="color:#40c0c4; "><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> Restaurant and small pub, in villa chef service</span></p>-->

<p><span style="color:#40c0c4; ">24-hour onsite office</span></p>

<p><span style="color:#40c0c4; ">Assistance with excursions and tours</span></p>

<p><span style="color:#40c0c4; ">Laundry Services</span></p>

<p><img alt="" src="images/Print_Logo_COE2016_en.png" width="150px" /></p>
</div>
					
                </div>
                
                <div class="col-xs-12 col-sm-8 col-md-9 index-content"> 
					
					<h1 style="color:#40c0c4;font-weight:bold;">WHAT MAKES CASA LINDA A BETTER VACATION?</h1>

<p>&nbsp;</p>

<h1 style="text-align: justify;margin-top:-7px;"><span style="font-size:18px;">
<img alt="" class="img-responsive" src="images/info_graphic_rental.png" /></span></h1>

<h1 style="color:#96ca56;">Never stand in another crowded buffet line again or wait for another pool lounger!</h1>

<p>You&#39;ve landed in the right place. Casa Linda vacation villas are the perfect blend of the comforts of home, mixed with the onsite services of a high end resort, together with a fully equipped, secluded Caribbean villa with private pool! Enjoy your vacation your way: in a private home that is close to beaches and is only for you!</p>

<h1 style="color:#e9656d;">PERSONAL SERVICE MATTERS:</h1>

<p>We are here to make your vacation incredible. Our onsite staff are second to none. We will assist with travel, services, excursions, groceries, taxi&rsquo;s, shuttle bus, area information and more. We are here to make your vacation a once in a lifetime experience.</p>

<h1 style="color:#40c0c4;">WHAT IS THERE TO DO?</h1>

<p>Spend your days lazing by your pool or soaking up rays at one of several local beaches. Maybe you&#39;d like to try your hand at kite boarding or windsurfing on Cabarete Beach? Adventurous? How about a trip down a zipline at Monkey Jungle with the only 4,500-foot ACCT certified zipline&nbsp;with seven stations and a free fall descender.&nbsp;Kids will love discovering Ocean World Adventure Park where they can swim with dolphins and enjoy marine shows. No matter what your tastes, there is an excursion for you. <a href="local-area-guide.php" target="_self">Click here for more information</a>.</p>

<p>End your days with a&nbsp;night on the town in Cabarete, enjoying&nbsp;one of Sosua&#39;s incredible restaurants, or cooking your own dinner in your private kitchen. We can even provide a chef!</p>

<p>There is nothing like vacationing in your own, private villa just steps to your own&nbsp;pool. Watch the sunset with a&nbsp;glass of wine from your back terrace&hellip;</p>
					
                </div>
                
            
			</div>
			<!--row -->
		</div>
		<!--container -->
		
	</div>
	<!--index-content -->