<? session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RCL Booking System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="es" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
   <!--no flollow content-->
    <meta name="robots" content="none" />
	<meta name="robots" content="noindex, nofollow, noarchive" />
    <meta name="gooblebot" content="noindex, nofollow, noarchive" />
    <meta http-equiv="cache-control" content="no-cache" />
    <!--no flollow content-->
    <meta name="author" content="ing.joseluis@msn.com" />
    <meta name="copyright" content="&copy; 2016 ing.joseluis@msn.com" />

	<link rel="icon" href="https://rentals.casalindacity.com/favicon.ico" type="image/ico" />
	<link rel="shortcut icon" href="https://rentals.casalindacity.com/favicon.ico" />
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
<!--//    <link href="../css/main.css" rel="stylesheet" type="text/css" />
    <link href="../css/estilo.css" rel="stylesheet" type="text/css" />//-->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />


   <!--// <link rel="stylesheet" href="js/w/dhtmlwindow.css" type="text/css" />
	<script type="text/javascript" src="js/w/dhtmlwindow.js"></script>
	<link rel="stylesheet" href="js/m/modal.css" type="text/css" />
	<script type="text/javascript" src="js/m/modal.js"></script>
	<script type="text/javascript" src="js/states_countries.js"></script>

	<script type="text/javascript" src="js/confirm.js"></script>
//-->
<script language="javascript" type="text/javascript">
	function muestraReloj()
{
// Compruebo si se puede ejecutar el script en el navegador del usuario
if (!document.layers && !document.all && !document.getElementById) return;
// Obtengo la hora actual y la divido en sus partes
var fechacompleta = new Date();
var horas = fechacompleta.getHours();
var minutos = fechacompleta.getMinutes();
var segundos = fechacompleta.getSeconds();
var mt = "AM";
// Pongo el formato 12 horas
if (horas> 11) {
mt = "PM";
horas = horas - 12;
}
if (horas == 0) horas = 12;
// Pongo minutos y segundos con dos digitos
if (minutos <= 9) minutos = "0" + minutos;
if (segundos <= 9) segundos = "0" + segundos;
// En la variable 'cadenareloj' puedes cambiar los colores y el tipo de fuente
//cadenareloj = "<font size='-1' face='verdana'>" + horas + ":" + minutos + ":" + segundos + " " + mt + "</font>";
cadenareloj =horas + ":" + minutos + ":" + segundos + " " + mt;
// Escribo el reloj de una manera u otra, segun el navegador del usuario
if (document.layers) {
document.layers.spanreloj.document.write(cadenareloj);
document.layers.spanreloj.document.close();
}
else if (document.all) spanreloj.innerHTML = cadenareloj;
else if (document.getElementById) document.getElementById("spanreloj").innerHTML = cadenareloj;
// Ejecuto la funcion con un intervalo de un segundo
setTimeout("muestraReloj()", 1000);
}

</script>

<script language="javascript">

function windowOpener(windowHeight, windowWidth, windowName, windowUri)
{
    var centerWidth = (window.screen.width - windowWidth) / 2;
    var centerHeight = (window.screen.height - windowHeight) / 2;

    newWindow = window.open(windowUri, windowName, 'titlebar=no, resizable=no, scrollbars=yes, toolbar=no,location=false, directories=no, status=no, menubar=no,width=' + windowWidth +
        ',height=' + windowHeight +
        ',left=' + centerWidth +
        ',top=' + centerHeight);

    newWindow.focus();
    return newWindow.name;
}

</script>

<SCRIPT LANGUAGE="javascript">
<!--
function referal(url)
{
window.open(url, 'Booking_System_RCL', 'width=600, height=650, resizable=yes, scrollbars=yes');

}
-->
</SCRIPT>

</head>
<body  onload="muestraReloj()" >
	<div id="wrap-utilidades">
		<div id="utilidades" class="clearfix">
