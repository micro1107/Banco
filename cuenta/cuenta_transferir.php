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
            
            document.cuenta_consignar.submit();
            
        }
    </script>
</head>
<body>
<h1>Retiro sobre una Cuenta</h1>
    <form name="cuenta_consignar" action="index.php?sel=P13" method="post">
        <table>
                <tr>
                    <td>Titular</td> 
                    <?php 
                    include("lib/config.php");
                    include("lib/mysql_lib.php");
                    include("lib/cuenta.php");
                    include("lib/cliente.php");

                    $cu = new Cuenta();
                    $cu->consultar($_GET['id_cuenta']);

                    $c = new Cliente();
                    $c->consultar($cu->getDocumento());

                    print "<td><input name= txtTitular type=text value = ".$c->getNombre()." readonly ></td>";

                    ?>
                </tr>
                <tr>
                    <td>Saldo</td>
                    <?php
                    print "<td><input name=txtSaldo type=text value = ".$cu->getSaldo()." readonly></td>";
                    ?>
                </tr>
                <tr>
                    <td>Monto</td>
                    <td><input name="txtMonto" type="text"></td>
                </tr>
                <tr>
                    <select name="txtCuenta2">
                        <?php
                        //FALTA SACAR TODAS LAS CUENTAS CON LOS CLIENTES
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
                    <?php
                    print "<td><input name=txtId_cuenta type=hidden value = ".$_GET['id_cuenta']." readonly ></td>"
                    ?>
                </tr>
                <tr>
                    <?php
                    print "<td><input name=txtTipo type=hidden value = 2 readonly ></td>"
                    ?>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="button" value="Guardar" onclick="javascript:validar();"></td>
                </tr>
            </table>
        </form>
</body>
</html>