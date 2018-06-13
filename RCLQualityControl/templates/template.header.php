<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>RCL Quality Control System</title>
 <!--no flollow content-->
    <meta name="robots" content="none" />
	<meta name="robots" content="noindex, nofollow, noarchive" />
    <meta name="gooblebot" content="noindex, nofollow, noarchive" />
    <meta http-equiv="cache-control" content="no-cache" />
    <!--no flollow content-->
    <meta name="author" content="ing.joseluis@msn.com" />
    <meta name="copyright" content="&copy; 2012 ing.joseluis@msn.com" />

	<link rel="icon" href="favicon.ico" type="image/ico" />
	<link rel="shortcut icon" href="favicon.ico" />



    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="css/style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="css/style.ie7.css" type="text/css" media="screen" /><![endif]-->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
   <style type="text/css">
.art-post .layout-item-0 { padding-right: 10px;padding-left: 10px; }
   .ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
   .ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
   </style>
  <!--// FANCY BOX//-->
  <script type="text/javascript" src="js/jquery.min.js"></script>
 <script type="text/javascript" src="./fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="./fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="./fancybox/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	<!--//<link rel="stylesheet" href="./fancybox/style.css" />//-->
   <!--// FANCY BOX//-->

</head>
<body>
<div id="art-main">
    <div class="cleared reset-box"></div>
    <div id="art-header-bg" class="art-header">
    </div>
    <div class="cleared reset-box"></div>
    <div id="art-hmenu-bg" class="art-bar art-nav">
    </div>
    <div class="cleared reset-box"></div>
    <div class="art-box art-sheet">
        <div class="art-box-body art-sheet-body">
            <div class="art-header">
                <div class="art-headerobject"></div>
                        <div class="art-logo">
                                                 <h1 class="art-logo-name"><a href="./index.php">RCL Quality Control</a></h1>
                                                                         <h2 class="art-logo-text">Residencial Casa Linda</h2>
                                                </div>

            </div>
            <div class="cleared reset-box"></div>
<div class="art-bar art-nav">
<div class="art-nav-outer">
	<ul class="art-hmenu">
	<?if ($_SESSION['rqc']){?>
<?php

?>
<?php

?>
		<li>
			<a href="./index.php">Home</a>
		</li>
		<li>
		 <?if ($_SESSION['rqc']['dpto']<4){?>
			<a href="#" class="active">Create</a>
		 <?}?>
			<ul>
			 <?if (($_SESSION['rqc']['dpto']==1)||($_SESSION['rqc']['dpto']==2)){?>
				<li>
                    <a href="./new_item.php?i=1">Villa</a>
					<!--<ul >
					<li><a href="./new-page/new-page.html">Subpage 41</a></li>
					</ul>-->
                </li>
				<li>
                    <a href="./new_item.php?i=2">Doc No.</a>

                </li>
				<li>
                    <a href="./new_item.php?i=3">Construction Details</a>

                </li>
                <li>
                    <a href="./new_item.php?i=4">Deficiency</a>

                </li>
             <?}?>
              <?if (($_SESSION['rqc']['dpto']==1)||($_SESSION['rqc']['dpto']==3)){?>
                <li>
                    <a href="./new_item.php?i=5">Maintenance</a>
                </li>
              <?}?>
			</ul>
		</li>
        <li>
         <?if ($_SESSION['rqc']['dpto']<4){?>
			<a href="#" class="active">Modify</a>
		 <?}?>
			<ul>
			 <?if (($_SESSION['rqc']['dpto']==1)||($_SESSION['rqc']['dpto']==2)){?>
				<li>
                    <a href="./show_item.php?i=1">Villa</a>
					<!--<ul >
					<li><a href="./new-page/new-page.html">Subpage 41</a></li>
					</ul>-->
                </li>
				<li>
                    <a href="./show_item.php?i=2">Doc No.</a>

                </li>
				<li>
                    <a href="./show_item.php?i=3">Construction Details</a>

                </li>
                <li>
                    <a href="./show_item.php?i=4">Deficiency</a>

                </li>
             <?}?>
                <?if (($_SESSION['rqc']['dpto']==1)||($_SESSION['rqc']['dpto']==3)){?>
                <li>
                    <a href="./show_item.php?i=5">Maintenance</a>
                </li>
                <?}?>
			</ul>
		</li>
		<li>
		 <?if ($_SESSION['rqc']['dpto']<4){?>
			<a href="#" class="active">Construction</a>
		 <?}?>
			<ul>
			 <?if (($_SESSION['rqc']['dpto']==1)||($_SESSION['rqc']['dpto']==2)){?>
				<li>
                    <a href="./deficiency_done.php">Make deficiency done</a>
                </li>
             <?}?>
				<li>
	                <a href="./c_deficiency_done.php">See deficiencies done</a>
	            </li>
            </ul>
		</li>
		<li>
			<a href="./logout.php">Logout</a>
		</li>
	<?}?>
	</ul>
</div>
</div>
<div class="cleared reset-box"></div>
<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content">
<div class="art-box art-post">
