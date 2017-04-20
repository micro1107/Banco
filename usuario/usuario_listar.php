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
    h1{
        padding-left: 100px;
        font-family: 'Lalezar', Arial;
        color:#0A1B40;
        font-size: 30px; 
    }

    </style>
</head>
<body>
    <h1>Usuarios</h1>
	<form name="index" action="index.php?sel=U2">
        <table border="1" class="tabla">
            <tr class="titulo">
            <td>LOGIN</td><td>PASSWORDe</td><td>ROL</td><td>DOCUMENTO</td><td>ESTADO</td>
            </tr>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/usuario.php");
                include("lib/rol.php");
                
                $u = new Usuario();
                $u->listar();
                $result = $u->lista;

                $r = new Rol();

                while ($row = mysql_fetch_array($result)) {

                    $r->consultarTipo($row['id_rol']);
                    $tipo = $r->getTipo();
                    $rol = "";

                    $u->consultar($row['login']);
                    $estado = $u->getEstado();
                    $esta ="";

                    switch ($tipo) {
                        case 'A':
                            $rol="Administrador";
                            break;
                        case 'F':
                            $rol="Funcionario";
                            break;
                        case 'C':
                            $rol="Cliente";
                            break;

                    }

                    switch ($estado) {
                        case 'A':
                            $esta = "Activo";
                            break;
                        case 'I':
                            $esta = "Inactivo";
                            break;
                    }

                    print "<tr>";
                    print "<td>".$row['login']."</td>";
                    print "<td>".$row['pwd']."</td>";
                    print "<td>".$rol."</td>";
                    print "<td>".$row['documento']."</td>";
                    print "<td>".$esta."</td>";
                    print "<td><a href='index.php?sel=U5&"."login=".$row['login']."'>Editar</a></td>";
                    print "<td><a href='index.php?sel=U4&"."login=".$row['login']."'>Eliminar</a></td>";
                    print "</tr>";
                }
            ?>
            <tr><td colspan="5"><input name="btnInsertar" type="button" class="botonNuevo" onclick="javascript:window.location='index.php?sel=U2';" value="Nuevo"></td></tr>
        </table>
        </form>
</body>
</html>