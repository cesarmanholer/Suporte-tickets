<?php
    require 'con_db.php';
?>

<!DOCTYPE html>
<html lan="pt-br">
    <head>
        <title>Suporte</title>
        <meta charset="utf-8">
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
        <!-- Conteiner de todo o conteudo da pagina -->
        <div class="container">
            <!-- Menu lateral -->
            <div class="left-bar">
                <!-- Botão para listar somente os chamados abertos -->
                <button class="open">Abertos</button>
                <!-- Botão para listar somente os chamados aguardando resposta -->
                <button class="waiting">Aguardando resposta</button>
                <!-- Botão para listar somente os chamados resolvidos -->
                <button class="resolved">Resolvidos</button>
                <!-- Botão para listar somente os chamados deletados -->
                <button class="deleted">Deletados</button>
            </div>
            <!-- Menu do centro -->
            <div class="midle-content">
                <!-- Chamados -->
                <?php
                    $verifica = "SELECT * FROM chamados";
                    $verifica_chamado = mysqli_query($con, $verifica);
                    while($tb_chamados = mysqli_fetch_array($verifica_chamado)) {
                        // Verificando o status dos chamados encontrados
                        // Chamados abertos
                        if($tb_chamados['stats'] == 1){
                            echo'
                            <div class="items">
                                <h4>'; echo $tb_chamados['titulo']; echo '</h4>
                                <p>'; echo $tb_chamados['descricao']; echo'</p>
                                <button class="edit" onclick="window.location.href='; echo"'visualizeCalled.php?post_id="; echo $tb_chamados['id']; echo"'"; echo'">Responder</button>
                            </div>';
                        // Chamados aguardando reposta
                        }elseif($tb_chamados['stats'] == 2){
                            echo'
                            <div class="items call_waiting">
                                <h4>'; echo $tb_chamados['titulo']; echo '</h4>
                                <p>'; echo $tb_chamados['descricao']; echo'</p>
                                <button class="edit" onclick="window.location.href='; echo"'visualizeCalled.php?post_id="; echo $tb_chamados['id']; echo"'"; echo'">Visualizar</button>
                            </div>';
                        // Chamados resolvidos
                        }elseif($tb_chamados['stats'] == 3){
                            echo'
                            <div class="items call_resolved">
                                <h4>'; echo $tb_chamados['titulo']; echo '</h4>
                                <p>'; echo $tb_chamados['descricao']; echo'</p>
                                <button class="edit" onclick="window.location.href='; echo"'visualizeCalled.php?post_id="; echo $tb_chamados['id']; echo"'"; echo'">Visualizar</button>
                            </div>';
                        // Chamados deletados
                        }elseif($tb_chamados['stats'] == 4){
                            echo'
                            <div class="items call_delete">
                                <h4>'; echo $tb_chamados['titulo']; echo '</h4>
                                <p>'; echo $tb_chamados['descricao']; echo'</p>
                                <button class="edit" onclick="window.location.href='; echo"'visualizeCalled.php?post_id="; echo $tb_chamados['id']; echo"'"; echo'">Visualizar</button>
                            </div>';
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>