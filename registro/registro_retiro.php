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
    
    print "<h1>Historial de Retiros</h1>";
	?>
    <form name="index" action="index.php?sel=P2">
        <table border="1" class="tabla">
            <tr class="titulo">
            <td>ID_REGISTRO</td><td>ID_CUENTA</td><td>TITULAR</td><td>MONTO</td><td>FECHA</td>
            </tr>
            <?php
                
                $r = new Registro();
                $r->listarRetiros();
                $result = $r->lista;

                while ($row = mysql_fetch_array($result)) {

                    print "<tr>";
                    print "<td>".$row['id_registro']."</td>";
                    print "<td>".$row['id_cuenta']."</td>";
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