<?php

class Rol {
    var $id_rol;
    var $tipo;  
    
    
    var $con;
    var $lista;
    var $numReg;
    
    function Rol( ) {
        $this->id_rol=0;
        $this->tipo="";  
        
        $this->con = new MySql();
        $this->lista = null;
        $this->numReg="";
    }
    
    // métodos setter
    
    // métodos getter
    
    
    function setId_rol( $id_rol) {
        $this->id_rol = $id_rol;
    }

    function getId_rol( ) {
        return $this->id_rol;
    }

    function setTipo( $tipo) {
        $this->tipo = $tipo;
    }

    function getTipo( ) {
        return $this->tipo;
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
        $this->con->sql= "INSERT INTO rol (id_rol,tipo) VALUES (
                                                     ".$this->getId_rol().",
                                                     '".$this->getTipo()."')";

                                                     
                
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
    function actualizar( ) {
        $this->con->sql= "UPDATE rol  
                          SET  tipo='".$this->getTipo()."',
                          WHERE id_rol = ".$this->getId_rol().";";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }

    function eliminar( ) {
        $this->con->sql= "DELETE FROM rol WHERE id_rol=".$this->getId_rol()."";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
   function consultarTipo($id_rol) {
      $this->id_rol = $id_rol;
      $this->con->conectarse();
      $this->con->sql = "SELECT * FROM rol WHERE id_rol=".$this->id_rol."";
      
      $this->con->consultar();
      $this->numReg=$this->con->numReg;
      if ($this->con->numReg > 0) {
         $this->tipo = mysql_result($this->con->rtaSql,0,"tipo");
      }
      $this->con->desconectarse();
   }

   function consultarId($tipo){
    $this->tipo = $tipo;
    $this->con->conectarse();
    $this->con->sql = "SELECT * FROM rol WHERE tipo='".$this->tipo."'";
      
    $this->con->consultar();
    $this->numReg=$this->con->numReg;
    if ($this->con->numReg > 0) {
       $this->id_rol = mysql_result($this->con->rtaSql,0,"id_rol");
    }
    $this->con->desconectarse();

   }

  function listar( ) {
      $this->con->conectarse();
      $this->con->sql = "SELECT id_rol, tipo ".
                "FROM rol";

      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }
}

?>