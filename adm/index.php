<?php
    // Retirando as mensagens de erro do php
    error_reporting(0);
    ini_set(“display_errors”, 0 );
    // Verificando se ha erros de tentativa de login passados pela URL em validate.php
    if($_GET['error'] == 'enter'){
        $erro = true;
    }else{
        $erro = false;
    }
?>

        <!DOCTYPE html>
        <html lan="pt-br">
            <head>
                <title>Suporte</title>
                <meta charset="utf-8">
                <link rel="stylesheet" href="css/index.css">
            </head>
            <body>
                <div id="container">
                    <form method="POST" action="validate.php">
                        <?php
                            if($erro){
                                echo'<div id="msgError">Usuario ou senha incorreto.</div>';
                            }
                        ?>
                        <h1>ADMINISTRADOR</h1>
                        <p>Nome de usuario:</p>
                        <input id="username" name="username" type="text" placeholder="">

                        <p>Senha:</p>
                        <input id="password" name="password" type="password" placeholder="">

                        <br><input type="submit" name="send" id="send" value="Enviar">
                        <p id="reg">Ainda não possui uma conta? <a href="register.php">Registre-se</a></p>
                    </form>
                </div>
            </body>
        </html>