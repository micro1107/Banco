<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/usuario.php");
                
                $p = new Usuario();
                $p->setLogin($_GET['login']);
                $p->eliminar();
                
                
                echo "Usuario ".$_GET['login']." eliminado correctamente";

            ?>
    </body>
    
</html>