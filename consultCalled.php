<?php
    // Retirando as mensagens de erro do php
    error_reporting(0);
    ini_set(“display_errors”, 0 );

    $id_user = $_COOKIE['id']; // Recuperando o id do usuario e salvando em variavel
    require ('con_db.php'); // Arquivo de conexão com o bando de dados
    // Variavel para armazenar conteudo de possiveis erros no momento da abertura do chamado
    $error = htmlspecialchars($_GET['error']);
    // Caso retorne algum erro ira iniciar a checagem abaixo
    if ($error == 'wrong_post'){
        // Se o resultado for positivo ira exibir uma mensagem informando o usuario do erro
        echo '<script>alert("Erro ao abrir o chamado, tente novamente, caso o problema persista favor entrar em contato com o desenvolvedor")</script>';
    }
?>

<!DOCTYPE html>
<html lan="pt-br">
    <head>
        <title>Suporte</title>
        <meta charset="utf-8">
        <meta name="author" content="Cesar Augusto Manholer">
        <link rel="stylesheet" href="css/consultCalled.css">
    </head>
    <body>
        <!-- Div do menu superior -->
        <div class="top">
            <!-- Titulo do site -->
            <h1>Suporte</h1>
            <!-- Botão para encerrar sessão -->
            <button onclick="window.location.href='session_destroy.php'">Sair</button>
        </div>

        <!-- Link para retornarmos ate a janela anterior -->
        <a id="return" href="home.php"><< Voltar</a>

        <!-- Div onde estaram presentes todos os chamados  -->
        <div class="container">
            <?php
                //Iniciando um query em todos os valores da tabela chamados
                $query = mysqli_query($con, 'SELECT * FROM chamados');
                
                //Iniciando um loop while para recuperar todos os valores obtidos em $query
                while($tb_chamados = mysqli_fetch_array($query)) {
                    //Div onde iram ficar as propriedades dos chamados
                    if($tb_chamados['idUser'] == $id_user){
                        // Se a checagem acima retornar true ira começar a mostrar todos os chamados feito pelo usuario
                        echo'<div class="items">
                            <h4>'; echo $tb_chamados['titulo']; echo'</h4>
                            <p>'; echo $tb_chamados['descricao']; echo'</p>
                            <button class="visualize" id="'; echo $id; echo'" onclick="window.location.href='; echo"'visualizeCalled.php?post_id="; echo $tb_chamados['id']; echo"'"; echo'">Visualizar</button>
                        </div>';
                    }
                }//Fechamento do loop while
            ?>
        </div>
    </body>
</html>