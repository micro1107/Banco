<?php
//Primero, arranca el bloque PHP y checkea si el archivo tiene nombre.  Si no fue asi, te remite de nuevo al formulario de inserción:
// No se comprueba aqui si se ha subido correctamente.
if (empty($_FILES['archivo']['name'])){
header("location: formulario.php?proceso=falta_indicar_fichero"); //o como se llame el formulario ..
exit;
}

//establece una conexión con la base de datos.
$conexion = mysql_connect("localhost","root","root") or die("No se pudo realizar la conexion con el servidor.");
mysql_select_db("banco",$conexion) or die("No se puede seleccionar BD"); // tu_bd es el nombre de la Base de datos .. por siaca.

// archivo temporal (ruta y nombre).
$binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;

// leer del archvio temporal .. el binario subido.
// "rb" para Windows .. Linux parece q con "r" sobra ...
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

// Obtener del array FILES (superglobal) los datos del binario .. nombre, tabamo y tipo.
$binario_nombre=$_FILES['archivo']['name'];
$binario_peso=$_FILES['archivo']['size'];
$binario_tipo=$_FILES['archivo']['type'];

//insertamos los datos en la BD.
$consulta_insertar = "INSERT INTO archivos (id, archivo_binario, archivo_nombre, archivo_peso, archivo_tipo, documento) VALUES ('', '$binario_contenido', '$binario_nombre', '$binario_peso', '$binario_tipo', ".$_POST['txtDocumento'].")";
mysql_query($consulta_insertar,$conexion) or die("No se pudo insertar los datos en la base de datos.");
header("location: listar_imagenes.php");  // si ha ido todo bien
exit;
?>