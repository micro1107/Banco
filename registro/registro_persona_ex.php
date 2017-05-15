<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_Personal_usuarios.xls");
        
        include("../lib/config.php");
        include("../lib/mysql_lib.php");
        include("../lib/registro.php");
        include("../lib/cliente.php");

        $p = new Cliente();
        $p->consultar($_GET['documento']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Transacciones</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
  <?php
    print "<td colspan=6 bgcolor=#CCE5FF><CENTER><strong>Registro Transacciones de ".$p->getNombre()." </strong></CENTER></td>"
    ?>
  </tr>
  <tr bgcolor="#276EFF">
    <td>ID_REGISTRO</td><td>ID_CUENTA</td><td>TRANSACCION</td><td>TITULAR</td><td>MONTO</td><td>FECHA</td>
  </tr>
  
<?PHP
		            
                $r = new Registro();
                $r->listarMovimientosPersona($_GET['documento']);
                $result = $r->lista;

while($row=mysql_fetch_array($result)){		

  switch ($row['id_transaccion']) {
                        case '1':
                            $tipo = "Consignacion";
                            break;
                        case '2':
                            $tipo = "Retiro";
                            break;
                        case '3':
                            $tipo = "Transferencia";
                            break;
                        case '4':
                            $tipo = "Sobregiro";
                            break;
                    }

	$id_registro=$row['id_registro'];
	$id_cuenta=$row['id_cuenta'];
  $cantidad = $row['cantidad'];
	$nombre = $row['nombre'];
  $fecha = $row['fecha'];
?>  
 <tr>
	<td><?php echo $id_registro; ?></td>
	<td><?php echo $id_cuenta; ?></td>
	<td><?php echo $tipo; ?></td>
	<td><?php echo $nombre; ?></td>
  <td><?php echo $cantidad; ?></td>
  <td><?php echo $fecha; ?></td>            
 </tr> 
  <?php
}
  ?>
</table>
</body>
</html>