<?php
  class Persona_archivo {
      var $id;
      var $id_persona;
      var $tipo;
      var $nombre;
      
      var $con;
      var $lista;
      var $numReg;
      
      function Persona_archivo( ) {
          $this->id = 0;
          $this->id_persona = "";
          $this->tipo = "";
          $this->nombre = "";
          
          $this->con = new Mysql();
          $this->lista = null;
          $this->numReg = "";
      }
      
      function eliminar ($id) {
          $this->con->conectarse();
          
	         $this->con->sql = "DELETE FROM persona_archivo WHERE id = ".$id."; ";
          
           $this->con->consultarArchivo();
	         $this->con->desconectarse();
      }

      function consultar($id) {
          $this->id = $id;
          
          $this->con->conectarse();
          $this->con->sql = "SELECT archivo, tipo 
                             FROM persona_archivo 
                             WHERE id_persona = ".$this->id."; ";

          $this->con->consultar();
          $this->numReg=$this->con->numReg;
     
          if ($this->con->numReg > 0) {
              $this->archivo = mysql_result($this->con->rtaSql,0,"archivo");
              $this->tipo = mysql_result($this->con->rtaSql,0,"tipo");
          }
          
          $this->con->desconectarse();
        }      
   
      function listar($documento) {
          $this->documento = $documento;
          $this->con->conectarse();
          $this->con->sql = "SELECT id, id_persona, tipo, nombre 
                             FROM persona_archivo WHERE id_persona = " .$this->documento. "
                             ORDER BY id;";

          $this->con->consultar();
          $this->lista = $this->con->rtaSql;
          $this->numReg = $this->con->numReg;
          $this->con->desconectarse();
      }
  }
?>
