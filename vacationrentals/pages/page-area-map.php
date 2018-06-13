<div class="main-wrapper">
	
	<div class="container">
		<div class="row breadcrumb-wrapper">
			<div class="col-xs-12">
				<ol class="breadcrumb">
					<li>
						<a href="index.php">Home</a>
					</li>
					<li>
						Area Map and Location Information
					</li>
				</ol>
			</div>
		</div>
		<div class="row">
			
			<div class="col-xs-12 col-sm-4 col-md-3" id="content2Left">
			
				

<div id="searchBox2">
	
	<div class="search-results-map-button hidden"></div>
	
	<div class="sidebar sidebar-left">
		<div class="secondary-search">
			
			<button class="btn btn-danger visible-xs mobile-sidebar-close-button hide-sidebar pull-right">
				<i class="fa fa-times"></i>
			</button>
			
			<div class="search-title " id="secondary-search-title">
				Search Rentals
			</div>
			
		<?php require_once('inc/calendar_to_the_left.php'); ?>
			
		</div><!-- secondary search -->
	</div><!-- sidebar -->
</div> <!-- searchbox 2 -->

<div class="secondary-left-feature hidden-xs">
	
		<h4>Featured Property</h4>
		<?php require_once('inc/features_property.php'); ?>

	
</div>


<div class="secondary-left-reviews hidden-xs">
	
	<?php require_once('inc/reviews_show.php'); ?>

</div>

<div class="secondary-left-content hidden-xs">
	<!--<font face="arial, helvetica, sans-serif"><span style="font-size: 14px; line-height: 22.4px;">Rates include partial electricity credit per day which varies by Villa size, full Villa cleaning services upon check-out and make up of rooms during your stay.</span></font><br />-->
&nbsp;
</div>
				
			</div>
			
			<div class="col-xs-12 col-sm-8 col-md-9" id="content2Right">
			
				<h1>Area Map and Location Information</h1>
				
				
				<!--<div class="property-map-container">
					<div id="map_canvas" style="width:99%; height:350px"></div>	
					<div id="map2"></div>		
				</div>-->
	

				
				<iframe border="0" height="780" src="https://www.google.com/maps/d/u/0/embed?mid=zPJnkjtweMoY.kssd5Nup_sTI" style="border: 1px solid #777;" width="840"></iframe>
				<div class="row">
					<div class="col-md-12" >

						<a target="_blank" href="../rentals/images/1-6.jpg" ><img class="img-responsive" src="../rentals/images/1-6.jpg" alt="" /></a>
						
						<a target="_blank" href="custimages/map-phase7-9.jpg" ><img class="img-responsive" src="custimages/map-phase7-9.jpg" alt="" /></a>

					</div> <!-- end of .section-header -->
				
				</div> <!-- end of .row -->
				
			</div>
			<!--content2Right -->
			
		</div>
		<!--row -->
	</div>
	<!--container -->
	
</div>
<!--main-wrapper -->
<script type="text/javascript">
			$( document ).ready(function(){
				var myLatlng = new google.maps.LatLng( 19.763881195492342 , -70.48897847074738);
				var myOptions = {zoom: 15,center: myLatlng,navigationControl: true,scaleControl: true, scrollwheel: false,mapTypeId: google.maps.MapTypeId.ROADMAP};
				var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				var marker = new google.maps.Marker({position: myLatlng,map: map,title:" Villa 701"});
			})
			
			$( document ).ready(function(){
				var myLatlng = new google.maps.LatLng( 19.762472679460302, -70.49199327368012);
				var myOptions = {zoom: 15,center: myLatlng,navigationControl: true,scaleControl: true, scrollwheel: false,mapTypeId: google.maps.MapTypeId.ROADMAP};
				var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				var marker = new google.maps.Marker({position: myLatlng,map: map,title:" Villa 758"});
			})
		</script>

<script>

      // The following example creates complex markers to indicate beaches near
      // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
      // to the base of the flagpole.

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map2'), {
          zoom: 16,
          center: {lat: 19.762472679460302, lng: -70.49199327368012}
        });

        setMarkers(map);
      }

      // Data for the markers consisting of a name, a LatLng and a zIndex for the
      // order in which these markers should display on top of each other.
      var beaches = [
        ['Villa 758', 19.762472679460302, -70.49199327368012, 4],
        ['Villa 09', 19.771945846091306, -70.49092039007417, 5],
        ['Villa 31', 19.771365305841574, -70.49199863809815, 3],
        ['Villa 43', 19.770035103470533, -70.49330219167939, 2],
        ['Villa 05', 19.772700545254825, -70.49127175945512, 1]
      ];

      function setMarkers(map) {
        // Adds markers to the map.

        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.

        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        var image = {
          url: 'http://labs.google.com/ridefinder/images/mm_20_green.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(20, 32),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 32)
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        for (var i = 0; i < beaches.length; i++) {
          var beach = beaches[i];
          var marker = new google.maps.Marker({
            position: {lat: beach[1], lng: beach[2]},
            map: map,
            icon: image,
            shape: shape,
            title: beach[0],
            zIndex: beach[3]
          });
        }
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcoICy5v6Bv4_NG2SdYRFOt5mWAbHY28o&callback=initMap"> </script>