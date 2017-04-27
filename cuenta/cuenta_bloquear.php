<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/cuenta.php");
                            
                $c = new Cuenta();
                $c->consultar($_GET['id_cuenta']);

                if ($c->getEstado() == 'A'){
                $c->setId_cuenta($c->getId_Cuenta());
                $c->setSaldo($c->getSaldo());
                $c->setEstado('B');
                $c->actualizar();
                }
                else{
                $c->setId_cuenta($c->getId_Cuenta());
                $c->setSaldo($c->getSaldo());
                $c->setEstado('A');
                $c->actualizar();
                }

            echo "Se modificó la cuenta: ".$_GET['id_cuenta']."";
            ?>
            
    </body>
    
</html>