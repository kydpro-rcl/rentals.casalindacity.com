<?php
	$date_today = date('Y-m-d');
	$end_date=date('m/d/Y', strtotime($date_today. ' + 5 days'));		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?=$_GET['metatitle']?> Residencial Casa Linda Vacation Rentals | Residencial Casa Linda Vacation Homes</title>
	<meta name="robots" content="index,follow">
	<meta name="keywords" content="">
	<meta name="description" content="Take a vacation in our Residencial Casa Linda Vacation Homes. Our Vacation Rentals have amazing accommodations and you will find activities for the entire family.">
	<meta name="author" content="http://kydpro.com">
    <meta name="copyright" content="&copy; <?=date('Y');?> http://kydpro.com" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.css">

	
	<!-- inject:css -->
	<link rel="stylesheet" href="../css/style-1480458422535.min.css">
	<!-- endinject -->

<!-- IE 9 AND BELLOW OVERRIDES GO HERE - FOR IE 10 AND ABOVE, SEE _ie-overrides.less FILE -->
<!--[if IE]>
<style type="text/css">
    .property-modal .carousel-control.left,
    .property-modal .carousel-control.right {
        position: relative;
        z-index: 2000;
    }
</style>
<![endif]-->
	<script type="text/javascript">
	var ADMIN_CUST_DATA_ID = 13260;
	var DYN_SITE_ID = 1376;
	var CDN_BASE_URL = 'https://cdn.liverez.com';
	var RESERVATIONS_BASE_URL = 'https://reservations.liverez.com';
	var RESERVATIONS_PROXY_URL = 'http://proxy.liverez.com/';
	
	var dateFormat = 'mm/dd/yyyy'; 
	
	var dateFormatType = 0;
	var defaultSearchViewType = 'list';
	var defaultSearchDepartureDays = 5;
	var maxWebRentalDays = 30; 
	</script>
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>		
		var lrjQ = $;
	</script>		
	
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<link href="https://netdna.bootstrapcdn.com/respond-proxy.html" id="respond-proxy" rel="respond-proxy">
	<link href="/vendor/respondjs/respond.proxy.gif" id="respond-redirect" rel="respond-redirect">
	<script src="/vendor/respondjs/respond.proxy.js"></script>
	<![endif]-->
	
	
	
	<!-- Google Analytics -->
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88653568-1', 'auto');
  ga('send', 'pageview');

</script>
	<!-- End Google Analytics -->
	
<?php
include('../fb-pixel.php');
?>	
	
</head>
<!--<body class="side-collapse-container Index">-->
<body class="side-collapse-container <?=$_GET['body_info']?>">

