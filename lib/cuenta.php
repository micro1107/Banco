<?php

class Cuenta {
    var $id_cuenta;
    var $tipo;
    var $fecha_crea;
    var $saldo;
    var $documento;
    var $id_sucursal;
    var $estado;
    
    var $con;
    var $lista;
    var $numReg;
    
    function Cuenta( ) {
        $this->id_cuenta=0;
        $this->tipo="";
        $this->fecha_crea="";
        $this->saldo=0;
        $this->documento=0;
        $this->id_sucursal=0;
        $this->estado="";
        
        $this->con = new MySql();
        $this->lista = null;
        $this->numReg="";
    }
    
    // métodos setter
    
    // métodos getter
    
    function setId_cuenta( $id_cuenta) {
        $this->id_cuenta = $id_cuenta;
    }

    function getId_cuenta( ) {
        return $this->id_cuenta;
    }

    function setId_sucursal( $id_sucursal) {
        $this->id_sucursal = $id_sucursal;
    }

    function getId_sucursal( ) {
        return $this->id_sucursal;
    }

    function setTipo( $tipo) {
        $this->tipo = $tipo;
    }

    function getTipo( ) {
        return $this->tipo;
    }

    function setFecha_crea( $fecha_crea) {
        $this->fecha_crea = $fecha_crea;
    }

    function getFecha_crea( ) {
        return $this->fecha_crea;
    }

    function setSaldo($saldo){
      $this->saldo = $saldo;
    }

    function getSaldo(){
      return $this->saldo;
    }

    function setDocumento($documento){
      $this->documento = $documento;
    }

    function getDocumento(){
      return $this->documento;
    }

    function setEstado($estado){
      $this->estado = $estado;
    }

    function getEstado(){
      return $this->estado;
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
        $this->con->sql= "INSERT INTO cuenta (tipo, saldo, estado, documento, id_sucursal) VALUES (
                                                     '".$this->getTipo()."',
                                                     ".$this->getSaldo().",
                                                     '".$this->getEstado()."',
                                                     ".$this->getDocumento().",
                                                     ".$this->getId_sucursal().")";

                                                     
                
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
    function actualizar( ) {
        $this->con->sql= "UPDATE cuenta SET 
                                saldo = ".$this->getSaldo().",
                                estado = '".$this->getEstado()."'
                          WHERE id_cuenta = ".$this->getId_cuenta().";";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }

    function eliminar( ) {
        $this->con->sql= "DELETE FROM cuenta WHERE id_cuenta=".$this->getId_cuenta()."";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
   function consultar($id_cuenta) {
      $this->id_cuenta = $id_cuenta;
      $this->con->conectarse();
      $this->con->sql = "SELECT * FROM cuenta WHERE id_cuenta=".$this->id_cuenta."";
      
      $this->con->consultar();
      $this->numReg=$this->con->numReg;
      if ($this->con->numReg > 0) {
         $this->tipo = mysql_result($this->con->rtaSql,0,"tipo");
         $this->saldo = mysql_result($this->con->rtaSql,0,"saldo");
         $this->id_cuenta = mysql_result($this->con->rtaSql,0,"id_cuenta");
         $this->id_sucursal = mysql_result($this->con->rtaSql,0,"id_sucursal");
         $this->fecha_crea = mysql_result($this->con->rtaSql,0,"fecha_crea");
         $this->estado = mysql_result($this->con->rtaSql,0,"estado");
         $this->documento = mysql_result($this->con->rtaSql,0,"documento");

      }
      $this->con->desconectarse();
   }

  function listar( ) {
      $this->con->conectarse();
      $this->con->sql = "SELECT c.id_cuenta, c.tipo, c.saldo, c.id_sucursal, c.fecha_crea, c.estado, c.documento,  ".
                "p.nombre as person, s.nombre ".
                "FROM cuenta c , cliente p , sucursal s  WHERE c.documento = p.documento  and c.id_sucursal = s.id_sucursal ORDER BY c.id_cuenta";

      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }

   function listarTop( ) {
      $this->con->conectarse();
      $this->con->sql = "SELECT c.id_cuenta, c.tipo, c.saldo, c.id_sucursal, c.fecha_crea, c.estado, c.documento,  ".
                "p.nombre as person, s.nombre ".
                "FROM cuenta c , cliente p , sucursal s  WHERE c.documento = p.documento  and c.id_sucursal = s.id_sucursal and c.estado = 'A' ORDER BY c.saldo DESC";

      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }

   function consultarUltimo($documento) {
      $this->documento = $documento;
      $this->con->conectarse();
      $this->con->sql = "SELECT MAX(id_cuenta) as id_cuenta FROM cuenta WHERE documento =".$this->documento."";
      
      $this->con->consultar();
      $this->numReg=$this->con->numReg;
      if ($this->con->numReg > 0) {
         $this->id_cuenta = mysql_result($this->con->rtaSql,0,"id_cuenta");
       }
      $this->con->desconectarse();
   }

   function listarPorPersona($documento) {
      $this->documento = $documento;
      $this->con->conectarse();
      $this->con->sql = "SELECT c.id_cuenta, c.tipo, c.saldo, c.id_sucursal, c.fecha_crea, c.estado, c.documento,  ".
                "p.nombre as person, s.nombre ".
                "FROM cuenta c , cliente p , sucursal s  WHERE c.documento = p.documento and c.documento = ".$this->documento." and c.id_sucursal = s.id_sucursal ORDER BY c.id_cuenta";

      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }

   function listarPorSucursal($id_sucursal) {
      $this->id_sucursal = $id_sucursal;
      $this->con->conectarse();
      $this->con->sql = "SELECT c.id_cuenta, c.tipo, c.saldo, c.id_sucursal, c.fecha_crea, c.estado, c.documento,  ".
                "p.nombre as person, s.nombre ".
                "FROM cuenta c , cliente p , sucursal s  WHERE c.id_sucursal = ".$this->id_sucursal." and c.id_sucursal = s.id_sucursal and c.documento = p.documento ORDER BY c.id_cuenta";

      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }

   function listarTopSucursal(){
    $this->con->conectarse();
      $this->con->sql = "SELECT s.nombre, sum(r.cantidad) as total, c.id_sucursal ".
            " FROM  cuenta c , sucursal s , reg_tran r WHERE r.id_cuenta = c.id_cuenta AND c.id_sucursal = s.id_sucursal GROUP BY s.id_sucursal ORDER BY total desc";


      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }

}

?>