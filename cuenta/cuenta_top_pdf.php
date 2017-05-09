<?php

include("lib/config.php");
include("lib/mysql_lib.php");
include("lib/cuenta.php");
include('lib/class.ezpdf.php');
//include ('./lib/Cezpdf.php');
    

$pdf = new Cezpdf('LETTER','portrait');   
//$pdf = new Cezpdf('LEGAL','landscape');

//AJUSTAMOS PREFERENCIAS DEL ARCHIVO 
$pdf->addInfo(array('Title'=>'XYZ','Author'=>'Banco El Ahorro'));
$pdf->setPreferences(array('HideToolBar'=>0,'HideMenuBar'=>0));

//Permisos sobre el archivo... proteccion con contraseña        setEncryption([userPass=''],[ownerPass=''],[pc=array])
//$pdf->setEncryption();
//$pdf->setEncryption('','',array('create','open','select','copy','print'));



// Fijamos margenes usando cent�metros    ezCmMargins(top, bottom, left, right)
$pdf->ezSetCmMargins(2.2,1.5,2,2);


//FIJACION NUMERACION DE PAGINA     setNum = ezStartPageNumbers(x,y,size,[pos],[pattern],[num])
//$pdf->setColor(0,0,1);
$pdf->ezStartPageNumbers(310,20,10,'center','{PAGENUM} de {TOTALPAGENUM}',1);



$pdf->ezImage('img/logo.png',0,70,'none','left');


//FIJAMOS ESTILO DE LETRA A UTILIZAR:  COURIER
$pdf->selectFont('lib/fonts/Courier.afm');

$pdf->addText(200,700,14,'<b> TOP CUENTAS </b>',0);

//FIJAMOS ESTILO DE LETRA A UTILIZAR:  HELVETICA
$pdf->selectFont('lib/fonts/Helvetica.afm');

        $titulo=array ('DATO1'=>'<b>TOP</b>','DATO2'=>'<b>ID_CUENTA</b>','DATO3'=>'<b>TIPO</b>','DATO4'=>'<b>TITULAR</b>','DATO5'=>'<b>ESTADO</b>','DATO6'=>'<b>SALDO</b>', 'DATO7'=>'<b>SUCURSAL</b>', 'DATO8'=>'<b>FECHA_CREACION</b>');  

	$cu= new Cuenta();
	$cu->listarTop( );
        $result = $cu->lista;

        $c=0;
        $top = 1;

        while($row = mysql_fetch_array($result)) {
            switch ($row['tipo']) {
                        case 'A':
                            $tipo = "Ahorros";
                            break;
                        case 'C':
                            $tipo = "Corriente";
                            break;
                    }
                    switch ($row['estado']) {
                        case 'A':
                            $estado = "Activa";
                            break;
                        case 'B':
                            $estado = "Bloqueada";
                            break;    
                    }
                        $datos[$c++]=array ('DATO1'=>$top,'DATO2'=>$row['id_cuenta'],'DATO3'=>$tipo,'DATO4'=>$row['person'],'DATO5'=>$estado,'DATO6'=>$row['saldo'],'DATO7'=>$row['nombre'],'DATO8'=>$row['fecha_crea']);
                        $top = $top + 1;
                  }

        $atributos = array('xPos'=>80,'xOrientation'=>'right','fontSize'=>10,'titleFontSize'=>7,'showLines'=>1,'shaded'=>0,
                            'showHeadings'=>1,  
                            'width'=>380,'colGap'=>3,'rowGap'=>3, 
                            'cols'=> array (
                                            'DATO1'=>array('justification'=>'left','width'=>10),
                                            'DATO2'=>array('justification'=>'left','width'=>10), 
                                            'DATO3'=>array('justification'=>'left','width'=>100),
                                            'DATO4'=>array('justification'=>'left','width'=>200),
                                            'DATO5'=>array('justification'=>'left','width'=>50),
                                            'DATO6'=>array('justification'=>'left','width'=>80),
                                            'DATO7'=>array('justification'=>'left','width'=>80),
                                            'DATO8'=>array('justification'=>'left','width'=>100) 
                                           )
                           );

        $pdf->ezTable($datos, $titulo, ' ', $atributos);


$pdf->ezOutPut();
$pdf->ezStream();

?>