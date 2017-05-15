<html>
    <head>
        <script>
            function eliminarItem(id_registro) {
              /*alert("Item que desea eliminar = " + id + 
                      "\nfecha" + document.formulario.txtFecha.value);*/
                document.formulario.txtDato.value = id_registro;
                document.formulario.txtAccion.value="DEL_ITEM";
        
                document.formulario.action = "cuenta/cuenta_transferirMD.php?id_registro="+id_registro;
                document.formulario.submit();
            }

            function agregarItem() {
                var txtMonto, txtSaldo;

                    txtSaldo = document.formulario.txtSaldo.value;
                    txtMonto = document.formulario.txtMonto.value;
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
                else if (txtMonto > txtSaldo){
                alert("Error: El monto supera el saldo");
                document.formulario.txtMonto.focus();
                return;
                }
                else if (txtSaldo < 10000){
                alert("Error: El saldo está en el limite");
                document.formulario.txtMonto.focus();
                return;
                }
                else {
                document.formulario.txtAccion.value="INS_ITEM";
                document.formulario.action = "cuenta/cuenta_transferirMD.php";
                document.formulario.submit();
                }
            }

            function abrirInforme() {
              /*alert("Item que desea eliminar = " + id + 
                      "\nfecha" + document.formulario.txtFecha.value);*/
                document.formulario.action = "pdf.php";
                document.formulario.target = "pdf";
                document.formulario.submit();
            }
        
        </script>
        
    </head>

    <body>
        <form  name="formulario" action="grabarEd.php" method="post">
            
            <?php
                include('./lib/config.php');
                include('lib/mysql_lib.php');
                include('lib/cliente.php');
                include('lib/cuenta.php');
                include('lib/tmp_registro.php');

                if ($_POST['txtAccion']=='DEL_ITEM') {
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

                if ($_POST['txtAccion']=='INS_ITEM') {
                    $d = new Tmp_registro( );
                    $d->setCuenta($_POST['txtCuenta2']);
                    $d->setId_cuenta($_POST['txtCuenta1']);
                    $d->setCantidad($_POST['txtMonto']);
                    $d->insertar();
                    //print "<font color='#FF0000'>Item ".$_POST['txtDato']." Eliminado!<br> </font>";
                    ?>
                    <script>
                        document.formulario.txtDato.value = "";
                        document.formulario.txtAccion.value="";
                    </script>
                    <?php
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
                        $saldo = $saldo - $total;

                        print "<h1>Saldo: " .$saldo. "<h1>";
                        print "<input name= txtSaldo type= hidden value = ".$saldo." readonly>";
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
                    <td colspan="2"><input type="button" name="btnAdicionar" value="Adicionar" onclick="javascript:agregarItem();"></td>
                </tr>
                <TR>
                    <td colspan="2">
                        <table border=1 >
                            <tr>
                                <td></td>
                                <td>Id</td>
                                <td>Monto</td>
                                <td>Cuenta Origen</td>
                                <td>Titular Destino</td>
                                <td>Cuenta Destino</td>
                            </tr>
                            
                            <?php
                            $d = new Tmp_registro();
                            $d->listar( );
                            $result = $d->lista;
                            while ($row = mysql_fetch_array($result)) {
                                print "<tr>
                                       <td><a href='javascript:eliminarItem(".$row['id_registro'].");'>Eliminar</a></td>
                                       <td>".$row['id_registro']."</td>
                                       <td>".$row['cantidad']."</td>
                                       <td>".$row['id_cuenta']."</td>
                                       <td>".$row['nombre']."</td>
                                       <td>".$row['cuenta']."</td>    
                                      </tr>";
                                
                                $total += $row['cantidad'];
                            }
                            
                            print "<tr><td colspan=6>Total: </td><td align='right'>".number_format($total,0,',','.')."</td></tr>
                                ";
                            ?>
                            
                            <tr>
                            <td>
                            <input name="btnGrabar" type="submit" value="Grabar">
                            </td>
                            <td>
                                <input type="button" name="btnAbrirInforme" value="Abrir Informe" onclick="javascript:abrirInforme();">
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

