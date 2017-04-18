<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title>
    <link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
    <style>
        h1{
        padding-left: 100px;
        font-family: 'Lalezar', Arial;
        color:#0A1B40;
        font-size: 30px; 
    }
    form{
        padding-left: 100px;
    }
    </style>
</head>
<body>
 <h1>Modificar Datos de Clientes</h1>
	<form name ='cliente_editar' action=index.php?sel=C6 method='post'>
        <table>
                <tr>
                    <td>Documento</td>
                    <?php 
                    include("lib/config.php");
                    include("lib/mysql_lib.php");
                    include("lib/cliente.php");

                    $c = new Cliente();
                    $c->consultar($_GET['documento']);

                    print "<td><input name= txtDocumento type=text value = ".$_GET['documento']." readonly></td>";

                    ?>
                </tr>
                <tr>
                    <td>Nombre</td>
                     <td><input name="txtNombre" type="text"  value = "<?php echo $c->getNombre(); ?>" ></td>
                </tr>
                <tr>
                    <td>Email</td>
                     <td><input name="txtEmail" type="text"  value = "<?php echo $c->getEmail(); ?>" ></td>
                </tr>
                <tr>
                    <td>Direccion</td>
                     <td><input name="txtDireccion" type="text"  value = "<?php echo $c->getDireccion(); ?>" ></td>
                </tr>
                <tr>
                    <td>Telefono</td>
                     <td><input name="txtTelefono" type="text"  value = "<?php echo $c->getTelefono(); ?>" ></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="submit" value="Guardar" ></td>
                </tr>
            </table>
        </form>
</body>
</html>