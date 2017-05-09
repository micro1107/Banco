<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
	<title></title>
    <style>
     /*LISTAR*/

    .titulo td{
    font-family: 'Lalezar', Arial;
    font-size: 15px;
    background: #CCE5FF;
    text-align: center;
    }

    td{
    font-family:  Arial;
    font-size: 11px;
    text-align: center;
    }

    .botonNuevo {
    float: right;
    }

    .tabla tr,td  {
    border-collapse: separate;
    border-spacing:  3px;
    border-style: none;
    }   
    form{
        padding-left:200px;
    }
    
    h1{
        padding-left: 100px;
        font-family: 'Lalezar', Arial;
        color:#0A1B40;
        font-size: 30px; 
    }

    </style>
</head>
<body>
    <h1>Top 10 Cuentas</h1>
	<form name="index" action="index.php?sel=PDF1">
        <table border="1" class="tabla">
            <tr class="titulo">
            <td>TOP</td><td>ID_CUENTA</td><td>TIPO</td><td>TITULAR</td><td>ESTADO</td><td>SALDO</td><td>SUCURSAL</td><td>FECHA_CREACIÓN</td>
            </tr>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/cuenta.php");
                
                
                $c = new Cuenta();
                $c->listarTop();
                $result = $c->lista;
                $top = 1;

                if ($top < 10){

                while ($row = mysql_fetch_array($result)) {

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

                    print "<tr>";
                    print "<td>".$top."</td>";
                    print "<td>".$row['id_cuenta']."</td>";
                    print "<td>".$tipo."</td>";
                    print "<td>".$row['person']."</td>";
                    print "<td>".$estado."</td>";
                    print "<td>".$row['saldo']."</td>";
                    print "<td>".$row['nombre']."</td>";
                    print "<td>".$row['fecha_crea']."</td>";
                    print "</tr>";
                    $top = $top + 1;
                    } 
                }
            ?>
            <tr><td colspan="7"><input name="btnInsertar" type="button" class="botonNuevo" value="Imprimir" onclick="javascript:window.location='index.php?sel=PDF1';" ></td></tr>
        </table>
        </form>
</body>
</html>