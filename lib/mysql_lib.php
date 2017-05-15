<?php
class Mysql {
 var $host;
 var $user;
 var $pwd;
 var $baseDatos;
 var $sql;
 var $rtaSql;
 var $enlace;
 var $numReg;

 function Mysql () {
    global $CFG_HOST, $CFG_USER, $CFG_DBPWD, $CFG_DBASE;
    $this->host = $CFG_HOST;
    $this->user = $CFG_USER;
    $this->pwd = $CFG_DBPWD;
    $this->baseDatos = $CFG_DBASE;
    $this->sql = "";
    $this->rtaSql = "";
    $this->enlace = null;
    $this->numReg = 0;
    }

function conectarse() {
 if (($this->enlace = mysql_connect($this->host, $this->user, $this->pwd)) != null) {
    if (mysql_select_db($this->baseDatos, $this->enlace) != null) {
        mysql_query("SET NAMES 'latin1'",$this->enlace);
             return($this->enlace);
        } else {
             print "<b>Error:</b> No se ha podido seleccionar la BD $CFG_DBASE";
             return (null);
            }
         } else {
         print "<b>Error:</b> No se ha podido establecer la conexión con $CFG_HOST";
        return (null);
    }
 }    

 function consultar() {
    $this->rtaSql = mysql_query($this->sql);
    $this->numReg = mysql_num_rows($this->rtaSql);
    }

 function actualizar() {
    $this->rtaSql = mysql_query($this->sql);
    }
 function consultarArchivo() {
    $this->rtaSql = mysql_query($this->sql);
    }
function desconectarse() {
    mysql_close();
    }
}   
?>
