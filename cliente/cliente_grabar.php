<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/cliente.php");
                                
                $c = new Cliente();

               
                $c->setDocumento($_POST['txtDocumento']);
                $c->setNombre($_POST['txtNombre']);
                $c->setEmail($_POST['txtEmail']);
                $c->setDireccion($_POST['txtDireccion']);
                $c->setTelefono($_POST['txtTelefono']);
                $c->insertar();
                $c->actualizar();   

            
                echo "Cliente ".$_POST['txtNombre']." registrado correctamente";
            ?>
    </body>
    
</html>