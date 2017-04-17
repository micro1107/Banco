<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<title></title>
    <style>
     /*LISTAR*/

    .titulo td{
    font-family: Arial;
    font-size: 13px;
    background: #CCE5FF;
    font-weight: bold;
    text-align: center;
    }

    td{
    font-family: Arial;
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

    </style>
</head>
<body>
	<form name="index" action="index.php?sel=U2">
        <table border="1" class="tabla">
            <tr class="titulo">
            <td>LOGIN</td><td>PASSWORD</td><td>ROL</td><td>DOCUMENTO</td><td>ID_FUNCIONARIO</td><td>ESTADO</td>
            </tr>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/usuario.php");
                
                $u = new Usuario();
                $u->listar();
                $result = $u->lista;
                while ($row = mysql_fetch_array($result)) {

                    //$c->consultar($row['id_categoria']);
                    //$categoria = $c->getCategoria();
                    print "<tr>";
                    print "<td>".$row['login']."</td>";
                    print "<td>".$row['pwd']."</td>";
                    print "<td>".$row['id_rol']."</td>";
                    print "<td>".$row['documento']."</td>";
                    print "<td>".$row['id_funcionario']."</td>";
                    print "<td>".$row['estado']."</td>";
                    print "<td><a href='index.php?sel=M14&"."login=".$row['login']."'>Editar</a></td>";
                    print "<td><a href='index.php?sel=M13&"."login=".$row['login']."'>Eliminar</a></td>";
                    print "</tr>";
                }
            ?>
            <tr><td colspan="6"><input name="btnInsertar" type="button" class="botonNuevo" onclick="javascript:window.location='index.php?sel=U2';" value="Nuevo"></td></tr>
        </table>
        </form>
</body>
</html>