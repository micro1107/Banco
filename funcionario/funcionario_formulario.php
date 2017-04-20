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
            
            document.cliente_grabar.submit();
            
        }
    </script>
</head>
<body>
<h1>Registro de Funcionario</h1>
    <form name="funcionario_grabar" action="index.php?sel=F3" method="post">
        <table>
                <tr>
                    <td>Documento</td> 
                    <td><input name= "txtDocumento" type= "text"></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input name="txtNombre" type="text"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input name="txtEmail" type="text"></td>
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td><input name="txtTelefono" type="text"></td>
                </tr>
                <tr>
                    <td>Sucursal</td>
                    <td><select name="txtSucursal">
                        <?php
                            include("lib/config.php");
                            include("lib/mysql_lib.php");
                            include("lib/sucursal.php");
                            
                            $s = new Sucursal();
                            $s->listar();
                            $result = $s->lista;
                        
                             while ($row = mysql_fetch_array($result)) {
                                print "<option value = row['id_sucursal']>row['nombre']</option>";
                            }
                        ?>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="button" value="Guardar" onclick="javascript:validar();"></td>
                </tr>
            </table>
        </form>
</body>
</html>