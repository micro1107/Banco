<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/sucursal.php");
                                
                $s = new Sucursal();

               
                $s->setNombre($_POST['txtNombre']);
                $s->setDireccion($_POST['txtDireccion']);
                $s->setCiudad($_POST['txtCiudad']);
                $s->setTelefono($_POST['txtTelefono']);
                $s->insertar();
                $s->actualizar();   

            
                echo "Sucursal ".$_POST['txtNombre']." registrada correctamente";
            ?>
    </body>
    
</html>