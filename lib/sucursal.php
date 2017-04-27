<?php

class Sucursal {
    var $id_sucursal;
    var $nombre;
    var $direccion;
    var $telefono;
    var $ciudad;
    
    
    
    var $con;
    var $lista;
    var $numReg;
    
    function Sucursal( ) {
        $this->id_sucursal=0;
        $this->nombre="";
        $this->ciudad="";
        $this->direccion="";
        $this->telefono="";
        
        $this->con = new MySql();
        $this->lista = null;
        $this->numReg="";
    }
    
    // métodos setter
    
    // métodos getter
    
    
    function setId_sucursal( $id_sucursal) {
        $this->id_sucursal = $id_sucursal;
    }

    function getId_sucursal( ) {
        return $this->id_sucursal;
    }

    function setNombre( $nombre) {
        $this->nombre = $nombre;
    }

    function getNombre( ) {
        return $this->nombre;
    }

    function setCiudad( $ciudad) {
        $this->ciudad = $ciudad;
    }

    function getCiudad( ) {
        return $this->ciudad;
    }

    function setDireccion($direccion){
      $this->direccion = $direccion;
    }

    function getDireccion(){
      return $this->direccion;
    }

    function setTelefono($telefono){
      $this->telefono = $telefono;
    }

    function getTelefono(){
      return $this->telefono;
    }


    /*function set( $login, $pwd, $rol ) {
        if ( $login==NULL || $login=='' || $pwd==NULL || $pwd==''
                || $rol==NULL || $rol=='')
            return false;
        else {
            $this->setLogin($login);
            $this->setPwd($pwd);
            $this->setRol($rol);
            return true;
        }
    }
    
    */

    function insertar( ) {
        $this->con->sql= "INSERT INTO sucursal (nombre, direccion, telefono, ciudad) VALUES (
                                                     '".$this->getNombre()."',
                                                     '".$this->getDireccion()."',
                                                     '".$this->getTelefono()."',
                                                     '".$this->getCiudad()."')";

                                                     
                
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
    function actualizar( ) {
        $this->con->sql= "UPDATE sucursal  
                          SET   nombre = '".$this->getNombre()."',
                                ciudad = '".$this->getCiudad()."',
                                direccion = '".$this->getDireccion()."',
                                telefono = '".$this->getTelefono()."'
                          WHERE id_sucursal = ".$this->getId_sucursal().";";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }

    function eliminar( ) {
        $this->con->sql= "DELETE FROM sucursal WHERE id_sucursal=".$this->getId_sucursal()."";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
   function consultar($id_sucursal) {
      $this->id_sucursal = $id_sucursal;
      $this->con->conectarse();
      $this->con->sql = "SELECT * FROM sucursal WHERE id_sucursal=".$this->id_sucursal."";
      
      $this->con->consultar();
      $this->numReg=$this->con->numReg;
      if ($this->con->numReg > 0) {
         $this->nombre = mysql_result($this->con->rtaSql,0,"nombre");
         $this->ciudad = mysql_result($this->con->rtaSql,0,"ciudad");
         $this->telefono = mysql_result($this->con->rtaSql,0,"telefono");
         $this->direccion = mysql_result($this->con->rtaSql,0,"direccion");
      }
      $this->con->desconectarse();
   }

  function listar( ) {
      $this->con->conectarse();
      $this->con->sql = "SELECT id_sucursal, nombre, direccion, telefono, ciudad ".
                "FROM sucursal";

      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }
}

?>