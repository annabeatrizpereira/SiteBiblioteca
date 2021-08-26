<?php
    // starting the session and including the database connection
    session_start();
    include('conexao.php');

    // getting the data informed by the user
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $data = mysqli_real_escape_string($conexao, trim($_POST['data']));
    $usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
    $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
    $confirmar_senha = mysqli_real_escape_string($conexao, trim($_POST['confirmar-senha']));
    $senha_segura = password_hash($senha, PASSWORD_DEFAULT);

    // checking if the user already has an account
    $sql = "select count(*) as total from usuario where email_user = '$usuario'";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);

    // if he does, a message will be displayed
    if($row['total'] != 0){
        $_SESSION['usuario_existe'] = true;
        header('Location: signup.php');
        exit;
    }

    // checking if the two input fields about the password have the same values
    if($senha != $confirmar_senha){
        $_SESSION['senhas_diferentes'] = true;
        header('Location: signup.php');
        exit;
    }

    // creating the new registration
    $sql = "insert into usuario (nome_user, nascimento_user, email_user, senha_user, nivel_user, data_user) ";
    $sql .= "values ('$nome', '$data', '$usuario', '$senha_segura', '1', NOW())";

    // if everything went well
    if($conexao->query($sql) === TRUE){
        $_SESSION['status_cadastro'] = true;
    }

    // closing the connection and redirecting the page
    $conexao->close();
    header('Location: signup.php');
    exit;


?>