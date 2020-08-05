<?php
    // Retirando as mensagens de erro do php
    error_reporting(0);
    ini_set(“display_errors”, 0 );
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Suporte</title>
        <meta charset="utf-8">
        <meta name="author" content="Cesar Augusto Manholer">
        <link rel="stylesheet" href="css/register.css">
    </head>
    <body>
        <!-- Div onde ficara contido o formulario -->
        <div id="container">
            <!-- Formulario de registro, utilizara o metodo POST para não passar nenhuma informação sigilosa pela URL 
                neste ponto inseri a proteção contra Cross‑Site Scripting XSS, quando o usuario clicar em enviar, os dados
                serão processados por meio do script em PHP que se inicia na linha 39 -->
            <form method="POST" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                <!-- Area em que sera inserido o nome de usuario, o <p></p> é utilizado como titulo do input abaixo -->
                <p>Nome de usuario:</p>
                <input id="username" name="username" type="text" placeholder="">
                <!-- Area em que sera inserido o email, o <p></p> é utilizado como titulo do input abaixo -->
                <p>Email:</p>
                <input id="email" name="email" type="email" placeholder="">
                <!-- Area em que sera inserido a senha, o <p></p> é utilizado como titulo do input abaixo -->
                <p>Senha:</p>
                <input id="password" name="password" type="password" placeholder="">
                <!-- Botão para envio das informações via method="POST" -->
                <br><input type="submit" name="send" id="send" value="Enviar">
            </form>
        </div>
    </body>
</html>

<?php
    // Carregando o excript de conexão com o banco de dados
    require ('con_db.php');
    // As variaveis abaixo são responsaveis por armazenar as informações necessarias para o registro do usuario no banco de dados
    $register = $_POST['send']; // Identificador para saber se o botão de envio do formulario for pressionado
    $user = $_POST['username']; // Identificador do nome de usuario
    $email = $_POST['email'];   // Identificador do email
    $pass = $_POST['password']; // Identificador da senha
    // Função de checagem para que se o usuario apertar o botão de envio do formulario inicie a função para salvar seus dados no banco de dados
    if($register == true){
        // Especificando as informações necessarias que vamos salvar no banco de dados
        $db_info = "INSERT INTO usuarios (users,email,pass) VALUES ('{$user}','{$email}','{$pass}')";
        // Fazendo o registro das informações no banco de dados
        mysqli_query($con, $db_info);
        // Encerrando coneão com o banco de dados
        mysqli_close($con);
        // Definindo o estado do botão como false para que assim a função não fique em loop infinito
        $register = false;
    }

?>