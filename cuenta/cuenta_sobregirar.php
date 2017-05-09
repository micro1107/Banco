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
<h1>Sobregirar una Cuenta</h1>
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
                    $max = ($cu->getSaldo())*0.50;
                    $max = $max + $cu->getSaldo();
                    ?>
                </tr>
                <tr>
                    <?php print "Tenga en cuenta que puede sobregirar por un máximo de: $".$max.""; ?>
                    <td>Monto</td>
                    <td><input name="txtMonto" type="text"></td>
                </tr>
                <tr>
                    <?php
                    print "<td><input name=txtId_cuenta type=hidden value = ".$_GET['id_cuenta']." readonly ></td>"
                    ?>
                </tr>
                <tr>
                    <?php
                    print "<td><input name=txtTipo type=hidden value = 4 readonly ></td>"
                    ?>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="button" value="Guardar" onclick="javascript:validar();"></td>
                </tr>
            </table>
        </form>
</body>
</html>