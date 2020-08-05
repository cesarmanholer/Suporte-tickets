<?php
// Passando um tempo negativo para os cookies, fazendo com que sejam expirados 
setcookie("id", "", time()-3600);
setcookie("email", "", time()-3600);
setcookie("user", "", time()-3600);

// Apos feito tudo ira redirecionar para o menu index.php
header ('Location:index.php');

?>