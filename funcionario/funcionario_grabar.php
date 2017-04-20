<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/funcionario.php");
                                
                $c = new Funcionario();

               
                $c->setDocumento($_POST['txtDocumento']);
                $c->setNombre($_POST['txtNombre']);
                $c->setEmail($_POST['txtEmail']);
                $c->setId_sucursal($_POST['txtSucursal']);
                $c->setTelefono($_POST['txtTelefono']);
                $c->insertar();
                $c->actualizar();   

            
                echo "Funcionario ".$_POST['txtNombre']." registrado correctamente";
            ?>
    </body>
    
</html>