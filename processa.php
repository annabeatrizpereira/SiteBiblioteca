<?php
    // including the connection to the database
    include_once("conexao.php");

    // getting the values informed by the user
    $nomeliv = filter_input(INPUT_POST, 'nomelivro', FILTER_SANITIZE_STRING);
    $autorliv = filter_input(INPUT_POST, 'autorlivro', FILTER_SANITIZE_STRING);
    $topicoliv = filter_input(INPUT_POST, 'topicolivro', FILTER_SANITIZE_STRING);
    $quantliv = filter_input(INPUT_POST, 'quantlivro', FILTER_SANITIZE_NUMBER_INT);

    // inserting it to the database
    $result_livro = "INSERT INTO livros (nome_liv, autor_liv, topicos_liv, quantidade_liv, data_liv) VALUES ('$nomeliv', '$autorliv', '$topicoliv', '$quantliv', NOW())";
    $resultado_livro = mysqli_query($conexao, $result_livro);

    //if everything went fine
    if(mysqli_insert_id($conexao)){
        $_SESSION['green'] = true;
        header("Location: collection.php");
        exit;

    // if something went wrong
    }else{
        $_SESSION['red'] = true;
        header("Location: collection.php");
        exit;
    }
