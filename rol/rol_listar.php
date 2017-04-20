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
    <h1>Roles</h1>
	<form name="index" action="index.php?sel=C2">
        <table border="1" class="tabla">
            <tr class="titulo">
            <td>ID_ROL</td><td>TIPO</td>
            </tr>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/rol.php");
                
                
                $r = new Rol();
                $r->listar();
                $result = $r->lista;

                while ($row = mysql_fetch_array($result)) {

                    switch ($row['tipo']) {
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

                    print "<tr>";
                    print "<td>".$row['id_rol']."</td>";
                    print "<td>".$rol."</td>";
                    print "</tr>";
                }
            ?>
        </table>
        </form>
</body>
</html>