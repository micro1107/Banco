<?php

class Usuario {
    var $login;
    var $pwd;
    var $estado;
    var $id_rol;
    var $documento;  
    var $id_funcionario;
    
    var $con;
    var $lista;
    var $numReg;
    
    function Usuario( ) {
        $this->login="";
        $this->pwd= "";
        $this->estado="";
        $this->id_rol=0;
        $this->documento=0;  
        $this->id_funcionario=0;
        
        $this->con = new MySql();
        $this->lista = null;
        $this->numReg="";
    }
    
    // métodos setter
    
    // métodos getter
    
    function validar( $lo, $pw ) {
        $this->login = $lo;
        $this->pwd = $pw;
        
        $this->con->sql= "SELECT * "
                . "FROM usuario "
                . "WHERE login='".$this->login."' AND pwd= MD5('".$this->pwd."')";

        $this->con->conectarse();
        $this->con->consultar();
        
        $this->numReg = $this->con->numReg;
        $this->con->desconectarse();        
        
        if ( $this->numReg > 0 ) {
            $this->id_rol = mysql_result($this->con->rtaSql,0,"id_rol");
            return 1;
        }
        else {
            return 0;
        }
        
    }
    
    function setLogin( $login) {
        $this->login = $login;
    }
    
    function getLogin( ) {
        return $this->login;
    }

    function setPwd( $pwd) {
        $this->pwd = $pwd;
    }
    
    function getPwd( ) {
        return $this->pwd;
    }
    
    function setId_rol( $id_rol) {
        $this->id_rol = $id_rol;
    }

    function getId_rol( ) {
        return $this->id_rol;
    }

    function setEstado( $estado) {
        $this->estado = $estado;
    }

    function getEstado( ) {
        return $this->estado;
    }

    function setId_funcionario( $id_funcionario) {
        $this->id_funcionario = $id_funcionario;
    }

    function getId_funcionario( ) {
        return $this->id_funcionario;
    }

    function setDocumento( $documento) {
        $this->documento = $documento;
    }

    function getDocumento( ) {
        return $this->documento;
    }

    function set( $login, $pwd, $rol ) {
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
    
    
    function insertar( ) {
        $this->con->sql= "INSERT INTO usuario (login,pwd,estado,id_rol,documento,id_funcionario) VALUES ('".$this->getLogin()."', 
                                                     MD5('".$this->getPwd()."'), 
                                                     ".$this->getEstado().",
                                                     ".$this->getId_rol().",
                                                     ".$this->getDocumento().",
                                                     ".$this->getId_funcionario()."";
                
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
    function actualizar( ) {
        $this->con->sql= "UPDATE usuario  
                          SET  pwd= MD5('".$this->getPwd()."'), 
                               id_rol=".$this->getId_rol().",
                               estado='".$this->getEstado()."',
                          WHERE login = '".$this->getLogin()."' ;";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }

    function eliminar( ) {
        $this->con->sql= "DELETE FROM usuario WHERE login='".$this->getLogin()."'";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
   function consultar($login) {
      $this->login = $login;
      $this->con->conectarse();
      $this->con->sql = "SELECT * FROM usuario WHERE login='".$this->login."'";
      
      $this->con->consultar();
      $this->numReg=$this->con->numReg;
      if ($this->con->numReg > 0) {
         $this->pwd = mysql_result($this->con->rtaSql,0,"pwd");
         $this->id_rol = mysql_result($this->con->rtaSql,0,"id_rol");
      }
      $this->con->desconectarse();
   }

  function listar( ) {
      $this->con->conectarse();
      $this->con->sql = "SELECT login, pwd, id_rol, estado, documento, id_funcionario ".
                "FROM usuario";

      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }
}

?>