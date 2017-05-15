<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
	<title></title>
    <style>
     /*LISTAR*/

    .titulo td{
    font-family: 'Lalezar', Arial;
    font-size: 15px;
    background: #CCE5FF;
    text-align: center;
    }

    td{
    font-family:  Arial;
    font-size: 11px;
    text-align: center;
    }

    .botonNuevo {
    float: right;
    }

    .tabla tr,td  {
    border-collapse: separate;
    border-spacing:  3px;
    border-style: none;
    }   
    form{
        padding-left:200px;
    }
    
    h1{
        padding-left: 100px;
        font-family: 'Lalezar', Arial;
        color:#0A1B40;
        font-size: 30px; 
    }

    </style>
    <script>
         function abrirPdf(){
                document.pdf.action = "cuenta/cuenta_top_sucursal_pdf.php";
                document.pdf.target = "pdf";
                document.pdf.submit();
        }
        function abrirEx(){
                document.pdf.action = "cuenta/cuenta_top_sucursal_ex.php";
                document.pdf.target = "excel";
                document.pdf.submit();
        }
    </script>
</head>
<body>
    <h1>Top Sucursales</h1>
	<form name="pdf" action="index.php?sel=PDF3">
        <table border="1" class="tabla">
            <tr class="titulo">
            <td>TOP</td><td>CIUDAD</td><td>NOMBRE</td><td>TOTAL</td>
            </tr>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/cuenta.php");
                
                
                $c = new Cuenta();
                $c->listarTopSucursal();
                $result = $c->lista;
                $top = 1;

                if ($top < 10){

                while ($row = mysql_fetch_array($result)) {


                    print "<tr>";
                    print "<td>".$top."</td>";
                    print "<td>".$row['ciudad']."</td>";
                    print "<td>".$row['nombre']."</td>";
                    print "<td>".$row['total']."</td>";
                    print "</tr>";
                    $top = $top + 1;
                    } 
                }
            ?>
            <tr><td colspan="7"><input name="btnInsertar" type="button" class="botonNuevo" value="DescargarPDF" onclick="abrirPdf()" ></td>
            <td><input name="btnInsertar" type="button" class="botonNuevo" value="DescargarExcel" onclick="abrirEx()" ></td>
            </tr>
        </table>
        </form>
</body>
</html>