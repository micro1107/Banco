<?php 
	include("lib/config.php");
	include("lib/mysql_lib.php");
    include("lib/persona_archivo.php");
        
        $pa = new Persona_archivo();
        $pa->consultar( $_GET['id']);
       
        $imagen = $pa->archivo;
        $mime = $pa->tipo;
        
	header("Content-Type: $mime");
	echo $imagen; 
?>