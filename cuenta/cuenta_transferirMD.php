<html>
    <head>
        <script>
            function eliminarItem(id_registro) {
              /*alert("Item que desea eliminar = " + id + 
                      "\nfecha" + document.formulario.txtFecha.value);*/
                var txtCuenta1 = document.formulario.txtCuenta1.value;
                document.formulario.txtDato.value = id_registro;
                document.formulario.txtAccion.value="DEL_ITEM";
                document.formulario.action = "index.php?sel=P11&id_cuenta="+txtCuenta1+"&id_registro="+id_registro;
                document.formulario.submit();
            }
            function cancelar() {
              /*alert("Item que desea eliminar = " + id + 
                      "\nfecha" + document.formulario.txtFecha.value);*/
                var txtCuenta1 = document.formulario.txtCuenta1.value;
                document.formulario.txtAccion.value="CAN";
                document.formulario.action = "index.php?sel=P11&id_cuenta="+txtCuenta1;
                document.formulario.submit();
            }

            function agregarItem() {
                var txtMonto, txtSaldo, txtCuenta1;
                    txtSaldo = document.formulario.txtSaldo.value;
                    txtMonto = document.formulario.txtMonto.value;
                    txtCuenta1 = document.formulario.txtCuenta1.value;
                if (document.formulario.txtMonto.value<1) {
                    alert("Digite un monto mayor que 0.");
                    document.formulario.txtMonto.focus();
                    return;
                }
                else if(isNaN(txtMonto)){
                    alert("Digite un valor numérico para el monto");
                    document.formulario.txtMonto.focus();
                    return;
                }
                else if (txtMonto=="" || txtMonto==null){
                alert("Error: Debe digitar un valor");
                document.formulario.txtMonto.focus();
                return;
                }
                /*else if (txtMonto > txtSaldo){
                alert("Error: El monto supera el saldo");
                document.formulario.txtMonto.focus();
                return;
                }
                */
                else if (txtSaldo < 10000){
                alert("Error: El saldo está en el limite");
                document.formulario.txtMonto.focus();
                return;
                }
                else {
                document.formulario.txtAccion.value="INS_ITEM";
                document.formulario.action = "index.php?sel=P11&id_cuenta="+txtCuenta1;
                document.formulario.submit();
                }
            }

            function grabar() {
              var txtMonto, txtSaldo, txtCuenta1;
                    txtSaldo = document.formulario.txtSaldo.value;
                    txtMonto = document.formulario.txtMonto.value;
                    txtCuenta1 = document.formulario.txtCuenta1.value;

                    document.formulario.action = "index.php?sel=P11&id_cuenta="+txtCuenta1;
                    document.formulario.txtAccion.value="GR";
                    document.formulario.submit();
            }
        
        </script>
        <style>
    .titulo td{
    font-family: 'Lalezar', Arial;
    font-size: 15px;
    background: #CCE5FF;
    text-align: center;
    }

    td{
    font-family:  Arial;
    font-size: 11px;
    text-align: center;
    }

    .botonNuevo {
    float: right;
    }

    .tabla tr,td  {
    border-collapse: separate;
    border-spacing:  3px;
    border-style: none;
    }   
    form{
        padding-left:200px;
    }
    
    h1{
        padding-left: 100px;
        font-family: 'Lalezar', Arial;
        color:#0A1B40;
        font-size: 30px; 
    }

        </style>
        
    </head>

    <body>
        <form  name="formulario" action="grabarEd.php" method="post">
            
            <?php

                if ($_POST['txtAccion']=='DEL_ITEM') {
                include('lib/config.php');
                include('lib/mysql_lib.php');
                include('lib/cliente.php');
                include('lib/cuenta.php');
                include('lib/tmp_registro.php');
                    $d = new Tmp_registro();
                    $d->eliminar($_POST['txtDato']);
                    print "<font color='#FF0000'>Item ".$_POST['txtDato']." Eliminado!<br> </font>";
                    ?>
                    <script>
                        document.formulario.txtDato.value = "";
                        document.formulario.txtAccion.value="";
                    </script>
                    <?php
                }

                else if ($_POST['txtAccion']=='INS_ITEM') {
                include('lib/config.php');
                include('lib/mysql_lib.php');
                include('lib/cliente.php');
                include('lib/cuenta.php');
                include('lib/tmp_registro.php');
                    $d = new Tmp_registro( );
                    $d->setCuenta($_POST['txtCuenta2']);
                    $d->setId_cuenta($_POST['txtCuenta1']);
                    $d->setCantidad($_POST['txtMonto']);
                    $d->setId_transaccion(3);
                    $d->insertar();
                    //print "<font color='#FF0000'>Item ".$_POST['txtDato']." Eliminado!<br> </font>";
                    ?>
                    <script>
                        document.formulario.txtDato.value = "";
                        document.formulario.txtAccion.value="";
                    </script>
                    <?php
                }
                elseif ($_POST['txtAccion']=='CAN') {
                include('lib/config.php');
                include('lib/mysql_lib.php');
                include('lib/cliente.php');
                include('lib/cuenta.php');
                include('lib/tmp_registro.php');
                    $d = new Tmp_registro();
                    $d->cancelar($_GET['id_cuenta']);
                }
                        elseif ($_POST['txtAccion']=='GR') {
                        include('lib/config.php');
                        include('lib/mysql_lib.php');
                        include('lib/cliente.php');
                        include('lib/cuenta.php');
                        include('lib/tmp_registro.php');
                        include("lib/registro.php");
                            $d = new Tmp_registro();
                            $d->listar($_GET['id_cuenta']);
                            $result = $d->lista;

                            $ce = new Cuenta();
                            $ce->consultar($_GET['id_cuenta']);

                            $ce2 = new Cuenta();

                            $cli = new Cliente();
                            $cli->consultar($ce->getDocumento());
                            $email = $cli->getEmail();
                            $nombre = $cli->getNombre();

                            $r = new Registro();

                            $tipo = 3;
                            $saldoViejo = $ce->getSaldo();
                            while ($row = mysql_fetch_array($result)){
                            
                            $id_cuenta = $row['id_cuenta'];
                            $cuenta = $row['cuenta'];
                            $cantidad = $row['cantidad'];
                            $total += $total+ $row['cantidad']; 

                            $ce2->consultar($row['cuenta']);
                            $saldoViejo2 = $ce2->getSaldo();

                            $saldoNuevo2 = $saldoViejo2 + $row['cantidad'];
                            $ce2->setSaldo($saldoNuevo2);
                            $ce2->setId_cuenta($row['cuenta']);
                            $ce2->actualizar();

                            $r->setId_cuenta($id_cuenta);
                            $r->setCantidad($cantidad);
                            $r->setCuenta($cuenta);
                            $r->setId_transaccion($tipo);
                            $r->insertarTransferencia($email,$nombre);

                            }
                            $saldoNuevo = $saldoViejo - $total;
                            $ce->setSaldo($saldoNuevo);
                            $ce->setId_cuenta($_GET['id_cuenta']);
                            $ce->actualizar();

                            

                            $d->cancelar($_GET['id_cuenta']);

                            echo "Tranferencia exitosa!";
                        }
                else{
                include('lib/config.php');
                include('lib/mysql_lib.php');
                include('lib/cliente.php');
                include('lib/cuenta.php');
                include('lib/tmp_registro.php');
                }
                
               
            ?>
            <table>
                <tr>
                    <?php
                        
                        $cu = new Cuenta();
                        $cu->consultar($_GET['id_cuenta']);

                        $c= new Cliente();
                        $c->consultar($cu->getDocumento());

                        $saldo = $cu->getSaldo();
                        //$total 
                            $d = new Tmp_registro();
                            $d->listar($_GET['id_cuenta']);
                            $result = $d->lista;
                            while ($row = mysql_fetch_array($result)){
                                $total = $total + $row['cantidad'];
                            }
                        $saldo = $saldo - $total;
                        print "<h1>Saldo: " .number_format($saldo,0,',','.'). "<h1>";
                        //print "total:".$total;
                        //print "saldo post:".$_POST['txtSaldo'];
                        print "<input name= txtSaldo type= hidden value = ".$saldo." >";
                    ?>
                    <td>Titular</td>
                    <td><input name="txtNombre" type="text" value="<?php echo $c->getNombre(); ?>" readonly></td>
                </tr>
                <tr>
                    <td>ID Cuenta Titular</td>
                    <td><input name="txtCuenta1" type="text" value="<?php echo $_GET['id_cuenta']; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Monto</td>
                    <td><input name="txtMonto" type="text"></td>
                </tr>
                <tr>
                    <td>Destino</td>
                    <td><select name="txtCuenta2"> 
                        <?php
                            $x = new Cuenta();
                            $x->listar();
                            $result1 = $x->lista;

                            $cl = new Cliente();
                        
                             while ($row1 = mysql_fetch_array($result1)) {
                                $cl->consultar($row1['documento']);
                                $nombre = $cl->getNombre();
                                print "<option value = $row1[id_cuenta]>Cuenta#:$row1[id_cuenta] -- $nombre</option>";
                            }
                        ?>
                        </select>   
                    </td>
                </tr>
                <tr>
                    <td>  </td>
                </tr>
                <tr>
                    <td ><input type="button" name="btnAdicionar" value="Adicionar" onclick="javascript:agregarItem();"></td>
                    <td ><input type="button" name="btnAdicionar" value="Cancelar Tranferencia" onclick="javascript:cancelar();"></td>
                </tr>
                <tr>
                    <td>Detalle</td>
                </tr>
                <TR>
                    <td colspan="2">
                        <table border=1 class="tabla">
                            <tr class="titulo">
                                <td></td>
                                <td>Id</td>
                                <td>Monto</td>
                                <td>Cuenta Origen</td>
                                <td>Titular Destino</td>
                                <td>Cuenta Destino</td>
                            </tr>
                            
                            <?php
                            $d = new Tmp_registro();
                            $d->listar($_GET['id_cuenta']);
                            $result = $d->lista;
                            while ($row = mysql_fetch_array($result)){
                                print "<tr>
                                       <td><a href='javascript:eliminarItem(".$row['id_registro'].");'>Eliminar</a></td>
                                       <td>".$row['id_registro']."</td>
                                       <td>".$row['cantidad']."</td>
                                       <td>".$row['id_cuenta']."</td>
                                       <td>".$row['nombre']."</td>
                                       <td>".$row['cuenta']."</td>    
                                      </tr>";
                                
                                $total2 = $total2 + $row['cantidad'];
                                
                            }
                            //print "<input type=hidden name= total value= ".$total.">";
                            print "<tr><td colspan=6>Total: </td><td align='right'>".number_format($total2,0,',','.')."</td></tr>
                                ";
                            ?>
                            
                            <tr>
                            <td>
                            <input name="btnGrabar" type="submit" value="Grabar" onclick="grabar()">
                            </td>
                            </tr>                           
                            <input type="hidden" name="txtDato">
                            <input type="hidden" name="txtAccion">
                        </table>
                    </td>
                </TR>
                
            </table>
        </form>
        
    </body>
    
</html>


<?php

?>

