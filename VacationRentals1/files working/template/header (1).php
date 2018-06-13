<?php if($_GET['back']==1){ $var_base='../';}?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- TITLE OF SITE -->
    <title>Vacation Villas Booking Page - Residencial Casa Linda</title>

    <meta name="description" content="Residencial Casa Linda - Vacation Villas" />
    <meta name="keywords" content="hotel, resort, booking, responsive,landing, spa" />
    <meta name="author" content="Crenoveative">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- =========================
      FAV AND TOUCH ICONS  
    ============================== -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$var_base?>images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$var_base?>images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$var_base?>images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?=$var_base?>images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="images/ico/favicon.png">
	
	<!-- BOOTSTRAP GALLERY -->
        <link rel="stylesheet" href="bootstrap-gallery/css/main.css">
        <script src="bootstrap-gallery/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- =========================
       STYLESHEETS 
	   
    ============================== -->
	<link rel="stylesheet" href="css/style.css">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="<?=$var_base?>bootstrap/css/bootstrap.min.css">
    <!-- FONT ICONS -->
    <link rel="stylesheet" href="<?=$var_base?>icons/font-awesome/css/font-awesome.min.css">
    <!-- CAROUSEL SLIDERS -->
    <link rel="stylesheet" href="<?=$var_base?>css/flexslider.css" media="screen" />  
    <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:700,400,300,300italic' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script src="js/respond.min.js"></script>
    <![endif]-->
    <!-- CSS3 ANIMATION -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- MAIN CSS -->
	<!--<link rel="stylesheet" href="css/style.css">-->
	<link href="css/datepicker.css" rel="stylesheet">
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-10039710-2', 'auto');
	  ga('send', 'pageview');

	</script>
	
	<style type="text/css">
		.rcorners2 {
			border-radius: 25px;
			border: 2px solid #428bca;
			padding: 10px; 
			margin-bottom:15px;
		}
		.fuente_parrafo{
			font-size: 19px;
		}
		.promotion{
			margin-top:3px;margin-bottom:20px;
		}
		.bedrooms{
			margin-top:30px;margin-bottom:20px;
		}
		.sales{
			margin-top:41px;margin-bottom:20px;text-align:right;
		}
	</style>
</head>
<body>
<div id="qLoverlay"></div>
<? if(!$_POST){?>
<!-- =========================
     HEADER AREA
============================== -->
<header id="header">
	<div class="logo">
		<img src="images/logo.png" alt="Logo" />
	</div>
</header>
 <!-- /END HEADER AREA -->

 <!-- =========================
  BIG BANNER SLIDER
============================== -->
<section class="big-banner-wrapper">
	<div id="main-slider" class="flex-set-height">
		<div id="mainFlexSlider" class="flexslider flexslider-clear">
			<ul class="slides">
				<li class="slide">
					<div class="flexslider-image-bg" style="background: url(<?=$var_base?>images/slider/flexslider5.jpg) center top no-repeat;"></div>
					<div class="flex-overlay"></div>
					<div class="flex-caption center">
						<h1 class="animation fromBottom transitionDelay2 transitionDuration6">Enjoy the Caribbean</h1><br>
						<p class="animation fromBottom transitionDelay4 transitionDuration10">With no buffet lines and total privacy<br> in your own rental villa<br></p>
						
					</div>
				</li><!-- slide5 end -->
				<li class="slide">
					<div class="flexslider-image-bg" style="background: url(<?=$var_base?>images/slider/flexslider2.jpg) center top no-repeat;"></div>
					<div class="flex-overlay"></div>
					<div class="flex-caption center">
						<h1 class="animation fromBottom transitionDelay2 transitionDuration6">Endless Activities</h1><br>
						<p class="animation fromBottom transitionDelay4 transitionDuration10">Ask for our help with booking excursions and world class surfing!</p><br>
						<!--<a href="#excursions" class="btn animation fromBottom transitionDelay6 transitionDuration10">Discover Now!</a>-->
					</div>
				</li><!-- slide1 end -->

				<li class="slide">
					<div class="flexslider-image-bg" style="background: url(<?=$var_base?>images/slider/flexslider3.jpg) center top no-repeat;"></div>
					<div class="flex-overlay"></div>
					<div class="flex-caption center">
						<h1 class="animation fromBottom transitionDelay2 transitionDuration6">24 hour gated security!</h1><br>
						<p class="animation fromBottom transitionDelay4 transitionDuration10">We offer a safe and well managed sub division with full services</p><br>
						
					</div>
				</li><!-- slide2 end -->

				<li class="slide">
					<div class="flexslider-image-bg" style="background: url(<?=$var_base?>images/slider/flexslider1.jpg) center top no-repeat;"></div>
					<div class="flex-overlay"></div>
					<div class="flex-caption center">
						<h1 class="animation fromBottom transitionDelay2 transitionDuration6">Located close to Sosua Beach!</h1><br>
						<p class="animation fromBottom transitionDelay4 transitionDuration10">Enjoy one of the most beautiful beaches in Dominican Republic with a great variety of bars and restaurants.</p><br>
						
					</div>
				</li><!-- slide3 end -->
				
				<li class="slide">
					<div class="flexslider-image-bg" style="background: url(<?=$var_base?>images/slider/flexslider4.jpg) center top no-repeat;"></div>
					<div class="flex-overlay"></div>
					<div class="flex-caption center">
						<h1 class="animation fromBottom transitionDelay2 transitionDuration6">Dont miss out on the golfing!</h1><br>
						<p class="animation fromBottom transitionDelay4 transitionDuration10">Dominican Republic offers great world class golfing excursions</p><br>
						
					</div>
				</li><!-- slide4 end -->
				
			</ul><!-- slides end -->
		</div><!-- flexslider end -->
	</div>
</section>
<!-- /END BIG BANNER SLIDER  -->

<!-- =========================
  FIND ROOM FORM
============================== -->
	<? }?>
