<!DOCTYPE html>

<head>
<title>Upload</title>
</head>

<body>

<form action="/apis/upload.php" method="post" enctype="multipart/form-data">
<label for="file"><span>Filename:</span></label>
<input type="file" name="the_file" id="the_file" /> 
<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>