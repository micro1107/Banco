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
<title>CUENTAS CON MAS DINERO PDF</title>
<style>

</style>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="8" bgcolor="#CCE5FF"><CENTER><strong>TOP CUENTAS CON MAS DINERO</strong></CENTER></td>
  </tr>
  <tr bgcolor="#276EFF">
    <td>TOP</td><td>ID_CUENTA</td><td>TIPO</td><td>TITULAR</td><td>ESTADO</td><td>SALDO</td><td>SUCURSAL</td><td>FECHA_CREACION</td>
  </tr>';
    
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
    $codigoHTML.='
    <tr>
        <td>'.$top.'</td>
        <td>'.$row['id_cuenta'].'</td>
        <td>'.$tipo.'</td>
        <td>'.$row['person'].'</td>
        <td>'.$estado.'</td>
        <td>'.$row['saldo'].'</td>
        <td>'.$row['nombre'].'</td>
        <td>'.$row['fecha_crea'].'</td>
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
$dompdf->stream("Top_cuentas.pdf");
?>