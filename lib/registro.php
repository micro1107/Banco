<?php

class Registro {
    var $id_registro;
    var $cantidad;
    var $cuenta;
    var $fecha;
    var $id_transaccion;
    var $id_cuenta;  
    
    
    var $con;
    var $lista;
    var $numReg;
    
    function Registro( ) {
        $this->id_registro=0;
        $this->cantidad=0;
        $this->cuenta=0;
        $this->fecha="";
        $this->id_transaccion=0;
        $this->id_cuenta=0;
          
        
        $this->con = new MySql();
        $this->lista = null;
        $this->numReg="";
    }
    
    // métodos setter
    
    // métodos getter
    
    
    function setId_registro( $id_registro) {
        $this->id_registro = $id_registro;
    }

    function getId_registro( ) {
        return $this->id_registro;
    }

    function setCantidad( $cantidad) {
        $this->cantidad = $cantidad;
    }

    function getCantidad( ) {
        return $this->cantidad;
    }

    function setCuenta( $ccuenta) {
        $this->cuenta = $cuenta;
    }

    function getCuenta( ) {
        return $this->cuenta;
    }

    function setFecha( $fecha) {
        $this->fecha = $fecha;
    }

    function getFecha( ) {
        return $this->fecha;
    }

    function setId_transaccion( $id_transaccion) {
        $this->id_transaccion = $id_transaccion;
    }

    function getId_transaccion( ) {
        return $this->id_transaccion;
    }

    function setId_cuenta( $id_cuenta) {
        $this->id_cuenta = $id_cuenta;
    }

    function getId_cuenta( ) {
        return $this->id_cuenta;
    }
    

    function insertarConsignacion( ) {
        $this->con->sql= "INSERT INTO reg_tran (cantidad, id_transaccion, id_cuenta) VALUES (
                                                     ".$this->getCantidad().",                                                    
                                                     ".$this->getId_transaccion().",
                                                     ".$this->getId_cuenta().")";                                                  

    }

    function insertar( ) {
        $this->con->sql= "INSERT INTO reg_tran (cantidad, cuenta, id_transaccion, id_cuenta) VALUES (
                                                     ".$this->getCantidad().",
                                                     ".$this->getCuenta().",
                                                     ".$this->getId_transaccion().",
                                                     ".$this->getId_cuenta().")";

                                                     
                
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
    
   /* function actualizar( ) {
        $this->con->sql= "UPDATE rol  
                          SET  tipo='".$this->getTipo()."',
                          WHERE id_rol = ".$this->getId_rol().";";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
*/
  /*  function eliminar( ) {
        $this->con->sql= "DELETE FROM rol WHERE id_rol=".$this->getId_rol()."";
                    
        $this->con->conectarse();
        $this->con->actualizar();
        $this->con->desconectarse(); 
    }
  */
   function consultar($id_registro) {
      $this->id_registro = $id_registro;
      $this->con->conectarse();
      $this->con->sql = "SELECT * FROM reg_tran WHERE id_registro=".$this->id_registro."";
      
      $this->con->consultar();
      $this->numReg=$this->con->numReg;
      if ($this->con->numReg > 0) {
        $this->id_registro = mysql_result($this->con->rtaSql,0,"id_registro");
        $this->cantidad = mysql_result($this->con->rtaSql,0,"cantidad");
        $this->fecha = mysql_result($this->con->rtaSql,0,"fecha");
        $this->cuenta = mysql_result($this->con->rtaSql,0,"cuenta");
        $this->id_transaccion = mysql_result($this->con->rtaSql,0,"id_transaccion");
        $this->id_cuenta = mysql_result($this->con->rtaSql,0,"id_cuenta");
      }
      $this->con->desconectarse();
   }

  function listarConsignaciones( ) {
      $this->con->conectarse();
      $this->con->sql = "SELECT r.id_registro, r.cantidad, r.id_cuenta, r.fecha, p.nombre ".
                "FROM reg_tran r, cliente p, cuenta c  WHERE p.documento = c.documento and c.id_cuenta = r.id_cuenta ";

      $this->con->consultar();
      $this->lista = $this->con->rtaSql;
      $this->numReg = $this->con->numReg;
      $this->con->desconectarse();
   }
}

?>