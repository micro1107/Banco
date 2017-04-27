<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/sucursal.php");
                                
                $s = new Sucursal();

                $s->setId_sucursal($_POST['txtSucursal']);
                $s->setNombre($_POST['txtNombre']);
                $s->setDireccion($_POST['txtDireccion']);
                $s->setCiudad($_POST['txtCiudad']);
                $s->setTelefono($_POST['txtTelefono']);
                $s->actualizar();   

            
                echo "Sucursal ".$_POST['txtNombre']." actualizada correctamente";
            ?>
    </body>
    
</html>