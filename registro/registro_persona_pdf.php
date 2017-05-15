<?php
        include("../lib/config.php");
        include("../lib/mysql_lib.php");
        require_once("../lib/dompdf/dompdf_config.inc.php");
        include("../lib/registro.php");
        include("../lib/cliente.php");

        $p = new Cliente();
        $p->consultar($_GET['documento']);

$codigoHTML='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
<title>Registro Transacciones PDF</title>
<style>

</style>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" bgcolor="#CCE5FF"><CENTER><strong>Historial de Transacciones de '.$p->getNombre().'</strong></CENTER></td>
  </tr>
  <tr bgcolor="#276EFF">
    <td>ID_REGISTRO</td><td>ID_CUENTA</td><td>TRANSACCION</td><td>TITULAR</td><td>MONTO</td><td>FECHA</td>
  </tr>';
            
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
    $codigoHTML.='
    <tr>
        <td>'.$row['id_registro'].'</td>
        <td>'.$row['id_cuenta'].'</td>
        <td>'.$tipo.'</td>
        <td>'.$row['nombre'].'</td>
        <td>'.$row['cantidad'].'</td>
        <td>'.$row['fecha'].'</td>
    </tr>';
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
$dompdf->stream("Registro_transacciones.pdf");
?>