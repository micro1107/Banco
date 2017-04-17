<?php
print "Cerrando sesion ".$_SESSION['SES_USUARIO']." ... ";
unset($_SESSION['SES_USUARIO']);

print "<meta http-equiv='refresh' content='1;URL=index.php'>";
?>
