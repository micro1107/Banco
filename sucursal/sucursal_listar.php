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
    <h1>Sucursales</h1>
	<form name="index" action="index.php?sel=S2">
        <table border="1" class="tabla">
            <tr class="titulo">
            <td>ID_SUCURSAL</td><td>NOMBRE</td><td>DIRECCION</td><td>TELEFONO</td><td>CIUDAD</td>
            </tr>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/sucursal.php");    

                $s = new Sucursal();
                $s->listar();
                $result = $s->lista;

                while ($row = mysql_fetch_array($result)) {

                    print "<tr>";
                    print "<td>".$row['id_sucursal']."</td>";
                    print "<td>".$row['nombre']."</td>";
                    print "<td>".$row['direccion']."</td>";
                    print "<td>".$row['telefono']."</td>";
                    print "<td>".$row['ciudad']."</td>";
                    print "<td><a href='index.php?sel=P8&"."id_sucursal=".$row['id_sucursal']."'>Ver Cuentas</a></td>";
                    print "<td><a href='index.php?sel=S5&"."id_sucursal=".$row['id_sucursal']."'>Editar</a></td>";
                    print "<td><a href='index.php?sel=S4&"."id_sucursal=".$row['id_sucursal']."'>Eliminar</a></td>";
                    print "</tr>";
                }
            ?>
            <tr><td colspan="5"><input name="btnInsertar" type="button" class="botonNuevo" onclick="javascript:window.location='index.php?sel=S2';" value="Nuevo"></td></tr>
        </table>
        </form>
</body>
</html>