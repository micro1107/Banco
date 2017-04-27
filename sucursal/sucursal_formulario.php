<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">
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
            var txtPwd, txtLogin, txtRol;
            
            document.sucursal_grabar.submit();
            
        }
    </script>
</head>
<body>
<h1>Registro de Sucursal</h1>
    <form name="sucursal_grabar" action="index.php?sel=S3" method="post">
        <table>
                <tr>
                    <td>Nombre</td>
                    <td><input name="txtNombre" type="text"></td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td><input name="txtDireccion" type="text"></td>
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td><input name="txtTelefono" type="text"></td>
                </tr>
                <tr>
                    <td>Ciudad</td>
                    <td><input name="txtCiudad" type="text"></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="button" value="Guardar" onclick="javascript:validar();"></td>
                </tr>
            </table>
        </form>
</body>
</html>