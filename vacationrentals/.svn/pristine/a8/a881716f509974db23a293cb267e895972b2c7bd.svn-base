<?php

switch($_GET['b']){
		case 10:$beds=$_GET['b'];break;
		case 1:$beds=$_GET['b'];break;
		case 2:$beds=$_GET['b'];break;
		case 3:$beds=$_GET['b'];break;
		case 4:$beds=$_GET['b'];break;
		case 5:$beds=$_GET['b'];break;
		case 6:$beds=$_GET['b'];break;
		default:
			exit("Error: Invalid bedrooms size");	
	}
	
$items_pp=7;
  if($_GET['pag']!=''){
	$current_page=$_GET['pag'];  
  }else{
	$current_page=1;
  }
  $db= new getQueries ();
  $count = count($db->villas_for_rent_online($beds));
  //$count =15;
  $paging_info = get_paging_info($count,$items_pp,$current_page);
  $villas_for_rent=$db->display_rentals($beds,$starts=$paging_info['si'],$end=$items_pp);
 // $codigoFX=$db->display_guests('0', $starts=$paging_info['si'],$ends=$items_pp);
  
//$villas_for_rent=$db->villas_for_rent_online($beds);//villas for rent with this bedrooms qty.
?>

<div class="main-wrapper">
	
	<div class="container">
		<div class="row breadcrumb-wrapper">
			<div class="col-xs-12">
				<ol class="breadcrumb">
					<li>
						<a href="index.php">Home</a>
					</li>
					<li>
						View Rentals
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
				<h1>View Rentals</h1>
				<p>
				</p>  
<hr style="border: 1px solid #9c0000;"/>
<p>&nbsp;</p>
<?php
	
shuffle($villas_for_rent);//mostrar de forma aleatoria el resultado.
 
	                  foreach($villas_for_rent AS $d){  
				           ?>
									<!--RESPONSIVE VILLAS DETAILS START-->
									
									  <div class="row" >
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
										  <div class="panel panel-primary rcorners2">
											<div class="row padall">
											  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"> <span></span> 
											  <a   class="thumbnails"  href="../vacationrentals/villa-details.php?v=<?=$d['id']?>" target="_self" >
											  <img style="margin:5px;" class="img-responsive img-thumbnail" src="../booking/<?=$d['pic']?>" /></a> </div>
											  <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" >
												<div class="clearfix">
												
												  <div class="pull-right">
													<?=number_format($d['ft2'])?>
													SqFt |
													<?=$d['bed']?>
													Bdr |
													<?=$d['bath']?>
													Baths 
													|
													<?=($d['bed']*2)?>
													Adults max. 
													</div>
												</div>
												<div style="margin:5px;">
												<a href="../vacationrentals/villa-details.php?v=<?=$d['id']?>" target="_self" alt="">
												  <h4> Villa
													<?=$d['no']?> <?php
																$txt_class='';//empty when return
																		switch($d['classification']){
																	
																				case 1: //Premium
																					$txt_class='PREMIUM';
																					$txt_class_color='#333333';
																					break;
																				case 2: //Deluxe
																					$txt_class='DELUXE';
																					$txt_class_color='#333333';
																					break;
																				case 3: //standard
																					$txt_class='STANDARD';
																					$txt_class_color='#333333';
																					break;
																		}																		
																	?>																	
																	<span style="color:<?=$txt_class_color?>;font-weight:normal;margin-left:15px;"><?=$txt_class;?> <?php /*=$d['classification'];*/?></span>
												  </h4>
												  </a>
												 
												  
												 
												  <?=readmore_villas_tiny($d['head'],$d['id']);?>
												  <!--<a href="#"><span class="fa fa-search icon pull-right"> More</span></a>--> 
												</div>
												
												<div class="pull-right" style="margin-bottom:5px;">
												  <div class="row">
													<div class="col-xs-6 col-sm-4"> 
													  <!-- Large modal -->
													  <a   class="thumbnails"  href="../vacationrentals/villa-details.php?v=<?=$d['id']?>" target="_self" >
														<button type="button" name="continue" class="btn btn-primary pull-left">View villa</button>
														</a>
													</div>
													
													<div class="col-xs-6 col-sm-4">				
														
													</div>
												  </div>
												</div>
												<!--</div>--> 
											  </div>
											</div>
										  </div>
										</div>
									  </div>
					  <?}?>
									<!--RESPONSIVE VILLAS DETAILS END--> 
									<!-----------START PAGINATION---------------------->
									<!--<nav aria-label="Page navigation">
									  <ul class="pagination">
										<li>
										  <a href="#" aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
										  </a>
										</li>
										<li><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
										<li>
										  <a href="#" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
										  </a>
										</li>
									  </ul>
									</nav>-->
									<!-----------END PAGINATION------------------------>
				
 <!--PAGES CODE BELLOW-->
