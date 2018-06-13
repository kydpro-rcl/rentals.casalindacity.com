<div class="footer-wrapper">
	
	<div class="container">
		<div class="row">

			<div class="col-sm-4 footer-col-one">
	
	<div class="footer-col-container">
		<h2>Let's Socialize</h2>
<a href="https://www.facebook.com/CasaLindaDR/" target="blank"><i class="fa fa-facebook-square"></i></a>
<a href="https://twitter.com/casa_linda_city" target="blank"><i class="fa fa-twitter-square"></i></a>
<a href="https://www.instagram.com/casalindacity/" target="blank"><i class="fa fa-instagram"></i></a>
<a href="https://plus.google.com/u/0/+ResidencialCasaLindaSos%C3%BAa/posts?gmbpt=true&_ga=1.246600262.337153904.1470677297" target="blank"><i class="fa fa-google-plus-square"></i></a>
<a href="https://www.youtube.com/channel/UCct2gh8Y8UOjWuG4AzamVXw" target="blank"><i class="fa fa-youtube-square"></i></a>
<script type="text/javascript">
		function showResult2(str)
		{
		if (str.length==0)
		  {
		  document.getElementById("livesearch2").innerHTML="";
		  document.getElementById("livesearch2").style.border="0px";
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
			document.getElementById("livesearch2").innerHTML=xmlhttp.responseText;
			document.getElementById("livesearch2").style.border="1px solid #A5ACB2";
			}
		  }
		xmlhttp.open("GET","../livesearch.php?q="+str,true);
		xmlhttp.send();
		}
	</script>
<!--<h2>Search Rentals</h2>
	
<input class="lr-typeahead form-control input-sm" type="text" onkeyup="showResult2(this.value)" placeholder="Search by Property Number">
<div id="livesearch2"></div>		
<script>

$( document).ready(function(){

	var myOptions = {
		timeoutLength: 600,
		dataSource: function(callback, query){

			$.ajax({
				type: 'GET',
				url: '/inc/api/webservices.aspx?method=propertysearch',
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
				return '<div><a href="../vacation-rentals-homes.asp">No Results</a></div>';
			}
		
			

		}
	};

	$('.lr-typeahead').lrtypeahead(myOptions);

});
</script>-->

	</div>
	
</div>

<div class="col-sm-4 footer-col-two">
	
	<div class="footer-col-container">
		<h2>Information</h2>
		<ul class="list-unstyled">                 
			<!--<li><a href="guest-reviews.php">Guest Reviews</a></li>-->
			<li><a href="../contact-information.php">Contact Us</a></li>
			<li><a href="../property-management-services.php">Property Management</a></li>
			<!--<li><a href="#">Owner Login</a></li>-->
		</ul>
	</div>
	
</div>

<div class="col-sm-4 footer-col-three">
	
	<div class="footer-col-container">
		<h2>Contact RCL ADMINISTRACIONES, SRL</h2>
		<address>Carretera Sosua-Cabarete,  Entrada el Choco
			<br> Sosua, Puerto Plata - Dominican Republic&nbsp;57000 </address>
		<ul class="list-unstyled mrg-bottom-1">
		
		<li>Call us toll-free: 844-830-1611</li>
		<li>Email: reservations@casalindacity.com</li>
		</ul>
	</div>
	
</div> 
			
		</div>
	</div>
	
	<!-- --/container ---->
	<div class="footer-banner-bottom">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 footer-banner-col-left">
	
	<div class="footer-banner-col-container">
		<p  style="color:#24baf4;" class="muted pull-left" >&copy; 2016 | RCL ADMINISTRACIONES, SRL All rights reserved. | <a style="color:#24baf4;" href="../terms-conditions.php" title="Terms of Use">Terms of Use</a> | <a style="color:#24baf4;" href="../privacy-policy.php">Privacy Policy</a><!-- | <a style="color:#24baf4;" href="sitemap.php">Sitemap</a> | <a style="color:#24baf4;" href="#" target="blank">Owner Login</a></p>-->
	</div>
	
</div>
<div class="col-sm-4 footer-banner-col-right">
	
	<div class="footer-banner-col-container">
		<!--<p class="muted pull-right">Powered by: <a href=#" target="blank">http://kydpro.com</a></p>-->
	</div>
	
</div>
			</div>
			<!-- --/container ---->
		</div>
	</div>
	
</div>


	
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>


	<!-- inject:js -->
	<script src="../js/scripts-1480458417572.js"></script>
	<!-- endinject -->


<script type="text/javascript"> 	
$( document ).ready(function(){

if(LIVEREZ.DynsiteFunctions.isMobileDevice()){
	$('.index-content img, #content2Right img').not('.lr-info-block-reviews-stars-div img').addClass('img-responsive');
	$('.index-content table, #content2Right table').wrap('<div class="table-responsive" />');
}


LIVEREZ.DynsiteFunctions.handleCRMPlusCookies('');


$('form[name="form_reserve"]').on('submit', function(event){		
	// Cross browser hoops.
	event = event || window.event;                             
	var target = event.target || event.srcElement;			
	if (target && target.action) {
		ga('linker:decorate', target);
	}		
})	


	LIVEREZ.SearchResults.clearFilters();


});
</script>


<div class="site-overlay hidden"></div>	

	
</body>
</html>