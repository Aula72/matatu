<!DOCTYPE html>

<head>
<title>Upload</title>
</head>

<body>

<form action="/apis/upload.php" method="post" enctype="multipart/form-data">
<label for="file"><span>Filename:</span></label>
<input type="file" name="fileToUpload" id="fileToUpload" /> 
<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>