<?php
$nombre_script="view-rentals.php?b=".$_GET['b'];
$joiner_page="&";
?>
<!--
<nav aria-label="...">
  <ul class="pagination">
    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
    ...
  </ul>
</nav>-->

<nav aria-label="Page navigation">
<ul class="pagination">
										
    <!-- If the current page is more than 1, show the First and Previous links -->
    <?php if($paging_info['curr_page'] > 1) : ?>
        <li><a class="btn yellow" href='<?=$nombre_script?><?=$joiner_page?>pag=1' title='Page 1'>&laquo;</a>	</li>
        <!--<li><a class="btn blue" href='<?=$nombre_script?><?=$joiner_page?>pag=<?php echo ($paging_info['curr_page'] - 1); ?>' title='Previous page'><</a>	</li>-->
    <?php endif; ?>

    <?php
        //setup starting point
        //$max is equal to number of links shown
        $max = 7;
        if($paging_info['curr_page'] < $max)
            $sp = 1;
        elseif($paging_info['curr_page'] >= ($paging_info['pages'] - floor($max / 2)) )
            $sp = $paging_info['pages'] - $max + 1;
        elseif($paging_info['curr_page'] >= $max)
            $sp = $paging_info['curr_page']  - floor($max/2);
    ?>

    <!-- If the current page >= $max then show link to 1st page -->
    <?php if($paging_info['curr_page'] >= $max) : ?>

        <li><a class="btn blue btn-outline" href='<?=$nombre_script?><?=$joiner_page?>pag=1' title='Page 1'>1</a></li>
		<? if($paging_info['pages']>($max+1)){?>
		<li><a>..</a></li>
		<?}?>
    <?php endif; ?>

    <!-- Loop though max number of pages shown and show links either side equal to $max / 2 -->
    <?php for($i = $sp; $i <= ($sp + $max -1);$i++) : ?>

        <?php
            if($i > $paging_info['pages'])
                continue;
        ?>

        <?php if($paging_info['curr_page'] == $i) : ?>

           <li class="active"><span class="btn blue" style=""><?php echo $i; ?></span>	</li>

        <?php else : ?>

            <li><a class="btn blue btn-outline" href='<?=$nombre_script?><?=$joiner_page?>pag=<?php echo $i; ?>' title='Page <?php echo $i; ?>'><?php echo $i; ?></a>	</li>

        <?php endif; ?>

    <?php endfor; ?>


    <!-- If the current page is less than say the last page minus $max pages divided by 2-->
    <?php if($paging_info['curr_page'] < ($paging_info['pages'] - floor($max / 2))) : ?>
		<? if($paging_info['pages']>($max+1)){?>
		<li><a>..</a></li>
		<?}?>
        <li><a class="btn blue btn-outline" href='<?=$nombre_script?><?=$joiner_page?>pag=<?php echo $paging_info['pages']; ?>' title='Page <?php echo $paging_info['pages']; ?>'><?php echo $paging_info['pages']; ?></a>	</li>

    <?php endif; ?>

    <!-- Show last two pages if we're not near them -->
    <?php if($paging_info['curr_page'] < $paging_info['pages']) : ?>

        <!--<li><a class="btn blue" href='<?=$nombre_script?><?=$joiner_page?>pag=<?php echo ($paging_info['curr_page'] + 1); ?>' title='Next Page'>></a>	</li>-->

        <li><a class="btn yellow" href='<?=$nombre_script?><?=$joiner_page?>pag=<?php echo $paging_info['pages']; ?>' title='Last page'>&raquo;</a>	</li>

    <?php endif; ?>

	</ul>
</nav>					
									
</div>
			<!--content2Right -->
			
		</div>
		<!--row -->
	</div>
	<!--container -->
	
</div>
<!--main-wrapper -->