<div class="masthead" id="masthead"> 
	<div id="nav-site-wrapper" class="">
		<div class="navbar navbar-inverse">
			<div class="container">
		        <div class="navbar-header">
		        	<!-- menu hamburger -->
		            <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="hamburger is-closed visible-xs" data-toggle="offcanvas">
		                <span class="hamb-top"></span>
		    			<span class="hamb-middle"></span>
						<span class="hamb-bottom"></span>
		            </button>
		        </div>	
				<div class="row">
					<div class="col-xs-6 col-sm-3">
						<a class="navbar-brand" href="../index.php" style="">
							<img src="../images/logo.png" alt="RCL ADMINISTRACIONES, SRL">
						</a>
					</div>
					<div class="col-xs-6 col-sm-9">
						
						<ul class="navbar-top">
							<li class="pull-right phone-wrapper">
								<div class="phone header-item">
									<a class="phone-link hidden-xs" href="tel: +1.809.571.1190">
										<span class="800PhoneHolder">Call us toll-free: 844-830-1611</span>
									</a>
									<a class="phone-link visible-xs" href="tel: +1.849-859-5151">
										<span class="fa fa-phone"></span>
									</a>
								</div>
							</li>
				            
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<nav role="banner" class="navbar navbar-default">
    <div class="container">	
    	<div class="row">
    		<div class="col-xs-12">
				<div class="side-collapse in">				
					<ul class="nav navbar-nav pull-right">
						
						<li><a href="index.php" class="visible-xs">Home</a></li>

						<li class="dropdown">
							<!-- LG SCREEN: Top Level Link -->
							<!--<a href="../rentals/vacation-villas-search.php?b=10&i=<?=date('m/d/Y');?>&t=<?=$end_date?>" class="dropdown-toggle hidden-xs" aria-expanded="false">View Rentals <span class="caret"></span></a>-->
							<a href="../view-rentals.php?b=10" class="dropdown-toggle hidden-xs" aria-expanded="false">View Rentals <span class="caret"></span></a>
							<!-- XS SCREEN: Top Level Link -->
							<a href="view-rentals.php?b=10" class="dropdown-toggle visible-xs" data-toggle="dropdown" role="button" aria-expanded="false">View Rentals <span class="caret"></span></a>
							
							<ul class="dropdown-menu">
									<li>
										<a href="../view-rentals.php?b=10">
											All rentals
										</a>
									</li>
								
									<li>
										<a href="../view-rentals.php?b=2">
											2 bedrooms 
										</a>
									</li>
									
									<li>
										<a href="../view-rentals.php?b=3">
											3 bedrooms 
										</a>
									</li>
									
									<li>
										<a href="../view-rentals.php?b=4">
											4 bedrooms
										</a>
									</li>
									<li>
										<a href="../view-rentals.php?b=5">
											5 bedrooms
										</a>
									</li>
									<li>
										<a href="../view-rentals.php?b=6">
											6 bedrooms 
										</a>
									</li>
									
							</ul>
							
						</li>
						
						<!--<li><a href="packages-specials.php">Specials</a></li>-->
						
						<li class="dropdown">
							<!-- LG SCREEN: Top Level Link -->
							<a href="../local-area-guide.php" class="dropdown-toggle hidden-xs" aria-expanded="false">Local Area Guide <span class="caret"></span></a>
							<!-- XS SCREEN: Top Level Link -->
							<a href="local-area-guide.php" class="dropdown-toggle visible-xs" data-toggle="dropdown" role="button" aria-expanded="false">Local Area Guide <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="../local-area-guide.php">Activities & Attractions</a></li>
								<li><a href="../area-map.php">Area Map</a></li>
								<li><a href="../driving-directions.php">Driving Directions</a></li>
								<li><a href="../weather.php">Weather</a></li>
							</ul>
						</li>
						
						<li class="dropdown">
							<!-- LG SCREEN: Top Level Link -->
							<a href="../property-management-services.php" class="dropdown-toggle hidden-xs" aria-expanded="false">About Us <span class="caret"></span></a>
							<!-- XS SCREEN: Top Level Link -->
							<a href="../property-management-services.php" class="dropdown-toggle visible-xs" data-toggle="dropdown" role="button" aria-expanded="false">About Us <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<!--<li><a href="contact-information.php">Contact / Company Information</a></li>-->
								<li><a href="../faq.php">Frequently Asked Questions</a></li>
								<li><a href="../privacy-policy.php">Privacy Policy</a></li>
								<li><a href="../terms-conditions.php">Terms and Conditions</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<!-- LG SCREEN: Top Level Link -->
							<a href="../concierge-services.php" class="dropdown-toggle hidden-xs" aria-expanded="false">Guest Services <span class="caret"></span></a>
							<!-- XS SCREEN: Top Level Link -->
							<a href="../concierge-services.php" class="dropdown-toggle visible-xs" data-toggle="dropdown" role="button" aria-expanded="false">Guest Services <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<!--<li><a href="villa-services.php">Villa Services</a></li>-->
								<li><a href="../transportation.php">Transportation</a></li>
							</ul>
						</li>
						<li><a href="../contact-information.php">Contact</a></li>
						<!--<li><a href="#" target="_blank">Owners</a></li>-->
						
					</ul>					
				</div>
    		</div>
    	</div>
    </div>
</nav>
<div class="overlay"></div>
<!-- /#sidebar-wrapper -->
<script>
$(document).ready(function() {   
    var sideslider = $('[data-toggle=collapse-side]');
    var sel = sideslider.attr('data-target');
    var sel2 = sideslider.attr('data-target-2');
    sideslider.click(function(event){
        $(sel).toggleClass('in');
        $(sel2).toggleClass('out');
    });
});
$(document).ready(function(){
	$(document).ready(function () {
	  var trigger = $('.hamburger'),
	      overlay = $('.overlay'),
	     isClosed = false;

	    trigger.click(function () {
	      hamburger_cross();      
	    });

	    function hamburger_cross() {

	      if (isClosed == true) {          
	        overlay.hide();
	        trigger.removeClass('is-open');
	        trigger.addClass('is-closed');
	        isClosed = false;
	      } else {   
	        overlay.show();
	        trigger.removeClass('is-closed');
	        trigger.addClass('is-open');
	        isClosed = true;
	      }
	  }  
	});
});
$(document).ready(function(){
	$('.dropdown').on('show.bs.dropdown', function () {
	    $(this).siblings('.open').removeClass('open').find('a.dropdown-toggle').attr('data-toggle', 'dropdown');
	    $(this).find('a.dropdown-toggle').removeAttr('data-toggle');
	});
});
</script>
</div> 