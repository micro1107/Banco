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
    <script>
        function abrirPdf(){

                document.pdf.action = "cliente/cliente_listar_pdf.php";
                document.pdf.target = "cliente_listar_pdf";
                document.pdf.submit();
        }
    </script>
</head>
<body>
    <h1>Clientes</h1>
	<form name="pdf" action="index.php?sel=C2">
        <table border="1" class="tabla">
            <tr class="titulo">
            <td>DOCUMENTO</td><td>NOMBRE</td><td>EMAIL</td><td>DIRECCION</td><td>TELEFONO</td>
            </tr>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/cliente.php");
                
                
                $c = new Cliente();
                $c->listar();
                $result = $c->lista;

                while ($row = mysql_fetch_array($result)) {

                    print "<tr>";
                    print "<td>".$row['documento']."</td>";
                    print "<td>".$row['nombre']."</td>";
                    print "<td>".$row['email']."</td>";
                    print "<td>".$row['direccion']."</td>";
                    print "<td>".$row['telefono']."</td>";
                    print "<td><a href='index.php?sel=C7&"."documento=".$row['documento']."'>Ver Perfil</a></td>";
                    print "<td><a href='index.php?sel=P5&"."documento=".$row['documento']."'>Ver Cuentas</a></td>";
                    print "<td><a href='index.php?sel=RE2&"."documento=".$row['documento']."'>Ver Movimientos</a></td>";
                    print "<td><a href='index.php?sel=UPF&"."documento=".$row['documento']."'>Subir Foto</a></td>";
                    print "<td><a href='index.php?sel=UPFA&"."documento=".$row['documento']."'>Subir Archivos</a></td>";
                    print "<td><a href='index.php?sel=C5&"."documento=".$row['documento']."'>Editar</a></td>";
                    print "<td><a href='index.php?sel=C4&"."documento=".$row['documento']."'>Eliminar</a></td>";
                    print "</tr>";
                }
            ?>
            <tr><td colspan="11"><input name="btnInsertar" type="button" class="botonNuevo" onclick="javascript:window.location='index.php?sel=C2';" value="Nuevo"></td></tr>
        </table>
        </form>
</body>
</html>