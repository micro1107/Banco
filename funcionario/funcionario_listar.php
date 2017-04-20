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
    <h1>Funcionarios</h1>
	<form name="index" action="index.php?sel=F2">
        <table border="1" class="tabla">
            <tr class="titulo">
            <td>DOCUMENTO</td><td>NOMBRE</td><td>EMAIL</td><td>SUCURSAL</td><td>TELEFONO</td>
            </tr>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/funcionario.php");
                include("lib/sucursal.php");
                
                
                $f = new Funcionario();
                $f->listar();
                $result = $f->lista;

                $s = new Sucursal();

                while ($row = mysql_fetch_array($result)) {

                    $s->consultar($row['id_sucursal']);
                    $nombre = $s->getNombre();

                    print "<tr>";
                    print "<td>".$row['documento']."</td>";
                    print "<td>".$row['nombre']."</td>";
                    print "<td>".$row['email']."</td>";
                    print "<td>".$nombre."</td>";
                    print "<td>".$row['telefono']."</td>";
                    print "<td><a href='index.php?sel=F5&"."documento=".$row['documento']."'>Editar</a></td>";
                    print "<td><a href='index.php?sel=F4&"."documento=".$row['documento']."'>Eliminar</a></td>";
                    print "</tr>";
                }
            ?>
            <tr><td colspan="5"><input name="btnInsertar" type="button" class="botonNuevo" onclick="javascript:window.location='index.php?sel=F2';" value="Nuevo"></td></tr>
        </table>
        </form>
</body>
</html>