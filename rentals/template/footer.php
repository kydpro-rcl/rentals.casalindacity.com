<?php if($_GET['back']==1){ $var_base='../';}?>

<!-- =========================
  FOOTER 
============================== -->
<footer class="footer" id="footer">
    <div id="footer-bottom">
		<div class="container pt-50 pb-30">
		
			<div class="footer-social mb-20" >
				<a href="https://www.facebook.com/CasaLindaDR" class="facebook-color wow fadeInUp" data-wow-offset="50" data-wow-delay="0s"><i class="fa fa-facebook"></i></a>
				<a href="https://twitter.com/casa_linda_city" class="twitter-color wow fadeInUp" data-wow-offset="50" data-wow-delay="0.3s"><i class="fa fa-twitter"></i></a>
				<a href="https://instagram.com/casalindacity/" class="instagram-color wow fadeInUp" data-wow-offset="50" data-wow-delay="0.3s"><i class="fa fa-instagram"></i></a>
				<!--<a href="https://www.pinterest.com/rz2820/casa-linda/" class="pinterest-color wow fadeInUp" data-wow-offset="50" data-wow-delay="0.6s"><i class="fa fa-pinterest"></i></a>
				<a href="https://www.flickr.com/people/residencialcasalinda/" class="pinterest-color wow fadeInUp" data-wow-offset="50" data-wow-delay="1.2s"><i class="fa fa-flickr"></i></a>-->
				<a href="https://plus.google.com/u/1/b/110383690153148939736/+ResidencialCasaLindaSos%C3%BAa/posts" class="google-plus-color wow fadeInUp" data-wow-offset="50" data-wow-delay="1.5s"><i class="fa fa-google-plus"></i></a>
			</div>
			
			<ul class="inline-menu mb-20">
				<li><a href="../vacationrentals/index.php">Home</a></li>
				<li><a href="../vacationrentals/faq.php">FAQ</a></li>
				<li><a href="../vacationrentals/terms-conditions.php" target="_blank">Terms and Conditions</a></li>
			</ul>
			
			<p class="text-center">Copyright &#169; <?=date('Y');?> RCL Residencial Casa Linda. All rights reserved worldwide.</p>
		</div>
	</div>
</footer>
<!-- /END FOOTER -->

<div id="back-to-top">
   <a href="#">Back to Top</a>
</div>

<!-- SCRIPTS -->

<script type="text/javascript" src="<?=$var_base?>js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?=$var_base?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$var_base?>js/device.min.js"></script>
<script type="text/javascript" src="<?=$var_base?>js/plugins.js"></script>
<script type="text/javascript" src="<?=$var_base?>js/jquery.customSelect.js"></script>
<script type="text/javascript" src="<?=$var_base?>js/customs.js"></script>   

<script type="text/javascript" src="<?=$var_base?>js/bootstrap-datepicker.js"></script>   
	<script>
	if (top.location != location) {
    top.location.href = document.location.href ;
  }
		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp1').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('#dp2').datepicker();
			$('#dp3').datepicker();
			$('#dp3').datepicker();
			$('#dpYears').datepicker();
			$('#dpMonths').datepicker();
			
			
			var startDate = new Date(2012,1,20);
			var endDate = new Date(2012,1,25);
			$('#dp4').datepicker()
				.on('changeDate', function(ev){
					if (ev.date.valueOf() > endDate.valueOf()){
						$('#alert').show().find('strong').text('The start date can not be greater then the end date');
					} else {
						$('#alert').hide();
						startDate = new Date(ev.date);
						$('#startDate').text($('#dp4').data('date'));
					}
					$('#dp4').datepicker('hide');
				});
			$('#dp5').datepicker()
				.on('changeDate', function(ev){
					if (ev.date.valueOf() < startDate.valueOf()){
						$('#alert').show().find('strong').text('The end date can not be less then the start date');
					} else {
						$('#alert').hide();
						endDate = new Date(ev.date);
						$('#endDate').text($('#dp5').data('date'));
					}
					$('#dp5').datepicker('hide');
				});

        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
		});
	</script>
</body>

<!-- SCRIPTS -->
<script src="js/ekko-lightbox.js"></script>
		<script type="text/javascript">
			$(document).ready(function ($) {

				// delegate calls to data-toggle="lightbox"
				$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
					event.preventDefault();
					return $(this).ekkoLightbox({
						always_show_close: true
					});
				});

			});
		</script>

		
		<!-- SCRIPTS BOOTSTRAP GALLERY -->
		<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

        <script src="bootstrap-gallery/js/vendor/bootstrap.min.js"></script>
        <script src="bootstrap-gallery/js/plugins.js"></script>
        <script src="bootstrap-gallery/js/jquery.prettyPhoto.js"></script>
        <script src="bootstrap-gallery/js/main.js"></script>

        <script>           
            // Colorbox Call

            $(document).ready(function(){
                $("[rel^='lightbox']").prettyPhoto();
            });
        </script>
</html>