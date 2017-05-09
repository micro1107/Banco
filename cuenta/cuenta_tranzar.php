<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/cuenta.php");
                include("lib/registro.php");
                include("lib/cliente.php");
                                
                $c = new Cuenta();
                $c->consultar($_POST['txtId_cuenta']);

                $p = new Cliente();
                $p->consultar($c->getDocumento());
                $email = $p->getEmail();
                $nombre = $p->getNombre();

                $tipo = $_POST['txtTipo'];
                $monto = $_POST['txtMonto'];
                $saldoViejo = $c->getSaldo();
                switch ($tipo) {
                    case '1':
                        $saldoNuevo = $saldoViejo + $monto;
                        $c->setId_cuenta($_POST['txtId_cuenta']);
                        $c->setSaldo($saldoNuevo);
                        $c->setEstado('A');
                        $c->actualizar(); 
                        break;
                    case '2':
                        $saldoNuevo = $saldoViejo - $monto;
                        $c->setId_cuenta($_POST['txtId_cuenta']);
                        $c->setSaldo($saldoNuevo);
                        $c->actualizar(); 
                        break; 

                    case'3':
                        $c2 = new Cuenta();
                        $c2->consultar($_POST['txtId_cuenta2']);
                        $saldoNuevo = $saldoViejo - $monto;
                        $saldoNuevo2 = $saldoViejo2 + $monto;
                        
                        $c->setId_cuenta($_POST['txtId_cuenta']);
                        $c->setSaldo($saldoNuevo);
                        $c->actualizar(); 
                        break;  

                    case '4':
                        $saldoNuevo = $saldoViejo - $monto;
                        $c->setId_cuenta($_POST['txtId_cuenta']);
                        $c->setSaldo($saldoNuevo);
                        $c->setEstado('B');
                        $c->actualizar(); 
                        break;                
                }

                $r = new Registro();
                $r->setCantidad($monto);
                $r->setId_transaccion($tipo);
                $r->setId_cuenta($_POST['txtId_cuenta']);

                switch ($tipo) {
                    case '1':
                        $r->insertarConsignacion($email,$nombre);
                        break;
                    case '2':
                        $r->insertarRetiro($email,$nombre);
                        break;

                    case '3':
                        $r->insertarConsignacion($email,$nombre);
                        break;

                    case '4':
                        $r->insertarSobregiro($email,$nombre);
                        break;

                }
            
                echo "Transacción a cliente ".$_POST['txtDocumento']." registrada correctamente en la cuenta".$_POST['txtId_cuenta'];
            ?>
    </body>
    
</html>