<!--HOME WELCOME-->
<!--Reloj digital flash-->
<!--<link rel="stylesheet" type="text/css" href="clock/media/screen.css" />-->
		<script type="text/javascript" src="clock/js/swfobject.js"></script>

       <div style="text-align:right;">
       <p id="devDigitalClock" ><a href="http://www.casalindacity.com/">Digital flash clock</a></p></div>

		<script type="text/javascript">
			var flashvars = {
				clockSkin: "clock/media/skins/skin001.png",
				digitWidth: "20",
				digitHeight: "32",
				separatorWidth: "11",
				ampmWidth: "23"
			};
			swfobject.embedSWF(
				"clock/media/devDigitalClock.swf", // path to the widget
				"devDigitalClock",
				"179", // width of the widget
				"40", // height of the widget
				"8",
				"clock/media/expressInstall.swf",
				flashvars,
				{scale: "noscale", wmode: "transparent"}
			);
		</script>
 <!--End Reloj digital flash-->
 <hr />
 <h2>Residencial Casa Linda</h2>

 <? $db=new getQueries();
 $checkin=$db->check_in_today();
 $total_in=$db->getAffectedRows();
 $checkout=$db->check_out_today();
 $total_out=$db->getAffectedRows();
 ?>
 <table align="center" cellpadding="2" cellspacing="2">
 <tr>
 <td  onclick="location.href='booking-calendar.php'" title="" onmouseover="this.style.backgroundColor='#e2e1e1'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" ><p style="text-align:center; margin:0px;"><img src="images/home/calendar_icon.png" alt="See Calendar" title="See Calendar" border="0" width="90px" height="97px"/></p><p style="text-align:center; margin:0px;" class="paraf">Calendar</p></td>
 <td  onclick="location.href='check-in.php'" title="" onmouseover="this.style.backgroundColor='#e2e1e1'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" ><p style="text-align:center; margin:0px;"><img src="images/home/checkin_icon2.png" alt="See check in" title="See check in" border="0" width="88px" height="97px"/></p><p style="text-align:center; margin:0px;" class="paraf">Check In Today (<span style="color:red;"><?=$total_in?></span>)</p></td>
 <td  onclick="location.href='check-out.php'" title="" onmouseover="this.style.backgroundColor='#e2e1e1'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" ><p style="text-align:center; margin:0px;"><img src="images/home/checkout_icon2.png" alt="See check out" title="See check out" border="0" width="88px" height="97px"/></p><p style="text-align:center; margin:0px;" class="paraf">Check Out Today (<span style="color:red;"><?=$total_out?></span>)</p></td>
 </tr>
 <tr>
 <td onclick="location.href='new-client.php'" title="" onmouseover="this.style.backgroundColor='#e2e1e1'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" ><p style="text-align:center; margin:0px;"><img src="images/home/add_client_icon.png" alt="find booked" title="Find Booked" border="0" width="88px" height="95px"/></p><p style="text-align:center; margin:0px;" class="paraf">New Customer</p></td>
 <td onclick="location.href='find-booking.php'" title="" onmouseover="this.style.backgroundColor='#e2e1e1'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" ><p style="text-align:center; margin:0px;"><img src="images/home/find_book_icon.png" alt="find booked" title="Find Booked" border="0" width="100px" height="98px"/></p><p style="text-align:center; margin:0px;" class="paraf">Find Bookings</p></td>
 <td  onclick="location.href='find-client.php'" title="" onmouseover="this.style.backgroundColor='#e2e1e1'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" ><p style="text-align:center; margin:0px;"><img src="images/home/find_client_icon.png" alt="Find Customers" title="Find Customers" border="0" width="98px" height="95px"/></p><p style="text-align:center; margin:0px;" class="paraf">Find Customers</p></td>
 </tr>
 </table>
 <?/* include_once('inc/visitor_online.php');*/?>

