<div class="main-wrapper">
	
	<div class="container">
		<div class="row breadcrumb-wrapper">
			<div class="col-xs-12">
				<ol class="breadcrumb">
					<li>
						<a href="index.php">Home</a>
					</li>
					<li>
						Company and Contact Information
					</li>
				</ol>
			</div>
		</div>
		<div class="row main-content-row">
			
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
			
				<h1 id="ctf-cnt-h1">Company and Contact Information</h1>
				
				<div class="row ctf-ctn-info-row">

					<div class="col-sm-6 ctf-ctn-info-item">
						<strong>RCL ADMINISTRACIONES, SRL</strong><br>
						Carretera Sosua-Cabarete,  Entrada el Choco <br>
						Sosua Puerto Plata - Dominican Republic 57000
					</div>
					<div class="col-sm-6 ctf-ctn-info-item">
						
							 <strong>Tel: </strong> +1.809.571.1190 <br>
							 <strong>Email:</strong> reservations@casalindacity.com
						
					</div>
				</div>
				
				<!-- contact information: company profile -->
				<p>
					
				</p>
				
				
					
					<!-- Contact Us: Request Information Instructions -->
					<p><?php if (isset($_GET['success'])){?> <div class="alert alert-info" role="alert"><?=$_GET['success']?></div> <?php } ?></p>

					<hr class="horizontal-rule-1">

					

					<div class="row">
						<div class="col-lg-12">
							<form method="POST" name="OptionForm" action="" class="form-horizontal" role="form" >
								<!--<input type="hidden" name="complete" value="yes">
								<input type="hidden" name="NavisHiddenKeyword" id="NavisHiddenKeyword" value="">
								<input type="text" name="checkform" value="" id="checkform" style="display: none;">-->


								<div class="form-group">
									<label for="FirstName" class="col-sm-4 col-md-3 col-lg-3 control-label">First Name <span class="ctf-cnt-rqrd">*</span></label>
									<div class="col-sm-8 col-md-7 col-lg-5">
									  <input type="text" name="FirstName" class="form-control input-sm" required placeholder="First Name" size="30" value=""> 
									</div>
								</div>

								<div class="form-group">
									<label for="LastName" class="col-sm-4 col-md-3 col-lg-3 control-label">Last Name <span class="ctf-cnt-rqrd">*</span></label>
									<div class="col-sm-8 col-md-7 col-lg-5">
									  <input type="text" name="LastName" class="form-control input-sm" required placeholder="Last Name" size="30" value=""> 
									</div>
								</div>
								
								<div class="form-group">
									<label for="Email" class="col-sm-4 col-md-3 col-lg-3 control-label">Email Address <span class="ctf-cnt-rqrd">*</span></label>
									<div class="col-sm-8 col-md-7 col-lg-5">
									  <input type="email" name="Email2" class="form-control input-sm" required placeholder="Email Address" size="35" value=""> 
									</div>
								</div>
								
								<div class="form-group" id="email-div">
									<label for="Email" class="col-sm-4 col-md-3 col-lg-3 control-label">Email Address<span class="ctf-cnt-rqrd">*</span></label>
									<div class="col-sm-8 col-md-7 col-lg-5">
									  <input type="email" name="Email" class="form-control input-sm" placeholder="Email Address" size="35"> 
									</div>
								</div>
								
								<div class="form-group">
									<label for="Phone" class="col-sm-4 col-md-3 col-lg-3 control-label">Phone <span class="ctf-cnt-rqrd">*</span></label>
									<div class="col-sm-8 col-md-7 col-lg-5">
									  <input type="phone" name="Phone" class="form-control input-sm" required placeholder="Phone Number" size="30" value=""> 
									</div>
								</div>
								
								<div class="form-group">
									<label for="Comments" class="col-sm-4 col-md-3 col-lg-3 control-label">Comments <span class="ctf-cnt-rqrd">*</span></label>
									<div class="col-sm-8 col-md-7 col-lg-5">
										<textarea name="Comments" class="form-control required input-sm" maxlength="1000" style="height: 100px" wrap="physical" required></textarea>
									</div>
								</div>

								<!--<div class="form-group">
									<div class="col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-3 col-lg-5 col-lg-offset-3">
										<input type="checkbox" name="MailingList" value="Yes" >Please send me your Information by Mail (If Available).
									</div>
								</div>
								
								<div class="form-group">
									<label for="Address1" class="col-sm-4 col-md-3 col-lg-3 control-label">Mailing address (line 1)</label>
									<div class="col-sm-8 col-md-7 col-lg-5">
									  <input type="text" name="Address1" class="form-control input-sm" placeholder="Mail Address (line 1)" size="55" value=""> 
									</div>
								</div>
							   
								<div class="form-group">
									<label for="Address2" class="col-sm-4 col-md-3 col-lg-3 control-label">Mailing address (line 2)</label>
									<div class="col-sm-8 col-md-7 col-lg-5">
									  <input type="text" name="Address2" class="form-control input-sm" placeholder="Mail Address (line 2)" size="55" value=""> 
									</div>
								</div>
								
								<div class="form-group">
									<label for="City" class="col-sm-4 col-md-3 col-lg-3 control-label">City</label>
									<div class="col-sm-8 col-md-7 col-lg-5">
									  <input type="text" name="City" class="form-control input-sm" placeholder="City" size="30" value=""> 
									</div>
								</div>
								
								<div class="form-group">
									<label for="State" class="col-sm-4 col-md-3 col-lg-3 control-label">State/Province</label>
									<div class="col-sm-8 col-md-7 col-lg-3">
									  <input type="text" name="State" class="form-control input-sm" placeholder="State / Province" size="10" value=""> 
									</div>
								</div>
								
								<div class="form-group">
									<label for="Zip" class="col-sm-4 col-md-3 col-lg-3 control-label">Zip</label>
									<div class="col-sm-8 col-md-7 col-lg-2">
									  <input type="text" name="Zip" class="form-control input-sm" placeholder="Zip Code" size="10" value=""> 
									</div>
								</div>
								
								<div class="form-group">
									<label for="Country" class="col-sm-4 col-md-3 col-lg-3 control-label">Country (If Not USA)</label>
									<div class="col-sm-8 col-md-7 col-lg-5">
									  <input type="text" name="Country" class="form-control input-sm" placeholder="Country" size="15" value=""> 
									</div>
								</div>-->
								
								
								<!--<div class="form-group">
									<label for="HowHeard" class="col-sm-4 col-md-3 col-lg-3 control-label">How did you hear about us? <span class="ctf-cnt-rqrd">*</span></label>
									<div class="col-sm-8 col-md-7 col-lg-5">
										
