<?php

class Cliente {
    var $documento;
    var $nombre;
    var $direccion;
    var $telefono;
    var $email;
    
    
    
    var $con;
    var $lista;
    var $numReg;
    
    function Cliente( ) {
        $this->documento=0;
        $this->nombre="";
        $this->email="";
        $this->direccion="";
        $this->telefono="";
        
        $this->con = new MySql();
        $this->lista = null;
        $this->numReg="";
    }
    
    // métodos setter
    
    // métodos getter
    
    
    function setDocumento( $documento) {
        $this->documento = $documento;
    }

    function getDocumento( ) {
        return $this->documento;
    }

    function setNombre( $nombre) {
        $this->nombre = $nombre;
    }

    function getNombre( ) {
        return $this->nombre;
    }

    function setEmail( $email) {
        $this->email = $email;
    }

    function getEmail( ) {
        return $this->email;
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
        $this->con->sql= "INSERT INTO cliente (documento, nombre, email, direccion, telefono) VALUES (
                                                     ".$this->getDocumento().",
                                                     '".$this->getNombre()."',
                                                     '".$this->getEmail()."',
                                                     '".$this->getDireccion()."',
                                                     '".$this->getTelefono()."')";

                                                     
                
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
    function actualizar( ) {
        $this->con->sql= "UPDATE cliente  
                          SET   nombre = '".$this->getNombre()."',
                                email = '".$this->getEmail()."',
                                direccion = '".$this->getDireccion()."',
                                telefono = '".$this->getTelefono()."'
                          WHERE documento = ".$this->getDocumento().";";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }

    function eliminar( ) {
        $this->con->sql= "DELETE FROM cliente WHERE documento=".$this->getDocumento()."";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
   function consultar($documento) {
      $this->documento = $documento;
      $this->con->conectarse();
      $this->con->sql = "SELECT * FROM cliente WHERE documento=".$this->documento."";
      
      $this->con->consultar();
      $this->numReg=$this->con->numReg;
      if ($this->con->numReg > 0) {
         $this->nombre = mysql_result($this->con->rtaSql,0,"nombre");
         $this->email = mysql_result($this->con->rtaSql,0,"email");
         $this->telefono = mysql_result($this->con->rtaSql,0,"telefono");
         $this->direccion = mysql_result($this->con->rtaSql,0,"direccion");
      }
      $this->con->desconectarse();
   }

  function listar( ) {
      $this->con->conectarse();
      $this->con->sql = "SELECT documento, nombre, email, direccion, telefono ".
                "FROM cliente";

      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }
}

?>