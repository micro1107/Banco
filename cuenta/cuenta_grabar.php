<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/cuenta.php");
                include("lib/registro.php");
                include("lib/cliente.php");

                $c = new Cuenta();

                $p = new Cliente();
                $p->consultar($_POST['txtDocumento']);
                $email = $p->getEmail();
                $nombre = $p->getNombre();
               
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
                $r->insertarConsignacion($email,$nombre);

                print $c->getId_cuenta();
            
                echo "Cuenta ".$_POST['txtDocumento']." registrada correctamente";
            ?>
    </body>
    
</html>