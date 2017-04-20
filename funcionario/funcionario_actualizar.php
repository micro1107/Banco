<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/funcionario.php");
                            
                $f = new Funcionario();
               
                $f->setDocumento($_POST['txtDocumento']);
                $f->setNombre($_POST['txtNombre']);
                $f->setEmail($_POST['txtEmail']);
                $f->setId_sucursal($_POST['txtSucursal']);
                $f->setTelefono($_POST['txtTelefono']);
                $f->actualizar();


            echo "Se actualizó el funcionario: ".$_POST['txtNombre']." correctamente";
            ?>
            
    </body>
    
</html>