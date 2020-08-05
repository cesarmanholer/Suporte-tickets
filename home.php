<?php
    // Retirando as mensagens de erro do php
    error_reporting(0);
    ini_set(“display_errors”, 0 );
    // Recuperando as informações do usuario por meio dos cookies setados por validate.php
    $id = $_COOKIE['id']; // Id do usuario
    $user = $_COOKIE['user']; // Nome do usuario
    $email = $_COOKIE['email']; // Email do usuario
?>

<!DOCTYPE html>
<html lan="pt-br">
    <head>
        <title>Suporte</title>
        <meta charset="utf-8">
        <meta name="author" content="Cesar Augusto Manholer">
        <link rel="stylesheet" href="css/home.css">
    </head>
    <body>
        <!-- Div do menu superior -->
        <div class="top">
            <!-- Titulo do site -->
            <h1>Suporte</h1>
            <!-- Botão para encerrar sessão -->
            <button onclick="window.location.href='session_destroy.php'">Sair</button>
        </div>

        <!-- Div inde ira ser exibido os dados do usuario logado no momento -->
        <div class="user_info">
            <!-- Box para que quando aplicado a propriedade display:flex no css para que os paragrafos não fiquem na mesma linha -->
            <div class="box_info">
                <!-- Campo onde sera exibido o nome do usuario -->
                <p><b>Usuario:</b> <?php echo $user; ?></p>
                <!-- Campo onde sera exibido o email do usuario -->
                <p><b>Email:</b> <?php echo $email; ?></p>
            </div>
        </div>
        <!-- Container onde esta os botoes para criar e exibir os chamados -->
        <div class="container">
            <!-- Botão responsavel por abrir o menu de criação de chamados -->
            <button id="openCalled" onclick="window.location.href='createCalled.php'">Abrir chamado</button>
            <!--Botão responsavel por eibir os chamados ja abertos anteriormente -->
            <button id="consultCalled" onclick="window.location.href='consultCalled.php'">Consultar meus chamados</button>
        </div>
    </body>
</html>