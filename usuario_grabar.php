<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/usuario.php");
                include("lib/rol.php");
                
                $p = new Usuario();

                $r = new Rol();
                $r->consultarId($_POST['txtRol']);
                $id_rol = $r->getId_rol();
               
                $p->setLogin($_POST['txtLogin']);
                $p->setPwd($_POST['txtPwd']);
                $p->setId_rol($id_rol);
                $p->setDocumento($_POST['txtDocumento']);
                $p->setEstado('A');
                $p->insertar();
                $p->actualizar();   

            
                echo "Usuario ".$_POST['txtLogin']." registrado correctamente";
            ?>
    </body>
    
</html>