<div id="find-room-form-wrapper" class="light-bg">
	<div class="container">
	<? if(!$_POST){?>
		<div class="inner">
<input type="hidden" name="referral" value="">
		  <input type="hidden" name="villa" value="">
<input type="hidden" name="show" value="1">
		  <!--<input type="hidden" name="promotion_code" value="">-->

			<form class="row" name="bookform" id="bookform" method="post" action="vacation-rentals-search.php#content_starts">
			
				<div class="col-xs-12 col-sm-12 col-md-10">
					<div class="row">
						
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group form-icon">
								<input type="text" class="form-control" name="fecha_ini" class="span2" value="" id="dpd1" placeholder="Check in" required ><!--<i class="fa fa-calendar" ></i>-->
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group form-icon">
								<input type="text" class="form-control" name="fecha_ter" class="span2" value="" id="dpd2" placeholder="Check out" required ><!--<i class="fa fa-calendar" ></i>-->
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="col-xs-12 col-sm-4 col-md-2">
					<?php if($_GET['villa']!=''){
						$_SESSION['uniqueVilla']=$_GET['villa'];
						?>
					<input type="hidden" name="villa"  value="<?=$_GET['villa']?>"  class="form-control" >
					<?php } ?>
					<button class="btn btn-primary btn-block caps">Search</button>
				</div>
				
				<div class="clear"></div>
				
			</form>
		</div>
	<? }?>
		 <a id="content_starts"></a>
		<div class="row">
				<div class="col-md-12">
					<!---MENU OPTIONS-->
					<nav class="navbar navbar-default">
					  <div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						  <a class="navbar-brand" href="vacation-rentals.php">Home</a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						  <ul class="nav navbar-nav">
							<li ><a  href="http://rentals.casalindacity.com/rentals/index.php#amenities">Amenities <!--<span class="sr-only">(current)</span>--></a></li>
							<li><a  href="http://rentals.casalindacity.com/rentals/index.php#excursions">Excursions</a></li>
							<li><a  href="http://rentals.casalindacity.com/rentals/index.php#services">Services</a></li>
							<li><a  href="http://rentals.casalindacity.com/rentals/index.php#directions">Directions</a></li>
							<li><a target="_blank" href="maps.php">Maps</a></li>
							<li><a target="_blank" href="http://casalindadr.com/realestatedr/">Sales</a></li>
							
						  </ul>
						</div><!-- /.navbar-collapse -->
					  </div><!-- /.container-fluid -->
					</nav>
					<!-- /END MENU  -->
				</div>
		</div>
	</div>
</div>
<!-- /END FIND ROOM FORM  -->
