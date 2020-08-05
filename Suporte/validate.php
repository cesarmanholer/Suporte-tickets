<?php
// Conectando ao banco de dados
require ('con_db.php');

// Recuperando as informações passadas pelo formulario de Index.php
$login = $_POST['username'];  // Username
$entrar = $_POST['send'];     // Estado do botão no index.php
$senha = $_POST['password'];  // Senha


// Caso seja pressionado o botão enviar no index.php sera retornado o valor true para $entrar iniciando a verificação abaixo
  if (isset($entrar)) {
    // Verificando o banco de dados usuarios, verificando o user e o pass com as informações passadas pelo formulario de index.php
    // Especificando os parametros a ser usado
    $verifica = "SELECT * FROM usuarios WHERE users = '$login' && pass = '$senha' LIMIT 1";
    // Realizando a verificação com o banco de dados
    $resultado_usuario = mysqli_query($con, $verifica);
    // Recuperando os valores do banco de dados
    $resultado = mysqli_fetch_assoc($resultado_usuario);
      if (isset($resultado)){
        setcookie('id',$resultado['id']);
        setcookie('user',$resultado['users']);
        setcookie('email',$resultado['email']);
        header('Location:home.php'); 
      }else{
        // Redirecionando o Usuario para index.php com uma mensagem de erro
        header('Location:index.php?error=enter');
        die();
      }
  }else{
    // Redirecionando o usuario para index.php
    header('Location:index.php');
  }
?>