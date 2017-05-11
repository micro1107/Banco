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

            var txtNombre, txtEmail, txtDocumento, txtTelefono;

            txtNombre = document.funcionario_grabar.txtNombre.value;
            txtEmail = document.funcionario_grabar.txtEmail.value;
            txtDocumento = document.funcionario_grabar.txtDocumento.value;
            txtTelefono = document.funcionario_grabar.txtTelefono.value;

            if (txtDocumento=="" || txtDocumento==null){
                alert("Error: Debe digitar un valor para el documento");
                document.funcionario_grabar.txtDocumento.focus();
                return;
            }
                else if (isNaN(txtDocumento)){
                    alert("Error: Debe digitar un valor válido para el documento");
                    document.funcionario_grabar.txtDocumento.focus();
                    return;
                }

            else if (document.funcionario_grabar.txtNombre.value=="" || document.funcionario_grabar.txtNombre.value==null){
                alert("Error: Debe digitar un nombre");
                document.usuario_grabar.txtNombre.focus();
                return;
            }
                else if (!isNaN(txtNombre)){
                    alert("Error: Debe digitar un nombre válido");
                    document.funcionario_grabar.txtNombre.focus();
                    return;
                }
            
            else if (document.funcionario_grabar.txtEmail.value=="" || document.funcionario_grabar.txtEmail.value==null){
                alert("Error: Debe digitar un email");
                document.funcionario_grabar.txtEmail.focus();
                return;
            }
            else if(!email(txtEmail)){
                alert("Error: Debe digitar un email válido");
                document.funcionario_grabar.txtEmail.focus();
                return;
            }

            else if (txtTelefono=="" || txtTelefono==null){
                alert("Error: Debe digitar un telefono");
                document.funcionario_grabar.txtTelefono.focus();
                return;
            }
            
            else{
            document.funcionario_grabar.submit();
            }
        }

        function email(txtEmail){
            if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(txtEmail)){
              return true;
              } 
              else {
               return false;
              }
            }
    </script>
</head>
<body>
 <h1>Modificar Datos de Funcionario</h1>
	<form name ='funcionario_grabar' action=index.php?sel=F6 method='post'>
        <table>
                <tr>
                    <td>Documento</td>
                    <?php 
                    include("lib/config.php");
                    include("lib/mysql_lib.php");
                    include("lib/funcionario.php");
                    include("lib/sucursal.php");


                    $f = new Funcionario();
                    $f->consultar($_GET['documento']);

                    print "<td><input name= txtDocumento type=text value = ".$_GET['documento']." readonly></td>";

                    ?>
                </tr>
                <tr>
                    <td>Nombre</td>
                     <td><input name="txtNombre" type="text"  value = "<?php echo $f->getNombre(); ?>" ></td>
                </tr>
                <tr>
                    <td>Email</td>
                     <td><input name="txtEmail" type="text"  value = "<?php echo $f->getEmail(); ?>" ></td>
                </tr>
                <tr>
                    <td>Sucursal</td>
                     <td><select name="txtSucursal">
                        <?php
                        
                            $s = new Sucursal();
                            $s->listar();
                            $result = $s->lista;

                            $s->consultar($f->getId_sucursal());
                                
                                $id = $f->getId_sucursal();
                                $nombre = $s->getNombre();

                                print "<option value = $id> $nombre </option>";
                             while ($row = mysql_fetch_array($result)) {
                                if ($row['id_sucursal'] !== $id){
                                print "<option value = $row[id_sucursal]>$row[nombre]</option>";
                                }
                            }
                        ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Telefono</td>
                     <td><input name="txtTelefono" type="text"  value = "<?php echo $f->getTelefono(); ?>" ></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="button" value="Guardar" onclick="validar()" ></td>
                </tr>
            </table>
        </form>
</body>
</html>