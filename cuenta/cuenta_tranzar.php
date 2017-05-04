<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/cuenta.php");
                include("lib/registro.php");
                                
                $c = new Cuenta();
                $c->consultar($_POST['txtId_cuenta']);

                $tipo = $_POST['txtTipo'];
                $monto = $_POST['txtMonto'];
                $saldoViejo = $c->getSaldo();
                switch ($tipo) {
                    case '1':
                        $saldoNuevo = $saldoViejo + $monto;
                        $c->setId_cuenta($_POST['txtId_cuenta']);
                        $c->setSaldo($saldoNuevo);
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
                }

                  

                $r = new Registro();
                $r->setCantidad($monto);
                $r->setId_transaccion($tipo);
                $r->setId_cuenta($_POST['txtId_cuenta']);

                switch ($tipo) {
                    case 1:
                        $r->insertarConsignacion();
                        break;
                    case 2:
                        $r->insertarRetiro();
                        break;
                }
            
                echo "Transacción a cliente ".$_POST['txtDocumento']." registrada correctamente en la cuenta".$_POST['txtId_cuenta'];
            ?>
    </body>
    
</html>