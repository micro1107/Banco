<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bienvenida</title>
	<style>
		.b h1{
        padding-left: 300px;
        font-family: 'Lalezar', Arial;
        color:#0A1B40;
        font-size: 30px; 
    }
    .b .ini{
    	padding-left: 250px;
    }
	</style>
</head>
<body>
	<div class="b">
	<?php
	print "<h1>Bienvenido usuario ".$_SESSION['SES_USUARIO']." al Banco El Ahorro</h1>";
	?>
	<div class="ini">
		<img src="img/ini.png" alt="Imagen incio" width="90%" >
	</div>
	</div>
</body>
</html>