<?php
require_once('../../inc/session.php');
if (!$_SESSION['info']){
	//header('Location:login.php');
	die('Restricted area...');
}
require_once('../../init.php');

//echo $_POST['lat'];
//echo "<br/>";
//echo $_POST['lon'];
if($_POST){
	 $db= new subDB();
	if($_POST['locationid']!=''){
		$fields2=array(	'villaid'=>$_POST['villa'],
						'locationName'=>$_POST['location'],
						'latitude'=>$_POST['lat'],
						'logitude'=>$_POST['lon'],
						'date'=>time()
					);
		$table2='villas_location';
		$db->update($_POST['locationid'], $fields2, $table2);
		$alerta="<div class=\"alert alert-success\" role=\"alert\">Well done! You successfully updated the location for this villa.</div>";
	}else{
		$fields2=array(	'villaid'=>$_POST['villa'],
						'locationName'=>$_POST['location'],
						'latitude'=>$_POST['lat'],
						'logitude'=>$_POST['lon'],
						'date'=>time()
					);
		$table2='villas_location';
		$db->insert_id($fields2, $table2);
		$alerta="<div class=\"alert alert-info\" role=\"alert\">Well done! You successfully created the location for this villa.</div>";
	}
}

if($_GET['id']!=''){
	$db= new getQueries();
	$villas=$db->show_id('villas', $_GET['id']);$v=$villas[0];
	if(!$v){die('error: villa no found');}
	$loc=$db->location($v['id']);
	
}else{
	die('Error: no villa id provided...');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap stuff -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <!-- -->

    <!-- Location picker -->
    <!--<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>-->
	<!-- api key -->
			<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCcoICy5v6Bv4_NG2SdYRFOt5mWAbHY28o"></script>

    <script src="../dist/locationpicker.jquery.js"></script>
    <title>jquery-location-picker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div id="examples">
            <p>
                <h3>Providing location for villa <?=$v['no']?></h3>
				<?=$alerta?>
                <p>Result:</p>

                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Location:</label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="us2-address" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Radius:</label>

                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="us2-radius" />
                        </div>
                    </div>
                    <div id="us2" style="width: 100%; height: 600px;"></div>
                    <div class="clearfix">&nbsp;</div>
					<form method="post" action="">
                    <div class="m-t-small">
                        <label class="p-r-small col-sm-1 control-label">Lat.:</label>

                        <div class="col-sm-1">
                            <input type="text" class="form-control" style="width: 110px" id="us2-lat" name="lat" />
                        </div>
                        <label class="p-r-small col-sm-1 control-label">Long.:</label>

                        <div class="col-sm-1">
                            <input type="text" class="form-control" style="width: 110px" id="us2-lon" name="lon"/>
                        </div>
						
                    </div>
					 <div class="clearfix"></div>
						<p style="text-align:right;">
						<input type="hidden" name="location" value="Villa <?=$v['no']?>"/>
						<input type="hidden" name="villa" value="<?=$v['id']?>"/>
						<input type="hidden" name="locationid" value="<?=$loc['id']?>"/>
							<button type="submit" name="submit" class="btn btn-primary">Guardar o Actualizar</button>
						</p>
					</form>
                    <div class="clearfix"></div>
                </div>
				<?php
				if(!$loc){?>
                <script>
                    $('#us2').locationpicker({
                        location: {
                            latitude: 19.7720039,
                            longitude: -70.49161240000001
                        },
						locationName: "Villa 15",
                        radius: 15,
						zoom: 17,
                        inputBinding: {
                            latitudeInput: $('#us2-lat'),
                            longitudeInput: $('#us2-lon'),
                            radiusInput: $('#us2-radius'),
                            locationNameInput: $('#us2-address')
                        },
						mapTypeId: google.maps.MapTypeId.SATELLITE,/*remove this line to show streets*/
                        enableAutocomplete: true
                    });
                </script>
				<?php }else{?>
				<script>
                    $('#us2').locationpicker({
                        location: {
                            latitude: <?=$loc['latitude']?>,
                            longitude: <?=$loc['logitude']?>
                        },
						locationName: " <?=$loc['locationName']?>",
                        radius: 15,
						zoom: 17,
                        inputBinding: {
                            latitudeInput: $('#us2-lat'),
                            longitudeInput: $('#us2-lon'),
                            radiusInput: $('#us2-radius'),
                            locationNameInput: $('#us2-address')
                        },
						mapTypeId: google.maps.MapTypeId.SATELLITE,/*remove this line to show streets*/
                        enableAutocomplete: true
                    });
                </script>
				<?}?>
 

                <!--<div>
                    <h2 class="page-header" id="credits">Credits</h2> Dmitry Berezovsky, Logicify (<a href="http://logicify.com/" target="_blank">http://logicify.com/</a>)
                </div>-->

        </div>
        <footer>
            <p ><a href="http://kydpro.com/" target="_blank">www.kydpro.com</a></p>

            <!--<p><a href="http://logicify.com/" target="_blank">Logicify</a></p>-->
        </footer>
    </div>
</body>

</html>
