<?php
    // Retirando as mensagens de erro do php
    error_reporting(0);
    ini_set(“display_errors”, 0 );
?>
<!DOCTYPE html>
<html lan="pt-br">
    <head>
        <title>Suporte</title>
        <meta charset="utf-8">
        <meta name="author" content="Cesar Augusto Manholer">
        <link rel="stylesheet" href="css/createCalled.css">
    </head>
    <body>
        <!-- Div do menu superior -->
        <div class="top">
            <!-- Titulo do site -->
            <h1>Suporte</h1>
            <!-- Botão responsavel por encerrar a sessão -->
            <button onclick="window.location.href='session_destroy.php'">Sair</button>
        </div>
        <!-- Link para retornar a janela anterior -->
        <a href="home.php" id="return"><< Voltar</a>
        <!-- Div que ira conter o formulario -->
        <div class="container">
            <!-- Formulario para a criação do chamado utilizando o method="POST" para não mostrar na URL os valores doa campos abaixo
                utilizando o htmlspecialchars($_SERVER["PHP_SELF"]); para evitar metodos de Cross‑Site Scripting XSS -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <!-- Titulo do formulario -->
                <h1>Abrir Chamado</h1>
                <!-- Area em que sera inserido o titulo do chamado utilizando um <p></p> para indicar a serventia do campo para o usuario -->
                <p>Assunto:</p>
                <input type="text" name="title" id="title" placeholder="">
                <!-- Area em que sera inserido o texto do chamado utilizando um <p></p> para indicar a serventia do campo para o usuario -->
                <p>Descrição:</p>
                <textarea id="descricao" name="descricao"></textarea>
                <!-- Botão para o envio das informações acima utilizando o method="POST" -->
                <input type="submit" name="send" id="send" value="Enviar">
            </form>
        </div>
    </body>
</html>

<?php
    // Arquivo de conexão com o banco de dados
    require ('con_db.php');

    // Variaveis para armazenar os valores passados atraves do formulario acima e atravez dos cookies
    $create = $_POST['send'];           // Estado do botão
    $title = $_POST['title'];           // Titulo do chamado
    $descricao = $_POST['descricao'];   // Conteudo do chamado
    $id_user = $_COOKIE['id'];          // Id do usuario
    // Checando para caso o estado do botão mude para true ira fazer a gravação no banco de dados das informações passadas
    if($create == true){
        // Especificando os parametros a ser usado
        $db_info = "INSERT INTO chamados (titulo,descricao,stats,fechado,idUser) VALUES ('{$title}','{$descricao}','{0}','{0}','{$id_user}')";
        // Realizando a gravação das informações no banco de dados no bando de dados
        mysqli_query($con, $db_info);
        // Encerrando a conexão com o banco de dados
        mysqli_close($con);
        // definindo o estado do botão para false, assim evita um loop infinito
        $create = false;
    }
?>