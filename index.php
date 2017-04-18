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
        
        if ( $usr->validar( $_POST['txtLogin'], $_POST['txtPassw']) == 1 ) {
        
           $_SESSION['SES_USUARIO'] = $usr->login;
           session_register($_SESSION['SES_USUARIO']);
           $_SESSION['SES_ID_ROL'] = $usr->id_rol;
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
        <img src="img/logo.png" width="100px" height="100px" alt="Logo" >
        <h1>Banco El Ahorro</h1>
        </div>
		<div id="navegacion"> Navegacion </div>
		<div id="contenedor">
			<div id="menu"> <?php
                                                if ( $_SESSION['SES_ID_ROL']==1){

                                                    include('menu.php');
                                                }
                                                else{
                                                    include('menu.php');
                                                }
                                        ?>
                                        
            </div>
			<div id="contenido">
             <?php 
                                switch ( $_GET['sel'] ) {
                                    case 'U1'   : include ('usuario/usuario_listar.php');
                                                print 'Lista de usuarios';
                                                break;
                                    case 'U2'  : include('usuario_formulario.php');
                                                print 'Registro de nuevo usuario';
                                                break;
                                    case 'U3'  : include('usuario_grabar.php');
                                                print 'Grabación de usuario';
                                                break;
                                    case 'U4'  : include('usuario_eliminar.php');
                                                print 'Eliminación de usuario';
                                                break;
                                    case 'U5'  : include('usuario_editar.php');
                                                print 'Edición de usuario';
                                                break;
                                    case 'U6'  : include('usuario_actualizar.php');  
                                                print 'Actualización de usuario';
                                                break;

                                    case 'C1'   : include ('cliente/cliente_listar.php');
                                                print 'Lista de clientes';
                                                break;
                                    case 'C2'  : include('cliente/cliente_formulario.php');
                                                print 'Registro de nuevo cliente';
                                                break;
                                    case 'C3'  : include('cliente_grabar.php');
                                                print 'Grabación de cliente';
                                                break;
                                    case 'C4'  : include('cliente_eliminar.php');
                                                print 'Eliminación de cliente';
                                                break;
                                    case 'C5'  : include('cliente_editar.php');
                                                print 'Edición de cliente';
                                                break;
                                    case 'C6'  : include('cliente_actualizar.php');  
                                                print 'Actualización de cliente';
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