<!DOCTYPE html>
<html>
<head>
	<title>PHP - Multiple Image upload using dropzone.js</title>
	<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
	<link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>PHP - Multiple Image upload using dropzone.js</h2>
			<form action="upload.php" enctype="multipart/form-data" method="POST">
				<div>
					<h3>Upload Multiple Image By Click On Box</h3>
				</div>
				<input type="file" name="files" multiple/>
				<input type="submit"/>
			</form>
		</div>
	</div>
</div>


</body>
</html>