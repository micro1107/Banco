<html>
    <body>
            <?php
                include("lib/config.php");
                include("lib/mysql_lib.php");
                include("lib/usuario.php");
                include("lib/rol.php");
                include("lib/cliente.php");
                include("lib/funcionario.php");

                $p = new Usuario();

                $r = new Rol();
                $r->consultarId($_POST['txtRol']);
                $id_rol = $r->getId_rol();

                $p->listar();
                $result = $p->lista;

                $rol = $_POST['txtRol'];
                $alerta2=0;

                while ($row = mysql_fetch_array($result)) {
                if ($row['login']==$_POST['txtLogin']){
                    $alerta = 1;
                }
                }

                switch ($rol) {
                    case 'C':
                        $c = new Cliente();
                        $c->listar();
                        $res = $c->lista;

                        while ($row = mysql_fetch_array($res)) {
                        if ($row['documento']==$_POST['txtDocumento']) {
                            $alerta2 = 2;
                        }
                        }
                        break;
                    case 'F':
                        $f = new Funcionario();
                        $f->listar();
                        $res = $f->lista;
                        while ($row = mysql_fetch_array($res)) {
                        if ($row['documento']==$_POST['txtDocumento']) {
                            $alerta2 = 2;
                        }
                        }
                        break;
                    case 'A':
                        $alerta2 =2;
                        break;
                }

                if ($alerta2==0) {
                echo "El documento asociado no existe";
                }
                elseif($alerta!=1){
                $p->setLogin($_POST['txtLogin']);
                $p->setPwd($_POST['txtPwd']);
                $p->setId_rol($id_rol);
                $p->setDocumento($_POST['txtDocumento']);
                $p->setEstado('A');
                $p->insertar();
                $p->actualizar();   

            
                echo "Usuario ".$_POST['txtLogin']." registrado correctamente";
            }
            
            else{
                echo "El usuario " .$_POST['txtLogin']. " ya existe";
            }
            ?>
    </body>
    
</html>