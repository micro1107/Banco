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
    h4{
        font-family: 'Lalezar', Arial;
        color:#0A1B40;
        font-size: 20px; 
    }
    h3{
        font-family: 'Lalezar', Arial;
        color:#0A1B40;
        font-size: 15px;
    }

    </style>
</head>
<body>
    <?php 
        include("lib/config.php");
        include("lib/mysql_lib.php");
        include("lib/cuenta.php");
        include("lib/cliente.php");

        $p = new Cliente();
        $p->consultar($_GET['documento']);
    
    print "<h1>Perfil de ". $p->getNombre() ."</h1>";
	?>
    <form name="index" action="index.php?sel=P2">
    <h4>Foto<h4>
    <?php
    print "<img width=200px eight=200px src='ver_archivo.php?id=".$_GET['documento']."' alt='Imagen' />";
    ?>
    <h4>Contacto</h4>
    <table border="=1" class="tabla">
    <tr class="titulo">
        <td>EMAIL</td><td>TELEFONO</td><td>DIRECCION</td>
    </tr>
    <?php
        print "<tr>";
                    print "<td>".$p->getEmail()."</td>";
                    print "<td>".$p->getTelefono()."</td>";
                    print "<td>".$p->getDireccion()."</td>";                    
        print "</tr>";

    ?>
    </table>
    <?php
    print "<a href='index.php?sel=P5&"."documento=".$_GET['documento']."'><h3>Ver Cuentas<h3></a>";
    ?>
        </form>
</body>
</html>