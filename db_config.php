<?php
    // Criando conexão com o phpmyadmin
    $conect_db = mysqli_connect('localhost', 'root', '');
    // Parametros para a criação do banco de dados
    $db_name = 'CREATE DATABASE suporte';
    // Criando o banco de dados
    mysqli_query($conect_db, $db_name);
    // Criando conexão com o banco de dados criado
    $con = mysqli_connect('localhost', 'root', '', 'suporte');
    // Verificando se o banco de dados foi criado
    if (!$con) {
        // Caso não foi criado sera retornado erro
        die ("Connection failed:".mysqli_connect_error());
    }else{
        // Caso for criado ira encerrar a conexão com o phpmyadmin mas mantendo a conexão com o banco de dados 
        mysqli_close($conect_db);
        // Parametros para a criação da tabela adm
        $table1 = "CREATE TABLE adm (
            id INT(255) AUTO_INCREMENT PRIMARY KEY,
            users VARCHAR(30) NULL,
            email VARCHAR(30) NULL,
            pass VARCHAR(50) NULL
        )";
        // Criando a tabela adm
        mysqli_query($con, $table1);
        // Parametros para a criação da tabela chamados
        $table2 = "CREATE TABLE chamados (
            id INT(255) AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(30) NULL,
            descricao VARCHAR(30) NULL,
            stats INT(1) NULL,
            idUser INT(1) NULL
        )";
        // // Criando a tabela chamados
        mysqli_query($con, $table2);
        // Parametros para a criação da tabela respostas
        $table3 = "CREATE TABLE respostas (
            id INT(255) AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(30) NULL,
            email VARCHAR(30) NULL,
            comentario VARCHAR(50) NULL,
            idpost INT(1) NULL,
            user INT(1) NULL
        )";
        // Criando a tabela respostas
        mysqli_query($con, $table3);
        // Parametros para a criação da tabela usuarios
        $table4 = "CREATE TABLE usuarios (
            id INT(255) AUTO_INCREMENT PRIMARY KEY,
            users VARCHAR(30) NULL,
            email VARCHAR(30) NULL,
            pass VARCHAR(50) NULL
        )";
        // Criando a tabela usuarios
        mysqli_query($con, $table4);
    }
?>