<script language="JavaScript1.2" type="text/javascript">

function ReferralChangeMenu() {
menuNum = document.OptionForm.HowHeard.selectedIndex;
if (menuNum == null) return;
if (menuNum == 0) {
  NewOpt = new Array;
  NewOpt[0] = new Option('-');
  NewOpt[0].value = '0';
 }

if (menuNum == 1) {

 NewOpt = new Array;
 NewOpt[0] = new Option('Which Search Engine');
 NewOpt[0].value = '';
 

 NewOpt[1] = new Option('','');

 NewOpt[2] = new Option('Alta Vista','Alta Vista');

 NewOpt[3] = new Option('Another Search Engine','Another Search Engine');

 NewOpt[4] = new Option('AOL','AOL');

 NewOpt[5] = new Option('Ask Jeeves','Ask Jeeves');

 NewOpt[6] = new Option('Comcast','Comcast');

 NewOpt[7] = new Option('Dogpile','Dogpile');

 NewOpt[8] = new Option('Expedia','Expedia');

 NewOpt[9] = new Option('Google','Google');

 NewOpt[10] = new Option('MSN','MSN');

 NewOpt[11] = new Option('SBC','SBC');

 NewOpt[12] = new Option('Yahoo','Yahoo');

 NewOpt[13] = new Option('Another Search Engine','Another Search Engine');
 

}

if (menuNum == 2) {

 NewOpt = new Array;
 NewOpt[0] = new Option('Which Website');
 NewOpt[0].value = '';
 

 NewOpt[1] = new Option('','');

 NewOpt[2] = new Option('a1vacations.com','a1vacations.com');

 NewOpt[3] = new Option('airbnb.com','airbnb.com');

 NewOpt[4] = new Option('Another Website','Another Website');

 NewOpt[5] = new Option('cyberrentals.com','cyberrentals.com');

 NewOpt[6] = new Option('expedia.com','expedia.com');

 NewOpt[7] = new Option('flipkey.com','flipkey.com');

 NewOpt[8] = new Option('GreatRentals.com','GreatRentals.com');

 NewOpt[9] = new Option('rentalo.com','rentalo.com');

 NewOpt[10] = new Option('triphomes.com','triphomes.com');

 NewOpt[11] = new Option('vacationhomes.com','vacationhomes.com');

 NewOpt[12] = new Option('vacationrentals.com','vacationrentals.com');

 NewOpt[13] = new Option('vrbo.net','vrbo.net');

 NewOpt[14] = new Option('Another Website','Another Website');
 

}

if (menuNum == 3) {

 NewOpt = new Array;
 NewOpt[0] = new Option('Which Another Source');
 NewOpt[0].value = '';
 

 NewOpt[1] = new Option('','');

 NewOpt[2] = new Option('AAA','AAA');

 NewOpt[3] = new Option('Another Source','Another Source');

 NewOpt[4] = new Option('Guidebook','Guidebook');

 NewOpt[5] = new Option('Print Advertisement','Print Advertisement');

 NewOpt[6] = new Option('Radio Commercial','Radio Commercial');

 NewOpt[7] = new Option('Travel Agent','Travel Agent');

 NewOpt[8] = new Option('TV Commercial','TV Commercial');

 NewOpt[9] = new Option('Another Another Source','Another Another Source');
 

}

if (menuNum == 4) {
  NewOpt = new Array;
  NewOpt[0] = new Option('-');
  NewOpt[0].value = '0';
 }

if (menuNum == 5) {
  NewOpt = new Array;
  NewOpt[0] = new Option('-');
  NewOpt[0].value = '0';
 }

var formObj =  document.OptionForm.HowHeardvalues;
HowHeardropdown = formObj.options.length;
// remove all items in dropdown before adding new ones
for (i = HowHeardropdown; i > 0; i--) {
    formObj.options[i] = null;
}
for (i=0; i < NewOpt.length; i++) {
    formObj.options[i] = NewOpt[i];
}

}
</script>

<div class="row">	
    <div class="col-sm-6">	
        <select name="HowHeard" onchange="return ReferralChangeMenu();" required class="form-control input-sm" id="HowHeardDDL">
            <option value="">Please Select One
            
            <option value="Search Engine" >Search Engine
            <option value="Website" >Website
            <option value="Another Source" >Another Source
            <option value="Friend" >Friend
            
            <option value="Past Guest" >Past Guest
            
        </select>
    </div>
    <div class="col-sm-6">
        <select class="form-control input-sm" name="HowHeardvalues">
            <option value="0">-
        </select>
    </div>
</div>

									</div>
								</div>-->
										   
								<div class="form-group">
									<div class="col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-3 col-lg-5 col-lg-offset-3">
										<input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR']?>"/>
										<input type="submit" value="Submit Information" class="btn btn-primary">
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-3 col-lg-5 col-lg-offset-3">
										<span class="ctf-cnt-rqrd">*</span> Required Fields
									</div>
								</div>
								
							</form>
						</div>
					</div>
					
					
			</div>
			<!--content2Right -->
			
		</div>
		<!--row -->
	</div>
	<!--container -->
	
</div>
<!--main-wrapper -->