<link href="menu_CSS/style.css" rel="stylesheet" type="text/css" />

<div id='cssmenu'>
<ul>
   <!--<li><a href='last-activities.php'><span>Activities</span></a></li>-->
   <li class='has-sub '><a href='#'><span>Villas</span></a>
      <ul>
         <li class='has-sub '><a href='view-villas.php'><span>View all villas</span></a></li>
         <li class='has-sub '><a href='new-villa.php'><span>Create a Villa</span></a></li>
		 <li class='has-sub '><a href='view-villas-ha.php'><span>HomeAway list</span></a></li>
		 <li class='has-sub '><a href='view-villas-rp.php'><span>Rentals Pool list</span></a></li>
		 <li class='has-sub '><a href='services-chart.php' target="_blank"><span>Services chart</span></a></li>
      </ul>
   </li>
   <li class='has-sub '><a href='#'><span>Owners</span></a>
	   	<ul>
	   		<li class='has-sub '><a href='view-owners.php'><span>View all owners</span></a></li>
	   		<li class='has-sub '><a href='new-owner.php'><span>Create owner</span></a></li>
	    </ul>
   </li>
   <?php
   if ($_SESSION['info']['agentes']==1){
	   ?>
    <li class='has-sub '><a href='#'><span>Referrals</span></a>
	   	<ul>
			<li class='has-sub '><a href='view-interm.php'><span>View all</span></a> </li>
			<li class='has-sub '><a href='new-interm.php'><span>Create new</span></a> </li>
			<li class='has-sub '><a href='dis-interm.php'><span>Delete</span></a> </li>
	    </ul>
   </li> 
   <?php
    
   }
   ?>
</ul>
</div>
<div style="clear:both; margin: 0 0 30px 0;">&nbsp;</div>