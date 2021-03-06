<?php
session_start();
if (!$_SESSION['info']){ die('Restrinted access...'); }

$_SESSION['villaid']=$_GET['id'];

if($_GET['id']){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload pictures for villa id <?=$_GET['id']?></title>
	<script src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/bootstrap-3.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>
<body>

<div class="container">
<img src="images/logo.png" alt=""/>
<?php include_once('menu.php'); ?>

	<div class="row">
		<div class="col-md-12">
			<h2>Uploading pictures for villa id <?=$_GET['id']?></h2>
			<form action="upload.php" enctype="multipart/form-data" class="dropzone" id="image-upload">
				<div>
					<h6>Upload Multiple Image By Click On Box or drag and drop inside square</h6>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	Dropzone.options.imageUpload = {
        maxFilesize:1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF"
    };
</script>

</body>
</html>

<?php
}else{
	echo "Error: missing villa id";
}
?>