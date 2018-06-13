<?php
require_once('inc/session.php');
if ($_SESSION['info']){
require_once('init.php');
$data= new getQueries ();
$ticket=$data->singleTicket($ticketid=$_GET['t']);
$dep=departments();$options=tickets_subjects();
$username=$data->givemeUsername($ticket['userid']);
$villa=$data->villa_no($ticket['villa_id']);
	
$creatorby=$data->ticketHistory($ticket['id'],1);
$c_user=$data->givemeUsername($creatorby['userid']);

$processedby=$data->ticketHistory($ticket['id'],2);
$p_user=$data->givemeUsername($processedby['userid']);

$completedby=$data->ticketHistory($ticket['id'],3);
$co_user=$data->givemeUsername($completedby['userid']);

$cancelledby=$data->ticketHistory($ticket['id'],4);
$ca_user=$data->givemeUsername($cancelledby['userid']);

$changedby=$data->ticketHistory($ticket['id'],5);
$ch_user=$data->givemeUsername($changedby['userid']);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Sticky Footer Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="bootstrap-3.3.5/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<?php /* ?>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<?php */ ?>

    <!-- Begin page content -->
    <div class="container">
      <!--<div class="page-header">
        <h1>Sticky footer with fixed navbar</h1>
      </div>
      <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p>
      <p>Back to <a href="../sticky-footer">the default sticky footer</a> minus the navbar.</p>-->
   

	<div class="row" >
		<div class="col-xs-3  col-md-3 text-center">
			<div class="panel panel-primary">
			 <div class="panel-heading">Report Nr:</div>
			  <div class="panel-body">
				<?=$ticket['id']?>
			 </div>
			</div>
		</div>
		<div class="col-xs-3 col-md-3 text-center">
		<div class="panel panel-primary">
			 <div class="panel-heading">Subject:</div>
			  <div class="panel-body">
				<?=$options[$ticket['subject']]?>
			  </div>
		</div>
		</div>
		<div class="col-xs-3 col-md-3 text-center">
		<div class="panel panel-primary">
			 <div class="panel-heading">Department:</div>
			  <div class="panel-body">
				<?=$dep[$ticket['department']]?>
			   </div>
			</div>
		</div>
		<div class="col-xs-3 col-md-3 text-center">
		<div class="panel panel-primary">
			 <div class="panel-heading">Villa Nr:</div>
			  <div class="panel-body">
				<?=$villa?>
				</div>
		</div>
		</div>
	</div>
	<div class="row" >
	<div class="col-xs-4 col-md-4">
	<div class="panel panel-primary">
	  <div class="panel-heading">Status:</div>
	  <div class="panel-body">
		
		<?=tickets_status($ticket['status'])?>
	
	 </div>
	</div>
	</div>
	<div class="col-xs-8 col-md-8">
	<div class="panel panel-primary">
	  <div class="panel-heading">Details:</div>
	  <div class="panel-body">
		
		 <?=$ticket['details']?>
		
	 </div>
	</div>
	</div>
	</div>
<?php if($creatorby){?>	
	<div class="panel panel-primary">
	 <div class="panel-heading">Created</div>
	  <div class="panel-body">
		<div class="row">
		  <div class="col-xs-4 col-md-4"><strong>By:</strong> <?=$c_user?></div>
		  <div class="col-xs-8 col-md-8"><strong>On:</strong> <?=fechaLegible($creatorby['date']);?></div>
		</div>
	  </div>
	</div>
<?php }?>
<?php if($processedby){?>	
	<div class="panel panel-success">
	 <div class="panel-heading">Processed</div>
	  <div class="panel-body">
		<div class="row">
		<?php if($processedby['etc']!=0){?>
		  <div class="col-xs-3 col-md-3"><strong>By:</strong> <?=$p_user?></div>
		  <div class="col-xs-3 col-md-3"><strong>On:</strong> <?=fechaLegible($processedby['date']);?></div>
		   <div class="col-xs-3 col-md-3"><strong>Assigned to:</strong> <?=$processedby['notereasondelegate'];?></div>
		   <div class="col-xs-3 col-md-3"><strong>ETC:</strong> <?php $timeestimated=time2string($endtime=$processedby['etc'], $starttime=$processedby['date']);?> <?=fechaLegible($processedby['etc']); /*echo  $timeestimated; */?></div>
		<?php }else{?>
		   <div class="col-xs-4 col-md-4"><strong>By:</strong> <?=$p_user?></div>
		   <div class="col-xs-4 col-md-4"><strong>On:</strong> <?=fechaLegible($processedby['date']);?></div>
		   <div class="col-xs-4 col-md-4"><strong>Assigned to:</strong> <?=$processedby['notereasondelegate'];?></div>
		<?php	
		}?>
		</div>
	  </div>
	</div>	
<?php }?>
<?php if($completedby){?>	
	<div class="panel panel-info">
	 <div class="panel-heading">Completed</div>
	  <div class="panel-body">
		<div class="row">
		  <div class="col-xs-4 col-md-4"><strong>By:</strong> <?=$co_user?></div>
		  <div class="col-xs-4 col-md-4"><strong>On:</strong> <?=fechaLegible($completedby['date']);?></div>
		   <div class="col-xs-4 col-md-4"><strong>Note:</strong> <?=$completedby['notereasondelegate'];?></div>
		</div>
	  </div>
	</div>		
<?php }?>
<?php if($cancelledby){?>		
	<div class="panel panel-warning">
	 <div class="panel-heading">Cancelled</div>
	  <div class="panel-body">
		<div class="row">
		  <div class="col-xs-4 col-md-4"><strong>By:</strong> <?=$ca_user?></div>
		  <div class="col-xs-4 col-md-4"><strong>On:</strong> <?=fechaLegible($cancelledby['date']);?></div>
		   <div class="col-xs-4 col-md-4"><strong>Reason:</strong> <?=$cancelledby['notereasondelegate'];?></div>
		</div>
	  </div>
	</div>	
<?php }?>
<?php if($changedby){?>	
	<div class="panel panel-danger">
	 <div class="panel-heading">Changed</div>
	  <div class="panel-body">
		<div class="row">
		  <div class="col-xs-4 col-md-4"><strong>By:</strong> <?=$ch_user?></div>
		  <div class="col-xs-8 col-md-8"><strong>On:</strong> <?=fechaLegible($changedby['date']);?></div>
		  <!--<div class="col-xs-4 col-md-4"><strong>Note:</strong> </div>-->
		</div>
	  </div>
	</div>		
<?php }?>	
	
	
	
	
	


	
	
	
	
	 <!-- <div class="row">
	  <div class="col-xs-8 col-md-8"><strong>Future stuff</strong></div>
	  <div class="col-xs-4 col-md-4"><strong>New Comment</strong></div>
	</div>-->

   </div>

    <!-- <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src=".bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap-3.3.5/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<?php }?>