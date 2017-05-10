<html>
    <head>
        <script>
            function eliminarItem(id, id_factura) {
              /*alert("Item que desea eliminar = " + id + 
                      "\nfecha" + document.formulario.txtFecha.value);*/
                document.formulario.txtDato.value = id;
                document.formulario.txtAccion.value="DEL_ITEM";
        
                document.formulario.action = "formularioEd.php?id="+id_factura;
                document.formulario.submit();
            }

            function agregarItem( id_factura ) {
                if (document.formulario.cmbCodigo_articulo.value==-1) {
                    alert("Seleccione un articulo.");
                    document.formulario.cmbCodigoArticulo.focus();
                    return;
                }
                else if (document.formulario.txtCantidad.value<1) {
                    alert("Digite una cantidad mayor que 0.");
                    document.formulario.txtCantidad.focus();
                    return;
                }

                document.formulario.txtAccion.value="INS_ITEM";
                document.formulario.action = "formularioEd.php?id="+id_factura;
                document.formulario.submit();
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
            
                include('lib/config.php');
                include('lib/mysql_lib.php');
                include('lib/cliente.php');
                include('lib/cuenta.php');

                if ($_POST['txtAccion']=='DEL_ITEM') {
                    $d = new Detalle( );
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
                    $d = new Detalle( );
                    $d->setId_factura($_GET['id']);
                    $d->setCodigo_articulo($_POST['cmbCodigo_articulo']);
                    $d->setCantidad($_POST['txtCantidad']);
                    $d->insertar();

                    print "<font color='#FF0000'>Item ".$_POST['txtDato']." Eliminado!<br> </font>";
                    ?>
                    <script>
                        document.formulario.txtDato.value = "";
                        document.formulario.txtAccion.value="";
                    </script>
                    <?php
                }
                
                
                $f = new Factura( null, null );
                $f->Consultar( $_GET['id'] );
               
            ?>
            <table>
                <tr>
                    <td>ID</td>
                    <td><input name="txtId" type="text" value="<?php echo $_GET['id']; ?>" readonly></td>
                </tr>
                <tr>
                    <td>FECHA FACT</td>
                    <td><input name="txtFecha" type="text" value="<?php echo $f->getFecha(); ?>"></td>
                </tr>
                <tr>
                    <td>CLIENTE</td>
                    <td><select name="cmbCedula_persona"> 
                        <?php
                            $str = "";
                            $p = new Persona();
                            $p->ListarOrdenadoXNombre();
                            $result = $p->Lista;

                            while ($row = mysql_fetch_array($result)) {
                                $str=$str."<option value='".$row['cedula']."' 
                                             ".(strcmp($f->getCedula_persona(), $row['cedula'])==0?"selected":"")."
                                            >".strtoupper($row['nombre'])." ".strtoupper($row['apellido'])."</option>";
                            }
                            
                            print $str;
                        ?>
                            
                        </select>   
                    </td>
                </tr>
                <tr>
                    <td>OBSERVACIONES</td>
                    <td><textarea name="txtObservaciones"><?php echo $f->observaciones; ?></textarea>
                </tr>
                
                <tr>
                    <td colspan="2"><input name="btnGrabar" type="submit" value="Grabar"></td>
                </tr>

                <TR>
                    <td colspan="2">
                        <table border=1 >
                            <tr>
                                <td></td>
                                <td WIDTH="15">Id</td>
                                <td>Articulo</td>
                                <td>Precio</td>
                                <td>Cantidad</td>
                                <td>Subtotal</td>
                            </tr>
                            
                            <?php
                            $d = new Detalle(  );
                            $d->Listar( $_GET['id'] );
                            $result = $d->Lista;
                            
                            $total=0;
                            
                            while ($row = mysql_fetch_array($result)) {
                                print "<tr>
                                       <td><a href='javascript:eliminarItem(".$row['id'].",".$_GET['id'].");'>Eliminar</a></td>
                                       <td>".$row['id']."</td>
                                       <td>".$row['nombre']."</td>
                                       <td align='right'>".number_format($row['precio'],0,',','.')."</td>
                                       <td align='right'>".$row['cantidad']."</td>    
                                       <td align='right'>".number_format($row['precio']*$row['cantidad'],0,',','.')."</td>
                                      </tr>";
                                
                                $total += $row['precio']*$row['cantidad'];
                            }
                            
                            print "<tr><td colspan=5>Total: </td><td align='right'>".number_format($total,0,',','.')."</td></tr>
                                ";
                            ?>
                            
                            <tr style="background-color:#A0A0A0;">
                            <td>ARTICULO</td>
                            <td  COLSPAN="2"><select name="cmbCodigo_articulo">
                                <?php
                                    $str = "<option value='-1' selected>- Seleccione -</option>";
                                    $a = new Articulo();
                                    $a->Listar();
                                    $result = $a->Lista;

                                    while ($row = mysql_fetch_array($result)) {
                                        $str=$str."<option value='".$row['codigo']."' 
                                                    >".strtoupper($row['nombre'])."</option>";
                                    }

                                    print $str;
                                ?>

                                </select> 
                            </td>
                            </tr>
                            <tr style="background-color:#A0A0A0;">
                            <td>CANTIDAD</td>
                            <td  colspa="2"><input name="txtCantidad" type="text" value=""></td>
                            <td>
                                <input type="button" name="btnAdicionar" value="Adicionar" onclick="javascript:agregarItem(<?php print $_GET ['id']; ?>);">
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

