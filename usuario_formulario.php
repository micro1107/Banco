<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<title></title>
    <link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
    <style>
        h1{
        padding-left: 100px;
        font-family: 'Lalezar', Arial;
        color:#0A1B40;
        font-size: 30px; 
    }
    form{
        padding-left: 100px;
    }
    </style>
	<script>
		function validar() {
		    var txtPwd, txtLogin, txtRol;
		    
		    if (document.usuario_grabar.txtLogin=="" || document.usuario_grabar.txtLogin== null){
		        alert("Error: Debe digitar un valor para el Login");
		        document.usuario_grabar.txtLogin.focus();
		        return;
		    }
		    
		    else{
		        document.usuario_grabar.submit();
		    }
		}
	</script>
</head>
<body>
<h1>Registro de Usuario</h1>
	<form name="usuario_grabar" action="index.php?sel=U3" method="post">
		<table>
                <tr>
                    <td>Login</td> 
                    <td><input name= "txtLogin" type= "text"></td>
                </tr>
                <tr>
                    <td>Passwd</td>
                    <td><input name="txtPwd" type="password"></td>
                </tr>
                <tr>
                    <td>Rol</td>
                    <td><select name="txtRol">
   						<option value="A">Administrador</option> 
  						<option value="F">Funcionario</option> 
   						<option value="C">Cliente</option>
						</select></td>
                </tr>
                <tr>
                	<td>Documento</td>
                	<td><input name="txtDocumento" type="text"></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="button" value="Guardar" onclick="javascript:validar();"></td>
                </tr>
            </table>
        </form>
</body>
</html>