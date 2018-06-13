<? if ($_SESSION['owner']['id']=='') $_SESSION['owner']=$_SESSION['owner'][0]; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html class="jsEnabled" lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Owners Portal - Residencial Casa Linda</title>
 <!--no flollow content-->
    <meta name="robots" content="none" />

	<meta name="robots" content="noindex, nofollow, noarchive" />
    <meta name="gooblebot" content="noindex, nofollow, noarchive" />
    <meta http-equiv="cache-control" content="no-cache" />
    <!--no flollow content-->
    <meta name="author" content="ing.joseluis@msn.com" />
<meta http-equiv="X-UA-Compatible" content="IE=8">

<!--//FANCY BOX CODE//-->
  <script type="text/javascript" src="../fancybox/jquery.min.js"></script>
	<script>
		!window.jQuery && document.write('<script src="../fancybox/jquery-1.4.3.min.js"><\/script>');
	</script>
	<script type="text/javascript" src="../fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="../fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="../fancybox/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	<link rel="stylesheet" href="../fancybox/style.css" />
<!--//FANCY BOX CODE//-->

<link media="screen" rel="stylesheet" type="text/css" href="css/xptdev.css">
<link media="screen" rel="stylesheet" type="text/css" href="css/global.css">
<link media="screen" rel="stylesheet" type="text/css" href="css/p2p.css">

<link rel="stylesheet" type="text/css" href="css/sandbox.css">
<link media="print" rel="stylesheet" type="text/css" href="css/print.css">
	<? if ($_GET['login']=="RCL"){?>
        <style>
         body {
            background-image: url(images/opbg.jpg);
			background-position:center top;
			background-repeat:no-repeat;
			border-left: 0;
    		border-right: 0;
        }
        </style>
    <?}?>
</head>
<body class="xptSandbox"><iframe style="position: absolute; visibility: visible; width: 2em; height: 2em; top: -25px; left: 0pt; border-width: 0pt;" title="Text Resize Monitor" id="_yuiResizeMonitor"></iframe><div style="z-index: 17; visibility: hidden;" id="balloonCalloutPanel_c" class="yui-panel-container yui-overlay-hidden balloon"><div style="visibility: inherit;" class="yui-module yui-overlay yui-panel posUnder" id="balloonCalloutPanel"><div class="body"></div></div></div>
<noscript>
<style type="text/css">body{display:block !important;}</style>
<p class="nonjsAlert">NOTE: Many features on the This Web site require Javascript and cookies. You can enable both via your browser's preference settings.</p>
</noscript>
<div class="p2p" id="page">
<div id="header" class="std" <? if ($_GET['login']=="RCL"){?> style="height:198px;" <?}?>>
	<? if ($_GET['login']!="RCL"){?>
			<h1><a target="_blank" href="http://www.casalindacity.com" ><img src="images/new-casa-linda-logo.gif" alt="" border="0"></a></h1>
    <?}?>
 <? if ($_SESSION['owner']){?>
    <div id="navGlobal">
        <ul>
			  <li class="last"><a href="logout.php">Log Out</a></li>
		 </ul>
    </div>
    <div id="navPrimary">
      <ul class="secondary">
        <li <? if ( $_GET['main']==1){?> <?=SELECT_MENU?> <?}?>><a href="home.php">My Account</a>
        	<ul>
                <li<? if ( $_GET['secund']==1.1){?> <?=SELECT_MENU?> <?}?>>&nbsp;<!--//<a href="home_overview.php">Overview</a>//--></li>
                <li <? if ( $_GET['secund']==1.2){?> <?=SELECT_MENU?> <?}?>><!--//<a href="profile.php">Profile</a>//--></li>
				<? if ( $_GET['secund']==1.2){?>
                	<ul>
                        <li <? if ( $_GET['segundo']==1.21){?> <?=SELECT_MENU?> <? } ?> >  <!--//<a href="profile.php">Edit/change Personal Details</a>//--></li>
                        <li <? if ( $_GET['segundo']==1.22){?> <?=SELECT_MENU?> <? } ?> ><!--//<a href="profile1.php">Edit/Change Secret Question or Password</a>//--></li>
                    </ul>
                   <?}?>
        	</ul>
    	</li>
    	<li <? if ( $_GET['main']==2){?> <?=SELECT_MENU?> <?}?>>  <a href="availability.php">Availability</a>
        	<ul>
                <li <? if ( $_GET['secund']==2.1){?> <?=SELECT_MENU?> <?}?>>&nbsp;<!--//<a href="create_booking.php">Create new</a>//--></li>
                <!--//<li <? if ( $_GET['secund']==2.2){?> <?=SELECT_MENU?> <?}?>><a href="find_booking.php">Find</a></li>
                <li <? if ( $_GET['secund']==2.3){?> <?=SELECT_MENU?> <?}?>><a href="cancel_booking.php">Cancel booking</a></li>//-->
   			</ul>
    	</li>
		<li <? if ( $_GET['main']==7){?> <?=SELECT_MENU?> <?}?>>  <a href="new_booking.php">New booking</a>
        	<ul>
                <li <? if ( $_GET['secund']==7.1){?> <?=SELECT_MENU?> <?}?>>&nbsp;<!--//<a href="create_booking.php">Create new</a>//--></li>
               
   			</ul>
    	</li>
    	<li <? if ( $_GET['main']==3){?> <?=SELECT_MENU?> <?}?>><a href="communicate.php">Contact Us</a>
        	<ul>
    			<li <? if ( $_GET['secund']==3.1){?> <?=SELECT_MENU?> <?}?>>&nbsp;<!--//<a href="clients_list.php" >List</a>//--></li>
    		</ul>
    	</li>
    	<li <? if ( $_GET['main']==5){?> <?=SELECT_MENU?> <?}?>><a href="news.php">News</a>
        	<ul>
    			<li <? if ( $_GET['secund']==3.1){?> <?=SELECT_MENU?> <?}?>>&nbsp;</li>
    		</ul>
    	</li>
    	<li <? if ( $_GET['main']==4){?> <?=SELECT_MENU?> <?}?>><a href="profile.php">Profile</a>
        	<ul>
    			<li <? if ( $_GET['secund']==3.1){?> <?=SELECT_MENU?> <?}?>>&nbsp;<!--//<a href="clients_list.php" >List</a>//--></li>
    		</ul>
    	</li>
      </ul>
    </div>
<? }?>
</div>
<div id="content" class="sideposright">
<div id="headline">
<div class="titleLink secure"><a target="_blank" href="http://www.casalindacity.com" >www.CasaLindaCity.com</a></div>
<!--//<h2><?=$_GET['titulo']?></h2>//-->
