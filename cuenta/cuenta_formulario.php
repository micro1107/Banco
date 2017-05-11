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

            var txtSaldo;

            txtSaldo = document.cuenta_grabar.txtSaldo.value;

            if (txtSaldo=="" || txtSaldo==null){
                alert("Error: Debe digitar una consignación inicial");
                document.cuenta_grabar.txtSaldo.focus();
                return;
            }
                else if (isNaN(txtSaldo)){
                    alert("Error: Debe digitar un valor válido para el monto");
                    document.cuenta_grabar.txtSaldo.focus();
                    return;
                }
                else if (txtSaldo <= 0){
                    alert("Error: Debe digitar un valor válido para el monto");
                    document.cuenta_grabar.txtMonto.focus();
                    return;
                }
            else{
                document.cuenta_grabar.submit();
                }
        }
    </script>
</head>
<body>
<h1>Registro de Cuenta</h1>
    <form name="cuenta_grabar" action="index.php?sel=P3" method="post">
        <table>
                <tr>
                    <td>Titular</td> 
                    <td><select name="txtDocumento">
                        <?php
                            include("lib/config.php");
                            include("lib/mysql_lib.php");
                            include("lib/cliente.php");
                            
                            $c = new Cliente();
                            $c->listar();
                            $result1 = $c->lista;
                        
                             while ($row1 = mysql_fetch_array($result1)) {
                                print "<option value = $row1[documento]>$row1[nombre]</option>";
                            }
                        ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Tipo</td>
                    <td><select name="txtTipo">
                    <option value = 'A'>Ahorros</option>
                    <option value = 'C'>Corriente</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Consignacion Inicial</td>
                    <td><input name="txtSaldo" type="text"></td>
                </tr>
                <tr>
                    <td>Sucursal</td>
                    <td><select name="txtSucursal">
                        <?php
                            include("lib/sucursal.php");
                            
                            $s = new Sucursal();
                            $s->listar();
                            $result = $s->lista;
                        
                             while ($row = mysql_fetch_array($result)) {
                                print "<option value = $row[id_sucursal]>$row[nombre]</option>";
                            }
                        ?>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="button" value="Guardar" onclick="validar()"></td>
                </tr>
            </table>
        </form>
</body>
</html>