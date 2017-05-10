<?php

include("lib/config.php");
include("lib/mysql_lib.php");
include("lib/cliente.php");
include("lib/class.ezpdf.php");
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

$pdf->addText(200,700,14,'<b> CLIENTES </b>',0);

//FIJAMOS ESTILO DE LETRA A UTILIZAR:  HELVETICA
$pdf->selectFont('lib/fonts/Helvetica.afm');

        $titulo=array ('DATO1'=>'<b>DOCUMENTO</b>','DATO2'=>'<b>NOMBRE</b>','DATO3'=>'<b>EMAIL</b>','DATO4'=>'<b>DIRECCION</b>','DATO5'=>'<b>TELEFONO</b>');  

	$cu = new Cliente();
	$cu->listar( );
        $result = $cu->lista;

        $c=0;

        while($row = mysql_fetch_array($result)) {
            
                        $datos[$c++]=array ('DATO1'=>$row['documento'],'DATO2'=>$row['nombre'],'DATO3'=>$row['email'],'DATO4'=>$row['direccion'],'DATO5'=>$row['telefono']);
                  }

        $atributos = array('xPos'=>80,'xOrientation'=>'right','fontSize'=>10,'titleFontSize'=>7,'showLines'=>1,'shaded'=>0,
                            'showHeadings'=>1,  
                            'width'=>500,'colGap'=>3,'rowGap'=>3, 
                            'cols'=> array (
                                            'DATO1'=>array('justification'=>'left','width'=>80),
                                            'DATO2'=>array('justification'=>'left','width'=>100), 
                                            'DATO3'=>array('justification'=>'left','width'=>100),
                                            'DATO4'=>array('justification'=>'left','width'=>100),
                                            'DATO5'=>array('justification'=>'left','width'=>80)
                                           )
                           );

        $pdf->ezTable($datos, $titulo, ' ', $atributos);


$pdf->ezOutPut();
$pdf->ezStream();

?>