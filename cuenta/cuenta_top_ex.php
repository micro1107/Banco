<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_Personal_usuarios.xls");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TOP CUENTAS</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" bgcolor="#CCE5FF"><CENTER><strong>TOP CUENTAS CON MAS DINERO</strong></CENTER></td>
  </tr>
  <tr bgcolor="#276EFF">
    <td>TOP</td><td>ID_CUENTA</td><td>TIPO</td><td>TITULAR</td><td>ESTADO</td><td>SALDO</td><td>SUCURSAL</td><td>FECHA_CREACION</td>
  </tr>
  
<?PHP
		
		include("../lib/config.php");
        include("../lib/mysql_lib.php");
		require_once("../lib/cuenta.php");

		$c = new Cuenta();
                $c->listarTop();
                $result = $c->lista;
                $top = 1;

while($row=mysql_fetch_array($result)){		

  switch ($row['tipo']) {
                        case 'A':
                            $tipo = "Ahorros";
                            break;
                        case 'C':
                            $tipo = "Corriente";
                            break;
                    }
                    switch ($row['estado']) {
                        case 'A':
                            $estado = "Activa";
                            break;
                        case 'B':
                            $estado = "Bloqueada";
                            break;    
                    }

	$id_cuenta=$row['id_cuenta'];
	$person=$row['person'];
  $saldo = $row['saldo'];
	$sucursal = $row['nombre'];
  $fecha_crea = $row['fecha_crea'];
?>  
 <tr>
	<td><?php echo $top; ?></td>
	<td><?php echo $id_cuenta; ?></td>
	<td><?php echo $tipo; ?></td>
	<td><?php echo $person; ?></td>
  <td><?php echo $estado; ?></td>
  <td><?php echo $saldo; ?></td>
  <td><?php echo $sucursal; ?></td>   
  <td><?php echo $fecha_crea; ?></td>             
 </tr> 
  <?php
  $top = $top + 1;
}
  ?>
</table>
</body>
</html>