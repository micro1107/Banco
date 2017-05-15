<html>
    <head>
        <script>
            function insertarRegistro ( ) { 
                document.form.modo.value="INS_A";
                document.form.target="_self";
                document.form.action="index.php?sel=UPF";
                document.form.submit();
            }
            function eliminarArchivo ( id_archivo ) {
                document.form.modo.value = "DEL_A";
                document.form.id_archivo.value = id_archivo;
                document.form.target="_self";
                document.form.action="index.php?sel=UPF";
                document.form.submit();
            }
            
            function verArchivo(id_archivo, tipo_archivo) {
                document.form.id_archivo.value= id_archivo; 
                document.form.tipo_archivo.value= tipo_archivo;  
                document.form.target="_blank"; 
                document.form.action="ver.php"; 
                document.form.submit();
            }

        </script>
    </head>
    <body>

        <form name="form" method="post" enctype="multipart/form-data" action="index.php?sel=UPF">
        <?php
			include("lib/config.php");
			include("lib/mysql_lib.php");
			include("lib/persona_archivo.php");
				
                if ( $_POST['modo'] == 'INS_A' || $_GET['modo'] == 'INS_A') {

                            $documento = $_POST['documento'];

							$con = new Mysql;
							$con->conectarse();
							
							$tipos = array("image/gif","image/jpeg","image/bmp","image/pjpeg","application/pdf");
							$maximo = 1024000; //100Kb
							if (is_uploaded_file($_FILES['imagen']['tmp_name'])) { // Se ha subido?
								if ( in_array($_FILES['imagen']['type'],$tipos) && $_FILES['imagen']['size'] <= $maximo) { // Es correcto?
									$fp = fopen($_FILES['imagen']['tmp_name'], 'r'); //Abrimos la imagen
									$imagen = fread($fp, filesize($_FILES['imagen']['tmp_name'])); //Extraemos el contenido de la imagen
									$imagen = addslashes($imagen);
									fclose($fp); //Cerramos imagen
									if(!get_magic_quotes_gpc())    $nombre = addslashes($_FILES['imagen']['name']); // Arreglamos el Nombre
									else $nombre = $_FILES['imagen']['name'];
									$id = ( $_POST['id']=='' || $_POST['id']==NULL?'NULL':$_POST['id']);
									$query = "INSERT INTO persona_archivo ( archivo, nombre, tipo, id_persona) VALUES ";
									$query.= "( '".$imagen."', '".$nombre."','".$_FILES['imagen']['type']."', '".$_POST['documento']."' )";

									$con->sql = $query;
			                                                
									$con->consultarArchivo();
									$msg = "Se ha grabado el archivo ".$nombre.".";
						  
								} else echo "El formato del archivo no es correcto o es mayor de 1000Kb";
							} else echo "La imagen no ha sido subida";
				
							$con->desconectarse();
                        }
                        elseif ( $_POST['modo'] == 'DEL_A' || $_GET['modo'] == 'DEL_A') {

                            $documento = $_POST['documento'];

                            $pa = new Persona_archivo();
                            $pa->eliminar($_POST['id_archivo']);

                            print "<input type='hidden' value=" .$_POST['documento']. " name='documento' />  ";
                        }
                        else {
                            $documento = $_GET['documento'];
                        }
                        
			
                        print "<table>";
                        print "  <tr><td valign='top' align='center'  colspan=5> <b>Archivos adjuntos (con extensi&oacute;n .bmp o .jpg):</b> </td></tr>";
                        print "<input type='file' name='imagen' /> ";
                        print "<input id='btnNuevoArchivo' name='btnNuevoArchivo' type='button' value='Agregar Archivo' onClick='insertarRegistro()'>";
                        print "<input type='hidden' name='id_archivo' />  ";
                        print "<input type='hidden' name='tipo_archivo' />  ";
                        print "<input type='hidden' name='modo' />  ";
                        print "<input type='hidden' value=" .$_GET['documento']. " name='documento' />  ";
                        print "</table>";

                        
                        $persona_archivo= new Persona_archivo();
                        $persona_archivo->listar($documento);
                        $result=$persona_archivo->lista;

                        print "<table border=0>";
                        while($row = mysql_fetch_array($result)) {

                                print "<tr>  <td> <a href='javascript:eliminarArchivo(".$row['id'].");' title='Eliminar registro'> Eliminar </a></td> 
                                            <td width='430' style=\"cursor:hand\" onMouseOver=\"this.style.background='#FFFFDD'; this.style.color='#006633';\" onMouseOut=\"this.style.background='#FFFFFF'; this.style.color='black'\" onClick='javascript:verArchivo(\"".$row['id']."\",\"".$row['tipo']."\" );' >".$row['nombre']." </td> </tr>";
                                }

                        print "</table>";
        ?>

        </form>
    </body>
</html>
