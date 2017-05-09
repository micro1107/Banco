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
    <?php 
        include("lib/config.php");
        include("lib/mysql_lib.php");
        include("lib/registro.php");
        include("lib/cliente.php");

        $p = new Cliente();
        $p->consultar($_GET['documento']);
    
    print "<h1>Historial de Transacciones de ". $p->getNombre() ."</h1>";
	?>
    <form name="index" action="index.php?sel=P2">
        <table border="1" class="tabla">
            <tr class="titulo">
            <td>ID_REGISTRO</td><td>ID_CUENTA</td><td>TRANSACCION</td><td>TITULAR</td><td>MONTO</td><td>FECHA</td>
            </tr>
            <?php
                
                $r = new Registro();
                $r->listarMovimientosPersona($_GET['documento']);
                $result = $r->lista;

                while ($row = mysql_fetch_array($result)) {

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

                    print "<tr>";
                    print "<td>".$row['id_registro']."</td>";
                    print "<td>".$row['id_cuenta']."</td>";
                    print "<td>".$tipo."</td>";
                    print "<td>".$row['nombre']."</td>";
                    print "<td>".$row['cantidad']."</td>";
                    print "<td>".$row['fecha']."</td>";                    
                    print "</tr>";
                }
            ?>
        </table>
        </form>
</body>
</html>