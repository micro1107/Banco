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
	<script >
	    function validar() {

            var txtNombre, txtEmail, txtDocumento, txtDireccion, txtTelefono;

            txtNombre = document.cliente_grabar.txtNombre.value;
            txtEmail = document.cliente_grabar.txtEmail.value;
            txtDocumento = document.cliente_grabar.txtDocumento.value;
            txtDireccion = document.cliente_grabar.txtDireccion.value;
            txtTelefono = document.cliente_grabar.txtTelefono.value;

            if (txtDocumento=="" || txtDocumento==null){
                alert("Error: Debe digitar un valor para el documento");
                document.cliente_grabar.txtDocumento.focus();
                return;
            }
                else if (isNaN(txtDocumento)){
                    alert("Error: Debe digitar un valor válido para el documento");
                    document.cliente_grabar.txtDocumento.focus();
                    return;
                }

            else if (document.cliente_grabar.txtNombre.value=="" || document.cliente_grabar.txtNombre.value==null){
                alert("Error: Debe digitar un nombre");
                document.usuario_grabar.txtNombre.focus();
                return;
            }
                else if (!isNaN(txtNombre)){
                    alert("Error: Debe digitar un nombre válido");
                    document.cliente_grabar.txtNombre.focus();
                    return;
                }
            
            else if (document.cliente_grabar.txtEmail.value=="" || document.cliente_grabar.txtEmail.value==null){
                alert("Error: Debe digitar un email");
                document.cliente_grabar.txtEmail.focus();
                return;
            }
            else if(!email(txtEmail)){
                alert("Error: Debe digitar un email válido");
                document.cliente_grabar.txtEmail.focus();
                return;
            }

            else if (txtDireccion=="" || txtDireccion==null){
                alert("Error: Debe digitar una dirección");
                document.cliente_grabar.txtDireccion.focus();
                return;
            }

            else if (txtTelefono=="" || txtTelefono==null){
                alert("Error: Debe digitar un nombre");
                document.cliente_grabar.txtTelefono.focus();
                return;
            }
            

		    else{
		    document.cliente_grabar.submit();
		    }
		}

        function email(txtEmail){
            if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(txtEmail)){
              return true;
              } 
              else {
               return false;
              }
            }
        
	</script>
</head>
<body>
<h1>Registro de Cliente</h1>
	<form name="cliente_grabar" action="index.php?sel=C3" method="post">
		<table>
                <tr>
                    <td>Documento</td> 
                    <td><input name= "txtDocumento" type= "text"></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input name="txtNombre" type="text"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input name="txtEmail" type="text"></td>
                </tr>
                <tr>
                	<td>Dirección</td>
                	<td><input name="txtDireccion" type="text"></td>
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td><input name="txtTelefono" type="text"></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="btnGuardar" type="button" value="Guardar" onclick="validar()"></td>
                </tr>
            </table>
        </form>
</body>
</html>