<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_Personal_usuarios.xls");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TOP SUCURSALES</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>TOP SUCURSALES CON MAS FLUJO DE DINERO</strong></CENTER></td>
  </tr>
  <tr bgcolor="red">
    <td><strong>TOP</strong></td>
    <td><strong>CIUDAD</strong></td>
    <td><strong>NOMBRE</strong></td>
    <td><strong>TOTAL</strong></td>
  </tr>
  
<?PHP
		
		include("../lib/config.php");
        include("../lib/mysql_lib.php");
		require_once("../lib/cuenta.php");

		$c = new Cuenta();
                $c->listarTopSucursal();
                $result = $c->lista;
                $top = 1;

while($row=mysql_fetch_array($result)){		

	$ciudad=$row["ciudad"];
	$nombre=$row["nombre"];
	$total=$row["total"];
				
?>  
 <tr>
	<td><?php echo $top; ?></td>
	<td><?php echo $ciudad; ?></td>
	<td><?php echo $nombre; ?></td>
	<td><?php echo $total; ?></td>                   
 </tr> 
  <?php
  $top = $top + 1;
}
  ?>
</table>
</body>
</html>