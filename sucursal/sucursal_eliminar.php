<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/sucursal.php");
                
                $s = new Sucursal();
                $s->setId_sucursal($_GET['id_sucursal']);
                $s->eliminar();
                
                
                echo "Sucursal ".$_GET['id_sucursal']." eliminada correctamente";


            ?>
    </body>
    
</html>