<!-- Publicidad -->
            <div class="publicidad-head b-publicidad">
            <div style="margin: 0pt auto; width: 728px;">
            </div>
            </div>
			<div id="pop-login" class="emboss" style="display: none; visibility: hidden;" role="dialog">
			<!--	<h2>Logout</h2>-->
			</div>
			<div id="breadcrumb">
				<? if ($_SESSION['info']){?><p>Bienvenido(a): <!--<a href="#">--><span style="color:#006;"><? echo ucfirst($_SESSION['info']['name'])." ".ucfirst($_SESSION['info']['lastname']) ?></span><!--</a>--> <!--&gt;--> <!--- Level  &gt;--> <? /* echo $_SESSION['rcl']['level']*/?> </p><? }?>
			</div>

			<!-- anonimo -->
			<ul id="identificacion">
            	<li style="color:#006"><strong><?=formatear_fecha(date('Y-m-d'));?></strong></li>
				<li class="primera"><!--<a href="#">--><strong><div id="spanreloj" style="color:#006"><!--CLOCK APPER HERE--></div></strong>
<!--Date, Time--><!--</a>--></li>
				<? if ($_SESSION['info']){?><li class="login"><a id="login-link" href="logout.php">Salir</a></li><? }?>
			</ul>
			 <!-- usr? -->
		</div>
	</div> <!-- /wrap-utilidades -->
		<div id="wrap-header">

		<div id="header" role="banner" style="background:url(&quot;images/fondo_014.jpg&quot;) repeat scroll 0% 0% transparent;">
			<a href="home-welcome.php" title="Go Home to Booking System" class="limpito"><!--//<img class="pngfix" id="js-logo" src="template/img/rcl_transparente.png" alt="" border="0" height="60" width="252">//--></a>
		</div> <!-- /header -->
	</div> <!-- /wrap-header -->
	<div id="wrap-navegacion">
    <div id="navegacion" class="clearfix">	<p class="invis"><!--(Menu principal)--></p>
   <?if ($_SESSION['info']){?>
      <ul id="nav-primaria" class="clearfix" role="navigation">
        <li <?  if ($_GET['actual']==1) echo 'class="actual"';?>><a href="index.php" accesskey="1"><span>Inicio</span></a></li>
		 <li <?  if ($_GET['actual']==1) echo 'class="actual"';?>><a href="new_statement.php" accesskey="1"><span>Nuevo</span></a></li>
		  <li <?  if ($_GET['actual']==1) echo 'class="actual"';?>><a href="view_statement.php" accesskey="1"><span>Ver</span></a></li>

         <? if (($_SESSION['info']['id']==5)||($_SESSION['info']['id']==31)){?>
           <li <?  if ($_GET['actual']==3) echo 'class="actual"';?>><a href="delete_record_to_villa.php" accesskey="1"><span>Delete all Statements</span></a></li>
           <li <?  if ($_GET['actual']==4) echo 'class="actual"';?>><a href="delete_some_statements.php" accesskey="1"><span>Delete some Statements</span></a></li>
         <?}?>
     <!--//   <li <? if ($_GET['actual']==2) echo 'class="actual"';?>><a href="languages.php" accesskey="2"><span>Languages</span></a></li>
       	<li <? if ($_GET['actual']==3) echo 'class="actual"';?>><a href="translations.php" accesskey="4"><span>Translations</span></a></li>//-->
   </ul>
   <? }else{?>
      <ul id="nav-primaria" class="clearfix" role="navigation"><li><a href="#">&nbsp;</a></li></ul>
   <? }?>
	</div> <!-- /navegacion -->

	</div>  <!-- /wrap-navegacion -->

	<a name="a-contenido"></a>

	<div id="wrap-main"><!-- need to clos-->

		<div id="main" class="clearfix " role="main"><!-- need to clos-->
			<div id="subnav" class="clearfix">
				<?/*  if ($_GET['p']=='h'){?>
                <ul class="menu">

                    <li class="actual"><a href="home-welcome.php" title=""><span>Welcome</span></a></li>

                </ul>
				<? }?>

                <?  if ($_GET['p']=='b'){?>
                <ul class="menu"> <!--BOOKING MENU-->
                <li <? if (($_GET['s']=='b.ca')||(!$_GET['s'])) echo 'class="actual"';?>><a href="booking-calendar.php" title="Main Calendar"><span>Calendar</span></a></li>

                    <li <? if ($_GET['s']=='b.f') echo 'class="actual"';?>><a href="find-booking.php" title="Find bookings"><span>Find</span></a></li>
                    <? if ($_SESSION['rcl']['level']<=4){?>
                    	<li <? if ($_GET['s']=='b.e') echo 'class="actual"';?>><a href="edit-booking.php" title="Change a Booking"><span>Edit</span></a></li>
                    <?}?>
                     <? if ($_SESSION['rcl']['level']==1){?>
                     	<li <? if ($_GET['s']=='b.c') echo 'class="actual"';?>><a href="cancel-booking.php" title="Cancel a booking"><span>Cancel</span></a></li>
                     <?}?>

                    <li <? if ($_GET['s']=='b.ck') echo 'class="actual"';?>><a href="check-in.php" title="Check In Today"><span>Check In</span></a></li>
                    <li <? if ($_GET['s']=='b.o') echo 'class="actual"';?>><a href="check-out.php" title="Check Out Today"><span>Check Out</span></a></li>
                    <? if ($_SESSION['rcl']['level']==1){?>
                     	<li <? if ($_GET['s']=='b.s') echo 'class="actual"';?>><a href="seasons.php" title="update seasons"><span>Seasons</span></a></li>
                     	<li <? if ($_GET['s']=='b.in_out') echo 'class="actual"';?>><a href="in_out.php" title="In & Out past time"><span>In & Out</span></a></li>
                     	<li <? if ($_GET['s']=='b.book_changed') echo 'class="actual"';?>><a href="bookings_changed.php" title="Bookings Changed"><span>Booking changes</span></a></li>
                    <?}?>
                </ul>
				<? }?>

                <?  if ($_GET['p']=='c'){?>
                <ul class="menu">  <!--CUSTOMERS MENU-->
                <li <? if (($_GET['s']=='c.n')||(!$_GET['s'])) echo 'class="actual"';?> ><a href="new-client.php" title="Create Customer"><span>New</span></a></li>
                    <li <? if ($_GET['s']=='c.v') echo 'class="actual"';?>><a href="view-clients.php" title="View customers"><span>View all</span></a></li>
                    <? if ($_SESSION['rcl']['level']<=3){?>
                    	<li <? if ($_GET['s']=='c.e') echo 'class="actual"';?>><a href="edit-clients.php" title="Change a customer"><span>Edit</span></a></li>
                    <?}?>
                    <li <? if ($_GET['s']=='c.f') echo 'class="actual"';?>><a href="find-client.php" title="Search Customer"><span>Find</span></a></li>
                     <? if ($_SESSION['rcl']['level']==1){?>

                     <?}?>
                </ul>
				<? }?>

                <?  if ($_GET['p']=='a'){?>
                <ul class="menu">  <!--SERVICES MENU-->
                	<li <? if ($_GET['s']=='a.v') echo 'class="actual"';?>><a href="view-services.php" title="See all services"><span>View Services</span></a></li>
                	<? if ($_SESSION['rcl']['level']==1){?>
	                	<li <? if (($_GET['s']=='a.n')||(!$_GET['s'])) echo 'class="actual"';?>><a href="new-service.php" title="Add service"><span>New</span></a></li>
	                    <li <? if ($_GET['s']=='a.c') echo 'class="actual"';?>><a href="edit-services.php" title="Modify a service"><span>Change</span></a></li>
	                    <li <? if ($_GET['s']=='a.d') echo 'class="actual"';?>><a href="dis-services.php" title="Disable a service"><span>Delete</span></a></li>
	                <?}?>
                </ul>
				<? }?>
                <?  if ($_GET['p']=='i'){?>
                <ul class="menu"> <!--INTERMEDIARIES MENU-->
                <li <? if (($_GET['s']=='i.v')||(!$_GET['s'])) echo 'class="actual"';?>><a href="view-interm.php" title="View commisions"><span>View</span></a></li>
                 <? if ($_SESSION['rcl']['level']<=2){?>
                    <li <? if ($_GET['s']=='i.n') echo 'class="actual"';?>><a href="new-interm.php" title="Create a new one"><span>New</span></a></li>
                    <li <? if ($_GET['s']=='i.c') echo 'class="actual"';?>><a href="edit-interm.php" title="Modify one"><span>Change</span></a></li>
                 <?}?>

                 <? if ($_SESSION['rcl']['level']==1){?>
                    <li <? if ($_GET['s']=='i.d') echo 'class="actual"';?>><a href="dis-interm.php" title="Enable or Disalbe"><span>Delete</span></a></li>
                  <?}?>

                 <? if ($_SESSION['rcl']['level']<=2){?>
                    <li <? if ($_GET['s']=='i.a') echo 'class="actual"';?>><a href="assign_to_referal.php" title="Assign a booking"><span>Assign a booking</span></a></li>
                 <?}?>

                </ul>
				<? }?>
                <?  if ($_GET['p']=='v'){?>
                <ul class="menu"> <!--VILLAS AND OWNERS MENU-->
                  <? if ($_SESSION['rcl']['level']<=3){?>
    				 <li <? if (($_GET['s']=='v.v')||(!$_GET['s'])) echo 'class="actual"';?>>
                			<a href="view-villas.php" title="View all the houses"><span>Villas</span></a>
                	</li>
                  <?}?>
                   <? if ($_SESSION['rcl']['level']==1){?>
	                	<li <? if ($_GET['s']=='v.n') echo 'class="actual"';?>><a href="new-villa.php" title="Create a New Villa"><span>New villa</span></a></li>
	                    <li <? if ($_GET['s']=='v.c') echo 'class="actual"';?>><a href="edit-villas.php" title="Modify a villa"><span>Change villa</span></a></li>

                    <?}?>
                    <li <? if ($_GET['s']=='v.o') echo 'class="actual"';?>><a href="view-owners.php" title="View all the Owners"><span>Owners</span></a></li>
                   <? if ($_SESSION['rcl']['level']==1){?>
	                    <li <? if ($_GET['s']=='v.no') echo 'class="actual"';?>><a href="new-owner.php" title="Create a Owner"><span>New Owner</span></a></li>
	                    <li <? if ($_GET['s']=='v.e') echo 'class="actual"';?>><a href="edit-owner.php" title="Change a owner"><span>Edit Owner</span></a></li>

                     <?}?>
                </ul>
				<? }?>
                <?  if ($_GET['p']=='p'){?>
                <ul class="menu"><!--PRINTING MENU-->

                    <li <? if ($_GET['s']=='p.i') echo 'class="actual"';?>><a href="invoices.php" title="print a invoice"><span>Invoice Short Term</span></a></li>
                    <li <? if ($_GET['s']=='p.r') echo 'class="actual"';?>><a href="register-sheet.php" title="print a register sheet"><span>Register Sheet</span></a></li>                   <li <? if ($_GET['s']=='p.l') echo 'class="actual"';?>><a href="invoices_long.php" title="print a invoice"><span>Invoice Long Term</span></a></li>
                    <li <? if ($_GET['s']=='p.s') echo 'class="actual"';?>><a href="security-sheet.php" title="print a invoice"><span>Security Info</span></a></li>

                </ul>
				<? }?>
                <?  if ($_GET['p']=='u'){?>
                <ul class="menu"><!--USER ACCESS MENU-->
                <li <? if (($_GET['s']=='u.v')||(!$_GET['s'])) echo 'class="actual"';?>><a href="view-users.php" title="See all usesrs"><span>View</span></a></li>
                    <li <? if ($_GET['s']=='u.n') echo 'class="actual"';?>><a href="new-user.php" title="create a user"><span>New</span></a></li>
                    <li <? if ($_GET['s']=='u.e') echo 'class="actual"';?>><a href="edit-user.php" title="change a user"><span>Edit</span></a></li>
                    <li <? if ($_GET['s']=='u.d') echo 'class="actual"';?>><a href="dis-user.php" title="Disable or Enable"><span>Delete</span></a></li>
                    <li <? if ($_GET['s']=='u.p') echo 'class="actual"';?>><a href="profile-user.php" title="Change my Personal info"><span>Change my Profile</span></a></li>
                    <li <? if ($_GET['s']=='u.pa') echo 'class="actual"';?>><a href="pass-user.php" title="Change my password"><span>Change my Password</span></a></li>
                </ul>
				<? }?>
				<?  if ($_GET['p']=='r'){?>
                <ul class="menu"><!--REPORTS MENU-->
                 <? if ($_SESSION['rcl']['level']==1){?>
                	<li <? if (($_GET['s']=='r.cc')||(!$_GET['s'])) echo 'class="actual"';?>><a href="reports.php" title="See clients per countries and cities"><span>Clients per Cities</span></a></li>
                	<li <? if ($_GET['s']=='r.cr') echo 'class="actual"';?>><a href="search_clients_referal.php" title="See clients per referal"><span>Clients per Referal</span></a></li>

                	<li <? if ($_GET['s']=='r.br') echo 'class="actual"';?>><a href="search_bookings_referal.php" title="See bookings per referal"><span>Bookings per Referal</span></a></li>
                 <?}?>
                </ul>
				<? }?>
				<?  if ($_GET['p']=='pro'){?>
                <ul class="menu"><!--PROMOTION MENU-->
                 <? if ($_SESSION['rcl']['level']==1){?>
                	<li <? if (($_GET['s']=='pro.a')||(!$_GET['s'])) echo 'class="actual"';?>><a href="all_promotion.php" title="See all our Promotions"><span>View All</span></a></li>
                	<li <? if ($_GET['s']=='pro.n') echo 'class="actual"';?>><a href="new_promotion.php" title="Create New promotion"><span>New</span></a></li>
                 <?}?>
                </ul>
				<? }?>
				<?  if ($_GET['p']=='ad'){?>
                <ul class="menu"><!--ADMIN MENU-->
                 <? if ($_SESSION['rcl']['level']==1){?>
                	<li <? if (($_GET['s']=='ad.a')||(!$_GET['s'])) echo 'class="actual"';?>><a href="last-activities.php" title="See all usesrs"><span>Last activities</span></a></li>
                	<li <? if ($_GET['s']=='ad.e') echo 'class="actual"';?>><a href="send_emails.php" title="See all usesrs"><span>Email Owners</span></a></li>
                	<li <? if ($_GET['s']=='ad.c') echo 'class="actual"';?>><a href="send_emails_clients.php" title="See all usesrs"><span>Email clients</span></a></li>
                 <?}?>
                    <li <? if ($_GET['s']=='ad.i') echo 'class="actual"';?>><a href="search-invoices.php" title="create a user"><span>Search invoices</span></a></li>
                </ul>
				<? }?>

				<? if ($_SESSION['rcl']['contabilidad']==1){?>
					<?  if ($_GET['p']=='con'){?>
	                <ul class="menu"><!--ADMIN MENU-->
                        <li <? if ($_GET['s']=='con.u') echo 'class="actual"';?>><a href="unpaid.php" title="Unpaid"><span>No pagado</span></a></li>
	                	<li <? if (($_GET['s']=='con.p')||(!$_GET['s'])) echo 'class="actual"';?>><a href="ready_to_pickup.php" title="Ready to pickup"><span>Listo</span></a></li>
	                	<li <? if ($_GET['s']=='con.paid') echo 'class="actual"';?>><a href="paid.php" title="Paid"><span>Pagado</span></a></li>
	                </ul>
	                 <?}?>
				<? }*/?>
			</div>


<div class="container_16 clearfix" >
	<div style="padding:3px;">

	<!--<div style="padding:3px; border: 3px coral solid;  ">-->

	<!--CONTENT GOES HERE-->