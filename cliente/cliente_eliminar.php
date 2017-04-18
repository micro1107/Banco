<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/cliente.php");
                
                $c = new Cliente();
                $c->setDocumento($_GET['documento']);
                $c->eliminar();
                
                
                echo "Cliente ".$_GET['documento']." eliminado correctamente";

            ?>
    </body>
    
</html>