<?php
    // including the database connection
    session_start();
    include('conexao.php');

    // if an empty input is submited, the user will be redirected to the login page again.
    if(empty($_POST['usuario']) || empty($_POST['senha'])) {
        header('Location: login.php');
        exit();
    }

    // getting the data thru the input
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    
    // verifying if the hash combine with the password informed
    $sql = "select senha_user, nivel_user from usuario where email_user = '$usuario'";
    $query = mysqli_query($conexao, $sql);
    $data = mysqli_fetch_array($query);
    $password = $data['senha_user'];
    $level = $data['nivel_user'];

    if(password_verify($senha, $password)){

        // selecting the values informed in the database
        $query = "select ID_user, nome_user, email_user, senha_user, nivel_user from usuario where email_user = '{$usuario}' and senha_user = '{$password}'";
        $result = mysqli_query($conexao, $query);
        $row = mysqli_num_rows($result);

        // if the user is registered or not
        if($row == 1){
            // if the user is an admin
            if($level == 2){
                $_SESSION['admin'] = true;
            }

            $_SESSION['email_user'] = $usuario;
            header('Location: index.php'); 
            exit();

        }else{
            $_SESSION['nao_autenticado'] = true;
            header('Location: login_page.php'); 
            exit();
        }

    }else{
        $_SESSION['nao_autenticado'] = true;
        header('Location: login_page.php'); 
        exit();
    }








 

