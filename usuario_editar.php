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
    <h1>Editar Datos de Usuario</h1>
	<form name ='usuario_editar' action=index.php?sel=U6 method='post'>
        <table>
                <tr>
                    <td>Login</td>
                    <?php 
                    include("lib/config.php");
                    include("lib/mysql_lib.php");
                    include("lib/usuario.php");
                    include("lib/rol.php");

                    $p = new Usuario();
                    $p->consultar($_GET['login']);

                    $r = new Rol();
                    $r->consultarTipo($p->getId_rol());
                    $tipo = $r->getTipo();

                    ?>
                    <?php 
                    print "<td><input name= txtLogin type=text value = ".$_GET['login']." readonly></td>";
                    ?>
                </tr>
                <tr>
                    <td>Password</td>
                     <td><input name="txtPwd" type="password"  value = "<?php echo $p->getPwd(); ?>" ></td>
                </tr>
                <tr>
                    <td>Rol</td>
                    <td>
                        <?php 
                        if ($tipo == 'A'){
                            print "<select name=txtRol>";
                            print "<option value=A>Administrador</option>"; 
                            print "<option value=F>Funcionario</option>"; 
                            print "<option value=C>Cliente</option>";
                            print "</select>";
                        }
                        elseif ($tipo == 'F') {
                            print "<select name=txtRol>";
                            print "<option value=F>Funcionario</option>"; 
                            print "<option value=A>Administrador</option>";
                            print "<option value=C>Cliente</option>";
                            print "</select>";
                        }
                        else{
                            print "<select name=txtRol>";
                            print "<option value=C>Cliente</option>";
                            print "<option value=A>Administrador</option>";
                            print "<option value=F>Funcionario</option>";
                            print "</select>";
                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Estado</td>
                    <td>
                        <select name="txtEstado">
                        <option value="A">Activo</option> 
                        <option value="I">Inactivo</option> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Documento</td>
                    <td><input name="txtDocumento" type="text"  value = "<?php echo $p->getDocumento(); ?>" readonly></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="submit" value="Guardar" onclick="javascript:validar();"></td>
                </tr>
            </table>
        </form>
</body>
</html>