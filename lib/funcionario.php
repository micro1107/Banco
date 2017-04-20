<?php

class Funcionario {
    var $documento;
    var $nombre;
    var $id_sucursal;
    var $telefono;
    var $email;
    
    
    
    var $con;
    var $lista;
    var $numReg;
    
    function Funcionario( ) {
        $this->documento=0;
        $this->nombre="";
        $this->email="";
        $this->id_sucursal=0;
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

    function setId_sucursal($id_sucursal){
      $this->id_sucursal = $id_sucursal;
    }

    function getId_sucursal(){
      return $this->id_sucursal;
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
        $this->con->sql= "INSERT INTO funcionario (documento, nombre, email, telefono, id_sucursal) VALUES (
                                                     ".$this->getDocumento().",
                                                     '".$this->getNombre()."',
                                                     '".$this->getEmail()."',
                                                     '".$this->getTelefono()."',
                                                     ".$this->getId_sucursal().")";

                                                     
                
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
    function actualizar( ) {
        $this->con->sql= "UPDATE funcionario  
                          SET   nombre = '".$this->getNombre()."',
                                email = '".$this->getEmail()."',
                                id_sucursal = ".$this->getId_sucursal().",
                                telefono = '".$this->getTelefono()."'
                          WHERE documento = ".$this->getDocumento().";";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }

    function eliminar( ) {
        $this->con->sql= "DELETE FROM funcionario WHERE documento=".$this->getDocumento()."";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
   function consultar($documento) {
      $this->documento = $documento;
      $this->con->conectarse();
      $this->con->sql = "SELECT * FROM funcionario WHERE documento=".$this->documento."";
      
      $this->con->consultar();
      $this->numReg=$this->con->numReg;
      if ($this->con->numReg > 0) {
         $this->nombre = mysql_result($this->con->rtaSql,0,"nombre");
         $this->email = mysql_result($this->con->rtaSql,0,"email");
         $this->telefono = mysql_result($this->con->rtaSql,0,"telefono");
         $this->id_sucursal = mysql_result($this->con->rtaSql,0,"id_sucursal");
      }
      $this->con->desconectarse();
   }

  function listar( ) {
      $this->con->conectarse();
      $this->con->sql = "SELECT documento, nombre, email, telefono, id_sucursal ".
                "FROM funcionario";

      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }
}

?>