<?php
    // Retirando as mensagens de erro do php
    //error_reporting(0);
    //ini_set(“display_errors”, 0 );

    // Recuperando o ID do chamado pela url
    $post_id = htmlspecialchars($_GET["post_id"]);
    // Criando conexão com o banco de dados
    require ('con_db.php');
    
    //Iniciando verificação para a procura do chamado
    $verifica = "SELECT * FROM chamados WHERE id = '$post_id' LIMIT 1"; // Especificando o parametro a ser usado
    $resultado_usuario = mysqli_query($con, $verifica); // Realizando a verificação
    $resultado = mysqli_fetch_assoc($resultado_usuario); // Recuperando as informações obtidas em forma de array
    // Caso encontre um chamado que corresponda com os parametros passados, ira retornar true
    // Caso retorne true ira salvar os respectivos dados abaixo
    if (isset($resultado)){
        // Titulo do chamado
        $post_title = $resultado['titulo'];
        // Descricao do chamado
        $post_description = $resultado['descricao'];
    }else{
        // Caso retorne false ira redirecionar o usuario para a home.php com uma mensagem de erro
        header('Location:consultCalled.php?error=wrong_post');
    }
    ?>

<!DOCTYPE html>
<html lan="pt-br">
    <head>
        <title>Suporte - <?php echo $post_title; ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/visualizeCalled.css">
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
                <p><b>Usuario:</b> <?php echo $_COOKIE['user']; ?></p>
                <!-- Campo onde sera exibido o email do usuario -->
                <p><b>Email:</b> <?php echo $_COOKIE['email']; ?></p>
            </div>
        </div>
        <!-- Div onde estara contido todos os recursos -->
        <div class="container">
            <!-- Div onde sera exibido o chamado -->
            <div class="post">
                <!-- Titulo do chamado -->
                <h4><?php echo $post_title; ?></h4>
                <!-- Descrição do chamado -->
                <p><?php echo $post_description; ?></p>
            </div>

            <?php
                // Parametros para a pesquisa no banco de dados
                $query = mysqli_query($con, 'SELECT * FROM respostas');
                // Loop while responsavel por verificar toda a tabela em busca das linhas compativeis
                while($tb_chamados = mysqli_fetch_array($query)) {
                    // Verificando se as respostas encontradas são do chamado que o usuario esta visualizando
                    if($tb_chamados['idpost'] == $post_id){
                        // Verificando o status do chamado para diferenciar os usuarios dos administradores
                        if($tb_chamados['stats'] == 0){
                            echo'
                            <div class="answer_user">
                                <p>'; echo $tb_chamados['comentario']; echo'</p>
                            </div>';
                        }elseif($tb_chamados['stats'] == 1){
                            echo'
                            <div class="answer_adm">
                                <p>'; echo $tb_chamados['comentario']; echo'</p>
                            </div>';
                        }
                    }
                }
            ?>
        <!-- Div do container do formulario de resposta -->
        <div class="answer_call">
            <!-- Formulario de resposta utilizando method="POST para não expor as informações na URL,
                Utilizando tambem htmlspecialchars($_SERVER["PHP_SELF"]); para evitar Cross‑Site Scripting XSS -->
            <form method="POST" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                <!-- As respostas serão preenchidas no <textarea></textarea> -->
                <textarea id="att_call" name="att_call"></textarea>
                <!-- Botão para enviar a resposta para o banco de dados -->
                <input type="submit" name="waiting" id="waiting" value="Aguardando resposta">
                <input type="submit" name="resolved" id="resolved" value="Resolvido">
                <input type="submit" name="delete" id="delete" value="Deletar">
            </form>
        </div>
    </body>
<html>

<?php
    // As variaveis abaixo são responsaveis por armazenar as informações necessarias para o registro do administrador no banco de dados
    $waiting = $_POST['waiting'];       // Estado do botão para definir como aguardando resposta
    $resolved = $_POST['resolved'];     // Estado do botão para definir chamado como resolvido
    $delete = $_POST['delete'];         // Estado do botão para definir chamado como deletado
    $comment = $_POST['att_call'];      // Conteudo da resposta do administrador
    $email = $_COOKIE['email'];         // Email do administrador
    $nome = $_COOKIE['user'];           // Nome do administrador
    $id_user = $_COOKIE['id'];          // Id do administrador
    // Caso o estado do botão passe a ser true então ira começar a verificação abaixo
    if($waiting == true){
        // Especificando os parametros da respostas
        $db_resposta = "INSERT INTO respostas (nome,email,comentario,idpost,user,stats) VALUES ('{$nome}','{$email}','{$comment}','{$post_id}','{$id_user}','1')";
        // Especiicando os parametros do chamado
        $sql = "UPDATE chamados SET stats='2' WHERE id='{$post_id}'";
        // Inserindo os dados da resposta no banco de dados
        mysqli_query($con, $db_resposta);
        // Inserindo a atualização do chamado no banco de dados
        mysqli_real_query($con, $sql);
        // mysqli_query($con, $db_chamados);
        // Encerrando conexão com o banco de dados
        mysqli_close($con);
        // Iniciando um refresh na pagina para que as informações passadas via POST sejam apagadas do navegador
        header ('Refresh: 10; url = visualizeCalled.php?post_id=' . $post_id);
        // Definindo o estado do botão como false, evitando assim um loop infinito
        $delete = false;
    }

    if($resolved == true){
        // Especificando os parametros da respostas
        $db_resposta = "INSERT INTO respostas (nome,email,comentario,idpost,user,stats) VALUES ('{$nome}','{$email}','{$comment}','{$post_id}','{$id_user}','1')";
        // Especiicando os parametros do chamado
        $sql = "UPDATE chamados SET stats='3' WHERE id='{$post_id}'";
        // Inserindo os dados da resposta no banco de dados
        mysqli_query($con, $db_resposta);
        // Inserindo a atualização do chamado no banco de dados
        mysqli_real_query($con, $sql);
        // mysqli_query($con, $db_chamados);
        // Encerrando conexão com o banco de dados
        mysqli_close($con);
        // Iniciando um refresh na pagina para que as informações passadas via POST sejam apagadas do navegador
        header ('Refresh: 10; url = visualizeCalled.php?post_id=' . $post_id);
        // Definindo o estado do botão como false, evitando assim um loop infinito
        $delete = false;
    }

    if($delete == true){
        // Especificando os parametros da respostas
        $db_resposta = "INSERT INTO respostas (nome,email,comentario,idpost,user,stats) VALUES ('{$nome}','{$email}','{$comment}','{$post_id}','{$id_user}','1')";
        // Especiicando os parametros do chamado
        $sql = "UPDATE chamados SET stats='4' WHERE id='{$post_id}'";
        // Inserindo os dados da resposta no banco de dados
        mysqli_query($con, $db_resposta);
        // Inserindo a atualização do chamado no banco de dados
        mysqli_real_query($con, $sql);
        // mysqli_query($con, $db_chamados);
        // Encerrando conexão com o banco de dados
        mysqli_close($con);
        // Iniciando um refresh na pagina para que as informações passadas via POST sejam apagadas do navegador
        header ('Refresh: 10; url = visualizeCalled.php?post_id=' . $post_id);
        // Definindo o estado do botão como false, evitando assim um loop infinito
        $delete = false;
    }
?>