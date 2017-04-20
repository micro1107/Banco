<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/funcionario.php");
                
                $f = new Funcionario();
                $f->setDocumento($_GET['documento']);
                $f->eliminar();
                
                
                echo "Funcionario ".$_GET['documento']." eliminado correctamente";


            ?>
    </body>
    
</html>