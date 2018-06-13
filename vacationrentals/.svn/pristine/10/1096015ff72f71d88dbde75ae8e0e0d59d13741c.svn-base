<?php
			$db= new getQueries();
			$simalar=$db->villas_3_ramdom_online($beds=$v['bed']);
			/*echo "</pre>";
			print_r($simalar);
			echo "<pre>";*/
			?>

<h2 class="property-page-section-title" id="Similar-Properties">Similar Properties</h2>


<div class="row">
	<div class="row-same-height row-full-height alternative-properties-wrapper">
		
		<div class="col-xs-10 col-xs-height col-middle">
			<div id="alternativeProperties" class="carousel slide alternative-properties-carousel" data-interval="false">									
				<div class="carousel-inner alternative-properties-carousel-inner">
					
							
					
						<div class="item alternative-properties-item active">
							<div class="row">	
							<!-- open row -->
																
					<?php 
					
					foreach($simalar AS $s){?>
						<div class="col-xs-6 col-sm-4">
							
							<div class="alternative-properties-price-wrapper">
								<div class="alternative-properties-price-container">
									<h2 class="alternative-properties-price"><strong><?=$s['p_low']*1.18;?></strong></h2>
									<div class="alternative-properties-per-night"><small>Per night <strong>(USD)</strong></small>
									</div>
								</div>
							</div>
							
							<a href="villa-details.php?v=<?=$s['id'];?>" class="alternative-properties-img"><img src="../booking/<?=$s['pic']?>" style="height: 160px;"></a>
							<div class="alternative-properties-title">
								<a href="villa-details.php?v=<?=$s['id'];?>"><!--<span class="pid-text">Code:</span>--> Villa-<?=$s['no'];?></a>
							</div>
						</div>
					<? }?>
																
					
						<!--<div class="col-xs-6 col-sm-4">
							
							<div class="alternative-properties-price-wrapper">
								<div class="alternative-properties-price-container">
									<h2 class="alternative-properties-price"><strong>$370.00</strong></h2>
									<div class="alternative-properties-per-night"><small>Per night <strong>(USD)</strong></small>
									</div>
								</div>
							</div>
							
							<a href="/vacation-rental-home.asp?PageDataID=116269" class="alternative-properties-img"><img src="http://cdn.liverez.com/5/13260/1/116269/250/1.jpg" style="height: 160px;"></a>
							<div class="alternative-properties-title">
								<a href="/vacation-rental-home.asp?PageDataID=116269"><span class="pid-text">Code:</span> Villa-751</a>
							</div>
						</div>
						
																
					
						<div class="col-xs-6 col-sm-4">
							
							<div class="alternative-properties-price-wrapper">
								<div class="alternative-properties-price-container">
									<h2 class="alternative-properties-price"><strong>$370.00</strong></h2>
									<div class="alternative-properties-per-night"><small>Per night <strong>(USD)</strong></small>
									</div>
								</div>
							</div>
							
							<a href="/vacation-rental-home.asp?PageDataID=116270" class="alternative-properties-img"><img src="http://cdn.liverez.com/5/13260/1/116270/250/1.jpg" style="height: 160px;"></a>
							<div class="alternative-properties-title">
								<a href="/vacation-rental-home.asp?PageDataID=116270"><span class="pid-text">Code:</span> Villa-849</a>
							</div>
						</div>-->
						
						
							</div>
						</div>
						<!-- close row -->
							
					
				</div><!--.carousel-inner-->
			</div>
		</div>
		
	</div>
</div>	