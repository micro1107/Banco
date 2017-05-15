<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title>
    <link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
    <style>
        h1{
        padding-left: 100px;
        font-family: 'Lalezar', Arial;
        color:#0A1B40;
        font-size: 30px; 
    }
    form{
        padding-left: 100px;
    }
    </style>
</head>
<body>
	<form enctype="multipart/form-data" action="lib/uploader.php" method="POST">
	<input name="uploadedfile" type="file" />
	<input type="submit" value="Subir archivo" />
</form>
</body>
</html>