<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/cuenta.php");
                include("lib/registro.php");
                                
                $c = new Cuenta();

               
                $c->setDocumento($_POST['txtDocumento']);
                $c->setTipo($_POST['txtTipo']);
                $c->setEstado('A');
                $c->setId_sucursal($_POST['txtSucursal']);
                $c->setSaldo($_POST['txtSaldo']);
                $c->insertar();
                $c->actualizar();   

                $c->consultarUltimo($_POST['txtDocumento']);

                $r = new Registro();
                $r->setCantidad($_POST['txtSaldo']);
                $r->setId_transaccion(1);
                $r->setId_cuenta($c->getId_cuenta());
                $r->insertarConsignacion();

                print $c->getId_cuenta();
            
                echo "Cuenta ".$_POST['txtDocumento']." registrada correctamente";
            ?>
    </body>
    
</html>