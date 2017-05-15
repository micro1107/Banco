<?php
		include("../lib/config.php");
        include("../lib/mysql_lib.php");
		require_once("../lib/dompdf/dompdf_config.inc.php");
		require_once("../lib/cuenta.php");

$codigoHTML='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
<title>Documento sin título</title>
<style>

</style>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" bgcolor="#CCE5FF"><CENTER><strong>TOP SUCURSALES CON MAS FLUJO DE DINERO</strong></CENTER></td>
  </tr>
  <tr bgcolor="#276EFF">
    <td><strong>TOP</strong></td>
    <td><strong>CIUDAD</strong></td>
    <td><strong>NOMBRE</strong></td>
    <td><strong>TOTAL</strong></td>
  </tr>';
  	
				$c = new Cuenta();
                $c->listarTopSucursal();
                $result = $c->lista;
                $top = 1;

                
while($row=mysql_fetch_array($result)){
	$codigoHTML.='
	<tr>
		<td>'.$top.'</td>
		<td>'.$row['ciudad'].'</td>
		<td>'.$row['nombre'].'</td>
		<td>'.$row['total'].'</td>
	</tr>';
	$top = $top + 1;
}
$codigoHTML.='
</table>
</body>
</html>';
$codigoHTML=utf8_encode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Top_sucursales.pdf");
?>