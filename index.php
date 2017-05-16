<!DOCTYPE html>
<html lang="eS">
<head>
	<meta charset="UTF-8">
	<title>El Ahorro</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
</head>
<body>
<?php

@session_start();

if ( $_REQUEST['submit'] ) {
	//include('login.php');
        include("lib/config.php");
        include("lib/mysql_lib.php");
        include("lib/usuario.php");
        
        $usr = new Usuario();
        $usr->consultar($_POST['txtLogin']);
        $rol = $usr->getId_rol();

        if ( $usr->validar( $_POST['txtLogin'], $_POST['txtPassw']) == 1 ) {
        
           $_SESSION['SES_USUARIO'] = $_POST['txtLogin'];
           session_register($_SESSION['SES_USUARIO']);
           $_SESSION['SES_ID_ROL'] = $rol;
           session_register($_SESSION['SES_ID_ROL']);
           
            //print "<meta http-equiv='refresh' content='1;URL=index.php'>";
            
        }
        else {
            print "<form name='form_login' method='post' action='index.php'>";
            print "ERR: El usuario ".$_POST['txtLogin']." no tiene permisos para ingresar a la aplicacion."
                    . " <br> <input type='submit' value='Regresar'>";
            print "</form>";
            exit;
        }
	//exit;
	}

if ( $_GET['p'] == 'logout' ) {
    include('logout.php');
	exit;
	}
      
if ( !isset($_SESSION['SES_USUARIO'] ) && !$_GET['sel'] )
     include("inicio.php");
else {
		// Distribucion de pagina (se sugiere sacar a otro archivo .php
?>

<div id="bunker">
		<div id="cabecera">
        <?php print "<p> Usuario logeado: ".$_SESSION['SES_USUARIO'].", ID ROL = ".$_SESSION['SES_ID_ROL']."   --  <a href='index.php?p=logout'>Logout</a> </p>"; ?> 
        <img src="img/logo.png" width="100px" height="100px" alt="Logo">
        <h1>Banco El Ahorro</h1>
        </div>
		<div id="navegacion"> Navegacion </div>
		<div id="contenedor">
			<div id="menu"> <?php
                                                if ( $_SESSION['SES_ID_ROL']==1){

                                                    include('menu.php');
                                                }
                                                elseif ($_SESSION['SES_ID_ROL']==2){
                                                    include('menu2.php');
                                                }
                                                elseif ($_SESSION['SES_ID_ROL']==3){
                                                    include('menu3.php');
                                                }
                                                else
                                                {
                                                    include('menu.php');
                                                }
                                        ?>

            </div>
			<div id="contenido">
             <?php 
                                switch ( $_GET['sel'] ) {
                                    
                                    case 'U1'   : include ('usuario/usuario_listar.php');
                                                break;
                                    case 'U2'  : include('usuario/usuario_formulario.php');
                                                break;
                                    case 'U3'  : include('usuario/usuario_grabar.php');
                                                break;
                                    case 'U4'  : include('usuario/usuario_eliminar.php');
                                                break;
                                    case 'U5'  : include('usuario/usuario_editar.php');
                                                break;
                                    case 'U6'  : include('usuario/usuario_actualizar.php');  
                                                break;

                                    case 'R1' : include ('rol/rol_listar.php');
                                                break;

                                    case 'C1'   : include ('cliente/cliente_listar.php');
                                                break;
                                    case 'C2'  : include('cliente/cliente_formulario.php');
                                                break;
                                    case 'C3'  : include('cliente/cliente_grabar.php');
                                                break;
                                    case 'C4'  : include('cliente/cliente_eliminar.php');
                                                break;
                                    case 'C5'  : include('cliente/cliente_editar.php');
                                                break;
                                    case 'C6'  : include('cliente/cliente_actualizar.php');  
                                                break;
                                    case 'C7'  : include('cliente/cliente_perfil.php');  
                                                break;

                                    case 'F1'   : include ('funcionario/funcionario_listar.php');
                                                break;
                                    case 'F2'  : include('funcionario/funcionario_formulario.php');
                                                break;
                                    case 'F3'  : include('funcionario/funcionario_grabar.php');
                                                break;
                                    case 'F4'  : include('funcionario/funcionario_eliminar.php');
                                                break;
                                    case 'F5'  : include('funcionario/funcionario_editar.php');
                                                break;
                                    case 'F6'  : include('funcionario/funcionario_actualizar.php');  
                                                break;

                                    case 'S1'   : include ('sucursal/sucursal_listar.php');
                                                break;
                                    case 'S2'  : include('sucursal/sucursal_formulario.php');
                                                break;
                                    case 'S3'  : include('sucursal/sucursal_grabar.php');
                                                break;
                                    case 'S4'  : include('sucursal/sucursal_eliminar.php');
                                                break;
                                    case 'S5'  : include('sucursal/sucursal_editar.php');
                                                break;
                                    case 'S6'  : include('sucursal/sucursal_actualizar.php');  
                                                break;

                                    case 'P1'   : include ('cuenta/cuenta_listar.php');
                                                break;
                                    case 'P2'  : include('cuenta/cuenta_formulario.php');
                                                break;
                                    case 'P3'  : include('cuenta/cuenta_grabar.php');
                                                break;
                                    case 'P4'  : include('cuenta/cuenta_eliminar.php');
                                                break;
                                    case 'P5'  : include('cuenta/cuenta_persona.php');
                                                break;
                                    case 'P6'  : include('cuenta/cuenta_actualizar.php');  
                                                break;
                                    case 'P7'  : include('cuenta/cuenta_bloquear.php');  
                                                break;
                                    case 'P8'  : include('cuenta/cuenta_sucursal.php');
                                                break;
                                    case 'P9'  : include('cuenta/cuenta_consignar.php');
                                                break;
                                    case 'P10'  : include('cuenta/cuenta_retirar.php');
                                                break;
                                    case 'P11'  : include('cuenta/cuenta_transferirMD.php');
                                                break;
                                    case 'P12'  : include('cuenta/cuenta_sobregirar.php');
                                                break;
                                    case 'P13'  : include('cuenta/cuenta_tranzar.php');
                                                break;


                                    case 'CO1'   : include ('registro/registro_consignacion.php');
                                                break;
                                    case 'RE1'  : include('registro/registro_retiro.php');
                                                break;
                                    case 'CU1'  : include('registro/registro_transferencia.php');
                                                break;
                                    case 'SO1'  : include('registro/registro_sobregiro.php');
                                                break;
                                    case 'RE2'  : include('registro/registro_persona.php');
                                                break;
                                    
                                    case 'TOP1'  : include('cuenta/cuenta_top.php');
                                                break;

                                    case 'TOP2'  : include('cuenta/cuenta_top_sucursal.php');
                                                break;

                                    case 'PDF1'  : include('cuenta/cuenta_top_pdf.php');
                                                break;

                                    case 'PDF2'  : include('cliente/cliente_listar_pdf.php');
                                                break;

                                    case 'PDF3'  : include('cuenta/cuenta_top_sucursal_pdf.php');
                                                break;

                                    
                                    case 'UP1'  : include('subirArchivos.php');
                                                break;
                                    case 'UPF'  : include('subirFoto.php');
                                                break;
                                    case 'UPF2'  : include('insertar.php');
                                                break;
                                    case 'UPFA'  : include('subirForm.php');
                                                break;
                                    case '' : include('bienvenida.php');
                                        break;
                                }

                ?>
            </div>
		</div>
		<div id="pie" heigth: 50px;> Creado por Julian Ibarra </div>
        <?php    
     }

?>
</div>
</body>
</html>