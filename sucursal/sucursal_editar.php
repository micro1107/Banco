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
    <script>
        function validar() {

            var txtNombre, txtCiudad, txtDireccion, txtTelefono;

            txtNombre = document.sucursal_grabar.txtNombre.value;
            txtCiudad = document.sucursal_grabar.txtCiudad.value;
            txtDireccion = document.sucursal_grabar.txtDireccion.value;
            txtTelefono = document.sucursal_grabar.txtTelefono.value;

            if (txtCiudad=="" || txtCiudad==null){
                alert("Error: Debe digitar un valor para la ciudad");
                document.sucursal_grabar.txtCiudad.focus();
                return;
            }
                else if (!isNaN(txtCiudad)){
                    alert("Error: Debe digitar un valor válido para la ciudad");
                    document.sucursal_grabar.txtCiudad.focus();
                    return;
                }

            else if (document.sucursal_grabar.txtNombre.value=="" || document.sucursal_grabar.txtNombre.value==null){
                alert("Error: Debe digitar un nombre");
                document.usuario_grabar.txtNombre.focus();
                return;
            }
                else if (!isNaN(txtNombre)){
                    alert("Error: Debe digitar un nombre válido");
                    document.sucursal_grabar.txtNombre.focus();
                    return;
                }
            

            else if (txtDireccion=="" || txtDireccion==null){
                alert("Error: Debe digitar una dirección");
                document.sucursal_grabar.txtDireccion.focus();
                return;
            }

            else if (txtTelefono=="" || txtTelefono==null){
                alert("Error: Debe digitar un nombre");
                document.sucursal_grabar.txtTelefono.focus();
                return;
            }
            

            else{
            document.sucursal_grabar.submit();
            }
        }
    </script>
</head>
<body>
 <h1>Modificar Datos de Sucursal</h1>
	<form name ='sucursal_grabar' action=index.php?sel=S6 method='post'>
        <table>
                <tr>
                    <td>Id_Sucursal</td>
                    <?php 
                    include("lib/config.php");
                    include("lib/mysql_lib.php");
                    include("lib/sucursal.php");


                    $s = new Sucursal();
                    $s->consultar($_GET['id_sucursal']);

                    print "<td><input name= txtSucursal type=text value = ".$_GET['id_sucursal']." readonly></td>";

                    ?>
                </tr>
                <tr>
                    <td>Nombre</td>
                     <td><input name="txtNombre" type="text"  value = "<?php echo $s->getNombre(); ?>" ></td>
                </tr>
                <tr>
                    <td>Direccion</td>
                     <td><input name="txtDireccion" type="text"  value = "<?php echo $s->getDireccion(); ?>" ></td>
                </tr>
                <tr>
                    <td>Telefono</td>
                     <td><input name="txtTelefono" type="text"  value = "<?php echo $s->getTelefono(); ?>" ></td>
                </tr>
                <tr>
                    <td>Ciudad</td>
                     <td><input name="txtCiudad" type="text"  value = "<?php echo $s->getCiudad(); ?>" ></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="button" value="Guardar" onclick="validar()"></td>
                </tr>
            </table>
        </form>
</body>
</html>